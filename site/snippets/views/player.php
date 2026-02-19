<radio-player
  hx-get="/random-audio"
  hx-trigger="load"
  hx-swap="none">
  <div class="player-container relative w-screen md:w-80 md:ml-auto mt-2 overflow-hidden bg-bright-green">
    <!-- Player controls -->
    <div class="relative flex gap-2 items-center pl-2 py-1">
      <button class="play-button relative z-30 pointer-events-auto">
        <svg width="24" height="24" viewBox="0 0 35 34" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M3.83253 2.00117C3.83253 1.99007 3.83253 1.97896 3.83253 6.9773C3.83253 11.9756 3.83253 21.9837 3.82439 27.2293C3.81624 32.4749 3.79995 32.6547 3.84365 32.7272C3.88735 32.7997 3.99153 32.7595 7.27009 30.3131C10.5487 27.8668 16.9984 23.0155 21.8552 19.6898C26.712 16.3641 29.7804 14.711 31.4308 13.8088C33.2286 12.826 33.4433 12.6297 33.5264 12.4802C33.5626 12.4151 33.4578 12.3195 30.5152 11.8095C27.5726 11.2996 21.7623 10.3649 17.5921 9.33974C13.4218 8.31461 11.0677 7.22738 9.26209 6.31203C7.45644 5.39668 6.2706 4.68615 5.16863 4.10036C4.06665 3.51457 3.08448 3.07504 2.43807 2.75345C1.79165 2.43187 1.51074 2.24156 1.1123 1.96582" stroke="black" stroke-width="2" stroke-linecap="round" />
        </svg>
      </button>
      <button class="pause-button relative z-30 pointer-events-auto" style="display: none;">
        <img src="/assets/images/spiral.png" alt="Pause" class="w-6 h-6 motion-safe:animate-spin-slow" />
      </button>
      <marquee class="relative z-10 flex-1 min-w-0">Explore our archive</marquee>
      <a href="#" class="info-button relative z-30 px-2 hover:underline pointer-events-auto flex-shrink-0">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <circle cx="12" cy="12" r="10" stroke="black" stroke-width="2"/>
          <path d="M12 16V12M12 8H12.01" stroke="black" stroke-width="2" stroke-linecap="round"/>
        </svg>
      </a>
    </div>

    <!-- Progress bar overlay (orange gradient moving across) -->
    <div class="progress-bg absolute inset-0 pointer-events-none transition-all" style="width: 0%; background: linear-gradient(90deg, rgba(255, 123, 0, 0) 0%, rgba(255, 123, 0, 0.4) 50%, rgba(255, 123, 0, 0.8) 100%);"></div>

    <!-- Scrubber overlay (clickable) -->
    <div class="scrubber absolute inset-0 cursor-pointer z-20"></div>
  </div>
</radio-player>

