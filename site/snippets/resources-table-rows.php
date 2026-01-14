<?php foreach ($resources as $resource): ?>
  <tr class="border-b border-black hover:bg-bright-green transition-colors">
    <td class="p-4">
      <?php if ($resource->date()->isNotEmpty()): ?>
        <?= $resource->date()->toDate('M d, Y') ?>
      <?php else: ?>
        <?= $resource->published()->toDate('M d, Y') ?>
      <?php endif; ?>
    </td>
    <td class="p-4">
      <a href="<?= $resource->url() ?>" class="font-bold hover:underline flex items-center gap-2">
        <?php if ($resource->color()->isNotEmpty()): ?>
          <div class="w-3 h-3 rounded-full flex-shrink-0" style="background: <?= $resource->color() ?>"></div>
        <?php endif; ?>
        <?= $resource->title()->esc() ?>
      </a>
    </td>
    <td class="p-4">
      <?php if ($resource->tags()->isNotEmpty()): ?>
        <div class="flex flex-wrap gap-2">
          <?php
          $tags = $resource->tags()->split(',');
          foreach ($tags as $tag):
            $tag = trim($tag);
          ?>
            <button
              type="button"
              class="tag tag-inline !bg-white"
              data-tag="<?= esc($tag) ?>"
              hx-get="<?= $page->url() ?>?tags=<?= urlencode($tag) ?>"
              hx-target="#resourcesTable"
              hx-select="#resourcesTable"
              hx-swap="outerHTML"
              hx-push-url="false"
              onclick="filterByTag('<?= esc($tag) ?>')">
              <?= esc($tag) ?>
            </button>
          <?php endforeach; ?>
        </div>
      <?php else: ?>
        —
      <?php endif; ?>
    </td>
  </tr>
<?php endforeach; ?>

<script>
  // Handle clicking tags in the table
  function filterByTag(tag) {
    // Add tag to filter
    const tagsInput = document.getElementById('tagsInput');
    const currentTags = new Set(tagsInput.value ? tagsInput.value.split(',').map(t => t.trim()).filter(t => t) : []);
    currentTags.add(tag);
    tagsInput.value = Array.from(currentTags).join(',');

    // Update tag filter buttons
    document.querySelectorAll('.tag-filter').forEach(button => {
      if (button.dataset.tag === tag) {
        button.classList.add('active');
      }
    });
  }
</script>