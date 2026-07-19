<?php

/**
 * SiSAS-IITG Admin — Activity Logs
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
    <title>Activity Logs &mdash; SiSAS-IITG Admin</title>
    <meta name="description" content="View system activity logs.">
    <meta name="robots" content="noindex, nofollow">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;600;700&family=Outfit:wght@400;500;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Shared Admin Stylesheet -->
    <link rel="stylesheet" href="../dist/css/admin/dashboard.css">
    <link rel="stylesheet" href="../dist/css/admin/faculty.css">
    
    <style>
        .type-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 700;
        }
        .type-create { background-color: #e6f4ea; color: #1e8e3e; }
        .type-update { background-color: #e8f0fe; color: #1a73e8; }
        .type-delete { background-color: #fce8e6; color: #d93025; }
        .module-badge {
            font-size: 0.8rem;
            font-weight: 600;
            color: #555;
            background-color: #eee;
            padding: 2px 6px;
            border-radius: 4px;
        }
        td.details-col {
            max-width: 300px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
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

            <!-- TOP HEADER -->
            <?php include_once 'components/header.php'; ?>

            <!-- ====== CONTENT AREA ====== -->
            <main class="admin-content" id="logsMain">

                <!-- Page Header -->
                <div class="page-header">
                    <div class="page-header-left">
                        <h1><i class="fa-solid fa-clock-rotate-left" style="color:var(--accent-blue);margin-right:10px;font-size:1.5rem;"></i>Activity Logs</h1>
                        <p>Track who made changes, what was changed, and when.</p>
                    </div>
                </div>

                <!-- ===== DATA GRID FOR LOGS ===== -->
                <div class="data-table-wrapper" id="logsTableWrapper">
                    <div class="data-table-header">
                        <h4><i class="fa-solid fa-list"></i> System Activity Logs</h4>
                        <div class="search-box">
                            <i class="fa-solid fa-search"></i>
                            <input type="text" id="logsSearchInput" placeholder="Search logs...">
                        </div>
                    </div>
                    <div style="overflow-x: auto;">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Admin</th>
                                    <th>Module</th>
                                    <th>Action</th>
                                    <th>Details</th>
                                    <th>IP Address</th>
                                    <th>Date & Time</th>
                                    <th style="text-align: right;">Action</th>
                                </tr>
                            </thead>
                            <tbody id="logsTableBody">
                                <!-- Data injected via JS -->
                            </tbody>
                        </table>
                    </div>
                    <!-- Pagination -->
                    <div class="pagination-wrapper" style="display:flex; justify-content:space-between; align-items:center; padding: 16px 24px; border-top: 1px solid rgba(0,0,0,0.05); background-color: #fafafa;">
                        <div class="page-limit-selector" style="display: flex; align-items: center; gap: 10px;">
                            <label for="logsPageLimit" style="font-size: 0.85rem; color: var(--text-muted); font-weight: 600; margin: 0;">Rows per page:</label>
                            <select id="logsPageLimit" class="form-select" style="width:auto; display:inline-block; padding: 6px 32px 6px 12px; font-size: 0.85rem; background-position: right 10px center; height: auto;">
                                <option value="10">10</option>
                                <option value="25" selected>25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                        <div class="pagination-controls" style="display:flex; align-items:center; gap: 15px;">
                            <button type="button" id="logsPrevPage" class="btn-icon" style="background-color: var(--white); border: 1px solid rgba(0,0,0,0.1); color: var(--text-dark); width: 32px; height: 32px; border-radius: 6px;"><i class="fa-solid fa-chevron-left" style="font-size: 0.8rem;"></i></button>
                            <span id="logsPageInfo" style="font-size: 0.85rem; font-weight: 600; color: var(--text-dark);">Page 1</span>
                            <button type="button" id="logsNextPage" class="btn-icon" style="background-color: var(--white); border: 1px solid rgba(0,0,0,0.1); color: var(--text-dark); width: 32px; height: 32px; border-radius: 6px;"><i class="fa-solid fa-chevron-right" style="font-size: 0.8rem;"></i></button>
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>

    <!-- ====== Log Details Modal ====== -->
    <div id="logModalBackdrop" style="display: none; align-items: center; justify-content: center; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 9999;">
        <div style="background: #fff; border-radius: 8px; padding: 25px; max-width: 500px; width: 90%; box-shadow: 0 10px 25px rgba(0,0,0,0.2); position: relative;">
            <h3 style="margin-top: 0; margin-bottom: 15px; border-bottom: 1px solid #eee; padding-bottom: 10px; font-size: 1.2rem; color: #333;">
                <i class="fa-solid fa-circle-info" style="color: var(--accent-blue); margin-right: 8px;"></i> Activity Details
            </h3>
            <div id="logModalContent" style="font-size: 0.95rem; line-height: 1.6; color: #555; margin-bottom: 20px;">
            </div>
            <div style="text-align: right;">
                <button id="closeLogModalBtn" style="padding: 8px 16px; border: 1px solid #ddd; background: #f9f9f9; border-radius: 4px; cursor: pointer; font-weight: 600; color: #333;">Close</button>
            </div>
        </div>
    </div>

    <!-- Script for Sidebar logic -->
    <script>
        $(document).ready(function() {
            $('#sidebarToggleBtn, #sidebarOverlay').on('click', function() {
                $('#adminSidebar').toggleClass('active');
                $('#sidebarOverlay').toggleClass('active');
            });
        });
    </script>

    <!-- Main Logic Script -->
    <script>
        // --- GLOBAL STATE ---
        const API_URL = '../api/logs.php';
        let dataList = [];

        // Pagination State
        let currentPage = 1;
        let limit = 25;
        let searchTerm = '';
        let totalPages = 1;

        // --- INIT ---
        $(document).ready(function() {
            loadLogs();

            // Server-side Search filters
            let searchTimeout;
            $('#logsSearchInput').on('keyup', function() {
                clearTimeout(searchTimeout);
                searchTerm = $(this).val();
                currentPage = 1;
                searchTimeout = setTimeout(() => loadLogs(), 400);
            });

            // Pagination Listeners
            $('#logsPageLimit').change(function() {
                limit = parseInt($(this).val());
                currentPage = 1;
                loadLogs();
            });
            $('#logsPrevPage').click(function() {
                if (currentPage > 1) {
                    currentPage--;
                    loadLogs();
                }
            });
            $('#logsNextPage').click(function() {
                if (currentPage < totalPages) {
                    currentPage++;
                    loadLogs();
                }
            });

            $('#closeLogModalBtn, #logModalBackdrop').click(function(e) {
                if (e.target === this) {
                    $('#logModalBackdrop').fadeOut(200);
                }
            });
        });

        // --- FUNCTIONS ---
        function loadLogs() {
            $.getJSON(API_URL, { 
                action: 'get_logs',
                page: currentPage,
                limit: limit,
                search: searchTerm
            }, function(r) {
                if (r.success) {
                    dataList = r.data;
                    totalPages = Math.ceil(r.total / r.limit) || 1;
                    renderTable();
                    updatePaginationUI();
                }
            });
        }

        function updatePaginationUI() {
            $('#logsPageInfo').text(`Page ${currentPage} of ${totalPages}`);
            $('#logsPrevPage').prop('disabled', currentPage <= 1).css('opacity', currentPage <= 1 ? '0.5' : '1');
            $('#logsNextPage').prop('disabled', currentPage >= totalPages).css('opacity', currentPage >= totalPages ? '0.5' : '1');
        }

        function renderTable() {
            const tbody = $('#logsTableBody');
            tbody.empty();

            if (dataList.length === 0) {
                tbody.append('<tr><td colspan="6" style="text-align:center; padding: 20px;">No activity logs found.</td></tr>');
                return;
            }

            dataList.forEach(item => {
                let badgeClass = 'type-badge';
                if (item.action_type === 'CREATE') badgeClass += ' type-create';
                else if (item.action_type === 'UPDATE') badgeClass += ' type-update';
                else if (item.action_type === 'DELETE') badgeClass += ' type-delete';

                const tr = $(`
                    <tr>
                        <td><strong>${escapeHtml(item.admin_email)}</strong></td>
                        <td><span class="module-badge">${escapeHtml(item.module)}</span></td>
                        <td><span class="${badgeClass}">${escapeHtml(item.action_type)}</span></td>
                        <td class="details-col" title="${escapeHtml(item.details)}">${escapeHtml(item.details)}</td>
                        <td style="color:#666; font-size:0.85rem;">${escapeHtml(item.ip_address)}</td>
                        <td style="white-space:nowrap;">${formatDateTime(item.created_at)}</td>
                        <td style="text-align: right; white-space: nowrap;">
                            <div style="display: flex; justify-content: flex-end;">
                                <button class="btn-icon" onclick="viewLog(${item.id})" title="View Details"><i class="fa-solid fa-eye"></i></button>
                            </div>
                        </td>
                    </tr>
                `);
                tbody.append(tr);
            });
        }

        function formatDateTime(dateStr) {
            if (!dateStr) return '';
            const d = new Date(dateStr);
            if (isNaN(d.getTime())) return dateStr;
            return d.toLocaleString('en-GB', { 
                day: '2-digit', month: 'short', year: 'numeric', 
                hour: '2-digit', minute:'2-digit', second:'2-digit' 
            });
        }

        function escapeHtml(str) {
            if (!str) return '';
            return str.toString().replace(/[&<>'"]/g, function(tag) {
                const charsToReplace = {
                    '&': '&amp;', '<': '&lt;', '>': '&gt;', "'": '&#39;', '"': '&quot;'
                };
                return charsToReplace[tag] || tag;
            });
        }

        window.viewLog = function(id) {
            const item = dataList.find(x => x.id == id);
            if (!item) return;

            let badgeClass = 'type-badge';
            if (item.action_type === 'CREATE') badgeClass += ' type-create';
            else if (item.action_type === 'UPDATE') badgeClass += ' type-update';
            else if (item.action_type === 'DELETE') badgeClass += ' type-delete';

            const html = `
                <table style="width: 100%; border-collapse: collapse;">
                    <tr><td style="padding: 8px 0; border-bottom: 1px solid #eee; width: 30%;"><strong>Admin:</strong></td><td style="padding: 8px 0; border-bottom: 1px solid #eee;">${escapeHtml(item.admin_email)}</td></tr>
                    <tr><td style="padding: 8px 0; border-bottom: 1px solid #eee;"><strong>Module:</strong></td><td style="padding: 8px 0; border-bottom: 1px solid #eee;"><span class="module-badge">${escapeHtml(item.module)}</span></td></tr>
                    <tr><td style="padding: 8px 0; border-bottom: 1px solid #eee;"><strong>Action:</strong></td><td style="padding: 8px 0; border-bottom: 1px solid #eee;"><span class="${badgeClass}">${escapeHtml(item.action_type)}</span></td></tr>
                    <tr><td style="padding: 8px 0; border-bottom: 1px solid #eee;"><strong>IP Address:</strong></td><td style="padding: 8px 0; border-bottom: 1px solid #eee;">${escapeHtml(item.ip_address)}</td></tr>
                    <tr><td style="padding: 8px 0; border-bottom: 1px solid #eee;"><strong>Time:</strong></td><td style="padding: 8px 0; border-bottom: 1px solid #eee;">${formatDateTime(item.created_at)}</td></tr>
                    <tr><td style="padding: 8px 0; vertical-align: top;"><strong>Details:</strong></td><td style="padding: 8px 0; word-break: break-word;">${escapeHtml(item.details)}</td></tr>
                </table>
            `;
            $('#logModalContent').html(html);
            $('#logModalBackdrop').css('display', 'flex').hide().fadeIn(200);
        };
    </script>
</body>
</html>
