<?php

/**
 * System Logger
 */

// Ensure the `activity_logs` table exists
function initializeLogger($conn)
{
    $createTableQuery = "CREATE TABLE IF NOT EXISTS activity_logs (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        admin_email VARCHAR(255) NOT NULL,
        module VARCHAR(100) NOT NULL,
        action_type VARCHAR(50) NOT NULL,
        details TEXT DEFAULT NULL,
        ip_address VARCHAR(45) DEFAULT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )";
    mysqli_query($conn, $createTableQuery);
}

/**
 * Log an action to the database.
 *
 * @param mysqli $conn Database connection
 * @param string $module The module/page (e.g., 'Notices', 'Faculty')
 * @param string $actionType The type of action ('CREATE', 'UPDATE', 'DELETE', etc)
 * @param string $details Specific details of the action
 */
function logActivity($conn, $module, $actionType, $details)
{
    // Only initialize once per request, or we could just rely on this check once
    static $initialized = false;
    if (!$initialized) {
        initializeLogger($conn);
        $initialized = true;
    }

    $adminEmail = 'system';
    if (session_status() === PHP_SESSION_NONE && php_sapi_name() !== 'cli') {
        session_start();
    }
    if (isset($_SESSION['admin_email'])) {
        $adminEmail = $_SESSION['admin_email'];
    }

    $ipAddress = $_SERVER['REMOTE_ADDR'] ?? 'UNKNOWN';

    $stmt = mysqli_prepare($conn, "INSERT INTO activity_logs (admin_email, module, action_type, details, ip_address) VALUES (?, ?, ?, ?, ?)");
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssss", $adminEmail, $module, $actionType, $details, $ipAddress);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
}
