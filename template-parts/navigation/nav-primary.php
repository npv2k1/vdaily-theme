<?php
/**
 * Template part for primary navigation
 *
 * @package VDaily_Theme
 * @since 1.0.0
 */
?>

<nav id="primary-navigation" class="primary-nav" role="navigation" aria-label="<?php esc_attr_e('Primary Navigation', 'vdaily-theme'); ?>">
    
    <button class="menu-toggle" aria-expanded="false" aria-controls="primary-menu">
        <span class="screen-reader-text"><?php esc_html_e('Menu', 'vdaily-theme'); ?></span>
        <span class="hamburger-icon">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </span>
    </button>

    <div id="primary-menu" class="menu-wrapper">
        <?php
        wp_nav_menu(array(
            'theme_location' => 'primary',
            'menu_id'        => 'primary-menu',
            'container'      => false,
            'menu_class'     => 'nav-menu',
            'fallback_cb'    => 'vdaily_nav_fallback',
        ));
        ?>
    </div><!-- .menu-wrapper -->

</nav><!-- #primary-navigation -->
