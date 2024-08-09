<?php

// Define path constants.
define('STAFF_DATA_PATH', get_template_directory() . '/data/staff.json');
define('COMPANY_DATA_PATH', get_template_directory() . '/data/company.json');

function starterwptheme_theme_support()
{
    add_theme_support('title-tag');
    add_theme_support('custom-logo');
    add_theme_support('post-thumbnails');
}

add_action('after_setup_theme', 'starterwptheme_theme_support');

function starterwptheme_menus()
{
    $locations = array(
        'primary' => "Desktop Primary Left Sidebar",
        'footer' => "Footer Menu Items"
    );
    register_nav_menus($locations);
}

add_action('init', 'starterwptheme_menus');

function starterwptheme_register_styles()
{
    $version = wp_get_theme()->get('Version');
    wp_enqueue_style('starterwptheme-style', get_template_directory_uri() . "/style.css", array('starterwptheme-bootstrap'), $version, 'all');
    wp_enqueue_style('starterwptheme-bootstrap', "https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css", array(), '4.4.1', 'all');
    wp_enqueue_style('starterwptheme-fontawesome', "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css", array(), '5.13.0', 'all');
}

add_action('wp_enqueue_scripts', 'starterwptheme_register_styles');

function starterwptheme_register_scripts()
{
    $version = wp_get_theme()->get('Version');
    wp_enqueue_script('starterwptheme-jquery', 'https://code.jquery.com/jquery-3.4.1.slim.min.js', array(), '3.4.1', true);
    wp_enqueue_script('starterwptheme-popper', 'https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js', array(), '1.16.0', true);
    wp_enqueue_script('starterwptheme-bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js', array(), '4.4.1', true);
    wp_enqueue_script('starterwptheme-main', get_template_directory_uri() . "/assets/js/main.js", array(), $version, true);
}

add_action('wp_enqueue_scripts', 'starterwptheme_register_scripts');

function starterwptheme_widget_areas()
{
    register_sidebar(
        array(
            'before_title' => '',
            'after_title' => '',
            'before_widget' => '',
            'after_widget' => '',
            'name' => 'Sidebar Area',
            'id' => 'sidebar-1',
            'description' => 'Sidebar Widget Area',
        )
    );

    register_sidebar(
        array(
            'before_title' => '',
            'after_title' => '',
            'before_widget' => '',
            'after_widget' => '',
            'name' => 'Footer Area',
            'id' => 'footer-1',
            'description' => 'Footer Widget Area',
        )
    );
}

add_action('widgets_init', 'starterwptheme_widget_areas');

function delete_expired_auction_posts_schedule() {
    // Execute the delete posts function daily.
    if (!wp_next_scheduled('delete_expired_auction_posts')) {
        wp_schedule_event(time(), 'daily', 'delete_expired_auction_posts');
    }
}
add_action('init', 'delete_expired_auction_posts_schedule');

function delete_expired_auction_posts() {
    $category_slug = 'remates';

    $args = array (
        'post_type' => 'post',
        'category_name' => $category_slug,
        'meta_key' => 'fin_del_remate' // Use this meta key to delete the post.
    );

    $query = new WP_Query( $args );

    if ( $query->have_posts() ) {
        $current_time = current_time('Y-m-d H:i:s'); // Using Wordpress settings timezone (Montevideo, Uruguay).

        while ($query->have_posts()) {
            $query->the_post();
            $end_date = get_post_meta( get_the_ID(), 'fin_del_remate', true );

            // Move to trash if the auction finish time has passed.
            if (strtotime($end_date) < strtotime($current_time)) {
                wp_trash_post( get_the_ID() );
            }
        }
    }
    wp_reset_postdata();
}
