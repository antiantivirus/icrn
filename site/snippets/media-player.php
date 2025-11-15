<?php
/**
 * Media Player Snippet
 * Displays multiple media items with navigation
 * @param $mediaItems - Structure field with media items
 */
?>

<div x-data="{
  currentIndex: 0,
  totalItems: <?= $mediaItems->count() ?>,
  next() {
    if (this.currentIndex < this.totalItems - 1) {
      this.currentIndex++
    }
  },
  prev() {
    if (this.currentIndex > 0) {
      this.currentIndex--
    }
  },
  goTo(index) {
    this.currentIndex = index
  }
}" class="media-player bg-gray-50 border-2 border-black p-6 lg:p-8">

  <h2 class="text-xl lg:text-2xl font-bold mb-6">Media</h2>

  <!-- Media Items -->
  <div class="relative">
    <?php $index = 0; ?>
    <?php foreach ($mediaItems as $item): ?>
      <div
        x-show="currentIndex === <?= $index ?>"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        class="media-item"
      >
        <!-- Media Title -->
        <?php if ($item->title()->isNotEmpty()): ?>
          <h3 class="text-lg lg:text-xl font-bold mb-3">
            <?= $item->title()->esc() ?>
          </h3>
        <?php endif; ?>

        <!-- Media Link/Embed -->
        <?php if ($item->url()->isNotEmpty()): ?>
          <div class="mb-4">
            <?php
            $url = $item->url()->value();
            $isYouTube = strpos($url, 'youtube.com') !== false || strpos($url, 'youtu.be') !== false;
            $isVimeo = strpos($url, 'vimeo.com') !== false;
            $isSoundcloud = strpos($url, 'soundcloud.com') !== false;
            $isArchive = strpos($url, 'archive.org') !== false;
            $isBandcamp = strpos($url, 'bandcamp.com') !== false;
            ?>

            <?php if ($isYouTube): ?>
              <!-- YouTube Embed -->
              <?php
              preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $url, $matches);
              $videoId = $matches[1] ?? null;
              ?>
              <?php if ($videoId): ?>
                <div class="aspect-video">
                  <iframe
                    class="w-full h-full"
                    src="https://www.youtube.com/embed/<?= $videoId ?>"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen
                  ></iframe>
                </div>
              <?php endif; ?>

            <?php elseif ($isVimeo): ?>
              <!-- Vimeo Embed -->
              <?php
              preg_match('/vimeo\.com\/(\d+)/i', $url, $matches);
              $videoId = $matches[1] ?? null;
              ?>
              <?php if ($videoId): ?>
                <div class="aspect-video">
                  <iframe
                    class="w-full h-full"
                    src="https://player.vimeo.com/video/<?= $videoId ?>"
                    frameborder="0"
                    allow="autoplay; fullscreen; picture-in-picture"
                    allowfullscreen
                  ></iframe>
                </div>
              <?php endif; ?>

            <?php elseif ($isSoundcloud): ?>
              <!-- SoundCloud Embed -->
              <div class="aspect-video">
                <iframe
                  class="w-full h-full"
                  scrolling="no"
                  frameborder="no"
                  allow="autoplay"
                  src="https://w.soundcloud.com/player/?url=<?= urlencode($url) ?>&color=%23a2ff00&auto_play=false&hide_related=true&show_comments=false&show_user=true&show_reposts=false&show_teaser=false&visual=true"
                ></iframe>
              </div>

            <?php elseif ($isArchive): ?>
              <!-- Internet Archive Player -->
              <div class="p-6 border-2 border-black bg-gray-50">
                <?= snippet('internet-archive-player', [
                  'url' => $url,
                  'title' => $item->title()->isNotEmpty() ? $item->title()->value() : null
                ]) ?>
              </div>

            <?php elseif ($isBandcamp): ?>
              <!-- Bandcamp Link -->
              <div class="p-6 border-2 border-black bg-white">
                <p class="mb-4 font-family-mono">Listen on Bandcamp:</p>
                <a
                  href="<?= $url ?>"
                  target="_blank"
                  rel="noopener noreferrer"
                  class="inline-block px-4 py-2 bg-bright-green border-2 border-black font-bold hover:bg-green transition-colors link"
                >
                  Open in Bandcamp
                </a>
              </div>

            <?php else: ?>
              <!-- Generic Link -->
              <div class="p-6 border-2 border-black bg-white">
                <a
                  href="<?= $url ?>"
                  target="_blank"
                  rel="noopener noreferrer"
                  class="inline-block px-4 py-2 bg-bright-green border-2 border-black font-bold hover:bg-green transition-colors link"
                >
                  View Media
                </a>
              </div>
            <?php endif; ?>
          </div>
        <?php endif; ?>

        <!-- Media Caption -->
        <?php if ($item->caption()->isNotEmpty()): ?>
          <div class="text-sm text-gray-700">
            <?= $item->caption()->kt() ?>
          </div>
        <?php endif; ?>
      </div>
      <?php $index++; ?>
    <?php endforeach; ?>
  </div>

  <!-- Navigation Controls -->
  <?php if ($mediaItems->count() > 1): ?>
    <div class="mt-8">
      <!-- Progress Indicators -->
      <div class="flex justify-center gap-2 mb-4">
        <?php for ($i = 0; $i < $mediaItems->count(); $i++): ?>
          <button
            @click="goTo(<?= $i ?>)"
            :class="currentIndex === <?= $i ?> ? 'bg-bright-green' : 'bg-white'"
            class="w-3 h-3 rounded-full border-2 border-black transition-colors hover:bg-bright-green"
            aria-label="Go to media item <?= $i + 1 ?>"
          ></button>
        <?php endfor; ?>
      </div>

      <!-- Previous/Next Buttons -->
      <div class="flex justify-between items-center">
        <button
          @click="prev()"
          :disabled="currentIndex === 0"
          :class="currentIndex === 0 ? 'opacity-50 cursor-not-allowed' : 'hover:bg-gray-200'"
          class="px-4 py-2 border-2 border-black bg-white font-bold transition-colors disabled:hover:bg-white"
        >
          ← Previous
        </button>

        <span class="text-sm font-family-mono">
          <span x-text="currentIndex + 1"></span> / <?= $mediaItems->count() ?>
        </span>

        <button
          @click="next()"
          :disabled="currentIndex === <?= $mediaItems->count() - 1 ?>"
          :class="currentIndex === <?= $mediaItems->count() - 1 ?> ? 'opacity-50 cursor-not-allowed' : 'hover:bg-gray-200'"
          class="px-4 py-2 border-2 border-black bg-white font-bold transition-colors disabled:hover:bg-white"
        >
          Next →
        </button>
      </div>
    </div>
  <?php endif; ?>

</div>
