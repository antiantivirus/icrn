<site-logo class="lg:absolute lg:top-2 lg:left-4">
  <!-- Your logo content goes here -->
  <a href="/">
    <!-- Replace with your actual logo image/SVG -->
    <img src="/assets/images/icrn-dots-logo.svg" class="h-8 lg:h-40" alt="Site Logo" />
  </a>
</site-logo>

<script>
  class SiteLogo extends HTMLElement {
    constructor() {
      super();
      this.updateVisibility = this.updateVisibility.bind(this);
    }

    connectedCallback() {
      this.updateVisibility();

      // Listen for HTMX events
      document.addEventListener('htmx:afterSettle', this.updateVisibility);
      document.addEventListener('htmx:historyRestore', this.updateVisibility);

      // Listen for popstate (browser back/forward)
      window.addEventListener('popstate', this.updateVisibility);
    }

    disconnectedCallback() {
      document.removeEventListener('htmx:afterSettle', this.updateVisibility);
      document.removeEventListener('htmx:historyRestore', this.updateVisibility);
      window.removeEventListener('popstate', this.updateVisibility);
    }

    updateVisibility() {
      const currentPath = window.location.pathname;

      if (currentPath === '/' || currentPath === '') {
        this.style.display = 'none';
      } else {
        this.style.display = 'block';
      }
    }
  }

  // Register the custom element
  customElements.define('site-logo', SiteLogo);
</script>