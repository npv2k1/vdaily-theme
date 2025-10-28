<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php vdaily_skip_link(); ?>

<div id="page" class="site">
    <header id="masthead" class="site-header" role="banner">
        <div class="container">
            <div class="header-wrapper">
                <div class="site-branding">
                    <?php
                    if (has_custom_logo()) {
                        the_custom_logo();
                    } else {
                        ?>
                        <h1 class="site-title">
                            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home" aria-label="<?php bloginfo('name'); ?> - Go to homepage">
                                2k1
                            </a>
                        </h1>
                        <?php
                    }
                    ?>
                </div><!-- .site-branding -->

                <?php get_template_part('template-parts/navigation/nav', 'primary'); ?>

                <div class="header-icons">
                    <?php vdaily_social_media_icons('header'); ?>
                    <button class="header-icon search-toggle" aria-label="Open search" aria-expanded="false">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <circle cx="11" cy="11" r="8"></circle>
                            <path d="m21 21-4.35-4.35"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div><!-- .container -->
    </header><!-- #masthead -->

    <?php
    // Reading progress bar for single posts
    if (is_single() && get_option('vdaily_show_reading_progress', true)) {
        get_template_part('template-parts/components/reading', 'progress');
    }
    ?>

    <div id="content" class="site-content">
        <div class="container">
            <main id="primary" class="site-main" role="main">
