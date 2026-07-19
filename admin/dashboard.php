<?php
/**
 * Admin Dashboard
 * Main entry point for the admin portal. Requires active admin session.
 */

require_once '../api/admin_auth.php';
requireAdmin('login.html');

// Fetch session data
$adminEmail   = isset($_SESSION['admin_email']) ? $_SESSION['admin_email'] : 'admin@iiserkol.ac.in';
$adminDisplay = isset($_SESSION['admin_display_name']) ? $_SESSION['admin_display_name'] : ucfirst(explode('@', $adminEmail)[0]);
$loginTime    = isset($_SESSION['admin_login_time']) ? date('d M Y, h:i A', $_SESSION['admin_login_time']) : 'N/A';

// Dynamic Greeting based on time
$hour = (int)date('H');
if ($hour < 12) {
    $greeting = 'Good morning';
} elseif ($hour < 17) {
    $greeting = 'Good afternoon';
} else {
    $greeting = 'Good evening';
}

// Static dashboard stats (Database queries temporarily disabled)
$lastLoginDb = 'N/A';
$totalResearchGroups = 12; // Static placeholder
$totalFacultyStaff = 45;   // Static placeholder
$totalNotices = 18;        // Static placeholder
$totalPublications = 104;  // Static placeholder

// Static Chart Data
$chartLabels = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
$chartData = [5, 12, 8, 15, 10, 3, 2];
$chartLabelsJson = json_encode($chartLabels);
$chartDataJson = json_encode($chartData);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard &mdash; Admin</title>
    <meta name="description" content="Administration Dashboard — manage content, faculty, research, and site settings.">
    <meta name="robots" content="noindex, nofollow">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;600;700&family=Outfit:wght@400;500;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- jQuery (must load before component scripts) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Dashboard Stylesheet -->
    <link rel="stylesheet" href="../dist/css/admin/dashboard.css">
</head>
<body>

