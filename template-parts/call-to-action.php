<section 
    style="background-image: url('<?php echo get_template_directory_uri() . $cta_bg_image_url; ?>');"
    class="call-to-action"
>
    <article class="gray-overlay">
        <div class="container">
            <div class="content-wrapper">
                <h1><?php echo esc_html($cta_title); ?></h1>
                <h6><?php echo esc_html($cta_subtitle); ?></h6>
                <a class="btn btn-secondary" href="<?php echo esc_url($cta_button_url); ?>">
                    <?php echo esc_html($cta_button_text); ?>
                    <i class="fa-solid <?php echo esc_attr($cta_icon); ?>"></i>
                </a>
            </div>
        </div>
    </article>
</section>