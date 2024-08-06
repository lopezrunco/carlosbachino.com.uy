<?php
require_once get_template_directory() . '/functions.php';
if (file_exists(COMPANY_DATA_PATH)) {
    $json_data = file_get_contents(COMPANY_DATA_PATH);
    $company_data = json_decode($json_data, true);
}
?>

<div class="quick-links">
    <?php
    $market_page = get_page_by_path('mercados');
    $market_page_url = $market_page ? get_permalink($market_page) : '#';
    ?>
    <a href="<?php echo esc_url($market_page_url); ?>" rel="noreferrer" class="acg-link">
        <div class="img-wrapper">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/acg-logo.jpg" alt="ACG" />
        </div>
    </a>

    <a href="<?php echo esc_url($company_data['whatsappLink']); ?>" target="_blank" rel="noreferrer" class="wapp-link">
        <div class="icon-wrapper">
            <i class="<?php echo esc_html($company_data['whatsappIcon']); ?>"></i>
            <span class="active-circle"></span>
            <div class="aditional">
                <span>
                    <div class="text-wrapper">
                        <h5>¿Consultas?</h5>
                        <small>Chatee con nosotros</small>
                    </div>
                </span>
            </div>
        </div>
    </a>
</div>