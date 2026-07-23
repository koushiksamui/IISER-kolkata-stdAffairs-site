<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notices & Updates — Students' Affairs Office, IISER</title>
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
                    ['title' => 'Notices & Updates']
                ];
                include __DIR__ . '/../components/breadcrumb.php';
                ?>
                <h1 class="hero-title">Notices &amp; Updates</h1>
                <p class="lede hero-subtitle">All the latest announcements, circulars, and updates from the Students' Affairs Office.</p>
            </div>
        </section>

        <!-- ============ NOTICES LAYOUT ============ -->
        <section class="section">
            <div class="container hostel-layout">

                <!-- Sidebar Navigation -->
                <aside class="sidebar-menu" id="noticesSidebar">
                    <button class="tab-btn active" data-type=""><i class="fa-solid fa-list"></i> All Notices</button>
                </aside>

                <!-- Main Content Area -->
                <div class="tab-content">
                    <div class="tab-pane active" id="tab-notices">
                        <div class="content-box">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; flex-wrap: wrap; gap: 1rem;">
                                <h2 style="margin: 0;" id="category-title">All Notices</h2>
                                <div class="search-bar" style="position: relative; width: 300px; max-width: 100%;">
                                    <input type="text" id="search-input" placeholder="Search notices..." style="width: 100%; padding: 10px 15px 10px 35px; border: 1px solid #ccc; border-radius: 6px;">
                                    <i class="fa-solid fa-search" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #666;"></i>
                                </div>
                            </div>

                            <ul class="announcement-list notice-style" id="full-notices-container">
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
            const container = document.getElementById("full-notices-container");
            const loadMoreBtn = document.getElementById("load-more-btn");
            const paginationControls = document.getElementById("pagination-controls");
            const sidebar = document.getElementById("noticesSidebar");
            const categoryTitle = document.getElementById('category-title');
            const searchInput = document.getElementById('search-input');
            
            let currentPage = 1;
            const limit = 20;
            let currentType = '';
            let currentSearch = '';

            function getCategoryIcon(cat) {
                const c = cat.toLowerCase();
                if (c.includes('academic')) return 'fa-book';
                if (c.includes('circular')) return 'fa-file-lines';
                if (c.includes('event')) return 'fa-calendar-day';
                if (c.includes('alert') || c.includes('urgent')) return 'fa-bell';
                if (c.includes('tender')) return 'fa-file-contract';
                if (c.includes('hostel')) return 'fa-building';
                return 'fa-folder-open';
            }

            function bindTabClicks() {
                const tabBtns = document.querySelectorAll('#noticesSidebar .tab-btn');
                tabBtns.forEach(btn => {
                    btn.onclick = () => {
                        tabBtns.forEach(b => b.classList.remove('active'));
                        btn.classList.add('active');
                        currentType = btn.dataset.type;
                        categoryTitle.textContent = btn.textContent.trim();
                        currentPage = 1;
                        loadNotices(currentPage, true);
                    };
                });
            }

            // Fetch dynamic categories from DB
            $.ajax({
                url: '../api/notices.php?action=get_categories',
                method: 'GET',
                dataType: 'json'
            }).done(data => {
                if (data.success && data.categories && data.categories.length > 0) {
                    data.categories.forEach(cat => {
                        const icon = getCategoryIcon(cat);
                        const btn = document.createElement('button');
                        btn.className = 'tab-btn';
                        btn.dataset.type = cat;
                        btn.innerHTML = `<i class="fa-solid ${icon}"></i> ${cat}`;
                        sidebar.appendChild(btn);
                    });
                    bindTabClicks();
                }
            });

            bindTabClicks();

            // Handle Search
            let searchTimeout;
            searchInput.addEventListener('input', (e) => {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    currentSearch = e.target.value.trim();
                    currentPage = 1;
                    loadNotices(currentPage, true);
                }, 500); // 500ms debounce
            });

            function loadNotices(page, reset = false) {
                if (reset) {
                    container.innerHTML = `
                        <li>
                            <div style="display: flex; align-items: center; justify-content: center; padding: 64px 0;">
                                <i class="fa-solid fa-circle-notch fa-spin" style="font-size: 3rem; color: var(--gold-500);"></i>
                            </div>
                        </li>
                    `;
                }

                let url = `../api/notices.php?action=get_notices&public_only=1&limit=${limit}&page=${page}`;
                if (currentType) url += `&type=${encodeURIComponent(currentType)}`;
                if (currentSearch) url += `&search=${encodeURIComponent(currentSearch)}`;

                $.ajax({
                    url: url,
                    method: 'GET',
                    dataType: 'json'
                }).done(data => {
                        if (page === 1) container.innerHTML = '';
                        
                        if (data.success && data.data && data.data.length > 0) {
                            data.data.forEach(notice => {
                                const rawDate = notice.created_at ? notice.created_at.replace(' ', 'T') : '';
                                const dateObj = rawDate ? new Date(rawDate) : new Date();
                                const dateStr = !isNaN(dateObj.getTime()) ? dateObj.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' }) : '';

                                let actionsHTML = [];
                                if (notice.pdf_path) {
                                    actionsHTML.push(`<a href="../${notice.pdf_path}" target="_blank">View Document</a>`);
                                }
                                if (notice.link) {
                                    actionsHTML.push(`<a href="${notice.link}" target="_blank">Open Link</a>`);
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
                                            ${notice.title}${newBadge}
                                        </div>
                                        <div class="notice-meta">
                                            <span><i class="fa-regular fa-calendar" style="margin-right: 4px;"></i>${dateStr}</span>
                                            ${actionsString ? `<span style="color: #cbd5e1;">&bull;</span> ${actionsString}` : ''}
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
                            container.innerHTML = '<li style="text-align: center; color: var(--grey-500); padding: 40px;">No Updates or Notices found.</li>';
                            paginationControls.style.display = 'none';
                        }
                    })
                    .fail((jqXHR, textStatus, err) => {
                        console.error('Failed to load notices:', err);
                        if (page === 1) {
                            container.innerHTML = '<li style="text-align: center; color: var(--grey-500); padding: 40px;">Failed to load updates. Please try again.</li>';
                        }
                    });
            }

            loadNotices(currentPage, true);

            loadMoreBtn.addEventListener("click", () => {
                currentPage++;
                loadNotices(currentPage);
            });
        });
    </script>
</body>
</html>
