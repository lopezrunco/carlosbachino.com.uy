<?php
require_once get_template_directory() . '/functions.php';
if (file_exists(SERVICES_DATA_PATH)) {
    $json_data = file_get_contents(SERVICES_DATA_PATH);
    $services_data = json_decode($json_data, true);
}
?>

<section class="services bg-primary">
    <article class="container">
        <div class="row">
            <?php foreach ($services_data as $service) : ?>
                <div class="col-lg-4 mb-5">
                    <?php if ($service['style'] === 'info') : ?>
                        <div class="content-wrapper thick-border-light p-5">
                            <i class="<?= $service['icon']; ?> icon"></i>
                            <h4><?= $service['title']; ?></h4>
                            <p><?= $service['content']; ?></p>
                        </div>
                    <?php elseif ($service['style'] === 'img') : ?>
                        <div class="image-wrapper">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/<?= $service['imgName']; ?>" alt="<?= $service['alt']; ?>" />
                        </div>
                    <?php endif ?>
                </div>
            <?php endforeach; ?>
        </div>
    </article>
</section>