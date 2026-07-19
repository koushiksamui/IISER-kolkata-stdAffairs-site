<?php

/**
 * Bespoke Left Sidebar Component for SiSAS-IITG Admin Portal
 */

// Determine admin display name from session
$adminEmail    = isset($_SESSION['admin_email']) ? $_SESSION['admin_email'] : 'admin@iitg.ac.in';
$adminDisplay  = isset($_SESSION['admin_display_name']) ? $_SESSION['admin_display_name'] : ucfirst(explode('@', $adminEmail)[0]);

// Get current page filename to highlight active nav item
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<aside class="admin-sidebar" id="adminSidebar">

    <!-- Brand / Logo Area -->
    <div class="sidebar-brand">
        <img src="../dist/img/iitg-logo.png" alt="IIT Guwahati Logo" class="sidebar-brand-logo">
        <div class="sidebar-brand-text">
            SiSAS CMS
        </div>
    </div>

    <!-- Navigation -->
    <nav class="sidebar-nav-container" aria-label="Admin Navigation">

        <!-- MAIN section -->
        <p class="sidebar-category-header">Main</p>
        <ul class="sidebar-menu-list">
            <li class="sidebar-menu-item">
                <a href="dashboard.php" class="sidebar-menu-link <?php echo ($currentPage === 'dashboard.php') ? 'active' : ''; ?>">
                    <i class="fa-solid fa-gauge-high"></i>
                    <span class="link-label">Dashboard</span>
                </a>
            </li>
        </ul>

        <!-- CONTENT section -->
        <p class="sidebar-category-header">Content</p>
        <ul class="sidebar-menu-list">
            <li class="sidebar-menu-item">
                <a href="homepage_banners.php" class="sidebar-menu-link <?php echo ($currentPage === 'homepage_banners.php') ? 'active' : ''; ?>">
                    <i class="fa-solid fa-file-lines"></i>
                    <span class="link-label">Homepage Banners</span>
                </a>
            </li>
            <li class="sidebar-menu-item">
                <a href="page_content.php" class="sidebar-menu-link <?php echo ($currentPage === 'page_content.php') ? 'active' : ''; ?>">
                    <i class="fa-solid fa-file-pen"></i>
                    <span class="link-label">Page Content</span>
                </a>
            </li>

            <li class="sidebar-menu-item">
                <a href="notices.php" class="sidebar-menu-link <?php echo ($currentPage === 'notices.php') ? 'active' : ''; ?>">
                    <i class="fa-solid fa-newspaper"></i>
                    <span class="link-label">Notices</span>
                </a>
            </li>

            <li class="sidebar-menu-item">
                <a href="verticals.php" class="sidebar-menu-link <?php echo ($currentPage === 'verticals.php') ? 'active' : ''; ?>">
                    <i class="fa-solid fa-microscope"></i>
                    <span class="link-label">Verticals</span>
                </a>
            </li>
            <li class="sidebar-menu-item">
                <a href="courses.php" class="sidebar-menu-link <?php echo ($currentPage === 'courses.php') ? 'active' : ''; ?>">
                    <i class="fa-solid fa-book"></i>
                    <span class="link-label">Courses</span>
                </a>
            </li>

            <li class="sidebar-menu-item">
                <a href="research_labs.php" class="sidebar-menu-link <?php echo ($currentPage === 'research_labs.php') ? 'active' : ''; ?>">
                    <i class="fa-solid fa-flask"></i>
                    <span class="link-label">Research Labs</span>
                </a>
            </li>
            <li class="sidebar-menu-item">
                <a href="forms_downloads.php" class="sidebar-menu-link <?php echo ($currentPage === 'forms_downloads.php') ? 'active' : ''; ?>">
                    <i class="fa-solid fa-file-pdf"></i>
                    <span class="link-label">Forms & Downloads</span>
                </a>
            </li>
        </ul>

        <!-- People Section -->
        <p class="sidebar-category-header">People</p>
        <ul class="sidebar-menu-list">
            <li class="sidebar-menu-item">
                <a href="head.php" class="sidebar-menu-link <?php echo ($currentPage === 'head.php') ? 'active' : ''; ?>">
                    <i class="fa-solid fa-user-tie"></i>
                    <span class="link-label">Heads of School</span>
                </a>
            </li>
            <li class="sidebar-menu-item">
                <a href="faculty.php" class="sidebar-menu-link <?php echo ($currentPage === 'faculty.php') ? 'active' : ''; ?>">
                    <i class="fa-solid fa-chalkboard-user"></i>
                    <span class="link-label">Faculty</span>
                </a>
            </li>
            <li class="sidebar-menu-item">
                <a href="staffs.php" class="sidebar-menu-link <?php echo ($currentPage === 'staffs.php') ? 'active' : ''; ?>">
                    <i class="fa-solid fa-users"></i>
                    <span class="link-label">Staff</span>
                </a>
            </li>
            <li class="sidebar-menu-item">
                <a href="students.php" class="sidebar-menu-link <?php echo ($currentPage === 'students.php') ? 'active' : ''; ?>">
                    <i class="fa-solid fa-user-graduate"></i>
                    <span class="link-label">Students</span>
                </a>
            </li>
            <li class="sidebar-menu-item">
                <a href="commitees.php" class="sidebar-menu-link <?php echo ($currentPage === 'commitees.php') ? 'active' : ''; ?>">
                    <i class="fa-solid fa-users-gear"></i>
                    <span class="link-label">Commitees</span>
                </a>
            </li>
            <li class="sidebar-menu-item">
                <a href="committee_roles.php" class="sidebar-menu-link <?php echo ($currentPage === 'committee_roles.php') ? 'active' : ''; ?>">
                    <i class="fa-solid fa-tags"></i>
                    <span class="link-label">Committee Roles</span>
                </a>
            </li>
        </ul>

        <!-- Research Section -->
        <p class="sidebar-category-header">Research</p>
        <ul class="sidebar-menu-list">
            <li class="sidebar-menu-item">
                <a href="publications.php" class="sidebar-menu-link <?php echo ($currentPage === 'publications.php') ? 'active' : ''; ?>">
                    <i class="fa-solid fa-book-open"></i>
                    <span class="link-label">Publications</span>
                </a>
            </li>
            <li class="sidebar-menu-item">
                <a href="invited_talks.php" class="sidebar-menu-link <?php echo ($currentPage === 'invited_talks.php') ? 'active' : ''; ?>">
                    <i class="fa-solid fa-microphone-lines"></i>
                    <span class="link-label">Invited Talks</span>
                </a>
            </li>
            <li class="sidebar-menu-item">
                <a href="patents.php" class="sidebar-menu-link <?php echo ($currentPage === 'patents.php') ? 'active' : ''; ?>">
                    <i class="fa-solid fa-certificate"></i>
                    <span class="link-label">Patents</span>
                </a>
            </li>
            <li class="sidebar-menu-item">
                <a href="projects.php" class="sidebar-menu-link <?php echo ($currentPage === 'projects.php') ? 'active' : ''; ?>">
                    <i class="fa-solid fa-diagram-project"></i>
                    <span class="link-label">Projects</span>
                </a>
            </li>
        </ul>

        <!-- Events section -->
        <p class="sidebar-category-header">Events</p>
        <ul class="sidebar-menu-list">
            <li class="sidebar-menu-item">
                <a href="seminars.php" class="sidebar-menu-link <?php echo ($currentPage === 'seminars.php') ? 'active' : ''; ?>">
                    <i class="fa-solid fa-person-chalkboard"></i>
                    <span class="link-label">Seminars & Colloquium</span>
                </a>
            </li>
            <li class="sidebar-menu-item">
                <a href="workshops.php" class="sidebar-menu-link <?php echo ($currentPage === 'workshops.php') ? 'active' : ''; ?>">
                    <i class="fa-solid fa-users-gear"></i>
                    <span class="link-label">Workshops & Conferences</span>
                </a>
            </li>
            <li class="sidebar-menu-item">
                <a href="events.php" class="sidebar-menu-link <?php echo ($currentPage === 'events.php') ? 'active' : ''; ?>">
                    <i class="fa-solid fa-calendar-days"></i>
                    <span class="link-label">Events</span>
                </a>
            </li>
        </ul>

        <!-- Gallery Section -->
        <p class="sidebar-category-header">Gallery</p>
        <ul class="sidebar-menu-list">
            <li class="sidebar-menu-item">
                <a href="photo_gallery.php" class="sidebar-menu-link <?php echo ($currentPage === 'photo_gallery.php') ? 'active' : ''; ?>">
                    <i class="fa-solid fa-images"></i>
                    <span class="link-label">Photos</span>
                </a>
            </li>
            <li class="sidebar-menu-item">
                <a href="videos.php" class="sidebar-menu-link <?php echo ($currentPage === 'videos.php') ? 'active' : ''; ?>">
                    <i class="fa-solid fa-play"></i>
                    <span class="link-label">Videos</span>
                </a>
            </li>
            <li class="sidebar-menu-item">
                <a href="event_media.php" class="sidebar-menu-link <?php echo ($currentPage === 'event_media.php') ? 'active' : ''; ?>">
                    <i class="fa-solid fa-images"></i>
                    <span class="link-label">Event Media Archives</span>
                </a>
            </li>
            <li class="sidebar-menu-item">
                <a href="press_releases.php" class="sidebar-menu-link <?php echo ($currentPage === 'press_releases.php') ? 'active' : ''; ?>">
                    <i class="fa-solid fa-newspaper"></i>
                    <span class="link-label">Press Releases</span>
                </a>
            </li>
        </ul>

        <!-- SYSTEM section -->
        <p class="sidebar-category-header">System</p>
        <ul class="sidebar-menu-list">
            <li class="sidebar-menu-item">
                <a href="logs.php" class="sidebar-menu-link <?php echo ($currentPage === 'logs.php') ? 'active' : ''; ?>">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                    <span class="link-label">Activity Logs</span>
                </a>
            </li>
            <li class="sidebar-menu-item">
                <a href="settings.php" class="sidebar-menu-link <?php echo ($currentPage === 'settings.php') ? 'active' : ''; ?>">
                    <i class="fa-solid fa-gear"></i>
                    <span class="link-label">Settings</span>
                </a>
            </li>
            <li class="sidebar-menu-item">
                <a href="#" class="sidebar-menu-link" id="sidebar_logout_btn">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span class="link-label">Sign Out</span>
                </a>
            </li>
        </ul>

    </nav>

