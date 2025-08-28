<?php snippet('header'); ?>
<section
  class="min-h-[125vh] bg-gradient-home mt-20"
  style="background: linear-gradient(180deg, #01B4FF 73.28%, rgba(54, 178, 80, 0) 100%);">
  <img src="<?= $page->collage()->toFile()->url() ?>" alt="" class="object-cover w-full h-full absolute top-0 left-0 mix-blend-color-burn">
  <div class="relative z-10 flex flex-col gap-15 lg:gap-20 py-20">
    <?php snippet('views/network-diagram', ['stations' =>  $stationsJSON]); ?>
    <div class="max-w-prose mx-auto text-center p-4 bg-blue">
      <h2>
        <?= $page->intro()->kirbytext() ?>
        <a class="text-bright-green underline mt-2.5 block" href="/about">
          More Info →
        </a>
      </h2>
    </div>
    <img class="w-[200px] mx-auto" src="<?= $page->graphic()->toFile()->url() ?>" alt="">
  </div>
</section>

<section class="px-15">
  <h3 class="flex items-center gap-3 h1 mb-12">
    <div class="w-10 h-10 rounded-full bg-green mt-1"></div>
    Members
  </h3>
  <div class="flex gap-x-10 gap-y-4 flex-wrap">
    <?php foreach ($stations as $member): ?>
      <a class="flex items-center gap-1" href="<?= $member->url() ?>">
        <div class="w-5 h-5 rounded-full mt-0.25" style="background: <?= $member->colour() ?>"></div>
        <?= $member->title() ?>
      </a>
    <?php endforeach; ?>
  </div>
</section>

<?php snippet('footer'); ?>