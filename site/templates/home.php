<?php snippet('header') ?>

<section
  class="bg-gradient-home pt-10 lg:pt-20 min-h-[125vh]"
  style="background: linear-gradient(180deg, #01B4FF 73.28%, rgba(54, 178, 80, 0) 100%);">
  <img src="<?= $page->collage()->toFile()->url() ?>" alt="" class="object-cover w-full h-full absolute top-0 left-0 mix-blend-color-burn">
  <div class="relative z-10 flex flex-col gap-15 lg:gap-20 py-20 max-w-[1200px] mx-auto">
    <?php snippet('views/network-diagram', ['stations' =>  $stationsJSON]); ?>
    <h2 class="max-w-2xl mx-auto text-center p-4 ">
      <?= $page->intro()->kirbytext() ?>
      <a class="text-bright-green underline mt-2.5 block" href="/about"
        hx-get="/about" hx-target="#main" hx-push-url="true">
        More Info →
      </a>
    </h2>
    <img class="w-30 lg:w-40 mx-auto" src="<?= $page->graphic()->toFile()->url() ?>" alt="">
  </div>
</section>

<!-- <section class="px-4 py-20 lg:px-10 mx-auto">
  <h3 class="blob before:bg-green h1 mb-12">
    Latest
  </h3>
  <div class="grid grid-cols-3 gap-x-10 gap-y-4">
    <div>
      <div class="aspect-video bg-green mb-1"></div>
      <h4 class="mb-1">Alternating Current Festival, May 1 – 4</h4>
      <p>We’re happy to announce that Alternating Current, organised by Dublin Digital Radio, kicks off this weekend!</p>
    </div>
    <div>
      <div class="aspect-video bg-orange mb-1"></div>
      <h4 class="mb-1">ICRN x Signals2Noise</h4>
      <p>We’re happy to announce that Alternating Current, organised by Dublin Digital Radio, kicks off this weekend!</p>
    </div>
    <div>
      <div class="aspect-video bg-dark-blue mb-1"></div>
      <h4 class="mb-1">ICRN x Tīrkultūra Radio Pop-Up at Le Guess Who? Festival</h4>
      <p>We’re happy to announce that Alternating Current, organised by Dublin Digital Radio, kicks off this weekend!</p>
    </div>
  </div>
</section> -->

<section class="px-4 py-20 lg:px-10 mx-auto">
  <h3 class="blob before:bg-green h1 mb-12">
    Members
  </h3>
  <div class="flex gap-x-10 gap-y-4 flex-wrap">
    <?php foreach ($stations as $member): ?>
      <div class="flex items-center gap-1">
        <div class="w-5 h-5 rounded-full mt-0.25" style="background: <?= $member->colour() ?>"></div>
        <a href="<?= $member->url() ?>">
          <h4><?= $member->title() ?></h4>
        </a>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<?php snippet('footer') ?>