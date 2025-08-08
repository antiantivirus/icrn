<?php snippet('header'); ?>
<?php snippet('views/network-diagram', ['stations' =>  $stationsJSON]); ?>
<div class="max-w-prose mx-auto text-center">
  <?= $page->intro()->kirbytext() ?>
  <a href="/about">More Info -></a>
</div>

<?= $stationsJSON ?>

<?php snippet('footer'); ?>