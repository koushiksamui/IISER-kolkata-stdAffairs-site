<?php
if (session_status() === PHP_SESSION_NONE) session_start();
if (empty($_SESSION['admin_logged_in'])) {
    echo '<p style="color:#ef4444;padding:20px;">Unauthorized.</p>';
    exit;
}
?>

<div id="contactUsPartial" style="padding: 10px 0;">

    <form id="contactUsForm">

        <!-- SECTION: Office Address -->
        <div style="margin-bottom: 24px;">
            <label for="cuOfficeAddress" style="font-family: var(--font-heading); color: var(--primary-forest); margin-bottom: 8px; font-size: 1.05rem; font-weight: 700; display: block;">
                <i class="fa-solid fa-location-dot" style="color: var(--accent-emerald); margin-right: 8px;"></i>
                Office Address
            </label>
            <textarea name="office_address" id="cuOfficeAddress" rows="4" style="width: 100%; padding: 10px 12px; border-radius: 8px; border: 1px solid rgba(0,0,0,0.15); font-family: 'Lato', sans-serif; font-size: 0.95rem; resize: vertical;" placeholder="Enter the department's office address..."></textarea>
        </div>

        <!-- SECTION: Email Address -->
        <div style="margin-bottom: 24px;">
            <label for="cuEmailAddress" style="font-family: var(--font-heading); color: var(--primary-forest); margin-bottom: 8px; font-size: 1.05rem; font-weight: 700; display: block;">
                <i class="fa-solid fa-envelope" style="color: var(--accent-emerald); margin-right: 8px;"></i>
                Email Address
            </label>
            <input type="email" name="email_address" id="cuEmailAddress" style="width: 100%; padding: 10px 12px; border-radius: 8px; border: 1px solid rgba(0,0,0,0.15); font-family: 'Lato', sans-serif; font-size: 0.95rem;" placeholder="Enter email address (e.g. sisas@iitg.ac.in)...">
        </div>

        <!-- SECTION: Phone Number -->
        <div style="margin-bottom: 32px;">
            <label for="cuPhoneNumber" style="font-family: var(--font-heading); color: var(--primary-forest); margin-bottom: 8px; font-size: 1.05rem; font-weight: 700; display: block;">
                <i class="fa-solid fa-phone" style="color: var(--accent-emerald); margin-right: 8px;"></i>
                Phone Number
            </label>
            <input type="text" name="phone_number" id="cuPhoneNumber" style="width: 100%; padding: 10px 12px; border-radius: 8px; border: 1px solid rgba(0,0,0,0.15); font-family: 'Lato', sans-serif; font-size: 0.95rem;" placeholder="Enter phone number (e.g. +91-361-2583000)...">
        </div>

        <!-- Footer Actions -->
        <div class="pf-actions" style="display: flex; gap: 12px; align-items: center; border-top: 1px solid rgba(0,0,0,0.08); padding-top: 24px;">
            <button type="button" class="btn-pf-save" id="contactSaveBtn">
                <i class="fa-solid fa-cloud-arrow-up"></i> Save Contact Us
            </button>
            <button type="button" class="btn-pf-reset" id="contactClearBtn">
                <i class="fa-solid fa-trash-can"></i> Clear
            </button>

            <div style="margin-left: auto; display: flex; align-items: center; gap: 16px;">
                <span class="partial-saved-badge" id="contactSavedBadge" style="display:none; background: rgba(34, 160, 101, 0.12); color: var(--accent-emerald); padding: 6px 12px; border-radius: 8px; font-size: 0.8rem; font-weight: 700;">
                    <i class="fa-solid fa-circle-check"></i> Saved
                </span>
                <span class="pf-last-saved" id="contactLastSaved" style="font-size: 0.85rem; color: var(--text-muted);">
                    <i class="fa-regular fa-clock"></i>
                    <span>Not yet saved this session</span>
                </span>
            </div>
        </div>

    </form>
</div>

<script>
    (function($) {
        var API = '../api/page_content.php';
        var SLUG = 'contact_us';

        // Formats a MySQL datetime (YYYY-MM-DD HH:MM:SS) for display
        function formatDateTime(datetimeStr) {
            if (!datetimeStr) return '';
            var d = new Date(datetimeStr.replace(/-/g, '/'));
            if (isNaN(d.getTime())) return datetimeStr;
            return d.toLocaleString([], {
                month: 'short',
                day: 'numeric',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });
        }

        // Load Data
        function loadData() {
            $.ajax({
                url: API,
                type: 'GET',
                dataType: 'json',
                data: {
                    action: 'get_contact_us'
                },
                success: function(r) {
                    if (r.success && r.data) {
                        $('#cuOfficeAddress').val(r.data.office_address || '');
                        $('#cuEmailAddress').val(r.data.email_address || '');
                        $('#cuPhoneNumber').val(r.data.phone_number || '');

                        if (r.data.last_updated) {
                            var dateStr = formatDateTime(r.data.last_updated);
                            var userStr = r.data.updated_by ? ' by ' + r.data.updated_by : '';
                            $('#contactLastSaved span').text('Last updated: ' + dateStr + userStr);
                        }
                    }
                }
            });
        }

        // Save
        function save() {
            var $btn = $('#contactSaveBtn');
            $btn.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin"></i> Saving…');

            var formData = new FormData($('#contactUsForm')[0]);
            formData.append('action', 'save_contact_us');

            $.ajax({
                url: API,
                type: 'POST',
                dataType: 'json',
                data: formData,
                contentType: false,
                processData: false,
                success: function(r) {
                    $btn.prop('disabled', false).html('<i class="fa-solid fa-cloud-arrow-up"></i> Save Contact Us');
                    if (r.success) {
                        window.showToast && showToast('success', r.message);

                        var dateStr = formatDateTime(r.saved_at);
                        var userStr = r.updated_by ? ' by ' + r.updated_by : '';
                        $('#contactLastSaved span').text('Last updated: ' + dateStr + userStr);

                        $('#contactSavedBadge').fadeIn(200).delay(2500).fadeOut(400);
                    } else {
                        window.showToast && showToast('error', r.message || 'Save failed.');
                    }
                },
                error: function() {
                    $btn.prop('disabled', false).html('<i class="fa-solid fa-cloud-arrow-up"></i> Save Contact Us');
                    window.showToast && showToast('error', 'Network error while saving.');
                }
            });
        }

        // Initialize load
        loadData();

        $('#contactSaveBtn').on('click', save);
        $('#contactClearBtn').on('click', function() {
            if (confirm('Clear all fields?')) {
                $('#cuOfficeAddress').val('');
                $('#cuEmailAddress').val('');
                $('#cuPhoneNumber').val('');
            }
        });
        $(document).off('page:save.contact_us').on('page:save.contact_us', function(e, slug) {
            if (slug === SLUG) save();
        });
    }(jQuery));
</script>
