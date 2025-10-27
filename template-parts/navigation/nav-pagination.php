<?php
/**
 * Template part for pagination
 *
 * @package VDaily_Theme
 * @since 1.0.0
 */

if (!$GLOBALS['wp_query']->max_num_pages || $GLOBALS['wp_query']->max_num_pages < 2) {
    return;
}
?>

<nav class="pagination" role="navigation" aria-label="<?php esc_attr_e('Posts Navigation', 'vdaily-theme'); ?>">
    <?php
    the_posts_pagination(array(
        'mid_size'           => 2,
        'prev_text'          => __('← Previous', 'vdaily-theme'),
        'next_text'          => __('Next →', 'vdaily-theme'),
        'screen_reader_text' => __('Posts navigation', 'vdaily-theme'),
    ));
    ?>
</nav><!-- .pagination -->
