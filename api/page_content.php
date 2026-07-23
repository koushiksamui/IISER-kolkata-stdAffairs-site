<?php

/**
 * SiSAS-IITG Page Content API
 * Reads and saves static page content stored as HTML files.
 * Supported actions: get_page, save_page
 */

require_once '../api/admin_auth.php';
requireAdmin('../admin/login.php');
require_once __DIR__ . '/../php_utils/_logger.php';

header('Content-Type: application/json');

// ── Allowed page slugs (whitelist for security) ───────────────────────────────
$ALLOWED_PAGES = [
    'about_us'         => 'About Us',
    'contact_us'       => 'Contact Us',
    'director_message' => 'Message from the Director',
    'deans_message'    => 'Message from the Deans',
];

// ── Storage directory ─────────────────────────────────────────────────────────
$dataDir = __DIR__ . '/../data/pages/';
if (!is_dir($dataDir)) {
    mkdir($dataDir, 0755, true);
}

// ── Route request ─────────────────────────────────────────────────────────────
$action = '';
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $action = isset($_GET['action']) ? trim($_GET['action']) : 'get_page';
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = isset($_POST['action']) ? trim($_POST['action']) : '';
}

switch ($action) {

    // ── UPLOAD inline image for WYSIWYG editors ───────────────────────────────────
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

            // 2. Dimension validation
            $imgInfo = getimagesize($file['tmp_name']);
            if ($imgInfo === false) {
                echo json_encode(['success' => false, 'message' => 'Uploaded file is not a valid image.']);
                exit;
            }
            $width = $imgInfo[0];
            $height = $imgInfo[1];

            if ($width < 1140 || $width > 2280) {
                echo json_encode(['success' => false, 'message' => 'Image width must be between 1140px and 2280px.']);
                exit;
            }

            $ratio = $width / $height;
            if (abs($ratio - 2.0) > 0.05) { // 5% tolerance
                echo json_encode(['success' => false, 'message' => 'Image must have a 2:1 aspect ratio (e.g., 1600x800).']);
                exit;
            }

            $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'gif'])) {
                $newName = 'inline_' . time() . '_' . uniqid() . '.' . $ext;
                if (move_uploaded_file($file['tmp_name'], $uploadDir . $newName)) {
                    // Return absolute-ish URL from root
                    $url = '../dist/img/pages/inline/' . $newName;
                    echo json_encode(['success' => true, 'url' => $url]);
                    exit;
                }
            }
        }
        echo json_encode(['success' => false, 'message' => 'Upload failed. Invalid format or server error.']);
        break;

    // ── GET page content ──────────────────────────────────────────────────────
    case 'get_page':
        $slug = isset($_GET['slug']) ? preg_replace('/[^a-z0-9_]/', '', strtolower(trim($_GET['slug']))) : '';

        if (!array_key_exists($slug, $ALLOWED_PAGES)) {
            echo json_encode(['success' => false, 'message' => 'Invalid page slug.']);
            exit;
        }

        require_once __DIR__ . '/../php_utils/_dbConnect.php';

        // Check if the slug maps to a valid table for page content
        $valid_tables = ['about_us', 'director_message', 'deans_message'];
        $content = '';
        if (in_array($slug, $valid_tables)) {
            $query = "SELECT content FROM `$slug` ORDER BY id DESC LIMIT 1";
            $result = mysqli_query($conn, $query);
            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $content = $row['content'] ?? '';
            }
        }

        echo json_encode([
            'success' => true,
            'slug'    => $slug,
            'label'   => $ALLOWED_PAGES[$slug],
            'content' => $content,
        ]);
        break;

    // ── SAVE page content ─────────────────────────────────────────────────────
    case 'save_page':
        $slug    = isset($_POST['slug'])    ? preg_replace('/[^a-z0-9_]/', '', strtolower(trim($_POST['slug'])))  : '';
        $content = isset($_POST['content']) ? $_POST['content'] : '';

        if (!array_key_exists($slug, $ALLOWED_PAGES)) {
            echo json_encode(['success' => false, 'message' => 'Invalid page slug.']);
            exit;
        }

        require_once __DIR__ . '/../php_utils/_dbConnect.php';

        $valid_tables = ['about_us', 'director_message', 'deans_message'];
        if (!in_array($slug, $valid_tables)) {
            echo json_encode(['success' => false, 'message' => 'Slug is not configured for database storage.']);
            exit;
        }

        $content_safe = mysqli_real_escape_string($conn, $content);
        $updated_by_safe = mysqli_real_escape_string($conn, $_SESSION['admin_email'] ?? 'admin');

        $query = "SELECT id FROM `$slug` ORDER BY id DESC LIMIT 1";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $updateQuery = "UPDATE `$slug` SET content = '$content_safe', updated_by = '$updated_by_safe' ORDER BY id DESC LIMIT 1";
            $dbResult = mysqli_query($conn, $updateQuery);
        } else {
            $insertQuery = "INSERT INTO `$slug` (content, updated_by) VALUES ('$content_safe', '$updated_by_safe')";
            $dbResult = mysqli_query($conn, $insertQuery);
        }

        if (!$dbResult) {
            echo json_encode(['success' => false, 'message' => 'Failed to save to database: ' . mysqli_error($conn)]);
        } else {
            logActivity($conn, 'Page Content', 'UPDATE', "Updated page: $slug");
            echo json_encode([
                'success'   => true,
                'message'   => $ALLOWED_PAGES[$slug] . ' content saved successfully.',
                'slug'      => $slug,
                'saved_at'  => date('Y-m-d H:i:s'),
                'updated_by' => $updated_by_safe
            ]);
        }
        break;

    // ── GET all page metadata ─────────────────────────────────────────────────
    case 'get_all_pages':
        require_once __DIR__ . '/../php_utils/_dbConnect.php';
        $pages = [];
        $valid_tables = ['about_us', 'director_message', 'deans_message'];

        foreach ($ALLOWED_PAGES as $slug => $label) {
            $has_content = false;
            $updated_at = null;

            if (in_array($slug, $valid_tables)) {
                $query = "SELECT content, last_updated FROM `$slug` ORDER BY id DESC LIMIT 1";
                $result = mysqli_query($conn, $query);
                if ($result && mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $has_content = !empty(trim($row['content']));
                    $updated_at = $row['last_updated'];
                }
            }

            $pages[] = [
                'slug'       => $slug,
                'label'      => $label,
                'has_content' => $has_content,
                'updated_at' => $updated_at,
            ];
        }
        echo json_encode(['success' => true, 'pages' => $pages]);
        break;



    // ── GET Contact Us structured JSON ───────────────────────────────────────
    case 'get_contact_us':
        require_once __DIR__ . '/../php_utils/_dbConnect.php';

        $defaults = [
            'office_address' => '',
            'email_address' => '',
            'phone_number' => ''
        ];

        // Ensure table exists before querying
        $createTableQuery = "CREATE TABLE IF NOT EXISTS contact_us (
            id INT(11) AUTO_INCREMENT PRIMARY KEY,
            office_address TEXT,
            email_address VARCHAR(255),
            phone_number VARCHAR(100),
            last_updated DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            updated_by VARCHAR(100) DEFAULT NULL
        )";
        mysqli_query($conn, $createTableQuery);

        // Ensure columns exist for backward compatibility
        $checkCol = mysqli_query($conn, "SHOW COLUMNS FROM contact_us LIKE 'office_address'");
        if ($checkCol && mysqli_num_rows($checkCol) == 0) {
            mysqli_query($conn, "ALTER TABLE contact_us ADD COLUMN office_address TEXT");
            mysqli_query($conn, "ALTER TABLE contact_us ADD COLUMN email_address VARCHAR(255)");
            mysqli_query($conn, "ALTER TABLE contact_us ADD COLUMN phone_number VARCHAR(100)");
        }

        $query = "SELECT office_address, email_address, phone_number, last_updated, updated_by FROM contact_us ORDER BY id DESC LIMIT 1";
        $result = mysqli_query($conn, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $data = [
                'office_address' => $row['office_address'] ? $row['office_address'] : '',
                'email_address' => $row['email_address'] ? $row['email_address'] : '',
                'phone_number' => $row['phone_number'] ? $row['phone_number'] : '',
                'last_updated' => $row['last_updated'] ? $row['last_updated'] : '',
                'updated_by' => $row['updated_by'] ? $row['updated_by'] : ''
            ];
        } else {
            $data = $defaults;
        }
        echo json_encode(['success' => true, 'data' => $data]);
        break;

    // ── SAVE Contact Us structured JSON ──────────────────────────────────────
    case 'save_contact_us':
        require_once __DIR__ . '/../php_utils/_dbConnect.php';

        // Ensure table exists
        $createTableQuery = "CREATE TABLE IF NOT EXISTS contact_us (
            id INT(11) AUTO_INCREMENT PRIMARY KEY,
            office_address TEXT,
            email_address VARCHAR(255),
            phone_number VARCHAR(100),
            last_updated DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            updated_by VARCHAR(100) DEFAULT NULL
        )";
        mysqli_query($conn, $createTableQuery);

        // Ensure columns exist for backward compatibility
        $checkCol = mysqli_query($conn, "SHOW COLUMNS FROM contact_us LIKE 'office_address'");
        if ($checkCol && mysqli_num_rows($checkCol) == 0) {
            mysqli_query($conn, "ALTER TABLE contact_us ADD COLUMN office_address TEXT");
            mysqli_query($conn, "ALTER TABLE contact_us ADD COLUMN email_address VARCHAR(255)");
            mysqli_query($conn, "ALTER TABLE contact_us ADD COLUMN phone_number VARCHAR(100)");
        }

        $office_address = isset($_POST['office_address']) ? $_POST['office_address'] : '';
        $email_address = isset($_POST['email_address']) ? $_POST['email_address'] : '';
        $phone_number = isset($_POST['phone_number']) ? $_POST['phone_number'] : '';

        // Fetch existing data
        $query = "SELECT id FROM contact_us ORDER BY id DESC LIMIT 1";
        $result = mysqli_query($conn, $query);

        $office_address_safe = mysqli_real_escape_string($conn, $office_address);
        $email_address_safe = mysqli_real_escape_string($conn, $email_address);
        $phone_number_safe = mysqli_real_escape_string($conn, $phone_number);
        $updated_by_safe = mysqli_real_escape_string($conn, $_SESSION['admin_email'] ?? 'admin');

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $id = $row['id'];
            // Update existing row
            $updateQuery = "UPDATE contact_us SET office_address = '$office_address_safe', email_address = '$email_address_safe', phone_number = '$phone_number_safe', updated_by = '$updated_by_safe' WHERE id = $id";
            $dbResult = mysqli_query($conn, $updateQuery);
        } else {
            // Insert new row
            $insertQuery = "INSERT INTO contact_us (office_address, email_address, phone_number, updated_by) VALUES ('$office_address_safe', '$email_address_safe', '$phone_number_safe', '$updated_by_safe')";
            $dbResult = mysqli_query($conn, $insertQuery);
        }

        if (!$dbResult) {
            echo json_encode(['success' => false, 'message' => 'Failed to save to database: ' . mysqli_error($conn)]);
        } else {
            logActivity($conn, 'Page Content', 'UPDATE', "Updated Contact Us fields");
            echo json_encode([
                'success'  => true,
                'message'  => 'Contact Us content saved to database successfully.',
                'saved_at' => date('Y-m-d H:i:s'),
                'updated_by' => $updated_by_safe
            ]);
        }
        break;

    default:
        echo json_encode(['success' => false, 'message' => 'Unknown action.']);
        break;
}
