<?php
// Check if this is an HTMX request (partial page load)
$isHtmxRequest = isset($_SERVER['HTTP_HX_REQUEST']);

if (!$isHtmxRequest) {
  // Full page load - include header
  snippet('header');
}
?>

<h1><?= $page->title() ?></h1>

<?php
if (!$isHtmxRequest) {
  // Full page load - include footer
  snippet('footer');
}
?>