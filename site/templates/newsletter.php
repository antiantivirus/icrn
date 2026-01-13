<?php snippet('header') ?>

<div class="pt-40 lg:pt-80 px-4 lg:px-10 min-h-screen">
  <h1 class="blob before:bg-dark-blue mb-10">
    <?= $page->title() ?>
  </h1>
  <?php snippet('views/newsletter') ?>
  <img src="/assets/images/winding.png" alt="" class="w-60 mt-20" />
  <?php if ($page->editions()->isNotEmpty()): ?>
    <div class="mt-16">
      <h2 class="mb-6">Past Editions</h2>
      <ul class="space-y-4">
        <?php foreach ($page->editions()->toStructure()->sortBy('date', 'desc') as $edition): ?>
          <li>
            <a href="<?= $edition->link() ?>" target="_blank" rel="noopener noreferrer" class="hover:underline">
              <?= $edition->title() ?><?= $edition->date()->toDate("F 'y") ?>
            </a>
          </li>
        <?php endforeach ?>
      </ul>
    </div>
  <?php endif ?>
</div>

<?php snippet('footer') ?>