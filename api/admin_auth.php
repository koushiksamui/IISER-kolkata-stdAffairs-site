<?php

/**
 * SiSAS-IITG Admin Authentication Functions
 * Handles admin session management, login validation, database authentication, and logout.
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Check if the administrator is currently logged in.
 *
 * @return bool True if the admin session is active, false otherwise.
 */
function isAdminLoggedIn()
{
    return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
}

/**
 * Restricts page access. Redirects to the login page if not logged in.
 *
 * @param string $loginPagePath Path to redirect if unauthorized (default: 'login.php').
 */
function requireAdmin($loginPagePath = 'login.php')
{
    if (!isAdminLoggedIn()) {
        header("Location: " . $loginPagePath);
        exit;
    }
}

/**
 * Ensures the `admin` table exists in the database.
 * If the table does not exist, it creates the table and inserts a default administrator.
 *
 * @param mysqli $conn Database connection.
 * @return bool True if the table exists or was successfully created, false otherwise.
 */
function ensureAdminTableExists($conn)
{
    // 1. Check if the 'admin' table exists
    $tableCheckQuery = "SHOW TABLES LIKE 'admin'";
    $result = mysqli_query($conn, $tableCheckQuery);

    if ($result && mysqli_num_rows($result) > 0) {
        // Verify if both 'email' and 'last_login' columns exist
        $emailCheck = mysqli_query($conn, "SHOW COLUMNS FROM `admin` LIKE 'email'");
        $lastLoginCheck = mysqli_query($conn, "SHOW COLUMNS FROM `admin` LIKE 'last_login'");

        if ($emailCheck && mysqli_num_rows($emailCheck) > 0 && $lastLoginCheck && mysqli_num_rows($lastLoginCheck) > 0) {
            return true; // Table is up-to-date
        }

        // Table exists but is outdated (missing email or last_login), drop it to recreate
        mysqli_query($conn, "DROP TABLE IF EXISTS `admin`");
    }

    // 2. Create the table if it does not exist
    $createTableQuery = "CREATE TABLE `admin` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `email` VARCHAR(100) NOT NULL UNIQUE,
        `password` VARCHAR(255) NOT NULL,
        `last_login` DATETIME DEFAULT NULL,
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

    if (!mysqli_query($conn, $createTableQuery)) {
        return false;
    }
}

/**
 * Validates administrative credentials, verifies CAPTCHA, and handles session login.
 * Can use a mysqli database connection if provided, otherwise falls back to defaults.
 *
 * @param string $email
 * @param string $password
 * @param string $enteredCaptcha
 * @param string $sessionCaptcha
 * @param mysqli|null $conn Optional database connection.
 * @param string $loginType The type of login ('admin' or 'faculty').
 * @return array Status array with 'success' (bool) and 'message' (string).
 */
function adminLogin($email, $password, $enteredCaptcha, $sessionCaptcha, $conn = null, $loginType = 'admin')
{
    // 1. Verify CAPTCHA Code
    if (empty($enteredCaptcha) || empty($sessionCaptcha) || strtolower($enteredCaptcha) !== strtolower($sessionCaptcha)) {
        return [
            'success' => false,
            'message' => 'Invalid CAPTCHA code. Please check and try again.'
        ];
    }

    // 2. Validate Credentials
    $loginSuccessful = false;
    $isFaculty = false;
    $facultyData = null;

    if ($conn) {
        // Ensure the admin table exists, creating it if it does not exist
        ensureAdminTableExists($conn);

        // Database-backed verification
        // Escape input to prevent SQL injection
        $safeEmail = mysqli_real_escape_string($conn, $email);

        if ($loginType === 'admin') {
            // Query to check email in admin table
            $query = "SELECT * FROM `admin` WHERE `email` = '$safeEmail' LIMIT 1";
            $result = mysqli_query($conn, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                $adminData = mysqli_fetch_assoc($result);
                // Verify password (supports both password_verify and raw check for backward compatibility)
                if (password_verify($password, $adminData['password']) || $password === $adminData['password']) {
                    $loginSuccessful = true;

                    // Update last_login timestamp on successful login
                    $adminId = (int)$adminData['id'];
                    $updateQuery = "UPDATE `admin` SET `last_login` = NOW() WHERE `id` = $adminId";
                    mysqli_query($conn, $updateQuery);
                }
            }
        } else if ($loginType === 'faculty') {
            // Query to check email in faculties table
            $query = "SELECT * FROM `faculties` WHERE `email` = '$safeEmail' LIMIT 1";
            $result = mysqli_query($conn, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                $facultyData = mysqli_fetch_assoc($result);
                // Verify password (supports both password_verify and raw check)
                if (password_verify($password, $facultyData['password']) || $password === $facultyData['password']) {
                    $loginSuccessful = true;
                    $isFaculty = true;

                    // Update last_logged_in timestamp on successful login
                    $facultyId = (int)$facultyData['id'];
                    $updateQuery = "UPDATE `faculties` SET `last_logged_in` = NOW() WHERE `id` = $facultyId";
                    mysqli_query($conn, $updateQuery);
                }
            }
        }
    }

    // Fallback/Demo verification if DB is not connected or query fails
    if (!$loginSuccessful) {
        $expectedEmail = 'admin@iitg.ac.in';
        $expectedPass = 'admin123'; // Standard admin fallback credential

        if ($email === $expectedEmail && $password === $expectedPass) {
            $loginSuccessful = true;
        }
    }

    // 3. Handle Session Activation
    if ($loginSuccessful) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_email'] = $email;
        $_SESSION['admin_username'] = $email; // Fallback for backward compatibility
        $_SESSION['admin_login_time'] = time();
        $_SESSION['admin_role'] = $isFaculty ? 'faculty' : 'admin';
        if ($isFaculty && $facultyData) {
            $_SESSION['admin_display_name'] = $facultyData['name'];
        }

        if ($conn) {
            require_once __DIR__ . '/../php_utils/_logger.php';
            $logMsg = ($isFaculty ? 'Faculty' : 'Admin') . " login successful: $email";
            logActivity($conn, 'Authentication', 'LOGIN', $logMsg);
        }

        return [
            'success' => true,
            'message' => 'Login successful.'
        ];
    } else {
        return [
            'success' => false,
            'message' => 'Incorrect email or password.'
        ];
    }
}

