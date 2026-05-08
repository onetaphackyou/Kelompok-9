// Mobile sidebar toggle and desktop close functionality
document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('sidebar');
    if (!sidebar) return; // jika tidak ada sidebar, hentikan

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
        if (!sidebar.contains(e.target) && !hamburger.contains(e.target)) {
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

    // Add open button for desktop when sidebar is closed
    const openBtn = document.createElement('button');
    openBtn.className = 'btn btn-primary position-fixed d-none d-md-block';
    openBtn.innerHTML = '<i class="bi bi-chevron-right"></i>';
    openBtn.style.cssText = 'top: 20px; left: 20px; z-index: 1060; padding: 8px 12px; border-radius: 50%;';

    openBtn.addEventListener('click', function() {
        sidebar.classList.remove('closed');
    });

    document.body.appendChild(openBtn);

    // Show/hide open button based on sidebar state
    function updateOpenBtn() {
        if (sidebar.classList.contains('closed')) {
            openBtn.classList.remove('d-none');
        } else {
            openBtn.classList.add('d-none');
        }
    }

    updateOpenBtn();
    const observer = new MutationObserver(updateOpenBtn);
    observer.observe(sidebar, { attributes: true, attributeFilter: ['class'] });
});

// Auto-hide alerts (Bootstrap 5)
setTimeout(() => {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        // Jika Bootstrap 5 tersedia
        if (typeof bootstrap !== 'undefined' && bootstrap.Alert) {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        } else {
            // Fallback: sembunyikan manual
            alert.style.display = 'none';
        }
    });
}, 5000);
