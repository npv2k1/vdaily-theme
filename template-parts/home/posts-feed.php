<?php
/**
 * Template part for posts feed (dev.to style center content)
 *
 * @package VDaily_Theme
 * @since 1.0.0
 */

// Get current page
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

// Get current category filter
$current_category = isset($_GET['category']) ? sanitize_text_field($_GET['category']) : '';

// Query posts
$args = array(
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'posts_per_page' => 10,
    'paged'          => $paged,
);

if (!empty($current_category) && $current_category !== 'all') {
    $args['category_name'] = $current_category;
}

$posts_query = new WP_Query($args);
?>

<div class="devto-feed">
    <!-- Feed Header with Tabs -->
    <div class="devto-feed-header">
        <nav class="devto-feed-tabs">
            <a href="<?php echo esc_url(home_url('/')); ?>" 
               class="feed-tab <?php echo empty($current_category) ? 'active' : ''; ?>">
                <?php esc_html_e('Relevant', 'vdaily-theme'); ?>
            </a>
            <a href="<?php echo esc_url(add_query_arg('category', 'all', home_url('/'))); ?>" 
               class="feed-tab <?php echo $current_category === 'all' ? 'active' : ''; ?>">
                <?php esc_html_e('Latest', 'vdaily-theme'); ?>
            </a>
            <a href="<?php echo esc_url(add_query_arg('category', 'top', home_url('/'))); ?>" 
               class="feed-tab <?php echo $current_category === 'top' ? 'active' : ''; ?>">
                <?php esc_html_e('Top', 'vdaily-theme'); ?>
            </a>
        </nav>
    </div>

    <!-- Posts List -->
    <div class="devto-posts-list">
        <?php
        if ($posts_query->have_posts()) :
            while ($posts_query->have_posts()) :
                $posts_query->the_post();
                
                // Get post metadata
                $author_id = get_the_author_meta('ID');
                $author_name = get_the_author();
                $author_avatar = get_avatar_url($author_id, array('size' => 40));
                $comments_count = get_comments_number();
                $reading_time = function_exists('vdaily_reading_time') ? vdaily_reading_time() : '5';
                $categories = get_the_category();
        ?>
                <article class="devto-post-card">
                    <div class="post-card-header">
                        <div class="post-author-info">
                            <img src="<?php echo esc_url($author_avatar); ?>" 
                                 alt="<?php echo esc_attr($author_name); ?>" 
                                 class="author-avatar">
                            <div class="author-meta">
                                <a href="<?php echo esc_url(get_author_posts_url($author_id)); ?>" 
                                   class="author-name"><?php echo esc_html($author_name); ?></a>
                                <div class="post-date">
                                    <?php echo esc_html(get_the_date()); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="post-card-body">
                        <a href="<?php the_permalink(); ?>" class="post-card-link">
                            <h2 class="post-card-title"><?php the_title(); ?></h2>
                            
                            <?php if (!empty($categories)) : ?>
                                <div class="post-card-tags">
                                    <?php foreach (array_slice($categories, 0, 3) as $category) : ?>
                                        <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" 
                                           class="post-tag">
                                            #<?php echo esc_html($category->name); ?>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </a>
                    </div>

                    <?php if (has_post_thumbnail()) : ?>
                        <div class="post-card-image">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('medium_large', array('class' => 'post-thumbnail')); ?>
                            </a>
                        </div>
                    <?php endif; ?>

                    <div class="post-card-footer">
                        <div class="post-reactions">
                            <span class="reaction-display" title="Reactions coming soon">
                                <span class="reaction-icon">❤️</span>
                                <span class="reaction-count">0</span>
                            </span>
                            <span class="reaction-display" title="Reactions coming soon">
                                <span class="reaction-icon">🦄</span>
                                <span class="reaction-count">0</span>
                            </span>
                            <span class="reaction-display" title="Reactions coming soon">
                                <span class="reaction-icon">🔖</span>
                                <span class="reaction-count">0</span>
                            </span>
                        </div>
                        <div class="post-meta-info">
                            <a href="<?php the_permalink(); ?>#comments" class="comments-link">
                                💬 <?php echo esc_html($comments_count); ?> 
                                <?php echo _n('comment', 'comments', $comments_count, 'vdaily-theme'); ?>
                            </a>
                            <span class="reading-time">⏱️ <?php echo esc_html($reading_time); ?> min read</span>
                        </div>
                    </div>
                </article>
        <?php
            endwhile;
            wp_reset_postdata();
        else :
        ?>
            <div class="no-posts-message">
                <p><?php esc_html_e('No posts found. Try a different filter!', 'vdaily-theme'); ?></p>
            </div>
        <?php endif; ?>
    </div>

    <!-- Pagination -->
    <?php if ($posts_query->max_num_pages > 1) : ?>
        <div class="devto-pagination">
            <?php
            echo paginate_links(array(
                'total'     => $posts_query->max_num_pages,
                'current'   => $paged,
                'prev_text' => '← ' . __('Previous', 'vdaily-theme'),
                'next_text' => __('Next', 'vdaily-theme') . ' →',
            ));
            ?>
        </div>
    <?php endif; ?>
</div>
