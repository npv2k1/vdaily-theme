<?php
/**
 * Template part for displaying content section with tabs and articles
 *
 * @package VDaily_Theme
 * @since 1.0.0
 */

// Get categories for tabs
$categories = get_categories(array(
    'orderby'    => 'name',
    'order'      => 'ASC',
    'hide_empty' => true,
));

// Get current category from query string
$current_category = isset($_GET['category']) ? sanitize_text_field($_GET['category']) : 'all';
?>

<section class="content-section">
    <div class="content-tabs">
        <ul class="tabs-list" role="tablist">
            <li class="tab-item">
                <a href="<?php echo esc_url(home_url('/')); ?>" 
                   class="tab-link <?php echo $current_category === 'new' ? 'active' : ''; ?>"
                   role="tab">
                    <?php esc_html_e('Bài mới', 'vdaily-theme'); ?>
                </a>
            </li>
            <li class="tab-item">
                <a href="<?php echo esc_url(add_query_arg('category', 'all', home_url('/'))); ?>" 
                   class="tab-link <?php echo $current_category === 'all' ? 'active' : ''; ?>"
                   role="tab">
                    <?php esc_html_e('ALL', 'vdaily-theme'); ?>
                </a>
            </li>
            <?php foreach ($categories as $category) : ?>
                <li class="tab-item">
                    <a href="<?php echo esc_url(add_query_arg('category', $category->slug, home_url('/'))); ?>" 
                       class="tab-link <?php echo $current_category === $category->slug ? 'active' : ''; ?>"
                       role="tab">
                        <?php echo esc_html(strtoupper($category->name)); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div class="articles-list">
        <?php
        // Query posts based on selected category
        $args = array(
            'post_type'      => 'post',
            'post_status'    => 'publish',
            'posts_per_page' => 10,
        );

        if ($current_category !== 'all' && $current_category !== 'new') {
            $args['category_name'] = $current_category;
        }

        $posts_query = new WP_Query($args);

        if ($posts_query->have_posts()) :
            while ($posts_query->have_posts()) :
                $posts_query->the_post();
        ?>
                <article class="article-item">
                    <a href="<?php the_permalink(); ?>" class="article-link">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="article-thumbnail">
                                <?php the_post_thumbnail('vdaily-archive'); ?>
                            </div>
                        <?php endif; ?>
                        
                        <div class="article-content">
                            <h3 class="article-title"><?php the_title(); ?></h3>
                            
                            <div class="article-meta">
                                <?php vdaily_posted_by(); ?>
                                <span class="meta-separator">•</span>
                                <?php vdaily_posted_on(); ?>
                                <span class="meta-separator">•</span>
                                <span class="comments-count">
                                    <?php
                                    $comments_count = get_comments_number();
                                    printf(
                                        _n('%s comment', '%s comments', $comments_count, 'vdaily-theme'),
                                        number_format_i18n($comments_count)
                                    );
                                    ?>
                                </span>
                            </div>
                            
                            <div class="article-excerpt">
                                <?php echo vdaily_custom_excerpt(120); ?>
                            </div>
                        </div>
                    </a>
                </article>
        <?php
            endwhile;
            wp_reset_postdata();
        else :
        ?>
            <p class="no-posts"><?php esc_html_e('No posts found.', 'vdaily-theme'); ?></p>
        <?php endif; ?>
    </div>

    <?php if ($posts_query->max_num_pages > 1) : ?>
        <div class="content-pagination">
            <?php
            echo paginate_links(array(
                'total'   => $posts_query->max_num_pages,
                'current' => max(1, get_query_var('paged')),
            ));
            ?>
        </div>
    <?php endif; ?>
</section>
