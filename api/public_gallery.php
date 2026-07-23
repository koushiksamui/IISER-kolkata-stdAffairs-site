<?php
/**
 * Public API for fetching Galleries and Videos
 */
require_once __DIR__ . '/../php_utils/_dbConnect.php';

header('Content-Type: application/json');

$action = isset($_GET['action']) ? trim($_GET['action']) : '';

if ($action === 'get_photos') {
    $query = "
        SELECT g.id, g.title, g.created_at,
               (SELECT COUNT(*) FROM photo_gallery_images i WHERE i.gallery_id = g.id) as image_count
        FROM photo_galleries g
        ORDER BY g.created_at DESC
    ";
    $result = mysqli_query($conn, $query);
    $galleries = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $galId = intval($row['id']);
            // Limit card preview slideshow images to 4 for ultra-fast initial payload
            $imgQ = mysqli_query($conn, "SELECT image_path FROM photo_gallery_images WHERE gallery_id = $galId ORDER BY display_order ASC, id ASC LIMIT 4");
            $images = [];
            if ($imgQ) {
                while ($imgRow = mysqli_fetch_assoc($imgQ)) {
                    $path = $imgRow['image_path'];
                    $images[] = preg_match('/^https?:\/\//', $path) ? $path : '../' . $path;
                }
            }
            $row['images'] = $images;
            $row['cover_image'] = !empty($images) ? $images[0] : null;
            $galleries[] = $row;
        }
    }
    echo json_encode(['success' => true, 'galleries' => $galleries]);
    exit;
} elseif ($action === 'get_gallery_images') {
    $gallery_id = isset($_GET['gallery_id']) ? intval($_GET['gallery_id']) : 0;
    
    $gRes = mysqli_query($conn, "SELECT id, title, created_at FROM photo_galleries WHERE id = $gallery_id");
    $gallery = $gRes ? mysqli_fetch_assoc($gRes) : null;
    
    $query = "SELECT id, image_path, display_order FROM photo_gallery_images WHERE gallery_id = $gallery_id ORDER BY display_order ASC, id ASC";
    $result = mysqli_query($conn, $query);
    $images = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $path = $row['image_path'];
            $row['image_path'] = preg_match('/^https?:\/\//', $path) ? $path : '../' . $path;
            $images[] = $row;
        }
    }
    echo json_encode(['success' => true, 'gallery' => $gallery, 'images' => $images]);
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
