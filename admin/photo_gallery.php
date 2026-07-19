<?php
/**
 * SiSAS-IITG Admin — Photo Gallery Management
 */

require_once '../api/admin_auth.php';
requireAdmin('login.html');
require_once __DIR__ . '/../php_utils/_dbConnect.php';

$adminEmail   = isset($_SESSION['admin_email']) ? $_SESSION['admin_email'] : 'admin@iitg.ac.in';
$adminDisplay = ucfirst(explode('@', $adminEmail)[0]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photo Gallery Management &mdash; SiSAS-IITG Admin</title>
    
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
    
    <!-- Homepage Banners Stylesheet (Reused for Gallery images layout) -->
    <link rel="stylesheet" href="../dist/css/admin/homepage_banners.css">

    <style>
        .header-back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--text-muted);
            text-decoration: none;
            font-weight: 600;
            margin-bottom: 15px;
            transition: color 0.2s;
            cursor: pointer;
        }
        .header-back-link:hover {
            color: var(--accent-blue);
        }


        
        /* Custom Button Styles for Gallery Form */
        #submitGalleryBtn {
            background-color: #27ae60;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            font-weight: 600;
            font-size: 0.95rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }
        #submitGalleryBtn:hover {
            background-color: #219653;
        }
        #cancelGalleryFormBtn {
            background-color: #f8f9fa;
            color: #333;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 10px 20px;
            font-weight: 600;
            font-size: 0.95rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }
        #cancelGalleryFormBtn:hover {
            background-color: #e2e8f0;
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

                <!-- VIEW 1: GALLERIES LIST -->
                <div id="viewGalleries">
                    <div class="page-header" style="margin-bottom: 30px;">
                        <div class="page-header-left">
                            <h1><i class="fa-solid fa-images" style="color:var(--accent-blue);margin-right:10px;font-size:1.5rem;"></i> Photo Galleries</h1>
                            <p>Manage photo galleries and their images.</p>
                        </div>
                        <button class="btn-primary-action" id="toggleAddGalleryBtn">
                            <i class="fa-solid fa-plus"></i> Add New Gallery
                        </button>
                    </div>

                    <!-- Gallery Form Card -->
                    <div class="form-card" id="galleryFormCard">
                        <div class="form-card-header" style="border-bottom: 1px solid rgba(0,0,0,0.05); padding-bottom: 15px; margin-bottom: 15px;">
                            <h3 id="galleryFormTitle" style="color: #1f2937; font-size: 1.25rem;"><i class="fa-solid fa-folder-plus" style="color:#27ae60;"></i> Add New Gallery</h3>
                            <button class="btn-close-form" id="closeGalleryFormBtn" title="Close form" style="color: #6b7280; font-size: 1.2rem; background: none; border: none; cursor: pointer;">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                        <div class="form-card-body">
                            <form id="galleryForm" enctype="multipart/form-data">
                                <input type="hidden" name="action" value="save_gallery">
                                <input type="hidden" name="id" id="galleryId" value="0">
                                
                                <div class="form-grid" style="margin-bottom: 25px;">
                                    <div class="form-group full-width">
                                        <label class="form-label" for="galleryTitle" style="font-weight: 700; color: #374151;">Gallery Title *</label>
                                        <input type="text" name="title" id="galleryTitle" class="form-control" required placeholder="e.g. Convocation 2026" style="padding: 10px; border-radius: 6px; border: 1px solid #d1d5db;">
                                    </div>
                                </div>
                                
                                <!-- Image Drop Zone -->
                                <div class="image-drop-zone" id="imageDropZone" style="margin-bottom: 25px;">
                                    <input type="file" name="images[]" id="galleryImageInput" accept="image/jpeg,image/jpg,image/png,image/webp,image/gif" multiple>
                                    <div class="drop-zone-icon"><i class="fa-solid fa-cloud-arrow-up"></i></div>
                                    <p class="drop-zone-title">Drag &amp; drop images here</p>
                                    <p class="drop-zone-sub">or click to browse &mdash; JPEG, PNG, WebP, GIF</p>
                                    <div class="drop-zone-preview" id="dropZonePreview" style="display:none; flex-wrap:wrap; gap:15px; justify-content:center; margin-top:20px;"></div>
                                </div>
                                
                                <div class="form-submit-row" style="display: flex; gap: 15px;">
                                    <button type="submit" id="submitGalleryBtn">
                                        <i class="fa-solid fa-check"></i> Save Gallery
                                    </button>
                                    <button type="button" id="cancelGalleryFormBtn">
                                        <i class="fa-solid fa-xmark"></i> Cancel
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Galleries List Card -->
                    <div class="banners-list-card">
                        <div class="banners-list-header">
                            <h3>
                                <i class="fa-solid fa-layer-group"></i>
                                All Galleries
                                <span class="banners-count-badge" id="galleriesCountBadge">0</span>
                            </h3>
                        </div>
                        <div class="banners-grid" id="galleriesGrid">
                            <!-- Loaded via JS -->
                        </div>
                    </div>
                </div>

                <!-- VIEW 2: MANAGE IMAGES -->
                <div id="viewImages" style="display: none;">
                    <a class="header-back-link" id="backToGalleriesBtn"><i class="fa-solid fa-arrow-left"></i> Back to Galleries</a>
                    
                    <div class="page-header" style="margin-bottom: 30px;">
                        <div class="page-header-left">
                            <h1><i class="fa-solid fa-images" style="color:var(--accent-emerald);margin-right:10px;font-size:1.5rem;"></i> Manage Images</h1>
                            <p>Gallery: <strong id="currentGalleryTitle">Loading...</strong></p>
                        </div>
                        <div style="display: flex; gap: 10px;">
                            <button class="btn-primary-action" id="toggleAddImagesBtn" style="background-color: #3b82f6;">
                                <i class="fa-solid fa-upload"></i> Add Images
                            </button>
                            <button class="btn-primary-action" id="deleteAllImagesBtn" style="background-color: #fff0f0; color: #ef4444; border: 1px solid rgba(239,68,68,0.2);">
                                <i class="fa-solid fa-trash-can"></i> Delete All
                            </button>
                        </div>
                    </div>

                    <!-- Upload Section -->
                    <div class="form-card" id="addImagesFormCard">
                        <div class="form-card-header">
                            <h3><i class="fa-solid fa-upload"></i> Upload Images</h3>
                            <button class="btn-close-form" id="closeImagesFormBtn" title="Close form">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                        <div class="form-card-body">
                            <form id="uploadImagesForm" enctype="multipart/form-data">
                                <input type="hidden" name="action" value="upload_images">
                                <input type="hidden" name="gallery_id" id="uploadGalleryId" value="0">
                                
                                <div class="image-drop-zone" id="uploadImageDropZone" style="margin-bottom: 25px;">
                                    <input type="file" name="images[]" id="uploadImageInput" accept="image/jpeg,image/jpg,image/png,image/webp,image/gif" multiple required>
                                    <div class="drop-zone-icon"><i class="fa-solid fa-cloud-arrow-up"></i></div>
                                    <p class="drop-zone-title">Drag &amp; drop images here</p>
                                    <p class="drop-zone-sub">or click to browse &mdash; JPEG, PNG, WebP, GIF</p>
                                    <div class="drop-zone-preview" id="uploadDropZonePreview" style="display:none; flex-wrap:wrap; gap:15px; justify-content:center; margin-top:20px;"></div>
                                </div>
                                
                                <div class="form-submit-row">
                                    <button type="submit" class="btn-submit" id="submitImagesBtn">
                                        <i class="fa-solid fa-cloud-arrow-up"></i> Upload Images
                                    </button>
                                    <button type="button" class="btn-cancel" id="cancelImagesFormBtn">
                                        <i class="fa-solid fa-xmark"></i> Cancel
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Images Grid -->
                    <div class="banners-list-card">
                        <div class="banners-list-header">
                            <h3>
                                <i class="fa-solid fa-layer-group"></i>
                                All Images
                                <span class="banners-count-badge" id="imagesCountBadge">0</span>
                            </h3>
                        </div>

                        <div class="banners-grid" id="imagesGrid">
                            <!-- Loaded via JS -->
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>

    <!-- Toast Notifications -->
    <div id="toastContainer" class="toast-container"></div>

    <!-- Lightbox Modal -->
    <div class="lightbox-modal" id="imageLightbox" role="dialog" aria-modal="true">
        <button class="lightbox-close" id="closeLightboxBtn">&times;</button>
        <img class="lightbox-content" id="lightboxImage" src="" alt="Enlarged View">
        <div class="lightbox-caption" id="lightboxCaption"></div>
    </div>

    <script>
        $(document).ready(function() {
            $('#sidebarToggleBtn, #sidebarOverlay').on('click', function() {
                $('#adminSidebar').toggleClass('active');
                $('#sidebarOverlay').toggleClass('active');
            });
        });

        const API_URL = '../api/photo_gallery.php';
        let currentGalleryId = 0;
        let galleriesData = [];

        // --- GALLERIES LOGIC ---

        function loadGalleries() {
            $.getJSON(API_URL, { action: 'get_galleries' }, function(res) {
                if(res.success) {
                    galleriesData = res.data;
                    renderGalleries();
                } else {
                    showToast('error', 'Failed to load galleries.');
                }
            });
        }

        let shuffleIntervals = [];

        function renderGalleries() {
            shuffleIntervals.forEach(clearInterval);
            shuffleIntervals = [];
            
            const container = $('#galleriesGrid');
            container.empty();

            $('#galleriesCountBadge').text(galleriesData.length);

            if(galleriesData.length === 0) {
                container.html(`
                    <div class="banners-empty-state">
                        <i class="fa-solid fa-images"></i>
                        <p>No galleries found</p>
                        <small>Click "Add New Gallery" to get started.</small>
                    </div>
                `);
                return;
            }

            galleriesData.forEach(g => {
                const coverSrc = g.cover_image ? g.cover_image : '';
                const imagesJson = g.images ? JSON.stringify(g.images).replace(/"/g, '&quot;') : '[]';
                
                const coverHtml = coverSrc 
                    ? `<img src="${coverSrc}" class="shuffling-img" data-images="${imagesJson}" data-index="0" alt="Cover" loading="lazy" draggable="false" style="cursor:pointer; opacity:1; transition: opacity 0.3s ease, transform 0.4s ease;" onclick="openGallery(${g.id})">` 
                    : `<div style="width:100%; height:100%; background:#f1f5f9; display:flex; align-items:center; justify-content:center; color:#cbd5e1; font-size:3rem; cursor:pointer;" onclick="openGallery(${g.id})"><i class="fa-solid fa-image"></i></div>`;

                const card = $(`
                    <div class="banner-item-card" data-id="${g.id}">
                        <div class="banner-thumbnail-wrap">
                            ${coverHtml}
                            <span style="position: absolute; top: 0; right: 0; background: rgba(0,0,0,0.7); color: #fff; padding: 8px 16px; font-size: 0.85rem; font-weight: 700; border-radius: 0 0 0 16px; z-index: 2; display: flex; align-items: center; gap: 6px;">
                                <i class="fa-solid fa-image"></i> ${g.image_count} Images
                            </span>
                        </div>
                        <div class="banner-card-body">
                            <div class="banner-card-title">${escapeHtml(g.title)}</div>
                            <div class="banner-card-actions">
                                <button class="banner-action-btn toggle-btn is-active" onclick="openGallery(${g.id})" title="Manage Images">
                                    <i class="fa-solid fa-images"></i> Manage
                                </button>
                                <button class="banner-action-btn edit-btn" onclick="editGallery(${g.id})" title="Edit Gallery">
                                    <i class="fa-solid fa-pen"></i> Edit
                                </button>
                                <button class="banner-action-btn delete-btn" onclick="deleteGallery(${g.id})" title="Delete Gallery">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                `);
                container.append(card);
            });

            // Initialize shuffle intervals
            $('.shuffling-img').each(function() {
                const imagesStr = $(this).attr('data-images');
                if (imagesStr) {
                    try {
                        const images = JSON.parse(imagesStr);
                        if (images && images.length > 1) {
                            const imgEl = $(this);
                            const interval = setInterval(() => {
                                let idx = parseInt(imgEl.attr('data-index'));
                                idx = (idx + 1) % images.length;
                                imgEl.attr('data-index', idx);
                                imgEl.css('opacity', 0);
                                setTimeout(() => {
                                    imgEl.attr('src', images[idx]);
                                    imgEl.css('opacity', 1);
                                }, 300);
                            }, 5000);
                            shuffleIntervals.push(interval);
                        }
                    } catch(e) {
                        console.error('Error parsing shuffling images', e);
                    }
                }
            });
        }

        function escapeHtml(str) {
            return $('<div>').text(str).html();
        }

        // Add/Edit Gallery Form
        $('#toggleAddGalleryBtn').click(function() {
            if ($('#galleryFormCard').hasClass('visible')) {
                closeGalleryForm();
            } else {
                $('#imageDropZone').show();
                $('#galleryFormCard').addClass('visible');
                $('#galleryFormTitle').html('<i class="fa-solid fa-folder-plus" style="color:#27ae60;"></i> Add New Gallery');
            }
        });

        $('#closeGalleryFormBtn, #cancelGalleryFormBtn').click(closeGalleryForm);

        function openGalleryForm(title) {
            $('#galleryFormTitle').html(`<i class="fa-solid fa-folder-plus" style="color:#27ae60;"></i> ${title}`);
            $('#galleryFormCard').addClass('visible');
        }

        function closeGalleryForm() {
            $('#galleryFormCard').removeClass('visible');
            $('#galleryForm')[0].reset();
            $('#galleryId').val('0');
            resetFormImagePreview();
        }

        window.editGallery = function(id) {
            const g = galleriesData.find(x => x.id == id);
            if(!g) return;
            $('#galleryId').val(g.id);
            $('#galleryTitle').val(g.title);
            $('#imageDropZone').hide();
            $('#galleryFormCard').addClass('visible');
            $('#galleryFormTitle').html('<i class="fa-solid fa-pen" style="color:var(--accent-blue);"></i> Edit Gallery');
            $('.main-panel').animate({ scrollTop: 0 }, 300);
        };

        window.deleteGallery = function(id) {
            if(!confirm('Are you sure you want to delete this gallery? All images inside it will be permanently deleted.')) return;
            $.post(API_URL, { action: 'delete_gallery', id: id }, function(res) {
                if(res.success) {
                    showToast('success', res.message);
                    loadGalleries();
                } else {
                    showToast('error', res.message);
                }
            }, 'json');
        };

        $('#galleryForm').submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            const btn = $('#submitGalleryBtn');
            const orig = btn.html();
            btn.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin"></i> Saving...');

            $.ajax({
                url: API_URL, type: 'POST', data: fd, processData: false, contentType: false, dataType: 'json',
                success: function(res) {
                    if(res.success) {
                        showToast('success', res.message);
                        closeGalleryForm();
                        loadGalleries();
                    } else {
                        showToast('error', res.message);
                    }
                },
                complete: function() { btn.prop('disabled', false).html(orig); }
            });
        });

        // --- IMAGES LOGIC ---

        window.openGallery = function(id) {
            currentGalleryId = id;
            $('#uploadGalleryId').val(id);
            $('#viewGalleries').hide();
            $('#viewImages').fadeIn();
            
            // Set title temporarily
            const g = galleriesData.find(x => x.id == id);
            $('#currentGalleryTitle').text(g ? g.title : 'Loading...');
            
            loadImages();
            $('.main-panel').animate({ scrollTop: 0 }, 300);
        };

        $('#backToGalleriesBtn').click(function() {
            $('#viewImages').hide();
            $('#viewGalleries').fadeIn();
            loadGalleries(); // refresh to get updated cover/counts
            closeImagesForm();
        });

        function loadImages() {
            $.getJSON(API_URL, { action: 'get_images', gallery_id: currentGalleryId }, function(res) {
                const container = $('#imagesGrid');
                container.empty();

                if (!res.success) {
                    showToast('error', 'Failed to load images.');
                    return;
                }

                if (res.gallery_title) {
                    $('#currentGalleryTitle').text(res.gallery_title);
                }
                
                $('#imagesCountBadge').text(res.data.length);

                if (res.data.length === 0) {
                    container.html(`
                        <div class="banners-empty-state">
                            <i class="fa-solid fa-images"></i>
                            <p>No images yet</p>
                            <small>Click "Upload Images" to add your first image.</small>
                        </div>
                    `);
                    return;
                }

                res.data.forEach((img, index) => {
                    const imgSrc = '../' + img.image_path;
                    const card = $(`
                        <div class="banner-item-card" data-id="${img.id}" style="border: none; background: transparent; box-shadow: none;">
                            <div class="banner-thumbnail-wrap" style="height: 240px; cursor: pointer; border-radius: 14px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                                <div class="banner-reorder-controls">
                                    <button type="button" class="reorder-btn move-up-btn" title="Move Left/Up"><i class="fa-solid fa-chevron-left"></i></button>
                                    <button type="button" class="reorder-btn move-down-btn" title="Move Right/Down"><i class="fa-solid fa-chevron-right"></i></button>
                                </div>
                                <span class="banner-order-badge">${index + 1}</span>
                                <img src="${imgSrc}" style="height: 100%; object-fit: cover; width: 100%;">
                                
                                <button onclick="deleteImage(${img.id})" title="Delete image" style="position: absolute; bottom: 12px; right: 12px; background: rgba(255, 255, 255, 0.95); color: #ef4444; border: none; padding: 8px 14px; border-radius: 8px; font-size: 0.85rem; font-weight: 700; cursor: pointer; box-shadow: 0 2px 8px rgba(0,0,0,0.15); transition: all 0.2s ease;" onmouseover="this.style.background='#ef4444'; this.style.color='#fff';" onmouseout="this.style.background='rgba(255, 255, 255, 0.95)'; this.style.color='#ef4444';">
                                    <i class="fa-solid fa-trash"></i> Delete
                                </button>
                            </div>
                        </div>
                    `);
                    container.append(card);
                });

                // Enable drag-and-drop reordering
                container.sortable({
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
                        saveImageOrder();
                        updateOrderBadges();
                        refreshReorderButtons();
                    }
                });
                refreshReorderButtons();
            });
        }

        // Upload Logic
        let selectedFiles = [];
        function resetFormImagePreview() {
            selectedFiles = [];
            $('#galleryImageInput').val('');
            $('#dropZonePreview').hide().empty();
            $('.drop-zone-icon, .drop-zone-title, .drop-zone-sub').show();
        }

        function renderPreviews() {
            const $preview = $('#dropZonePreview');
            $preview.empty();
            if (selectedFiles.length === 0) {
                resetFormImagePreview();
                return;
            }

            $('.drop-zone-icon, .drop-zone-title').hide();
            $('.drop-zone-sub').show();
            $preview.css('display', 'flex');

            selectedFiles.forEach((fileObj, index) => {
                const thumbnailSrc = fileObj.src || '../dist/img/iitg-logo.png';
                const fileName = escapeHtml(fileObj.file.name);

                const card = $(`
                    <div class="preview-item valid">
                        <button type="button" class="preview-remove-btn" data-index="${index}" title="Remove">&times;</button>
                        <img src="${thumbnailSrc}" alt="Preview">
                        <span class="preview-name" title="${fileName}">${fileName}</span>
                        <span class="preview-info success">${escapeHtml(fileObj.info)}</span>
                    </div>
                `);
                $preview.append(card);
            });
        }

        $('#galleryImageInput').on('change', function() {
            const files = Array.from(this.files);
            selectedFiles = [];
            
            if (files.length === 0) {
                renderPreviews();
                return;
            }

            let filesProcessed = 0;
            files.forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    selectedFiles.push({
                        file: file,
                        src: e.target.result,
                        info: (file.size / 1024 / 1024).toFixed(2) + ' MB'
                    });
                    filesProcessed++;
                    if (filesProcessed === files.length) renderPreviews();
                };
                reader.onerror = function() {
                    filesProcessed++;
                    if (filesProcessed === files.length) renderPreviews();
                };
                reader.readAsDataURL(file);
            });
        });

        $(document).on('click', '.preview-remove-btn', function(e) {
            e.stopPropagation();
            const index = $(this).data('index');
            selectedFiles.splice(index, 1);
            
            const dt = new DataTransfer();
            selectedFiles.forEach(f => dt.items.add(f.file));
            $('#galleryImageInput')[0].files = dt.files;
            
            renderPreviews();
        });

        // Upload Images logic
        $('#toggleAddImagesBtn').click(function() {
            if ($('#addImagesFormCard').hasClass('visible')) {
                closeImagesForm();
            } else {
                $('#addImagesFormCard').hide().addClass('visible').slideDown(300);
            }
        });
        $('#closeImagesFormBtn, #cancelImagesFormBtn').click(closeImagesForm);

        function closeImagesForm() {
            $('#addImagesFormCard').slideUp(300, function() {
                $(this).removeClass('visible').css('display', '');
                $('#uploadImagesForm')[0].reset();
                resetUploadFormImagePreview();
            });
        }

        $('#uploadImagesForm').submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            const btn = $('#submitImagesBtn');
            const orig = btn.html();
            btn.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin"></i> Uploading...');

            $.ajax({
                url: API_URL, type: 'POST', data: fd, processData: false, contentType: false, dataType: 'json',
                success: function(res) {
                    if(res.success) {
                        showToast('success', res.message);
                        closeImagesForm();
                        loadImages();
                    } else {
                        showToast('error', res.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error:", xhr.responseText);
                    showToast('error', 'Server Error: ' + error + '. Please check console.');
                },
                complete: function() { btn.prop('disabled', false).html(orig); }
            });
        });

        // Delete All Images logic
        $('#deleteAllImagesBtn').click(function() {
            if (!confirm('Are you sure you want to delete ALL images in this gallery? This action cannot be undone.')) return;
            const btn = $(this);
            const orig = btn.html();
            btn.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin"></i> Deleting...');

            $.post(API_URL, { action: 'delete_all_images', gallery_id: currentGalleryId }, function(res) {
                if(res.success) {
                    showToast('success', res.message);
                    loadImages();
                } else {
                    showToast('error', res.message);
                }
            }, 'json').always(function() {
                btn.prop('disabled', false).html(orig);
            });
        });

        // Upload Preview Logic for Manage Images
        let uploadSelectedFiles = [];
        function resetUploadFormImagePreview() {
            uploadSelectedFiles = [];
            $('#uploadImageInput').val('');
            $('#uploadDropZonePreview').hide().empty();
            $('#uploadImageDropZone .drop-zone-icon, #uploadImageDropZone .drop-zone-title, #uploadImageDropZone .drop-zone-sub').show();
        }

        function renderUploadPreviews() {
            const $preview = $('#uploadDropZonePreview');
            $preview.empty();
            if (uploadSelectedFiles.length === 0) {
                resetUploadFormImagePreview();
                return;
            }

            $('#uploadImageDropZone .drop-zone-icon, #uploadImageDropZone .drop-zone-title').hide();
            $('#uploadImageDropZone .drop-zone-sub').show();
            $preview.css('display', 'flex');

            uploadSelectedFiles.forEach((fileObj, index) => {
                const thumbnailSrc = fileObj.src || '../dist/img/iitg-logo.png';
                const fileName = escapeHtml(fileObj.file.name);

                const card = $(`
                    <div class="preview-item valid">
                        <button type="button" class="preview-remove-btn upload-preview-remove-btn" data-index="${index}" title="Remove">&times;</button>
                        <img src="${thumbnailSrc}" alt="Preview">
                        <span class="preview-name" title="${fileName}">${fileName}</span>
                        <span class="preview-info success">${escapeHtml(fileObj.info)}</span>
                    </div>
                `);
                $preview.append(card);
            });
        }

        $('#uploadImageInput').on('change', function() {
            const files = Array.from(this.files);
            uploadSelectedFiles = [];
            
            if (files.length === 0) {
                renderUploadPreviews();
                return;
            }

            let filesProcessed = 0;
            files.forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    uploadSelectedFiles.push({
                        file: file,
                        src: e.target.result,
                        info: (file.size / 1024 / 1024).toFixed(2) + ' MB'
                    });
                    filesProcessed++;
                    if (filesProcessed === files.length) renderUploadPreviews();
                };
                reader.onerror = function() {
                    filesProcessed++;
                    if (filesProcessed === files.length) renderUploadPreviews();
                };
                reader.readAsDataURL(file);
            });
        });

        $(document).on('click', '.upload-preview-remove-btn', function(e) {
            e.stopPropagation();
            const index = $(this).data('index');
            uploadSelectedFiles.splice(index, 1);
            
            const dt = new DataTransfer();
            uploadSelectedFiles.forEach(f => dt.items.add(f.file));
            $('#uploadImageInput')[0].files = dt.files;
            
            renderUploadPreviews();
        });

        // Reordering & Delete Images
        function updateOrderBadges() {
            $('#imagesGrid .banner-item-card').each(function(idx) {
                $(this).find('.banner-order-badge').text(idx + 1);
            });
        }
        function refreshReorderButtons() {
            var $cards = $('#imagesGrid .banner-item-card');
            $cards.find('.reorder-btn').prop('disabled', false);
            $cards.first().find('.move-up-btn').prop('disabled', true);
            $cards.last().find('.move-down-btn').prop('disabled', true);
        }
        function saveImageOrder() {
            var order = [];
            $('#imagesGrid .banner-item-card').each(function() {
                order.push($(this).data('id'));
            });
            $.post(API_URL, { action: 'reorder_images', order: JSON.stringify(order) }, function(res) {
                if (res.success) showToast('info', 'Image order saved.');
            }, 'json');
        }

        $(document).on('click', '.move-up-btn', function(e) {
            e.stopPropagation();
            var $card = $(this).closest('.banner-item-card');
            var $prev = $card.prev('.banner-item-card');
            if ($prev.length > 0) {
                $card.insertBefore($prev);
                updateOrderBadges();
                refreshReorderButtons();
                saveImageOrder();
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
                saveImageOrder();
            }
        });

        window.deleteImage = function(id) {
            if (!confirm('Are you sure you want to delete this image?')) return;
            $.post(API_URL, { action: 'delete_image', id: id }, function(res) {
                if (res.success) {
                    showToast('success', res.message);
                    loadImages();
                } else {
                    showToast('error', res.message);
                }
            }, 'json');
        };

        // Lightbox logic (Only for images inside the Manage Images view)
        $(document).on('click', '#imagesGrid .banner-thumbnail-wrap img', function(e) {
            e.stopPropagation();
            var src = $(this).attr('src');
            openLightbox(src, 'Gallery Image');
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
            if ($(e.target).is('#imageLightbox') || $(e.target).is('#lightboxImage')) closeLightbox();
        });
        $(document).on('keydown', function(e) {
            if (e.key === 'Escape' && $('#imageLightbox').hasClass('active')) closeLightbox();
        });

        // Init
        loadGalleries();
    </script>
    <script src="../dist/js/admin_toast.js"></script>
</body>
</html>
