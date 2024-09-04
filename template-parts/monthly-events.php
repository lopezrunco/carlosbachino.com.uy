<?php
$monthly_events_posts = new WP_Query(
    array(
        'posts_per_page' => 12,
        'post_type' => 'post',
        'category_name' => 'cartelera',
        'orderby' => 'date',
        'order' => 'ASC',
    )
);

if ($monthly_events_posts->have_posts()) : ?>
    <section class="monthly-events bg-primary fade-in delay-level3">
        <article class="container">
            <div class="row">
                <?php
                while ($monthly_events_posts->have_posts()) {
                    $monthly_events_posts->the_post();
                ?>
                    <div class="col-lg-6 mb-5">
                        <div class="post-content">
                            <h3 class="mb-4"><?php the_title(); ?></h3>
                        </div>
                        <?php if (has_post_thumbnail()) { ?>
                            <div class="post-thumbnail">
                                <?php the_post_thumbnail('full'); ?>
                            </div>
                        <?php } ?>
                    </div>
                <?php }
                wp_reset_postdata(); ?>
            </div>
        </article>
    </section>
<?php endif; ?>