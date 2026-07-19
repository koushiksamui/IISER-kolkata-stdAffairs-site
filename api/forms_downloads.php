<?php
require_once '../php_utils/_dbConnect.php';
/** @var mysqli $conn */
header('Content-Type: application/json');

if (!isset($_REQUEST['action'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid action.']);
    exit;
}

$action = $_REQUEST['action'];

if ($action === 'get_forms') {
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 10;
    $search = isset($_GET['search']) ? mysqli_real_escape_string($conn, trim($_GET['search'])) : '';
    $type = isset($_GET['type']) ? mysqli_real_escape_string($conn, trim($_GET['type'])) : '';
    
    $offset = ($page - 1) * $limit;
    
    $whereClause = "1=1";
    if ($search !== '') {
        $whereClause .= " AND (title LIKE '%$search%')";
    }
    if ($type !== '') {
        $whereClause .= " AND display_type = '$type'";
    }

    $countQuery = "SELECT COUNT(*) as total FROM forms_downloads WHERE $whereClause";
    $countRes = mysqli_query($conn, $countQuery);
    $total = 0;
    if ($countRes) {
        $row = mysqli_fetch_assoc($countRes);
        $total = intval($row['total']);
    }

    $query = "SELECT id, title, files, visible_from, visible_upto, display_type FROM forms_downloads WHERE $whereClause ORDER BY id DESC LIMIT $limit OFFSET $offset";
    $res = mysqli_query($conn, $query);

    $data = [];
    if ($res) {
        while ($row = mysqli_fetch_assoc($res)) {
            $row['files'] = json_decode($row['files'], true) ?: [];
            $data[] = $row;
        }
    }

    echo json_encode(['success' => true, 'data' => $data, 'total' => $total]);
    exit;
}

if ($action === 'save_form') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $title = isset($_POST['title']) ? mysqli_real_escape_string($conn, trim($_POST['title'])) : '';
    $visible_from = isset($_POST['visible_from']) ? mysqli_real_escape_string($conn, trim($_POST['visible_from'])) : '';
    $visible_upto = isset($_POST['visible_upto']) && !empty($_POST['visible_upto']) ? "'" . mysqli_real_escape_string($conn, trim($_POST['visible_upto'])) . "'" : 'NULL';
    $display_type = isset($_POST['display_type']) ? mysqli_real_escape_string($conn, trim($_POST['display_type'])) : 'Public';
    
    $existingFiles = isset($_POST['existing_files']) ? json_decode($_POST['existing_files'], true) : [];
    if (!is_array($existingFiles)) {
        $existingFiles = [];
    }

    if (empty($title) || empty($visible_from)) {
        echo json_encode(['success' => false, 'message' => 'Title and Visible From date are required.']);
        exit;
    }

    // Handle File Uploads
    $uploadDir = '../uploads/forms/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    
    $uploadedFiles = [];
    if (isset($_FILES['new_files'])) {
        $files = $_FILES['new_files'];
        for ($i = 0; $i < count($files['name']); $i++) {
            if ($files['error'][$i] === UPLOAD_ERR_OK) {
                $tmpName = $files['tmp_name'][$i];
                $name = basename($files['name'][$i]);
                $extension = strtolower(pathinfo($name, PATHINFO_EXTENSION));
                // Basic check, allow popular document types
                $allowed = ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'txt', 'zip', 'rar'];
                if (in_array($extension, $allowed)) {
                    $uniqueName = uniqid() . '_' . preg_replace("/[^a-zA-Z0-9.-]/", "_", $name);
                    $destPath = $uploadDir . $uniqueName;
                    if (move_uploaded_file($tmpName, $destPath)) {
                        $uploadedFiles[] = [
                            'name' => $name,
                            'path' => 'uploads/forms/' . $uniqueName
                        ];
                    }
                }
            }
        }
    }

    $allFiles = array_merge($existingFiles, $uploadedFiles);
    $filesJson = mysqli_real_escape_string($conn, json_encode($allFiles));

    if ($id > 0) {
        $query = "UPDATE forms_downloads SET 
            title = '$title',
            visible_from = '$visible_from',
            visible_upto = $visible_upto,
            display_type = '$display_type',
            files = '$filesJson'
            WHERE id = $id";
        $message = 'Form updated successfully.';
    } else {
        $query = "INSERT INTO forms_downloads (title, visible_from, visible_upto, display_type, files) 
                  VALUES ('$title', '$visible_from', $visible_upto, '$display_type', '$filesJson')";
        $message = 'Form added successfully.';
    }

    if (mysqli_query($conn, $query)) {
        echo json_encode(['success' => true, 'message' => $message]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . mysqli_error($conn)]);
    }
    exit;
}

if ($action === 'delete_form') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    
    // fetch files to delete from disk
    $q = "SELECT files FROM forms_downloads WHERE id = $id";
    $res = mysqli_query($conn, $q);
    if ($row = mysqli_fetch_assoc($res)) {
        $files = json_decode($row['files'], true) ?: [];
        foreach ($files as $file) {
            $filePath = '../' . $file['path'];
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
    }

    $query = "DELETE FROM forms_downloads WHERE id = $id";
    if (mysqli_query($conn, $query)) {
        echo json_encode(['success' => true, 'message' => 'Form deleted successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . mysqli_error($conn)]);
    }
    exit;
}

echo json_encode(['success' => false, 'message' => 'Invalid action.']);
?>
