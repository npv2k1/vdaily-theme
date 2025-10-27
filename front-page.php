<?php
/**
 * The front page template file - Dev.to inspired layout
 *
 * @package VDaily_Theme
 * @since 1.0.0
 */

get_header();
?>

<main id="primary" class="site-main home-page devto-layout" role="main">

    <div class="devto-container">
        <!-- Left Sidebar: Navigation & Tags -->
        <aside class="devto-left-sidebar">
            <?php get_template_part('template-parts/home/left', 'sidebar'); ?>
        </aside>

        <!-- Main Content Area: Posts Feed -->
        <div class="devto-main-content">
            <?php get_template_part('template-parts/home/posts', 'feed'); ?>
        </div>

        <!-- Right Sidebar: Info & Widgets -->
        <aside class="devto-right-sidebar">
            <?php get_template_part('template-parts/home/right', 'sidebar'); ?>
        </aside>
    </div>

</main><!-- #primary -->

<?php
get_footer();
