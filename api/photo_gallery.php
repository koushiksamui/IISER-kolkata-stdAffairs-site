<?php

/**
 * SiSAS-IITG Admin API — Photo Gallery Management
 */

require_once 'admin_auth.php';
requireAdmin('../admin/login.php');
require_once __DIR__ . '/../php_utils/_dbConnect.php';
require_once __DIR__ . '/../php_utils/_logger.php';

header('Content-Type: application/json');

// Ensure tables exist
$createGalleriesTable = "CREATE TABLE IF NOT EXISTS photo_galleries (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    created_by VARCHAR(255),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
)";
if (!mysqli_query($conn, $createGalleriesTable)) {
    echo json_encode(['success' => false, 'message' => 'Database error: Could not create photo_galleries table.']);
    exit;
}

$createImagesTable = "CREATE TABLE IF NOT EXISTS photo_gallery_images (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    gallery_id INT(11) NOT NULL,
    image_path VARCHAR(255) NOT NULL,
    display_order INT(11) DEFAULT 0,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (gallery_id) REFERENCES photo_galleries(id) ON DELETE CASCADE
)";
if (!mysqli_query($conn, $createImagesTable)) {
    echo json_encode(['success' => false, 'message' => 'Database error: Could not create photo_gallery_images table.']);
    exit;
}

$action = '';
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $action = isset($_GET['action']) ? trim($_GET['action']) : '';
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Catch POST Content-Length overflow before routing
    if (empty($_POST) && empty($_FILES) && isset($_SERVER['CONTENT_LENGTH']) && $_SERVER['CONTENT_LENGTH'] > 0) {
        $sizeMB = round($_SERVER['CONTENT_LENGTH'] / (1024 * 1024), 2);
        echo json_encode([
            'success' => false,
            'message' => "Uploaded batch ($sizeMB MB) exceeds the server's post_max_size limit. Please upload fewer photos per batch (e.g., 5–10 photos) or compress large files."
        ]);
        exit;
    }
    $action = isset($_POST['action']) ? trim($_POST['action']) : '';
}

$adminEmail = isset($_SESSION['admin_email']) ? $_SESSION['admin_email'] : 'admin@iitg.ac.in';

// ── Helpers ───────────────────────────────────────────────────────────────────

function uploadMultiplePhotos()
{
    $uploadedPaths = [];
    if (!isset($_FILES['images'])) {
        return $uploadedPaths;
    }

    $uploadDir = __DIR__ . '/../dist/img/galleries/';
    if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

    $files = $_FILES['images'];
    $fileCount = is_array($files['name']) ? count($files['name']) : (empty($files['name']) ? 0 : 1);

    if ($fileCount === 0) return $uploadedPaths;

    for ($i = 0; $i < $fileCount; $i++) {
        $name = is_array($files['name']) ? $files['name'][$i] : $files['name'];
        $tmp_name = is_array($files['tmp_name']) ? $files['tmp_name'][$i] : $files['tmp_name'];
        $error = is_array($files['error']) ? $files['error'][$i] : $files['error'];

        if ($error !== UPLOAD_ERR_OK) {
            throw new Exception("File upload error code: $error on file $name");
        }

        $size = is_array($files['size']) ? $files['size'][$i] : $files['size'];
        $maxSizeBytes = 5 * 1024 * 1024; // 5 MB limit per image
        if ($size > $maxSizeBytes) {
            $sizeMB = round($size / (1024 * 1024), 2);
            throw new Exception("File '$name' ($sizeMB MB) exceeds the maximum allowed limit of 5 MB per image.");
        }

        $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'webp', 'gif'];

        if (!in_array($ext, $allowed)) {
            throw new Exception("Invalid file extension: $ext");
        }

        $newName = 'gallery_' . time() . '_' . uniqid() . '.' . $ext;
        if (move_uploaded_file($tmp_name, $uploadDir . $newName)) {
            $uploadedPaths[] = 'dist/img/galleries/' . $newName; // Relative path from root
        } else {
            throw new Exception("Failed to move uploaded file: $name");
        }
    }

    return $uploadedPaths;
}

