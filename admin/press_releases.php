<?php

/**
 * SiSAS-IITG Admin — Press Releases Management
 */

require_once '../api/admin_auth.php';
requireAdmin('login.php');
require_once __DIR__ . '/../php_utils/_dbConnect.php';

$adminEmail   = isset($_SESSION['admin_email']) ? $_SESSION['admin_email'] : 'admin@iitg.ac.in';
$adminDisplay = ucfirst(explode('@', $adminEmail)[0]);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Press Releases &mdash; SiSAS-IITG Admin</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;600;700&family=Outfit:wght@400;500;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Quill Editor -->
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>

    <!-- Shared Admin Stylesheet -->
    <link rel="stylesheet" href="../dist/css/admin/dashboard.css">
    <link rel="stylesheet" href="../dist/css/admin/faculty.css">

    <style>
        /* Quill Custom Styling */
        .ql-toolbar {
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
            border-color: rgba(0, 0, 0, 0.1) !important;
            background-color: #f8f9fa;
        }

        .ql-container {
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
            border-color: rgba(0, 0, 0, 0.1) !important;
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
            <?php include_once 'components/header.php'; ?>

            <main class="admin-content">

                <div id="viewPressReleases">
                    <div class="page-header" style="margin-bottom: 30px;">
                        <div class="page-header-left">
                            <h1><i class="fa-solid fa-newspaper" style="color:var(--accent-blue, #3b82f6);margin-right:10px;font-size:1.5rem;"></i> Press Releases</h1>
                            <p>Manage and publish official press releases.</p>
                        </div>
                        <button class="btn-primary-action" id="toggleAddReleaseBtn" style="background-color: var(--accent-blue, #3b82f6);">
                            <i class="fa-solid fa-plus"></i> Add Press Release
                        </button>
                    </div>

                    <!-- Form Card -->
                    <div class="form-card" id="releaseFormCard">
                        <div class="form-card-header" style="border-bottom: 1px solid rgba(0,0,0,0.05); padding-bottom: 15px; margin-bottom: 15px;">
                            <h3 id="releaseFormTitle" style="color: #1f2937; font-size: 1.25rem;"><i class="fa-solid fa-newspaper" style="color:var(--accent-blue, #3b82f6);"></i> Add Press Release</h3>
                            <button class="btn-close-form" id="closeReleaseFormBtn" title="Close form" style="color: #6b7280; font-size: 1.2rem; background: none; border: none; cursor: pointer;">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                        <div class="form-card-body">
                            <form id="releaseForm">
                                <input type="hidden" name="action" value="save_release">
                                <input type="hidden" name="id" id="releaseId" value="0">

                                <div class="form-grid" style="margin-bottom: 20px; display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 20px;">
                                    <div class="form-group">
                                        <label class="form-label" for="releaseTitle" style="font-weight: 700; color: #374151;">Title *</label>
                                        <input type="text" name="title" id="releaseTitle" class="form-control" required placeholder="e.g. SiSAS-IITG Announces New Initiative" style="padding: 10px; border-radius: 6px; border: 1px solid #d1d5db; width: 100%;">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="releaseAuthor" style="font-weight: 700; color: #374151;">Author (Optional)</label>
                                        <input type="text" name="author" id="releaseAuthor" class="form-control" placeholder="e.g. Prof. Arbind K. Patel" style="padding: 10px; border-radius: 6px; border: 1px solid #d1d5db; width: 100%;">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="releaseTags" style="font-weight: 700; color: #374151;">Tags (Comma-separated)</label>
                                        <input type="text" name="tags" id="releaseTags" class="form-control" placeholder="e.g. flood, water, research" style="padding: 10px; border-radius: 6px; border: 1px solid #d1d5db; width: 100%;">
                                    </div>
                                    <div class="form-group full-width">
                                        <label class="form-label" style="font-weight: 700; color: #374151;">Content *</label>
                                        <div id="releaseContentContainer" style="background: white; border-radius: 8px; border: 1px solid rgba(0,0,0,0.1);">
                                            <div id="releaseContentEditor" style="height: 300px; font-family: 'Lato', sans-serif; font-size: 16px;"></div>
                                        </div>
                                        <input type="hidden" name="content" id="releaseContent">
                                    </div>
                                </div>

                                <div class="form-submit-row" style="display: flex; justify-content: flex-end; gap: 15px;">
                                    <button type="button" class="btn-cancel" id="cancelReleaseFormBtn" style="background: none; border: 1px solid rgba(0,0,0,0.1); padding: 10px 20px; border-radius: 6px; font-weight: 600; color: var(--text-muted); cursor: pointer;">
                                        <i class="fa-solid fa-xmark"></i> Cancel
                                    </button>
                                    <button type="submit" class="btn-submit" id="submitReleaseBtn" style="background-color: var(--accent-blue, #3b82f6); color: white; border: none; padding: 10px 24px; border-radius: 6px; font-weight: 600; cursor: pointer;">
                                        <i class="fa-solid fa-check"></i> Save Release
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- List Card -->
                    <div class="data-table-wrapper" id="releaseTableWrapper">
                        <div class="data-table-header">
                            <h4><i class="fa-solid fa-list"></i> All Press Releases</h4>
                            <div class="search-box">
                                <i class="fa-solid fa-search"></i>
                                <input type="text" id="releaseSearchInput" placeholder="Search title...">
                            </div>
                        </div>
                        <div style="overflow-x: auto;">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Created By</th>
                                        <th>Created At</th>
                                        <th style="text-align: right;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="releaseTableBody">
                                    <!-- Populated via AJAX -->
                                </tbody>
                            </table>
                        </div>
                        <!-- Pagination -->
                        <div class="pagination-wrapper" style="display:flex; justify-content:space-between; align-items:center; padding: 16px 24px; border-top: 1px solid rgba(0,0,0,0.05); background-color: #fafafa;">
                            <div class="page-limit-selector" style="display: flex; align-items: center; gap: 10px;">
                                <label for="releasePageLimit" style="font-size: 0.85rem; color: var(--text-muted); font-weight: 600; margin: 0;">Rows per page:</label>
                                <select id="releasePageLimit" class="form-select" style="width:auto; display:inline-block; padding: 6px 32px 6px 12px; font-size: 0.85rem; background-position: right 10px center; height: auto;">
                                    <option value="5">5</option>
                                    <option value="10" selected>10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                </select>
                            </div>
                            <div class="pagination-controls" style="display:flex; align-items:center; gap: 15px;">
                                <button type="button" id="releasePrevPage" class="btn-icon" style="background-color: var(--white); border: 1px solid rgba(0,0,0,0.1); color: var(--text-dark); width: 32px; height: 32px; border-radius: 6px;"><i class="fa-solid fa-chevron-left" style="font-size: 0.8rem;"></i></button>
                                <span id="releasePageInfo" style="font-size: 0.85rem; font-weight: 600; color: var(--text-dark);">Page 1</span>
                                <button type="button" id="releaseNextPage" class="btn-icon" style="background-color: var(--white); border: 1px solid rgba(0,0,0,0.1); color: var(--text-dark); width: 32px; height: 32px; border-radius: 6px;"><i class="fa-solid fa-chevron-right" style="font-size: 0.8rem;"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>

    <!-- Toast Container -->
    <div class="toast-container" id="toastContainer"></div>

    <script>
        const API_URL = '../api/press_releases.php';
        let releaseData = [];

        // Pagination State
        let releasePage = 1;
        let releaseLimit = 10;
        let releaseTotalPages = 1;
        let releaseSearchTerm = '';

        let qContent;

        $(document).ready(function() {
            // Custom Image Handler for Quill
            function selectLocalImage() {
                const input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/jpeg,image/png,image/webp,image/gif');
                input.click();

                input.onchange = () => {
                    const file = input.files[0];
                    if (!file) return;

                    if (!/^image\/(jpeg|png|webp|gif)$/.test(file.type)) {
                        showToast('error', 'Only JPG, PNG, WEBP, and GIF images are allowed.');
                        return;
                    }

                    saveToServer(file);
                };
            }

            function saveToServer(file) {
                const fd = new FormData();
                fd.append('image', file);
                fd.append('action', 'upload_inline_image');

                showToast('info', 'Uploading image...');

                $.ajax({
                    url: API_URL,
                    type: 'POST',
                    data: fd,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(res) {
                        if (res.success && res.url) {
                            insertToEditor(res.url);
                        } else {
                            showToast('error', res.message || 'Image upload failed');
                        }
                    },
                    error: function() {
                        showToast('error', 'Network error during upload');
                    }
                });
            }

            function insertToEditor(url) {
                const range = qContent.getSelection() || {
                    index: qContent.getLength()
                };
                qContent.insertEmbed(range.index, 'image', url);
                qContent.setSelection(range.index + 1);
            }

            // Init Quill
            qContent = new Quill('#releaseContentEditor', {
                theme: 'snow',
                formats: ['header', 'bold', 'italic', 'underline', 'strike', 'list', 'link', 'image'],
                modules: {
                    toolbar: {
                        container: [
                            [{
                                'header': [1, 2, 3, 4, false]
                            }],
                            ['bold', 'italic', 'underline', 'strike'],
                            [{
                                'list': 'ordered'
                            }, {
                                'list': 'bullet'
                            }],
                            ['link', 'image', 'clean']
                        ],
                        handlers: {
                            image: selectLocalImage
                        }
                    }
                },
                placeholder: 'Write the press release content here...'
            });

            loadReleases();

            // Search
            let searchTimeout;
            $('#releaseSearchInput').on('keyup', function() {
                clearTimeout(searchTimeout);
                releaseSearchTerm = $(this).val();
                releasePage = 1;
                searchTimeout = setTimeout(() => {
                    loadReleases();
                }, 400);
            });

            // Pagination Listeners
            $('#releasePageLimit').change(function() {
                releaseLimit = parseInt($(this).val());
                releasePage = 1;
                loadReleases();
            });
            $('#releasePrevPage').click(function() {
                if (releasePage > 1) {
                    releasePage--;
                    loadReleases();
                }
            });
            $('#releaseNextPage').click(function() {
                if (releasePage < releaseTotalPages) {
                    releasePage++;
                    loadReleases();
                }
            });
        });

        // Fetch & Render
        function loadReleases() {
            $('#releaseTableBody').html('<tr><td colspan="4" style="text-align:center; padding: 20px; color: #64748b;"><i class="fa-solid fa-spinner fa-spin"></i> Loading...</td></tr>');
            $.getJSON(API_URL, {
                action: 'get_releases',
                page: releasePage,
                limit: releaseLimit,
                search: releaseSearchTerm
            }, function(res) {
                if (res.success) {
                    releaseData = res.data;
                    releaseTotalPages = Math.ceil(res.total / res.limit) || 1;
                    renderReleases();
                    updatePaginationUI();
                } else {
                    showToast('error', res.message);
                }
            }).fail(function() {
                showToast('error', 'Failed to fetch press releases.');
            });
        }

        function updatePaginationUI() {
            $('#releasePageInfo').text(`Page ${releasePage} of ${releaseTotalPages}`);
            $('#releasePrevPage').prop('disabled', releasePage <= 1).css('opacity', releasePage <= 1 ? '0.5' : '1');
            $('#releaseNextPage').prop('disabled', releasePage >= releaseTotalPages).css('opacity', releasePage >= releaseTotalPages ? '0.5' : '1');
        }

        function renderReleases() {
            const $tbody = $('#releaseTableBody');
            $tbody.empty();

            if (releaseData.length === 0) {
                $tbody.html('<tr><td colspan="4" style="text-align:center; padding: 20px; color: #64748b;"><i class="fa-solid fa-info-circle"></i> No press releases found.</td></tr>');
                return;
            }

            releaseData.forEach((r) => {
                const tr = $(`
                    <tr>
                        <td style="font-weight:600; max-width: 300px; word-wrap: break-word;">${escapeHtml(r.title)}</td>
                        <td style="font-size: 0.85rem; color: #64748b;">${escapeHtml(r.created_by)}</td>
                        <td style="font-size: 0.85rem; color: #64748b;">${r.created_at}</td>
                        <td style="text-align: right;">
                            <div class="action-btns" style="justify-content:flex-end;">
                                <button class="btn-icon btn-edit" onclick="editRelease(${r.id})" title="Edit"><i class="fa-solid fa-pen-to-square"></i></button>
                                <button class="btn-icon btn-delete" onclick="deleteRelease(${r.id})" title="Delete"><i class="fa-solid fa-trash-can"></i></button>
                            </div>
                        </td>
                    </tr>
                `);
                $tbody.append(tr);
            });
        }

        // Form Logic
        $('#toggleAddReleaseBtn').click(function() {
            if ($('#releaseFormCard').hasClass('visible')) {
                closeReleaseForm();
            } else {
                $('#releaseFormTitle').html('<i class="fa-solid fa-newspaper" style="color:var(--accent-blue, #3b82f6);"></i> Add Press Release');
                $('#releaseId').val('0');
                $('#releaseForm')[0].reset();
                qContent.root.innerHTML = '';
                $('#releaseContent').val('');
                $('#releaseFormCard').hide().addClass('visible').slideDown(300);
            }
        });

        $('#closeReleaseFormBtn, #cancelReleaseFormBtn').click(closeReleaseForm);

        function closeReleaseForm() {
            $('#releaseFormCard').slideUp(300, function() {
                $(this).removeClass('visible').css('display', '');
                $('#releaseForm')[0].reset();
                $('#releaseId').val('0');
                qContent.root.innerHTML = '';
                $('#releaseContent').val('');
            });
        }

        $('#releaseForm').submit(function(e) {
            e.preventDefault();

            const contentHtml = qContent.root.innerHTML;
            $('#releaseContent').val(contentHtml === '<p><br></p>' ? '' : contentHtml);

            if (!$('#releaseContent').val().trim()) {
                showToast('error', 'Content is required.');
                return;
            }

            const fd = new FormData(this);
            const btn = $('#submitReleaseBtn');
            const orig = btn.html();
            btn.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin"></i> Saving...');

            $.ajax({
                url: API_URL,
                type: 'POST',
                data: fd,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(res) {
                    if (res.success) {
                        showToast('success', res.message);
                        closeReleaseForm();
                        loadReleases();
                    } else {
                        showToast('error', res.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error:", xhr.responseText);
                    showToast('error', 'Server Error: ' + error);
                },
                complete: function() {
                    btn.prop('disabled', false).html(orig);
                }
            });
        });

        // Edit
        window.editRelease = function(id) {
            const r = releaseData.find(v => v.id == id);
            if (!r) return;

            $('#releaseFormTitle').html('<i class="fa-solid fa-pen" style="color:#f59e0b;"></i> Edit Press Release');
            $('#releaseId').val(r.id);
            $('#releaseTitle').val(r.title);
            $('#releaseAuthor').val(r.author || '');
            $('#releaseTags').val(r.tags || '');

            qContent.root.innerHTML = r.content || '';
            $('#releaseContent').val(r.content || '');

            if (!$('#releaseFormCard').hasClass('visible')) {
                $('#releaseFormCard').hide().addClass('visible').slideDown(300);
            }

            $('html, body').animate({
                scrollTop: $('#releaseFormCard').offset().top - 100
            }, 400);
        };

        // Delete
        window.deleteRelease = function(id) {
            if (!confirm('Are you sure you want to delete this press release? This action cannot be undone.')) return;
            $.post(API_URL, {
                action: 'delete_release',
                id: id
            }, function(res) {
                if (res.success) {
                    showToast('success', res.message);
                    loadReleases();
                } else {
                    showToast('error', res.message);
                }
            }, 'json');
        };

        function escapeHtml(str) {
            if (!str) return '';
            return $('<div>').text(str).html();
        }
    </script>
    <script src="../dist/js/admin_toast.js"></script>
</body>

</html>