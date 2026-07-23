<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Gallery — Students' Affairs Office, IISER</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700;800&family=Inter:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
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
                    ['title' => 'Video Gallery']
                ];
                include __DIR__ . '/../components/breadcrumb.php';
                ?>
                <h1 class="hero-title">Video Gallery</h1>
                <p class="lede hero-subtitle">Explore campus life, research talks, and cultural events through our videos.</p>
            </div>
        </section>

        <!-- ============ VIDEO CONTENT ============ -->
        <section class="section section-alt">
            <div class="container">
                <div class="albums-grid" id="videoGalleryGrid">
                    <!-- Dynamic rendering goes here -->
                </div>
            </div>
        </section>

    </main>

    <!-- ============ VIDEO LIGHTBOX ============ -->
    <div class="lightbox-modal" id="videoLightbox" role="dialog" aria-modal="true">
        <!-- Floating Top Left Title -->
        <div class="lightbox-top-left">
            <h3 class="lightbox-title-text" id="vlTitle">Video</h3>
        </div>

        <!-- Floating Top Right Close Button -->
        <button class="lightbox-close-btn" id="vlClose" aria-label="Close video viewer">
            <i class="fa-solid fa-xmark"></i>
        </button>

        <div class="lightbox-body" style="padding: 20px;">
            <div class="lightbox-video-container" id="vlVideoContainer" style="width: 100%; max-width: 1100px; display: flex; flex-direction: column; align-items: center; justify-content: center; box-shadow: 0 16px 50px rgba(0, 0, 0, 0.7); border-radius: 12px; overflow: hidden; background: #000; margin: auto;">
                <!-- Player gets injected here -->
            </div>
        </div>
    </div>

    <?php include __DIR__ . '/../components/footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="../layout/include.js"></script>
    <script>
        $(document).ready(function() {
            let videosData = [];

            $.ajax({
                url: '../api/public_gallery.php?action=get_videos',
                type: 'GET',
                success: function(res) {
                    const grid = $('#videoGalleryGrid');
                    grid.empty();

                    if (res.success && res.videos && res.videos.length > 0) {
                        videosData = res.videos;
                        res.videos.forEach(function(v, index) {
                            let playerHtml = '';
                            if (v.video_type === 'youtube') {
                                let videoId = '';
                                const regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|&v=)([^#&?]*).*/;
                                const match = v.video_url.match(regExp);
                                if (match && match[2].length === 11) {
                                    videoId = match[2];
                                }
                                const embedUrl = videoId ? `https://www.youtube.com/embed/${videoId}` : v.video_url;
                                playerHtml = `<iframe src="${embedUrl}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="width: 100%; height: 100%; pointer-events: none;"></iframe>`;
                            } else {
                                playerHtml = `<video style="width: 100%; height: 100%; object-fit: cover; background: #000; pointer-events: none;">
                                                  <source src="../api/stream_video.php?file=${encodeURIComponent(v.video_url)}" type="video/mp4">
                                              </video>`;
                            }

                            const html = `
                                <div class="album-card" onclick="openVideoLightbox(${index})" style="cursor: pointer;">
                                    <div class="album-media" style="position: relative;">
                                        ${playerHtml}
                                        <!-- Invisible overlay to capture clicks instead of the player -->
                                        <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; z-index: 5;"></div>
                                        <div class="album-count-badge" style="z-index: 10;">
                                            <i class="fa-solid fa-play"></i> Video
                                        </div>
                                    </div>
                                    <div class="album-details">
                                        <h3 class="album-title">${v.caption || 'Untitled Video'}</h3>
                                        <div class="album-meta-text">Click to watch video</div>
                                    </div>
                                </div>
                            `;
                            grid.append(html);
                        });
                    } else {
                        grid.html('<div style="grid-column: 1/-1; text-align: center; color: var(--grey-500); padding: 40px 0;">No videos found.</div>');
                    }
                },
                error: function() {
                    $('#videoGalleryGrid').html('<div style="grid-column: 1/-1; text-align: center; color: var(--red-600); padding: 40px 0;">Failed to load videos.</div>');
                }
            });

            // Lightbox logic
            window.openVideoLightbox = function(index) {
                const v = videosData[index];
                if (!v) return;

                const container = $('#vlVideoContainer');
                container.empty();

                if (v.video_type === 'youtube') {
                    const match = v.video_url.match(/\/embed\/([^?&]+)/);
                    let embedUrl = v.video_url;
                    if (!match && v.video_url.includes('youtube.com/watch?v=')) {
                        const idMatch = v.video_url.match(/v=([^&]+)/);
                        if (idMatch) embedUrl = `https://www.youtube.com/embed/${idMatch[1]}?autoplay=1`;
                    } else if (match) {
                        embedUrl += (embedUrl.includes('?') ? '&' : '?') + 'autoplay=1';
                    }
                    container.html(`<iframe width="100%" style="aspect-ratio: 16/9; max-height: 85vh;" src="${embedUrl}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>`);
                } else {
                    // Prepend ../ because we are in pages/
                    container.html(`<video width="100%" style="max-height: 85vh; outline: none;" controls autoplay controlsList="nodownload"><source src="../api/stream_video.php?file=${encodeURIComponent(v.video_url)}" type="video/mp4">Your browser does not support the video tag.</video>`);
                }

                $('#vlTitle').text(v.caption || 'Untitled Video');
                $('#videoLightbox').addClass('active');
                $('body').css('overflow', 'hidden');
            };

            function closeVideoLightbox() {
                $('#videoLightbox').removeClass('active');
                $('#vlVideoContainer').empty(); // Stop playing
                $('body').css('overflow', '');
            }

            $('#vlClose').click(closeVideoLightbox);
            $('#videoLightbox').click(function(e) {
                if (e.target === this || $(e.target).closest('.lightbox-body').length && !$(e.target).closest('#vlVideoContainer').length) {
                    closeVideoLightbox();
                }
            });
            $(document).keydown(function(e) {
                if (e.key === "Escape" && $('#videoLightbox').hasClass('active')) {
                    closeVideoLightbox();
                }
            });
        });
    </script>
</body>

</html>