<?php

/**
 * SiSAS-IITG Admin API — Notices Management
 */

require_once 'admin_auth.php';
requireAdmin('../admin/login.html');
require_once __DIR__ . '/../php_utils/_dbConnect.php';
require_once __DIR__ . '/../php_utils/_logger.php';

header('Content-Type: application/json');

// Ensure the `notices` table exists
$createTableQuery = "CREATE TABLE IF NOT EXISTS notices (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    pdf_path VARCHAR(255) DEFAULT NULL,
    link VARCHAR(255) DEFAULT NULL,
    type VARCHAR(50) NOT NULL,
    other_type_name VARCHAR(50) DEFAULT NULL,
    status VARCHAR(20) DEFAULT 'published',
    scheduled_time DATETIME DEFAULT NULL,
    is_pinned TINYINT(1) DEFAULT 0,
    pinned_till DATETIME DEFAULT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
)";
if (!mysqli_query($conn, $createTableQuery)) {
    echo json_encode(['success' => false, 'message' => 'Database error: Could not create notices table.']);
    exit;
}

// Ensure columns exist if table was already created
$alterColumns = [
    "other_type_name" => "VARCHAR(50) DEFAULT NULL",
    "is_pinned" => "TINYINT(1) DEFAULT 0",
    "pinned_till" => "DATETIME DEFAULT NULL"
];
foreach ($alterColumns as $col => $def) {
    $checkCol = mysqli_query($conn, "SHOW COLUMNS FROM notices LIKE '$col'");
    if (mysqli_num_rows($checkCol) == 0) {
        mysqli_query($conn, "ALTER TABLE notices ADD COLUMN $col $def");
    }
}

$action = '';
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $action = isset($_GET['action']) ? trim($_GET['action']) : '';
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = isset($_POST['action']) ? trim($_POST['action']) : '';
}

// ── Helpers ───────────────────────────────────────────────────────────────────
function uploadPdf()
{
    if (!isset($_FILES['pdf_file']) || $_FILES['pdf_file']['error'] !== UPLOAD_ERR_OK) {
        return null; // No file uploaded or error
    }

    $uploadDir = __DIR__ . '/../dist/notices/';
    if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

    $file = $_FILES['pdf_file'];
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

    $allowed = ['pdf'];
    if (!in_array($ext, $allowed)) {
        throw new Exception('Invalid file format. Only PDF allowed.');
    }

    $newName = 'notice_' . time() . '_' . uniqid() . '.' . $ext;
    if (move_uploaded_file($file['tmp_name'], $uploadDir . $newName)) {
        return 'dist/notices/' . $newName; // Relative path from root
    } else {
        throw new Exception('Failed to move uploaded file.');
    }
}

