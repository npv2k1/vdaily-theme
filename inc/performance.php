<?php
/**
 * Performance optimizations
 *
 * @package VDaily_Theme
 * @since 1.0.0
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add lazy loading to images
 */
function vdaily_add_lazy_loading($attr, $attachment, $size) {
    $enable = apply_filters('vdaily_lazy_load_images', true, 'content');
    
    if ($enable && !is_admin()) {
        $attr['loading'] = 'lazy';
    }
    
    return $attr;
}
add_filter('wp_get_attachment_image_attributes', 'vdaily_add_lazy_loading', 10, 3);

/**
 * Add WebP support via picture element
 */
function vdaily_add_webp_support($html, $post_id, $post_thumbnail_id, $size, $attr) {
    if (!get_option('vdaily_webp_images', true)) {
        return $html;
    }
    
    // Get image data
    $image_src = wp_get_attachment_image_src($post_thumbnail_id, $size);
    if (!$image_src) {
        return $html;
    }
    
    $image_url = $image_src[0];
    $webp_url = preg_replace('/\.(jpg|jpeg|png)$/i', '.webp', $image_url);
    
    // Check if WebP file exists (simplified check)
    // In production, you'd want to generate WebP versions
    
    $picture = '<picture>';
    $picture .= '<source srcset="' . esc_url($webp_url) . '" type="image/webp">';
    $picture .= $html;
    $picture .= '</picture>';
    
    return $picture;
}
// Note: This would need proper WebP generation in production
// add_filter('post_thumbnail_html', 'vdaily_add_webp_support', 10, 5);

/**
 * Remove query strings from static resources
 */
function vdaily_remove_query_strings($src) {
    if (strpos($src, '?ver=')) {
        $src = remove_query_arg('ver', $src);
    }
    return $src;
}
add_filter('style_loader_src', 'vdaily_remove_query_strings', 10, 1);
add_filter('script_loader_src', 'vdaily_remove_query_strings', 10, 1);

/**
 * Defer non-critical JavaScript
 */
function vdaily_defer_scripts($tag, $handle, $src) {
    // Skip if in admin
    if (is_admin()) {
        return $tag;
    }
    
    // List of scripts to defer
    $defer_scripts = array(
        'vdaily-main',
        'vdaily-navigation',
        'vdaily-code-copy',
        'vdaily-reading-progress',
    );
    
    if (in_array($handle, $defer_scripts, true)) {
        return str_replace(' src', ' defer src', $tag);
    }
    
    return $tag;
}
add_filter('script_loader_tag', 'vdaily_defer_scripts', 10, 3);

/**
 * Disable emoji scripts and styles
 */
function vdaily_disable_emojis() {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
}
add_action('init', 'vdaily_disable_emojis');

/**
 * Remove unnecessary WordPress features
 */
function vdaily_cleanup_head() {
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wp_shortlink_wp_head');
}
add_action('init', 'vdaily_cleanup_head');

/**
 * Optimize database queries
 */
function vdaily_optimize_queries() {
    // Limit post revisions
    if (!defined('WP_POST_REVISIONS')) {
        define('WP_POST_REVISIONS', 5);
    }
    
    // Set autosave interval to 3 minutes
    if (!defined('AUTOSAVE_INTERVAL')) {
        define('AUTOSAVE_INTERVAL', 180);
    }
}
add_action('init', 'vdaily_optimize_queries');
