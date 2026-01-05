<?php snippet('header') ?>

<article class="pt-40 lg:pt-80 px-4 lg:px-10 pb-20">
  <div class="max-w-screen-xl mx-auto">

    <div class="grid lg:grid-cols-6 gap-10 lg:gap-16 justify-center">
      <article class="space-y-10 lg:col-span-4 lg:space-y-16">
        <h1 class="blob">
          <?= $page->title() ?>
        </h1>
        <?php if ($page->color()->isNotEmpty()): ?>
          <style>
            h1.blob::before {
              background: <?= $page->color() ?>;
            }
          </style>
        <?php endif; ?>
        <?php if ($page->media()->isNotEmpty()): ?>
          <section>
            <?= snippet('internet-archive-player', [
              'url' => $page->media()->value()
            ]) ?>
          </section>
        <?php endif; ?>
        <?php if ($page->description()->isNotEmpty()): ?>
          <div class="leading-relaxed">
            <?= $page->description()->kt() ?>
          </div>
        <?php endif; ?>

        <?php if ($page->cover()->isNotEmpty()): ?>
          <div>
            <img
              src="<?= $page->cover()->toFile()->resize(1200, null)->url() ?>"
              alt="<?= $page->title()->esc() ?>"
              class="w-full h-auto">
          </div>
        <?php endif; ?>

        <?php if ($page->text()->isNotEmpty()): ?>
          <div class="prose space-y-6">
            <?= $page->text()->kt() ?>
          </div>
        <?php elseif ($page->content()->isNotEmpty()): ?>
          <div class="prose space-y-6">
            <?= $page->content()->kt() ?>
          </div>
        <?php endif; ?>


      </article>

      <aside class="space-y-2 lg:col-span-2 lg:space-y-4 lg:sticky lg:top-24 lg:mt-24 lg:self-start">
        <?php if ($page->tags()->isNotEmpty()): ?>
          <div>
            <span class="meta-label">Tags</span>
            <div class="flex flex-wrap gap-2">
              <?php
              $tags = $page->tags()->split(',');
              foreach ($tags as $tag):
                $tag = trim($tag);
              ?>
                <a
                  href="<?= $site->find('resources')->url() ?>?tags=<?= urlencode($tag) ?>"
                  class="tag">
                  <?= esc($tag) ?>
                </a>
              <?php endforeach; ?>
            </div>
          </div>
        <?php endif; ?>
        <?php if ($page->date()->isNotEmpty()): ?>
          <div>
            <span class="meta-label">Date: <?= $page->date()->toDate('F j, Y') ?>
            </span>
            <div></div>
          </div>
        <?php endif; ?>

        <?php if ($page->authors()->isNotEmpty()): ?>
          <div>
            <span class="meta-label">Authors: <?= $page->authors()->esc() ?></span>
          </div>
        <?php endif; ?>

        <?php if ($page->media()->isNotEmpty()): ?>
          <a
            href="<?= $page->media()->value() ?>"
            target="_blank"
            rel="noopener noreferrer"
            class="underline font-family-mono meta-label inline-block">
            View on Internet Archive ↗
          </a>
        <?php endif; ?>
        <?php
        $relatedStations = $page->stations()->toPages();
        if ($relatedStations->isNotEmpty()):
        ?>
          <span class="meta-label">Stations</span>
          <div class="space-y-1">
            <?php foreach ($relatedStations as $station): ?>
              <a
                href="<?= $station->url() ?>"
                class="block hover:underline">
                <div class="flex items-start gap-2">
                  <?php if ($station->colour()->isNotEmpty()): ?>
                    <div class="w-4 h-4 rounded-full mt-1 flex-shrink-0" style="background: <?= $station->colour() ?>"></div>
                  <?php else: ?>
                    <div class="w-4 h-4 rounded-full mt-1 flex-shrink-0 bg-black opacity-20"></div>
                  <?php endif; ?>
                  <?= $station->title() ?>
                </div>
              </a>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
        <?php
        $relatedResources = $page->related_resources()->toPages();
        if ($relatedResources->isNotEmpty()):
        ?>
          <span class="meta-label">Related Resources</span>
          <div class="space-y-1">
            <?php foreach ($relatedResources as $resource): ?>
              <a
                href="<?= $resource->url() ?>"
                class="block hover:underline">
                <div class="flex items-start gap-2">
                  <?php if ($resource->color()->isNotEmpty()): ?>
                    <div class="w-4 h-4 rounded-full mt-1 flex-shrink-0" style="background: <?= $resource->color() ?>"></div>
                  <?php else: ?>
                    <div class="w-4 h-4 rounded-full mt-1 flex-shrink-0 bg-black opacity-20"></div>
                  <?php endif; ?>
                  <?= $resource->title() ?>
                </div>
              </a>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </aside>
    </div>

  </div>
</article>

<?php snippet('footer') ?>