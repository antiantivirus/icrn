<div class="bg-bright-green flex gap-2 items-center w-fit ml-auto mt-2 pl-2 py-1 pr-8"
  x-data="{
  playing: false,
  audio: null,
  init() {
      this.audio = new Audio('https://seyisfjorur-community-radio.radiocult.fm/stream');
      this.audio.addEventListener('ended', () => this.playing = false);
      this.audio.addEventListener('pause', () => this.playing = false);
      this.audio.addEventListener('play', () => this.playing = true);
    },
    play() {
      this.audio.play();
      this.playing = true;
    },
    pause() {
      this.audio.pause();
      this.playing = false;
    }
  }">
  <button @click="play" x-show="!playing">
    <svg width="24" height="24" viewBox="0 0 35 34" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M3.83253 2.00117C3.83253 1.99007 3.83253 1.97896 3.83253 6.9773C3.83253 11.9756 3.83253 21.9837 3.82439 27.2293C3.81624 32.4749 3.79995 32.6547 3.84365 32.7272C3.88735 32.7997 3.99153 32.7595 7.27009 30.3131C10.5487 27.8668 16.9984 23.0155 21.8552 19.6898C26.712 16.3641 29.7804 14.711 31.4308 13.8088C33.2286 12.826 33.4433 12.6297 33.5264 12.4802C33.5626 12.4151 33.4578 12.3195 30.5152 11.8095C27.5726 11.2996 21.7623 10.3649 17.5921 9.33974C13.4218 8.31461 11.0677 7.22738 9.26209 6.31203C7.45644 5.39668 6.2706 4.68615 5.16863 4.10036C4.06665 3.51457 3.08448 3.07504 2.43807 2.75345C1.79165 2.43187 1.51074 2.24156 1.1123 1.96582" stroke="black" stroke-width="2" stroke-linecap="round" />
    </svg>
  </button>
  <button @click="pause" x-show="playing">
    <img src="/assets/images/spiral.png" alt="Pause" class="w-6 h-6 motion-safe:animate-spin-slow" />
  </button>
  <p>Seyðisfjörður Community Radio 107.1</p>
</div>