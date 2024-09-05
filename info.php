<?php

/**
 * Template Name: Info
 * 
 * @package Carlos Bachino Agronegocios WP Theme
 */

get_header();
?>

<section class="info-page">
    <article class="container">
        <div class="row">
            <div class="col-12 fade-in delay-level3">
                <?php get_template_part('template-parts/venues'); ?>
            </div>
        </div>
    </article>
</section>

<?php
get_footer();
?>