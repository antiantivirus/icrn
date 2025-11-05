<?php snippet('header') ?>
<?php $stations = $page->children()->listed(); ?>

<div class="pt-40 lg:pt-80 px-4 lg:px-10">
  <h1 class="mb-10 blob before:bg-orange">
    <?= $page->title() ?>
  </h1>

  <?php if ($stations->isNotEmpty()): ?>
    <div class="grid grid-cols-[repeat(auto-fill,minmax(250px,1fr))] gap-8">
      <?php foreach ($stations as $station): ?>
        <style>
          .blob-<?= $station->slug() ?>::before {
            background: <?= $station->colour() ?>;
          }
        </style>
        <a href="<?= $station->url() ?>" class="flex flex-col gap-4">
          <?php if ($station->logo()->isNotEmpty()): ?>
            <img src="<?= $station->logo()->toFile()->resize(500, null)->url() ?>" alt="<?= $station->title() ?> logo" class="w-full h-auto grayscale">
          <?php endif ?>
          <h2 class="blob-small blob-<?= $station->slug() ?>"><?= $station->title() ?></h2>
        </a>
      <?php endforeach ?>
    </div>
  <?php endif ?>
</div>

<?php snippet('footer') ?>