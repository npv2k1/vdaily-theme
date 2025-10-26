        </div><!-- .container -->
    </div><!-- #content -->

    <footer id="colophon" class="site-footer" role="contentinfo">
        <div class="container">
            <?php if (is_active_sidebar('footer-1')) : ?>
                <div class="footer-widgets">
                    <?php dynamic_sidebar('footer-1'); ?>
                </div>
            <?php endif; ?>

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
                </p>
            </div><!-- .site-info -->
        </div><!-- .container -->
    </footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
