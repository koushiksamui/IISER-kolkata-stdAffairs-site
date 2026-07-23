<?php

/**
 * SiSAS-IITG Admin — Videos Management
 */

require_once '../api/admin_auth.php';
requireAdmin('login.php');
require_once __DIR__ . '/../php_utils/_dbConnect.php';

$adminEmail   = isset($_SESSION['admin_email']) ? $_SESSION['admin_email'] : 'admin@iitg.ac.in';
$adminDisplay = ucfirst(explode('@', $adminEmail)[0]);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Videos Management &mdash; SiSAS-IITG Admin</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;600;700&family=Outfit:wght@400;500;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- jQuery UI (local, for drag-and-drop sorting) -->
    <script src="../plugins/jQueryUI/jquery-ui-1.10.3.min.js"></script>

    <!-- Shared Admin Stylesheet -->
    <link rel="stylesheet" href="../dist/css/admin/dashboard.css">

    <!-- Homepage Banners Stylesheet (Reused for Grid layouts) -->
    <link rel="stylesheet" href="../dist/css/admin/homepage_banners.css">

    <style>
        .video-thumbnail-wrap {
            position: relative;
            padding-top: 56.25%;
            /* 16:9 Aspect Ratio */
            overflow: hidden;
            background: #000;
        }

        .video-thumbnail-wrap video,
        .video-thumbnail-wrap iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
        }



        /* Video Type Toggle Buttons */
        .video-type-toggle {
            display: inline-flex;
            gap: 8px;
            margin-bottom: 20px;
            background: #f1f5f9;
            padding: 6px;
            border-radius: 10px;
        }

        .type-btn {
            padding: 10px 24px;
            border: none;
            border-radius: 6px;
            background: transparent;
            color: #64748b;
            font-weight: 700;
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .type-btn:hover {
            color: #1e293b;
        }

        .type-btn.active {
            background: #fff;
            color: var(--accent-blue, #3b82f6);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        }

        .type-section {
            display: none;
        }

        .type-section.active {
            display: block;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-5px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Custom Drop Zone adjustments */
        .image-drop-zone video {
            max-height: 200px;
            border-radius: 8px;
            margin-top: 15px;
        }
    </style>
</head>

<body>
    <div class="admin-layout" id="adminLayout">
        <div class="sidebar-overlay" id="sidebarOverlay"></div>

        <!-- ====== LEFT SIDEBAR ====== -->
        <?php include_once 'components/sidebar.php'; ?>

        <!-- ====== MAIN PANEL ====== -->
        <div class="main-panel">
            <?php include_once 'components/header.php'; ?>

            <main class="admin-content">

                <!-- VIEW: VIDEOS LIST -->
                <div id="viewVideos">
                    <div class="page-header" style="margin-bottom: 30px;">
                        <div class="page-header-left">
                            <h1><i class="fa-solid fa-play" style="color:var(--accent-blue, #3b82f6);margin-right:10px;font-size:1.5rem;"></i> Videos Management</h1>
                            <p>Manage and organize videos (Uploads & YouTube).</p>
                        </div>
                        <button class="btn-primary-action" id="toggleAddVideoBtn" style="background-color: var(--accent-blue, #3b82f6);">
                            <i class="fa-solid fa-plus"></i> Add New Video
                        </button>
                    </div>

                    <!-- Video Form Card -->
                    <div class="form-card" id="videoFormCard">
                        <div class="form-card-header" style="border-bottom: 1px solid rgba(0,0,0,0.05); padding-bottom: 15px; margin-bottom: 15px;">
                            <h3 id="videoFormTitle" style="color: #1f2937; font-size: 1.25rem;"><i class="fa-solid fa-video" style="color:var(--accent-blue, #3b82f6);"></i> Add New Video</h3>
                            <button class="btn-close-form" id="closeVideoFormBtn" title="Close form" style="color: #6b7280; font-size: 1.2rem; background: none; border: none; cursor: pointer;">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                        <div class="form-card-body">
                            <form id="videoForm" enctype="multipart/form-data">
                                <input type="hidden" name="action" value="save_video">
                                <input type="hidden" name="id" id="videoId" value="0">
                                <input type="hidden" name="video_type" id="videoType" value="youtube">

                                <div class="form-grid" style="margin-bottom: 20px;">
                                    <div class="form-group full-width">
                                        <label class="form-label" for="videoCaption" style="font-weight: 700; color: #374151;">Video Caption *</label>
                                        <input type="text" name="caption" id="videoCaption" class="form-control" required placeholder="e.g. Inauguration Ceremony 2026" style="padding: 10px; border-radius: 6px; border: 1px solid #d1d5db;">
                                    </div>
                                </div>

                                <label class="form-label" style="font-weight: 700; color: #374151; margin-bottom: 10px; display:block;">Video Source *</label>
                                <div class="video-type-toggle">
                                    <button type="button" class="type-btn active" data-type="youtube">
                                        <i class="fa-brands fa-youtube" style="color: #ef4444;"></i> YouTube URL
                                    </button>
                                    <button type="button" class="type-btn" data-type="upload">
                                        <i class="fa-solid fa-file-video"></i> Upload MP4
                                    </button>
                                </div>

                                <!-- YouTube Section -->
                                <div class="type-section active" id="section-youtube">
                                    <div class="form-group full-width" style="margin-bottom: 25px;">
                                        <label class="form-label" for="youtubeUrl" style="font-weight: 600; color: #4b5563;">YouTube Video URL / Embed URL</label>
                                        <input type="url" name="youtube_url" id="youtubeUrl" class="form-control" placeholder="https://www.youtube.com/watch?v=..." style="padding: 10px; border-radius: 6px; border: 1px solid #d1d5db;">
                                        <small style="display:block; margin-top:5px; color:#6b7280;">Paste the full YouTube link here.</small>
                                    </div>
                                </div>

                                <!-- Upload Section -->
                                <div class="type-section" id="section-upload">
                                    <div class="image-drop-zone" id="videoDropZone" style="margin-bottom: 25px;">
                                        <input type="file" name="video_file" id="videoFileInput" accept="video/mp4,video/webm">
                                        <div class="drop-zone-icon"><i class="fa-solid fa-cloud-arrow-up"></i></div>
                                        <p class="drop-zone-title">Drag &amp; drop video here</p>
                                        <p class="drop-zone-sub">or click to browse &mdash; MP4, WebM (Max 50MB)</p>
                                        <div class="drop-zone-preview" id="videoPreview" style="display:none; justify-content:center;"></div>
                                    </div>
                                    <p id="existingVideoNotice" style="display:none; color: #2563eb; font-size: 0.9rem; margin-bottom: 20px;">
                                        <i class="fa-solid fa-circle-info"></i> A video file is already uploaded. Leave this blank to keep it.
                                    </p>
                                </div>

                                <div class="form-submit-row">
                                    <button type="submit" class="btn-submit" id="submitVideoBtn" style="background-color: var(--accent-blue, #3b82f6);">
                                        <i class="fa-solid fa-check"></i> Save Video
                                    </button>
                                    <button type="button" class="btn-cancel" id="cancelVideoFormBtn">
                                        <i class="fa-solid fa-xmark"></i> Cancel
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Videos Grid -->
                    <div class="banners-list-card">
                        <div class="banners-list-header">
                            <h2 style="font-size: 1.15rem;"><i class="fa-solid fa-list-ul"></i> All Videos</h2>
                        </div>
                        <div class="banners-grid" id="videosGrid">
                            <!-- Populated via AJAX -->
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>

    <!-- Toast Container -->
    <div class="toast-container" id="toastContainer"></div>

    <!-- Delete Confirmation Modal -->
    <div class="delete-modal-backdrop" id="deleteModalOverlay">
        <div class="delete-modal">
            <div class="delete-modal-icon">
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>
            <h3 class="delete-modal-title">Delete Video?</h3>
            <p class="delete-modal-body">Are you sure you want to delete this video?<br>This action cannot be undone.</p>
            <div class="delete-modal-actions">
                <button class="delete-modal-cancel" id="cancelDeleteBtn">Cancel</button>
                <button class="delete-modal-confirm" id="confirmDeleteBtn">Yes, Delete</button>
            </div>
        </div>
    </div>

    <script>
        const API_URL = '../api/videos.php';
        let videosData = [];
        let deleteId = null;

        $(document).ready(function() {
            loadVideos();

            // Setup sortable grid
            $('#videosGrid').sortable({
                items: '.banner-item-card',
                placeholder: 'banner-item-card ui-sortable-placeholder',
                tolerance: 'intersect',
                cancel: 'a, button, input, textarea, .banner-reorder-controls, iframe, video',
                delay: 100,
                distance: 5,
                opacity: 0.8,
                zIndex: 9999,
                start: function(event, ui) {
                    ui.placeholder.height(ui.item.height());
                    ui.placeholder.width(ui.item.width());
                },
                stop: function() {
                    updateOrderBadges();
                    refreshReorderButtons();
                    updateVideosOrder();
                }
            });
            $('#videosGrid').disableSelection();
        });

        // -------------------------
        // Video Type Toggle Logic
        // -------------------------
        $('.type-btn').click(function() {
            $('.type-btn').removeClass('active');
            $(this).addClass('active');

            const type = $(this).data('type');
            $('#videoType').val(type);

            $('.type-section').removeClass('active');
            $('#section-' + type).addClass('active');

            if (type === 'youtube') {
                $('#youtubeUrl').prop('required', true);
                $('#videoFileInput').prop('required', false);
            } else {
                $('#youtubeUrl').prop('required', false);
                if ($('#videoId').val() == '0') {
                    $('#videoFileInput').prop('required', true);
                } else {
                    $('#videoFileInput').prop('required', false); // Optional when editing
                }
            }
        });

        // -------------------------
        // Fetch & Render Videos
        // -------------------------
        function loadVideos() {
            $('#videosGrid').html('<p style="padding: 20px; color: #64748b;"><i class="fa-solid fa-spinner fa-spin"></i> Loading videos...</p>');
            $.getJSON(API_URL, {
                action: 'get_videos'
            }, function(res) {
                if (res.success) {
                    videosData = res.data;
                    renderVideos();
                } else {
                    showToast('error', res.message);
                }
            }).fail(function() {
                showToast('error', 'Failed to fetch videos from server.');
            });
        }

        // Helper to convert YouTube URL to embed URL
        function getYoutubeEmbedUrl(url) {
            let videoId = '';
            const regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|&v=)([^#&?]*).*/;
            const match = url.match(regExp);
            if (match && match[2].length === 11) {
                videoId = match[2];
            }
            if (videoId) {
                return `https://www.youtube.com/embed/${videoId}`;
            }
            return url;
        }

        function renderVideos() {
            const $grid = $('#videosGrid');
            $grid.empty();

            if (videosData.length === 0) {
                $grid.html('<p style="padding: 20px; color: #64748b;"><i class="fa-solid fa-info-circle"></i> No videos found. Click "Add New Video" to create one.</p>');
                return;
            }

            videosData.forEach((v, index) => {
                const orderNum = index + 1;

                let playerHtml = '';
                if (v.video_type === 'youtube') {
                    const embedUrl = getYoutubeEmbedUrl(v.video_url);
                    playerHtml = `<iframe src="${embedUrl}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>`;
                } else {
                    playerHtml = `<video controls controlsList="nodownload" style="max-height: 200px; width: 100%; border-radius: 8px; background: #000;">
                                      <source src="../api/stream_video.php?file=${encodeURIComponent(v.video_url)}" type="video/mp4">
                                  </video>`;
                }

                const card = $(`
                    <div class="banner-item-card" data-id="${v.id}">
                        <div class="banner-reorder-controls">
                            <button type="button" class="reorder-btn move-up-btn" title="Move Left/Up"><i class="fa-solid fa-chevron-left"></i></button>
                            <button type="button" class="reorder-btn move-down-btn" title="Move Right/Down"><i class="fa-solid fa-chevron-right"></i></button>
                        </div>
                        <div class="banner-order-badge">${orderNum}</div>
                        
                        <div class="video-thumbnail-wrap">
                            ${playerHtml}
                        </div>
                        
                        <div class="banner-card-body">
                            <div class="banner-card-title">${escapeHtml(v.caption)}</div>
                            <div class="banner-card-meta">
                                <span class="banner-meta-chip">
                                    <i class="${v.video_type === 'youtube' ? 'fa-brands fa-youtube' : 'fa-solid fa-file-video'}"></i> 
                                    ${v.video_type === 'youtube' ? 'YouTube' : 'MP4 Upload'}
                                </span>
                            </div>
                            <div class="banner-card-actions">
                                <button class="banner-action-btn edit-btn" onclick="editVideo(${v.id})" title="Edit Video">
                                    <i class="fa-solid fa-pen"></i> Edit
                                </button>
                                <button class="banner-action-btn delete-btn" onclick="deleteVideo(${v.id})" title="Delete Video">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                `);
                $grid.append(card);
            });
            refreshReorderButtons();
        }

        // -------------------------
        // Reordering
        // -------------------------
        function updateOrderBadges() {
            $('#videosGrid .banner-item-card').each(function(idx) {
                $(this).find('.banner-order-badge').text(idx + 1);
            });
        }

        function refreshReorderButtons() {
            var $cards = $('#videosGrid .banner-item-card');
            $cards.find('.reorder-btn').prop('disabled', false);
            $cards.first().find('.move-up-btn').prop('disabled', true);
            $cards.last().find('.move-down-btn').prop('disabled', true);
        }

        $(document).on('click', '.move-up-btn', function(e) {
            e.stopPropagation();
            var $card = $(this).closest('.banner-item-card');
            var $prev = $card.prev('.banner-item-card');
            if ($prev.length > 0) {
                $card.insertBefore($prev);
                updateOrderBadges();
                refreshReorderButtons();
                updateVideosOrder();
            }
        });

        $(document).on('click', '.move-down-btn', function(e) {
            e.stopPropagation();
            var $card = $(this).closest('.banner-item-card');
            var $next = $card.next('.banner-item-card');
            if ($next.length > 0) {
                $card.insertAfter($next);
                updateOrderBadges();
                refreshReorderButtons();
                updateVideosOrder();
            }
        });

        function updateVideosOrder() {
            let orderData = [];
            $('#videosGrid .banner-item-card').each(function(index) {
                const id = $(this).data('id');
                orderData.push({
                    id: id,
                    order: index + 1
                });
            });

            $.post(API_URL, {
                action: 'update_order',
                order: JSON.stringify(orderData)
            }, function(res) {
                if (res.success) {
                    showToast('success', 'Order updated successfully.');
                    $('#videosGrid .banner-order-badge').each(function(index) {
                        $(this).text(index + 1);
                    });
                } else {
                    showToast('error', res.message);
                    loadVideos(); // Revert on UI
                }
            }, 'json').fail(function() {
                showToast('error', 'Failed to update order.');
                loadVideos();
            });
        }

        // -------------------------
        // Form Logic (Add / Edit)
        // -------------------------
        $('#toggleAddVideoBtn').click(function() {
            if ($('#videoFormCard').hasClass('visible')) {
                closeVideoForm();
            } else {
                $('#videoFormTitle').html('<i class="fa-solid fa-video" style="color:var(--accent-blue, #3b82f6);"></i> Add New Video');
                $('#videoId').val('0');
                $('#videoForm')[0].reset();
                resetVideoFormPreview();

                // Default to YouTube
                $('.type-btn[data-type="youtube"]').click();

                $('#videoFormCard').hide().addClass('visible').slideDown(300);
            }
        });

        $('#closeVideoFormBtn, #cancelVideoFormBtn').click(closeVideoForm);

        function closeVideoForm() {
            $('#videoFormCard').slideUp(300, function() {
                $(this).removeClass('visible').css('display', '');
                $('#videoForm')[0].reset();
                $('#videoId').val('0');
                resetVideoFormPreview();
            });
        }

        function resetVideoFormPreview() {
            $('#videoFileInput').val('');
            $('#videoPreview').hide().empty();
            $('#videoDropZone .drop-zone-icon, #videoDropZone .drop-zone-title, #videoDropZone .drop-zone-sub').show();
            $('#existingVideoNotice').hide();
        }

        // Local Preview for MP4 upload
        $('#videoFileInput').on('change', function() {
            const file = this.files[0];
            if (!file) {
                resetVideoFormPreview();
                return;
            }

            $('#videoDropZone .drop-zone-icon, #videoDropZone .drop-zone-title, #videoDropZone .drop-zone-sub').hide();
            const $preview = $('#videoPreview');
            $preview.empty().css('display', 'flex');

            const fileURL = URL.createObjectURL(file);
            const videoEl = $(`<video controls controlsList="nodownload" style="width:100%; max-height:250px; border-radius:8px;">
                                   <source src="${fileURL}" type="${file.type || 'video/mp4'}">
                               </video>`);

            const info = $('<p style="margin-top:10px; font-weight:600; color:#10b981;">').text('Selected: ' + file.name + ' (' + (file.size / 1024 / 1024).toFixed(2) + ' MB)');

            $preview.append(videoEl).append(info);
        });

        $('#videoForm').submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            const btn = $('#submitVideoBtn');
            const orig = btn.html();
            btn.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin"></i> Saving...');

            $.ajax({
                url: API_URL,
                type: 'POST',
                data: fd,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(res) {
                    if (res.success) {
                        showToast('success', res.message);
                        closeVideoForm();
                        loadVideos();
                    } else {
                        showToast('error', res.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error:", xhr.responseText);
                    showToast('error', 'Server Error: ' + error);
                },
                complete: function() {
                    btn.prop('disabled', false).html(orig);
                }
            });
        });

        // -------------------------
        // Edit Video
        // -------------------------
        window.editVideo = function(id) {
            const v = videosData.find(v => v.id == id);
            if (!v) return;

            $('#videoFormTitle').html('<i class="fa-solid fa-pen" style="color:#f59e0b;"></i> Edit Video');
            $('#videoId').val(v.id);
            $('#videoCaption').val(v.caption);

            resetVideoFormPreview();

            // Set Type
            $('.type-btn[data-type="' + v.video_type + '"]').click();

            if (v.video_type === 'youtube') {
                $('#youtubeUrl').val(v.video_url);
            } else {
                $('#existingVideoNotice').show();
            }

            if (!$('#videoFormCard').hasClass('visible')) {
                $('#videoFormCard').hide().addClass('visible').slideDown(300);
            }

            // Scroll to form
            $('html, body').animate({
                scrollTop: $('#videoFormCard').offset().top - 100
            }, 400);
        };

        // -------------------------
        // Delete Video
        // -------------------------
        window.deleteVideo = function(id) {
            deleteId = id;
            $('#deleteModalOverlay').addClass('active');
        };

        $('#cancelDeleteBtn').click(function() {
            deleteId = null;
            $('#deleteModalOverlay').removeClass('active');
        });

        $('#confirmDeleteBtn').click(function() {
            if (!deleteId) return;
            const btn = $(this);
            const orig = btn.html();
            btn.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin"></i>');

            $.post(API_URL, {
                action: 'delete_video',
                id: deleteId
            }, function(res) {
                if (res.success) {
                    showToast('success', res.message);
                    $('#deleteModalOverlay').removeClass('active');
                    loadVideos();
                } else {
                    showToast('error', res.message);
                }
            }, 'json').always(function() {
                btn.prop('disabled', false).html(orig);
            });
        });

        function escapeHtml(str) {
            if (!str) return '';
            return $('<div>').text(str).html();
        }
    </script>
    <script src="../dist/js/admin_toast.js"></script>
</body>

</html>