<?php

/**
 * Template Name: Contact
 * 
 * @package Carlos Bachino Agronegocios WP Theme
 */

get_header();
get_template_part('template-parts/contact-info'); 
?>

<section>
    <article class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>Envíenos un mensaje</h2>
                    <div class="separator"></div>
                </div>
            </div>
            <div class="col-lg-7 offset-lg-3 mb-5 mb-lg-0">
                <?php
                // Dev form
                // echo do_shortcode('[contact-form-7 id="64c307e" title="Contact form"]');

                // Prod form
                echo do_shortcode('[contact-form-7 id="63d971a" title="Formulario de contacto"]'); 
                ?>
            </div>
            <div class="col-12">
                <?php get_template_part('template-parts/social-icons'); ?> 
            </div>
        </div>
    </article>
</section>

<?php get_footer();