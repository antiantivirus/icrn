<?php snippet('header') ?>

<div class="pt-40 md:pt-80 px-10 h-screen">
  <h1 class="blob before:bg-dark-blue">
    <?= $page->title() ?>
  </h1>
  <style type="text/css">
    @import url("https://assets.mlcdn.com/fonts.css?version=1721302");
  </style>
  <?php snippet('views/newsletter') ?>
  <img src="/assets/images/winding.png" alt="" class="w-60 mt-20" />
</div>

<?php snippet('footer') ?>