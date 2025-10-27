<?php
/**
 * Custom template tags for this theme
 *
 * @package VDaily_Theme
 * @since 1.0.0
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Display formatted post date
 */
function vdaily_posted_on() {
    $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
    
    $time_string = sprintf(
        $time_string,
        esc_attr(get_the_date('c')),
        esc_html(get_the_date())
    );
    
    echo $time_string;
}

/**
 * Display formatted author link
 */
function vdaily_posted_by() {
    echo '<span class="author vcard">';
    echo '<a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">';
    echo esc_html(get_the_author());
    echo '</a>';
    echo '</span>';
}

/**
 * Display reading time
 */
function vdaily_reading_time() {
    $reading_time = get_post_meta(get_the_ID(), '_vdaily_reading_time', true);
    
    if (!$reading_time) {
        // Calculate on the fly if not saved
        $content = get_post_field('post_content', get_the_ID());
        $word_count = str_word_count(strip_tags(strip_shortcodes($content)));
        $wpm = apply_filters('vdaily_reading_time_wpm', 200);
        $reading_time = max(1, ceil($word_count / $wpm));
    }
    
    printf(
        '<span class="reading-time">%d %s</span>',
        (int) $reading_time,
        esc_html(_n('min read', 'min read', $reading_time, 'vdaily-theme'))
    );
}

/**
 * Generate custom excerpt
 */
function vdaily_custom_excerpt($length = null) {
    if ($length === null) {
        $length = apply_filters('vdaily_post_excerpt_length', 160);
    }
    
    $excerpt = get_the_excerpt();
    
    if (mb_strlen($excerpt) > $length) {
        $excerpt = mb_substr($excerpt, 0, $length) . '...';
    }
    
    return wp_kses_post($excerpt);
}

/**
 * Get related posts based on categories and tags
 */
function vdaily_get_related_posts($post_id = null, $count = null) {
    if ($post_id === null) {
        $post_id = get_the_ID();
    }
    
    if ($count === null) {
        $count = apply_filters('vdaily_related_posts_count', 5);
    }
    
    // Check cache
    $cache_key = 'vdaily_related_' . $post_id;
    $related_posts = get_transient($cache_key);
    
    if (false !== $related_posts) {
        return array_slice($related_posts, 0, $count);
    }
    
    // Get current post categories and tags
    $categories = wp_get_post_categories($post_id);
    $tags = wp_get_post_tags($post_id, array('fields' => 'ids'));
    
    // Build query args
    $args = array(
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => $count,
        'post__not_in'   => array($post_id),
        'orderby'        => 'date',
        'order'          => 'DESC',
    );
    
    // Add tax query if we have categories or tags
    if (!empty($categories) || !empty($tags)) {
        $tax_query = array('relation' => 'OR');
        
        if (!empty($categories)) {
            $tax_query[] = array(
                'taxonomy' => 'category',
                'field'    => 'term_id',
                'terms'    => $categories,
            );
        }
        
        if (!empty($tags)) {
            $tax_query[] = array(
                'taxonomy' => 'post_tag',
                'field'    => 'term_id',
                'terms'    => $tags,
            );
        }
        
        $args['tax_query'] = $tax_query;
    }
    
    // Allow filtering of args
    $args = apply_filters('vdaily_related_posts_args', $args, $post_id);
    
    // Run query
    $query = new WP_Query($args);
    $related_posts = $query->posts;
    
    // Cache for 12 hours
    set_transient($cache_key, $related_posts, 12 * HOUR_IN_SECONDS);
    
    return $related_posts;
}

/**
 * Invalidate related posts cache when post is updated
 */
function vdaily_invalidate_related_posts_cache($post_id) {
    delete_transient('vdaily_related_' . $post_id);
    
    // Also invalidate cache for related posts
    $related_posts = get_posts(array(
        'post_type'      => 'post',
        'posts_per_page' => 100,
        'fields'         => 'ids',
    ));
    
    foreach ($related_posts as $related_id) {
        delete_transient('vdaily_related_' . $related_id);
    }
}
add_action('save_post', 'vdaily_invalidate_related_posts_cache');
add_action('delete_post', 'vdaily_invalidate_related_posts_cache');

/**
 * Highlight search terms in content
 */
function vdaily_highlight_search_terms($text) {
    if (!is_search()) {
        return $text;
    }
    
    $search_query = get_search_query();
    
    if (empty($search_query)) {
        return $text;
    }
    
    $keys = array_map('trim', explode(' ', $search_query));
    $pattern = '/(' . implode('|', array_map('preg_quote', $keys)) . ')/i';
    
    return preg_replace($pattern, '<mark class="search-highlight">$1</mark>', $text);
}

/**
 * Fallback for primary navigation menu
 */
function vdaily_nav_fallback() {
    echo '<ul class="nav-menu">';
    wp_list_pages(array(
        'title_li' => '',
        'depth'    => 1,
    ));
    echo '</ul>';
}
