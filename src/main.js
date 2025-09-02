document.addEventListener('DOMContentLoaded', function () {
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
    updatePageBackground();
    // Always scroll to top after content swap
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });

  // Handle navigation state updates
  document.addEventListener('htmx:historyRestore', function (evt) {
    updatePageBackground();
  });

  // Initial setup
  updatePageBackground();
});