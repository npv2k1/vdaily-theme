<?php
/**
 * Single post template
 *
 * @package VDaily_Theme
 * @since 1.0.0
 */

get_header();
?>

<main id="primary" class="site-main single-post-template" role="main">

    <?php
    while (have_posts()) :
        the_post();
        
        // Breadcrumb navigation
        if (!is_front_page()) {
            get_template_part('template-parts/navigation/nav', 'breadcrumb');
        }
        
        // Post content
        get_template_part('template-parts/content/content', 'single');
        
        // Related posts
        get_template_part('template-parts/components/related-posts', null, array(
            'count' => get_option('vdaily_related_posts_count', 5)
        ));
        
        // Comments
        if (comments_open() || get_comments_number()) {
            comments_template();
        }
        
    endwhile;
    ?>

</main><!-- #primary -->

<?php
get_footer();
