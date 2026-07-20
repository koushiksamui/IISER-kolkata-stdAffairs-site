<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forms & Downloads — Students' Affairs Office, IISER</title>
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
                        style="font-size:.6rem"></i> <span>Forms & Downloads</span></div>
                <span class="eyebrow" style="color:var(--gold-500)">Resources</span>
                <h1>Forms & Downloads</h1>
                <p class="lede">Access and download all essential student forms, guidelines, and documents.</p>
            </div>
        </section>

        <!-- ============ FORMS FEED ============ -->
        <section class="section" style="padding-top: 0;">
            <div class="container" style="max-width: 800px; margin: 0 auto;">
                <ul class="announcement-list notice-style" id="forms-container" style="margin-top: 48px;">
                    <li>
                        <div style="display: flex; align-items: center; justify-content: center; padding: 64px 0;">
                            <i class="fa-solid fa-circle-notch fa-spin" style="font-size: 3rem; color: var(--gold-500);"></i>
                        </div>
                    </li>
                </ul>
                <div id="pagination-controls" style="text-align: center; margin-top: 32px; display: none;">
                    <button class="btn btn-outline" id="load-more-btn">Load More</button>
                </div>
            </div>
        </section>

    </main>

    <?php include __DIR__ . '/../components/footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="../layout/include.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const container = document.getElementById("forms-container");
            const loadMoreBtn = document.getElementById("load-more-btn");
            const paginationControls = document.getElementById("pagination-controls");
            
            let currentPage = 1;
            const limit = 20;

            function loadForms(page) {
                // Fetch public forms only
                fetch(`../api/forms_downloads.php?action=get_forms&type=Public&limit=${limit}&page=${page}`)
                    .then(res => res.json())
                    .then(data => {
                        if (page === 1) container.innerHTML = '';
                        
                        if (data.success && data.data && data.data.length > 0) {
                            data.data.forEach(form => {
                                // Optional check for visible_from/upto to only show active forms on frontend
                                const now = new Date();
                                const from = form.visible_from ? new Date(form.visible_from) : null;
                                const upto = form.visible_upto ? new Date(form.visible_upto) : null;
                                
                                // Skip if not yet visible or expired
                                if (from && from > now) return;
                                if (upto && upto < now) return;

                                let actionsHTML = '';
                                if (form.files && Array.isArray(form.files)) {
                                    form.files.forEach(f => {
                                        const filePath = f.path ? f.path : f.url; // fallback just in case
                                        actionsHTML += `<a href="../${filePath}" target="_blank" style="margin-right: 12px; font-size: 0.9rem; color: #2563eb; text-decoration: none; font-weight: 500; display: inline-flex; align-items: center; gap: 6px; padding: 6px 12px; background: #eff6ff; border-radius: 4px;"><i class="fa-solid fa-download"></i> Download ${f.name}</a>`;
                                    });
                                }

                                const li = document.createElement('li');
                                li.innerHTML = `
                                    <div style="display: flex; justify-content: space-between; align-items: center; padding: 24px 0; border-bottom: 1px solid #e2e8f0; flex-wrap: wrap; gap: 16px;">
                                        <div style="flex: 1; min-width: 250px;">
                                            <span style="display: inline-block; padding: 4px 12px; border-radius: 4px; font-size: 0.75rem; text-transform: uppercase; font-weight: 600; margin-bottom: 8px; background: #f0fdf4; color: #15803d;">Document</span>
                                            <strong style="display: block; font-size: 1.15rem; color: #0f172a; margin-bottom: 4px;">${form.title}</strong>
                                        </div>
                                        <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                                            ${actionsHTML}
                                        </div>
                                    </div>
                                `;
                                container.appendChild(li);
                            });

                            if (data.total > page * limit) {
                                paginationControls.style.display = 'block';
                            } else {
                                paginationControls.style.display = 'none';
                            }
                        } else if (page === 1) {
                            container.innerHTML = '<li style="text-align: center; padding: 48px; color: var(--grey-500);">No forms or downloads available at the moment.</li>';
                            paginationControls.style.display = 'none';
                        }
                    })
                    .catch(err => {
                        console.error("Error fetching forms:", err);
                        if (page === 1) container.innerHTML = '<li style="text-align: center; padding: 48px; color: var(--red-600);">Failed to load forms. Please try again later.</li>';
                    });
            }

            loadForms(currentPage);

            loadMoreBtn.addEventListener("click", () => {
                currentPage++;
                loadForms(currentPage);
            });
        });
    </script>
</body>
</html>
