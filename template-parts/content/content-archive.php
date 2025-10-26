<?php
/**
 * Template part for displaying posts in archive
 *
 * @package VDaily_Theme
 * @since 1.0.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post archive-post'); ?>>
    
    <a href="<?php the_permalink(); ?>" class="post-link">
        
        <?php if (has_post_thumbnail()) : ?>
            <div class="post-thumbnail">
                <?php the_post_thumbnail('vdaily-archive'); ?>
            </div>
        <?php endif; ?>

        <div class="post-content-wrapper">
            <header class="entry-header">
                <?php the_title('<h2 class="entry-title">', '</h2>'); ?>
                
                <div class="entry-meta">
                    <?php
                    vdaily_posted_on();
                    
                    if (get_option('vdaily_show_reading_time', true)) {
                        echo ' <span class="meta-separator">|</span> ';
                        vdaily_reading_time();
                    }
                    ?>
                </div><!-- .entry-meta -->
            </header><!-- .entry-header -->

            <div class="entry-excerpt">
                <?php echo vdaily_custom_excerpt(); ?>
            </div><!-- .entry-excerpt -->

            <div class="read-more">
                <?php esc_html_e('Read More', 'vdaily-theme'); ?> →
            </div>
        </div><!-- .post-content-wrapper -->
        
    </a><!-- .post-link -->

</article><!-- #post-<?php the_ID(); ?> -->
