<?php
/**
 * Template part for breadcrumb navigation
 *
 * @package VDaily_Theme
 * @since 1.0.0
 */

// Don't show on homepage or pages
if (is_front_page() || is_page()) {
    return;
}
?>

<nav class="breadcrumb" aria-label="<?php esc_attr_e('Breadcrumb', 'vdaily-theme'); ?>">
    <ol class="breadcrumb-list" vocab="https://schema.org/" typeof="BreadcrumbList">
        
        <li property="itemListElement" typeof="ListItem">
            <a property="item" typeof="WebPage" href="<?php echo esc_url(home_url('/')); ?>">
                <span property="name"><?php esc_html_e('Home', 'vdaily-theme'); ?></span>
            </a>
            <meta property="position" content="1" />
        </li>
        
        <?php if (is_single()) : ?>
            <?php
            $categories = get_the_category();
            if ($categories) {
                $category = $categories[0];
                ?>
                <li class="separator" aria-hidden="true">→</li>
                <li property="itemListElement" typeof="ListItem">
                    <a property="item" typeof="WebPage" href="<?php echo esc_url(get_category_link($category->term_id)); ?>">
                        <span property="name"><?php echo esc_html($category->name); ?></span>
                    </a>
                    <meta property="position" content="2" />
                </li>
                <li class="separator" aria-hidden="true">→</li>
                <li property="itemListElement" typeof="ListItem">
                    <span property="name"><?php the_title(); ?></span>
                    <meta property="position" content="3" />
                </li>
                <?php
            }
            ?>
        <?php elseif (is_category()) : ?>
            <li class="separator" aria-hidden="true">→</li>
            <li property="itemListElement" typeof="ListItem">
                <span property="name"><?php single_cat_title(); ?></span>
                <meta property="position" content="2" />
            </li>
        <?php elseif (is_tag()) : ?>
            <li class="separator" aria-hidden="true">→</li>
            <li property="itemListElement" typeof="ListItem">
                <span property="name"><?php single_tag_title(); ?></span>
                <meta property="position" content="2" />
            </li>
        <?php elseif (is_archive()) : ?>
            <li class="separator" aria-hidden="true">→</li>
            <li property="itemListElement" typeof="ListItem">
                <span property="name"><?php the_archive_title(); ?></span>
                <meta property="position" content="2" />
            </li>
        <?php endif; ?>
        
    </ol>
</nav>
