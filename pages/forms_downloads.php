<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forms &amp; Downloads — Students' Affairs Office, IISER Kolkata</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/hostel-management.css?v=<?php echo time(); ?>">
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
                    ['title' => 'Forms & Downloads']
                ];
                include __DIR__ . '/../components/breadcrumb.php';
                ?>
                <h1 class="hero-title">Forms &amp; Downloads</h1>
                <p class="lede hero-subtitle">Access and download official application forms, guidelines, and documents from the Students' Affairs Office.</p>
            </div>
        </section>

        <!-- ============ FORMS LAYOUT ============ -->
        <section class="section">
            <div class="container hostel-layout">

                <!-- Sidebar Navigation -->
                <aside class="sidebar-menu" id="formsSidebar">
                    <button class="tab-btn active" data-type="Public"><i class="fa-solid fa-folder-open"></i> Public Forms</button>
                    <button class="tab-btn" data-type="Internal" style="opacity: 0.6;" title="Login Required"><i class="fa-solid fa-lock"></i> Internal Forms</button>
                </aside>

                <!-- Main Content Area -->
                <div class="tab-content">
                    <div class="tab-pane active" id="tab-forms">
                        <div class="content-box">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; flex-wrap: wrap; gap: 1rem;">
                                <h2 style="margin: 0;" id="category-title">Public Forms</h2>
                                <div class="search-bar" style="position: relative; width: 300px; max-width: 100%;">
                                    <input type="text" id="search-input" placeholder="Search forms..." style="width: 100%; padding: 10px 15px 10px 35px; border: 1px solid #ccc; border-radius: 6px;">
                                    <i class="fa-solid fa-search" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #666;"></i>
                                </div>
                            </div>

                            <ul class="announcement-list notice-style" id="full-forms-container">
                                <li>
                                    <div style="display: flex; align-items: center; justify-content: center; padding: 64px 0;">
                                        <i class="fa-solid fa-circle-notch fa-spin" style="font-size: 3rem; color: var(--gold-500);"></i>
                                    </div>
                                </li>
                            </ul>
                            <div id="pagination-controls" style="text-align: center; margin-top: 16px; display: none;">
                                <button class="btn btn-outline" id="load-more-btn">Load More</button>
                            </div>
                        </div>
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
            const container = document.getElementById("full-forms-container");
            const loadMoreBtn = document.getElementById("load-more-btn");
            const paginationControls = document.getElementById("pagination-controls");
            const sidebar = document.getElementById("formsSidebar");
            const categoryTitle = document.getElementById('category-title');
            const searchInput = document.getElementById('search-input');

            let currentPage = 1;
            let currentType = 'Public';
            let currentSearch = '';
            let totalForms = 0;
            let loadedFormsCount = 0;
            const limit = 20;
            let searchTimeout = null;

            // Sidebar tab click handler
            sidebar.addEventListener("click", function (e) {
                const btn = e.target.closest(".tab-btn");
                if (!btn) return;

                const selectedType = btn.getAttribute("data-type");
                
                // Active state toggle
                sidebar.querySelectorAll(".tab-btn").forEach(b => b.classList.remove("active"));
                btn.classList.add("active");

                currentType = selectedType;
                categoryTitle.textContent = btn.textContent.trim();
                currentPage = 1;
                loadForms(currentPage, true);
            });

            // Search input listener with debouncing
            searchInput.addEventListener('input', function () {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    currentSearch = this.value.trim();
                    currentPage = 1;
                    loadForms(currentPage, true);
                }, 400);
            });

            function loadForms(page, reset = false) {
                if (reset) {
                    container.innerHTML = `
                        <li>
                            <div style="display: flex; align-items: center; justify-content: center; padding: 64px 0;">
                                <i class="fa-solid fa-circle-notch fa-spin" style="font-size: 3rem; color: var(--gold-500);"></i>
                            </div>
                        </li>
                    `;
                }

                let url = `../api/forms_downloads.php?action=get_forms&public_only=1&limit=${limit}&page=${page}`;
                if (currentType) url += `&type=${encodeURIComponent(currentType)}`;
                if (currentSearch) url += `&search=${encodeURIComponent(currentSearch)}`;

                $.ajax({
                    url: url,
                    method: 'GET',
                    dataType: 'json'
                }).done(data => {
                    if (page === 1) container.innerHTML = '';
                    
                    if (data.success && data.data && data.data.length > 0) {
                        totalForms = data.total || 0;
                        if (reset) loadedFormsCount = 0;
                        loadedFormsCount += data.data.length;

                        data.data.forEach(form => {
                            const dateValue = form.visible_from || form.created_at;
                            const rawDate = dateValue ? dateValue.replace(' ', 'T') : '';
                            const dateObj = rawDate ? new Date(rawDate) : new Date();
                            const dateStr = !isNaN(dateObj.getTime()) ? dateObj.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' }) : '';

                            let actionsHTML = [];
                            if (form.files && Array.isArray(form.files)) {
                                form.files.forEach(f => {
                                    const filePath = f.path ? f.path : f.url;
                                    const fileName = f.name ? f.name : 'Download File';
                                    if (filePath) {
                                        actionsHTML.push(`<a href="../${filePath}" target="_blank"><i class="fa-solid fa-download" style="margin-right: 4px;"></i>${fileName}</a>`);
                                    }
                                });
                            }
                            let actionsString = actionsHTML.join(' <span style="color: #cbd5e1;">&bull;</span> ');

                            const now = new Date();
                            const diffMs = now - dateObj;
                            const diffDays = diffMs / (1000 * 60 * 60 * 24);
                            const isNew = !isNaN(diffDays) && diffDays >= 0 && diffDays <= 7;
                            const newBadge = isNew ? '<span style="background: #ef4444; color: white; padding: 2px 6px; border-radius: 4px; font-size: 0.7rem; font-weight: 600; vertical-align: middle; margin-left: 8px;">NEW</span>' : '';

                            const li = document.createElement('li');
                            li.innerHTML = `
                                <div class="notice-row">
                                    <div class="notice-title">
                                        ${form.title}${newBadge}
                                    </div>
                                    <div class="notice-meta">
                                        <span><i class="fa-regular fa-calendar" style="margin-right: 4px;"></i>${dateStr}</span>
                                        ${actionsString ? `<span style="color: #cbd5e1;">&bull;</span> ${actionsString}` : ''}
                                    </div>
                                </div>
                            `;
                            container.appendChild(li);
                        });

                        if (loadedFormsCount < totalForms) {
                            paginationControls.style.display = 'block';
                        } else {
                            paginationControls.style.display = 'none';
                        }
                    } else {
                        if (page === 1) {
                            container.innerHTML = `
                                <li style="text-align: center; padding: 32px 0; color: #64748b;">
                                    <i class="fa-solid fa-folder-open" style="font-size: 2.5rem; margin-bottom: 12px; opacity: 0.5;"></i>
                                    <p style="margin: 0; font-size: 1rem;">No forms found matching your criteria.</p>
                                </li>
                            `;
                        }
                        paginationControls.style.display = 'none';
                    }
                }).fail(err => {
                    console.error("Error loading forms:", err);
                    if (page === 1) {
                        container.innerHTML = `
                            <li style="text-align: center; padding: 32px 0; color: #ef4444;">
                                <i class="fa-solid fa-triangle-exclamation" style="font-size: 2rem; margin-bottom: 8px;"></i>
                                <p style="margin: 0;">Failed to load forms. Please try again later.</p>
                            </li>
                        `;
                    }
                    paginationControls.style.display = 'none';
                });
            }

            // Load initial forms
            loadForms(currentPage, true);

            // Load more button handler
            loadMoreBtn.addEventListener("click", function () {
                currentPage++;
                loadForms(currentPage);
            });
        });
    </script>
</body>

</html>