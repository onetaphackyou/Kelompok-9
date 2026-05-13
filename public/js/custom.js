// Hamburger menu toggle functionality
document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('sidebar');
    const sidebarToggleBtn = document.getElementById('sidebar-toggle');

    // New: sidebar toggle for all roles (mobile)
    if (sidebarToggleBtn && sidebar) {
        sidebarToggleBtn.addEventListener('click', function() {
            sidebar.classList.toggle('open');
            sidebar.classList.toggle('closed');
            sidebarToggleBtn.classList.toggle('active');
        });
    }


    const hamburgerBtn = document.getElementById('hamburger-btn');

    if (hamburgerBtn && sidebar) {
        hamburgerBtn.addEventListener('click', function() {
            // Toggle sidebar visibility
            sidebar.classList.toggle('closed');
            hamburgerBtn.classList.toggle('active');

            // For mobile: toggle open class
            if (window.innerWidth <= 768) {
                sidebar.classList.toggle('open');
            }
        });
    }

    // Close sidebar when clicking outside (mobile)
    document.addEventListener('click', function(e) {
        if (sidebar && sidebar.classList.contains('open') &&
            !sidebar.contains(e.target) &&
            !hamburgerBtn.contains(e.target)) {
            sidebar.classList.remove('open');
            hamburgerBtn.classList.remove('active');
        }
    });

    // Desktop close button functionality
    const closeBtn = sidebar ? sidebar.querySelector('.close-btn') : null;
    if (closeBtn) {
        closeBtn.addEventListener('click', function() {
            sidebar.classList.add('closed');
            if (hamburgerBtn) hamburgerBtn.classList.remove('active');
        });
    }
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
