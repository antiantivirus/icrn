<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= $site->title()->esc() ?> | <?= $page->title()->esc() ?></title>

  <meta name="robots" content="index,follow">
  <meta name="description" content="">
  <meta name="thumbnail" content="">
  <meta property="og:site_name" name="og:site_name" content="">
  <meta property="og:type" content="website">
  <meta property="og:url" content="<?php echo $page->url(); ?>">
  <meta property="og:title" content="<?= $site->title()->esc() ?> | <?= $page->title()->esc() ?>">
  <meta property="og:description" content="">
  <meta property="og:image" content="">

  <link rel="shortcut icon" type="image/x-icon" href="<?= url('favicon.ico') ?>">

  <link rel="preload" href="<?= vite()->file('fonts/apfel.woff2') ?>" as="font" type="font/woff2" crossorigin>

  <?= vite()->css('main.css') ?>

  <!-- HTMX -->
  <script src="https://unpkg.com/htmx.org@2.0.2"></script>

  <!-- Alpine.js -->
  <script defer src="https://unpkg.com/@alpinejs/focus@3.14.9/dist/cdn.min.js"></script>
  <script defer src="https://unpkg.com/alpinejs@3.14.9/dist/cdn.min.js"></script>

  <?= vite()->js('main.js') ?>

</head>

<body>
  <!-- Persistent header with player and menu -->
  <header class="fixed top-0 left-0 w-full z-50 mt-4">
    <div class="flex justify-between mx-4">
      <div>
        <?php if (!$page->isHomePage()): ?>
          <a href="<?= $site->url() ?>" hx-get="<?= $site->url() ?>" hx-target="#main-content" hx-push-url="true">
            <img src="/assets/images/icrn-dots-logo.svg" alt="Home">
          </a>
        <?php endif; ?>
      </div>
      <?= snippet('views/menu') ?>
    </div>
    <?= snippet('views/player') ?>
  </header>

  <!-- Main content area that will be swapped -->
  <main id="main-content">