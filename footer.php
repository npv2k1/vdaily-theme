        </div><!-- .container -->
    </div><!-- #content -->

    <footer id="colophon" class="site-footer" role="contentinfo">
        <div class="container">
            <div class="footer-content">
                <?php if (is_active_sidebar('footer-1')) : ?>
                    <div class="footer-widgets">
                        <?php dynamic_sidebar('footer-1'); ?>
                    </div>
                <?php endif; ?>

                <div class="footer-navigation">
                    <h3 class="footer-title"><?php esc_html_e('Navigation', 'vdaily-theme'); ?></h3>
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'footer',
                        'menu_id'        => 'footer-menu',
                        'container'      => 'nav',
                        'menu_class'     => 'footer-menu',
                        'fallback_cb'    => false,
                    ));
                    ?>
                </div>

                <div class="footer-social">
                    <h3 class="footer-title"><?php esc_html_e('Follow Us', 'vdaily-theme'); ?></h3>
                    <div class="footer-social-icons">
                        <?php vdaily_social_media_icons('footer'); ?>
                    </div>
                </div>
            </div>

            <div class="site-info">
                <p>
                    <?php
                    /* translators: %s: WordPress */
                    printf(esc_html__('Powered by %s', 'vdaily-theme'), '<a href="https://wordpress.org/">WordPress</a>');
                    ?>
                    <span class="sep"> | </span>
                    <?php
                    /* translators: %s: Theme name */
                    printf(esc_html__('Theme: %s', 'vdaily-theme'), 'VDaily');
                    ?>
                    <span class="sep"> | </span>
                    <?php
                    /* translators: %s: Year */
                    printf(esc_html__('© %s All rights reserved', 'vdaily-theme'), esc_html(gmdate('Y')));
                    ?>
                </p>
            </div><!-- .site-info -->
        </div><!-- .container -->
    </footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
