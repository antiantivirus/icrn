<?php snippet('header') ?>

<div class="pt-40 lg:pt-80 px-4 lg:px-10 pb-20">
  <h1 class="mb-10 blob before:bg-green">
    <?= $page->title() ?>
  </h1>

  <div class="mb-10">
    <!-- Search Bar -->
    <div class="mb-6">
      <input
        type="text"
        id="searchInput"
        name="search"
        placeholder="Search resources..."
        value="<?= esc($searchQuery) ?>"
        class="w-full px-4 py-3 border-2 border-black rounded-none focus:outline-none focus:border-bright-green"
        hx-get="<?= $page->url() ?>"
        hx-trigger="keyup changed delay:500ms"
        hx-target="#resourcesTable"
        hx-select="#resourcesTable"
        hx-swap="outerHTML"
        hx-include="[name='tags']"
        hx-push-url="false">
    </div>

    <!-- Tag Filters -->
    <?php if (!empty($allTags)): ?>
      <div class="mb-6">
        <h3 class="font-bold mb-3">Filter by tags:</h3>
        <div class="flex flex-wrap gap-2">
          <?php
          $selectedTagsArray = !empty($selectedTags) ? array_map('trim', explode(',', $selectedTags)) : [];
          ?>
          <?php foreach ($allTags as $tag): ?>
            <?php $isActive = in_array($tag, $selectedTagsArray); ?>
            <button
              type="button"
              class="tag tag-filter <?= $isActive ? 'active' : '' ?>"
              data-tag="<?= esc($tag) ?>"
              hx-get="<?= $page->url() ?>"
              hx-target="#resourcesTable"
              hx-select="#resourcesTable"
              hx-swap="outerHTML"
              hx-include="#searchInput, [name='tags']"
              hx-push-url="false"
              onclick="toggleTag(this, '<?= esc($tag) ?>')">
              <?= esc($tag) ?>
            </button>
          <?php endforeach; ?>
        </div>
        <input type="hidden" name="tags" id="tagsInput" value="<?= esc($selectedTags) ?>">
      </div>
    <?php endif; ?>
  </div>

  <!-- Resources Table -->
  <div id="resourcesTable">
    <?php if ($resources->isNotEmpty()): ?>
      <div class="overflow-x-auto">
        <table class="w-full border-collapse table-fixed">
          <colgroup>
            <col style="width: 18%;">
            <col>
            <col style="width: 25%;">
          </colgroup>
          <thead>
            <tr class="border-b-2 border-black">
              <th class="text-left p-4 font-bold">Date</th>
              <th class="text-left p-4 font-bold">Title</th>
              <th class="text-left p-4 font-bold">Tags</th>
            </tr>
          </thead>
          <tbody id="resourcesTableBody">
            <?= snippet('resources-table-rows', ['resources' => $resources]) ?>
          </tbody>
        </table>
      </div>

      <?php if ($hasMore): ?>
        <div class="mt-8 text-center">
          <button
            class="px-6 py-3 bg-green border-2 border-black font-bold hover:bg-green transition-colors"
            hx-get="<?= $page->url() ?>?offset=<?= $offset + $limit ?>"
            hx-target="#resourcesTableBody"
            hx-select="#resourcesTableBody > tr"
            hx-swap="beforeend"
            hx-include="#searchInput, [name='tags']"
            hx-push-url="false">
            Load More
          </button>
        </div>
      <?php endif; ?>

      <div class="mt-4 text-sm text-gray-600">
        Showing <?= $resources->count() ?> of <?= $totalCount ?> resources
      </div>
    <?php else: ?>
      <div class="text-center py-20">
        <p class="text-xl">No resources found matching your criteria.</p>
      </div>
    <?php endif; ?>
  </div>
</div>

<script>
  // Tag filtering logic
  let selectedTags = new Set(<?= !empty($selectedTags) ? json_encode($selectedTagsArray) : '[]' ?>);

  function toggleTag(button, tag) {
    if (selectedTags.has(tag)) {
      selectedTags.delete(tag);
      button.classList.remove('active');
    } else {
      selectedTags.add(tag);
      button.classList.add('active');
    }

    // Update hidden input
    document.getElementById('tagsInput').value = Array.from(selectedTags).join(',');
  }

  // Update tag filter buttons after HTMX swap
  document.body.addEventListener('htmx:afterSwap', function(event) {
    if (event.detail.target.id === 'resourcesTable') {
      // Reinitialize selectedTags from the hidden input
      const tagsInput = document.getElementById('tagsInput');
      if (tagsInput && tagsInput.value) {
        selectedTags = new Set(tagsInput.value.split(',').map(t => t.trim()).filter(t => t));
      } else {
        selectedTags = new Set();
      }
    }
  });
</script>

<?php snippet('footer') ?>