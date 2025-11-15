<?php

/**
 * Internet Archive Audio Player
 * Fetches audio files from an Internet Archive item and creates a playlist
 *
 * @param string $url - Internet Archive item URL (e.g., https://archive.org/details/item-identifier)
 * @param string $title - Optional title for the player
 */

// Get parameters with defaults
$url = $url ?? '';
$title = $title ?? null;

// Extract identifier from URL
$identifier = null;
if (preg_match('/archive\.org\/details\/([^\/\?]+)/', $url, $matches)) {
    $identifier = $matches[1];
}

if (!$identifier) {
    // If we can't parse the identifier, just show a link
?>
    <a
        href="<?= $url ?>"
        target="_blank"
        rel="noopener noreferrer"
        class="inline-block px-4 py-2 bg-bright-green border-2 border-black font-bold hover:bg-green transition-colors">
        Listen on Internet Archive ↗
    </a>
<?php
    return;
}

// Try to fetch metadata from Internet Archive API
$apiUrl = "https://archive.org/metadata/{$identifier}";
$cacheKey = "ia_metadata_{$identifier}";

// Simple cache using Kirby's cache (if available)
$metadata = null;
try {
    if (function_exists('kirby')) {
        $cache = kirby()->cache('pages');
        $metadata = $cache->get($cacheKey);
    }

    if (!$metadata) {
        $response = @file_get_contents($apiUrl);
        if ($response) {
            $metadata = json_decode($response, true);

            // Cache for 1 hour
            if (function_exists('kirby') && $metadata) {
                $cache->set($cacheKey, $metadata, 60);
            }
        }
    }
} catch (Exception $e) {
    // Failed to fetch metadata
    $metadata = null;
}

// Extract media files - audio and video
$audioFiles = [];
$videoFiles = [];
$mediaType = null;

if ($metadata && isset($metadata['files'])) {
    // First, try to get only MP3 files
    $mp3Files = [];
    $otherAudioFiles = [];

    foreach ($metadata['files'] as $file) {
        $name = $file['name'] ?? '';
        $format = $file['format'] ?? '';
        $formatUpper = strtoupper($format);

        // Prioritize MP3 files for audio compatibility
        if (in_array($formatUpper, ['VBR MP3', 'MP3'])) {
            $mp3Files[] = [
                'name' => $name,
                'format' => $format,
                'url' => "https://archive.org/download/{$identifier}/" . rawurlencode($name),
                'title' => isset($file['title']) ? $file['title'] : pathinfo($name, PATHINFO_FILENAME),
                'track' => isset($file['track']) ? $file['track'] : null,
                'length' => isset($file['length']) ? $file['length'] : null,
            ];
        } elseif (in_array($formatUpper, ['OGG VORBIS', 'FLAC'])) {
            $otherAudioFiles[] = [
                'name' => $name,
                'format' => $format,
                'url' => "https://archive.org/download/{$identifier}/" . rawurlencode($name),
                'title' => isset($file['title']) ? $file['title'] : pathinfo($name, PATHINFO_FILENAME),
                'track' => isset($file['track']) ? $file['track'] : null,
                'length' => isset($file['length']) ? $file['length'] : null,
            ];
        } elseif (in_array($formatUpper, ['MPEG4', 'H.264', 'OGG VIDEO', 'WEBM'])) {
            $videoFiles[] = [
                'name' => $name,
                'format' => $format,
                'url' => "https://archive.org/download/{$identifier}/" . rawurlencode($name),
                'title' => isset($file['title']) ? $file['title'] : pathinfo($name, PATHINFO_FILENAME),
            ];
        }
    }

    // Use MP3 files if available, otherwise fall back to other formats
    $audioFiles = !empty($mp3Files) ? $mp3Files : $otherAudioFiles;

    // Sort by track number if available
    if (!empty($audioFiles)) {
        usort($audioFiles, function ($a, $b) {
            if ($a['track'] && $b['track']) {
                return intval($a['track']) - intval($b['track']);
            }
            return strcmp($a['name'], $b['name']);
        });
        $mediaType = 'audio';
    } elseif (!empty($videoFiles)) {
        $mediaType = 'video';
    }
}

// If we couldn't get any media files, show a simple link
if (!$mediaType) {
?>
    <p class="mb-4 font-family-mono">Listen on Internet Archive:</p>
    <a
        href="<?= $url ?>"
        target="_blank"
        rel="noopener noreferrer"
        class="inline-block px-4 py-2 bg-bright-green border-2 border-black font-bold hover:bg-green transition-colors">
        Open in Internet Archive ↗
    </a>
<?php
    return;
}

