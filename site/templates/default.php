<?php snippet('header') ?>

<div class="pt-40 lg:pt-80 px-4 lg:px-10 pb-20">
  <?php if ($page->showToc()->toBool()): ?>
    <div class="max-w-screen-xl mx-auto flex flex-col items-center">
      <h1 class="blob before:bg-blue mb-10 lg:mb-16 max-w-prose w-full">
        <?= $page->title() ?>
      </h1>

      <div class="flex flex-col lg:flex-row gap-10 lg:gap-16">
        <article class="max-w-prose prose space-y-5 lg:space-y-10">
          <?php foreach ($page->text()->toBlocks() as $block): ?>
            <div class="block block-type-<?= $block->type() ?>">
              <?= $block ?>
            </div>
          <?php endforeach ?>
        </article>

        <!-- TOC - shown below content on mobile, to the right on desktop -->
        <aside class="lg:sticky lg:top-24 lg:self-start flex-shrink-0">
          <?php snippet('toc', ['blocks' => $page->text()->toBlocks()]) ?>
        </aside>
      </div>
    </div>
  <?php else: ?>
    <article class="max-w-prose mx-auto prose space-y-5 lg:space-y-10">
      <h1 class="blob before:bg-blue mb-10">
        <?= $page->title() ?>
      </h1>
      <?php foreach ($page->text()->toBlocks() as $block): ?>
        <div class="block block-type-<?= $block->type() ?>">
          <?= $block ?>
        </div>
      <?php endforeach ?>
    </article>
  <?php endif ?>
</div>

<?php snippet('footer') ?>