<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= $page->title()->esc() ?> | <?= $site->title()->esc() ?></title>

  <meta name="robots" content="index,follow">
  <meta name="description" content="Independent Community Radio Network. We connect and support radios from across Europe to foster sustainability, cross-regional collaboration, and knowledge-sharing in independent radio and community media.">
  <meta name="thumbnail" content="">
  <meta property="og:site_name" name="og:site_name" content="">
  <meta property="og:type" content="website">
  <meta property="og:url" content="<?php echo $page->url(); ?>">
  <meta property="og:title" content="<?= $page->title()->esc() ?> | <?= $site->title()->esc() ?>">
  <meta property="og:description" content="">
  <meta property="og:image" content="<?= url('/assets/images/icrn-og.jpg') ?>">

  <link rel="shortcut icon" type="image/x-icon" href="<?= url('/assets/favicon.png') ?>">

  <link rel="preload" href="<?= vite()->file('fonts/apfel.woff2') ?>" as="font" type="font/woff2" crossorigin>

  <?= vite()->css('main.css') ?>

  <!-- HTMX -->
  <script src="https://unpkg.com/htmx.org@2.0.2"></script>

  <!-- Alpine.js -->
  <script defer src="https://unpkg.com/@alpinejs/focus@3.14.9/dist/cdn.min.js"></script>
  <script defer src="https://unpkg.com/alpinejs@3.14.9/dist/cdn.min.js"></script>


  <?= vite()->js('main.js') ?>

</head>

<body
  hx-boost="true"
  hx-target="#main"
  hx-select="#main"
  hx-swap="outerHTML"
  hx-ext="preload">
  <!-- Persistent header with player and menu -->
  <header class="fixed top-0 left-0 w-full z-50 mt-2 lg:mt-4">
    <div class="flex justify-between mx-4">
      <div>
        <?= snippet('views/logo') ?>
      </div>
      <div>
        <?= snippet('views/menu') ?>
      </div>
    </div>
    <?= snippet('views/player') ?>
  </header>

  <!-- Main content area that will be swapped -->
  <main id="main">