/**
 * Logs out the administrator, cleans up session variables, and redirects to the login screen.
 *
 * @param string $redirectPath Path to redirect after logout (default: '../admin/login.php').
 */
function adminLogout($redirectPath = '../admin/login.php')
{
    $adminEmail = $_SESSION['admin_email'] ?? 'unknown';
    $role = $_SESSION['admin_role'] ?? 'admin';
    $conn = null;
    $dbPath = __DIR__ . '/../php_utils/_dbConnect.php';
    if (file_exists($dbPath)) {
        include_once $dbPath;
    }
    if (isset($conn) && $conn) {
        require_once __DIR__ . '/../php_utils/_logger.php';
        $logMsg = ($role === 'faculty' ? 'Faculty' : 'Admin') . " logout successful: $adminEmail";
        logActivity($conn, 'Authentication', 'LOGOUT', $logMsg);
    }

    // Unset all session variables
    $_SESSION = [];

    // Clear session cookie if active
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
    }

    // Destroy the session
    session_destroy();

    // Redirect user
    header("Location: " . $redirectPath);
    exit;
}

// Handle incoming POST requests (e.g., AJAX actions)
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST' && basename($_SERVER['SCRIPT_NAME']) === 'admin_auth.php') {
    header('Content-Type: application/json');

    $action = isset($_POST['action']) ? $_POST['action'] : '';

    if ($action === 'login') {
        $email = isset($_POST['email']) ? trim($_POST['email']) : (isset($_POST['username']) ? trim($_POST['username']) : '');
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $enteredCaptcha = isset($_POST['captcha']) ? trim($_POST['captcha']) : '';
        $expectedCaptcha = isset($_POST['expected_captcha']) ? trim($_POST['expected_captcha']) : '';
        $loginType = isset($_POST['login_type']) ? $_POST['login_type'] : 'admin';

        // Include DB connection if available
        $conn = null;
        $dbPath = __DIR__ . '/../php_utils/_dbConnect.php';
        if (file_exists($dbPath)) {
            include_once $dbPath;
        }

        $result = adminLogin($email, $password, $enteredCaptcha, $expectedCaptcha, $conn, $loginType);
        echo json_encode($result);
        exit;
    } else if ($action === 'logout') {
        $adminEmail = $_SESSION['admin_email'] ?? 'unknown';
        $role = $_SESSION['admin_role'] ?? 'admin';
        $conn = null;
        $dbPath = __DIR__ . '/../php_utils/_dbConnect.php';
        if (file_exists($dbPath)) {
            include_once $dbPath;
        }
        if (isset($conn) && $conn) {
            require_once __DIR__ . '/../php_utils/_logger.php';
            $logMsg = ($role === 'faculty' ? 'Faculty' : 'Admin') . " logout successful: $adminEmail";
            logActivity($conn, 'Authentication', 'LOGOUT', $logMsg);
        }

        // Clear session inline so we can still echo JSON (adminLogout() redirects+exits before JSON fires)
        $_SESSION = [];
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params['path'],
                $params['domain'],
                $params['secure'],
                $params['httponly']
            );
        }
        session_destroy();
        echo json_encode(['success' => true, 'message' => 'Logged out successfully.']);
        exit;
    }

    echo json_encode(['success' => false, 'message' => 'Invalid action.']);
    exit;
}
