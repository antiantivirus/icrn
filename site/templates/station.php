<?php snippet('header') ?>
<?php $stations = $site->find('members')->children()->listed()->not($page)->shuffle(); ?>


<marquee class="pt-24 lg:pt-60 px-4 lg:px-10">
  <?php if ($stations->isNotEmpty()): ?>
    <?php foreach ($stations as $station): ?>
      <style>
        .blob-<?= $station->slug() ?>::before {
          background: <?= $station->colour() ?>;
        }
      </style>
      <a href="<?= $station->url() ?>" class="blob-small blob-<?= $station->slug() ?> mr-4"><?= $station->title() ?></a>
    <?php endforeach ?>
  <?php endif ?>
</marquee>
<div class="grid md:grid-cols-2 gap-10 lg:gap-20 pt-10 lg:pt-10 px-4 lg:px-10">
  <div>
    <div class="mb-8">
      <h1 class="blob" id="title">
        <?= $page->title() ?>
      </h1>
    </div>

    <p class="font-family-mono">Location: <?= $page->location() ?></p>


    <p class="font-family-mono">Frequency:
      <?php if ($page->frequency()->isNotEmpty()): ?>
        <?= $page->frequency() ?>
      <?php else: ?>
        Online
      <?php endif ?>
    </p>
    <a class="mb-6 font-family-mono link" href="<?= $page->website() ?>" target="_blank">Website</a>

    <img src="/assets/images/coil.png" alt="" class="mx-auto w-auto h-5 my-12">

    <div class="prose max-w-prose mt-6">
      <?= $page->description()->kt() ?>
    </div>
  </div>
  <div>
    <?php if ($page->pics()->isNotEmpty()): ?>
      <div class="grid gap-4">
        <?php foreach ($page->pics()->toFiles() as $pic): ?>
          <div>
            <img src="<?= $pic->resize(960, null)->url() ?>" alt="<?= $pic->alt() ?>" class="w-full h-auto">
          </div>
        <?php endforeach ?>
      </div>
    <?php endif ?>
  </div>
</div>


<style>
  #title::before {
    background: <?= $page->colour() ?>;
  }
</style>
<?php snippet('footer') ?>