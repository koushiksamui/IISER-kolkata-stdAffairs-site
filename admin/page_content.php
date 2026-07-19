<?php

/**
 * SiSAS-IITG Admin — Page Content Manager
 * Container page: heading + tab buttons.
 * Each tab loads its own PHP partial into #pageContentFrame.
 */

require_once '../api/admin_auth.php';
requireAdmin('login.html');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Content &mdash; SiSAS-IITG Admin</title>
    <meta name="description" content="Manage static page content for the SiSAS-IITG portal.">
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

    <!-- Page-specific styles -->
    <link rel="stylesheet" href="../dist/css/admin/page_content.css">

    <!-- TinyMCE (used by other partials) -->
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

    <!-- Quill Editor (requested for About Us) -->
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
</head>

<body>

    <div class="admin-layout" id="adminLayout">

        <!-- Mobile sidebar overlay -->
        <div class="sidebar-overlay" id="sidebarOverlay"></div>

        <!-- ====== LEFT SIDEBAR ====== -->
        <?php include_once 'components/sidebar.php'; ?>

        <!-- ====== MAIN PANEL ====== -->
        <div class="main-panel">

            <!-- TOP HEADER -->
            <?php include_once 'components/header.php'; ?>

            <!-- ====== CONTENT AREA ====== -->
            <main class="admin-content" id="pageContentMain">

                <!-- Page Header -->
                <div class="page-header">
                    <div class="page-header-left">
                        <h1>
                            <i class="fa-solid fa-file-pen" style="color:var(--accent-emerald);margin-right:10px;font-size:1.4rem;"></i>
                            Page Content
                        </h1>
                        <p>Select a page below to edit its content.</p>
                    </div>
                </div>

                <!-- ===== TAB BUTTONS ===== -->
                <div class="page-tabs-card">
                    <div class="page-tabs" role="tablist" aria-label="Page selector">

                        <button class="page-tab-btn active"
                            data-partial="partials/about_us.php"
                            data-slug="about_us"
                            id="tab-about_us" role="tab" aria-selected="true">
                            <i class="fa-solid fa-circle-info"></i>
                            About Us
                        </button>

                        <button class="page-tab-btn"
                            data-partial="partials/contact_us.php"
                            data-slug="contact_us"
                            id="tab-contact_us" role="tab" aria-selected="false">
                            <i class="fa-solid fa-address-card"></i>
                            Contact Us
                        </button>

                        <button class="page-tab-btn"
                            data-partial="partials/head_message.php"
                            data-slug="head_message"
                            id="tab-head_message" role="tab" aria-selected="false">
                            <i class="fa-solid fa-comment-dots"></i>
                            Message from the Head
                        </button>

                    </div>
                </div>

                <!-- ===== DYNAMIC CONTENT FRAME ===== -->
                <!-- Each tab's PHP partial is loaded here -->
                <div id="pageContentFrame">
                    <!-- Loading skeleton shown while fetching -->
                    <div class="frame-loading" id="frameLoading">
                        <i class="fa-solid fa-circle-notch fa-spin"></i>
                        <p>Loading…</p>
                    </div>
                </div>

            </main>
        </div><!-- /main-panel -->
    </div><!-- /admin-layout -->

    <!-- Toast container -->
    <div class="toast-container" id="toastContainer"></div>

    <script>
        $(function() {

            var loadedPartials = {}; // cache so we don't re-fetch on every click

            /* ── Toast ── */
            window.showToast = function(type, msg) {
                var icons = {
                    success: 'fa-circle-check',
                    error: 'fa-circle-xmark',
                    info: 'fa-circle-info'
                };
                var $t = $('<div class="toast ' + type + '">' +
                    '<i class="fa-solid ' + (icons[type] || 'fa-circle-info') + '"></i>' +
                    '<span class="toast-msg">' + msg + '</span></div>');
                $('#toastContainer').append($t);
                setTimeout(function() {
                    $t.fadeOut(300, function() {
                        $t.remove();
                    });
                }, 3500);
            };

            /* ── Load a partial into the frame ── */
            function loadPartial(partial, slug) {
                var $frame = $('#pageContentFrame');
                var $loading = $('#frameLoading');

                // Show skeleton, hide current content
                $frame.find('.partial-content').hide();
                $loading.show();

                // Use cache if already loaded
                if (loadedPartials[slug]) {
                    $loading.hide();
                    loadedPartials[slug].show();
                    return;
                }

                // Fetch the partial via AJAX
                $.ajax({
                    url: partial,
                    type: 'GET',
                    success: function(html) {
                        $loading.hide();
                        var $wrap = $('<div class="partial-content" data-slug="' + slug + '"></div>').html(html);
                        $frame.append($wrap);
                        loadedPartials[slug] = $wrap;
                    },
                    error: function(xhr) {
                        $loading.hide();
                        $frame.append(
                            '<div class="partial-content partial-error" data-slug="' + slug + '">' +
                            '<i class="fa-solid fa-circle-exclamation"></i>' +
                            '<p>Failed to load content (' + xhr.status + '). Please try again.</p>' +
                            '</div>'
                        );
                        showToast('error', 'Could not load the page file.');
                    }
                });
            }

            /* ── Tab click ── */
            $('.page-tab-btn').on('click', function() {
                var partial = $(this).data('partial');
                var slug = $(this).data('slug');

                // Update active tab
                $('.page-tab-btn').removeClass('active').attr('aria-selected', 'false');
                $(this).addClass('active').attr('aria-selected', 'true');

                // Dynamically update the breadcrumb
                var tabText = $(this).text().trim();
                $('#breadcrumb-last-item').text(tabText);

                loadPartial(partial, slug);
            });

            /* ── Ctrl+S — delegate to whichever partial is active ── */
            $(document).on('keydown', function(e) {
                if ((e.ctrlKey || e.metaKey) && e.key === 's') {
                    e.preventDefault();
                    // Each partial listens for this custom event on itself
                    var slug = $('.page-tab-btn.active').data('slug');
                    $(document).trigger('page:save', [slug]);
                }
            });

            /* ── Init: load first tab ── */
            var $first = $('.page-tab-btn.active');
            loadPartial($first.data('partial'), $first.data('slug'));
        });
    </script>

</body>

</html>