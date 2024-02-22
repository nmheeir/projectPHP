function showToast(message) {
    var container = document.querySelector('.container');
    var toast = document.createElement('div');
    toast.classList.add('toast', 'show');
    toast.innerHTML = `
        <div class="toast-header">
            <strong class="me-auto">Toast Header</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
        </div>
        <div class="toast-body">
            <p>Some text inside the toast body</p>
        </div>
    `;
    container.appendChild(toast);
}