<?php $menuItems = $site->mainMenu()->toPages(); ?>

<?php if ($menuItems->isNotEmpty()): ?>
  <nav class="mx-4">
    <ul class="flex large-text">
      <?php
      $index = 0;
      foreach ($menuItems as $item): ?>
        <li>
          <a class="hover:underline"
            href="<?= $item->url() ?>"
            hx-get="<?= $item->url() ?>"
            hx-target="#main-content"
            hx-push-url="true"><?= $item->title()->html() ?></a><?php if ($index < $menuItems->count() - 1): ?>,&nbsp;<?php endif; ?>
          <?php $index++; ?>
        </li>
      <?php endforeach ?>
    </ul>
  </nav>
<?php endif ?>