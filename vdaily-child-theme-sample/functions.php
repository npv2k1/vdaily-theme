<?php
/**
 * VDaily Child Theme Functions
 *
 * This file is loaded after the parent theme's functions.php
 * Use it to add custom functionality or override parent theme functions
 *
 * @package VDaily_Child_Theme
 * @since 1.0.0
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Enqueue child theme styles
 *
 * This function properly loads the parent theme styles followed by the child theme styles
 */
function vdaily_child_enqueue_styles() {
    // Get parent theme version
    $parent_theme = wp_get_theme(get_template());
    $parent_version = $parent_theme->get('Version');
    
    // Enqueue parent theme stylesheet
    wp_enqueue_style(
        'vdaily-parent-style',
        get_template_directory_uri() . '/assets/css/main.css',
        array(),
        $parent_version
    );
    
    // Enqueue child theme stylesheet (loads after parent)
    wp_enqueue_style(
        'vdaily-child-style',
        get_stylesheet_uri(),
        array('vdaily-parent-style'),
        wp_get_theme()->get('Version')
    );
}
add_action('wp_enqueue_scripts', 'vdaily_child_enqueue_styles', 15);

/**
 * Example: Customize excerpt length
 *
 * Uncomment to change the default excerpt length
 */
/*
function vdaily_child_excerpt_length($length) {
    return 30; // Change to desired word count
}
add_filter('vdaily_post_excerpt_length', 'vdaily_child_excerpt_length');
*/

/**
 * Example: Customize reading time calculation
 *
 * Uncomment to change words per minute for reading time
 */
/*
function vdaily_child_reading_time_wpm($wpm) {
    return 250; // Change to desired words per minute
}
add_filter('vdaily_reading_time_wpm', 'vdaily_child_reading_time_wpm');
*/

/**
 * Example: Add custom header code
 *
 * Uncomment to add custom code to the header
 */
/*
function vdaily_child_custom_header() {
    ?>
    <!-- Add your custom header code here -->
    <?php
}
add_action('wp_head', 'vdaily_child_custom_header');
*/

/**
 * Example: Customize related posts count
 *
 * Uncomment to change the number of related posts shown
 */
/*
function vdaily_child_related_posts_count($count) {
    return 6; // Change to desired number of related posts
}
add_filter('vdaily_related_posts_count', 'vdaily_child_related_posts_count');
*/

/**
 * Example: Add custom functionality after theme setup
 *
 * Uncomment to add custom theme features
 */
/*
function vdaily_child_custom_setup() {
    // Add custom image sizes
    add_image_size('vdaily-child-custom', 800, 600, true);
    
    // Register additional navigation menus
    register_nav_menus(array(
        'footer-menu' => esc_html__('Footer Menu', 'vdaily-child-theme'),
    ));
}
add_action('vdaily_theme_setup', 'vdaily_child_custom_setup');
*/

// Add your custom functions below this line
