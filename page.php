<?php
get_header();
?>

<article>
    <?php
    if (have_posts()) {
        while (have_posts()) {
            the_post();

            get_template_part('template-parts/content', 'page');
        }
    }
    ?>

</article>

<?php
get_footer();
?>