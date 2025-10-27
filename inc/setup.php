<?php
/**
 * Theme setup and configuration
 *
 * @package VDaily_Theme
 * @since 1.0.0
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Set up theme defaults and register support for various WordPress features
 */
function vdaily_setup() {
    
    // Make theme available for translation
    load_theme_textdomain('vdaily-theme', VDAILY_DIR . '/languages');
    
    // Add default posts and comments RSS feed links to head
    add_theme_support('automatic-feed-links');
    
    // Let WordPress manage the document title
    add_theme_support('title-tag');
    
    // Enable support for Post Thumbnails on posts and pages
    add_theme_support('post-thumbnails');
    
    // Set custom image sizes
    add_image_size('vdaily-featured', 1200, 630, true);  // For social sharing
    add_image_size('vdaily-archive', 600, 400, true);    // For archive listings
    add_image_size('vdaily-related', 400, 250, true);    // For related posts
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => esc_html__('Primary Menu', 'vdaily-theme'),
        'footer'  => esc_html__('Footer Menu', 'vdaily-theme'),
    ));
    
    // Switch default core markup to output valid HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));
    
    // Add theme support for selective refresh for widgets
    add_theme_support('customize-selective-refresh-widgets');
    
    // Add support for editor styles
    add_theme_support('editor-styles');
    add_editor_style('assets/css/editor-style.css');
    
    // Add support for responsive embeds
    add_theme_support('responsive-embeds');
    
    // Add support for custom logo
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    
    // Content width
    if (!isset($content_width)) {
        $content_width = get_option('vdaily_content_width', 700);
    }
    
    // Fire custom hook after theme setup
    do_action('vdaily_theme_setup');
}

/**
 * Register widget areas
 */
function vdaily_widgets_init() {
    register_sidebar(array(
        'name'          => esc_html__('Sidebar', 'vdaily-theme'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Add widgets here.', 'vdaily-theme'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
    
    register_sidebar(array(
        'name'          => esc_html__('Footer Widget Area', 'vdaily-theme'),
        'id'            => 'footer-1',
        'description'   => esc_html__('Appears in the footer area.', 'vdaily-theme'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="footer-widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'vdaily_widgets_init');

/**
 * Calculate and save reading time when post is saved
 */
function vdaily_save_reading_time($post_id) {
    // Check if this is an autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    // Check post type
    if (get_post_type($post_id) !== 'post') {
        return;
    }
    
    // Check user permissions
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    // Get post content
    $post = get_post($post_id);
    $content = $post->post_content;
    
    // Strip HTML and shortcodes
    $content = strip_tags(strip_shortcodes($content));
    
    // Count words
    $word_count = str_word_count($content);
    
    // Calculate reading time (200 words per minute default)
    $wpm = apply_filters('vdaily_reading_time_wpm', 200);
    $reading_time = max(1, ceil($word_count / $wpm));
    
    // Count code blocks
    $code_blocks = substr_count($post->post_content, '<pre');
    
    // Save meta data
    update_post_meta($post_id, '_vdaily_reading_time', $reading_time);
    update_post_meta($post_id, '_vdaily_code_blocks_count', $code_blocks);
}
add_action('save_post', 'vdaily_save_reading_time');
