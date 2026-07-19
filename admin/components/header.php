<?php

/**
 * Bespoke Top Header Component for SiSAS-IITG Admin Portal
 */
$currentPage = basename($_SERVER['PHP_SELF']);
$pageTitles = [
    'dashboard.php' => ['Dashboard'],
    'index.php' => ['Dashboard'],
    'homepage_banners.php' => ['Content', 'Homepage Banners'],
    'page_content.php' => ['Content', 'Page Content', 'About Us'],
    'notices.php' => ['Content', 'Notices'],
    'forms_downloads.php' => ['Content', 'Forms & Downloads'],
    'verticals.php' => ['Content', 'Verticals'],
    'view_vertical.php' => ['Content', 'Verticals', 'View Vertical'],
    'vertical_images.php' => ['Content', 'Verticals', 'Vertical Gallery'],
    'courses.php' => ['Content', 'Courses'],
    'research_labs.php' => ['Content', 'Research Labs'],
    'faculty.php' => ['People', 'Faculty'],
    'head.php' => ['People', 'Heads of School'],
    'staffs.php' => ['People', 'Staff'],
    'students.php' => ['People', 'Students'],
    'publications.php' => ['Research', 'Publications'],
    'projects.php' => ['Research', 'Projects'],
    'invited_talks.php' => ['Research', 'Invited Talks'],
    'patents.php' => ['Research', 'Patents'],
    'seminars.php' => ['Events', 'Seminars'],
    'workshops.php' => ['Events', 'Workshops'],
    'conferences.php' => ['Events', 'Conferences'],
    'events.php' => ['Events', 'Events'],
    'view_event.php' => ['Events', 'Events', 'View Event'],
    'event_gallery.php' => ['Events', 'Events', 'View Event', 'Event Gallery'],
    'photo_gallery.php' => ['Gallery', 'Photos'],
    'videos.php' => ['Gallery', 'Videos'],
    'event_media.php' => ['Gallery', 'Event Media Archives'],
    'press_releases.php' => ['Gallery', 'Press Releases'],
    'logs.php' => ['System', 'Logs'],
    'settings.php' => ['System', 'Settings'],
    'commitees.php' => ['People', 'Committees'],
    'committee_members.php' => ['People', 'Committees', 'Manage Members'],
    'committee_roles.php' => ['People', 'Committees', 'Manage Roles'],
    'research_lab_equipments.php' => ['Content', 'Research Labs', 'Equipments']
];
$breadcrumb = isset($pageTitles[$currentPage]) ? $pageTitles[$currentPage] : ['Dashboard'];
?>
<header class="admin-header">
    <div class="header-left">
        <!-- Hamburger toggle (visible on mobile) -->
        <button class="sidebar-toggle-btn" id="sidebarToggleBtn" aria-label="Toggle navigation">
            <span class="hamburger-bar"></span>
            <span class="hamburger-bar"></span>
            <span class="hamburger-bar"></span>
        </button>
        <div class="header-title-block">
            <nav aria-label="breadcrumb">
                <ol style="list-style: none; padding: 0; margin: 0; display: flex; font-size: 1rem; color: var(--text-muted); align-items: center; gap: 8px;">
                    <li><i class="fa-solid fa-house" style="font-size:0.9rem; margin-right:4px;"></i> SiSAS</li>
                    <?php foreach ($breadcrumb as $index => $crumb): ?>
                        <li><i class="fa-solid fa-chevron-right" style="font-size:0.7rem; opacity:0.6;"></i></li>
                        <?php if ($index === count($breadcrumb) - 1): ?>
                            <li style="font-weight: 600; color: var(--text-dark);" id="breadcrumb-last-item"><?php echo $crumb; ?></li>
                        <?php else: ?>
                            <li><?php echo $crumb; ?></li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ol>
            </nav>
        </div>
    </div>
    <div class="header-right">
        <div class="header-date-tag">
            <i class="fa-regular fa-calendar-days"></i>
            <span id="current_date_display"><?php echo date('d M, Y'); ?></span>
        </div>
        <button class="header-logout-btn" id="header_logout_btn_bespoke">
            <i class="fa-solid fa-right-from-bracket"></i>
            <span class="btn-logout-label">Sign Out</span>
        </button>
    </div>
</header>

<script>
    $(function() {
        // Hamburger toggle — slides sidebar in/out on mobile
        $('#sidebarToggleBtn').on('click', function() {
            $('#adminLayout').toggleClass('sidebar-open');
            $('#sidebarOverlay').toggleClass('active');
        });

        // Tap overlay to close sidebar
        $('#sidebarOverlay').on('click', function() {
            $('#adminLayout').removeClass('sidebar-open');
            $(this).removeClass('active');
        });

        // Header sign-out — opens the shared logout modal (defined in sidebar.php)
        $('#header_logout_btn_bespoke').on('click', function(e) {
            e.preventDefault();
            // Modal logic is registered by sidebar.php's script block
        });
    });
</script>