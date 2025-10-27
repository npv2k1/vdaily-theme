<?php
/**
 * Enqueue scripts and styles
 *
 * @package VDaily_Theme
 * @since 1.0.0
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Enqueue theme styles and scripts
 */
function vdaily_enqueue_assets() {
    
    // Main stylesheet
    wp_enqueue_style(
        'vdaily-style',
        VDAILY_URI . '/assets/css/main.css',
        array(),
        VDAILY_VERSION
    );
    
    // Print stylesheet
    wp_enqueue_style(
        'vdaily-print',
        VDAILY_URI . '/assets/css/print.css',
        array(),
        VDAILY_VERSION,
        'print'
    );
    
    // Syntax highlighting (Prism.js)
    $syntax_theme = get_option('vdaily_syntax_theme', 'tomorrow');
    wp_enqueue_style(
        'prism-theme',
        'https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-' . $syntax_theme . '.min.css',
        array(),
        '1.29.0'
    );
    
    // Main JavaScript
    wp_enqueue_script(
        'vdaily-main',
        VDAILY_URI . '/assets/js/main.js',
        array(),
        VDAILY_VERSION,
        true
    );
    
    // Navigation script (for mobile menu)
    wp_enqueue_script(
        'vdaily-navigation',
        VDAILY_URI . '/assets/js/navigation.js',
        array(),
        VDAILY_VERSION,
        true
    );
    
    // Code copy functionality
    if (is_single()) {
        wp_enqueue_script(
            'vdaily-code-copy',
            VDAILY_URI . '/assets/js/code-copy.js',
            array(),
            VDAILY_VERSION,
            true
        );
        
        // Reading progress indicator
        if (get_option('vdaily_show_reading_progress', true)) {
            wp_enqueue_script(
                'vdaily-reading-progress',
                VDAILY_URI . '/assets/js/reading-progress.js',
                array(),
                VDAILY_VERSION,
                true
            );
        }
    }
    
    // Prism.js for syntax highlighting
    wp_enqueue_script(
        'prism',
        'https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/prism.min.js',
        array(),
        '1.29.0',
        true
    );
    
    // Prism.js language components (load common languages)
    $languages = array('javascript', 'python', 'php', 'java', 'css', 'markup', 'bash', 'typescript');
    foreach ($languages as $lang) {
        wp_enqueue_script(
            'prism-' . $lang,
            'https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-' . $lang . '.min.js',
            array('prism'),
            '1.29.0',
            true
        );
    }
    
    // Line numbers plugin for Prism
    if (get_option('vdaily_show_line_numbers', false)) {
        wp_enqueue_style(
            'prism-line-numbers',
            'https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/plugins/line-numbers/prism-line-numbers.min.css',
            array('prism-theme'),
            '1.29.0'
        );
        
        wp_enqueue_script(
            'prism-line-numbers',
            'https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/plugins/line-numbers/prism-line-numbers.min.js',
            array('prism'),
            '1.29.0',
            true
        );
    }
    
    // Comment reply script
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
    
    // Fire custom hook after scripts are enqueued
    do_action('vdaily_enqueue_scripts');
}
