<?php
/**
 * SEO meta tags and structured data
 *
 * @package VDaily_Theme
 * @since 1.0.0
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Output SEO meta tags
 */
function vdaily_output_meta_tags() {
    if (!is_singular('post')) {
        return;
    }
    
    global $post;
    
    // Meta description
    $description = vdaily_custom_excerpt(160);
    $description = apply_filters('vdaily_meta_description', $description, $post->ID);
    
    echo '<meta name="description" content="' . esc_attr($description) . '">' . "\n";
    
    // Open Graph tags
    vdaily_output_open_graph();
    
    // Schema.org structured data
    vdaily_output_schema_org();
}
add_action('wp_head', 'vdaily_output_meta_tags');

/**
 * Output Open Graph meta tags
 */
function vdaily_output_open_graph() {
    if (!is_singular('post')) {
        return;
    }
    
    global $post;
    
    $og_title = get_the_title();
    $og_description = vdaily_custom_excerpt(160);
    $og_url = get_permalink();
    $og_type = 'article';
    
    // Featured image
    $og_image = '';
    if (has_post_thumbnail()) {
        $image_id = get_post_thumbnail_id();
        $image_data = wp_get_attachment_image_src($image_id, 'vdaily-featured');
        if ($image_data) {
            $og_image = $image_data[0];
        }
    }
    
    $og_image = apply_filters('vdaily_open_graph_image', $og_image, $post->ID);
    
    ?>
    <meta property="og:title" content="<?php echo esc_attr($og_title); ?>" />
    <meta property="og:description" content="<?php echo esc_attr($og_description); ?>" />
    <meta property="og:url" content="<?php echo esc_url($og_url); ?>" />
    <meta property="og:type" content="<?php echo esc_attr($og_type); ?>" />
    <?php if ($og_image) : ?>
    <meta property="og:image" content="<?php echo esc_url($og_image); ?>" />
    <?php endif; ?>
    <meta property="og:site_name" content="<?php echo esc_attr(get_bloginfo('name')); ?>" />
    
    <!-- Twitter Card tags -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="<?php echo esc_attr($og_title); ?>" />
    <meta name="twitter:description" content="<?php echo esc_attr($og_description); ?>" />
    <?php if ($og_image) : ?>
    <meta name="twitter:image" content="<?php echo esc_url($og_image); ?>" />
    <?php endif; ?>
    <?php
}

/**
 * Output Schema.org structured data
 */
function vdaily_output_schema_org() {
    if (!is_singular('post')) {
        return;
    }
    
    global $post;
    
    $author = get_the_author_meta('display_name', $post->post_author);
    $author_url = get_author_posts_url($post->post_author);
    
    // Build schema array
    $schema = array(
        '@context'      => 'https://schema.org',
        '@type'         => 'Article',
        'headline'      => get_the_title(),
        'description'   => vdaily_custom_excerpt(160),
        'datePublished' => get_the_date('c'),
        'dateModified'  => get_the_modified_date('c'),
        'author'        => array(
            '@type' => 'Person',
            'name'  => $author,
            'url'   => $author_url,
        ),
        'publisher'     => array(
            '@type' => 'Organization',
            'name'  => get_bloginfo('name'),
            'logo'  => array(
                '@type' => 'ImageObject',
                'url'   => get_site_icon_url(),
            ),
        ),
    );
    
    // Add featured image
    if (has_post_thumbnail()) {
        $image_id = get_post_thumbnail_id();
        $image_data = wp_get_attachment_image_src($image_id, 'vdaily-featured');
        if ($image_data) {
            $schema['image'] = array(
                '@type'  => 'ImageObject',
                'url'    => $image_data[0],
                'width'  => $image_data[1],
                'height' => $image_data[2],
            );
        }
    }
    
    // Allow filtering
    $schema = apply_filters('vdaily_schema_article', $schema, $post->ID);
    
    echo '<script type="application/ld+json">' . "\n";
    echo wp_json_encode($schema, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    echo "\n" . '</script>' . "\n";
}

/**
 * Add canonical link
 */
function vdaily_add_canonical() {
    if (is_singular()) {
        echo '<link rel="canonical" href="' . esc_url(get_permalink()) . '" />' . "\n";
    }
}
add_action('wp_head', 'vdaily_add_canonical');
