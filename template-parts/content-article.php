<?php
    // Check the category of the actual article.
    // Only show sidebar and agenda section when the article is "inmueble".
    $categories = get_the_category();
    $show_secondary_content = false;

    foreach ($categories as $category) {
        // Check if the category has a parent and if the parent is "inmuebles".
        if ($category->parent != 0) {
            $parent_category = get_category($category->parent);
            if ($parent_category->slug === 'inmuebles') {
                $show_secondary_content = true;
                break; // Exit loop if the parent category is found.
            }
        }
    }
?>

<section>
    <article class="container fade-in delay-level3">
        <div class="row">
            <div class="col-lg-9">
                <?php
                // Check if it's a single blog post page and show content accordingly.
                if (is_single()) :
                ?>
                    <div class="content-header mb-3">

                        <?php if (has_post_thumbnail()) : ?>
                            <div class="full-width-img mb-4">
                                <?php
                                $thumbnail_id = get_post_thumbnail_id();
                                $img_url = wp_get_attachment_image_url($thumbnail_id, 'large');
                                ?>
                                <img class="w-100" src="<?php echo esc_url(($img_url)) ?>" alt="<?php the_title_attribute(); ?>">
                            </div>
                        <?php endif; ?>
                        <div class="meta">
                            <span class="date">
                                <i class="fa-solid fa-calendar-days me-2"></i>
                                <?php echo get_the_date('j \d\e F \d\e Y'); ?>
                            </span>
                            <span class="author">
                                <i class="fa-solid fa-user me-2"></i>
                                <?php the_author(); ?>
                            </span>
                            <div>
                                <?php
                                the_tags(
                                    '<span class="tag"><i class="fa fa-tag me-2"></i> ',
                                    '</span><span class="tag"><i class="fa fa-tag me-2"></i>',
                                    '</span>'
                                );
                                ?>
                            </div>
                            <span class="comment">
                                <a href="#comments"><i class='fa fa-comment me-2'></i>
                                    <?php comments_number(); ?>
                                </a>
                            </span>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="content-body">
                    <?php
                    the_content();

                    // Agenda section (only show in inmuebles articles).
                    if ($show_secondary_content) {
                        $post_title = get_the_title();
                        if ($post_title) {
                            include_once 'agenda.php';
                        }
                    }

                    // Comments section
                    comments_template();
                    ?>
                </div>

            </div>
            <div class="col-lg-3">
                <?php 
                    if ($show_secondary_content) {
                        get_sidebar();
                    }
                ?>
            </div>
        </div>
    </article>
</section>