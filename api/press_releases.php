<?php

/**
 * SiSAS-IITG Admin API — Press Releases Management
 */

require_once 'admin_auth.php';
requireAdmin('../admin/login.html');
require_once __DIR__ . '/../php_utils/_dbConnect.php';
require_once __DIR__ . '/../php_utils/_logger.php';

header('Content-Type: application/json');

// Ensure the `press_releases` table exists
$createTableQuery = "CREATE TABLE IF NOT EXISTS press_releases (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content LONGTEXT NOT NULL,
    created_by VARCHAR(255) NOT NULL,
    author VARCHAR(255) DEFAULT NULL,
    tags VARCHAR(255) DEFAULT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
)";
if (!mysqli_query($conn, $createTableQuery)) {
    echo json_encode(['success' => false, 'message' => 'Database error: Could not create press_releases table.']);
    exit;
}

// Check if the author column exists, if not add it dynamically
$checkColumnQuery = "SHOW COLUMNS FROM press_releases LIKE 'author'";
$checkResult = mysqli_query($conn, $checkColumnQuery);
if ($checkResult && mysqli_num_rows($checkResult) == 0) {
    mysqli_query($conn, "ALTER TABLE press_releases ADD COLUMN author VARCHAR(255) DEFAULT NULL");
}

// Check if the tags column exists, if not add it dynamically
$checkTagsColumnQuery = "SHOW COLUMNS FROM press_releases LIKE 'tags'";
$checkTagsResult = mysqli_query($conn, $checkTagsColumnQuery);
if ($checkTagsResult && mysqli_num_rows($checkTagsResult) == 0) {
    mysqli_query($conn, "ALTER TABLE press_releases ADD COLUMN tags VARCHAR(255) DEFAULT NULL");
}

$action = '';
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $action = isset($_GET['action']) ? trim($_GET['action']) : '';
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = isset($_POST['action']) ? trim($_POST['action']) : '';
}

$adminEmail = isset($_SESSION['admin_email']) ? $_SESSION['admin_email'] : 'admin@iitg.ac.in';

switch ($action) {
    case 'get_releases':
        $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
        $limit = isset($_GET['limit']) ? max(1, intval($_GET['limit'])) : 10;
        $search = isset($_GET['search']) ? mysqli_real_escape_string($conn, trim($_GET['search'])) : '';

        $whereClause = "1=1";
        if ($search !== '') {
            $whereClause .= " AND (
                title LIKE '%$search%' 
                OR content LIKE '%$search%' 
                OR author LIKE '%$search%' 
                OR tags LIKE '%$search%' 
                OR DATE_FORMAT(created_at, '%d %b %Y') LIKE '%$search%'
            )";
        }

        $countQuery = "SELECT COUNT(*) as total FROM press_releases WHERE $whereClause";
        $countResult = mysqli_query($conn, $countQuery);
        $totalRow = mysqli_fetch_assoc($countResult);
        $total = intval($totalRow['total']);

        $offset = ($page - 1) * $limit;

        $query = "SELECT * FROM press_releases WHERE $whereClause ORDER BY created_at DESC, id DESC LIMIT $limit OFFSET $offset";
        $result = mysqli_query($conn, $query);
        
        $releases = [];
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $releases[] = $row;
            }
        }
        echo json_encode([
            'success' => true, 
            'data' => $releases,
            'total' => $total,
            'page' => $page,
            'limit' => $limit
        ]);
        break;

    case 'save_release':
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;

        $title = mysqli_real_escape_string($conn, trim($_POST['title'] ?? ''));
        $content = mysqli_real_escape_string($conn, trim($_POST['content'] ?? ''));
        $author = isset($_POST['author']) ? mysqli_real_escape_string($conn, trim($_POST['author'])) : '';
        $tags = isset($_POST['tags']) ? mysqli_real_escape_string($conn, trim($_POST['tags'])) : '';
        $created_by = mysqli_real_escape_string($conn, $adminEmail);

        if (empty($title) || empty($content)) {
            echo json_encode(['success' => false, 'message' => 'Please fill all required fields.']);
            exit;
        }

        $authorVal = ($author === '') ? "NULL" : "'$author'";
        $tagsVal = ($tags === '') ? "NULL" : "'$tags'";

        if ($id > 0) {
            // Update
            $updateFields = [
                "title = '$title'",
                "content = '$content'",
                "author = $authorVal",
                "tags = $tagsVal"
            ];

            $query = "UPDATE press_releases SET " . implode(", ", $updateFields) . " WHERE id = $id";
            if (mysqli_query($conn, $query)) {
                logActivity($conn, 'Press Releases', 'UPDATE', "Updated press release ID $id: $title");
                echo json_encode(['success' => true, 'message' => 'Press release updated successfully.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'DB Error: ' . mysqli_error($conn)]);
            }
        } else {
            // Insert
            $fields = "title, content, created_by, author, tags";
            $values = "'$title', '$content', '$created_by', $authorVal, $tagsVal";

            $query = "INSERT INTO press_releases ($fields) VALUES ($values)";
            if (mysqli_query($conn, $query)) {
                $newId = mysqli_insert_id($conn);
                logActivity($conn, 'Press Releases', 'CREATE', "Created new press release ID $newId: $title");
                echo json_encode(['success' => true, 'message' => 'Press release added successfully.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'DB Error: ' . mysqli_error($conn)]);
            }
        }
        break;

    case 'delete_release':
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        if ($id > 0) {
            $query = "DELETE FROM press_releases WHERE id = $id";
            if (mysqli_query($conn, $query)) {
                logActivity($conn, 'Press Releases', 'DELETE', "Deleted press release ID $id");
                echo json_encode(['success' => true, 'message' => 'Press release deleted successfully.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'DB Error: ' . mysqli_error($conn)]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid ID.']);
        }
        break;

    case 'upload_inline_image':
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../dist/img/pages/inline/';
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
            
            $file = $_FILES['image'];
            
            // 1. Type validation (MIME type)
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mimeType = finfo_file($finfo, $file['tmp_name']);
            finfo_close($finfo);
            
            $allowedMimes = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
            if (!in_array($mimeType, $allowedMimes)) {
                echo json_encode(['success' => false, 'message' => 'Invalid file type. Only JPG, PNG, WEBP, and GIF are allowed.']);
                exit;
            }

            // 2. Validate image validity
            $imgInfo = getimagesize($file['tmp_name']);
            if ($imgInfo === false) {
                echo json_encode(['success' => false, 'message' => 'Uploaded file is not a valid image.']);
                exit;
            }

            $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            $newFilename = 'pr_inline_' . time() . '_' . rand(1000, 9999) . '.' . $ext;
            $destPath = $uploadDir . $newFilename;
            
            if (move_uploaded_file($file['tmp_name'], $destPath)) {
                $url = '../dist/img/pages/inline/' . $newFilename;
                echo json_encode(['success' => true, 'url' => $url]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to save uploaded file.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'No file uploaded or upload error.']);
        }
        break;

    default:
        echo json_encode(['success' => false, 'message' => 'Invalid API action.']);
        break;
}