// ── Routing ───────────────────────────────────────────────────────────────────
switch ($action) {
    case 'get_galleries':
        $query = "
            SELECT g.*, 
                   (SELECT COUNT(*) FROM photo_gallery_images i WHERE i.gallery_id = g.id) AS image_count
            FROM photo_galleries g
            ORDER BY g.created_at DESC
        ";
        $result = mysqli_query($conn, $query);
        $galleries = [];
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $galId = intval($row['id']);
                $imgQ = mysqli_query($conn, "SELECT image_path FROM photo_gallery_images WHERE gallery_id = $galId ORDER BY display_order ASC, id ASC LIMIT 5");
                $imgs = [];
                while ($imgRow = mysqli_fetch_assoc($imgQ)) {
                    $path = $imgRow['image_path'];
                    $imgs[] = preg_match('/^https?:\/\//', $path) ? $path : '../' . $path;
                }
                $row['images'] = $imgs;
                $row['cover_image'] = !empty($imgs) ? $imgs[0] : null;
                $galleries[] = $row;
            }
        }
        echo json_encode(['success' => true, 'data' => $galleries]);
        break;

    case 'save_gallery':
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        $title = mysqli_real_escape_string($conn, trim($_POST['title'] ?? ''));

        if (empty($title)) {
            echo json_encode(['success' => false, 'message' => 'Title is required.']);
            exit;
        }

        if ($id > 0) {
            $query = "UPDATE photo_galleries SET title = '$title' WHERE id = $id";
            if (mysqli_query($conn, $query)) {
                $galleryId = $id;
                logActivity($conn, 'Gallery', 'UPDATE', "Updated gallery ID $id: $title");
            } else {
                echo json_encode(['success' => false, 'message' => 'DB Error: ' . mysqli_error($conn)]);
                exit;
            }
        } else {
            $created_by = mysqli_real_escape_string($conn, $adminEmail);
            $query = "INSERT INTO photo_galleries (title, created_by) VALUES ('$title', '$created_by')";
            if (mysqli_query($conn, $query)) {
                $galleryId = mysqli_insert_id($conn);
                logActivity($conn, 'Gallery', 'CREATE', "Created new gallery ID $galleryId: $title");
            } else {
                echo json_encode(['success' => false, 'message' => 'DB Error: ' . mysqli_error($conn)]);
                exit;
            }
        }

        try {
            $paths = uploadMultiplePhotos();
            if (!empty($paths)) {
                $orderQuery = mysqli_query($conn, "SELECT MAX(display_order) as max_order FROM photo_gallery_images WHERE gallery_id = $galleryId");
                $maxOrder = 0;
                if ($orderQuery && $orderRow = mysqli_fetch_assoc($orderQuery)) {
                    $maxOrder = intval($orderRow['max_order']);
                }
                foreach ($paths as $path) {
                    $maxOrder++;
                    $safePath = mysqli_real_escape_string($conn, $path);
                    mysqli_query($conn, "INSERT INTO photo_gallery_images (gallery_id, image_path, display_order) VALUES ($galleryId, '$safePath', $maxOrder)");
                }
            }
        } catch (Exception $e) {
        }

        echo json_encode(['success' => true, 'message' => 'Gallery saved successfully.']);
        break;

    case 'delete_gallery':
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        if ($id > 0) {
            // First, get all image paths to delete files
            $q = mysqli_query($conn, "SELECT image_path FROM photo_gallery_images WHERE gallery_id = $id");
            while ($row = mysqli_fetch_assoc($q)) {
                if ($row['image_path'] && file_exists(__DIR__ . '/../' . $row['image_path'])) {
                    unlink(__DIR__ . '/../' . $row['image_path']);
                }
            }

            $query = "DELETE FROM photo_galleries WHERE id = $id";
            if (mysqli_query($conn, $query)) {
                logActivity($conn, 'Gallery', 'DELETE', "Deleted gallery ID $id");
                echo json_encode(['success' => true, 'message' => 'Gallery and its images deleted successfully.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'DB Error: ' . mysqli_error($conn)]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid ID.']);
        }
        break;

    case 'get_images':
        $gallery_id = isset($_GET['gallery_id']) ? intval($_GET['gallery_id']) : 0;
        if ($gallery_id <= 0) {
            echo json_encode(['success' => false, 'message' => 'Gallery ID is required.']);
            exit;
        }

        $query = "SELECT * FROM photo_gallery_images WHERE gallery_id = $gallery_id ORDER BY display_order ASC, id ASC";
        $result = mysqli_query($conn, $query);
        $images = [];
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $images[] = $row;
            }
        }

        $galQuery = mysqli_query($conn, "SELECT title FROM photo_galleries WHERE id = $gallery_id");
        $galInfo = mysqli_fetch_assoc($galQuery);
        $gallery_title = $galInfo ? $galInfo['title'] : 'Unknown Gallery';

        echo json_encode([
            'success' => true,
            'data' => $images,
            'gallery_title' => $gallery_title
        ]);
        break;

    case 'upload_images':
        $gallery_id = isset($_POST['gallery_id']) ? intval($_POST['gallery_id']) : 0;

        if ($gallery_id <= 0) {
            echo json_encode(['success' => false, 'message' => 'Invalid gallery ID.']);
            exit;
        }

        $galCheck = mysqli_query($conn, "SELECT id, title FROM photo_galleries WHERE id = $gallery_id");
        if (!$galCheck || mysqli_num_rows($galCheck) === 0) {
            echo json_encode(['success' => false, 'message' => 'Gallery not found.']);
            exit;
        }
        $galInfo = mysqli_fetch_assoc($galCheck);

        try {
            $paths = uploadMultiplePhotos();
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            exit;
        }

        if (empty($paths)) {
            echo json_encode(['success' => false, 'message' => 'No valid images were uploaded.']);
            exit;
        }

        // Get current max display_order for this gallery
        $orderQuery = mysqli_query($conn, "SELECT MAX(display_order) as max_order FROM photo_gallery_images WHERE gallery_id = $gallery_id");
        $maxOrder = 0;
        if ($orderQuery && $orderRow = mysqli_fetch_assoc($orderQuery)) {
            $maxOrder = intval($orderRow['max_order']);
        }

        $successCount = 0;
        foreach ($paths as $path) {
            $maxOrder++;
            $safePath = mysqli_real_escape_string($conn, $path);
            $query = "INSERT INTO photo_gallery_images (gallery_id, image_path, display_order) VALUES ($gallery_id, '$safePath', $maxOrder)";
            if (mysqli_query($conn, $query)) {
                $successCount++;
            }
        }

        if ($successCount > 0) {
            logActivity($conn, 'Gallery', 'UPDATE', "Uploaded $successCount images to gallery: {$galInfo['title']}");
            echo json_encode(['success' => true, 'message' => "Successfully uploaded $successCount image(s)."]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to save images to the database.']);
        }
        break;

    case 'delete_image':
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        if ($id > 0) {
            $q = mysqli_query($conn, "SELECT image_path, gallery_id FROM photo_gallery_images WHERE id = $id");
            if ($row = mysqli_fetch_assoc($q)) {
                if ($row['image_path'] && file_exists(__DIR__ . '/../' . $row['image_path'])) {
                    unlink(__DIR__ . '/../' . $row['image_path']);
                }
                $gallery_id = $row['gallery_id'];
            }

            $query = "DELETE FROM photo_gallery_images WHERE id = $id";
            if (mysqli_query($conn, $query)) {
                logActivity($conn, 'Gallery', 'DELETE', "Deleted an image from gallery ID $gallery_id");
                echo json_encode(['success' => true, 'message' => 'Image deleted successfully.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'DB Error: ' . mysqli_error($conn)]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid ID.']);
        }
        break;

    case 'reorder_images':
        $orderJson = isset($_POST['order']) ? $_POST['order'] : '[]';
        $orderArr = json_decode($orderJson, true);
        if (is_array($orderArr)) {
            $success = true;
            foreach ($orderArr as $index => $id) {
                $id = intval($id);
                $displayOrder = $index + 1;
                if ($id > 0) {
                    if (!mysqli_query($conn, "UPDATE photo_gallery_images SET display_order = $displayOrder WHERE id = $id")) {
                        $success = false;
                    }
                }
            }
            if ($success) {
                echo json_encode(['success' => true, 'message' => 'Order updated successfully.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Some items failed to update.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid order data.']);
        }
        break;

    case 'delete_all_images':
        $gallery_id = isset($_POST['gallery_id']) ? intval($_POST['gallery_id']) : 0;
        if ($gallery_id > 0) {
            $q = mysqli_query($conn, "SELECT image_path FROM photo_gallery_images WHERE gallery_id = $gallery_id");
            while ($row = mysqli_fetch_assoc($q)) {
                if ($row['image_path'] && file_exists(__DIR__ . '/../' . $row['image_path'])) {
                    unlink(__DIR__ . '/../' . $row['image_path']);
                }
            }
            $query = "DELETE FROM photo_gallery_images WHERE gallery_id = $gallery_id";
            if (mysqli_query($conn, $query)) {
                logActivity($conn, 'Gallery', 'DELETE', "Deleted all images from gallery ID $gallery_id");
                echo json_encode(['success' => true, 'message' => 'All images deleted successfully.']);
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
