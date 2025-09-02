<?php snippet('header') ?>

<div class="pt-40 md:pt-80 px-4 lg:px-10 max-w-screen">
  <article class="max-w-prose mx-auto prose space-y-5 lg:space-y-10 prose ">
    <h1 class="blob before:bg-blue">
      <?= $page->title() ?>
    </h1>
    <?php foreach ($page->text()->toBlocks() as $block): ?>
      <div id="<?= $block->id() ?>" class="block block-type-<?= $block->type() ?>">
        <?= $block ?>
      </div>
    <?php endforeach ?>
  </article>
</div>

<?php snippet('footer') ?>