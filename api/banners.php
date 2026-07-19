<?php
/**
 * SiSAS-IITG Homepage Banners API
 * Handles CRUD operations for homepage carousel banners.
 * Actions: add_banner, delete_banner, toggle_banner, reorder_banners, get_banners
 */

require_once '../api/admin_auth.php';
requireAdmin('../admin/login.html');
require_once __DIR__ . '/../php_utils/_logger.php';

header('Content-Type: application/json');

// ── DB Connection ────────────────────────────────────────────────────────────
$dbPath = __DIR__ . '/../php_utils/_dbConnect.php';
if (!file_exists($dbPath)) {
    echo json_encode(['success' => false, 'message' => 'Database configuration not found.']);
    exit;
}
include_once $dbPath;

if (!isset($conn) || !$conn) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed.']);
    exit;
}

// ── Ensure banners table exists ───────────────────────────────────────────────
$createTable = "CREATE TABLE IF NOT EXISTS `homepage_banners` (
    `id`           INT AUTO_INCREMENT PRIMARY KEY,
    `image_path`   VARCHAR(500) NOT NULL,
    `title`        VARCHAR(255) NOT NULL,
    `description`  TEXT DEFAULT NULL,
    `button_text`  VARCHAR(100) DEFAULT NULL,
    `button_link`  VARCHAR(500) DEFAULT NULL,
    `sort_order`   INT DEFAULT 0,
    `is_active`    TINYINT(1) DEFAULT 1,
    `created_at`   TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
mysqli_query($conn, $createTable);

// ── Upload directory ──────────────────────────────────────────────────────────
$uploadDir = __DIR__ . '/../dist/img/banners/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

// ── Route request ─────────────────────────────────────────────────────────────
$action = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = isset($_POST['action']) ? trim($_POST['action']) : '';
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $action = isset($_GET['action']) ? trim($_GET['action']) : 'get_banners';
}

