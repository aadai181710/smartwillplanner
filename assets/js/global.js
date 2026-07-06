/**
 * Global JavaScript
 * Hamburger menu, sidebar toggling, and shared utilities
 */

// ===== Hamburger Menu Toggle =====
document.addEventListener("DOMContentLoaded", function () {
  if (window.smartWillsSidebarBootstrapped) {
    return;
  }

  window.smartWillsSidebarBootstrapped = true;

  const hamburgerMenu = document.querySelector(".hamburger-menu");
  const sidebar = document.querySelector(".sidebar");
  const sidebarOverlay = document.querySelector(".sidebar-overlay");

  // Toggle hamburger menu
  if (hamburgerMenu) {
    hamburgerMenu.addEventListener("click", function (e) {
      e.stopPropagation();
      hamburgerMenu.classList.toggle("active");
      sidebar.classList.toggle("active");
      sidebarOverlay.classList.toggle("active");
    });
  }

  // Close sidebar when clicking overlay
  if (sidebarOverlay) {
    sidebarOverlay.addEventListener("click", function () {
      hamburgerMenu.classList.remove("active");
      sidebar.classList.remove("active");
      sidebarOverlay.classList.remove("active");
    });
  }

  // Close sidebar when clicking a menu item (on mobile)
  const sidebarLinks = document.querySelectorAll(
    ".sidebar-menu a, .sidebar-footer a",
  );
  sidebarLinks.forEach((link) => {
    link.addEventListener("click", function () {
      if (window.innerWidth <= 768) {
        hamburgerMenu.classList.remove("active");
        sidebar.classList.remove("active");
        sidebarOverlay.classList.remove("active");
      }
    });
  });

  // Handle window resize
  window.addEventListener("resize", function () {
    if (window.innerWidth > 768) {
      hamburgerMenu.classList.remove("active");
      sidebar.classList.remove("active");
      sidebarOverlay.classList.remove("active");
    }
  });
});

// ===== Close mobile menu when clicking outside =====
document.addEventListener("click", function (e) {
  const sidebar = document.querySelector(".sidebar");
  const hamburgerMenu = document.querySelector(".hamburger-menu");
  const sidebarOverlay = document.querySelector(".sidebar-overlay");

  if (
    sidebar &&
    !sidebar.contains(e.target) &&
    hamburgerMenu &&
    !hamburgerMenu.contains(e.target) &&
    window.innerWidth <= 768
  ) {
    hamburgerMenu.classList.remove("active");
    sidebar.classList.remove("active");
    sidebarOverlay.classList.remove("active");
  }
});
