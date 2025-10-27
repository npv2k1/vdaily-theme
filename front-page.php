<?php
/**
 * The front page template file
 *
 * @package VDaily_Theme
 * @since 1.0.0
 */

get_header();
?>

<main id="primary" class="site-main home-page" role="main">

    <?php
    // Hero Section with Featured Posts
    get_template_part('template-parts/home/hero', 'section');
    ?>

    <div class="home-content-wrapper">
        <div class="home-main-content">
            <?php
            // Content Section with Tabs and Articles
            get_template_part('template-parts/home/content', 'section');
            ?>
        </div>

        <div class="home-sidebar">
            <?php
            // Sidebar with Popular Posts
            get_sidebar();
            ?>
        </div>
    </div>

</main><!-- #primary -->

<?php
get_footer();
