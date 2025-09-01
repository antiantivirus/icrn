<?php snippet('header') ?>

<div class="pt-40 md:pt-80">
  <article class="max-w-prose mx-auto prose">
    <h1 class="pb-4 lg:pb-8 flex gap-2.5 items-center">
      <div class="w-10 h-10 rounded-full bg-blue mt-1"></div>
      <?= $page->title() ?>
    </h1>
    <?= $page->text()->kt() ?>
  </article>
</div>

<?php snippet('footer') ?>