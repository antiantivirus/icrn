<?php snippet('header') ?>

<div class="pt-40 lg:pt-80 px-4 lg:px-10 max-w-screen">
  <?php if ($page->showToc()->toBool()): ?>
    <div class="flex flex-col lg:flex-row lg:flex-row-reverse gap-10 lg:gap-16 justify-center">
      <aside class="hidden lg:block lg:sticky lg:top-32 lg:self-start flex-shrink-0 lg:mt-28">
        <?php snippet('toc', ['blocks' => $page->text()->toBlocks()]) ?>
      </aside>
      <div class="max-w-prose">
        <h1 class="blob before:bg-blue mb-10 lg:mb-16">
          <?= $page->title() ?>
        </h1>

        <article class="prose space-y-5 lg:space-y-10">
          <?php foreach ($page->text()->toBlocks() as $block): ?>
            <div class="block block-type-<?= $block->type() ?>">
              <?= $block ?>
            </div>
          <?php endforeach ?>
        </article>
      </div>


    </div>
  <?php else: ?>
    <article class="max-w-prose mx-auto prose space-y-5 lg:space-y-10">
      <h1 class="blob before:bg-blue">
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