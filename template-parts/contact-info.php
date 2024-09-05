<?php
require_once get_template_directory() . '/functions.php';
if (file_exists(OFFICES_DATA_PATH)) {
    $json_data = file_get_contents(OFFICES_DATA_PATH);
    $offices_data = json_decode($json_data, true);
}
?>

<?php foreach ($offices_data as $office) : ?>
    <section class="contact-info <?= $office['bgColorClass']; ?>">
        <article class="container fade-in delay-level3">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2><?= $office['state']; ?></h2>
                        <div class="separator"></div>
                    </div>
                </div>
                <?php foreach ($office['data'] as $data_item) : ?>
                    <div class="col-lg-4">
                        <div class="content-wrapper">
                            <i class="<?= $data_item['icon']; ?>"></i>
                            <p class="description"><?= $data_item['title']; ?></p>
                            <h5>
                                <?php foreach ($data_item['content'] as $content_item) : ?>
                                    <a
                                        href="<?= $content_item['link']; ?>"
                                        target="_blank">
                                        <?= $content_item['info']; ?>
                                    </a>
                                <?php endforeach; ?>
                            </h5>
                        </div>
                    </div>
                <?php endforeach; ?>

                <div class="col-12">
                    <iframe src="<?= $office['iframeMap']; ?>" width="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </article>
    </section>
<?php endforeach; ?>