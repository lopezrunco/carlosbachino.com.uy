<?php
require_once get_template_directory() . '/functions.php';
if (file_exists(STAFF_DATA_PATH)) {
    $json_data = file_get_contents(STAFF_DATA_PATH);
    $staff_data = json_decode($json_data, true);
}
?>

<section class="staff-grid bg-light">
    <article class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>Nuestro equipo</h2>
                    <p>
                        Estamos orgullosos de contar con un equipo jóven, muy dinámico y muy profesional, con mucha ambición de constante superación.
                    </p>
                    <div class="separator"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-8 offset-lg-2 mb-5">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/staff.jpeg" alt="Nuestro equipo" width="100%" />
            </div>
        </div>
        <div class="row team">
            <?php foreach ($staff_data as $item) { ?>
                <div class="col-lg-4 mb-5">
                    <div class="content-wrapper">
                        <div class="icon-wrapper">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <div class="text-wrapper">
                            <h5><?php echo esc_html($item['name']); ?></h5>
                            <p class="description"><?php echo esc_html($item['description']); ?></p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </article>
</section>