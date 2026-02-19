<?php

/**
 * Table of Contents Snippet
 * Generates a table of contents from heading blocks
 *
 * @param $blocks - Kirby blocks collection
 */

// Extract all heading blocks
$headings = [];
foreach ($blocks as $block) {
  if ($block->type() === 'heading') {
    $headingText = strip_tags($block->text()->value());
    $headings[] = [
      'id' => Str::slug($headingText),
      'text' => $headingText,
      'level' => (int) str_replace('h', '', $block->level()->value()),
      'color' => $block->color()->value()
    ];
  }
}

// Only render if there are headings
if (empty($headings)) {
  return;
}
?>

<nav class="toc" aria-label="Table of Contents">
  <ul class="toc-list space-y-2">
    <?php foreach ($headings as $heading): ?>
      <li class="toc-item toc-level-<?= $heading['level'] ?>" style="padding-left: <?= ($heading['level'] - 2) * 1.5 ?>rem;">
        <a href="#<?= $heading['id'] ?>" class="toc-link hover:underline flex items-center gap-3 text-2xl">
          <span class="w-4 h-4 rounded-full flex-shrink-0" style="background: <?= !empty($heading['color']) ? $heading['color'] : '#01b4ff' ?>"></span>
          <span><?= strip_tags($heading['text']) ?></span>
        </a>
      </li>
    <?php endforeach ?>
  </ul>
</nav>