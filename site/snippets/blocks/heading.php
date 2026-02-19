<?php
// Generate slug from heading text
$headingText = strip_tags($block->text()->value());
$slug = Str::slug($headingText);
$level = $block->level()->or('h2');
$levelNum = (int) str_replace('h', '', $level);
?>
<<?= $level ?> id="<?= $slug ?>" class="<?php if ($block->color()->isNotEmpty()): ?>blob<?php endif ?>">
  <?= $block->text() ?>
</<?= $level ?>>
<style>
  #<?= $slug ?> {
    scroll-margin-top: 6rem;
  }
  <?php if ($block->color()->isNotEmpty()): ?>
    #<?= $slug ?>.blob::before {
      background: <?= $block->color() ?>;
      <?php if ($levelNum >= 2): ?>
        width: <?= $levelNum === 2 ? '0.75rem' : '0.625rem' ?>;
        height: <?= $levelNum === 2 ? '0.75rem' : '0.625rem' ?>;
        vertical-align: <?= $levelNum === 2 ? '-4%' : '-2%' ?>;
      <?php endif ?>
    }
  <?php endif ?>
  @media (min-width: 1024px) {
    #<?= $slug ?> {
      scroll-margin-top: 8rem;
    }
    <?php if ($block->color()->isNotEmpty() && $levelNum >= 2): ?>
      #<?= $slug ?>.blob::before {
        width: <?= $levelNum === 2 ? '1.5rem' : '1.25rem' ?>;
        height: <?= $levelNum === 2 ? '1.5rem' : '1.25rem' ?>;
        vertical-align: <?= $levelNum === 2 ? '-6%' : '-4%' ?>;
      }
    <?php endif ?>
  }
</style>