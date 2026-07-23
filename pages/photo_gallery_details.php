<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Album Photos — Students' Affairs Office, IISER Kolkata</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/hostel-management.css?v=<?php echo time(); ?>">

    <style>
        .gallery-details-section {
            padding: 32px 0 64px 0;
        }

        .back-nav-bar {
            margin-bottom: 24px;
        }

        .back-btn-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #0284c7;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            transition: color 0.2s ease;
        }

        .back-btn-link:hover {
            color: #0369a1;
        }

        .photos-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 20px;
        }

        .photo-card {
            position: relative;
            border-radius: 10px;
            overflow: hidden;
            background: #0f172a;
            aspect-ratio: 4/3;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .photo-card-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .photo-card-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(15, 23, 42, 0.82) 0%, transparent 60%);
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            padding: 16px;
            opacity: 0;
            transition: opacity 0.2s ease;
        }

        .photo-card:hover .photo-card-overlay {
            opacity: 1;
        }

        .photo-card-zoom-icon {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.9);
            color: #0f172a;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.95rem;
        }

        /* Lightbox Modal */
        .lightbox-modal {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            width: 100vw;
            height: 100vh;
            height: 100dvh;
            z-index: 9999;
            background: rgba(10, 15, 29, 0.97);
            display: flex;
            flex-direction: column;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.2s ease;
            overflow: hidden;
            box-sizing: border-box;
        }

        .lightbox-modal.active {
            opacity: 1;
            pointer-events: auto;
        }

        /* Floating Top Left Info */
        .lightbox-top-left {
            position: absolute;
            top: 20px;
            left: 24px;
            z-index: 100;
            background: rgba(15, 23, 42, 0.85);
            padding: 10px 18px;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.15);
            max-width: 60%;
            box-sizing: border-box;
        }

        .lightbox-title-text {
            font-size: 1.05rem;
            font-weight: 700;
            color: #ffffff;
            margin: 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .lightbox-counter {
            font-size: 0.8rem;
            color: #fbbf24;
            margin-top: 2px;
            font-weight: 600;
        }

        /* Floating Top Right Close Button */
        .lightbox-close-btn {
            position: absolute;
            top: 20px;
            right: 24px;
            z-index: 100;
            background: rgba(15, 23, 42, 0.85);
            border: 1px solid rgba(255, 255, 255, 0.15);
            color: #ffffff;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            font-size: 1.3rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.15s, transform 0.15s;
        }

        .lightbox-close-btn:hover {
            background: #ef4444;
            border-color: #ef4444;
            transform: scale(1.08);
        }

        .lightbox-body {
            flex: 1;
            min-height: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 70px 24px 16px 24px;
            position: relative;
            width: 100%;
            box-sizing: border-box;
            overflow: hidden;
        }

        /* Instant Render Image */
        .lightbox-main-img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            border-radius: 8px;
            box-shadow: 0 16px 40px rgba(0, 0, 0, 0.6);
        }

        .lightbox-nav-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(15, 23, 42, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.15);
            color: #ffffff;
            width: 52px;
            height: 52px;
            border-radius: 50%;
            font-size: 1.3rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.15s, transform 0.15s;
            z-index: 10;
        }

        .lightbox-nav-btn.prev-btn {
            left: 24px;
        }

        .lightbox-nav-btn.next-btn {
            right: 24px;
        }

        .lightbox-nav-btn:hover {
            background: var(--gold-500);
            border-color: var(--gold-500);
            color: #0f172a;
            transform: translateY(-50%) scale(1.08);
        }

        .lightbox-thumbnails {
            flex-shrink: 0;
            display: flex;
            gap: 10px;
            padding: 12px 24px;
            overflow-x: auto;
            overflow-y: hidden;
            justify-content: center;
            align-items: center;
            background: rgba(0, 0, 0, 0.4);
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            width: 100%;
            box-sizing: border-box;
        }

        .lightbox-thumb {
            width: 56px;
            height: 56px;
            border-radius: 6px;
            object-fit: cover;
            cursor: pointer;
            opacity: 0.5;
            border: 2px solid transparent;
            transition: opacity 0.15s, border-color 0.15s;
            flex-shrink: 0;
        }

        .lightbox-thumb.active,
        .lightbox-thumb:hover {
            opacity: 1;
            border-color: #fbbf24;
        }

        @media (max-width: 768px) {
            .lightbox-top-left {
                top: 12px;
                left: 12px;
                padding: 8px 14px;
                max-width: calc(100% - 70px);
            }
            .lightbox-close-btn {
                top: 12px;
                right: 12px;
                width: 38px;
                height: 38px;
                font-size: 1.1rem;
            }
            .lightbox-nav-btn {
                width: 42px;
                height: 42px;
                font-size: 1.1rem;
            }
            .lightbox-nav-btn.prev-btn { left: 12px; }
            .lightbox-nav-btn.next-btn { right: 12px; }
            .lightbox-body { padding: 60px 12px 12px 12px; }
            .lightbox-thumb { width: 44px; height: 44px; }
        }
    </style>
