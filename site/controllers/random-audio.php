<?php

return function ($kirby) {
    // Get all resources that have media URLs
    $resources = $kirby->page('resources')->children()->listed();
    $audioResources = [];

    foreach ($resources as $resource) {
        if ($resource->media()->isNotEmpty()) {
            $url = $resource->media()->value();
            // Check if it's an Internet Archive URL
            if (strpos($url, 'archive.org') !== false) {
                $audioResources[] = [
                    'title' => $resource->title()->value(),
                    'url' => $url,
                    'resourceUrl' => $resource->url()
                ];
            }
        }
    }

    // Return a random audio resource
    if (!empty($audioResources)) {
        $randomResource = $audioResources[array_rand($audioResources)];

        // Return JSON response
        header('Content-Type: application/json');
        echo json_encode($randomResource);
        exit;
    }

    // No audio resources found
    header('Content-Type: application/json');
    echo json_encode(['error' => 'No audio resources found']);
    exit;
};