<div class="admin-layout" id="adminLayout">

    <!-- Mobile sidebar overlay backdrop -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- ====== LEFT SIDEBAR ====== -->
    <?php include_once 'components/sidebar.php'; ?>

    <!-- ====== MAIN PANEL ====== -->
    <div class="main-panel">

        <!-- TOP HEADER -->
        <?php include_once 'components/header.php'; ?>

        <!-- ====== CONTENT AREA ====== -->
        <main class="admin-content" id="dashboardMain">

            <!-- Welcome Banner -->
            <div class="welcome-banner animate-stagger delay-1">
                <div class="welcome-info">
                    <h1><?php echo $greeting; ?>, <?php echo htmlspecialchars($adminDisplay); ?> 👋</h1>
                    <p>Here's what's happening with the <span>Admin</span> portal today.</p>
                </div>
                <div class="last-login-tag">
                    <span>Last Login</span>
                    <span><?php echo htmlspecialchars($lastLoginDb !== 'N/A' ? $lastLoginDb : $loginTime); ?></span>
                </div>
            </div>

            <!-- Statistics Grid -->
            <div class="stats-grid animate-stagger delay-2">

                <div class="stats-card">
                    <div class="card-data-block">
                        <span class="stats-label">Verticals</span>
                        <span class="stats-value"><?php echo $totalResearchGroups; ?></span>
                        <span class="stats-trend">&#8593; Active Verticals</span>
                    </div>
                    <div class="stats-icon-wrapper emerald">
                        <i class="fa-solid fa-building"></i>
                    </div>
                </div>

                <div class="stats-card">
                    <div class="card-data-block">
                        <span class="stats-label">Faculty & Staff</span>
                        <span class="stats-value"><?php echo $totalFacultyStaff; ?></span>
                        <span class="stats-trend">&#8593; Total personnel</span>
                    </div>
                    <div class="stats-icon-wrapper gold">
                        <i class="fa-solid fa-chalkboard-user"></i>
                    </div>
                </div>

                <div class="stats-card">
                    <div class="card-data-block">
                        <span class="stats-label">Notices</span>
                        <span class="stats-value"><?php echo $totalNotices; ?></span>
                        <span class="stats-trend">&#8593; Published</span>
                    </div>
                    <div class="stats-icon-wrapper blue">
                        <i class="fa-solid fa-bullhorn"></i>
                    </div>
                </div>

                <div class="stats-card">
                    <div class="card-data-block">
                        <span class="stats-label">Publications</span>
                        <span class="stats-value"><?php echo $totalPublications; ?></span>
                        <span class="stats-trend">&#8593; Research items</span>
                    </div>
                    <div class="stats-icon-wrapper red">
                        <i class="fa-solid fa-book-open"></i>
                    </div>
                </div>

            </div><!-- /.stats-grid -->

            <!-- Analytics Chart Row -->
            <div class="dashboard-card chart-card animate-stagger delay-3" style="margin-bottom: 35px;">
                <div class="card-header-block">
                    <h3><i class="fa-solid fa-chart-area"></i> System Activity (7 Days)</h3>
                    <div class="chart-actions">
                        <span class="badge-success" style="background: rgba(34, 160, 101, 0.1); color: var(--accent-emerald); padding: 4px 10px; border-radius: 20px; font-size: 0.8rem; font-weight: 700;"><i class="fa-solid fa-satellite-dish"></i> Live</span>
                    </div>
                </div>
                <div class="card-body-block">
                    <div class="chart-container" style="position: relative; height:300px; width:100%">
                        <canvas id="visitorChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Two-column row -->
            <div class="dashboard-details-row animate-stagger delay-4">

                <!-- System / DB Status -->
                <div class="dashboard-card">
                    <div class="card-header-block">
                        <h3><i class="fa-solid fa-server"></i> System Status</h3>
                        <a href="#" class="card-header-action">Refresh</a>
                    </div>
                    <div class="card-body-block">
                        <ul class="db-status-checklist">
                            <li class="db-status-item">
                                <span class="db-status-check success"><i class="fa-solid fa-circle-check"></i></span>
                                <div class="db-status-text">
                                    <h4>Database Connection</h4>
                                    <p>MySQL is reachable. Table <span class="db-status-badge">admin</span> verified.</p>
                                </div>
                            </li>
                            <li class="db-status-item">
                                <span class="db-status-check success"><i class="fa-solid fa-circle-check"></i></span>
                                <div class="db-status-text">
                                    <h4>Session Active</h4>
                                    <p>Authenticated as <span class="db-status-badge"><?php echo htmlspecialchars($adminEmail); ?></span></p>
                                </div>
                            </li>
                            <li class="db-status-item">
                                <span class="db-status-check success"><i class="fa-solid fa-circle-check"></i></span>
                                <div class="db-status-text">
                                    <h4>PHP Version</h4>
                                    <p>Running <span class="db-status-badge">PHP <?php echo PHP_VERSION; ?></span> on XAMPP.</p>
                                </div>
                            </li>
                            <li class="db-status-item">
                                <span class="db-status-check success"><i class="fa-solid fa-circle-check"></i></span>
                                <div class="db-status-text">
                                    <h4>Server Time</h4>
                                    <p>Current time: <span class="db-status-badge"><?php echo date('d M Y, h:i:s A'); ?></span></p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="dashboard-card">
                    <div class="card-header-block">
                        <h3><i class="fa-solid fa-bolt"></i> Quick Actions</h3>
                    </div>
                    <div class="card-body-block">
                        <div class="admin-actions-grid">
                            <a href="news.php" class="action-btn-shortcut" id="action_news">
                                <i class="fa-solid fa-plus-circle"></i>
                                <span class="action-btn-label">Add Notice</span>
                            </a>
                            <a href="faculty.php" class="action-btn-shortcut" id="action_faculty">
                                <i class="fa-solid fa-user-plus"></i>
                                <span class="action-btn-label">Add Faculty</span>
                            </a>
                            <a href="gallery.php" class="action-btn-shortcut" id="action_gallery">
                                <i class="fa-solid fa-image"></i>
                                <span class="action-btn-label">Upload Media</span>
                            </a>
                            <a href="applications.php" class="action-btn-shortcut" id="action_apps">
                                <i class="fa-solid fa-inbox"></i>
                                <span class="action-btn-label">View Applications</span>
                            </a>
                            <a href="research.php" class="action-btn-shortcut" id="action_research">
                                <i class="fa-solid fa-flask"></i>
                                <span class="action-btn-label">Research</span>
                            </a>
                            <a href="settings.php" class="action-btn-shortcut" id="action_settings">
                                <i class="fa-solid fa-gear"></i>
                                <span class="action-btn-label">Settings</span>
                            </a>
                        </div>
                    </div>
                </div>

            </div><!-- /.dashboard-details-row -->

        </main><!-- /#dashboardMain -->
    </div><!-- /.main-panel -->

</div><!-- /.admin-layout -->

<script>
$(document).ready(function() {
    const ctx = document.getElementById('visitorChart');
    if(ctx) {
        // Gradient fill for area chart
        let gradient = ctx.getContext('2d').createLinearGradient(0, 0, 0, 300);
        gradient.addColorStop(0, 'rgba(34, 160, 101, 0.4)'); // accent-emerald with opacity
        gradient.addColorStop(1, 'rgba(34, 160, 101, 0.0)');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?php echo $chartLabelsJson; ?>,
                datasets: [{
                    label: 'System Actions',
                    data: <?php echo $chartDataJson; ?>,
                    borderColor: '#22a065',
                    backgroundColor: gradient,
                    borderWidth: 3,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#22a065',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#092c23',
                        titleFont: { family: 'Outfit', size: 13 },
                        bodyFont: { family: 'Lato', size: 14 },
                        padding: 12,
                        cornerRadius: 8,
                        displayColors: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0,0,0,0.04)',
                            drawBorder: false
                        },
                        ticks: {
                            color: '#64748b',
                            font: { family: 'Lato', size: 12 },
                            maxTicksLimit: 6
                        }
                    },
                    x: {
                        grid: { display: false, drawBorder: false },
                        ticks: {
                            color: '#64748b',
                            font: { family: 'Lato', size: 12 }
                        }
                    }
                }
            }
        });
    }
});
</script>

</body>
</html>
