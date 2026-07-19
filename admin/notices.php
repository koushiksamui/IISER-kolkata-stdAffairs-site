<?php

/**
 * SiSAS-IITG Admin — Notices Management
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
    <title>Notices Management &mdash; SiSAS-IITG Admin</title>
    <meta name="description" content="Manage Notices and News for the SiSAS-IITG portal.">
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
        .status-badge {
            display: inline-flex !important;
            align-items: center !important;
            gap: 6px !important;
            padding: 6px 12px !important;
            border-radius: 4px;
            font-size: 0.8rem;
            font-weight: 600;
            white-space: nowrap;
        }
        .status-badge i {
            display: inline-block !important;
            margin: 0 !important;
        }
        .status-published { background-color: #e6f4ea; color: #1e8e3e; }
        .status-scheduled { background-color: #fef7e0; color: #b06000; }
        .type-badge {
            font-size: 0.8rem;
            font-weight: bold;
            color: #555;
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
            <main class="admin-content" id="newsMain">

                <!-- Page Header -->
                <div class="page-header">
                    <div class="page-header-left">
                        <h1><i class="fa-solid fa-newspaper" style="color:var(--accent-blue);margin-right:10px;font-size:1.5rem;"></i>Notices Management</h1>
                        <p>Upload, schedule, and manage notices for the portal.</p>
                    </div>
                    <button class="btn-primary-action" id="toggleAddFormBtn">
                        <i class="fa-solid fa-plus"></i> <span id="addBtnText">Add New Notice</span>
                    </button>
                </div>

                <!-- ===== ADD/EDIT NOTICE FORM CARD ===== -->
                <div class="form-card" id="noticeFormCard">
                    <div class="form-card-header">
                        <h3 id="formCardTitle"><i class="fa-solid fa-file-circle-plus"></i> Add New Notice</h3>
                        <button class="btn-close-form" id="closeFormBtn" title="Close form">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                    <div class="form-card-body">
                        <form id="noticeForm" enctype="multipart/form-data" novalidate>
                            <input type="hidden" name="id" id="noticeIdInput" value="0">

                            <div class="form-grid">
                                <div class="form-group full-width">
                                    <label class="form-label" for="noticeTitle">Title *</label>
                                    <input type="text" name="title" id="noticeTitle" class="form-control" required placeholder="Enter notice title">
                                </div>
                                


                                <div class="form-group">
                                    <label class="form-label" for="noticeType">Type *</label>
                                    <select name="type" id="noticeType" class="form-select" required>
                                        <option value="Academic">Academic</option>
                                        <option value="Finance">Finance</option>
                                        <option value="Disciplinary">Disciplinary</option>
                                        <option value="Others">Others</option>
                                    </select>
                                </div>

                                <div class="form-group full-width" id="otherTypeNameGroup" style="display:none;">
                                    <label class="form-label" for="otherTypeName">Other Type Name *</label>
                                    <input type="text" name="other_type_name" id="otherTypeName" class="form-control" placeholder="Specify the type">
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="noticeLink">Link (Optional)</label>
                                    <input type="url" name="link" id="noticeLink" class="form-control" placeholder="https://...">
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="noticePdf">PDF Upload (Optional)</label>
                                    <input type="file" name="pdf_file" id="noticePdf" class="form-control" accept="application/pdf">
                                </div>
                                
                                <div class="form-group full-width">
                                    <label class="form-label">Publishing Mode</label>
                                    <div style="display:flex; gap:20px; align-items:center; margin-top:10px;">
                                        <label><input type="radio" name="status" value="published" checked id="statusPublished"> Publish Now</label>
                                        <label><input type="radio" name="status" value="scheduled" id="statusScheduled"> Schedule for Later</label>
                                    </div>
                                </div>
                                
                                <div class="form-group full-width">
                                    <label style="display:flex; align-items:center; gap:8px;">
                                        <input type="checkbox" name="is_pinned" id="isPinned" value="1">
                                        <strong>Pin to Top</strong>
                                    </label>
                                </div>

                                <div class="form-group" id="pinnedTillGroup" style="display:none;">
                                    <label class="form-label" for="pinnedTill">Pinned Till Date (Optional)</label>
                                    <input type="date" name="pinned_till" id="pinnedTill" class="form-control">
                                    <p style="font-size: 0.8rem; color: var(--text-muted); margin-top: 5px;">Leave blank to keep it pinned forever until you manually uncheck it. If a date is set, the notice will automatically be unpinned on that date.</p>
                                </div>

                                <div class="form-group" id="scheduledTimeGroup" style="display:none;">
                                    <label class="form-label">Scheduled Date & Time *</label>
                                    <div style="display:flex; gap:10px;">
                                        <input type="date" id="scheduledDateInput" class="form-control" style="flex:1;">
                                        <select id="scheduledTimeInput" class="form-select" style="flex:1;" disabled>
                                            <option value="">Select Time</option>
                                        </select>
                                        <input type="hidden" name="scheduled_time" id="scheduledTime">
                                    </div>
                                    <p style="font-size: 0.8rem; color: var(--text-muted); margin-top: 5px;">The notice will automatically become visible on the public portal at this time.</p>
                                </div>
                            </div>

                            <div class="form-actions">
                                <button type="button" class="btn-cancel" id="cancelFormBtn">Cancel</button>
                                <button type="submit" class="btn-submit" id="submitFormBtn">
                                    <i class="fa-solid fa-check"></i> Save Notice
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- ===== DATA GRID FOR NOTICES ===== -->
                <div class="data-table-wrapper" id="noticeTableWrapper">
                    <div class="data-table-header">
                        <h4><i class="fa-solid fa-list"></i> List of Notices</h4>
                        <div class="search-box">
                            <i class="fa-solid fa-search"></i>
                            <input type="text" id="noticeSearchInput" placeholder="Search notices...">
                        </div>
                    </div>
                    <div style="overflow-x: auto;">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Date</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Attachments</th>
                                    <th style="text-align: right;">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="noticeTableBody">
                                <!-- Data injected via JS -->
                            </tbody>
                        </table>
                    </div>
                    <!-- Pagination -->
                    <div class="pagination-wrapper" style="display:flex; justify-content:space-between; align-items:center; padding: 16px 24px; border-top: 1px solid rgba(0,0,0,0.05); background-color: #fafafa;">
                        <div class="page-limit-selector" style="display: flex; align-items: center; gap: 10px;">
                            <label for="noticePageLimit" style="font-size: 0.85rem; color: var(--text-muted); font-weight: 600; margin: 0;">Rows per page:</label>
                            <select id="noticePageLimit" class="form-select" style="width:auto; display:inline-block; padding: 6px 32px 6px 12px; font-size: 0.85rem; background-position: right 10px center; height: auto;">
                                <option value="5">5</option>
                                <option value="10" selected>10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                            </select>
                        </div>
                        <div class="pagination-controls" style="display:flex; align-items:center; gap: 15px;">
                            <button type="button" id="noticePrevPage" class="btn-icon" style="background-color: var(--white); border: 1px solid rgba(0,0,0,0.1); color: var(--text-dark); width: 32px; height: 32px; border-radius: 6px;"><i class="fa-solid fa-chevron-left" style="font-size: 0.8rem;"></i></button>
                            <span id="noticePageInfo" style="font-size: 0.85rem; font-weight: 600; color: var(--text-dark);">Page 1</span>
                            <button type="button" id="noticeNextPage" class="btn-icon" style="background-color: var(--white); border: 1px solid rgba(0,0,0,0.1); color: var(--text-dark); width: 32px; height: 32px; border-radius: 6px;"><i class="fa-solid fa-chevron-right" style="font-size: 0.8rem;"></i></button>
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>

    <!-- Toast Notifications -->
    <div id="toastContainer" class="toast-container"></div>

    <!-- Script for Sidebar logic -->
    <script>
        $(document).ready(function() {
            $('#sidebarToggleBtn, #sidebarOverlay').on('click', function() {
                $('#adminSidebar').toggleClass('active');
                $('#sidebarOverlay').toggleClass('active');
            });
        });
    </script>

        <script src="../dist/js/admin_toast.js"></script>
    <!-- Main Logic Script -->
    <script>
        // --- GLOBAL STATE ---
        const API_URL = '../api/notices.php';
        let dataList = [];

        // Pagination State
        let currentPage = 1;
        let limit = 10;
        let searchTerm = '';
        let totalPages = 1;

        // --- INIT ---
        $(document).ready(function() {
            loadNotices();
            
            // Set minimum date to today for the date picker
            const now = new Date();
            const todayStr = now.getFullYear() + '-' + String(now.getMonth() + 1).padStart(2, '0') + '-' + String(now.getDate()).padStart(2, '0');
            $('#scheduledDateInput').attr('min', todayStr);

            // Toggle Scheduling Field
            $('input[name="status"]').change(function() {
                if ($('#statusScheduled').is(':checked')) {
                    $('#scheduledTimeGroup').slideDown();
                    $('#scheduledDateInput, #scheduledTimeInput').prop('required', true);
                    updateTimeOptions();
                } else {
                    $('#scheduledTimeGroup').slideUp();
                    $('#scheduledDateInput, #scheduledTimeInput').prop('required', false);
                }
            });

            // Toggle Others Type Field
            $('#noticeType').change(function() {
                if ($(this).val() === 'Others') {
                    $('#otherTypeNameGroup').slideDown();
                    $('#otherTypeName').prop('required', true);
                } else {
                    $('#otherTypeNameGroup').slideUp();
                    $('#otherTypeName').prop('required', false);
                }
            });

            // Toggle Pinned Till Field
            $('#isPinned').change(function() {
                if ($(this).is(':checked')) {
                    $('#pinnedTillGroup').slideDown();
                } else {
                    $('#pinnedTillGroup').slideUp();
                    $('#pinnedTill').val(''); // clear the value when unchecking
                }
            });

            $('#scheduledDateInput').change(function() {
                updateTimeOptions();
                updateHiddenTime();
            });
            $('#scheduledTimeInput').change(function() {
                updateHiddenTime();
            });

            function updateTimeOptions() {
                const dateVal = $('#scheduledDateInput').val();
                const timeSelect = $('#scheduledTimeInput');
                const previousVal = timeSelect.val();
                
                if (!dateVal) {
                    timeSelect.empty().append('<option value="">Select Time</option>');
                    timeSelect.prop('disabled', true);
                    return;
                }

                timeSelect.prop('disabled', false);

                const selectedDate = new Date(dateVal);
                const now = new Date();
                const todayStr = now.getFullYear() + '-' + String(now.getMonth() + 1).padStart(2, '0') + '-' + String(now.getDate()).padStart(2, '0');
                const isToday = (dateVal === todayStr);
                
                const currentHour = now.getHours();
                const currentMinute = now.getMinutes();

                timeSelect.empty();
                timeSelect.append('<option value="">Select Time</option>');

                for (let h = 0; h < 24; h++) {
                    for (let m = 0; m < 60; m += 30) {
                        let disabled = false;
                        if (isToday) {
                            if (h < currentHour || (h === currentHour && m <= currentMinute)) {
                                disabled = true;
                            }
                        }
                        
                        let hh = h.toString().padStart(2, '0');
                        let mm = m.toString().padStart(2, '0');
                        let timeStr = `${hh}:${mm}`;
                        
                        let period = h >= 12 ? 'PM' : 'AM';
                        let displayH = h % 12 || 12;
                        let displayTime = `${displayH.toString().padStart(2, '0')}:${mm} ${period}`;
                        
                        // Keep previous value even if disabled, to prevent it from disappearing during edit
                        if (disabled && previousVal !== timeStr) {
                            timeSelect.append(`<option value="${timeStr}" disabled>${displayTime}</option>`);
                        } else {
                            let selected = (previousVal === timeStr) ? 'selected' : '';
                            timeSelect.append(`<option value="${timeStr}" ${selected}>${displayTime}</option>`);
                        }
                    }
                }
                
                if (timeSelect.find('option:selected').prop('disabled')) {
                    timeSelect.val('');
                }
            }

            function updateHiddenTime() {
                const dateVal = $('#scheduledDateInput').val();
                const timeVal = $('#scheduledTimeInput').val();
                if (dateVal && timeVal) {
                    $('#scheduledTime').val(`${dateVal}T${timeVal}`);
                } else {
                    $('#scheduledTime').val('');
                }
            }

            // Toggle form
            $('#toggleAddFormBtn').click(function() {
                resetForm();
                $('#formCardTitle').html('<i class="fa-solid fa-file-circle-plus"></i> Add New Notice');
                $('#noticeFormCard').addClass('active');
                $('.main-panel').animate({ scrollTop: 0 }, 300);
            });

            $('#closeFormBtn, #cancelFormBtn').click(function() {
                $('#noticeFormCard').removeClass('active');
            });

            // Server-side Search filters
            let searchTimeout;
            $('#noticeSearchInput').on('keyup', function() {
                clearTimeout(searchTimeout);
                searchTerm = $(this).val();
                currentPage = 1;
                searchTimeout = setTimeout(() => loadNotices(), 400);
            });

            // Pagination Listeners
            $('#noticePageLimit').change(function() {
                limit = parseInt($(this).val());
                currentPage = 1;
                loadNotices();
            });
            $('#noticePrevPage').click(function() {
                if (currentPage > 1) {
                    currentPage--;
                    loadNotices();
                }
            });
            $('#noticeNextPage').click(function() {
                if (currentPage < totalPages) {
                    currentPage++;
                    loadNotices();
                }
            });

            // Form Submit
            $('#noticeForm').submit(function(e) {
                e.preventDefault();
                if (!$('#noticeTitle').val().trim()) {
                    showToast('error', 'Title is required.');
                    return;
                }
                
                if ($('#noticeType').val() === 'Others' && !$('#otherTypeName').val().trim()) {
                    showToast('error', 'Please specify the other type name.');
                    return;
                }
                
                if ($('#statusScheduled').is(':checked') && !$('#scheduledTime').val()) {
                    showToast('error', 'Scheduled time is required when scheduling.');
                    return;
                }

                const fd = new FormData(this);
                fd.append('action', 'save_notice');

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
                            $('#noticeFormCard').removeClass('active');
                            loadNotices();
                        } else {
                            showToast('error', r.message || 'Error saving notice.');
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
        });

        // --- FUNCTIONS ---
        function loadNotices() {
            $.getJSON(API_URL, { 
                action: 'get_notices',
                page: currentPage,
                limit: limit,
                search: searchTerm
            }, function(r) {
                if (r.success) {
                    dataList = r.data;
                    totalPages = Math.ceil(r.total / r.limit) || 1;
                    renderTable();
                    updatePaginationUI();
                } else {
                    showToast('error', 'Failed to load notices.');
                }
            });
        }

        function updatePaginationUI() {
            $('#noticePageInfo').text(`Page ${currentPage} of ${totalPages}`);
            $('#noticePrevPage').prop('disabled', currentPage <= 1).css('opacity', currentPage <= 1 ? '0.5' : '1');
            $('#noticeNextPage').prop('disabled', currentPage >= totalPages).css('opacity', currentPage >= totalPages ? '0.5' : '1');
        }

        function resetForm() {
            $('#noticeForm')[0].reset();
            $('#noticeIdInput').val('0');
            $('#scheduledDateInput').val('');
            $('#scheduledTimeInput').val('');
            $('#scheduledTime').val('');
            $('#statusPublished').prop('checked', true).trigger('change');
            
            $('#otherTypeNameGroup').hide();
            $('#pinnedTillGroup').hide();
            $('#isPinned').prop('checked', false);
        }

        function renderTable() {
            const tbody = $('#noticeTableBody');
            tbody.empty();

            if (dataList.length === 0) {
                tbody.append('<tr><td colspan="6" style="text-align:center; padding: 20px;">No notices found.</td></tr>');
                return;
            }

            dataList.forEach(item => {
                let statusHtml = '';
                if (item.status === 'scheduled') {
                    statusHtml = `<span class="status-badge status-scheduled"><i class="fa-regular fa-clock"></i> Scheduled (${formatDate(item.scheduled_time)})</span>`;
                } else {
                    statusHtml = `<span class="status-badge status-published"><i class="fa-solid fa-check"></i> Published</span>`;
                }

                let attachHtml = '';
                if (item.pdf_path) {
                    attachHtml += `<a href="../${item.pdf_path}" target="_blank" title="View PDF"><i class="fa-solid fa-file-pdf" style="color:var(--accent-red);font-size:1.2rem;"></i></a>`;
                }
                if (item.link) {
                    attachHtml += ` <a href="${item.link}" target="_blank" title="Open Link"><i class="fa-solid fa-link" style="color:var(--accent-blue);font-size:1.2rem;margin-left:8px;"></i></a>`;
                }
                if (!attachHtml) attachHtml = '-';
                
                let displayType = item.type === 'Others' && item.other_type_name ? escapeHtml(item.other_type_name) : escapeHtml(item.type);
                let pinHtml = parseInt(item.is_pinned) === 1 ? ' <i class="fa-solid fa-thumbtack" style="color: #dc3545; margin-left: 8px;" title="Pinned"></i>' : '';

                const tr = $(`
                    <tr>
                        <td><strong>${escapeHtml(item.title)}</strong>${pinHtml}</td>
                        <td>${formatDate(item.created_at)}</td>
                        <td><span class="type-badge">${displayType}</span></td>
                        <td>${statusHtml}</td>
                        <td>${attachHtml}</td>
                        <td style="text-align: right; white-space: nowrap;">
                            <div style="display: inline-flex; gap: 8px;">
                                <button class="btn-icon" onclick="editNotice(${item.id})" title="Edit"><i class="fa-solid fa-pen-to-square"></i></button>
                                <button class="btn-icon text-red" onclick="deleteNotice(${item.id})" title="Delete"><i class="fa-solid fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                `);
                tbody.append(tr);
            });
        }

        function formatDate(dateStr) {
            if (!dateStr) return '';
            const d = new Date(dateStr);
            if (isNaN(d.getTime())) return dateStr;
            return d.toLocaleString('en-GB', { day: 'numeric', month: 'short', year: 'numeric', hour: '2-digit', minute: '2-digit', hour12: true });
        }

        function escapeHtml(str) {
            if (!str) return '';
            return str.replace(/[&<>'"]/g, function(tag) {
                const charsToReplace = {
                    '&': '&amp;', '<': '&lt;', '>': '&gt;', "'": '&#39;', '"': '&quot;'
                };
                return charsToReplace[tag] || tag;
            });
        }

        window.editNotice = function(id) {
            const item = dataList.find(x => x.id == id);
            if (!item) return;

            resetForm();
            $('#noticeIdInput').val(item.id);
            $('#noticeTitle').val(item.title);

            $('#noticeType').val(item.type).trigger('change');
            if (item.type === 'Others') {
                $('#otherTypeName').val(item.other_type_name);
            }

            if (parseInt(item.is_pinned) === 1) {
                $('#isPinned').prop('checked', true).trigger('change');
                if (item.pinned_till) {
                    $('#pinnedTill').val(item.pinned_till.split(' ')[0]);
                }
            } else {
                $('#isPinned').prop('checked', false).trigger('change');
            }

            $('#noticeLink').val(item.link);
            
            if (item.status === 'scheduled') {
                if (item.scheduled_time) {
                    const dt = new Date(item.scheduled_time);
                    if (!isNaN(dt.getTime())) {
                        const local = new Date(dt.getTime() - dt.getTimezoneOffset() * 60000).toISOString().slice(0, 16);
                        const parts = local.split('T');
                        $('#scheduledDateInput').val(parts[0]);
                        
                        let timeParts = parts[1].split(':');
                        let h = parseInt(timeParts[0], 10);
                        let m = parseInt(timeParts[1], 10);
                        m = m < 30 ? 0 : 30;
                        const timeStr = `${h.toString().padStart(2, '0')}:${m.toString().padStart(2, '0')}`;
                        
                        $('#scheduledTimeInput').append(`<option value="${timeStr}"></option>`);
                        $('#scheduledTimeInput').val(timeStr);
                    }
                }
                $('#statusScheduled').prop('checked', true).trigger('change');
                updateHiddenTime();
            } else {
                $('#statusPublished').prop('checked', true).trigger('change');
            }

            $('#formCardTitle').html('<i class="fa-solid fa-pen-to-square"></i> Edit Notice');
            $('#noticeFormCard').addClass('active');
            $('.main-panel').animate({ scrollTop: 0 }, 300);
        };

        window.deleteNotice = function(id) {
            if (!confirm('Are you sure you want to completely delete this notice?')) return;
            $.post(API_URL, { action: 'delete_notice', id: id }, function(r) {
                if (r.success) {
                    showToast('success', r.message);
                    loadNotices();
                } else {
                    showToast('error', r.message || 'Error deleting notice.');
                }
            }, 'json');
        };
    </script>
</body>
</html>
