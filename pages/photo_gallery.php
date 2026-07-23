<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photo Gallery — Students' Affairs Office, IISER Kolkata</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/hostel-management.css?v=<?php echo time(); ?>">

    <style>
        .albums-container {
            padding: 32px 0 64px 0;
        }

        .albums-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 28px;
        }

        .album-card-link {
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .album-card {
            background: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            cursor: pointer;
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .album-media {
            position: relative;
            width: 100%;
            height: 240px;
            background: #0f172a;
            overflow: hidden;
        }

        .album-cover-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .album-count-badge {
            position: absolute;
            top: 14px;
            right: 14px;
            background: rgba(15, 23, 42, 0.85);
            color: #ffffff;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.78rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
            z-index: 2;
        }

        .album-count-badge i {
            color: #fbbf24;
        }

        .album-details {
            padding: 18px 20px;
            background: #ffffff;
            border-top: 1px solid #f1f5f9;
        }

        .album-title {
            margin: 0;
            font-size: 1.1rem;
            font-weight: 700;
            color: #0f172a;
            line-height: 1.3;
        }

        .album-meta-text {
            font-size: 0.82rem;
            color: #64748b;
            margin-top: 4px;
        }

        .album-action-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 14px;
            background: #f8fafc;
            color: #0284c7;
            border-radius: 6px;
            font-size: 0.85rem;
            font-weight: 600;
            transition: background 0.2s ease, color 0.2s ease;
            flex-shrink: 0;
            margin-left: 12px;
        }

        .album-card:hover .album-action-btn {
            background: #0284c7;
            color: #ffffff;
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
                <?php
                $breadcrumbs = [
                    ['title' => 'Home', 'url' => '../index.html'],
                    ['title' => 'Photo Gallery']
                ];
                include __DIR__ . '/../components/breadcrumb.php';
                ?>
                <h1 class="hero-title">Photo Gallery</h1>
                <p class="lede hero-subtitle">Visual highlights of student events, festivals, academic milestones, and campus life at IISER Kolkata.</p>
            </div>
        </section>

        <!-- ============ GALLERY ALBUMS LIST ============ -->
        <section class="section albums-container">
            <div class="container">
                <div class="albums-grid" id="photoGalleryGrid">
                    <!-- Dynamic rendering of galleries -->
                    <div style="grid-column: 1/-1; text-align: center; padding: 64px 0;">
                        <i class="fa-solid fa-circle-notch fa-spin" style="font-size: 3rem; color: var(--gold-500);"></i>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <?php include __DIR__ . '/../components/footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="../layout/include.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Fetch Galleries from public_gallery API
            $.ajax({
                url: '../api/public_gallery.php?action=get_photos',
                type: 'GET',
                dataType: 'json'
            }).done(res => {
                const grid = $('#photoGalleryGrid');
                grid.empty();

                if (res.success && res.galleries && res.galleries.length > 0) {
                    res.galleries.forEach(gal => {
                        const coverSrc = gal.cover_image 
                            ? gal.cover_image 
                            : 'https://placehold.co/600x400?text=No+Image';

                        const countText = gal.image_count || 0;

                        const cardHTML = `
                            <a href="photo_gallery_details.php?id=${gal.id}" class="album-card-link">
                                <div class="album-card">
                                    <div class="album-media">
                                        <img class="album-cover-img" src="${coverSrc}" alt="${gal.title}" loading="lazy" decoding="async">
                                        <div class="album-count-badge">
                                            <i class="fa-solid fa-images"></i> ${countText} ${countText === 1 ? 'Photo' : 'Photos'}
                                        </div>
                                    </div>
                                    <div class="album-details">
                                        <h3 class="album-title">${gal.title}</h3>
                                        <div class="album-meta-text">${countText} Photos &bull; Click to open album</div>
                                    </div>
                                </div>
                            </a>
                        `;
                        grid.append(cardHTML);
                    });
                } else {
                    grid.html(`
                        <div style="grid-column: 1/-1; text-align: center; padding: 64px 0; color: #64748b;">
                            <i class="fa-solid fa-images" style="font-size: 3rem; margin-bottom: 12px; opacity: 0.4;"></i>
                            <p style="margin: 0; font-size: 1.1rem;">No photo galleries available yet.</p>
                        </div>
                    `);
                }
            }).fail(err => {
                console.error("Failed to load photo galleries:", err);
                $('#photoGalleryGrid').html(`
                    <div style="grid-column: 1/-1; text-align: center; padding: 64px 0; color: #ef4444;">
                        <i class="fa-solid fa-triangle-exclamation" style="font-size: 2.5rem; margin-bottom: 12px;"></i>
                        <p style="margin: 0; font-size: 1.1rem;">Failed to load galleries. Please try again later.</p>
                    </div>
                `);
            });
        });
    </script>
</body>

</html>