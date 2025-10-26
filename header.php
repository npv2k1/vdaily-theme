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
            <div class="site-branding">
                <?php
                if (has_custom_logo()) {
                    the_custom_logo();
                } else {
                    ?>
                    <h1 class="site-title">
                        <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                            <?php bloginfo('name'); ?>
                        </a>
                    </h1>
                    <?php
                    $description = get_bloginfo('description', 'display');
                    if ($description || is_customize_preview()) {
                        ?>
                        <p class="site-description"><?php echo $description; ?></p>
                        <?php
                    }
                }
                ?>
            </div><!-- .site-branding -->

            <?php get_template_part('template-parts/navigation/nav', 'primary'); ?>
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
