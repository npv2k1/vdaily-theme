<?php
/**
 * The main template file
 *
 * @package VDaily_Theme
 * @since 1.0.0
 */

get_header();
?>

<main id="primary" class="site-main" role="main">

    <?php if (have_posts()) : ?>

        <?php if (is_home() && !is_front_page()) : ?>
            <header class="page-header">
                <h1 class="page-title"><?php single_post_title(); ?></h1>
            </header>
        <?php endif; ?>

        <div class="posts-list">
            <?php
            while (have_posts()) :
                the_post();
                get_template_part('template-parts/content/content', 'archive');
            endwhile;
            ?>
        </div>

        <?php get_template_part('template-parts/navigation/nav', 'pagination'); ?>

    <?php else : ?>

        <div class="no-results not-found">
            <header class="page-header">
                <h1 class="page-title"><?php esc_html_e('Nothing Found', 'vdaily-theme'); ?></h1>
            </header>

            <div class="page-content">
                <p><?php esc_html_e('It looks like nothing was found at this location. Maybe try a search?', 'vdaily-theme'); ?></p>
                <?php get_search_form(); ?>
            </div>
        </div>

    <?php endif; ?>

</main><!-- #primary -->

<?php
// get_sidebar(); // Uncomment if you want a sidebar
get_footer();
