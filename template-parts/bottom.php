<?php
require_once get_template_directory() . '/functions.php';
if (file_exists(COMPANY_DATA_PATH)) {
    $json_data = file_get_contents(COMPANY_DATA_PATH);
    $company_data = json_decode($json_data, true);
}
if (file_exists(OFFICES_DATA_PATH)) {
    $json_data = file_get_contents(OFFICES_DATA_PATH);
    $offices_data = json_decode($json_data, true);
}
?>

<section class="bottom bg-dark">
    <article class="container">
        <div class="row">
            <div class="col-lg-3 mb-5 mb-lg-0 bottom-column">
                <?php
                if (function_exists('the_custom_logo')) {
                    $custom_logo_id = get_theme_mod('custom_logo');
                }
                ?>
                <a href="<?php echo esc_url(home_url('/')); ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" alt="Logo de Carlos Bachino">
                </a>
                <p><?php echo esc_html($company_data['slogan']); ?></p>
                <div class="d-flex">
                    <a href="https://web.facebook.com/carlosbachinoagronegocios" target="_blank"><i class="fa-brands me-3 fa-facebook"></i></a>
                    <a href="https://www.instagram.com/carlosbachinoagronegocios" target="_blank"><i class="fa-brands me-3 fa-instagram"></i></a>
                    <a href="https://twitter.com/carlos_bachino" target="_blank"><i class="fa-brands me-3 fa-x-twitter"></i></a>
                </div>
            </div>

            <?php foreach($offices_data as $office) : ?>
                <div class="col-lg-3 mb-5 mb-lg-0 bottom-column">
                    <h4><?= $office['state']; ?></h4>
                    <?php foreach($office['data'] as $data_item) : ?>
                        <a href="<?= $data_item['content'][0]['link']; ?>" target="_blank">
                            <i class="me-3 <?= $data_item['icon']; ?>"></i> <?= $data_item['content'][0]['info']; ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>

        </div>
    </article>
</section>