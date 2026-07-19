<?php

/**
 * SiSAS-IITG Admin — Settings
 */

require_once '../api/admin_auth.php';
requireAdmin('login.html');

$adminEmail   = isset($_SESSION['admin_email']) ? $_SESSION['admin_email'] : 'admin@iitg.ac.in';
$adminDisplay = ucfirst(explode('@', $adminEmail)[0]);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings &mdash; SiSAS-IITG Admin</title>
    <meta name="description" content="Admin portal settings and password management.">
    <meta name="robots" content="noindex, nofollow">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;600;700&family=Outfit:wght@400;500;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Shared Admin Stylesheet -->
    <link rel="stylesheet" href="../dist/css/admin/dashboard.css">
    
    <style>
        /* Page Header */
        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 14px;
            margin-bottom: 28px;
        }
        .page-header-left h1 {
            font-family: var(--font-heading, 'Outfit', sans-serif);
            font-size: 1.65rem;
            font-weight: 800;
            color: var(--primary-forest, #2d3748);
            line-height: 1.15;
            margin: 0;
        }
        .page-header-left p {
            font-size: 0.92rem;
            color: var(--text-muted, #718096);
            margin: 4px 0 0 0;
        }

        /* Settings Card */
        .settings-card {
            background: #fff;
            border-radius: 16px;
            padding: 40px;
            max-width: 480px;
            margin: 40px auto;
            box-shadow: 0 10px 40px rgba(0,0,0,0.04);
            border: 1px solid rgba(0,0,0,0.05);
        }
        .settings-card-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .settings-card-header .icon-circle {
            width: 64px;
            height: 64px;
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(59, 130, 246, 0.2));
            color: #3b82f6;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin: 0 auto 16px auto;
        }
        .settings-card-header h3 {
            margin: 0;
            font-size: 1.4rem;
            color: var(--text-dark);
            font-weight: 700;
        }
        .settings-card-header p {
            margin: 8px 0 0 0;
            color: var(--text-muted);
            font-size: 0.95rem;
        }
        .form-group {
            margin-bottom: 24px;
        }
        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #4b5563;
            font-size: 0.9rem;
        }
        .input-group {
            position: relative;
        }
        .input-group > i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
        }
        .form-control {
            width: 100%;
            padding: 14px 16px 14px 44px;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            font-size: 1rem;
            font-family: inherit;
            box-sizing: border-box;
            background: #f9fafb;
            transition: all 0.2s ease;
        }
        .form-control.has-toggle {
            padding-right: 46px;
        }
        .input-group .toggle-password {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            cursor: pointer;
            border: none;
            background: transparent;
            padding: 0;
            font-size: 1.1rem;
            transition: color 0.2s;
            outline: none;
        }
        .input-group .toggle-password:hover {
            color: #4b5563;
        }
        .password-hint {
            display: block;
            margin-top: 8px;
            font-size: 0.85rem;
            color: #6b7280;
            line-height: 1.4;
        }
        .form-control:focus {
            outline: none;
            border-color: #3b82f6;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        }
        .form-control:focus + i, .input-group:focus-within i {
            color: #3b82f6;
        }
        .btn-submit {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: white;
            border: none;
            padding: 14px 24px;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
        }
        .btn-submit:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(59, 130, 246, 0.3);
        }
        .btn-submit:active {
            transform: translateY(0);
        }
        .btn-submit:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }
        /* Toast Notifications */
        .toast-container {
            position: fixed;
            bottom: 24px;
            right: 24px;
            z-index: 99999;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .toast-notification {
            display: flex;
            align-items: center;
            background: var(--white);
            color: var(--text-dark);
            padding: 16px 20px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            min-width: 300px;
            max-width: 400px;
            transform: translateX(120%);
            opacity: 0;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            border-left: 4px solid transparent;
        }

        .toast-notification.show {
            transform: translateX(0);
            opacity: 1;
        }

        .toast-success { border-left-color: var(--accent-emerald); }
        .toast-error { border-left-color: var(--status-red); }
        .toast-info { border-left-color: var(--accent-blue); }

        .toast-icon {
            font-size: 1.4rem;
            margin-right: 14px;
        }
        .toast-success .toast-icon { color: var(--accent-emerald); }
        .toast-error .toast-icon { color: var(--status-red); }
        .toast-info .toast-icon { color: var(--accent-blue); }

        .toast-message {
            flex: 1;
            font-size: 0.95rem;
            font-weight: 500;
            line-height: 1.4;
        }

        .toast-close {
            background: none;
            border: none;
            color: var(--text-muted);
            cursor: pointer;
            font-size: 1rem;
            padding: 4px;
            margin-left: 10px;
            transition: color 0.2s;
        }

        .toast-close:hover { color: var(--text-dark); }
    </style>
</head>

<body>

    <div class="admin-layout" id="adminLayout">

        <div class="sidebar-overlay" id="sidebarOverlay"></div>

        <!-- ====== LEFT SIDEBAR ====== -->
        <?php include_once 'components/sidebar.php'; ?>

        <!-- ====== MAIN PANEL ====== -->
        <div class="main-panel">

            <!-- TOP HEADER -->
            <?php include_once 'components/header.php'; ?>

            <!-- ====== CONTENT AREA ====== -->
            <main class="admin-content" id="settingsMain">

                <!-- Page Header -->
                <div class="page-header">
                    <div class="page-header-left">
                        <h1><i class="fa-solid fa-gear" style="color:#3b82f6;margin-right:10px;font-size:1.5rem;"></i>Settings</h1>
                        <p>Manage your administrator account settings.</p>
                    </div>
                </div>

                <div class="settings-card">
                    <div class="settings-card-header">
                        <div class="icon-circle">
                            <i class="fa-solid fa-shield-halved"></i>
                        </div>
                        <h3>Change Password</h3>
                        <p>Keep your administrator account secure</p>
                    </div>
                    <form id="passwordChangeForm">
                        <input type="hidden" name="action" value="change_password">
                        <div class="form-group">
                            <label class="form-label" for="current_password">Current Password</label>
                            <div class="input-group">
                                <i class="fa-solid fa-lock"></i>
                                <input type="password" name="current_password" id="current_password" class="form-control has-toggle" required placeholder="Enter current password">
                                <button type="button" class="toggle-password" tabindex="-1"><i class="fa-regular fa-eye"></i></button>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="new_password">New Password</label>
                            <div class="input-group">
                                <i class="fa-solid fa-key"></i>
                                <input type="password" name="new_password" id="new_password" class="form-control has-toggle" required placeholder="Min. 8 characters">
                                <button type="button" class="toggle-password" tabindex="-1"><i class="fa-regular fa-eye"></i></button>
                            </div>
                            <span class="password-hint"><i class="fa-solid fa-circle-info" style="margin-right: 4px;"></i>Hint: For a stronger password, use at least 8 characters, and mix uppercase, lowercase, numbers, and symbols.</span>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="confirm_password">Confirm New Password</label>
                            <div class="input-group">
                                <i class="fa-solid fa-check-double"></i>
                                <input type="password" name="confirm_password" id="confirm_password" class="form-control has-toggle" required placeholder="Re-enter new password">
                                <button type="button" class="toggle-password" tabindex="-1"><i class="fa-regular fa-eye"></i></button>
                            </div>
                        </div>
                        <button type="submit" class="btn-submit" id="submitBtn">
                            Update Password
                        </button>
                    </form>
                </div>

            </main>
        </div>
    </div>

    <!-- Toast Notifications -->
    <div id="toastContainer" class="toast-container"></div>

    <script>
        $(document).ready(function() {
            // Toggle Password Visibility
            $('.toggle-password').on('click', function() {
                const input = $(this).siblings('input');
                const icon = $(this).find('i');
                if (input.attr('type') === 'password') {
                    input.attr('type', 'text');
                    icon.removeClass('fa-eye').addClass('fa-eye-slash');
                } else {
                    input.attr('type', 'password');
                    icon.removeClass('fa-eye-slash').addClass('fa-eye');
                }
            });

            $('#passwordChangeForm').submit(function(e) {
                e.preventDefault();

                const newPass = $('#new_password').val();
                const confirmPass = $('#confirm_password').val();

                if (newPass.length < 8) {
                    showToast('error', 'New password must be at least 8 characters long.');
                    return;
                }

                if (newPass !== confirmPass) {
                    showToast('error', 'New passwords do not match.');
                    return;
                }

                const fd = new FormData(this);
                const $btn = $('#submitBtn');
                const origHtml = $btn.html();
                
                $btn.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin"></i> Updating...');

                $.ajax({
                    url: '../api/settings.php',
                    type: 'POST',
                    data: fd,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    success: function(r) {
                        if (r.success) {
                            showToast('success', r.message);
                            $('#passwordChangeForm')[0].reset();
                        } else {
                            showToast('error', r.message || 'Error changing password.');
                        }
                    },
                    error: function() {
                        showToast('error', 'Server connection failed.');
                    },
                    complete: function() {
                        $btn.prop('disabled', false).html(origHtml);
                    }
                });
            });
        });
    </script>
    <script src="../dist/js/admin_toast.js"></script>
</body>
</html>
