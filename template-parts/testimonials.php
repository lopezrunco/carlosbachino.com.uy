
<?php
require_once get_template_directory() . '/functions.php';
if (file_exists(TESTIMONIALS_DATA_PATH)) {
    $json_data = file_get_contents(TESTIMONIALS_DATA_PATH);
    $testimonials = json_decode($json_data);

	if ($testimonials !== null) {
?>

		<section class="testimonials bg-primary">
			<div class="paws-overlay">
				<div class="dark-gradient-overlay">
					<div class="container">
						<div class="row">
							<div class="col mb-5">
								<h2>Testimonios</h2>
							</div>
						</div>
						<div class="row">
							<?php foreach ($testimonials as $testimonial) : ?>
								<div class="col-lg-4 mb-5">
									<div class="content-wrapper">
										<div class="image-wrapper">
											<img src="<?php echo esc_url(get_template_directory_uri() . $testimonial->avatarSrc); ?>" alt="<?php echo esc_html($testimonial->name); ?>" />
										</div>
										<p class="testimonial">
											<?php foreach ($testimonial->testimonial as $testimonial_text) : ?>
												<?php echo esc_html($testimonial_text); ?><br>
											<?php endforeach; ?>
										</p>
										<span class="client-name"><?php echo esc_html($testimonial->name); ?></span>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>
		</section>
<?php
	} else {
		echo '<p>No hay testimonios.</p>';
	}
} else {
	echo '<p>Hubo un error al cargar los testimonios.</p>';
}
?>