<?php
require_once get_template_directory() . '/functions.php';
if (file_exists(COMPANY_DATA_PATH)) {
    $json_data = file_get_contents(COMPANY_DATA_PATH);
    $company_data = json_decode($json_data, true);
}
?>

<div class="agenda">
    <h4>¿Interesado?</h4>
    <div class="info">
        <a href="https://api.whatsapp.com/send/?phone=<?= $company_data['whatsappNumber']; ?>&text=Hola%2C+quisiera+agendar+una+visita+a+la+propiedad+<?php echo urlencode($post_title); ?>&type=phone_number&app_absent=0" target="_blank">
            <b><?= $company_data['formattedWhatsappNumber']; ?></b>
        </a>
        <a href="mailto:<?= $company_data['email']; ?>">
            <?= $company_data['email']; ?>
        </a>
    </div>
    <a class="btn btn-primary" href="https://api.whatsapp.com/send/?phone=<?= $company_data['whatsappNumber']; ?>&text=Hola%2C+quisiera+agendar+una+visita+a+la+propiedad+<?php echo urlencode($post_title); ?>&type=phone_number&app_absent=0" target="_blank">
        Agendar una visita.
        <i class="fa-solid fa-calendar-days"></i>
    </a>
</div>