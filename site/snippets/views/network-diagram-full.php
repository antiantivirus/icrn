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

<div class="mx-auto relative max-w-[83.33vw] mt-40">
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

    <g id="hoverEffect" style="display: none;">
      <circle id="hoverCircle" r="16" fill="#F8661B" opacity="1">
      </circle>
      <circle id="hoverWave" r="14" fill="none" stroke="#F8661B" stroke-width="2" opacity="0">
        <animate attributeName="r" values="14;20" dur="1s" repeatCount="indefinite" />
        <animate attributeName="opacity" values="1;0" dur="1s" repeatCount="indefinite" />
      </circle>
    </g>
  </svg>

  <div class="absolute left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2 w-100 pointer-events-none mix-blend-exclusion">
    <img class="aspect-4/3 object-cover" id="image" src="/assets/icrn-mic.jpg" />
    <p id="text">-</p>
  </div>
</div>

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
    transition: fill 0.3s ease;
  }

  #hoverEffect {
    pointer-events: none;
  }
</style>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const colours = ['#01B4FF', '#F8661B', '#C52734', '#00A2FF', '#A2FF00'];
    const stations = <?= $stations ?>;
    const hoverEffect = document.getElementById('hoverEffect');
    const hoverWave = document.getElementById('hoverWave');
    const hoverCircle = document.getElementById('hoverCircle');
    const image = document.getElementById('image');
    const text = document.getElementById('text');

    let isHovering = false;
    let autoplayInterval;
    let lastSelectedNode = null;
    let lastSelectedStation = null;

    function getRandomStation(excludeStation = null) {
      if (stations.length <= 1) return stations[0];

      let randomStation;
      do {
        const randomIndex = Math.floor(Math.random() * stations.length);
        randomStation = stations[randomIndex];
      } while (randomStation === excludeStation);

      return randomStation;
    }

    function getRandomNode(excludeNode = null) {
      const nodes = document.querySelectorAll('.network-node');
      if (nodes.length <= 1) return nodes[0];

      let randomNode;
      do {
        const randomIndex = Math.floor(Math.random() * nodes.length);
        randomNode = nodes[randomIndex];
      } while (randomNode === excludeNode);

      return randomNode;
    }

    function activateNode(node, station = null) {
      const selectedStation = station || getRandomStation(lastSelectedStation);
      lastSelectedStation = selectedStation;

      image.src = selectedStation.image;
      text.innerHTML = selectedStation.title;

      const cx = node.getAttribute('cx');
      const cy = node.getAttribute('cy');
      hoverCircle.setAttribute('cx', cx);
      hoverCircle.setAttribute('cy', cy);
      hoverWave.setAttribute('cx', cx);
      hoverWave.setAttribute('cy', cy);

      hoverEffect.style.display = 'none';
      hoverEffect.offsetHeight;
      hoverEffect.style.display = 'block';

      const animations = hoverWave.querySelectorAll('animate');
      animations.forEach(animation => {
        animation.beginElement();
      });
    }

    function deactivateNode() {
      image.src = '/assets/icrn-mic.jpg';
      text.innerHTML = "-";
      hoverEffect.style.display = 'none';
    }

    function startAutoplay() {
      autoplayInterval = setInterval(() => {
        if (!isHovering) {
          const randomNode = getRandomNode(lastSelectedNode);
          lastSelectedNode = randomNode;
          activateNode(randomNode);
        }
      }, 2000);
    }

    document.querySelectorAll('.network-node').forEach(node => {
      node.addEventListener('mouseover', (e) => {
        isHovering = true;
        const station = getRandomStation(lastSelectedStation);
        lastSelectedStation = station;
        activateNode(node, station);
      });

      node.addEventListener('mouseout', () => {
        isHovering = false;
        deactivateNode();
      });
    });

    startAutoplay();
  });
</script>