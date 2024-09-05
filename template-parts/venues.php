<?php
require_once get_template_directory() . '/functions.php';
if (file_exists(VENUES_DATA_PATH)) {
    $json_data = file_get_contents(VENUES_DATA_PATH);
    $venues_data = json_decode($json_data, true);
}

$venues = $venues_data['venues'];
$consignee = $venues_data['consignee'];

?>


<div class="venues">
    <div class="box image">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/hereford.jpg" alt="Ganado hereford" ()>
    </div>
    <?php foreach($venues as $venue) : ?>
        <div class="box text thick-border-dark">
            <h2><?= $venue['title']; ?></h2>
            <?php foreach($venue['contactData'] as $contact_data_item) : ?>
                <h5><?= $contact_data_item['tel']; ?></h5>
                <p><?= $contact_data_item['info']; ?></p>
            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>

    <div class="box text dark thick-border-dark">
        <h2><?= $consignee['title']; ?></h2>
        <h5><?= $consignee['tel']; ?></h5>
        <p><?= $consignee['info']; ?></p>
    </div>
</div>