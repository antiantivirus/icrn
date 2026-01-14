<!--

NETWORK DIAGRAM INTERACTION

On hover
- Update image src
- Update text content
- Change node colour
- Scale node up

Autoplay
- Choose random node every 3 seconds
- Same interaction as hover.

-->

<network-diagram data-stations='<?= $stations ?>'>
  <div class="grid md:grid-cols-2 p-5 gap-15 lg:gap-30 max-w-[83.33vw] mx-auto items-center justify-items-center">
    <svg class="network-diagram" viewBox="0 0 558 205" xmlns="http://www.w3.org/2000/svg">
      <circle class="network-node" cx="16.6016" cy="168.827" r="16"></circle>
      <circle class="network-node" cx="42.6738" cy="166.85" r="16"></circle>
      <circle class="network-node" cx="92.7949" cy="185.955" r="16"></circle>
      <circle class="network-node" cx="236.797" cy="162.133" r="16"></circle>
      <circle class="network-node" cx="293.564" cy="169.211" r="16"></circle>
      <circle class="network-node" cx="286.678" cy="148.595" r="16"></circle>
      <circle class="network-node" cx="286.678" cy="123.012" r="16"></circle>
      <circle class="network-node" cx="296.355" cy="99.5078" r="16"></circle>
      <circle class="network-node" cx="294.512" cy="82.4561" r="16"></circle>
      <circle class="network-node" cx="291.525" cy="54.7083" r="16"></circle>
      <circle class="network-node" cx="290.955" cy="35.7148" r="16"></circle>
      <circle class="network-node" cx="318.686" cy="28.2073" r="16"></circle>
      <circle class="network-node" cx="345.656" cy="42.7373" r="16"></circle>
      <circle class="network-node" cx="354.678" cy="67.7148" r="16"></circle>
      <circle class="network-node" cx="338.021" cy="90.8667" r="16"></circle>
      <circle class="network-node" cx="320.477" cy="111.534" r="16"></circle>
      <circle class="network-node" cx="344.908" cy="120.747" r="16"></circle>
      <circle class="network-node" cx="365.275" cy="141.129" r="16"></circle>
      <circle class="network-node" cx="380.439" cy="161.579" r="16"></circle>
      <circle class="network-node" cx="389.406" cy="185.174" r="16"></circle>
      <circle class="network-node" cx="425.346" cy="132.011" r="16"></circle>
      <circle class="network-node" cx="430.914" cy="104.308" r="16"></circle>
      <circle class="network-node" cx="423.104" cy="82.1948" r="16"></circle>
      <circle class="network-node" cx="420.475" cy="63.3279" r="16"></circle>
      <circle class="network-node" cx="423.131" cy="35.0039" r="16"></circle>
      <circle class="network-node" cx="445.178" cy="19.0039" r="16"></circle>
      <circle class="network-node" cx="468.215" cy="36.168" r="16"></circle>
      <circle class="network-node" cx="473.684" cy="59.4583" r="16"></circle>
      <circle class="network-node" cx="480.113" cy="86.0901" r="16"></circle>
      <circle class="network-node" cx="480.109" cy="110.433" r="16"></circle>
      <circle class="network-node" cx="483.688" cy="134.312" r="16"></circle>
      <circle class="network-node" cx="500.84" cy="157.073" r="16"></circle>
      <circle class="network-node" cx="522.111" cy="146.493" r="16"></circle>
      <circle class="network-node" cx="526.145" cy="122.496" r="16"></circle>
      <circle class="network-node" cx="538.104" cy="95.1108" r="16"></circle>
      <circle class="network-node" cx="533.586" cy="70.2888" r="16"></circle>
      <circle class="network-node" cx="541.854" cy="42.9102" r="16"></circle>
      <circle class="network-node" cx="531.4" cy="16.6724" r="16"></circle>
      <circle class="network-node" cx="218.393" cy="180.536" r="16"></circle>
      <circle class="network-node" cx="190.855" cy="188.606" r="16"></circle>
      <circle class="network-node" cx="169.621" cy="176.739" r="16"></circle>
      <circle class="network-node" cx="151.074" cy="152.883" r="16"></circle>
      <circle class="network-node" cx="137.945" cy="130.309" r="16"></circle>
      <circle class="network-node" cx="130.219" cy="107.812" r="16"></circle>
      <circle class="network-node" cx="140.801" cy="79.8171" r="16"></circle>
      <circle class="network-node" cx="154.633" cy="62.7871" r="16"></circle>
      <circle class="network-node" cx="179.418" cy="56.094" r="16"></circle>
      <circle class="network-node" cx="209" cy="56.7336" r="16"></circle>
      <circle class="network-node" cx="232.746" cy="71.0452" r="16"></circle>
      <circle class="network-node" cx="71.4922" cy="174.167" r="16"></circle>
      <circle class="network-node" cx="64.6406" cy="153.535" r="16"></circle>
      <circle class="network-node" cx="64.6406" cy="127.992" r="16"></circle>
      <circle class="network-node" cx="74.2793" cy="104.434" r="16"></circle>
      <circle class="network-node" cx="72.4531" cy="87.4968" r="16"></circle>
      <circle class="network-node" cx="69.4746" cy="59.6743" r="16"></circle>
      <circle class="network-node" cx="50.5098" cy="47.4685" r="16"></circle>
      <circle class="network-node" cx="22.0273" cy="39.7217" r="16"></circle>
      <circle class="network-node" cx="78.3145" cy="36.4351" r="16"></circle>
      <circle class="network-node" cx="97.4727" cy="33.5552" r="16"></circle>

      <g class="hover-effect" style="display: none;">
        <circle class="hover-circle" r="16" fill="#F8661B" opacity="1">
        </circle>
        <circle class="hover-wave" r="14" fill="none" stroke="#F8661B" stroke-width="2" opacity="0">
          <animate attributeName="r" values="14;24" dur="1s" repeatCount="indefinite" />
          <animate attributeName="opacity" values="1;0" dur="1s" repeatCount="indefinite" />
        </circle>
      </g>
    </svg>

    <div class="w-full max-w-full min-w-0">
      <img class="aspect-4/3 object-cover shadow-green network-image w-full" src="/assets/icrn-mic.jpg" />
      <p class="mt-1 whitespace-nowrap overflow-hidden text-ellipsis network-text">&nbsp;</p>
    </div>
  </div>
