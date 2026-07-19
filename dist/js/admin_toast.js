// --- TOAST NOTIFICATIONS ---
function showToast(type, message) {
    const icons = {
        success: 'fa-circle-check',
        error: 'fa-circle-exclamation',
        info: 'fa-circle-info'
    };
    const iconClass = icons[type] || 'fa-circle-info';

    const toast = $(`
        <div class="toast-notification toast-${type}">
            <div class="toast-icon"><i class="fa-solid ${iconClass}"></i></div>
            <div class="toast-message">${message}</div>
            <button class="toast-close"><i class="fa-solid fa-xmark"></i></button>
        </div>
    `);

    $('#toastContainer').append(toast);

    // Trigger animation
    setTimeout(() => toast.addClass('show'), 10);

    // Auto dismiss
    const timer = setTimeout(() => dismissToast(toast), 4000);

    // Manual dismiss
    toast.find('.toast-close').on('click', function() {
        clearTimeout(timer);
        dismissToast(toast);
    });
}

function dismissToast(toast) {
    toast.removeClass('show');
    setTimeout(() => toast.remove(), 300);
}
