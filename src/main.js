// Alpine.js and HTMX are now loaded via CDN
// Custom JavaScript for the application

document.addEventListener('DOMContentLoaded', function () {
  // Custom JavaScript initialization
  console.log('ICRN app initialized');

  // Update menu active states on HTMX navigation
  function updateMenuActiveState() {
    const currentPath = window.location.pathname;
    const menuLinks = document.querySelectorAll('nav a');

    menuLinks.forEach(link => {
      const href = link.getAttribute('href');
      link.classList.remove('underline');
      if (href === currentPath || (currentPath === '/' && href === '/')) {
        link.classList.add('underline');
      }
    });
  }

  // HTMX event handlers to preserve Alpine state
  document.addEventListener('htmx:beforeSwap', function (evt) {
    // Before swapping content, preserve any Alpine state if needed
    console.log('HTMX: Before content swap');
  });

  document.addEventListener('htmx:afterSettle', function (evt) {
    // After new content is settled, reinitialize any JavaScript
    console.log('HTMX: After content settled');

    // Update menu active state
    updateMenuActiveState();

    // Reinitialize Alpine.js for new content
    if (window.Alpine) {
      window.Alpine.initTree(evt.detail.elt);
    }
  });

  // Handle navigation state updates
  document.addEventListener('htmx:historyRestore', function (evt) {
    console.log('HTMX: History restored');
    updateMenuActiveState();
  });

  // Initial menu state
  updateMenuActiveState();
});