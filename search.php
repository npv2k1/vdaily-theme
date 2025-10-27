<?php
/**
 * Search results template
 *
 * @package VDaily_Theme
 * @since 1.0.0
 */

get_header();
?>

<main id="primary" class="site-main search-results" role="main">

    <?php if (have_posts()) : ?>

        <header class="page-header">
            <h1 class="page-title">
                <?php
                /* translators: %s: search query */
                printf(esc_html__('Search Results for: %s', 'vdaily-theme'), '<span>' . get_search_query() . '</span>');
                ?>
            </h1>
        </header>

        <div class="search-results-list">
            <?php
            while (have_posts()) :
                the_post();
                get_template_part('template-parts/content/content', 'search');
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
                <p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with different keywords.', 'vdaily-theme'); ?></p>
                <?php get_search_form(); ?>
            </div>
        </div>

    <?php endif; ?>

</main><!-- #primary -->

<?php
get_footer();
