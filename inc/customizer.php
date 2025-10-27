<?php
/**
 * Theme Customizer settings
 *
 * @package VDaily_Theme
 * @since 1.0.0
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register customizer settings
 */
function vdaily_customize_register($wp_customize) {
    
    // Add Design Panel
    $wp_customize->add_panel('vdaily_design_panel', array(
        'title'       => esc_html__('VDaily Design Options', 'vdaily-theme'),
        'description' => esc_html__('Customize the visual design and layout of your tech blog', 'vdaily-theme'),
        'priority'    => 30,
    ));
    
    // Colors Section
    $wp_customize->add_section('vdaily_colors', array(
        'title'    => esc_html__('Color Scheme', 'vdaily-theme'),
        'panel'    => 'vdaily_design_panel',
        'priority' => 10,
    ));
    
    // Primary Color
    $wp_customize->add_setting('vdaily_primary_color', array(
        'default'           => '#1a1a1a',
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vdaily_primary_color', array(
        'label'       => esc_html__('Primary Color', 'vdaily-theme'),
        'description' => esc_html__('Main text color used throughout the theme', 'vdaily-theme'),
        'section'     => 'vdaily_colors',
    )));
    
    // Accent Color
    $wp_customize->add_setting('vdaily_accent_color', array(
        'default'           => '#0066cc',
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vdaily_accent_color', array(
        'label'       => esc_html__('Accent Color', 'vdaily-theme'),
        'description' => esc_html__('Used for links, buttons, and highlights', 'vdaily-theme'),
        'section'     => 'vdaily_colors',
    )));
    
    // Content Width
    $wp_customize->add_section('vdaily_layout', array(
        'title'    => esc_html__('Layout', 'vdaily-theme'),
        'panel'    => 'vdaily_design_panel',
        'priority' => 30,
    ));
    
    $wp_customize->add_setting('vdaily_content_width', array(
        'default'           => 700,
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    ));
    
    $wp_customize->add_control('vdaily_content_width', array(
        'label'       => esc_html__('Content Width', 'vdaily-theme'),
        'description' => esc_html__('Maximum width of article content in pixels', 'vdaily-theme'),
        'section'     => 'vdaily_layout',
        'type'        => 'range',
        'input_attrs' => array(
            'min'  => 600,
            'max'  => 900,
            'step' => 10,
        ),
    ));
    
    // Content Options Section (top-level)
    $wp_customize->add_section('vdaily_content_options', array(
        'title'    => esc_html__('Content Options', 'vdaily-theme'),
        'priority' => 40,
    ));
    
    // Show Reading Time
    $wp_customize->add_setting('vdaily_show_reading_time', array(
        'default'           => true,
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'vdaily_sanitize_checkbox',
    ));
    
    $wp_customize->add_control('vdaily_show_reading_time', array(
        'label'   => esc_html__('Show Reading Time', 'vdaily-theme'),
        'section' => 'vdaily_content_options',
        'type'    => 'checkbox',
    ));
    
    // Show Reading Progress
    $wp_customize->add_setting('vdaily_show_reading_progress', array(
        'default'           => true,
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'vdaily_sanitize_checkbox',
    ));
    
    $wp_customize->add_control('vdaily_show_reading_progress', array(
        'label'   => esc_html__('Show Reading Progress Bar', 'vdaily-theme'),
        'section' => 'vdaily_content_options',
        'type'    => 'checkbox',
    ));
    
    // Related Posts Count
    $wp_customize->add_setting('vdaily_related_posts_count', array(
        'default'           => 5,
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    ));
    
    $wp_customize->add_control('vdaily_related_posts_count', array(
        'label'       => esc_html__('Related Posts Count', 'vdaily-theme'),
        'section'     => 'vdaily_content_options',
        'type'        => 'range',
        'input_attrs' => array(
            'min'  => 3,
            'max'  => 10,
            'step' => 1,
        ),
    ));
    
    // Syntax Theme
    $wp_customize->add_section('vdaily_code_display', array(
        'title'    => esc_html__('Code Display', 'vdaily-theme'),
        'panel'    => 'vdaily_design_panel',
        'priority' => 40,
    ));
    
    $wp_customize->add_setting('vdaily_syntax_theme', array(
        'default'           => 'tomorrow',
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('vdaily_syntax_theme', array(
        'label'   => esc_html__('Syntax Highlighting Theme', 'vdaily-theme'),
        'section' => 'vdaily_code_display',
        'type'    => 'select',
        'choices' => array(
            'tomorrow'          => 'Tomorrow (Light)',
            'tomorrow-night'    => 'Tomorrow Night (Dark)',
            'solarized-light'   => 'Solarized Light',
            'solarized-dark'    => 'Solarized Dark',
            'okaidia'           => 'Okaidia (Dark)',
        ),
    ));
    
    // Show Line Numbers
    $wp_customize->add_setting('vdaily_show_line_numbers', array(
        'default'           => false,
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'vdaily_sanitize_checkbox',
    ));
    
    $wp_customize->add_control('vdaily_show_line_numbers', array(
        'label'   => esc_html__('Show Line Numbers', 'vdaily-theme'),
        'section' => 'vdaily_code_display',
        'type'    => 'checkbox',
    ));
    
    // Social Media Section
    $wp_customize->add_section('vdaily_social_media', array(
        'title'    => esc_html__('Social Media Links', 'vdaily-theme'),
        'priority' => 50,
    ));
    
    // Facebook URL
    $wp_customize->add_setting('vdaily_facebook_url', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('vdaily_facebook_url', array(
        'label'   => esc_html__('Facebook URL', 'vdaily-theme'),
        'section' => 'vdaily_social_media',
        'type'    => 'url',
    ));
    
    // Twitter URL
    $wp_customize->add_setting('vdaily_twitter_url', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('vdaily_twitter_url', array(
        'label'   => esc_html__('Twitter URL', 'vdaily-theme'),
        'section' => 'vdaily_social_media',
        'type'    => 'url',
    ));
    
    // GitHub URL
    $wp_customize->add_setting('vdaily_github_url', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('vdaily_github_url', array(
        'label'   => esc_html__('GitHub URL', 'vdaily-theme'),
        'section' => 'vdaily_social_media',
        'type'    => 'url',
    ));
    
    // YouTube URL
    $wp_customize->add_setting('vdaily_youtube_url', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('vdaily_youtube_url', array(
        'label'   => esc_html__('YouTube URL', 'vdaily-theme'),
        'section' => 'vdaily_social_media',
        'type'    => 'url',
    ));
}

/**
 * Sanitize checkbox values
 */
function vdaily_sanitize_checkbox($value) {
    return (bool) $value;
}

/**
 * Output customizer CSS
 */
function vdaily_customizer_css() {
    $primary_color = get_option('vdaily_primary_color', '#1a1a1a');
    $accent_color = get_option('vdaily_accent_color', '#0066cc');
    $content_width = get_option('vdaily_content_width', 700);
    
    ?>
    <style type="text/css">
        :root {
            --color-primary: <?php echo esc_attr($primary_color); ?>;
            --color-accent: <?php echo esc_attr($accent_color); ?>;
            --content-width: <?php echo esc_attr($content_width); ?>px;
        }
    </style>
    <?php
}
add_action('wp_head', 'vdaily_customizer_css');
