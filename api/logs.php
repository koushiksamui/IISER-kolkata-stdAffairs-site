<?php

/**
 * SiSAS-IITG Admin API — Activity Logs
 */

require_once 'admin_auth.php';
requireAdmin('../admin/login.php');
require_once __DIR__ . '/../php_utils/_dbConnect.php';

header('Content-Type: application/json');

$action = '';
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $action = isset($_GET['action']) ? trim($_GET['action']) : '';
}

switch ($action) {
    case 'get_logs':
        $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
        $limit = isset($_GET['limit']) ? max(1, intval($_GET['limit'])) : 25;
        $search = isset($_GET['search']) ? mysqli_real_escape_string($conn, trim($_GET['search'])) : '';

        $whereClause = "1=1";
        if ($search !== '') {
            $whereClause .= " AND (admin_email LIKE '%$search%' OR module LIKE '%$search%' OR action_type LIKE '%$search%' OR details LIKE '%$search%')";
        }

        $countQuery = "SELECT COUNT(*) as total FROM activity_logs WHERE $whereClause";
        $countResult = mysqli_query($conn, $countQuery);

        if (!$countResult) {
            // Table might not exist yet if no activity has been logged
            echo json_encode(['success' => true, 'data' => [], 'total' => 0, 'page' => 1, 'limit' => $limit]);
            exit;
        }

        $totalRow = mysqli_fetch_assoc($countResult);
        $total = intval($totalRow['total']);

        $offset = ($page - 1) * $limit;

        $query = "SELECT * FROM activity_logs WHERE $whereClause ORDER BY created_at DESC, id DESC LIMIT $limit OFFSET $offset";
        $result = mysqli_query($conn, $query);

        $logs = [];
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $logs[] = $row;
            }
        }
        echo json_encode([
            'success' => true,
            'data' => $logs,
            'total' => $total,
            'page' => $page,
            'limit' => $limit
        ]);
        break;

    default:
        echo json_encode(['success' => false, 'message' => 'Invalid API action.']);
        break;
}
