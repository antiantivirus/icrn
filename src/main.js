document.addEventListener('DOMContentLoaded', function () {
  // Update logo visibility based on current path
  function updateLogoVisibility() {
    const currentPath = window.location.pathname;
    const homeLogo = document.getElementById('home-logo');

    if (homeLogo) {
      if (currentPath === '/' || currentPath === '') {
        homeLogo.style.display = 'none';
      } else {
        homeLogo.style.display = 'block';
      }
    }
  }

  // Update body background color based on current page
  function updatePageBackground() {
    const currentPath = window.location.pathname;
    const body = document.body;
    if (currentPath.includes('/about')) {
      body.setAttribute('data-page', 'about');
    } else if (currentPath.includes('/newsletter')) {
      body.setAttribute('data-page', 'newsletter');
    } else {
      body.setAttribute('data-page', 'default');
    }
  }

  // Handle HTMX content swaps
  document.addEventListener('htmx:afterSettle', function (evt) {
    updateLogoVisibility();
    updatePageBackground();
  });

  // Handle navigation state updates
  document.addEventListener('htmx:historyRestore', function (evt) {
    updateLogoVisibility();
    updatePageBackground();
  });

  // Initial setup
  updateLogoVisibility();
  updatePageBackground();
});