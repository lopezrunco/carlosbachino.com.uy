<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <!-- Meta -->
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Carlos Bachino Agronegocios WP Theme">
    <meta name="author" content="Damian Lopez runco">
    <link rel="shortcut icon" href="wp-content/themes/carlosbachino/assets/images/favicon.png" type="image/x-icon">
    <!-- FontAwesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <?php wp_head(); ?>
</head>

<body>
    <header class="fixed-top">
        <nav class="navbar navbar-expand-xl bg-dark py-lg-0">
            <div class="container fade-in delay-level1">
                <a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>">
                    <img class="main-logo" alt="Logo de Carlos Bachino" src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" />
                </a>
                <button class="navbar-toggler navbar-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa-solid fa-bars menu-icon"></i>
                </button>
                <div class="collapse navbar-collapse py-3 justify-content-end" id="navbarSupportedContent">
                    <?php
                    // Main menu
                    wp_nav_menu(array(
                        'menu' => 'primary',
                        'container' => '',
                        'theme_location' => 'primary',
                        'items_wrap' => '<ul class="navbar-nav mb-2 mb-lg-0">%3$s</ul>',
                        'fallback_cb' => false
                    ));
                    ?>
                </div>
            </div>
        </nav>
    </header>

    <div class="main-wrapper">
        <?php if (!is_front_page() && !is_404()) {

            $breadcrumb = '';
            $page_title = '';

            if (is_search()) {
                $breadcrumb = sprintf('Resultados: %s', get_search_query());
                $page_title = $breadcrumb;
            } elseif (is_archive()) {
                ob_start();
                the_archive_title();
                $breadcrumb = ob_get_clean();
                $page_title = $breadcrumb;
            } elseif (is_single()) {
                $page_title = get_the_title();
                $breadcrumb = $page_title;
            } elseif (is_page()) {
                $page_title = get_the_title();
                $breadcrumb = $page_title;
            } else {
                $page_title = get_the_title();
                $breadcrumb = $page_title;
            }

            include get_template_directory() . '/template-parts/page-title.php';
        } ?>