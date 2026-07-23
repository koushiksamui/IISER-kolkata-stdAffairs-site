<?php
require_once '../api/admin_auth.php';
requireAdmin('login.php');

$active_page = 'forms_downloads';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forms & Downloads | SiSAS Admin</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;600;700&family=Outfit:wght@400;500;700;800&display=swap" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Shared Admin Stylesheet -->
    <link rel="stylesheet" href="../dist/css/admin/dashboard.css">
    <link rel="stylesheet" href="../dist/css/admin/faculty.css">

    <style>
        .full-width {
            grid-column: 1 / -1;
        }

        .file-list {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-top: 10px;
        }

        .file-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 8px 12px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            font-size: 0.85rem;
        }

        .file-item a {
            color: #2563eb;
            text-decoration: none;
            word-break: break-all;
        }

        .file-item a:hover {
            text-decoration: underline;
        }

        .file-item .remove-file {
            color: #ef4444;
            cursor: pointer;
            padding: 4px;
        }

        .file-item .remove-file:hover {
            color: #b91c1c;
        }

        .type-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .type-Public {
            background: #dcfce7;
            color: #15803d;
            border: 1px solid #bbf7d0;
        }

        .type-Internal {
            background: #fee2e2;
            color: #b91c1c;
            border: 1px solid #fecaca;
        }
    </style>
</head>

