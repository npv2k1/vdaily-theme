<?php
/**
 * Code syntax highlighting
 *
 * @package VDaily_Theme
 * @since 1.0.0
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Get supported programming languages
 */
function vdaily_get_supported_languages() {
    $languages = array(
        'javascript', 'js', 'python', 'py', 'php', 'java', 'cpp', 'c++', 'c',
        'ruby', 'go', 'rust', 'typescript', 'ts', 'sql', 'html', 'markup',
        'css', 'scss', 'sass', 'bash', 'shell', 'json', 'yaml', 'xml',
        'swift', 'kotlin', 'csharp', 'cs', 'r', 'perl', 'lua', 'elixir'
    );
    
    return apply_filters('vdaily_syntax_highlighting_languages', $languages);
}

/**
 * Format code blocks in content
 */
function vdaily_format_code_blocks($content) {
    if (!is_singular('post')) {
        return $content;
    }
    
    // Add line numbers class if enabled
    $show_line_numbers = get_option('vdaily_show_line_numbers', false);
    $line_numbers_class = $show_line_numbers ? ' line-numbers' : '';
    
    // Match pre and code tags
    $pattern = '/<pre(?:\s+class=["\']([^"\']*)["\'])?[^>]*><code(?:\s+class=["\']([^"\']*)["\'])?[^>]*>(.*?)<\/code><\/pre>/is';
    
    $content = preg_replace_callback($pattern, function($matches) use ($line_numbers_class) {
        $pre_class = isset($matches[1]) ? $matches[1] : '';
        $code_class = isset($matches[2]) ? $matches[2] : '';
        $code_content = $matches[3];
        
        // Detect language from class
        $language = '';
        if (preg_match('/language-(\w+)/', $code_class, $lang_match)) {
            $language = $lang_match[1];
        } elseif (preg_match('/language-(\w+)/', $pre_class, $lang_match)) {
            $language = $lang_match[1];
        }
        
        // Default to plaintext if no language specified
        if (empty($language)) {
            $language = 'plaintext';
        }
        
        // Build classes
        $classes = array();
        $classes[] = 'language-' . $language;
        if ($line_numbers_class) {
            $classes[] = 'line-numbers';
        }
        
        $classes = apply_filters('vdaily_code_block_classes', $classes, $language, array());
        $class_string = implode(' ', $classes);
        
        // Fire action before code block
        do_action('vdaily_before_code_block', $language, $code_content);
        
        // Build output
        $output = '<div class="code-block-wrapper">';
        $output .= '<pre class="' . esc_attr($class_string) . '">';
        $output .= '<code class="' . esc_attr($class_string) . '">';
        $output .= $code_content;
        $output .= '</code></pre>';
        $output .= '<button class="copy-code-button" aria-label="Copy code" data-code-type="' . esc_attr($language) . '">';
        $output .= '<span class="copy-icon">📋</span>';
        $output .= '<span class="copy-text">Copy</span>';
        $output .= '</button>';
        $output .= '</div>';
        
        // Fire action after code block
        do_action('vdaily_after_code_block', $language, $code_content);
        
        return $output;
    }, $content);
    
    return $content;
}
add_filter('the_content', 'vdaily_format_code_blocks', 20);

/**
 * Add inline code styling
 */
function vdaily_format_inline_code($content) {
    // Ensure inline code has proper class
    $content = preg_replace(
        '/<code(?![^>]*class=)[^>]*>/i',
        '<code class="inline-code">',
        $content
    );
    
    return $content;
}
add_filter('the_content', 'vdaily_format_inline_code', 20);

/**
 * Escape code content for display
 */
function vdaily_escape_code_content($content) {
    // This is handled by WordPress core, but we can add extra safety
    return $content;
}
