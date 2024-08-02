<div class="hero">
	<div class="gray-overlay">
		<div class="container">
			<div class="content-wrapper fade-in delay-level2">
				<h6 class="subtitle">Bienvenido A Nuestro Sitio Web</h6>
				<h1 class="title">Carlos Bachino Agronegocios</h1>
				<?php
				$contact_page_url = get_permalink(get_page_by_path('contacto'));
				echo '<a class="btn btn-primary" href="' . esc_url($contact_page_url) . '">Contáctenos <i class="fa-solid fa-chevron-right"></i></a>'
				?>
			</div>
			<div class="video-bg">
				<video autoplay muted loop playsinline preload="auto">
					<source src="<?php echo get_template_directory_uri(); ?>/assets/videos/home-video.mp4" type="video/mp4">
				</video>
			</div>
		</div>
	</div>
</div>