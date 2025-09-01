<?php snippet('header') ?>

<div class="pt-40 md:pt-80 px-10 h-screen">
  <h1 class="flex items-center gap-3 mb-12">
    <div class="w-10 h-10 rounded-full bg-blue mt-1"></div>
    <?= $page->title() ?>
  </h1>
  <style type="text/css">
    @import url("https://assets.mlcdn.com/fonts.css?version=1721302");
  </style>
  <?php snippet('views/newsletter') ?>
</div>

<?php snippet('footer') ?>