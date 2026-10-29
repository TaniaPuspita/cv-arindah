
document.addEventListener('DOMContentLoaded', function () {
    const sidebar = document.getElementById('adminSidebar');
    const overlay = document.getElementById('sidebarOverlay');
    const menuButton = document.getElementById('mobileMenuButton');

    // Sinkronkan status dropdown dengan kondisi awal dari Blade.
    if (sidebar && window.bootstrap?.Collapse) {
        sidebar
            .querySelectorAll('[data-bs-toggle="collapse"]')
            .forEach(function (trigger) {
                const selector =
                    trigger.getAttribute('data-bs-target') ||
                    trigger.getAttribute('href');

                if (!selector || !selector.startsWith('#')) return;

                const target = document.querySelector(selector);
                if (!target) return;

                trigger.setAttribute(
                    'aria-expanded',
                    target.classList.contains('show') ? 'true' : 'false'
                );

                target.addEventListener('shown.bs.collapse', function () {
                    trigger.setAttribute('aria-expanded', 'true');
                });

                target.addEventListener('hidden.bs.collapse', function () {
                    trigger.setAttribute('aria-expanded', 'false');
                });
            });
    }

    // Sidebar mobile
    if (!sidebar || !overlay || !menuButton) return;

    function openSidebar() {
        sidebar.classList.add('is-open');
        overlay.classList.add('is-visible');
        menuButton.setAttribute('aria-expanded', 'true');
        document.body.classList.add('sidebar-open');
    }

    function closeSidebar() {
        sidebar.classList.remove('is-open');
        overlay.classList.remove('is-visible');
        menuButton.setAttribute('aria-expanded', 'false');
        document.body.classList.remove('sidebar-open');
    }

    menuButton.addEventListener('click', function () {
        if (sidebar.classList.contains('is-open')) {
            closeSidebar();
        } else {
            openSidebar();
        }
    });

    overlay.addEventListener('click', closeSidebar);

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') closeSidebar();
    });

    window.addEventListener('resize', function () {
        if (window.innerWidth > 760) closeSidebar();
    });
});
