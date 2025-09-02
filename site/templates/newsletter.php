<?php snippet('header') ?>

<div class="pt-40 md:pt-80 px-4 lg:px-10 h-screen">
  <h1 class="blob before:bg-dark-blue mb-10">
    <?= $page->title() ?>
  </h1>
  <?php snippet('views/newsletter') ?>
  <img src="/assets/images/winding.png" alt="" class="w-60 mt-20" />
</div>

<?php snippet('footer') ?>