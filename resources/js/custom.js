console.log('custom.js loaded');

document.addEventListener('DOMContentLoaded', function () {

    const sidebar = document.getElementById('sidebar');
    const hamburgerBtn = document.getElementById('hamburger-btn');
    const closeBtn = document.querySelector('.close-btn');

    // Buat overlay
    const overlay = document.createElement('div');
    overlay.id = 'sidebar-overlay';
    overlay.style.cssText = `
        display: none;
        position: fixed;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background: rgba(0,0,0,0.5);
        z-index: 999;
    `;
    document.body.appendChild(overlay);

    function isMobile() {
        return window.innerWidth <= 768;
    }

    function openSidebar() {
        sidebar.classList.add('show');
        if (isMobile()) overlay.style.display = 'block';
    }

    function closeSidebar() {
        sidebar.classList.remove('show');
        overlay.style.display = 'none';
    }

    if (hamburgerBtn) {
        hamburgerBtn.addEventListener('click', function () {
            if (isMobile()) {
                if (sidebar.classList.contains('show')) {
                    closeSidebar();
                } else {
                    openSidebar();
                }
            } else {
                // Desktop: toggle sidebar
                sidebar.classList.toggle('closed');
            }
        });
    }

    if (closeBtn) {
        closeBtn.addEventListener('click', function (e) {
            e.stopPropagation();
            closeSidebar();
        });
    }

    overlay.addEventListener('click', closeSidebar);

});

// Auto-hide alerts
setTimeout(() => {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        if (typeof bootstrap !== 'undefined') {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }
    });
}, 5000);