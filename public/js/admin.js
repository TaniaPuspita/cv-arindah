
document.addEventListener('DOMContentLoaded', function () {
    const sidebar = document.getElementById('adminSidebar');
    const overlay = document.getElementById('sidebarOverlay');
    const menuButton = document.getElementById('mobileMenuButton');

    /*
    |--------------------------------------------------------------------------
    | DROPDOWN CMS
    |--------------------------------------------------------------------------
    | Biarkan Bootstrap mengelola collapse secara native.
    | Jangan menghapus data-bs-toggle atau data-bs-target.
    */

    if (sidebar && window.bootstrap && window.bootstrap.Collapse) {
        const dropdownTriggers = sidebar.querySelectorAll(
            '[data-bs-toggle="collapse"]'
        );

        dropdownTriggers.forEach(function (trigger) {
            const selector =
                trigger.getAttribute('data-bs-target') ||
                trigger.getAttribute('href');

            if (!selector || !selector.startsWith('#')) {
                return;
            }

            const target = document.querySelector(selector);

            if (!target) {
                console.warn(
                    'Target submenu tidak ditemukan:',
                    selector
                );
                return;
            }

            // Samakan status tombol dengan kondisi submenu.
            function syncExpanded() {
                trigger.setAttribute(
                    'aria-expanded',
                    target.classList.contains('show') ? 'true' : 'false'
                );
            }

            syncExpanded();

            // Perbarui status setelah animasi Bootstrap selesai.
            target.addEventListener('shown.bs.collapse', syncExpanded);
            target.addEventListener('hidden.bs.collapse', syncExpanded);
        });
    }

    /*
    |--------------------------------------------------------------------------
    | SIDEBAR MOBILE
    |--------------------------------------------------------------------------
    */

    function isMobile() {
        return window.matchMedia('(max-width: 760px)').matches;
    }

    function openSidebar() {
        if (!sidebar || !overlay || !menuButton) {
            return;
        }

        sidebar.classList.add('is-open');
        overlay.classList.add('is-visible');
        document.body.classList.add('sidebar-open');

        menuButton.setAttribute('aria-expanded', 'true');
        menuButton.setAttribute('aria-label', 'Tutup navigasi');
    }

    function closeSidebar() {
        if (!sidebar || !overlay || !menuButton) {
            return;
        }

        sidebar.classList.remove('is-open');
        overlay.classList.remove('is-visible');
        document.body.classList.remove('sidebar-open');

        menuButton.setAttribute('aria-expanded', 'false');
        menuButton.setAttribute('aria-label', 'Buka navigasi');
    }

    if (menuButton && sidebar && overlay) {
        menuButton.addEventListener('click', function () {
            if (sidebar.classList.contains('is-open')) {
                closeSidebar();
            } else {
                openSidebar();
            }
        });

        overlay.addEventListener('click', closeSidebar);

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                closeSidebar();
            }
        });

        // Tutup sidebar mobile ketika tautan halaman dipilih.
        // Klik tombol dropdown dan submenu collapse tidak memicu ini.
        sidebar.addEventListener('click', function (event) {
            const link = event.target.closest('a[href]');

            if (!link || !sidebar.contains(link) || !isMobile()) {
                return;
            }

            const href = link.getAttribute('href');

            if (!href || href.startsWith('#')) {
                return;
            }

            closeSidebar();
        });

        window.addEventListener('resize', function () {
            if (!isMobile()) {
                closeSidebar();
            }
        });
    }
});
