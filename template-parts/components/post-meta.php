<?php
/**
 * Template part for post metadata
 *
 * @package VDaily_Theme
 * @since 1.0.0
 */
?>

<div class="post-meta">
    
    <span class="post-author">
        <?php echo get_avatar(get_the_author_meta('ID'), 32, '', '', array('class' => 'author-avatar')); ?>
        <?php esc_html_e('By', 'vdaily-theme'); ?>
        <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
            <?php echo esc_html(get_the_author()); ?>
        </a>
    </span>
    
    <span class="post-date">
        <time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
            <?php echo esc_html(get_the_date()); ?>
        </time>
    </span>
    
    <?php if (get_option('vdaily_show_reading_time', true)) : ?>
        <span class="post-reading-time">
            <?php
            $reading_time = get_post_meta(get_the_ID(), '_vdaily_reading_time', true);
            if ($reading_time) {
                printf(
                    esc_html(_n('%d min read', '%d min read', $reading_time, 'vdaily-theme')),
                    (int) $reading_time
                );
            }
            ?>
        </span>
    <?php endif; ?>
    
</div><!-- .post-meta -->
