<?php
/**
 * Archive template
 *
 * @package VDaily_Theme
 * @since 1.0.0
 */

get_header();
?>

<main id="primary" class="site-main archive-template" role="main">

    <?php if (have_posts()) : ?>

        <header class="page-header">
            <?php
            the_archive_title('<h1 class="page-title">', '</h1>');
            the_archive_description('<div class="archive-description">', '</div>');
            ?>
        </header>

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
                <p><?php esc_html_e('It seems we can\'t find what you\'re looking for. Perhaps searching can help.', 'vdaily-theme'); ?></p>
                <?php get_search_form(); ?>
            </div>
        </div>

    <?php endif; ?>

</main><!-- #primary -->

<?php
get_footer();
