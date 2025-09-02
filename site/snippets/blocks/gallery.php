<?php
$images = $block->images()->toFiles();
?>

<?php if ($images->isNotEmpty()): ?>
  <div class="flex items-center gap-5 lg:gap-10">
    <?php foreach ($images as $image): ?>
      <img
        src="<?= $image->resize(400)->url() ?>"
        alt="<?= $image->alt()->or($image->filename()) ?>"
        loading="lazy"
        class="h-14" />
      <?php if ($image->caption()->isNotEmpty()): ?>
        <p class="text-sm text-gray-600 mt-2 text-center">
          <?= $image->caption()->html() ?>
        </p>
      <?php endif; ?>
    <?php endforeach; ?>
  </div>
<?php endif; ?>