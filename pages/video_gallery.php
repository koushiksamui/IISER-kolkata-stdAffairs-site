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
        <section class="page-hero">
            <div class="container page-hero-inner">
                <div class="breadcrumb"><a href="../index.html">Home</a> <i class="fa-solid fa-chevron-right"
                        style="font-size:.6rem"></i> <span>Video Gallery</span></div>
                <span class="eyebrow" style="color:var(--gold-500)">Gallery</span>
                <h1>Video Gallery</h1>
                <p class="lede">Explore campus life, research talks, and cultural events through our videos.</p>
            </div>
        </section>

        <!-- ============ VIDEO CONTENT ============ -->
        <section class="section section-alt">
            <div class="container">
                <div class="gallery-grid" id="videoGalleryGrid">
                    <!-- Dynamic rendering goes here -->
                </div>
            </div>
        </section>

    </main>

    <!-- ============ VIDEO LIGHTBOX ============ -->
    <div class="lightbox" id="videoLightbox">
        <button class="lightbox-close" id="vlClose" aria-label="Close lightbox">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <div class="lightbox-video-container" id="vlVideoContainer" style="width: 100%; max-width: 900px; display: flex; flex-direction: column; align-items: center; justify-content: center;">
            <!-- Player gets injected here -->
        </div>
        <div class="lightbox-cap" style="text-align: center; margin-top: 15px;">
            <span id="vlTitle" style="font-size: 1.2rem; font-weight: 600;"></span>
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
                            let thumbnail = '';
                            if (v.video_type === 'youtube' && v.video_url) {
                                // Extract youtube ID to get thumbnail
                                const match = v.video_url.match(/\/embed\/([^?&]+)/);
                                if (match && match[1]) {
                                    thumbnail = `https://img.youtube.com/vi/${match[1]}/maxresdefault.jpg`;
                                }
                            }
                            if (!thumbnail) thumbnail = 'https://placehold.co/600x400?text=Video';

                            const html = `
                                <div class="gallery-item" onclick="openVideoLightbox(${index})">
                                    <img src="${thumbnail}" alt="${v.caption}" loading="lazy">
                                    <div class="overlay">
                                        <div>
                                            <div class="g-title">${v.caption || 'Untitled Video'}</div>
                                        </div>
                                    </div>
                                    <div class="play"><i class="fa-solid fa-play"></i></div>
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
                    container.html(`<iframe width="100%" height="500" src="${embedUrl}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="border-radius: 8px;"></iframe>`);
                } else {
                    // Prepend ../ because we are in pages/
                    container.html(`<video width="100%" style="max-height: 80vh; border-radius: 8px;" controls autoplay controlsList="nodownload"><source src="../api/stream_video.php?file=${encodeURIComponent(v.video_url)}" type="video/mp4">Your browser does not support the video tag.</video>`);
                }

                $('#vlTitle').text(v.caption || 'Untitled Video');
                $('#videoLightbox').addClass('open');
            };

            function closeVideoLightbox() {
                $('#videoLightbox').removeClass('open');
                $('#vlVideoContainer').empty(); // Stop playing
            }

            $('#vlClose').click(closeVideoLightbox);
            $('#videoLightbox').click(function(e) {
                if (e.target === this) closeVideoLightbox();
            });
            $(document).keydown(function(e) {
                if (e.key === "Escape" && $('#videoLightbox').hasClass('open')) {
                    closeVideoLightbox();
                }
            });
        });
    </script>
</body>

</html>