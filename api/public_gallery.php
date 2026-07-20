<?php
/**
 * Public API for fetching Galleries and Videos
 */
require_once __DIR__ . '/../php_utils/_dbConnect.php';

header('Content-Type: application/json');

$action = isset($_GET['action']) ? trim($_GET['action']) : '';

if ($action === 'get_photos') {
    // Fetch all galleries and their first image as a thumbnail
    $query = "
        SELECT g.id, g.title, 
               (SELECT image_path FROM photo_gallery_images i WHERE i.gallery_id = g.id ORDER BY display_order ASC, id ASC LIMIT 1) as cover_image,
               (SELECT COUNT(*) FROM photo_gallery_images i WHERE i.gallery_id = g.id) as image_count
        FROM photo_galleries g
        ORDER BY g.created_at DESC
    ";
    $result = mysqli_query($conn, $query);
    $galleries = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $galleries[] = $row;
        }
    }
    echo json_encode(['success' => true, 'galleries' => $galleries]);
    exit;
} elseif ($action === 'get_all_images') {
    $query = "
        SELECT i.id, i.image_path, g.title as gallery_title 
        FROM photo_gallery_images i 
        JOIN photo_galleries g ON i.gallery_id = g.id 
        ORDER BY i.created_at DESC
    ";
    $result = mysqli_query($conn, $query);
    $images = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $images[] = $row;
        }
    }
    echo json_encode(['success' => true, 'images' => $images]);
    exit;
} elseif ($action === 'get_videos') {
    $query = "SELECT * FROM videos ORDER BY display_order ASC, created_at DESC";
    $result = mysqli_query($conn, $query);
    $videos = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $videos[] = $row;
        }
    }
    echo json_encode(['success' => true, 'videos' => $videos]);
    exit;
}

echo json_encode(['success' => false, 'message' => 'Invalid action']);
exit;