</head>

<body>

    <a href="#main" class="skip-link">Skip to main content</a>

    <?php include __DIR__ . '/../components/navbar.php'; ?>

    <div id="mobile-drawer-placeholder"></div>

    <main id="main">

        <!-- ============ PAGE HERO ============ -->
        <section class="page-hero page-hero-banner">
            <div class="container page-hero-inner">
                <nav class="breadcrumb" aria-label="Breadcrumb">
                    <a href="../index.html">Home</a>
                    <i class="fa-solid fa-chevron-right" style="font-size: 0.6rem;"></i>
                    <a href="photo_gallery.php">Photo Gallery</a>
                    <i class="fa-solid fa-chevron-right" style="font-size: 0.6rem;"></i>
                    <span id="heroAlbumTitle">Album</span>
                </nav>
                <h1 class="hero-title" id="pageTitle">Album Photos</h1>
                <p class="lede hero-subtitle" id="pageSubtitle">Browse photos from this album.</p>
            </div>
        </section>

        <!-- ============ GALLERY PHOTOS GRID ============ -->
        <section class="section gallery-details-section">
            <div class="container">
                <div class="back-nav-bar">
                    <a href="photo_gallery.php" class="back-btn-link">
                        <i class="fa-solid fa-arrow-left"></i> Back to All Photo Galleries
                    </a>
                </div>

                <div class="photos-grid" id="photosGrid">
                    <div style="grid-column: 1/-1; text-align: center; padding: 64px 0;">
                        <i class="fa-solid fa-circle-notch fa-spin" style="font-size: 3rem; color: var(--gold-500);"></i>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <!-- ============ LIGHTBOX MODAL ============ -->
    <div class="lightbox-modal" id="lightboxModal" role="dialog" aria-modal="true">
        <!-- Floating Top Left Title & Counter -->
        <div class="lightbox-top-left">
            <h3 class="lightbox-title-text" id="lbAlbumTitle">Album</h3>
            <div class="lightbox-counter" id="lbCounter">Photo 1 of 1</div>
        </div>

        <!-- Floating Top Right Close Button -->
        <button class="lightbox-close-btn" id="lbCloseBtn" aria-label="Close image viewer">
            <i class="fa-solid fa-xmark"></i>
        </button>

        <div class="lightbox-body">
            <button class="lightbox-nav-btn prev-btn" id="lbPrevBtn" aria-label="Previous photo">
                <i class="fa-solid fa-chevron-left"></i>
            </button>
            <img class="lightbox-main-img" id="lbMainImg" src="" alt="Gallery Image" decoding="async">
            <button class="lightbox-nav-btn next-btn" id="lbNextBtn" aria-label="Next photo">
                <i class="fa-solid fa-chevron-right"></i>
            </button>
        </div>

        <div class="lightbox-thumbnails" id="lbThumbnails">
            <!-- Dynamic thumbnails -->
        </div>
    </div>

    <?php include __DIR__ . '/../components/footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="../layout/include.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const urlParams = new URLSearchParams(window.location.search);
            const galleryId = urlParams.get('id');

            if (!galleryId) {
                window.location.href = 'photo_gallery.php';
                return;
            }

            let galleryData = null;
            let albumImages = [];
            let currentImageIndex = 0;
            const preloadedCache = new Set();

            // Fetch album images for this gallery
            $.ajax({
                url: `../api/public_gallery.php?action=get_gallery_images&gallery_id=${galleryId}`,
                type: 'GET',
                dataType: 'json'
            }).done(res => {
                const grid = $('#photosGrid');
                grid.empty();

                if (res.success && res.gallery) {
                    galleryData = res.gallery;
                    albumImages = res.images || [];

                    $('#heroAlbumTitle').text(galleryData.title);
                    $('#pageTitle').text(galleryData.title);
                    $('#pageSubtitle').html(`${albumImages.length} ${albumImages.length === 1 ? 'photo' : 'photos'} in this album`);

                    if (albumImages.length > 0) {
                        albumImages.forEach((imgObj, idx) => {
                            const cardHTML = `
                                <div class="photo-card" onclick="openLightbox(${idx})">
                                    <img class="photo-card-img" src="${imgObj.image_path}" alt="${galleryData.title}" loading="lazy" decoding="async">
                                    <div class="photo-card-overlay">
                                        <span style="color: #ffffff; font-size: 0.85rem; font-weight: 600;">Photo ${idx + 1}</span>
                                        <div class="photo-card-zoom-icon">
                                            <i class="fa-solid fa-expand"></i>
                                        </div>
                                    </div>
                                </div>
                            `;
                            grid.append(cardHTML);
                        });

                        // Pre-cache ALL photos in parallel in memory background
                        preloadAllPhotos();
                    } else {
                        grid.html(`
                            <div style="grid-column: 1/-1; text-align: center; padding: 64px 0; color: #64748b;">
                                <i class="fa-solid fa-images" style="font-size: 3rem; margin-bottom: 12px; opacity: 0.4;"></i>
                                <p style="margin: 0; font-size: 1.1rem;">No photos found in this album.</p>
                            </div>
                        `);
                    }

                } else {
                    grid.html(`
                        <div style="grid-column: 1/-1; text-align: center; padding: 64px 0; color: #ef4444;">
                            <p style="margin: 0; font-size: 1.1rem;">Gallery not found.</p>
                        </div>
                    `);
                }
            }).fail(err => {
                console.error("Failed to load album photos:", err);
                $('#photosGrid').html(`
                    <div style="grid-column: 1/-1; text-align: center; padding: 64px 0; color: #ef4444;">
                        <p style="margin: 0; font-size: 1.1rem;">Failed to load photos. Please try again later.</p>
                    </div>
                `);
            });

            function preloadAllPhotos() {
                albumImages.forEach(imgObj => {
                    const src = imgObj.image_path;
                    if (src && !preloadedCache.has(src)) {
                        preloadedCache.add(src);
                        const img = new Image();
                        img.src = src;
                    }
                });
            }

            // LIGHTBOX MODAL HANDLERS
            const modal = document.getElementById("lightboxModal");
            const lbMainImg = document.getElementById("lbMainImg");
            const lbAlbumTitle = document.getElementById("lbAlbumTitle");
            const lbCounter = document.getElementById("lbCounter");
            const lbThumbnails = document.getElementById("lbThumbnails");

            window.openLightbox = function (idx) {
                if (!albumImages || albumImages.length === 0) return;
                currentImageIndex = idx;

                lbAlbumTitle.textContent = galleryData.title;
                renderThumbnailsOnce();
                changeImage(currentImageIndex);

                modal.classList.add("active");
                document.body.style.overflow = "hidden";
            };

            function closeModal() {
                modal.classList.remove("active");
                document.body.style.overflow = "";
            }

            function renderThumbnailsOnce() {
                lbThumbnails.innerHTML = '';
                albumImages.forEach((imgObj, idx) => {
                    const thumb = document.createElement('img');
                    thumb.src = imgObj.image_path;
                    thumb.loading = "lazy";
                    thumb.decoding = "async";
                    thumb.className = `lightbox-thumb ${idx === currentImageIndex ? 'active' : ''}`;
                    thumb.onclick = (e) => {
                        e.stopPropagation();
                        changeImage(idx);
                    };
                    lbThumbnails.appendChild(thumb);
                });
            }

            function changeImage(newIndex) {
                const totalImgs = albumImages.length;
                if (totalImgs === 0) return;

                if (newIndex < 0) newIndex = totalImgs - 1;
                if (newIndex >= totalImgs) newIndex = 0;

                const oldIndex = currentImageIndex;
                currentImageIndex = newIndex;

                const currentObj = albumImages[currentImageIndex];
                lbMainImg.src = currentObj.image_path;
                lbCounter.textContent = `Photo ${currentImageIndex + 1} of ${totalImgs}`;

                // Instant thumbnail active class switch
                const thumbs = lbThumbnails.querySelectorAll('.lightbox-thumb');
                if (thumbs.length > 0) {
                    if (thumbs[oldIndex]) thumbs[oldIndex].classList.remove('active');
                    if (thumbs[currentImageIndex]) {
                        thumbs[currentImageIndex].classList.add('active');
                        thumbs[currentImageIndex].scrollIntoView({ behavior: 'auto', inline: 'center', block: 'nearest' });
                    }
                }
            }

            document.getElementById("lbCloseBtn").addEventListener("click", closeModal);
            modal.addEventListener("click", e => {
                if (e.target === modal) closeModal();
            });

            document.getElementById("lbPrevBtn").addEventListener("click", e => {
                e.stopPropagation();
                changeImage(currentImageIndex - 1);
            });

            document.getElementById("lbNextBtn").addEventListener("click", e => {
                e.stopPropagation();
                changeImage(currentImageIndex + 1);
            });

            // Instant Keyboard Navigation
            document.addEventListener("keydown", e => {
                if (!modal.classList.contains("active")) return;
                if (e.key === "Escape") closeModal();
                if (e.key === "ArrowLeft") {
                    e.preventDefault();
                    changeImage(currentImageIndex - 1);
                }
                if (e.key === "ArrowRight") {
                    e.preventDefault();
                    changeImage(currentImageIndex + 1);
                }
            });
        });
    </script>
</body>

</html>
