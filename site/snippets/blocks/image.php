<?php
$image = $block->image()->toFile();
?>

<?php if ($image): ?>
  <figure class="space-y-3">
    <?php if ($block->link()->isNotEmpty()): ?>
      <a href="<?= $block->link() ?>" target="_blank" rel="noopener noreferrer">
        <img
          src="<?= $image->resize(1200)->url() ?>"
          alt="<?= $block->alt()->or($image->alt())->or('') ?>"
          loading="lazy"
          class="w-full h-auto" />
      </a>
    <?php else: ?>
      <img
        src="<?= $image->resize(1200)->url() ?>"
        alt="<?= $block->alt()->or($image->alt())->or('') ?>"
        loading="lazy"
        class="w-full h-auto" />
    <?php endif; ?>

    <?php if ($block->caption()->isNotEmpty()): ?>
      <figcaption class="text-sm text-gray-600">
        <?= $block->caption()->html() ?>
      </figcaption>
    <?php endif; ?>
  </figure>
<?php endif; ?>
