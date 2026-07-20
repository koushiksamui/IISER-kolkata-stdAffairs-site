<?php
if (session_status() === PHP_SESSION_NONE) session_start();
if (empty($_SESSION['admin_logged_in'])) {
    echo '<p style="color:#ef4444;padding:20px;">Unauthorized.</p>';
    exit;
}
?>
<style>
    /* Quill Custom Styling - WYSIWYG Experience */
    #auEditor .ql-editor {
        text-align: justify;
    }

    #auEditor .ql-editor h1,
    #auEditor .ql-editor h2,
    #auEditor .ql-editor h3,
    #auEditor .ql-editor h4 {
        font-size: 1.4rem;
        margin-bottom: 0.5rem;
        color: #333;
        font-weight: 600;
        border-left: 5px solid var(--accent-gold, #e09f3e);
        padding-left: 12px;
    }

    #auEditor .ql-editor h1:first-child,
    #auEditor .ql-editor h2:first-child,
    #auEditor .ql-editor h3:first-child,
    #auEditor .ql-editor h4:first-child {
        margin-top: 0;
    }

    #auEditor .ql-editor p {
        font-size: 1.1rem;
        line-height: 1.6;
        color: #666;
        margin-bottom: 1rem;
    }
</style>

<div id="aboutUsPartial" style="padding: 10px 0;">

    <form id="aboutUsForm" enctype="multipart/form-data">

        <!-- SECTION: Rich Text Content -->
        <div style="margin-bottom: 32px;">
            <h3 style="font-family: var(--font-heading); color: var(--primary-forest); margin-bottom: 6px; font-size: 1.15rem; font-weight: 700;">
                <i class="fa-solid fa-align-left" style="color: var(--accent-emerald); margin-right: 8px;"></i>
                Page Content
            </h3>
            <div style="background-color: rgba(224, 159, 62, 0.1); border-left: 4px solid var(--accent-gold); padding: 12px 16px; border-radius: 4px; margin-bottom: 20px;">
                <p style="color: var(--text-dark); font-size: 0.9rem; margin: 0; margin-bottom: 6px;">
                    <strong>Instructions:</strong> Write and format the main content for the About Us page below. You can drag & drop images or use the image button.
                </p>
                <p style="color: var(--primary-forest); font-size: 0.85rem; margin: 0;">
                    <i class="fa-solid fa-circle-info"></i> <strong>Image Rules:</strong> To maintain the website's premium aesthetic, all images must have exactly a <strong>2:1 aspect ratio</strong> (e.g., 1600x800). The image width must be between <strong>1140px and 2280px</strong>.
                </p>
            </div>

            <!-- Quill Editor Container -->
            <div id="auEditorContainer" style="background: white; border-radius: 8px; border: 1px solid rgba(0,0,0,0.1);">
                <div id="auEditor" style="height: 400px; font-family: 'Lato', sans-serif; font-size: 16px;"></div>
            </div>
            <!-- Hidden input to store content for the form -->
            <input type="hidden" name="content" id="auContentHidden">
        </div>

        <!-- Footer Actions -->
        <div class="pf-actions" style="display: flex; gap: 12px; align-items: center; border-top: 1px solid rgba(0,0,0,0.08); padding-top: 24px;">
            <button type="button" class="btn-pf-save" id="aboutSaveBtn">
                <i class="fa-solid fa-cloud-arrow-up"></i> Save About Us
            </button>
            <button type="button" class="btn-pf-reset" id="aboutClearBtn">
                <i class="fa-solid fa-trash-can"></i> Clear
            </button>

            <div style="margin-left: auto; display: flex; align-items: center; gap: 16px;">
                <span class="partial-saved-badge" id="aboutSavedBadge" style="display:none; background: rgba(34, 160, 101, 0.12); color: var(--accent-emerald); padding: 6px 12px; border-radius: 8px; font-size: 0.8rem; font-weight: 700;">
                    <i class="fa-solid fa-circle-check"></i> Saved
                </span>
                <span class="pf-last-saved" id="aboutLastSaved" style="font-size: 0.85rem; color: var(--text-muted);">
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
        var SLUG = 'about_us';

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
                    window.showToast && showToast('error', 'Only JPG, PNG, WEBP, and GIF images are allowed.');
                    return;
                }

                // Client-side dimension check
                const img = new Image();
                img.onload = function() {
                    const ratio = this.width / this.height;
                    const tolerance = 0.05; // Strict 2:1 ratio

                    if (this.width < 1140 || this.width > 2280) {
                        window.showToast && showToast('error', 'Image width must be between 1140px and 2280px.');
                        return;
                    }

                    if (Math.abs(ratio - 2.0) > tolerance) {
                        window.showToast && showToast('error', 'Image must have a 2:1 aspect ratio (e.g., 1600x800).');
                        return;
                    }

                    saveToServer(file);
                };
                img.onerror = function() {
                    window.showToast && showToast('error', 'Invalid image file.');
                };
                img.src = URL.createObjectURL(file);
            };
        }

        function saveToServer(file) {
            const fd = new FormData();
            fd.append('image', file);
            fd.append('action', 'upload_inline_image');

            // Show a temporary loading indicator or toast if desired
            window.showToast && showToast('info', 'Uploading image...');

            $.ajax({
                url: API,
                type: 'POST',
                data: fd,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(res) {
                    if (res.success && res.url) {
                        insertToEditor(res.url);
                    } else {
                        window.showToast && showToast('error', res.message || 'Image upload failed');
                    }
                },
                error: function() {
                    window.showToast && showToast('error', 'Network error during upload');
                }
            });
        }

        function insertToEditor(url) {
            const range = quill.getSelection() || {
                index: quill.getLength()
            };
            quill.insertEmbed(range.index, 'image', url);
            quill.setSelection(range.index + 1);
        }

        // Initialize Quill
        var quill = new Quill('#auEditor', {
            theme: 'snow',
            placeholder: 'Write and format the main content for the About Us page...',
            modules: {
                toolbar: {
                    container: [
                        [{
                            'header': [2, false]
                        }],
                        ['bold', 'italic', 'underline', 'strike'],
                        [{
                            'list': 'ordered'
                        }, {
                            'list': 'bullet'
                        }],
                        [{
                            'align': []
                        }],
                        ['link', 'image', 'video'],
                        ['clean']
                    ],
                    handlers: {
                        image: selectLocalImage
                    }
                }
            }
        });

        // Make the Quill toolbar match our borders
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

        // Save
        function save() {
            var $btn = $('#aboutSaveBtn');
            $btn.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin"></i> Saving…');

            var formData = new FormData($('#aboutUsForm')[0]);
            formData.append('action', 'save_page');
            formData.append('slug', SLUG);

            var content = quill.root.innerHTML;
            if (content === '<p><br></p>') content = '';

            if (content) {
                var $temp = $('<div>').html(content);
                $temp.find('h1, h2, h3, h4').css({
                    'font-size': '2.5rem',
                    'margin-bottom': '0.5rem',
                    'color': 'var(--text-dark, #333)',
                    'font-weight': '600',
                    'border-left': 'none',
                    'padding-left': '0'
                });
                $temp.find('h1:first-child, h2:first-child, h3:first-child, h4:first-child').css('margin-top', '0');
                
                $temp.find('p').css({
                    'font-size': '1.1rem',
                    'line-height': '1.6',
                    'color': 'var(--text-muted, #666)',
                    'margin-bottom': '1rem',
                    'text-align': 'justify'
                });
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
                    $btn.prop('disabled', false).html('<i class="fa-solid fa-cloud-arrow-up"></i> Save About Us');
                    if (r.success) {
                        window.showToast && showToast('success', r.message);
                        var dateStr = formatDateTime(r.saved_at);
                        $('#aboutLastSaved span').text('Last updated: ' + dateStr);
                        $('#aboutSavedBadge').fadeIn(200).delay(2500).fadeOut(400);
                    } else {
                        window.showToast && showToast('error', r.message || 'Save failed.');
                    }
                },
                error: function() {
                    $btn.prop('disabled', false).html('<i class="fa-solid fa-cloud-arrow-up"></i> Save About Us');
                    window.showToast && showToast('error', 'Network error while saving.');
                }
            });
        }

        // Initialize load
        loadData();

        $('#aboutSaveBtn').on('click', save);
        $('#aboutClearBtn').on('click', function() {
            if (confirm('Clear all content?')) {
                quill.root.innerHTML = '';
                $('#aboutUsForm')[0].reset();
            }
        });
        $(document).off('page:save.about').on('page:save.about', function(e, slug) {
            if (slug === SLUG) save();
        });
    }(jQuery));
</script>