<?php

/**
 * Template Name: Market
 * 
 * @package Carlos Bachino Agronegocios WP Theme
 */

get_header();
?>
<section>
    <article class="container">
        <?php
        if (have_posts()) {
            while (have_posts()) {
                the_post();
                get_template_part('template-parts/content', 'page');
            }
        }
        ?>
    </article>
</section>

<?php get_footer(); ?>