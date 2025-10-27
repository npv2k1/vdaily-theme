<?php
/**
 * 404 error template
 *
 * @package VDaily_Theme
 * @since 1.0.0
 */

get_header();
?>

<main id="primary" class="site-main error-404 not-found" role="main">

    <div class="error-404-content">
        <header class="page-header">
            <h1 class="page-title"><?php esc_html_e('404', 'vdaily-theme'); ?></h1>
            <h2><?php esc_html_e('Page Not Found', 'vdaily-theme'); ?></h2>
        </header>

        <div class="page-content">
            <p><?php esc_html_e('It looks like nothing was found at this location. Maybe try searching for what you need?', 'vdaily-theme'); ?></p>

            <?php get_search_form(); ?>

            <div class="widget widget_recent_entries">
                <h3 class="widget-title"><?php esc_html_e('Recent Posts', 'vdaily-theme'); ?></h3>
                <ul>
                    <?php
                    $recent_posts = wp_get_recent_posts(array(
                        'numberposts' => 5,
                        'post_status' => 'publish'
                    ));
                    
                    foreach ($recent_posts as $post) :
                        ?>
                        <li>
                            <a href="<?php echo esc_url(get_permalink($post['ID'])); ?>">
                                <?php echo esc_html($post['post_title']); ?>
                            </a>
                        </li>
                        <?php
                    endforeach;
                    wp_reset_query();
                    ?>
                </ul>
            </div>

            <div class="widget widget_categories">
                <h3 class="widget-title"><?php esc_html_e('Categories', 'vdaily-theme'); ?></h3>
                <ul>
                    <?php
                    wp_list_categories(array(
                        'orderby'    => 'count',
                        'order'      => 'DESC',
                        'show_count' => 1,
                        'title_li'   => '',
                        'number'     => 10,
                    ));
                    ?>
                </ul>
            </div>
        </div>
    </div>

</main><!-- #primary -->

<?php
get_footer();