switch ($action) {

    // ── GET all banners ───────────────────────────────────────────────────────
    case 'get_banners':
        $res = mysqli_query($conn, "SELECT * FROM `homepage_banners` ORDER BY `sort_order` ASC, `id` ASC");
        $banners = [];
        while ($row = mysqli_fetch_assoc($res)) {
            $banners[] = $row;
        }
        echo json_encode(['success' => true, 'banners' => $banners]);
        break;

    // ── ADD banner ────────────────────────────────────────────────────────────
    case 'add_banner':
        $title = isset($_POST['title']) ? trim($_POST['title']) : '';
        $description = isset($_POST['description']) ? trim($_POST['description']) : '';
        $buttonText  = isset($_POST['button_text']) ? trim($_POST['button_text']) : '';
        $buttonLink  = (!empty($buttonText) && isset($_POST['button_link'])) ? trim($_POST['button_link']) : '';

        // Title is strictly required
        if (empty($title)) {
            echo json_encode(['success' => false, 'message' => 'Title is required.']);
            exit;
        }

        // Validate file upload
        if (!isset($_FILES['banner_image']) || $_FILES['banner_image']['error'] === UPLOAD_ERR_NO_FILE) {
            echo json_encode(['success' => false, 'message' => 'No image was selected.']);
            exit;
        }

        $fileInput = $_FILES['banner_image'];

        if ($fileInput['error'] !== UPLOAD_ERR_OK) {
            echo json_encode(['success' => false, 'message' => 'Upload error in image.']);
            exit;
        }

        // Size check (max 10 MB)
        if ($fileInput['size'] > 10 * 1024 * 1024) {
            echo json_encode(['success' => false, 'message' => 'File exceeds the 10 MB limit.']);
            exit;
        }

        $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp', 'image/gif'];
        $allowedExts  = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
        $finfo        = finfo_open(FILEINFO_MIME_TYPE);

        // Type check
        $mimeType = finfo_file($finfo, $fileInput['tmp_name']);
        $ext      = strtolower(pathinfo($fileInput['name'], PATHINFO_EXTENSION));
        finfo_close($finfo);

        if (!in_array($mimeType, $allowedTypes) || !in_array($ext, $allowedExts)) {
            echo json_encode(['success' => false, 'message' => 'Only JPEG, PNG, WebP, or GIF images are allowed.']);
            exit;
        }

        // Dimension and aspect ratio check
        $imageInfo = getimagesize($fileInput['tmp_name']);
        if (!$imageInfo) {
            echo json_encode(['success' => false, 'message' => 'Invalid image file.']);
            exit;
        }
        $width = $imageInfo[0];
        $height = $imageInfo[1];
        $ratio = $width / $height;

        if ($width < 1200 || $height < 600) {
            echo json_encode(['success' => false, 'message' => 'Image is too small (' . $width . 'x' . $height . 'px). Minimum required size is 1200x600 px.']);
            exit;
        }

        if (abs($ratio - 2.0) > 0.01) {
            echo json_encode(['success' => false, 'message' => 'Image has an invalid aspect ratio (' . number_format($ratio, 2) . ':1). Must be exactly 2:1.']);
            exit;
        }

        // Save valid file
        $filename   = 'banner_' . uniqid() . '_' . time() . '.' . $ext;
        $targetPath = $uploadDir . $filename;

        if (!move_uploaded_file($fileInput['tmp_name'], $targetPath)) {
            echo json_encode(['success' => false, 'message' => 'Failed to save uploaded image.']);
            exit;
        }

        $imagePath = 'dist/img/banners/' . $filename;

        // Get next sort order
        $sortRes   = mysqli_query($conn, "SELECT MAX(`sort_order`) AS max_order FROM `homepage_banners`");
        $sortRow   = mysqli_fetch_assoc($sortRes);
        $sortOrder = ($sortRow['max_order'] !== null) ? (int)$sortRow['max_order'] + 1 : 0;

        $stmt = mysqli_prepare($conn,
            "INSERT INTO `homepage_banners` (`image_path`, `title`, `description`, `button_text`, `button_link`, `sort_order`, `is_active`)
             VALUES (?, ?, ?, ?, ?, ?, 1)"
        );
        mysqli_stmt_bind_param($stmt, 'sssssi', $imagePath, $title, $description, $buttonText, $buttonLink, $sortOrder);

        if (mysqli_stmt_execute($stmt)) {
            $newId = mysqli_insert_id($conn);
            logActivity($conn, 'Banners', 'CREATE', "Added new banner ID $newId: $title");
            echo json_encode(['success' => true, 'message' => 'Banner uploaded successfully.']);
        } else {
            $dbError = mysqli_error($conn);
            @unlink($targetPath);
            echo json_encode(['success' => false, 'message' => 'Database error. Failed to save banner. Error: ' . $dbError]);
        }
        mysqli_stmt_close($stmt);
        break;

    // ── EDIT banner ───────────────────────────────────────────────────────────
    case 'edit_banner':
        $id = isset($_POST['banner_id']) ? (int)$_POST['banner_id'] : 0;
        if ($id <= 0) {
            echo json_encode(['success' => false, 'message' => 'Invalid banner ID.']);
            exit;
        }

        $title = isset($_POST['title']) ? trim($_POST['title']) : '';
        $description = isset($_POST['description']) ? trim($_POST['description']) : '';
        $buttonText  = isset($_POST['button_text']) ? trim($_POST['button_text']) : '';
        $buttonLink  = (!empty($buttonText) && isset($_POST['button_link'])) ? trim($_POST['button_link']) : '';

        // Title is strictly required
        if (empty($title)) {
            echo json_encode(['success' => false, 'message' => 'Title is required.']);
            exit;
        }

        // Fetch existing banner
        $res = mysqli_query($conn, "SELECT * FROM `homepage_banners` WHERE `id` = $id LIMIT 1");
        if (!$res || mysqli_num_rows($res) === 0) {
            echo json_encode(['success' => false, 'message' => 'Banner not found.']);
            exit;
        }
        $existing = mysqli_fetch_assoc($res);
        $imagePath = $existing['image_path'];

        $newImageUploaded = false;
        $tempFileToDelete = null;

        // Process image if selected
        if (isset($_FILES['banner_image']) && $_FILES['banner_image']['error'] !== UPLOAD_ERR_NO_FILE) {
            $fileInput = $_FILES['banner_image'];

            if ($fileInput['error'] !== UPLOAD_ERR_OK) {
                echo json_encode(['success' => false, 'message' => 'Upload error in image.']);
                exit;
            }

            // Size check (max 10 MB)
            if ($fileInput['size'] > 10 * 1024 * 1024) {
                echo json_encode(['success' => false, 'message' => 'File exceeds the 10 MB limit.']);
                exit;
            }

            $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp', 'image/gif'];
            $allowedExts  = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
            $finfo        = finfo_open(FILEINFO_MIME_TYPE);

            // Type check
            $mimeType = finfo_file($finfo, $fileInput['tmp_name']);
            $ext      = strtolower(pathinfo($fileInput['name'], PATHINFO_EXTENSION));
            finfo_close($finfo);

            if (!in_array($mimeType, $allowedTypes) || !in_array($ext, $allowedExts)) {
                echo json_encode(['success' => false, 'message' => 'Only JPEG, PNG, WebP, or GIF images are allowed.']);
                exit;
            }

            // Dimension and aspect ratio check
            $imageInfo = getimagesize($fileInput['tmp_name']);
            if (!$imageInfo) {
                echo json_encode(['success' => false, 'message' => 'Invalid image file.']);
                exit;
            }
            $width = $imageInfo[0];
            $height = $imageInfo[1];
            $ratio = $width / $height;

            if ($width < 1200 || $height < 600) {
                echo json_encode(['success' => false, 'message' => 'Image is too small (' . $width . 'x' . $height . 'px). Minimum required size is 1200x600 px.']);
                exit;
            }

            if (abs($ratio - 2.0) > 0.01) {
                echo json_encode(['success' => false, 'message' => 'Image has an invalid aspect ratio (' . number_format($ratio, 2) . ':1). Must be exactly 2:1.']);
                exit;
            }

            // Save new file
            $filename   = 'banner_' . uniqid() . '_' . time() . '.' . $ext;
            $targetPath = $uploadDir . $filename;

            if (!move_uploaded_file($fileInput['tmp_name'], $targetPath)) {
                echo json_encode(['success' => false, 'message' => 'Failed to save uploaded image.']);
                exit;
            }

            // Prepare to delete the old physical file if it exists and is different
            $tempFileToDelete = __DIR__ . '/../' . $existing['image_path'];
            $imagePath = 'dist/img/banners/' . $filename;
            $newImageUploaded = true;
        }

        // Update database
        $stmt = mysqli_prepare($conn,
            "UPDATE `homepage_banners` 
             SET `image_path` = ?, `title` = ?, `description` = ?, `button_text` = ?, `button_link` = ? 
             WHERE `id` = ?"
        );
        mysqli_stmt_bind_param($stmt, 'sssssi', $imagePath, $title, $description, $buttonText, $buttonLink, $id);

        if (mysqli_stmt_execute($stmt)) {
            // Delete old file if a new one was uploaded successfully
            if ($newImageUploaded && $tempFileToDelete && file_exists($tempFileToDelete)) {
                @unlink($tempFileToDelete);
            }
            logActivity($conn, 'Banners', 'UPDATE', "Updated banner ID $id: $title");
            echo json_encode(['success' => true, 'message' => 'Banner updated successfully.']);
        } else {
            $dbError = mysqli_error($conn);
            if ($newImageUploaded) {
                @unlink($uploadDir . basename($imagePath));
            }
            echo json_encode(['success' => false, 'message' => 'Database error. Failed to update banner. Error: ' . $dbError]);
        }
        mysqli_stmt_close($stmt);
        break;

    // ── DELETE banner ─────────────────────────────────────────────────────────
    case 'delete_banner':
        $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
        if ($id <= 0) {
            echo json_encode(['success' => false, 'message' => 'Invalid banner ID.']);
            exit;
        }

        // Get the image path before deleting
        $res = mysqli_query($conn, "SELECT `image_path` FROM `homepage_banners` WHERE `id` = $id LIMIT 1");
        if (!$res || mysqli_num_rows($res) === 0) {
            echo json_encode(['success' => false, 'message' => 'Banner not found.']);
            exit;
        }
        $row       = mysqli_fetch_assoc($res);
        $imgPath   = __DIR__ . '/../' . $row['image_path'];

        if (mysqli_query($conn, "DELETE FROM `homepage_banners` WHERE `id` = $id")) {
            // Delete the physical file
            if (file_exists($imgPath)) {
                @unlink($imgPath);
            }
            logActivity($conn, 'Banners', 'DELETE', "Deleted banner ID $id");
            echo json_encode(['success' => true, 'message' => 'Banner deleted successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to delete banner.']);
        }
        break;

    // ── TOGGLE active state ───────────────────────────────────────────────────
    case 'toggle_banner':
        $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
        if ($id <= 0) {
            echo json_encode(['success' => false, 'message' => 'Invalid banner ID.']);
            exit;
        }

        $res = mysqli_query($conn, "SELECT `is_active` FROM `homepage_banners` WHERE `id` = $id LIMIT 1");
        if (!$res || mysqli_num_rows($res) === 0) {
            echo json_encode(['success' => false, 'message' => 'Banner not found.']);
            exit;
        }
        $row       = mysqli_fetch_assoc($res);
        $newStatus = $row['is_active'] ? 0 : 1;

        if (mysqli_query($conn, "UPDATE `homepage_banners` SET `is_active` = $newStatus WHERE `id` = $id")) {
            logActivity($conn, 'Banners', 'UPDATE', "Toggled banner ID $id active status to $newStatus");
            echo json_encode(['success' => true, 'is_active' => $newStatus]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update banner status.']);
        }
        break;

    // ── REORDER banners ───────────────────────────────────────────────────────
    case 'reorder_banners':
        $orderJson = isset($_POST['order']) ? $_POST['order'] : '[]';
        $orderArr  = json_decode($orderJson, true);

        if (!is_array($orderArr)) {
            echo json_encode(['success' => false, 'message' => 'Invalid order data.']);
            exit;
        }

        $allOk = true;
        foreach ($orderArr as $index => $bannerId) {
            $id = (int)$bannerId;
            if ($id <= 0) continue;
            if (!mysqli_query($conn, "UPDATE `homepage_banners` SET `sort_order` = $index WHERE `id` = $id")) {
                $allOk = false;
            }
        }

        if ($allOk) {
            logActivity($conn, 'Banners', 'UPDATE', "Reordered homepage banners");
        }
        echo json_encode(['success' => $allOk]);
        break;

    default:
        echo json_encode(['success' => false, 'message' => 'Invalid action.']);
}