</network-diagram>

<style>
  .network-diagram {
    width: 100%;
    height: auto;
    background: transparent;
    overflow: visible;
  }

  .network-node {
    fill: #A2FF00;
    cursor: pointer;
    transition: fill 0.3s ease, opacity 0.3s ease;
  }

  .hover-effect {
    pointer-events: none;
  }
</style>

<script>
  class NetworkDiagram extends HTMLElement {
    constructor() {
      super();
      this.stations = null;
      this.hoverEffect = null;
      this.hoverWave = null;
      this.hoverCircle = null;
      this.image = null;
      this.text = null;
      this.isHovering = false;
      this.autoplayInterval = null;
      this.lastSelectedNode = null;
      this.lastSelectedStation = null;
    }

    connectedCallback() {
      // Parse stations data from attribute
      const stationsData = this.getAttribute('data-stations');

      if (stationsData) {
        try {
          this.stations = JSON.parse(stationsData);
        } catch (e) {
          console.error('Failed to parse stations data:', e);
          return;
        }
      }

      // Get DOM elements
      this.hoverEffect = this.querySelector('.hover-effect');
      this.hoverWave = this.querySelector('.hover-wave');
      this.hoverCircle = this.querySelector('.hover-circle');
      this.image = this.querySelector('.network-image');
      this.text = this.querySelector('.network-text');

      if (!this.stations || !this.hoverEffect || !this.image || !this.text) {
        console.error('NetworkDiagram: Missing required elements or data');
        return;
      }

      this.setupEventListeners();
      this.startAutoplay();
    }

    disconnectedCallback() {
      this.cleanup();
    }

    cleanup() {
      if (this.autoplayInterval) {
        clearInterval(this.autoplayInterval);
        this.autoplayInterval = null;
      }
    }

    getRandomStation(excludeStation = null) {
      if (this.stations.length <= 1) return this.stations[0];

      let randomStation;

      do {
        const randomIndex = Math.floor(Math.random() * this.stations.length);
        randomStation = this.stations[randomIndex];
      }

      while (randomStation === excludeStation);

      return randomStation;
    }

    getRandomNode(excludeNode = null) {
      const nodes = this.querySelectorAll('.network-node');
      if (nodes.length <= 1) return nodes[0];

      let randomNode;

      do {
        const randomIndex = Math.floor(Math.random() * nodes.length);
        randomNode = nodes[randomIndex];
      }

      while (randomNode === excludeNode);

      return randomNode;
    }

    activateNode(node, station = null) {
      const selectedStation = station || this.getRandomStation(this.lastSelectedStation);
      this.lastSelectedStation = selectedStation;

      // Store station URL on node for click handler
      node.dataset.stationUrl = selectedStation.url;

      this.image.src = selectedStation.image;
      this.text.innerHTML = selectedStation.title;

      const cx = node.getAttribute('cx');
      const cy = node.getAttribute('cy');
      this.hoverCircle.setAttribute('cx', cx);
      this.hoverCircle.setAttribute('cy', cy);
      this.hoverWave.setAttribute('cx', cx);
      this.hoverWave.setAttribute('cy', cy);

      this.hoverEffect.style.display = 'none';
      this.hoverEffect.offsetHeight; // Force reflow
      this.hoverEffect.style.display = 'block';

      const animations = this.hoverWave.querySelectorAll('animate');

      animations.forEach(animation => {
        animation.beginElement();
      });
    }

    deactivateNode() {
      this.image.src = '/assets/icrn-mic.jpg';
      this.text.innerHTML = "&nbsp;";
      this.hoverEffect.style.display = 'none';
    }

    setupEventListeners() {
      this.querySelectorAll('.network-node').forEach(node => {
        node.addEventListener('mouseover', (e) => {
          this.isHovering = true;
          const station = this.getRandomStation(this.lastSelectedStation);
          this.lastSelectedStation = station;
          this.activateNode(node, station);
        });

        node.addEventListener('mouseout', () => {
          this.isHovering = false;
          this.deactivateNode();
        });

        node.addEventListener('click', (e) => {
          const stationUrl = node.dataset.stationUrl;
          if (stationUrl) {
            // Use htmx to navigate to station page
            if (typeof htmx !== 'undefined') {
              htmx.ajax('GET', stationUrl, {
                target: '#main',
                select: '#main',
                swap: 'outerHTML'
              });
              // Update browser URL
              window.history.pushState({}, '', stationUrl);
            } else {
              // Fallback to regular navigation
              window.location.href = stationUrl;
            }
          }
        });
      });
    }

    startAutoplay() {
      this.autoplayInterval = setInterval(() => {
          if (!this.isHovering) {
            const randomNode = this.getRandomNode(this.lastSelectedNode);
            this.lastSelectedNode = randomNode;
            this.activateNode(randomNode);
          }
        }

        , 2000);
    }
  }

  // Define the custom element
  if (!customElements.get('network-diagram')) {
    customElements.define('network-diagram', NetworkDiagram);
  }
</script>