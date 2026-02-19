<?php snippet('header') ?>

<article class="pt-40 lg:pt-80 px-4 lg:px-10 pb-20">
  <div class="max-w-screen-xl mx-auto">

    <div class="grid lg:grid-cols-6 gap-10 lg:gap-16 justify-center">
      <article class="space-y-10 lg:col-span-4 lg:space-y-16">
        <h1 class="blob">
          <?= $page->title() ?>
        </h1>
        <?php
        if ($page->type()->isNotEmpty()) {
          $typeColors = [
            'report' => 'var(--color-bright-green)',
            'editorial' => 'var(--color-orange)',
            'broadcast' => 'var(--color-blue)',
            'sound' => 'var(--color-green)',
            'visual' => 'var(--color-dark-blue)'
          ];
          $color = $typeColors[$page->type()->value()] ?? null;
          if ($color):
        ?>
            <style>
              h1.blob::before {
                background: <?= $color ?>;
              }
            </style>
        <?php
          endif;
        }
        ?>
        <?php if ($page->media()->isNotEmpty()): ?>
          <section>
            <?= snippet('internet-archive-player', [
              'url' => $page->media()->value(),
              'resourceTitle' => $page->title()->value()
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

        <?php
        $contentBlocks = $page->content()->content()->toBlocks();
        if ($contentBlocks->isNotEmpty()):
        ?>
          <div class="space-y-10">
            <?php foreach ($contentBlocks as $block): ?>
              <div id="<?= $block->id() ?>" class="block block-type-<?= $block->type() ?>">
                <?php snippet('blocks/' . $block->type(), [
                  'block' => $block,
                ]) ?>
              </div>
            <?php endforeach ?>
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

        <?php if ($page->location()->isNotEmpty()): ?>
          <div>
            <span class="meta-label">Location: <?= $page->location()->esc() ?></span>
          </div>
        <?php endif; ?>

        <?php if ($page->authors()->isNotEmpty()): ?>
          <div>
            <span class="meta-label">Authors: <?= $page->authors()->esc() ?></span>
          </div>
        <?php endif; ?>

        <?php
        $documents = $page->documents();
        if ($documents && $documents->isNotEmpty()):
        ?>
          <div>
            <span class="meta-label">Documents</span>
            <div class="space-y-1">
              <?php foreach ($documents as $document): ?>
                <a
                  href="<?= $document->url() ?>"
                  target="_blank"
                  rel="noopener noreferrer"
                  class="block hover:underline">
                  <?= $document->title()->isNotEmpty() ? $document->title() : $document->filename() ?> ↗
                </a>
              <?php endforeach; ?>
            </div>
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
                  <?php
                  if ($resource->type()->isNotEmpty()) {
                    $typeColors = [
                      'report' => 'var(--color-bright-green)',
                      'editorial' => 'var(--color-orange)',
                      'broadcast' => 'var(--color-blue)',
                      'sound' => 'var(--color-green)',
                      'visual' => 'var(--color-dark-blue)'
                    ];
                    $color = $typeColors[$resource->type()->value()] ?? null;
                    if ($color):
                  ?>
                      <div class="w-4 h-4 rounded-full mt-1 flex-shrink-0" style="background: <?= $color ?>"></div>
                    <?php
                    else:
                    ?>
                      <div class="w-4 h-4 rounded-full mt-1 flex-shrink-0 bg-black opacity-20"></div>
                    <?php
                    endif;
                  } else {
                    ?>
                    <div class="w-4 h-4 rounded-full mt-1 flex-shrink-0 bg-black opacity-20"></div>
                  <?php } ?>
                  <?= $resource->title() ?>
                </div>
              </a>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </aside>
    </div>

    <?php
    // Get the next resource
    $resourcesPage = $site->find('resources');
    if ($resourcesPage) {
      $allResources = $resourcesPage->children()->listed()->sortBy('date', 'desc');
      $nextResource = $allResources->indexOf($page) !== false ? $allResources->nth($allResources->indexOf($page) + 2) : null;

      if ($nextResource):
    ?>
        <div class="mt-16 pt-8 border-t border-black text-right">
          <a href="<?= $nextResource->url() ?>" class="inline-flex items-center gap-2 font-bold hover:underline">
            Next: <?= $nextResource->title()->esc() ?> →
          </a>
        </div>
    <?php endif;
    } ?>

  </div>
</article>

<?php snippet('footer') ?>