</aside>

<!-- ====== Logout Confirmation Modal ====== -->
<div class="logout-modal-backdrop" id="logoutModalBackdrop" role="dialog" aria-modal="true" aria-labelledby="logoutModalTitle">
    <div class="logout-modal">
        <div class="logout-modal-icon">
            <i class="fa-solid fa-right-from-bracket"></i>
        </div>
        <h3 class="logout-modal-title" id="logoutModalTitle">Sign Out?</h3>
        <p class="logout-modal-body">You're about to end your session. Any unsaved changes will be lost.</p>
        <div class="logout-modal-actions">
            <button class="logout-modal-cancel" id="logoutModalCancel">
                <i class="fa-solid fa-xmark"></i> Cancel
            </button>
            <button class="logout-modal-confirm" id="logoutModalConfirm">
                <i class="fa-solid fa-right-from-bracket"></i> Yes, Sign Out
            </button>
        </div>
    </div>
</div>

<script>
    $(function() {
        // ── Shared logout function ──────────────────────────────────────────────
        function doLogout() {
            var $btn = $('#logoutModalConfirm');
            $btn.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin"></i> Signing out…');
            $.ajax({
                url: '../api/admin_auth.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    action: 'logout'
                },
                success: function() {
                    window.location.href = 'login.html';
                },
                error: function() {
                    window.location.href = 'login.html';
                }
            });
        }

        // ── Open modal ─────────────────────────────────────────────────────────
        function openLogoutModal() {
            $('#logoutModalBackdrop').addClass('active');
            $('body').css('overflow', 'hidden');
            // Reset button in case it was disabled before
            $('#logoutModalConfirm').prop('disabled', false)
                .html('<i class="fa-solid fa-right-from-bracket"></i> Yes, Sign Out');
            setTimeout(function() {
                $('#logoutModalCancel').trigger('focus');
            }, 50);
        }

        // ── Close modal ─────────────────────────────────────────────────────────
        function closeLogoutModal() {
            $('#logoutModalBackdrop').removeClass('active');
            $('body').css('overflow', '');
        }

        // ── Trigger: sidebar Sign Out ──────────────────────────────────────────
        $('#sidebar_logout_btn').on('click', function(e) {
            e.preventDefault();
            openLogoutModal();
        });

        // ── Trigger: header Sign Out ───────────────────────────────────────────
        $('#header_logout_btn_bespoke').on('click', function(e) {
            e.preventDefault();
            openLogoutModal();
        });

        // ── Modal buttons ──────────────────────────────────────────────────────
        $('#logoutModalCancel').on('click', closeLogoutModal);
        $('#logoutModalConfirm').on('click', doLogout);

        // ── Close on backdrop click ────────────────────────────────────────────
        $('#logoutModalBackdrop').on('click', function(e) {
            if ($(e.target).is('#logoutModalBackdrop')) closeLogoutModal();
        });

        // ── Close on Escape key ────────────────────────────────────────────────
        $(document).on('keydown', function(e) {
            if (e.key === 'Escape' && $('#logoutModalBackdrop').hasClass('active')) {
                closeLogoutModal();
            }
        });
    });
</script>