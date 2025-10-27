<?php
/**
 * Template part for left sidebar navigation (dev.to style)
 *
 * @package VDaily_Theme
 * @since 1.0.0
 */

// Get main navigation menu
$nav_menu = wp_nav_menu(array(
    'theme_location' => 'primary',
    'container'      => false,
    'menu_class'     => 'devto-nav-menu',
    'echo'           => false,
    'fallback_cb'    => false,
));

// Get popular tags
$popular_tags = get_tags(array(
    'orderby'    => 'count',
    'order'      => 'DESC',
    'number'     => 10,
    'hide_empty' => true,
));
?>

<div class="devto-left-nav">
    <?php if ($nav_menu) : ?>
        <nav class="devto-sidebar-nav" role="navigation">
            <?php echo $nav_menu; ?>
        </nav>
    <?php else : ?>
        <nav class="devto-sidebar-nav" role="navigation">
            <ul class="devto-nav-menu">
                <li class="menu-item">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="nav-link active">
                        <span class="nav-icon">🏠</span>
                        <span class="nav-text"><?php esc_html_e('Home', 'vdaily-theme'); ?></span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?php echo esc_url(home_url('/category/programming/')); ?>" class="nav-link">
                        <span class="nav-icon">💻</span>
                        <span class="nav-text"><?php esc_html_e('Programming', 'vdaily-theme'); ?></span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?php echo esc_url(home_url('/category/tutorial/')); ?>" class="nav-link">
                        <span class="nav-icon">📚</span>
                        <span class="nav-text"><?php esc_html_e('Tutorials', 'vdaily-theme'); ?></span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?php echo esc_url(home_url('/category/tech/')); ?>" class="nav-link">
                        <span class="nav-icon">🚀</span>
                        <span class="nav-text"><?php esc_html_e('Tech News', 'vdaily-theme'); ?></span>
                    </a>
                </li>
            </ul>
        </nav>
    <?php endif; ?>

    <?php if (!empty($popular_tags)) : ?>
        <div class="devto-tags-section">
            <h3 class="tags-title"><?php esc_html_e('Popular Tags', 'vdaily-theme'); ?></h3>
            <div class="devto-tags-list">
                <?php foreach ($popular_tags as $tag) : ?>
                    <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" class="devto-tag">
                        <span class="tag-hash">#</span><?php echo esc_html($tag->name); ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="devto-social-section">
        <?php vdaily_social_media_icons('sidebar'); ?>
    </div>
</div>
