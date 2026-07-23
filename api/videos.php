<?php

/**
 * SiSAS-IITG Admin API — Videos Management
 */

require_once 'admin_auth.php';
require_once __DIR__ . '/../php_utils/_dbConnect.php';
require_once __DIR__ . '/../php_utils/_logger.php';

header('Content-Type: application/json');

// Ensure the videos table exists
$createVideosTable = "CREATE TABLE IF NOT EXISTS videos (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    video_type ENUM('upload', 'youtube') NOT NULL DEFAULT 'youtube',
    video_url VARCHAR(255) NOT NULL,
    caption VARCHAR(255) DEFAULT NULL,
    display_order INT(11) DEFAULT 0,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
)";
mysqli_query($conn, $createVideosTable);

$action = $_POST['action'] ?? $_GET['action'] ?? '';

// Require Admin authorization for management operations
if (in_array($action, ['save_video', 'delete_video', 'reorder_videos'])) {
    requireAdmin('../admin/login.php');
}

switch ($action) {
    case 'get_videos':
        $query = "SELECT * FROM videos ORDER BY display_order ASC, created_at DESC";
        $res = mysqli_query($conn, $query);
        $data = [];
        if ($res) {
            while ($row = mysqli_fetch_assoc($res)) {
                $data[] = $row;
            }
        }
        echo json_encode(['success' => true, 'data' => $data]);
        break;

    case 'save_video':
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        $video_type = isset($_POST['video_type']) ? mysqli_real_escape_string($conn, $_POST['video_type']) : 'youtube';
        $caption = isset($_POST['caption']) ? mysqli_real_escape_string($conn, trim($_POST['caption'])) : '';
        $video_url = '';

        if ($video_type === 'youtube') {
            $video_url = isset($_POST['youtube_url']) ? mysqli_real_escape_string($conn, trim($_POST['youtube_url'])) : '';
            if (empty($video_url)) {
                echo json_encode(['success' => false, 'message' => 'YouTube URL is required.']);
                exit;
            }
            // Basic validation for URL
            if (!filter_var($video_url, FILTER_VALIDATE_URL)) {
                echo json_encode(['success' => false, 'message' => 'Invalid YouTube URL format.']);
                exit;
            }
        } else {
            // It's an MP4 upload
            // Only require a new upload if we are creating, OR if we are updating and a file was chosen
            if ($id == 0 || (!empty($_FILES['video_file']['name']))) {
                if (!isset($_FILES['video_file']) || $_FILES['video_file']['error'] !== UPLOAD_ERR_OK) {
                    echo json_encode(['success' => false, 'message' => 'Please upload a valid MP4/WebM video file.']);
                    exit;
                }

                $ext = strtolower(pathinfo($_FILES['video_file']['name'], PATHINFO_EXTENSION));
                if ($ext !== 'mp4' && $ext !== 'webm') {
                    echo json_encode(['success' => false, 'message' => 'Only MP4 and WebM videos are allowed.']);
                    exit;
                }

                // Check size (e.g. max 50MB)
                if ($_FILES['video_file']['size'] > 50 * 1024 * 1024) {
                    echo json_encode(['success' => false, 'message' => 'Video size must be less than 50MB.']);
                    exit;
                }

                $uploadDir = __DIR__ . '/../dist/vid/';
                if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

                $newName = 'video_' . time() . '_' . uniqid() . '.' . $ext;
                if (move_uploaded_file($_FILES['video_file']['tmp_name'], $uploadDir . $newName)) {
                    $video_url = 'dist/vid/' . $newName; // Relative path from root
                } else {
                    echo json_encode(['success' => false, 'message' => 'Failed to move uploaded video file.']);
                    exit;
                }
            } else {
                // We are updating, but no new file was uploaded. Keep existing video URL.
                $q = mysqli_query($conn, "SELECT video_url FROM videos WHERE id = $id");
                if ($r = mysqli_fetch_assoc($q)) {
                    $video_url = mysqli_real_escape_string($conn, $r['video_url']);
                }
            }
        }

        if ($id > 0) {
            // Update
            // If they switched types or uploaded a new file, we should ideally delete the old MP4 if there was one.
            $oldQ = mysqli_query($conn, "SELECT video_url, video_type FROM videos WHERE id = $id");
            if ($oldRow = mysqli_fetch_assoc($oldQ)) {
                $oldUrl = $oldRow['video_url'];
                $oldType = $oldRow['video_type'];
                if ($oldType === 'upload' && $oldUrl && $oldUrl !== stripslashes($video_url)) {
                    $oldPath = __DIR__ . '/../' . $oldUrl;
                    if (file_exists($oldPath)) unlink($oldPath);
                }
            }

            $query = "UPDATE videos SET video_type='$video_type', video_url='$video_url', caption='$caption' WHERE id=$id";
            if (mysqli_query($conn, $query)) {
                logActivity($conn, 'Videos', 'UPDATE', "Updated video ID $id: $caption");
                echo json_encode(['success' => true, 'message' => 'Video updated successfully.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Database update failed.']);
            }
        } else {
            // Insert
            $orderQ = mysqli_query($conn, "SELECT MAX(display_order) as max_o FROM videos");
            $maxO = 0;
            if ($orderR = mysqli_fetch_assoc($orderQ)) {
                $maxO = intval($orderR['max_o']);
            }
            $maxO++;
            $query = "INSERT INTO videos (video_type, video_url, caption, display_order) VALUES ('$video_type', '$video_url', '$caption', $maxO)";
            if (mysqli_query($conn, $query)) {
                logActivity($conn, 'Videos', 'CREATE', "Added new video: $caption");
                echo json_encode(['success' => true, 'message' => 'Video added successfully.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Database insert failed.']);
            }
        }
        break;

    case 'delete_video':
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        if ($id > 0) {
            $q = mysqli_query($conn, "SELECT video_url, video_type FROM videos WHERE id = $id");
            if ($row = mysqli_fetch_assoc($q)) {
                if ($row['video_type'] === 'upload' && $row['video_url']) {
                    $path = __DIR__ . '/../' . $row['video_url'];
                    if (file_exists($path)) {
                        unlink($path);
                    }
                }
            }

            if (mysqli_query($conn, "DELETE FROM videos WHERE id = $id")) {
                logActivity($conn, 'Videos', 'DELETE', "Deleted video ID $id");
                echo json_encode(['success' => true, 'message' => 'Video deleted successfully.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to delete video record.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid ID.']);
        }
        break;

    case 'update_order':
        $orderData = isset($_POST['order']) ? json_decode($_POST['order'], true) : [];
        if (is_array($orderData) && count($orderData) > 0) {
            $success = true;
            foreach ($orderData as $item) {
                $id = intval($item['id']);
                $order = intval($item['order']);
                if (!mysqli_query($conn, "UPDATE videos SET display_order = $order WHERE id = $id")) {
                    $success = false;
                }
            }
            if ($success) {
                logActivity($conn, 'Videos', 'UPDATE', 'Reordered videos');
                echo json_encode(['success' => true, 'message' => 'Order updated successfully.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to update order for some items.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'No order data provided.']);
        }
        break;

    default:
        echo json_encode(['success' => false, 'message' => 'Invalid action.']);
        break;
}
