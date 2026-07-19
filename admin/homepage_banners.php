<?php

/**
 * SiSAS-IITG Admin â€“ Homepage Banners Management
 * Manage homepage carousel banners: upload, view, reorder, and delete.
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
    <title>Homepage Banners &mdash; SiSAS-IITG Admin</title>
    <meta name="description" content="Manage homepage carousel banners for the SiSAS-IITG portal.">
    <meta name="robots" content="noindex, nofollow">

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

    <!-- Page-specific styles for the banners admin page -->
    <link rel="stylesheet" href="../dist/css/admin/homepage_banners.css">


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
            <main class="admin-content" id="bannersMain">

                <!-- Page Header -->
                <div class="page-header">
                    <div class="page-header-left">
                        <h1><i class="fa-solid fa-images" style="color:var(--accent-emerald);margin-right:10px;font-size:1.5rem;"></i>Homepage Banners</h1>
                        <p>Upload and manage the rotating carousel banners displayed on the homepage.</p>
                    </div>
                    <button class="btn-primary-action" id="toggleAddFormBtn">
                        <i class="fa-solid fa-plus"></i> Add New Banner
                    </button>
                </div>

                <!-- ===== ADD BANNER FORM CARD ===== -->
                <div class="form-card" id="addBannerFormCard">
                    <div class="form-card-header">
                        <h3><i class="fa-solid fa-upload"></i> Upload New Banner</h3>
                        <button class="btn-close-form" id="closeFormBtn" title="Close form">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                    <div class="form-card-body">
                        <form id="addBannerForm" enctype="multipart/form-data" novalidate>
                            <input type="hidden" name="banner_id" id="bannerIdInput">

                            <!-- Image Drop Zone -->
                            <div class="image-drop-zone" id="imageDropZone">
                                <input type="file" name="banner_image" id="bannerImageInput" accept="image/jpeg,image/jpg,image/png,image/webp,image/gif" required>
                                <div class="drop-zone-icon"><i class="fa-solid fa-cloud-arrow-up"></i></div>
                                <p class="drop-zone-title">Drag &amp; drop an image here</p>
                                <p class="drop-zone-sub">or click to browse &mdash; JPEG, PNG, WebP, GIF &bull; Min 1200x600 px (2:1)</p>
                                <div class="drop-zone-preview" id="dropZonePreview">
                                    <!-- Dynamic preview item will be appended here -->
                                </div>
                            </div>

                            <!-- Fields Grid -->
                            <div class="form-fields-grid">

                                <!-- Title (required) -->
                                <div class="form-group full-width">
                                    <label class="form-label" for="bannerTitle">
                                        <span class="form-label-left">
                                            Banner Title
                                            <span class="badge-required">Required</span>
                                        </span>
                                        <span class="char-counter" id="titleCounter">100 left</span>
                                    </label>
                                    <input type="text" class="form-input" id="bannerTitle" name="title"
                                        placeholder="e.g., Welcome to SiSAS-IITG" maxlength="100" required>
                                </div>

                                <!-- Description (optional) -->
                                <div class="form-group full-width">
                                    <label class="form-label" for="bannerDesc">
                                        <span class="form-label-left">
                                            Description
                                            <span class="badge-optional">Optional</span>
                                        </span>
                                        <span class="char-counter" id="descCounter">300 left</span>
                                    </label>
                                    <textarea class="form-textarea" id="bannerDesc" name="description"
                                        placeholder="A brief description or subtitle for this banners" maxlength="300"></textarea>
                                </div>

                                <!-- Button Text (optional) -->
                                <div class="form-group">
                                    <label class="form-label" for="bannerBtnText">
                                        <span class="form-label-left">
                                            Button Text
                                            <span class="badge-optional">Optional</span>
                                        </span>
                                        <span class="char-counter" id="btnTextCounter">30 left</span>
                                    </label>
                                    <input type="text" class="form-input" id="bannerBtnText" name="button_text"
                                        placeholder="e.g., Learn More" maxlength="30">
                                    <span class="form-hint">Leave blank to show no button on this banner.</span>
                                </div>

                                <!-- Button Link (conditional) -->
                                <div class="form-group" id="linkFieldGroup">
                                    <label class="form-label" for="bannerBtnLink">
                                        <span class="form-label-left">
                                            Button Link
                                            <span class="badge-required">Required if button set</span>
                                        </span>
                                        <span class="char-counter" id="btnLinkCounter">500 left</span>
                                    </label>
                                    <div class="link-field-wrapper" id="linkFieldWrapper">
                                        <input type="text" class="form-input" id="bannerBtnLink" name="button_link"
                                            placeholder="https://example.com or /page-path" maxlength="500">
                                        <span class="form-hint" style="margin-top:5px;display:block;">URL where the button should navigate.</span>
                                    </div>
                                    <div id="linkFieldPlaceholder" style="color:var(--text-muted);font-size:0.84rem;padding-top:6px;">
                                        Fill in Button Text above to enable this field.
                                    </div>
                                </div>

                            </div><!-- /.form-fields-grid -->

                            <!-- Feedback -->
                            <div class="form-feedback" id="addFormFeedback"></div>

                            <!-- Submit row -->
                            <div class="form-submit-row">
                                <button type="submit" class="btn-submit" id="submitBannerBtn">
                                    <i class="fa-solid fa-cloud-arrow-up"></i> Upload Banner
                                </button>
                                <button type="button" class="btn-cancel" id="cancelFormBtn">
                                    <i class="fa-solid fa-xmark"></i> Cancel
                                </button>
                            </div>

                        </form>
                    </div><!-- /.form-card-body -->
                </div><!-- /#addBannerFormCard -->

                <!-- ===== BANNERS LIST CARD ===== -->
                <div class="banners-list-card">
                    <div class="banners-list-header">
                        <h3>
                            <i class="fa-solid fa-layer-group"></i>
                            All Banners
                            <span class="banners-count-badge" id="bannersCountBadge">0</span>
                        </h3>
                    </div>

                    <!-- Banners Grid (sortable) -->
                    <div class="banners-grid" id="bannersGrid">
                        <!-- Skeleton loaders while fetching -->
                        <div class="skeleton-card"></div>
                        <div class="skeleton-card"></div>
                        <div class="skeleton-card"></div>
                    </div>
                </div><!-- /.banners-list-card -->

            </main><!-- /#bannersMain -->
        </div><!-- /.main-panel -->
    </div><!-- /.admin-layout -->

    <!-- ===== DELETE CONFIRM MODAL ===== -->
    <div class="delete-modal-backdrop" id="deleteModalBackdrop" role="dialog" aria-modal="true" aria-labelledby="deleteModalTitle">
        <div class="delete-modal">
            <div class="delete-modal-icon">
                <i class="fa-solid fa-trash"></i>
            </div>
            <h3 class="delete-modal-title" id="deleteModalTitle">Delete Banner?</h3>
            <p class="delete-modal-body">
                This will permanently remove the banner and its image file. This action cannot be undone.
            </p>
            <div class="delete-modal-actions">
                <button class="delete-modal-cancel" id="deleteModalCancel">Cancel</button>
                <button class="delete-modal-confirm" id="deleteModalConfirm">
                    <i class="fa-solid fa-trash"></i> Delete
                </button>
            </div>
        </div>
    </div>

    <!-- ===== TOAST CONTAINER ===== -->
    <div class="toast-container" id="toastContainer"></div>

    <!-- ===== IMAGE LIGHTBOX MODAL ===== -->
    <div class="lightbox-modal" id="imageLightbox" role="dialog" aria-modal="true">
        <button class="lightbox-close" id="closeLightboxBtn">&times;</button>
        <img class="lightbox-content" id="lightboxImage" src="" alt="Enlarged View">
        <div class="lightbox-caption" id="lightboxCaption"></div>
    </div>

    <script>
        $(function() {

            /* ====================
               CONFIGURATION
            ==================== */
            var API_URL = '../api/banners.php';
            var bannersList = [];

            /* ====================
               UTILITIES
            ==================== */

            /* ====================
               CHARACTER COUNTERS
            ==================== */
            function updateCharCounter($input, $counter, maxLen, warningThreshold, dangerThreshold) {
                var len = $input.val().length;
                var remaining = maxLen - len;
                $counter.text(remaining + ' left');

                $counter.removeClass('warning danger');
                if (remaining <= dangerThreshold) {
                    $counter.addClass('danger');
                } else if (remaining <= warningThreshold) {
                    $counter.addClass('warning');
                }
            }

            $('#bannerTitle').on('input', function() {
                updateCharCounter($(this), $('#titleCounter'), 100, 15, 5);
            });
            $('#bannerDesc').on('input', function() {
                updateCharCounter($(this), $('#descCounter'), 300, 30, 10);
            });
            $('#bannerBtnText').on('input', function() {
                updateCharCounter($(this), $('#btnTextCounter'), 30, 5, 2);
            });
            $('#bannerBtnLink').on('input', function() {
                updateCharCounter($(this), $('#btnLinkCounter'), 500, 50, 10);
            });

            /* ====================
               TOGGLE ADD FORM
            ==================== */
            function openForm() {
                $('#addBannerFormCard').addClass('visible');
                $('#toggleAddFormBtn').html('<i class="fa-solid fa-xmark"></i> Close Form');
                $('.main-panel').animate({
                    scrollTop: $('.main-panel').scrollTop() + $('#addBannerFormCard').offset().top - 90
                }, 300);
            }

            function closeForm() {
                $('#addBannerFormCard').removeClass('visible');
                $('#toggleAddFormBtn').html('<i class="fa-solid fa-plus"></i> Add New Banner');
                resetForm();
            }

            $('#toggleAddFormBtn').on('click', function() {
                if ($('#addBannerFormCard').hasClass('visible')) {
                    closeForm();
                } else {
                    openForm();
                }
            });

            $('#closeFormBtn, #cancelFormBtn').on('click', closeForm);

            /* ====================
               IMAGE PREVIEW
            ==================== */
            $('#imageDropZone').on('dragover', function(e) {
                e.preventDefault();
                $(this).addClass('dragover');
            }).on('dragleave', function() {
                $(this).removeClass('dragover');
            });

            var selectedFile = null; // Holds single { file, src, isValid, errorMsg, info }

            $('#bannerImageInput').on('change', function() {
                var file = this.files[0];
                if (!file) return;

                var inputEl = this;
                var allowed = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp', 'image/gif'];

                // Basic Type check
                if (!allowed.includes(file.type)) {
                    showToast('error', 'Only JPEG, PNG, WebP, or GIF images are allowed.');
                    inputEl.value = '';
                    resetFormImagePreview();
                    return;
                }

                // Size check
                if (file.size > 10 * 1024 * 1024) {
                    showToast('error', 'Image size must not exceed 10 MB.');
                    inputEl.value = '';
                    resetFormImagePreview();
                    return;
                }

                var reader = new FileReader();
                reader.onload = function(e) {
                    var img = new Image();
                    img.onload = function() {
                        var width = this.width;
                        var height = this.height;
                        var ratio = width / height;

                        if (width < 1200 || height < 600) {
                            selectedFile = {
                                file: file,
                                src: e.target.result,
                                isValid: false,
                                errorMsg: 'Dimensions too small (' + width + 'x' + height + 'px). Min: 1200x600 px.',
                                info: 'Min 1200x600 px'
                            };
                        } else if (Math.abs(ratio - 2.0) > 0.01) {
                            selectedFile = {
                                file: file,
                                src: e.target.result,
                                isValid: false,
                                errorMsg: 'Invalid aspect ratio (' + ratio.toFixed(2) + ':1). Must be exactly 2:1.',
                                info: 'Ratio is not 2:1'
                            };
                        } else {
                            selectedFile = {
                                file: file,
                                src: e.target.result,
                                isValid: true,
                                errorMsg: '',
                                info: width + 'x' + height + ' px'
                            };
                        }

                        renderPreview();
                    };
                    img.onerror = function() {
                        showToast('error', 'Invalid image file.');
                        inputEl.value = '';
                        resetFormImagePreview();
                    };
                    img.src = e.target.result;
                };
                reader.readAsDataURL(file);
            });

            function renderPreview() {
                var $preview = $('#dropZonePreview');
                $preview.empty();

                if (!selectedFile) {
                    $preview.hide();
                    $('.drop-zone-icon, .drop-zone-title, .drop-zone-sub').show();
                    return;
                }

                $preview.css('display', 'flex');
                $('.drop-zone-icon, .drop-zone-title').hide();
                $('.drop-zone-sub').show(); // keep validation visible

                var validityClass = selectedFile.isValid ? 'valid' : 'invalid';
                var infoClass = selectedFile.isValid ? 'success' : 'error';
                var infoText = selectedFile.info;
                var tooltipAttr = selectedFile.isValid ? '' : 'title="' + selectedFile.errorMsg + '"';
                var thumbnailSrc = selectedFile.src ? selectedFile.src : '../dist/img/iitg-logo.png';

                var fileName = (selectedFile.file && selectedFile.file.name) ? selectedFile.file.name : 'Current Image';

                var $card = $('<div class="preview-item ' + validityClass + '">' +
                    '<button type="button" class="preview-remove-btn" title="Remove">&times;</button>' +
                    '<img src="' + thumbnailSrc + '" alt="Preview">' +
                    '<span class="preview-name" title="' + escHtml(fileName) + '">' + escHtml(fileName) + '</span>' +
                    '<span class="preview-info ' + infoClass + '" ' + tooltipAttr + '>' + escHtml(infoText) + '</span>' +
                    '</div>');

                $preview.append($card);
            }

            // Handle cross click to remove image
            $(document).on('click', '.preview-remove-btn', function(e) {
                e.stopPropagation();
                resetFormImagePreview();
            });

            // Programmatic drag & drop drop handler for the dropzone container
            $('#imageDropZone').on('drop', function(e) {
                e.preventDefault();
                $(this).removeClass('dragover');
                var droppedFiles = e.originalEvent.dataTransfer.files;
                if (droppedFiles && droppedFiles.length > 0) {
                    var inputEl = $('#bannerImageInput')[0];
                    inputEl.files = droppedFiles;
                    $(inputEl).trigger('change');
                }
            });

            function resetFormImagePreview() {
                selectedFile = null;
                $('#bannerImageInput').val('');
                $('#dropZonePreview').hide().empty();
                $('.drop-zone-icon, .drop-zone-title').show();
                $('.drop-zone-sub').show(); // Keep validation conditions visible under the drop-zone
            }

            /* ====================
               CONDITIONAL BUTTON LINK FIELD
            ==================== */
            $('#bannerBtnText').on('input', function() {
                var hasText = $(this).val().trim().length > 0;
                if (hasText) {
                    $('#linkFieldWrapper').addClass('visible');
                    $('#linkFieldPlaceholder').hide();
                } else {
                    $('#linkFieldWrapper').removeClass('visible');
                    $('#bannerBtnLink').val('').removeClass('error');
                    $('#linkFieldPlaceholder').show();
                }
            });

            /* ====================
               RESET FORM
            ==================== */
            function resetForm() {
                $('#addBannerForm')[0].reset();
                $('#bannerIdInput').val('');
                resetFormImagePreview();
                $('#linkFieldWrapper').removeClass('visible');
                $('#linkFieldPlaceholder').show();
                $('#addFormFeedback').hide().removeClass('success error').text('');
                $('.form-input, .form-textarea').removeClass('error');
                $('#submitBannerBtn').prop('disabled', false).html('<i class="fa-solid fa-cloud-arrow-up"></i> Upload Banner');
                $('#addBannerFormCard').find('.form-card-header h3').html('<i class="fa-solid fa-upload"></i> Upload New Banner');

                // Reset character counters
                updateCharCounter($('#bannerTitle'), $('#titleCounter'), 100, 15, 5);
                updateCharCounter($('#bannerDesc'), $('#descCounter'), 300, 30, 10);
                updateCharCounter($('#bannerBtnText'), $('#btnTextCounter'), 30, 5, 2);
                updateCharCounter($('#bannerBtnLink'), $('#btnLinkCounter'), 500, 50, 10);
            }

            /* ====================
               SUBMIT FORM
            ==================== */
            $('#addBannerForm').on('submit', function(e) {
                e.preventDefault();
                var isValid = true;

                // Image validation counts
                var invalidCount = (selectedFile && !selectedFile.isValid) ? 1 : 0;
                var validCount = (selectedFile && selectedFile.isValid) ? 1 : 0;

                if (invalidCount > 0) {
                    showToast('error', 'Please remove the invalid image (red border) before uploading.');
                    isValid = false;
                } else if (validCount === 0) {
                    showToast('error', 'Please select a banner image.');
                    isValid = false;
                }

                // Title validation: always required for single banner upload
                var title = $('#bannerTitle').val().trim();
                if (!title) {
                    $('#bannerTitle').addClass('error');
                    isValid = false;
                } else {
                    $('#bannerTitle').removeClass('error');
                }

                // Link validation: required if button text is set
                var btnText = $('#bannerBtnText').val().trim();
                var btnLink = $('#bannerBtnLink').val().trim();
                if (btnText && !btnLink) {
                    $('#bannerBtnLink').addClass('error');
                    showToast('error', 'Please provide a link URL for the button.');
                    isValid = false;
                } else {
                    $('#bannerBtnLink').removeClass('error');
                }

                if (!isValid) return;

                // Prepare FormData
                var isEdit = $('#bannerIdInput').val() !== '';
                var action = isEdit ? 'edit_banner' : 'add_banner';
                var formData = new FormData(this);
                formData.append('action', action);

                var $btn = $('#submitBannerBtn');
                var loadingText = isEdit ? 'Updatingâ€¦' : 'Uploadingâ€¦';
                $btn.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin"></i> ' + loadingText);
                $('#addFormFeedback').hide();

                $.ajax({
                    url: API_URL,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        if (res.success) {
                            var successText = isEdit ? 'Banner updated successfully!' : 'Banner uploaded successfully!';
                            showToast('success', successText);
                            closeForm();
                            loadBanners();
                        } else {
                            var errText = isEdit ? 'Update failed. Please try again.' : 'Upload failed. Please try again.';
                            showFeedback('error', res.message || errText);
                            var btnHtml = isEdit ? '<i class="fa-solid fa-check"></i> Update Banner' : '<i class="fa-solid fa-cloud-arrow-up"></i> Upload Banner';
                            $btn.prop('disabled', false).html(btnHtml);
                        }
                    },
                    error: function() {
                        showFeedback('error', 'Server error. Please try again.');
                        var btnHtml = isEdit ? '<i class="fa-solid fa-check"></i> Update Banner' : '<i class="fa-solid fa-cloud-arrow-up"></i> Upload Banner';
                        $btn.prop('disabled', false).html(btnHtml);
                    }
                });
            });

            function showFeedback(type, msg) {
                var icon = type === 'success' ? 'fa-circle-check' : 'fa-circle-exclamation';
                $('#addFormFeedback')
                    .removeClass('success error')
                    .addClass(type)
                    .html('<i class="fa-solid ' + icon + '"></i> ' + msg)
                    .show();
            }

            /* ====================
               LOAD BANNERS
            ==================== */
            function loadBanners() {
                $.ajax({
                    url: API_URL,
                    type: 'GET',
                    data: {
                        action: 'get_banners'
                    },
                    success: function(res) {
                        if (res.success) {
                            bannersList = res.banners;
                            renderBanners(res.banners);
                        } else {
                            $('#bannersGrid').html('<div class="banners-empty-state"><i class="fa-solid fa-triangle-exclamation"></i><p>Failed to load banners.</p></div>');
                        }
                    },
                    error: function() {
                        $('#bannersGrid').html('<div class="banners-empty-state"><i class="fa-solid fa-triangle-exclamation"></i><p>Server error loading banners.</p></div>');
                    }
                });
            }

            function renderBanners(banners) {
                var $grid = $('#bannersGrid');
                $grid.empty();

                $('#bannersCountBadge').text(banners.length);

                if (banners.length === 0) {
                    $grid.html(
                        '<div class="banners-empty-state">' +
                        '<i class="fa-solid fa-images"></i>' +
                        '<p>No banners yet</p>' +
                        '<small>Click "Add New Banner" to upload your first homepage banner.</small>' +
                        '</div>'
                    );
                    $('#dragHintText').hide();
                    return;
                }

                $('#dragHintText').show();

                $.each(banners, function(index, banner) {
                    var isActive = parseInt(banner.is_active) === 1;
                    var hasButton = banner.button_text && banner.button_text.trim() !== '';
                    var desc = banner.description ? banner.description : '<em style="opacity:0.5;">No description</em>';
                    var imgSrc = '../' + banner.image_path;

                    var metaChips = '';
                    if (hasButton) {
                        var linkUrl = banner.button_link ? banner.button_link.trim() : '#';
                        metaChips += '<a href="' + escHtml(linkUrl) + '" target="_blank" class="banner-meta-chip has-btn" style="text-decoration: none;" onclick="event.stopPropagation();">' +
                            '<i class="fa-solid fa-link"></i>' + escHtml(banner.button_text) + '</a>';
                    }

                    var $card = $(
                        '<div class="banner-item-card' + (isActive ? '' : ' inactive') + '" data-id="' + banner.id + '">' +
                        '<div class="banner-reorder-controls">' +
                        '<button type="button" class="reorder-btn move-up-btn" title="Move Left/Up"><i class="fa-solid fa-chevron-left"></i></button>' +
                        '<button type="button" class="reorder-btn move-down-btn" title="Move Right/Down"><i class="fa-solid fa-chevron-right"></i></button>' +
                        '</div>' +
                        '<span class="banner-order-badge">' + (index + 1) + '</span>' +
                        '<div class="banner-thumbnail-wrap">' +
                        '<img src="' + imgSrc + '" alt="' + escHtml(banner.title) + '" loading="lazy" draggable="false">' +
                        '<span class="banner-status-pill ' + (isActive ? 'active' : 'inactive') + '">' +
                        (isActive ? '<i class="fa-solid fa-eye"></i> Active' : '<i class="fa-solid fa-eye-slash"></i> Hidden') +
                        '</span>' +
                        '</div>' +
                        '<div class="banner-card-body">' +
                        '<div class="banner-card-title">' + escHtml(banner.title) + '</div>' +
                        '<div class="banner-card-desc">' + desc + '</div>' +
                        (metaChips ? '<div class="banner-card-meta">' + metaChips + '</div>' : '') +
                        '<div class="banner-card-actions">' +
                        '<button class="banner-action-btn toggle-btn' + (isActive ? ' is-active' : '') + '" ' +
                        'data-id="' + banner.id + '" data-active="' + (isActive ? 1 : 0) + '">' +
                        '<i class="fa-solid ' + (isActive ? 'fa-eye' : 'fa-eye-slash') + '"></i> ' +
                        (isActive ? 'Visible' : 'Hidden') +
                        '</button>' +
                        '<button class="banner-action-btn edit-btn" data-id="' + banner.id + '" title="Edit banner">' +
                        '<i class="fa-solid fa-pen"></i> Edit' +
                        '</button>' +
                        '<button class="banner-action-btn delete-btn" data-id="' + banner.id + '" title="Delete banner">' +
                        '<i class="fa-solid fa-trash"></i>' +
                        '</button>' +
                        '</div>' +
                        '</div>' +
                        '</div>'
                    );

                    $grid.append($card);
                });

                // Enable drag-and-drop reordering
                $grid.sortable({
                    items: '.banner-item-card',
                    placeholder: 'banner-item-card ui-sortable-placeholder',
                    tolerance: 'intersect',
                    cancel: 'a, button, input, textarea, .banner-reorder-controls',
                    delay: 100,
                    distance: 5,
                    opacity: 0.8,
                    zIndex: 9999,
                    start: function(event, ui) {
                        ui.placeholder.height(ui.item.height());
                        ui.placeholder.width(ui.item.width());
                    },
                    stop: function() {
                        saveBannerOrder();
                        updateOrderBadges();
                        refreshReorderButtons();
                    }
                });
                refreshReorderButtons();
            }

            function escHtml(str) {
                return $('<div>').text(str).html();
            }

            function updateOrderBadges() {
                $('#bannersGrid .banner-item-card').each(function(idx) {
                    $(this).find('.banner-order-badge').text(idx + 1);
                });
            }

            function refreshReorderButtons() {
                var $cards = $('#bannersGrid .banner-item-card');
                $cards.find('.reorder-btn').prop('disabled', false); // reset
                $cards.first().find('.move-up-btn').prop('disabled', true);
                $cards.last().find('.move-down-btn').prop('disabled', true);
            }

            /* ====================
               SAVE REORDER
            ==================== */
            function saveBannerOrder() {
                var order = [];
                $('#bannersGrid .banner-item-card').each(function() {
                    order.push($(this).data('id'));
                });

                $.ajax({
                    url: API_URL,
                    type: 'POST',
                    data: {
                        action: 'reorder_banners',
                        order: JSON.stringify(order)
                    },
                    success: function(res) {
                        if (res.success) {
                            showToast('info', 'Banner order saved.');
                        }
                    }
                });
            }

            /* ====================
               TOGGLE ACTIVE
            ==================== */
            $(document).on('click', '.toggle-btn', function(e) {
                e.stopPropagation();
                var $btn = $(this);
                var id = $btn.data('id');
                var $card = $btn.closest('.banner-item-card');

                $btn.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin"></i>');

                $.ajax({
                    url: API_URL,
                    type: 'POST',
                    data: {
                        action: 'toggle_banner',
                        id: id
                    },
                    success: function(res) {
                        if (res.success) {
                            var nowActive = parseInt(res.is_active) === 1;
                            $card.toggleClass('inactive', !nowActive);
                            $btn.prop('disabled', false)
                                .toggleClass('is-active', nowActive)
                                .data('active', nowActive ? 1 : 0)
                                .html('<i class="fa-solid ' + (nowActive ? 'fa-eye' : 'fa-eye-slash') + '"></i> ' +
                                    (nowActive ? 'Visible' : 'Hidden'));
                            $card.find('.banner-status-pill')
                                .removeClass('active inactive')
                                .addClass(nowActive ? 'active' : 'inactive')
                                .html(nowActive ?
                                    '<i class="fa-solid fa-eye"></i> Active' :
                                    '<i class="fa-solid fa-eye-slash"></i> Hidden');
                            showToast('info', 'Banner ' + (nowActive ? 'made visible' : 'hidden') + '.');
                        } else {
                            showToast('error', res.message || 'Failed to toggle banner.');
                            $btn.prop('disabled', false).html('<i class="fa-solid fa-eye"></i> Visible');
                        }
                    },
                    error: function() {
                        showToast('error', 'Server error. Try again.');
                        $btn.prop('disabled', false);
                    }
                });
            });

            /* ====================
               DELETE BANNER
            ==================== */
            var deletingId = null;

            $(document).on('click', '.delete-btn', function(e) {
                e.stopPropagation();
                deletingId = $(this).data('id');
                $('#deleteModalBackdrop').addClass('active');
                $('body').css('overflow', 'hidden');
                $('#deleteModalConfirm').prop('disabled', false).html('<i class="fa-solid fa-trash"></i> Delete');
            });

            $('#deleteModalCancel').on('click', closeDeleteModal);

            $('#deleteModalBackdrop').on('click', function(e) {
                if ($(e.target).is('#deleteModalBackdrop')) closeDeleteModal();
            });

            $(document).on('keydown', function(e) {
                if (e.key === 'Escape' && $('#deleteModalBackdrop').hasClass('active')) closeDeleteModal();
            });

            function closeDeleteModal() {
                $('#deleteModalBackdrop').removeClass('active');
                $('body').css('overflow', '');
                deletingId = null;
            }

            $('#deleteModalConfirm').on('click', function() {
                if (!deletingId) return;
                var $btn = $(this);
                $btn.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin"></i> Deletingâ€¦');

                $.ajax({
                    url: API_URL,
                    type: 'POST',
                    data: {
                        action: 'delete_banner',
                        id: deletingId
                    },
                    success: function(res) {
                        if (res.success) {
                            closeDeleteModal();
                            showToast('success', 'Banner deleted.');
                            loadBanners();
                        } else {
                            showToast('error', res.message || 'Delete failed.');
                            closeDeleteModal();
                        }
                    },
                    error: function() {
                        showToast('error', 'Server error. Try again.');
                        closeDeleteModal();
                    }
                });
            });

            /* ====================
               EDIT BANNER
            ==================== */
            $(document).on('click', '.edit-btn', function(e) {
                e.stopPropagation();
                var id = $(this).data('id');
                var banner = bannersList.find(function(b) {
                    return parseInt(b.id) === parseInt(id);
                });
                if (!banner) {
                    showToast('error', 'Banner data not found.');
                    return;
                }

                // Populate fields
                $('#bannerIdInput').val(banner.id);
                $('#bannerTitle').val(banner.title).trigger('input');
                $('#bannerDesc').val(banner.description || '').trigger('input');
                $('#bannerBtnText').val(banner.button_text || '').trigger('input');
                $('#bannerBtnLink').val(banner.button_link || '').trigger('input');

                // Set preview of current image (make validation true since it is already existing)
                selectedFile = {
                    file: null,
                    src: '../' + banner.image_path,
                    isValid: true,
                    errorMsg: '',
                    info: 'Current Image'
                };
                renderPreview();

                // Change UI labels
                $('#addBannerFormCard').find('.form-card-header h3').html('<i class="fa-solid fa-pen"></i> Edit Banner');
                $('#submitBannerBtn').html('<i class="fa-solid fa-check"></i> Update Banner');

                openForm();
            });

            /* ====================
               REORDER BUTTONS
            ==================== */
            $(document).on('click', '.move-up-btn', function(e) {
                e.stopPropagation();
                var $card = $(this).closest('.banner-item-card');
                var $prev = $card.prev('.banner-item-card');
                if ($prev.length > 0) {
                    $card.insertBefore($prev);
                    updateOrderBadges();
                    refreshReorderButtons();
                    saveBannerOrder();
                } else {
                    showToast('info', 'Already at the top.');
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
                    saveBannerOrder();
                } else {
                    showToast('info', 'Already at the bottom.');
                }
            });

            /* ====================
               IMAGE LIGHTBOX EVENTS
             ==================== */
            // Open lightbox for upload previews (only on valid/invalid images, not the Add More card)
            $(document).on('click', '.preview-item:not(.add-more-box) img', function(e) {
                e.stopPropagation();
                var src = $(this).attr('src');
                var name = $(this).siblings('.preview-name').text();
                openLightbox(src, name);
            });

            // Open lightbox for existing banners
            $(document).on('click', '.banner-thumbnail-wrap img', function(e) {
                e.stopPropagation();
                var src = $(this).attr('src');
                var title = $(this).closest('.banner-item-card').find('.banner-card-title').text();
                openLightbox(src, title);
            });

            function openLightbox(src, caption) {
                if (!src) return;
                $('#lightboxImage').attr('src', src);
                $('#lightboxCaption').text(caption);
                $('#imageLightbox').addClass('active');
                $('body').css('overflow', 'hidden');
            }

            function closeLightbox() {
                $('#imageLightbox').removeClass('active');
                $('body').css('overflow', '');
                setTimeout(function() {
                    $('#lightboxImage').attr('src', '');
                    $('#lightboxCaption').text('');
                }, 250);
            }

            $('#closeLightboxBtn').on('click', closeLightbox);

            $('#imageLightbox').on('click', function(e) {
                if ($(e.target).is('#imageLightbox') || $(e.target).is('#lightboxImage')) {
                    closeLightbox();
                }
            });

            $(document).on('keydown', function(e) {
                if (e.key === 'Escape' && $('#imageLightbox').hasClass('active')) {
                    closeLightbox();
                }
            });

            /* ====================
               INIT
            ==================== */
            loadBanners();
        });
    </script>

    <script src="../dist/js/admin_toast.js"></script>
</body>

</html>