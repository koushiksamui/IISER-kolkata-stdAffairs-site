<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photo Gallery — Students' Affairs Office, IISER</title>
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
                        style="font-size:.6rem"></i> <span>Photo Gallery</span></div>
                <span class="eyebrow" style="color:var(--gold-500)">Gallery</span>
                <h1>Photo Gallery</h1>
                <p class="lede">Glimpses of campus life, events, and student activities at IISER.</p>
            </div>
        </section>

        <!-- ============ GALLERY CONTENT ============ -->
        <section class="section section-alt" id="gallery">
            <div class="container">
                <div class="gallery-grid" id="photoGalleryGrid">
                    <!-- Dynamic rendering goes here -->
                </div>
            </div>
        </section>

    </main>

    <!-- ============ LIGHTBOX ============ -->
    <div class="lightbox" id="lightbox" role="dialog" aria-modal="true" aria-label="Image viewer">
        <div class="lightbox-inner">
            <button class="lightbox-close" id="lbClose" aria-label="Close lightbox">
                <i class="fa-solid fa-xmark"></i>
            </button>
            <button class="lightbox-nav prev" id="lbPrev" aria-label="Previous image">
                <i class="fa-solid fa-chevron-left"></i>
            </button>
            <img id="lbImg" src="" alt="" />
            <div class="lightbox-cap">
                <span id="lbTitle"></span>
                <span id="lbCat" style="color: var(--gold-500)"></span>
            </div>
            <button class="lightbox-nav next" id="lbNext" aria-label="Next image">
                <i class="fa-solid fa-chevron-right"></i>
            </button>
        </div>
    </div>

    <?php include __DIR__ . '/../components/footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="../layout/include.js"></script>
    <script>
        $(document).ready(function() {
            let galleriesData = [];

            $.ajax({
                url: '../api/public_gallery.php?action=get_all_images',
                type: 'GET',
                success: function(res) {
                    const grid = $('#photoGalleryGrid');
                    grid.empty();
                    
                    if (res.success && res.images && res.images.length > 0) {
                        galleriesData = res.images;
                        res.images.forEach(function(g, index) {
                            const imgPath = g.image_path ? g.image_path : 'https://placehold.co/600x400?text=No+Image';
                            const src = imgPath.match(/^https?:\/\//) ? imgPath : '../' + imgPath;
                            
                            const html = `
                                <div class="gallery-item" onclick="openLightbox(${index})">
                                    <img src="${src}" alt="${g.gallery_title}" loading="lazy">
                                    <div class="overlay">
                                        <div>
                                            <div class="g-cat">${g.gallery_title}</div>
                                            <div class="g-title">Photo</div>
                                        </div>
                                    </div>
                                </div>
                            `;
                            grid.append(html);
                        });
                    } else {
                        grid.html('<div style="grid-column: 1/-1; text-align: center; color: var(--grey-500); padding: 40px 0;">No photos found.</div>');
                    }
                },
                error: function() {
                    $('#photoGalleryGrid').html('<div style="grid-column: 1/-1; text-align: center; color: var(--red-600); padding: 40px 0;">Failed to load photos.</div>');
                }
            });

            /* ================= LIGHTBOX ================= */
            const lightbox = document.getElementById("lightbox"),
                lbImg = document.getElementById("lbImg"),
                lbTitle = document.getElementById("lbTitle"),
                lbCat = document.getElementById("lbCat");
            let lbIndex = 0;

            window.openLightbox = function(i) {
                lbIndex = i;
                updateLightbox();
                lightbox.classList.add("open");
            };

            function updateLightbox() {
                const g = galleriesData[lbIndex];
                const imgPath = g.image_path ? g.image_path : 'https://placehold.co/1200x800?text=No+Image';
                const src = imgPath.match(/^https?:\/\//) ? imgPath : '../' + imgPath;
                
                lbImg.src = src.replace("w=600", "w=1200");
                lbImg.alt = g.gallery_title;
                lbTitle.textContent = 'Photo';
                lbCat.textContent = g.gallery_title;
            }

            document.getElementById("lbClose").addEventListener("click", () => lightbox.classList.remove("open"));
            lightbox.addEventListener("click", (e) => {
                if (e.target === lightbox) lightbox.classList.remove("open");
            });
            document.getElementById("lbPrev").addEventListener("click", () => {
                lbIndex = (lbIndex - 1 + galleriesData.length) % galleriesData.length;
                updateLightbox();
            });
            document.getElementById("lbNext").addEventListener("click", () => {
                lbIndex = (lbIndex + 1) % galleriesData.length;
                updateLightbox();
            });
            document.addEventListener("keydown", (e) => {
                if (!lightbox.classList.contains("open")) return;
                if (e.key === "Escape") lightbox.classList.remove("open");
                if (e.key === "ArrowLeft") document.getElementById("lbPrev").click();
                if (e.key === "ArrowRight") document.getElementById("lbNext").click();
            });
        });
    </script>
</body>

</html>