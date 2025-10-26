<?php
/**
 * Template part for displaying search results
 *
 * @package VDaily_Theme
 * @since 1.0.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post search-result'); ?>>
    
    <header class="entry-header">
        <?php the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '">', '</a></h2>'); ?>
        
        <div class="entry-meta">
            <?php
            vdaily_posted_on();
            echo ' <span class="meta-separator">in</span> ';
            
            $categories_list = get_the_category_list(', ');
            if ($categories_list) {
                echo $categories_list;
            }
            ?>
        </div><!-- .entry-meta -->
    </header><!-- .entry-header -->

    <div class="entry-summary">
        <?php echo vdaily_highlight_search_terms(vdaily_custom_excerpt(200)); ?>
    </div><!-- .entry-summary -->

</article><!-- #post-<?php the_ID(); ?> -->