<body>

    <div class="admin-layout" id="adminLayout">
        <!-- Mobile sidebar overlay -->
        <div class="sidebar-overlay" id="sidebarOverlay"></div>

        <!-- ====== LEFT SIDEBAR ====== -->
        <?php include_once 'components/sidebar.php'; ?>

        <!-- ====== MAIN PANEL ====== -->
        <div class="main-panel">
            <!-- TOP HEADER -->
            <?php include_once 'components/header.php'; ?>

            <!-- ====== CONTENT AREA ====== -->
            <main class="admin-content">
                <!-- Page Header -->
                <div class="page-header">
                    <div class="page-header-left">
                        <h1><i class="fa-solid fa-file-pdf" style="color:var(--accent-emerald);margin-right:10px;font-size:1.5rem;"></i>Forms & Downloads</h1>
                        <p>Manage documents, forms, and files available for download.</p>
                    </div>
                    <button class="btn-primary-action" id="toggleAddFormBtn">
                        <i class="fa-solid fa-plus"></i> <span id="addBtnText">Add Item</span>
                    </button>
                </div>

                <!-- ADD/EDIT FORM (Slide Down) -->
                <div class="form-card" id="formCard">
                    <div class="form-card-header">
                        <h3 id="formCardTitle"><i class="fa-solid fa-file-circle-plus"></i> Add New Item</h3>
                        <button class="btn-close-form" id="closeFormBtn" title="Close form">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                    <div class="form-card-body">
                        <form id="dataForm" novalidate>
                            <input type="hidden" name="id" id="itemIdInput" value="0">
                            <!-- Store existing files as JSON when editing -->
                            <input type="hidden" name="existing_files" id="existingFilesInput" value="[]">

                            <div class="form-grid">
                                <div class="form-group full-width">
                                    <label class="form-label" for="itemTitle">Title *</label>
                                    <input type="text" name="title" id="itemTitle" class="form-control" required maxlength="255" placeholder="Document Title">
                                </div>

                                <div class="form-group full-width">
                                    <label class="form-label" for="itemFiles">PDF or Document Upload (can select multiple) *</label>
                                    <input type="file" name="new_files[]" id="itemFiles" class="form-control" multiple accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.txt,.zip,.rar">
                                    <div class="file-list" id="currentFilesList"></div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="visibleFrom">Visible From *</label>
                                    <input type="date" name="visible_from" id="visibleFrom" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="visibleUpto">Visible Upto</label>
                                    <input type="date" name="visible_upto" id="visibleUpto" class="form-control">
                                    <small style="color:#64748b;">Leave blank if it doesn't expire.</small>
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="displayType">Display Type *</label>
                                    <select name="display_type" id="displayType" class="form-select" required>
                                        <option value="Public">Public</option>
                                        <option value="Internal">Internal</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-actions">
                                <button type="button" class="btn-cancel" id="cancelFormBtn">Cancel</button>
                                <button type="submit" class="btn-submit" id="submitFormBtn">
                                    <i class="fa-solid fa-check"></i> Save Item
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- ===== DATA GRID FOR FORMS ===== -->
                <div class="page-tabs" id="typeTabs" style="margin-bottom: 20px;">
                    <button class="tab-btn active" data-filter="">All</button>
                    <button class="tab-btn" data-filter="Public">Public</button>
                    <button class="tab-btn" data-filter="Internal">Internal</button>
                </div>

                <!-- TABLE SECTION -->
                <div class="data-table-wrapper" id="tableWrapper">
                    <div class="data-table-header">
                        <h4><i class="fa-solid fa-list"></i> List of Forms & Downloads</h4>
                        <div class="search-box">
                            <i class="fa-solid fa-search"></i>
                            <input type="text" id="searchInput" placeholder="Search by title...">
                        </div>
                    </div>

                    <div style="overflow-x: auto;">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Files</th>
                                    <th>Visibility</th>
                                    <th style="text-align: right; min-width: 100px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody">
                                <!-- Data injected here -->
                                <tr>
                                    <td colspan="4" style="text-align:center; padding: 20px;"><i class="fa-solid fa-spinner fa-spin"></i> Loading...</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="pagination-wrapper" style="display:flex; justify-content:space-between; align-items:center; padding: 16px 24px; border-top: 1px solid rgba(0,0,0,0.05); background-color: #fafafa;">
                        <div class="page-limit-selector" style="display: flex; align-items: center; gap: 10px;">
                            <label for="pageLimit" style="font-size: 0.85rem; color: var(--text-muted); font-weight: 600; margin: 0;">Rows per page:</label>
                            <select id="pageLimit" class="form-select" style="width:auto; display:inline-block; padding: 6px 32px 6px 12px; font-size: 0.85rem; background-position: right 10px center; height: auto;">
                                <option value="10" selected>10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                            </select>
                        </div>
                        <div class="pagination-controls" style="display:flex; align-items:center; gap: 15px;">
                            <button type="button" id="prevPage" class="btn-icon" style="background-color: var(--white); border: 1px solid rgba(0,0,0,0.1); color: var(--text-dark); width: 32px; height: 32px; border-radius: 6px;"><i class="fa-solid fa-chevron-left" style="font-size: 0.8rem;"></i></button>
                            <span id="pageInfo" style="font-size: 0.85rem; font-weight: 600; color: var(--text-dark);">Page 1</span>
                            <button type="button" id="nextPage" class="btn-icon" style="background-color: var(--white); border: 1px solid rgba(0,0,0,0.1); color: var(--text-dark); width: 32px; height: 32px; border-radius: 6px;"><i class="fa-solid fa-chevron-right" style="font-size: 0.8rem;"></i></button>
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>

    <!-- Toast Notification Container -->
    <div id="toastContainer" class="toast-container"></div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../dist/js/admin/dashboard.js"></script>

    <script>
        const API_URL = '../api/forms_downloads.php';
        let dataList = [];
        let currentPage = 1;
        let limit = 10;
        let totalPages = 1;
        let searchTerm = '';
        let typeFilter = '';

        let currentEditingFiles = [];

        $(document).ready(function() {
            loadData();

            // Toggle form
            $('#toggleAddFormBtn').click(function() {
                if ($('#formCard').hasClass('active')) {
                    closeForm();
                } else {
                    $('#formCardTitle').html('<i class="fa-solid fa-file-circle-plus"></i> Add New Item');
                    $('#itemIdInput').val('0');
                    $('#dataForm')[0].reset();
                    currentEditingFiles = [];
                    renderCurrentFiles();

                    // Set default visible from to today
                    document.getElementById('visibleFrom').valueAsDate = new Date();

                    $('#formCard').hide().addClass('active').slideDown(300);
                    $('#addBtnText').text('Cancel');
                    $(this).html('<i class="fa-solid fa-xmark"></i> <span>Cancel</span>');
                }
            });

            $('#closeFormBtn, #cancelFormBtn').click(closeForm);

            function closeForm() {
                $('#formCard').slideUp(300, function() {
                    $(this).removeClass('active');
                    $('#dataForm')[0].reset();
                    $('#itemIdInput').val('0');
                    currentEditingFiles = [];
                    renderCurrentFiles();
                    $('#toggleAddFormBtn').html('<i class="fa-solid fa-plus"></i> <span id="addBtnText">Add Item</span>');
                });
            }

            // Form Submit
            $('#dataForm').submit(function(e) {
                e.preventDefault();

                // Update hidden input with current existing files
                $('#existingFilesInput').val(JSON.stringify(currentEditingFiles));

                const fd = new FormData(this);
                fd.append('action', 'save_form');

                // Basic validation
                const title = fd.get('title').trim();
                const visible_from = fd.get('visible_from');
                const newFiles = document.getElementById('itemFiles').files;

                if (!title || !visible_from) {
                    showToast('error', 'Title and Visible From are required.');
                    return;
                }

                if (currentEditingFiles.length === 0 && newFiles.length === 0) {
                    showToast('error', 'Please upload at least one file.');
                    return;
                }

                const $btn = $('#submitFormBtn');
                const origHtml = $btn.html();
                $btn.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin"></i> Saving...');

                $.ajax({
                    url: API_URL,
                    type: 'POST',
                    data: fd,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    success: function(r) {
                        if (r.success) {
                            showToast('success', r.message);
                            closeForm();
                            loadData();
                        } else {
                            showToast('error', r.message || 'Error saving data.');
                        }
                    },
                    error: function() {
                        showToast('error', 'Server connection failed.');
                    },
                    complete: function() {
                        $btn.prop('disabled', false).html(origHtml);
                    }
                });
            });

            // Type Filter Listeners
            $('#typeTabs .tab-btn').click(function() {
                $('#typeTabs .tab-btn').removeClass('active');
                $(this).addClass('active');
                typeFilter = $(this).data('filter');
                currentPage = 1;
                loadData();
            });

            let searchTimeout;
            $('#searchInput').on('keyup', function() {
                clearTimeout(searchTimeout);
                searchTerm = $(this).val();
                searchTimeout = setTimeout(() => {
                    currentPage = 1;
                    loadData();
                }, 300);
            });

            $('#pageLimit').change(function() {
                limit = parseInt($(this).val());
                currentPage = 1;
                loadData();
            });

            $('#prevPage').click(function() {
                if (currentPage > 1) {
                    currentPage--;
                    loadData();
                }
            });

            $('#nextPage').click(function() {
                if (currentPage < totalPages) {
                    currentPage++;
                    loadData();
                }
            });
        });

        // --- FUNCTIONS ---

        function loadData() {
            $.getJSON(API_URL, {
                action: 'get_forms',
                page: currentPage,
                limit: limit,
                search: searchTerm,
                type: typeFilter
            }, function(r) {
                if (r.success) {
                    dataList = r.data;
                    totalPages = Math.ceil(r.total / limit) || 1;
                    renderTable();
                    updatePaginationUI();
                } else {
                    showToast('error', r.message);
                }
            }).fail(function() {
                showToast('error', 'Failed to fetch forms list.');
            });
        }

        function formatDate(dateString) {
            if (!dateString) return '';
            const parts = dateString.split('-');
            if (parts.length === 3) {
                return `${parts[2]}-${parts[1]}-${parts[0]}`;
            }
            return dateString;
        }

        function escapeHtml(unsafe) {
            if (!unsafe) return '';
            return unsafe
                .toString()
                .replace(/&/g, "&amp;")
                .replace(/</g, "&lt;")
                .replace(/>/g, "&gt;")
                .replace(/"/g, "&quot;")
                .replace(/'/g, "&#039;");
        }

        function renderTable() {
            const $tbody = $('#tableBody');
            $tbody.empty();

            if (dataList.length === 0) {
                $tbody.html('<tr><td colspan="4" style="text-align:center; padding: 30px; color:#64748b;">No items found.</td></tr>');
                return;
            }

            dataList.forEach(item => {
                let filesHtml = '';
                if (item.files && item.files.length > 0) {
                    filesHtml = '<ul style="margin:0; padding-left:20px; font-size:0.85rem; color:#475569;">';
                    item.files.forEach(f => {
                        filesHtml += `<li><a href="../${f.path}" target="_blank" style="color:#2563eb;">${escapeHtml(f.name)}</a></li>`;
                    });
                    filesHtml += '</ul>';
                }

                const tr = $(`
                    <tr>
                        <td>
                            <strong style="color: #1e293b;">${escapeHtml(item.title)}</strong>
                            <div style="margin-top:5px;">
                                <span class="type-badge type-${item.display_type}">${item.display_type}</span>
                            </div>
                        </td>
                        <td>${filesHtml}</td>
                        <td>
                            <div style="font-size:0.85rem;">
                                <div><strong style="color:#64748b;">From:</strong> ${formatDate(item.visible_from)}</div>
                                <div><strong style="color:#64748b;">Upto:</strong> ${item.visible_upto ? formatDate(item.visible_upto) : '<em>No expiry</em>'}</div>
                            </div>
                        </td>
                        <td style="text-align: right;">
                            <div style="display: flex; justify-content: flex-end; gap: 8px;">
                                <button class="btn-icon" onclick="editItem(${item.id})" title="Edit" style="background: var(--bg-slate); border: 1px solid rgba(0,0,0,0.1); width: 32px; height: 32px; border-radius: 6px;"><i class="fa-solid fa-pen" style="color:var(--text-dark);"></i></button>
                                <button class="btn-icon" onclick="deleteItem(${item.id})" title="Delete" style="background: #fff0f0; border: 1px solid rgba(239,68,68,0.2); width: 32px; height: 32px; border-radius: 6px;"><i class="fa-solid fa-trash-can" style="color:#ef4444;"></i></button>
                            </div>
                        </td>
                    </tr>
                `);
                $tbody.append(tr);
            });
        }

        function updatePaginationUI() {
            $('#pageInfo').text(`Page ${currentPage} of ${totalPages}`);
            $('#prevPage').prop('disabled', currentPage <= 1).css('opacity', currentPage <= 1 ? '0.5' : '1');
            $('#nextPage').prop('disabled', currentPage >= totalPages).css('opacity', currentPage >= totalPages ? '0.5' : '1');
        }

        // File removal function for the edit form
        window.removeExistingFile = function(index) {
            currentEditingFiles.splice(index, 1);
            renderCurrentFiles();
        };

        function renderCurrentFiles() {
            const container = $('#currentFilesList');
            container.empty();

            if (currentEditingFiles.length > 0) {
                currentEditingFiles.forEach((f, i) => {
                    container.append(`
                        <div class="file-item">
                            <a href="../${f.path}" target="_blank"><i class="fa-regular fa-file"></i> ${escapeHtml(f.name)}</a>
                            <i class="fa-solid fa-times remove-file" title="Remove File" onclick="removeExistingFile(${i})"></i>
                        </div>
                    `);
                });
            }
        }

        window.editItem = function(id) {
            const item = dataList.find(v => v.id == id);
            if (!item) return;

            $('#formCardTitle').html('<i class="fa-solid fa-pen" style="color:#f59e0b;"></i> Edit Item');
            $('#itemIdInput').val(item.id);
            $('#itemTitle').val(item.title);
            $('#visibleFrom').val(item.visible_from);
            $('#visibleUpto').val(item.visible_upto || '');
            $('#displayType').val(item.display_type || 'Public');

            currentEditingFiles = JSON.parse(JSON.stringify(item.files || []));
            renderCurrentFiles();

            if (!$('#formCard').hasClass('active')) {
                $('#formCard').hide().addClass('active').slideDown(300);
                $('#toggleAddFormBtn').html('<i class="fa-solid fa-xmark"></i> <span id="addBtnText">Cancel</span>');
            }

            $('html, body').animate({
                scrollTop: $('#formCard').offset().top - 100
            }, 300);
        };

        window.deleteItem = function(id) {
            if (!confirm('Are you sure you want to delete this item? Associated files will be permanently deleted.')) return;

            $.post(API_URL, {
                action: 'delete_form',
                id: id
            }, function(r) {
                if (r.success) {
                    showToast('success', r.message);
                    if (dataList.length === 1 && currentPage > 1) {
                        currentPage--;
                    }
                    loadData();
                } else {
                    showToast('error', r.message || 'Error deleting item.');
                }
            }, 'json').fail(function() {
                showToast('error', 'Server connection failed.');
            });
        };

        // Show Toast function
        function showToast(type, message) {
            const toast = $('<div class="toast toast-' + type + '"><i class="fa-solid ' + (type === 'success' ? 'fa-check-circle' : 'fa-circle-exclamation') + '"></i> ' + escapeHtml(message) + '</div>');
            $('#toastContainer').append(toast);

            setTimeout(() => {
                toast.addClass('show');
            }, 10);

            setTimeout(() => {
                toast.removeClass('show');
                setTimeout(() => {
                    toast.remove();
                }, 300);
            }, 3000);
        }
    </script>
</body>

</html>