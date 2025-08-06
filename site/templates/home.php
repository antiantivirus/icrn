<?php snippet('header'); ?>
<?php snippet('views/network-diagram', ['stations' =>  $stationsJSON]); ?>
<div class="max-w-prose mx-auto text-center">
  <h2><?= $page->intro() ?></h2>
  <a href="/about">More Info -></a>
</div>

<?= $stationsJSON ?>

<?php snippet('footer'); ?>