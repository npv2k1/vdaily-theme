<?php
/**
 * Template part for displaying single post content
 *
 * @package VDaily_Theme
 * @since 1.0.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post single-post'); ?>>
    
    <?php if (has_post_thumbnail()) : ?>
        <div class="post-thumbnail">
            <?php the_post_thumbnail('vdaily-featured'); ?>
        </div>
    <?php endif; ?>

    <header class="entry-header">
        <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
        
        <div class="entry-meta">
            <?php
            vdaily_posted_by();
            echo ' <span class="meta-separator">|</span> ';
            vdaily_posted_on();
            
            if (get_option('vdaily_show_reading_time', true)) {
                echo ' <span class="meta-separator">|</span> ';
                vdaily_reading_time();
            }
            ?>
        </div><!-- .entry-meta -->
    </header><!-- .entry-header -->

    <?php do_action('vdaily_before_article_content', get_the_ID()); ?>

    <div class="entry-content">
        <?php
        the_content();

        wp_link_pages(array(
            'before' => '<div class="page-links">' . esc_html__('Pages:', 'vdaily-theme'),
            'after'  => '</div>',
        ));
        ?>
    </div><!-- .entry-content -->

    <?php do_action('vdaily_after_article_content', get_the_ID()); ?>

    <footer class="entry-footer">
        <?php
        $categories_list = get_the_category_list(esc_html__(', ', 'vdaily-theme'));
        if ($categories_list) {
            printf(
                '<div class="post-categories"><span class="label">%1$s:</span> %2$s</div>',
                esc_html__('Categories', 'vdaily-theme'),
                $categories_list
            );
        }

        $tags_list = get_the_tag_list('', esc_html_x(', ', 'list item separator', 'vdaily-theme'));
        if ($tags_list) {
            printf(
                '<div class="post-tags"><span class="label">%1$s:</span> %2$s</div>',
                esc_html__('Tags', 'vdaily-theme'),
                $tags_list
            );
        }
        ?>
    </footer><!-- .entry-footer -->

</article><!-- #post-<?php the_ID(); ?> -->
