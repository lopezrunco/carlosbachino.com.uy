<?php
require_once get_template_directory() . '/functions.php';
if (file_exists(COMPANY_DATA_PATH)) {
    $json_data = file_get_contents(COMPANY_DATA_PATH);
    $company_data = json_decode($json_data, true);
}
?>

<section class="company-description">
    <article class="container fade-in delay-level3">
        <div class="row">
            <div class="col-12 col-lg-5">
                <img width="100%" class="box-shadow" src="<?php echo get_template_directory_uri(); ?>/assets/images/carlos bachino local.jpg" alt="Local de Carlos Bachino" />
                <div class="quote">
                    <i class="fa-solid fa-quote-left quotes-icon"></i>
                    <h5>
                        <?php echo esc_html($company_data['slogan']); ?>
                    </h5>
                </div>
            </div>
            <div class="col-12 col-lg-7">
                <h3>Acerca de nosotros</h3>
                <div class="separator ms-0"></div>
                <?php foreach($company_data['about1'] as $pharagraph) { ?>
                    <p><?php echo $pharagraph; ?></p>
                <?php } ?>
            </div>
            <div class="col-12">
                <?php foreach($company_data['about2'] as $pharagraph) { ?>
                    <p><?php echo $pharagraph; ?></p>
                <?php } ?>
            </div>
        </div>
    </article>
</section>