// ── Routing ───────────────────────────────────────────────────────────────────
switch ($action) {
    case 'get_notices':
        $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
        $limit = isset($_GET['limit']) ? max(1, intval($_GET['limit'])) : 10;
        $search = isset($_GET['search']) ? mysqli_real_escape_string($conn, trim($_GET['search'])) : '';
        $public_only = isset($_GET['public_only']) ? (bool)$_GET['public_only'] : false;
        
        $whereClause = "1=1";
        if ($search !== '') {
            $whereClause .= " AND (title LIKE '%$search%' OR type LIKE '%$search%')";
        }

        // Auto-scheduling logic for public view
        if ($public_only) {
            $whereClause .= " AND (status = 'published' OR (status = 'scheduled' AND scheduled_time <= NOW()))";
        }

        $countQuery = "SELECT COUNT(*) as total FROM notices WHERE $whereClause";
        $countResult = mysqli_query($conn, $countQuery);
        $totalRow = mysqli_fetch_assoc($countResult);
        $total = intval($totalRow['total']);

        $offset = ($page - 1) * $limit;
        
        // Failsafe: dynamically unpin expired notices
        mysqli_query($conn, "UPDATE notices SET is_pinned = 0 WHERE is_pinned = 1 AND pinned_till < NOW()");

        $query = "SELECT * FROM notices WHERE $whereClause ORDER BY is_pinned DESC, created_at DESC, id DESC LIMIT $limit OFFSET $offset";
        $result = mysqli_query($conn, $query);
        
        $notices = [];
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $notices[] = $row;
            }
        }
        echo json_encode([
            'success' => true, 
            'data' => $notices,
            'total' => $total,
            'page' => $page,
            'limit' => $limit
        ]);
        break;

    case 'save_notice':
        // Retrieve and sanitize fields
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;

        $title = mysqli_real_escape_string($conn, trim($_POST['title'] ?? ''));
        $link = mysqli_real_escape_string($conn, trim($_POST['link'] ?? ''));
        $type = mysqli_real_escape_string($conn, trim($_POST['type'] ?? 'Academic'));
        $other_type_name = mysqli_real_escape_string($conn, trim($_POST['other_type_name'] ?? ''));
        $status = mysqli_real_escape_string($conn, trim($_POST['status'] ?? 'published'));
        $scheduled_time_raw = trim($_POST['scheduled_time'] ?? '');
        $scheduled_time = !empty($scheduled_time_raw) ? "'" . mysqli_real_escape_string($conn, $scheduled_time_raw) . "'" : "NULL";
        
        $is_pinned = isset($_POST['is_pinned']) ? 1 : 0;
        $pinned_till_raw = trim($_POST['pinned_till'] ?? '');
        $pinned_till = !empty($pinned_till_raw) ? "'" . mysqli_real_escape_string($conn, $pinned_till_raw) . "'" : "NULL";

        // Handle File Upload
        $pdfPath = null;
        try {
            $pdfPath = uploadPdf();
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            exit;
        }

        if ($id > 0) {
            // Update
            $updateFields = [
                "title = '$title'",
                "link = '$link'",
                "type = '$type'",
                "other_type_name = '$other_type_name'",
                "status = '$status'",
                "scheduled_time = $scheduled_time",
                "is_pinned = $is_pinned",
                "pinned_till = $pinned_till"
            ];

            if ($pdfPath) {
                // Optionally delete old file? Keeping it simple here.
                $updateFields[] = "pdf_path = '" . mysqli_real_escape_string($conn, $pdfPath) . "'";
            }

            $query = "UPDATE notices SET " . implode(", ", $updateFields) . " WHERE id = $id";
            if (mysqli_query($conn, $query)) {
                logActivity($conn, 'Notices', 'UPDATE', "Updated notice ID $id: $title");
                echo json_encode(['success' => true, 'message' => 'Notice updated successfully.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'DB Error: ' . mysqli_error($conn)]);
            }
        } else {
            // Insert
            $fields = "title, link, type, other_type_name, status, scheduled_time, is_pinned, pinned_till";
            $values = "'$title', '$link', '$type', '$other_type_name', '$status', $scheduled_time, $is_pinned, $pinned_till";

            if ($pdfPath) {
                $fields .= ", pdf_path";
                $values .= ", '" . mysqli_real_escape_string($conn, $pdfPath) . "'";
            }

            $query = "INSERT INTO notices ($fields) VALUES ($values)";
            if (mysqli_query($conn, $query)) {
                $newId = mysqli_insert_id($conn);
                logActivity($conn, 'Notices', 'CREATE', "Created new notice ID $newId: $title");
                echo json_encode(['success' => true, 'message' => 'Notice added successfully.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'DB Error: ' . mysqli_error($conn)]);
            }
        }
        break;

    case 'delete_notice':
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        if ($id > 0) {
            $q = mysqli_query($conn, "SELECT pdf_path FROM notices WHERE id = $id");
            if ($row = mysqli_fetch_assoc($q)) {
                if ($row['pdf_path'] && file_exists(__DIR__ . '/../' . $row['pdf_path'])) {
                    unlink(__DIR__ . '/../' . $row['pdf_path']);
                }
            }

            $query = "DELETE FROM notices WHERE id = $id";
            if (mysqli_query($conn, $query)) {
                logActivity($conn, 'Notices', 'DELETE', "Deleted notice ID $id");
                echo json_encode(['success' => true, 'message' => 'Notice deleted successfully.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'DB Error: ' . mysqli_error($conn)]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid ID.']);
        }
        break;

    default:
        echo json_encode(['success' => false, 'message' => 'Invalid API action.']);
        break;
}
