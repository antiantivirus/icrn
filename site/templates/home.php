<?php snippet('header'); ?>
<section
  class="min-h-[125vh] bg-gradient-home"
  style="background: linear-gradient(180deg, #01B4FF 73.28%, rgba(54, 178, 80, 0) 100%);">
  <img src="<?= $page->collage()->toFile()->url() ?>" alt="" class="object-cover w-full h-full absolute top-0 left-0 mix-blend-color-burn">
  <div class="relative z-10 flex flex-col gap-15 lg:gap-20 py-20">
    <?php snippet('views/network-diagram', ['stations' =>  $stationsJSON]); ?>
    <div class="max-w-prose mx-auto text-center p-4 bg-blue">
      <a href="/about">
        <h2>
          <?= $page->intro()->kirbytext() ?>
          <span class="text-bright-green underline mt-2.5 block">More Info →</span>
        </h2>
      </a>
    </div>
    <img class="w-[200px] mx-auto" src="<?= $page->graphic()->toFile()->url() ?>" alt="">
  </div>
</section>

<section class="px-15">
  <h3>Members</h3>
  <div class="flex">
    <?php foreach ($stations as $member): ?>
      <a href="<?= $member->url() ?>" class="inline-block mx-10 grayscale hover:grayscale-0" target="_blank" rel="noopener">
        <?= $member->name() ?>
      </a>
    <?php endforeach; ?>
  </div>
</section>

<?php snippet('footer'); ?>