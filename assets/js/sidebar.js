document.addEventListener('DOMContentLoaded', function () {
    if (window.smartWillsSidebarBootstrapped) {
        return;
    }

    window.smartWillsSidebarBootstrapped = true;

    const hamburgerMenu = document.querySelector('.hamburger-menu');
    const sidebar = document.querySelector('.sidebar');
    const sidebarOverlay = document.querySelector('.sidebar-overlay');

    function closeSidebar() {
        if (hamburgerMenu) {
            hamburgerMenu.classList.remove('active');
        }

        if (sidebar) {
            sidebar.classList.remove('active');
        }

        if (sidebarOverlay) {
            sidebarOverlay.classList.remove('active');
        }
    }

    if (hamburgerMenu && sidebar && sidebarOverlay) {
        hamburgerMenu.addEventListener('click', function (event) {
            event.stopPropagation();
            hamburgerMenu.classList.toggle('active');
            sidebar.classList.toggle('active');
            sidebarOverlay.classList.toggle('active');
        });

        sidebarOverlay.addEventListener('click', closeSidebar);
    }

    document.querySelectorAll('.sidebar-menu a, .sidebar-footer a').forEach(function (link) {
        link.addEventListener('click', function () {
            if (window.innerWidth <= 768) {
                closeSidebar();
            }
        });
    });

    document.addEventListener('click', function (event) {
        if (
            sidebar &&
            hamburgerMenu &&
            !sidebar.contains(event.target) &&
            !hamburgerMenu.contains(event.target) &&
            window.innerWidth <= 768
        ) {
            closeSidebar();
        }
    });

    window.addEventListener('resize', function () {
        if (window.innerWidth > 768) {
            closeSidebar();
        }
    });
});
