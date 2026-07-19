<?php

/**
 * SiSAS-IITG Admin API — Settings
 */

require_once 'admin_auth.php';
requireAdmin('../admin/login.html');
require_once __DIR__ . '/../php_utils/_dbConnect.php';
require_once __DIR__ . '/../php_utils/_logger.php';

header('Content-Type: application/json');

$action = '';
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $action = isset($_GET['action']) ? trim($_GET['action']) : '';
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = isset($_POST['action']) ? trim($_POST['action']) : '';
}

switch ($action) {
    case 'change_password':
        $current_password = $_POST['current_password'] ?? '';
        $new_password = $_POST['new_password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';

        if (empty($current_password) || empty($new_password) || empty($confirm_password)) {
            echo json_encode(['success' => false, 'message' => 'All fields are required.']);
            exit;
        }

        if ($new_password !== $confirm_password) {
            echo json_encode(['success' => false, 'message' => 'New passwords do not match.']);
            exit;
        }

        if (strlen($new_password) < 8) {
            echo json_encode(['success' => false, 'message' => 'New password must be at least 8 characters long.']);
            exit;
        }

        $email = $_SESSION['admin_email'];
        $safeEmail = mysqli_real_escape_string($conn, $email);

        $query = "SELECT * FROM `admin` WHERE `email` = '$safeEmail' LIMIT 1";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $adminData = mysqli_fetch_assoc($result);
            // Verify current password
            if (password_verify($current_password, $adminData['password']) || $current_password === $adminData['password']) {
                // Password is correct, update it
                $new_hash = password_hash($new_password, PASSWORD_DEFAULT);
                $updateQuery = "UPDATE `admin` SET `password` = '$new_hash' WHERE `id` = " . $adminData['id'];
                if (mysqli_query($conn, $updateQuery)) {
                    logActivity($conn, 'Admin settings', 'UPDATE', "Changed admin password for $email");
                    echo json_encode(['success' => true, 'message' => 'Password updated successfully.']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Failed to update password. Database error.']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Incorrect current password.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Admin account not found in database. Cannot change default fallback password.']);
        }
        break;

    default:
        echo json_encode(['success' => false, 'message' => 'Invalid action.']);
        break;
}
