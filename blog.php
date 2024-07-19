<?php

/**
 * Template Name: Blog
 * 
 * @package Carlos Bachino Agronegocios WP Theme
 */

get_header();

// Include WordPress main file
require_once('wp-load.php');
?>

<section class="latest-posts-by-category">
    <article class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="row">
                    <?php
                    // Set up pagination
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

                    // Get the latest blog posts
                    $args = array(
                        'post_type'      => 'post',
                        'post_status'    => 'publish',
                        'posts_per_page' => 9,
                        'category_name' => 'inmuebles',
                        'paged'          => $paged,
                        'orderby'        => 'date',
                        'order'          => 'DESC'
                    );
                    $query = new WP_Query($args);

                    // Check if there are any posts
                    if ($query->have_posts()) {
                        while ($query->have_posts()) {
                            $query->the_post();
                    ?>
                            <div class="col-lg-6 mb-5">
                                <div class="new-wrapper">

                                    <?php if (has_post_thumbnail()) : ?>
                                        <div class="post-thumbnail">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_post_thumbnail('medium'); ?>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                    <div class="post-content">
                                        <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                        <small class="post-date me-3">
                                            <i class="fa-solid fa-calendar-days me-2"></i>
                                            <?php echo get_the_date('j \d\e F \d\e Y'); ?>
                                        </small>
                                        <small class="post-category me-3">
                                            <i class="fa-regular fa-folder-open me-2"></i>
                                            <?php echo the_category(', '); ?>
                                        </small>
                                        <div class="post-excerpt mt-3">
                                            <?php echo wp_trim_words(get_the_excerpt(), 30, '...'); ?>
                                        </div>
                                        <a href="<?php the_permalink(); ?>">
                                            <small class="my-2">Leer más...</small>
                                        </a>
                                        <div class="tags">
                                            <?php
                                            $tags = get_the_tags();
                                            if ($tags) {
                                                foreach ($tags as $tag) {
                                                    echo '<a href="' . esc_url(get_tag_link($tag->term_id)) . '"><small>' . esc_html($tag->name) . '</small></a> ';
                                                }
                                            }
                                            ?>
                                        </div>

                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                        echo '<div class="pagination">';
                        echo paginate_links(array(
                            'total' => $query->max_num_pages
                        ));
                        echo '</div>';
                    } else {
                        echo 'No se encontraron artículos.';
                    }

                    // Restore original post data
                    wp_reset_postdata();
                    ?>
                </div>

            </div>
            <div class="col-lg-3">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </article>
</section>

<?php get_footer(); ?>