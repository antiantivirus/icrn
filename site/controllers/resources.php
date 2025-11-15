<?php

return function ($site, $page, $kirby) {

  // Get all resources
  $allResources = $page->children()->listed();

  // Get all unique tags
  $allTags = [];
  foreach ($allResources as $resource) {
    $tags = $resource->tags()->split(',');
    foreach ($tags as $tag) {
      $tag = trim($tag);
      if (!empty($tag) && !in_array($tag, $allTags)) {
        $allTags[] = $tag;
      }
    }
  }
  sort($allTags);

  // Get filter parameters
  $searchQuery = $kirby->request()->get('search', '');
  $selectedTags = $kirby->request()->get('tags', '');
  $offset = (int)$kirby->request()->get('offset', 0);
  $limit = 20;

  // Filter resources
  $resources = $allResources;

  // Filter by search query
  if (!empty($searchQuery)) {
    $resources = $resources->filter(function($item) use ($searchQuery) {
      $query = strtolower($searchQuery);
      return stripos(strtolower($item->title()), $query) !== false
          || stripos(strtolower($item->description()), $query) !== false
          || stripos(strtolower($item->tags()), $query) !== false;
    });
  }

  // Filter by tags
  if (!empty($selectedTags)) {
    $tagArray = array_map('trim', explode(',', $selectedTags));
    $resources = $resources->filter(function($item) use ($tagArray) {
      $itemTags = array_map('trim', $item->tags()->split(','));
      foreach ($tagArray as $tag) {
        if (in_array($tag, $itemTags)) {
          return true;
        }
      }
      return false;
    });
  }

  // Sort by date (newest first)
  $resources = $resources->sortBy('date', 'desc');

  $totalCount = $resources->count();
  $hasMore = $totalCount > ($offset + $limit);

  // Paginate
  $paginatedResources = $resources->slice($offset, $limit);

  return [
    'resources' => $paginatedResources,
    'allTags' => $allTags,
    'totalCount' => $totalCount,
    'hasMore' => $hasMore,
    'offset' => $offset,
    'limit' => $limit,
    'searchQuery' => $searchQuery,
    'selectedTags' => $selectedTags,
  ];
};
