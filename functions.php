<?php
/**
 * VDaily Tech Blog Theme functions and definitions
 *
 * @package VDaily_Theme
 * @since 1.0.0
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Theme version
define('VDAILY_VERSION', '1.0.0');

// Theme directory path
define('VDAILY_DIR', get_template_directory());

// Theme directory URI
define('VDAILY_URI', get_template_directory_uri());

/**
 * Load theme includes
 */
require_once VDAILY_DIR . '/inc/setup.php';
require_once VDAILY_DIR . '/inc/enqueue.php';
require_once VDAILY_DIR . '/inc/template-tags.php';
require_once VDAILY_DIR . '/inc/customizer.php';
require_once VDAILY_DIR . '/inc/seo.php';
require_once VDAILY_DIR . '/inc/performance.php';
require_once VDAILY_DIR . '/inc/accessibility.php';
require_once VDAILY_DIR . '/inc/code-highlighting.php';

/**
 * Theme setup
 */
add_action('after_setup_theme', 'vdaily_setup');

/**
 * Enqueue scripts and styles
 */
add_action('wp_enqueue_scripts', 'vdaily_enqueue_assets');

/**
 * Theme customizer
 */
add_action('customize_register', 'vdaily_customize_register');
