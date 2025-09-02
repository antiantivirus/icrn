  </main>

  <!-- Persistent footer -->
  <footer class="grid grid-cols-2 md:grid-cols-3 justify-between pt-25 padding px-4 lg:px-10 pb-10"
    style="background: linear-gradient(0deg, #F8661B 0%, rgba(248, 102, 27, 0) 100%);">
    <nav class="self-end">
      <ul>
        <?php foreach ($site->children()->listed() as $item): ?>
          <li>
            <a class="hover:underline" href="<?= $item->url() ?>"><?= $item->title()->html() ?></a>
          </li>
        <?php endforeach; ?>
      </ul>
    </nav>
    <img src="/assets/images/full-logo.png" alt="ICRN Logo" class="w-80 mx-auto pb-1">
    <div class="text-right hidden md:block self-end text-tiny">
      <?= $site->legal()->kt() ?>
    </div>
  </footer>
  </body>

  </html>