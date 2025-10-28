<?php
/**
 * Template part for displaying posts in archive
 *
 * @package VDaily_Theme
 * @since 1.0.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post archive-post'); ?>>
    
    <a href="<?php the_permalink(); ?>" class="post-link" aria-label="<?php echo esc_attr(get_the_title()); ?>">
        
        <?php if (has_post_thumbnail()) : ?>
            <div class="post-thumbnail">
                <?php 
                the_post_thumbnail('vdaily-archive', array(
                    'alt' => get_the_title(),
                )); 
                ?>
            </div>
        <?php endif; ?>

        <div class="post-content-wrapper">
            <header class="entry-header">
                <?php the_title('<h2 class="entry-title">', '</h2>'); ?>
                
                <div class="entry-meta">
                    <span class="posted-on">
                        <?php vdaily_posted_on(); ?>
                    </span>
                    
                    <?php if (get_option('vdaily_show_reading_time', true)) : ?>
                        <span class="meta-separator" aria-hidden="true">|</span>
                        <span class="reading-time">
                            <?php vdaily_reading_time(); ?>
                        </span>
                    <?php endif; ?>
                </div><!-- .entry-meta -->
            </header><!-- .entry-header -->

            <div class="entry-excerpt">
                <?php echo vdaily_custom_excerpt(); ?>
            </div><!-- .entry-excerpt -->

            <span class="read-more" aria-hidden="true">
                <?php esc_html_e('Read More', 'vdaily-theme'); ?> →
            </span>
        </div><!-- .post-content-wrapper -->
        
    </a><!-- .post-link -->

</article><!-- #post-<?php the_ID(); ?> -->
