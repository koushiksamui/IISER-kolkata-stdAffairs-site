<?php
if (session_status() === PHP_SESSION_NONE) session_start();
if (empty($_SESSION['admin_logged_in'])) {
    echo '<p style="color:#ef4444;padding:20px;">Unauthorized.</p>';
    exit;
}
?>
<style>
    #deansmEditor .ql-editor h1,
    #deansmEditor .ql-editor h2,
    #deansmEditor .ql-editor h3 {
        border-left: 4px solid #f59e0b;
        padding-left: 12px;
        color: #1a1a1a;
        font-weight: 600;
    }
    #deansmEditor .ql-editor h1:first-child,
    #deansmEditor .ql-editor h2:first-child,
    #deansmEditor .ql-editor h3:first-child {
        margin-top: 0;
    }
    #deansmEditor .ql-editor p {
        color: #333;
    }
</style>

<div id="deansMessagePartial" style="padding: 10px 0;">
    <form id="deansMessageForm" enctype="multipart/form-data">
        <div style="margin-bottom: 32px;">
            <h3 style="font-family: var(--font-heading); color: var(--primary-forest); margin-bottom: 6px; font-size: 1.15rem; font-weight: 700;">
                <i class="fa-solid fa-align-left" style="color: var(--accent-emerald); margin-right: 8px;"></i>
                Page Content
            </h3>
            <div style="background-color: rgba(224, 159, 62, 0.1); border-left: 4px solid var(--accent-gold); padding: 12px 16px; border-radius: 4px; margin-bottom: 20px;">
                <p style="color: var(--text-dark); font-size: 0.9rem; margin: 0; margin-bottom: 6px;">
                    <strong>Instructions:</strong> Write and format the main content for the Message from the Deans page below. 
                </p>
            </div>
            <div id="deansmEditorContainer" style="background: white; border-radius: 8px; border: 1px solid rgba(0,0,0,0.1);">
                <div id="deansmEditor" style="height: 400px; font-family: 'Lato', sans-serif; font-size: 16px;"></div>
            </div>
            <input type="hidden" name="content" id="deansmContentHidden">
        </div>

        <div class="pf-actions" style="display: flex; gap: 12px; align-items: center; border-top: 1px solid rgba(0,0,0,0.08); padding-top: 24px;">
            <button type="button" class="btn-pf-save" id="deansmSaveBtn">
                <i class="fa-solid fa-cloud-arrow-up"></i> Save Message from the Deans
            </button>
            <button type="button" class="btn-pf-reset" id="deansmClearBtn">
                <i class="fa-solid fa-trash-can"></i> Clear
            </button>

            <div style="margin-left: auto; display: flex; align-items: center; gap: 16px;">
                <span class="partial-saved-badge" id="deansmSavedBadge" style="display:none; background: rgba(34, 160, 101, 0.12); color: var(--accent-emerald); padding: 6px 12px; border-radius: 8px; font-size: 0.8rem; font-weight: 700;">
                    <i class="fa-solid fa-circle-check"></i> Saved
                </span>
                <span class="pf-last-saved" id="deansmLastSaved" style="font-size: 0.85rem; color: var(--text-muted);">
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
        var SLUG = 'deans_message';

        var quill = new Quill('#deansmEditor', {
            theme: 'snow',
            placeholder: 'Write and format the main content for the Message from the Deans page...',
            modules: {
                toolbar: {
                    container: [
                        [{ 'header': [1, 2, 3, 4, false] }],
                        ['bold', 'italic', 'underline', 'strike'],
                        [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                        [{ 'align': [] }],
                        ['link'],
                        ['clean']
                    ]
                }
            }
        });

        $('.ql-toolbar').css({
            'border-top-left-radius': '8px',
            'border-top-right-radius': '8px',
            'border-color': 'rgba(0,0,0,0.1)',
            'background-color': '#f8f9fa'
        });
        $('.ql-container').css({
            'border-bottom-left-radius': '8px',
            'border-bottom-right-radius': '8px',
            'border-color': 'rgba(0,0,0,0.1)'
        });

        function formatDateTime(datetimeStr) {
            if (!datetimeStr) return '';
            var d = new Date(datetimeStr.replace(/-/g, '/'));
            if (isNaN(d.getTime())) return datetimeStr;
            return d.toLocaleString([], { month: 'short', day: 'numeric', year: 'numeric', hour: '2-digit', minute: '2-digit' });
        }

        function loadData() {
            $.ajax({
                url: API,
                type: 'GET',
                dataType: 'json',
                data: { action: 'get_page', slug: SLUG },
                success: function(r) {
                    if (r.success) {
                        quill.root.innerHTML = r.content || '';
                    }
                }
            });
        }

        function save() {
            var $btn = $('#deansmSaveBtn');
            $btn.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin"></i> Saving…');

            var formData = new FormData($('#deansMessageForm')[0]);
            formData.append('action', 'save_page');
            formData.append('slug', SLUG);

            var content = quill.root.innerHTML;
            if (content === '<p><br></p>') content = '';

            if (content) {
                var $temp = $('<div>').html(content);
                $temp.find('h1, h2, h3, h4').css({
                    'border-left': '4px solid #f59e0b',
                    'padding-left': '12px',
                    'color': '#1a1a1a',
                    'font-weight': '600'
                });
                $temp.find('h1:first-child, h2:first-child, h3:first-child, h4:first-child').css('margin-top', '0');
                content = $temp.html();
            }

            formData.append('content', content);

            $.ajax({
                url: API,
                type: 'POST',
                dataType: 'json',
                data: formData,
                contentType: false,
                processData: false,
                success: function(r) {
                    $btn.prop('disabled', false).html('<i class="fa-solid fa-cloud-arrow-up"></i> Save Message from the Deans');
                    if (r.success) {
                        window.showToast && showToast('success', r.message);
                        var dateStr = formatDateTime(r.saved_at);
                        $('#deansmLastSaved span').text('Last updated: ' + dateStr);
                        $('#deansmSavedBadge').fadeIn(200).delay(2500).fadeOut(400);
                    } else {
                        window.showToast && showToast('error', r.message || 'Save failed.');
                    }
                },
                error: function() {
                    $btn.prop('disabled', false).html('<i class="fa-solid fa-cloud-arrow-up"></i> Save Message from the Deans');
                    window.showToast && showToast('error', 'Network error while saving.');
                }
            });
        }

        loadData();

        $('#deansmSaveBtn').on('click', save);
        $('#deansmClearBtn').on('click', function() {
            if (confirm('Clear all content?')) {
                quill.root.innerHTML = '';
                $('#deansMessageForm')[0].reset();
            }
        });
        $(document).off('page:save.deans_message').on('page:save.deans_message', function(e, slug) {
            if (slug === SLUG) save();
        });
    }(jQuery));
</script>