// Handle different media types
if ($mediaType === 'audio') {
    // Safely encode tracks for JavaScript
    $tracksJson = json_encode($audioFiles, JSON_HEX_APOS | JSON_HEX_QUOT);

    // Display audio player with playlist
?>
    <ia-archive-player data-tracks='<?= htmlspecialchars($tracksJson, ENT_QUOTES, 'UTF-8') ?>'>
        <div class="bg-white">
            <!-- Current Track Display -->

            <!-- Playlist -->
            <div class="playlist-container max-h-64 overflow-y-auto"></div>
        </div>
    </ia-archive-player>

    <script>
        if (!customElements.get('ia-archive-player')) {
            class IAArchivePlayer extends HTMLElement {
                constructor() {
                    super();
                    this.tracks = [];
                    this.currentTrack = 0;
                }

                connectedCallback() {
                    // Parse tracks data
                    const tracksData = this.getAttribute('data-tracks');
                    if (tracksData) {
                        this.tracks = JSON.parse(tracksData);
                    }

                    // Get current page URL for info button
                    this.resourceUrl = window.location.href;

                    // Get DOM elements
                    this.playButton = this.querySelector('.play-button');
                    this.prevButton = this.querySelector('.prev-button');
                    this.nextButton = this.querySelector('.next-button');
                    this.currentTrackTitle = this.querySelector('.current-track-title');
                    this.currentIndexEl = this.querySelector('.current-index');
                    this.playlistContainer = this.querySelector('.playlist-container');

                    // Setup event listeners
                    this.setupEventListeners();

                    // Render playlist
                    this.renderPlaylist();

                    // Update initial UI
                    this.updateUI();

                    // Listen for track changes from main player
                    this.trackChangedHandler = (e) => {
                        this.currentTrack = e.detail.index;
                        this.updateUI();
                    };
                    window.addEventListener('radio-player-track-changed', this.trackChangedHandler);
                }

                disconnectedCallback() {
                    window.removeEventListener('radio-player-track-changed', this.trackChangedHandler);
                }

                setupEventListeners() {
                    this.playButton?.addEventListener('click', () => this.playTrack(this.currentTrack));
                    this.prevButton?.addEventListener('click', () => this.prevTrack());
                    this.nextButton?.addEventListener('click', () => this.nextTrack());
                }

                renderPlaylist() {
                    if (!this.playlistContainer) return;

                    this.playlistContainer.innerHTML = this.tracks.map((track, index) => `
                <div class="playlist-item p-2 border-b border-gray-300 cursor-pointer transition-colors hover:bg-gray-50" data-index="${index}">
                    <div class="flex items-center gap-2">
                        <div class="w-6 h-6 flex items-center justify-center border border-black flex-shrink-0 bg-white">
                            <span class="text-xs">${index + 1}</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="truncate text-sm">${this.escapeHtml(track.title)}</div>
                        </div>
                    </div>
                </div>
            `).join('');

                    // Add click handlers to playlist items
                    this.querySelectorAll('.playlist-item').forEach(item => {
                        item.addEventListener('click', () => {
                            const index = parseInt(item.getAttribute('data-index'));
                            this.playTrack(index);
                        });
                    });
                }

                updateUI() {
                    const track = this.tracks[this.currentTrack];
                    if (!track) return;

                    // Update current track title
                    if (this.currentTrackTitle) {
                        this.currentTrackTitle.textContent = track.title;
                    }

                    // Update counter
                    if (this.currentIndexEl) {
                        this.currentIndexEl.textContent = this.currentTrack + 1;
                    }

                    // Update button states
                    if (this.prevButton) {
                        this.prevButton.disabled = this.currentTrack === 0;
                        this.prevButton.classList.toggle('opacity-50', this.currentTrack === 0);
                        this.prevButton.classList.toggle('cursor-not-allowed', this.currentTrack === 0);
                    }

                    if (this.nextButton) {
                        this.nextButton.disabled = this.currentTrack === this.tracks.length - 1;
                        this.nextButton.classList.toggle('opacity-50', this.currentTrack === this.tracks.length - 1);
                        this.nextButton.classList.toggle('cursor-not-allowed', this.currentTrack === this.tracks.length - 1);
                    }

                    // Update playlist highlighting
                    this.querySelectorAll('.playlist-item').forEach((item, index) => {
                        const isActive = index === this.currentTrack;
                        item.classList.toggle('bg-bright-green', isActive);
                        item.classList.toggle('bg-white', !isActive);

                        const indicator = item.querySelector('.w-6');
                        indicator.classList.toggle('bg-black', isActive);
                        indicator.classList.toggle('text-white', isActive);
                        indicator.classList.toggle('bg-white', !isActive);

                        const numberSpan = indicator.querySelector('span');
                        numberSpan.textContent = isActive ? '▶' : (index + 1);
                    });
                }

                playTrack(index) {
                    this.currentTrack = index;
                    const track = this.tracks[index];

                    // Send event to main player
                    window.dispatchEvent(new CustomEvent('ia-player-track', {
                        detail: {
                            url: track.url,
                            title: track.title,
                            playlist: this.tracks,
                            index: index,
                            resourceUrl: this.resourceUrl
                        }
                    }));

                    this.updateUI();
                }

                nextTrack() {
                    if (this.currentTrack < this.tracks.length - 1) {
                        this.playTrack(this.currentTrack + 1);
                    }
                }

                prevTrack() {
                    if (this.currentTrack > 0) {
                        this.playTrack(this.currentTrack - 1);
                    }
                }

                escapeHtml(text) {
                    const div = document.createElement('div');
                    div.textContent = text;
                    return div.innerHTML;
                }
            }

            customElements.define('ia-archive-player', IAArchivePlayer);
        }
    </script>
<?php
} elseif ($mediaType === 'video') {
    // Display video player
    $video = $videoFiles[0]; // Use first video file
?>
    <video controls class="w-full">
        <source src="<?= $video['url'] ?>" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <?php if (count($videoFiles) > 1): ?>
        <div class="mt-4">
            <p class="font-family-mono mb-2">Additional videos:</p>
            <div class="space-y-2">
                <?php foreach (array_slice($videoFiles, 1) as $vid): ?>
                    <a href="<?= $vid['url'] ?>" target="_blank" class="block hover:underline">
                        <?= esc($vid['title']) ?> ↗
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
<?php
}
?>