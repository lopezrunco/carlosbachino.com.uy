<?php
require_once get_template_directory() . '/functions.php';
if (file_exists(SOCIAL_DATA_PATH)) {
    $json_data = file_get_contents(SOCIAL_DATA_PATH);
    $social_data = json_decode($json_data, true);
}
?>

<div class="social-icons">
    <?php foreach ($social_data as $item) : ?>
        <a href="<?= $item['link']; ?>" target="_blank"><i class="<?= $item['icon']; ?>" title="<?= $item['title']; ?>"></i></a>
    <?php endforeach; ?>
</div>