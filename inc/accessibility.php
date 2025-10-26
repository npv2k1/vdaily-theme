<?php
/**
 * Accessibility features
 *
 * @package VDaily_Theme
 * @since 1.0.0
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add skip to content link
 */
function vdaily_skip_link() {
    $text = apply_filters('vdaily_skip_link_text', esc_html__('Skip to content', 'vdaily-theme'));
    echo '<a class="skip-link screen-reader-text" href="#primary">' . $text . '</a>';
}

/**
 * Add ARIA labels to navigation
 */
function vdaily_nav_menu_args($args) {
    if (isset($args['theme_location'])) {
        $location = $args['theme_location'];
        $label = apply_filters('vdaily_aria_label', ucfirst($location) . ' Navigation', 'menu');
        $args['container_aria_label'] = $label;
    }
    return $args;
}
add_filter('wp_nav_menu_args', 'vdaily_nav_menu_args');

/**
 * Ensure all images have alt text
 */
function vdaily_image_alt_check($content) {
    if (is_admin()) {
        return $content;
    }
    
    // Find images without alt attribute
    $pattern = '/<img(?![^>]*alt=)[^>]*>/i';
    
    if (preg_match($pattern, $content)) {
        // Add empty alt attribute for decorative images
        $content = preg_replace(
            '/<img(?![^>]*alt=)([^>]*)>/i',
            '<img$1 alt="">',
            $content
        );
    }
    
    return $content;
}
add_filter('the_content', 'vdaily_image_alt_check');

/**
 * Add keyboard navigation support
 */
function vdaily_keyboard_navigation() {
    ?>
    <script>
    document.addEventListener('keydown', function(e) {
        // Tab key navigation enhancement
        if (e.key === 'Tab') {
            document.body.classList.add('keyboard-navigation');
        }
    });
    
    document.addEventListener('mousedown', function() {
        document.body.classList.remove('keyboard-navigation');
    });
    </script>
    <?php
}
add_action('wp_footer', 'vdaily_keyboard_navigation');

/**
 * Add focus styles for keyboard navigation
 */
function vdaily_focus_styles() {
    ?>
    <style>
    .keyboard-navigation *:focus {
        outline: 2px solid var(--color-accent, #0066cc);
        outline-offset: 2px;
    }
    
    .skip-link {
        position: absolute;
        top: -100%;
        left: 0;
        background: var(--color-accent, #0066cc);
        color: #fff;
        padding: 0.5rem 1rem;
        text-decoration: none;
        z-index: 999;
    }
    
    .skip-link:focus {
        top: 0;
    }
    
    .screen-reader-text {
        border: 0;
        clip: rect(1px, 1px, 1px, 1px);
        clip-path: inset(50%);
        height: 1px;
        margin: -1px;
        overflow: hidden;
        padding: 0;
        position: absolute;
        width: 1px;
        word-wrap: normal !important;
    }
    
    .screen-reader-text:focus {
        background-color: #f1f1f1;
        border-radius: 3px;
        box-shadow: 0 0 2px 2px rgba(0, 0, 0, 0.6);
        clip: auto !important;
        clip-path: none;
        color: #21759b;
        display: block;
        font-size: 0.875rem;
        font-weight: 700;
        height: auto;
        left: 5px;
        line-height: normal;
        padding: 15px 23px 14px;
        text-decoration: none;
        top: 5px;
        width: auto;
        z-index: 100000;
    }
    </style>
    <?php
}
add_action('wp_head', 'vdaily_focus_styles');

/**
 * Add ARIA live regions for dynamic content
 */
function vdaily_aria_live_regions() {
    if (!is_singular('post')) {
        return;
    }
    ?>
    <div class="sr-only" aria-live="polite" aria-atomic="true" id="reading-progress-announce"></div>
    <?php
}
add_action('wp_footer', 'vdaily_aria_live_regions');
