<blockquote class=" pl-6 py-2 italic">
  <p class="h1 font-family-mono">
    <?= $block->text() ?>
  </p>
  <?php if ($block->citation()->isNotEmpty()): ?>
    <cite class="block mt-4 not-italic font-medium">
      — <?= $block->citation()->html() ?>
    </cite>
  <?php endif; ?>
</blockquote>