<?php $menuItems = $site->mainMenu()->toPages(); ?>

<?php if ($menuItems->isNotEmpty()): ?>
  <nav>
    <ul class="flex">
      <?php foreach ($menuItems as $item): ?>
        <li>
          <a class="hover:underline <?= r($item->isActive(), 'underline') ?>"
            href="<?= $item->url() ?>"><?= $item->title()->html() ?></a>
          <?php if (!$item->isLast()): ?>
            ,&nbsp;
          <?php endif; ?>
        </li>
      <?php endforeach ?>
    </ul>
  </nav>
<?php endif ?>