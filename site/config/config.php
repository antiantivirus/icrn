<?php

return [
  'debug' => true,
  'routes' => [
    [
      'pattern' => 'ia-player',
      'method' => 'GET',
      'action' => function () {
        $url = get('url', '');
        $title = get('title', '');

        // Return only the player snippet
        return snippet('internet-archive-player', [
          'url' => $url,
          'title' => $title
        ], true);
      }
    ],
    [
      'pattern' => 'random-audio',
      'method' => 'GET',
      'action' => function () {
        // Get all resources that have media URLs and are tagged with 'Audio'
        $resources = page('resources')->children()->listed();
        $audioResources = [];

        foreach ($resources as $resource) {
          if ($resource->media()->isNotEmpty() && $resource->tags()->isNotEmpty()) {
            $url = $resource->media()->value();
            $tags = $resource->tags()->split(',');
            $hasAudioTag = false;

            foreach ($tags as $tag) {
              if (trim(strtolower($tag)) === 'audio') {
                $hasAudioTag = true;
                break;
              }
            }

            // Check if it's an Internet Archive URL and has Audio tag
            if (strpos($url, 'archive.org') !== false && $hasAudioTag) {
              $audioResources[] = [
                'title' => $resource->title()->value(),
                'url' => $url,
                'resourceUrl' => $resource->url()
              ];
            }
          }
        }

        // Pick a random resource
        if (empty($audioResources)) {
          return new Kirby\Http\Response(json_encode([
            'status' => 'error',
            'message' => 'No audio resources found'
          ]), 'application/json');
        }

        $randomResource = $audioResources[array_rand($audioResources)];

        // Extract identifier from Internet Archive URL
        $identifier = null;
        if (preg_match('/archive\.org\/details\/([^\/\?]+)/', $randomResource['url'], $matches)) {
          $identifier = $matches[1];
        }

        if (!$identifier) {
          return new Kirby\Http\Response(json_encode([
            'status' => 'error',
            'message' => 'Could not parse Internet Archive identifier'
          ]), 'application/json');
        }

        // Fetch metadata from Internet Archive API
        $apiUrl = "https://archive.org/metadata/{$identifier}";
        $metadata = null;

        try {
          $response = @file_get_contents($apiUrl);
          if ($response) {
            $metadata = json_decode($response, true);
          }
        } catch (Exception $e) {
          // Failed to fetch metadata
        }

        if (!$metadata || !isset($metadata['files'])) {
          return new Kirby\Http\Response(json_encode([
            'status' => 'error',
            'message' => 'Could not fetch Internet Archive metadata'
          ]), 'application/json');
        }

        // Extract audio files (prioritize MP3)
        $audioFiles = [];
        foreach ($metadata['files'] as $file) {
          $name = $file['name'] ?? '';
          $format = $file['format'] ?? '';
          $formatUpper = strtoupper($format);

          if (in_array($formatUpper, ['VBR MP3', 'MP3', 'OGG VORBIS', 'FLAC'])) {
            $fileTitle = isset($file['title']) ? $file['title'] : pathinfo($name, PATHINFO_FILENAME);

            // Build display title with resource title if different
            $displayTitle = $fileTitle;
            if (strtolower($fileTitle) !== strtolower($randomResource['title'])) {
              $displayTitle = $randomResource['title'] . ' - ' . $fileTitle;
            }

            $audioFiles[] = [
              'url' => "https://archive.org/download/{$identifier}/" . rawurlencode($name),
              'title' => $displayTitle,
              'format' => $format
            ];
          }
        }

        if (empty($audioFiles)) {
          return new Kirby\Http\Response(json_encode([
            'status' => 'error',
            'message' => 'No audio files found in Internet Archive item'
          ]), 'application/json');
        }

        // Pick a random audio file
        $randomAudioFile = $audioFiles[array_rand($audioFiles)];

        return new Kirby\Http\Response(json_encode([
          'status' => 'success',
          'data' => [
            'title' => $randomAudioFile['title'],
            'url' => $randomAudioFile['url'],
            'resourceUrl' => $randomResource['resourceUrl']
          ]
        ]), 'application/json');
      }
    ]
  ]
];
