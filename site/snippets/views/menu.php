<?php $menuItems = $site->mainMenu()->toPages(); ?>

<?php if ($menuItems->isNotEmpty()): ?>
  <!-- Desktop nav -->
  <nav class="hidden md:block">
    <ul class="flex large-text">
      <?php
      $index = 0;
      foreach ($menuItems as $item): ?>
        <li>
          <a class="hover:underline"
            href="<?= $item->url() ?>"><?= $item->title()->html() ?></a><?php if ($index < $menuItems->count() - 1): ?>,&nbsp;<?php endif; ?>
          <?php $index++; ?>
        </li>
      <?php endforeach ?>
    </ul>
  </nav>

  <!-- Mobile Nav -->
  <div class="md:hidden items-end" x-data="{ open: false }">
    <button @click="open = true">
      <!-- Burger menu icon -->
      <svg width="31" height="23" viewBox="0 0 31 23" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M2.41748 1.28787C2.70208 1.28787 2.98669 1.28787 7.3312 1.28787C11.6757 1.28787 20.0715 1.28787 24.5033 1.2523C28.9352 1.21672 29.1486 1.14557 29.5842 1.07227" stroke="black" stroke-width="2" stroke-linecap="round" />
        <path d="M1.771 10.5586H26.566" stroke="black" stroke-width="2" stroke-linecap="round" />
        <path d="M2.41748 21.9851C2.48863 21.9851 2.55978 21.9851 7.00779 21.9851C11.4558 21.9851 20.2785 21.9851 29.3686 21.7695" stroke="black" stroke-width="2" stroke-linecap="round" />
      </svg>
    </button>
    <nav x-show="open" x-trap="open" class="fixed z-100 top-0 left-0 h-screen w-screen bg-blue p-10 py-20">
      <button class="absolute top-2 right-4" @click="open = false">
        <!-- Close icon -->
        <svg width="32" height="25" viewBox="0 0 32 25" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M1.87598 1.40039C1.90746 1.40039 1.93895 1.40039 3.51364 2.73847C5.08833 4.07656 8.20527 6.75272 12.1251 9.70556C16.0449 12.6584 20.6731 15.8068 23.1517 17.5232C26.1635 19.6087 26.552 20.0658 26.9508 20.322C27.3389 20.5713 27.7293 20.9569 28.1906 21.3233C28.589 21.5942 28.8752 21.8165 29.097 22.0383C29.2244 22.1657 29.3818 22.3231 29.544 22.4853" stroke="black" stroke-width="2" stroke-linecap="round" />
          <path d="M30.1164 1.6875C30.0534 1.6875 29.8006 1.78195 29.2148 2.08248C28.8416 2.27398 28.3457 2.60341 25.898 4.6704C23.4503 6.73739 19.074 10.547 16.7251 12.5725C14.2055 14.7452 13.8982 14.9481 13.6921 15.1227C13.2507 15.4967 12.6283 15.8058 11.659 16.5519C10.375 17.5402 8.78151 18.8264 7.90568 19.3201C7.22803 19.7021 6.83903 19.9408 6.45692 20.1163C6.03664 20.3094 5.34686 20.5762 4.74008 20.8633C4.25051 21.095 3.88141 21.3719 3.5785 21.69C3.29381 21.9891 2.83194 22.1351 2.44983 22.3107C2.2595 22.4213 2.06773 22.5492 1.87739 22.6918C1.78151 22.7715 1.68705 22.8659 1.39893 23.1541" stroke="black" stroke-width="2" stroke-linecap="round" />
        </svg>
      </button>

      <ul class="flex flex-col items-end gap-10 text-[3rem]">
        <?php
        foreach ($menuItems as $item): ?>
          <li>
            <a @click="open = false" class="hover:underline"
              href="<?= $item->url() ?>"><?= $item->title()->html() ?></a>
          </li>
        <?php endforeach ?>
      </ul>
    </nav>
  </div>
<?php endif ?>