<script>
  class RadioPlayer extends HTMLElement {
    constructor() {
      super();
      this.audio = null;
      this.playing = false;
      this.playButton = null;
      this.pauseButton = null;
      this.marquee = null;
      this.progressBg = null;
      this.scrubber = null;
      this.infoButton = null;
      this.playlist = [];
      this.currentTrackIndex = 0;
      this.currentResourceUrl = null;
      this.updateProgressInterval = null;
    }

    connectedCallback() {
      // Initialize audio but don't set src yet
      this.audio = new Audio();
      this.setupAudioEvents();

      // Get DOM elements
      this.playButton = this.querySelector('.play-button');
      this.pauseButton = this.querySelector('.pause-button');
      this.marquee = this.querySelector('marquee');
      this.progressBg = this.querySelector('.progress-bg');
      this.scrubber = this.querySelector('.scrubber');
      this.infoButton = this.querySelector('.info-button');

      if (!this.playButton || !this.pauseButton) {
        console.error('RadioPlayer: Missing required button elements');
        return;
      }

      this.setupEventListeners();

      // Listen for htmx response with random audio data
      this.addEventListener('htmx:afterRequest', (event) => {
        if (event.detail.xhr.status === 200) {
          try {
            const data = JSON.parse(event.detail.xhr.responseText);
            if (data.status === 'success' && data.data) {
              // Set the random resource data but don't play yet
              this.currentResourceUrl = data.data.resourceUrl;
              this.audio.src = data.data.url;
              if (this.marquee) {
                this.marquee.textContent = data.data.title;
              }
              if (this.infoButton && this.currentResourceUrl) {
                this.infoButton.href = this.currentResourceUrl;
                this.infoButton.style.display = 'block';
              }
            }
          } catch (error) {
            console.error('Error parsing random audio response:', error);
          }
        }
      });

      // Listen for custom events from archive player
      window.addEventListener('ia-player-track', (e) => this.loadTrack(e.detail));
      window.addEventListener('ia-player-next', () => this.nextTrack());
      window.addEventListener('ia-player-prev', () => this.prevTrack());
    }

    disconnectedCallback() {
      this.cleanup();
    }

    setupAudioEvents() {
      this.audio.addEventListener('ended', () => {
        // Auto-play next track if in playlist mode
        if (this.playlist.length > 0 && this.currentTrackIndex < this.playlist.length - 1) {
          this.nextTrack();
        } else {
          this.playing = false;
          this.stopProgressUpdate();
          this.updateUI();
        }
      });

      this.audio.addEventListener('pause', () => {
        this.playing = false;
        this.stopProgressUpdate();
        this.updateUI();
      });

      this.audio.addEventListener('play', () => {
        this.playing = true;
        this.startProgressUpdate();
        this.updateUI();
      });

      this.audio.addEventListener('error', (e) => {
        console.error('Audio error:', e);
        this.playing = false;
        this.stopProgressUpdate();
        this.updateUI();
      });

      // Update progress when metadata loads
      this.audio.addEventListener('loadedmetadata', () => {
        this.updateProgress();
      });

      this.audio.addEventListener('timeupdate', () => {
        this.updateProgress();
      });
    }

    setupEventListeners() {
      this.playButton.addEventListener('click', (e) => {
        e.preventDefault();
        e.stopPropagation();
        this.play();
      });

      this.pauseButton.addEventListener('click', (e) => {
        e.preventDefault();
        e.stopPropagation();
        this.pause();
      });

      // Scrubber click to seek
      if (this.scrubber) {
        this.scrubber.addEventListener('click', (e) => {
          if (!this.audio.duration || isNaN(this.audio.duration)) return;

          const rect = this.scrubber.getBoundingClientRect();
          const x = e.clientX - rect.left;
          const percentage = x / rect.width;
          const newTime = percentage * this.audio.duration;

          this.audio.currentTime = newTime;
          this.updateProgress();
        });
      }

      // Info button - navigate using htmx to maintain playback
      if (this.infoButton) {
        this.infoButton.addEventListener('click', (e) => {
          e.preventDefault();
          e.stopPropagation();
          // Use htmx to navigate without interrupting playback
          if (this.currentResourceUrl && typeof htmx !== 'undefined') {
            htmx.ajax('GET', this.currentResourceUrl, {
              target: '#main',
              select: '#main',
              swap: 'outerHTML'
            });
          }
        });
      }
    }

    updateUI() {
      if (this.playing) {
        this.playButton.style.display = 'none';
        this.pauseButton.style.display = 'block';
      } else {
        this.playButton.style.display = 'block';
        this.pauseButton.style.display = 'none';
      }
    }

    play() {
      if (this.audio) {
        this.audio.play().catch(error => {
          console.error('Error playing audio:', error);
          this.playing = false;
          this.updateUI();
        });
      }
    }

    pause() {
      if (this.audio) {
        this.audio.pause();
      }
    }

    loadTrack(trackData) {
      // trackData: { url, title, playlist, index, resourceUrl }
      if (trackData.playlist) {
        this.playlist = trackData.playlist;
        this.currentTrackIndex = trackData.index || 0;
      }

      // Store resource URL for info button
      this.currentResourceUrl = trackData.resourceUrl || null;

      if (this.audio) {
        this.audio.src = trackData.url;
        this.audio.load();
        this.audio.play().catch(error => {
          console.error('Error playing audio:', error);
          this.playing = false;
          this.updateUI();
        });
      }

      // Update marquee with track title
      if (this.marquee && trackData.title) {
        this.marquee.textContent = trackData.title;
      }

      // Update info button
      if (this.infoButton && this.currentResourceUrl) {
        this.infoButton.href = this.currentResourceUrl;
      }

      // Reset progress
      this.updateProgress();

      // Notify archive player of current track
      window.dispatchEvent(new CustomEvent('radio-player-track-changed', {
        detail: { index: this.currentTrackIndex }
      }));
    }

    nextTrack() {
      if (this.playlist.length > 0 && this.currentTrackIndex < this.playlist.length - 1) {
        this.currentTrackIndex++;
        const track = this.playlist[this.currentTrackIndex];
        this.loadTrack({
          url: track.url,
          title: track.title,
          playlist: this.playlist,
          index: this.currentTrackIndex,
          resourceUrl: this.currentResourceUrl
        });
      }
    }

    prevTrack() {
      if (this.playlist.length > 0 && this.currentTrackIndex > 0) {
        this.currentTrackIndex--;
        const track = this.playlist[this.currentTrackIndex];
        this.loadTrack({
          url: track.url,
          title: track.title,
          playlist: this.playlist,
          index: this.currentTrackIndex,
          resourceUrl: this.currentResourceUrl
        });
      }
    }

    updateProgress() {
      if (!this.progressBg || !this.audio.duration || isNaN(this.audio.duration)) {
        if (this.progressBg) {
          this.progressBg.style.width = '0%';
        }
        return;
      }

      const percentage = (this.audio.currentTime / this.audio.duration) * 100;
      this.progressBg.style.width = `${percentage}%`;
    }

    startProgressUpdate() {
      this.stopProgressUpdate();
      this.updateProgressInterval = setInterval(() => {
        this.updateProgress();
      }, 100);
    }

    stopProgressUpdate() {
      if (this.updateProgressInterval) {
        clearInterval(this.updateProgressInterval);
        this.updateProgressInterval = null;
      }
    }

    cleanup() {
      this.stopProgressUpdate();
      if (this.audio) {
        this.audio.pause();
        this.audio.src = '';
        this.audio = null;
      }
    }
  }

  // Define the custom element
  if (!customElements.get('radio-player')) {
    customElements.define('radio-player', RadioPlayer);
  }
</script>