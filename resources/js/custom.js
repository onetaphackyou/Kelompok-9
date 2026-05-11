// Mobile sidebar toggle and desktop close functionality
document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('sidebar');
    if (!sidebar) {
        return;
    }

    const hamburger = document.createElement('button');
    hamburger.className = 'btn btn-primary d-md-none position-fixed';
    hamburger.innerHTML = '<i class="bi bi-list"></i>';
    hamburger.style.cssText = 'top: 85px; right: 15px; z-index: 1060;';

    hamburger.addEventListener('click', function() {
        sidebar.classList.toggle('show');
    });

    document.body.appendChild(hamburger);

    // Close sidebar when clicking outside (mobile)
    document.addEventListener('click', function(e) {
        if (sidebar.classList.contains('show') && !sidebar.contains(e.target) && !hamburger.contains(e.target)) {
            sidebar.classList.remove('show');
        }
    });

    // Desktop close button functionality
    const closeBtn = sidebar.querySelector('.close-btn');
    if (closeBtn) {
        closeBtn.addEventListener('click', function() {
            sidebar.classList.add('closed');
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
