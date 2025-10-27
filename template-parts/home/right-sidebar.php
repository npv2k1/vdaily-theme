<?php
/**
 * Template part for right sidebar (dev.to style)
 *
 * @package VDaily_Theme
 * @since 1.0.0
 */

// Get popular posts
$popular_args = array(
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'posts_per_page' => 5,
    'orderby'        => 'comment_count',
    'order'          => 'DESC',
);

$popular_query = new WP_Query($popular_args);
?>

<div class="devto-right-content">
    <!-- Listings Section -->
    <div class="devto-listings-card">
        <h3 class="card-title"><?php esc_html_e('Listings', 'vdaily-theme'); ?></h3>
        <div class="listings-content">
            <a href="#" class="listing-item">
                <span class="listing-category"><?php esc_html_e('events', 'vdaily-theme'); ?></span>
                <p class="listing-text"><?php esc_html_e('Check out upcoming tech events', 'vdaily-theme'); ?></p>
            </a>
            <a href="#" class="listing-item">
                <span class="listing-category"><?php esc_html_e('jobs', 'vdaily-theme'); ?></span>
                <p class="listing-text"><?php esc_html_e('Browse developer opportunities', 'vdaily-theme'); ?></p>
            </a>
            <a href="#" class="listing-item">
                <span class="listing-category"><?php esc_html_e('collabs', 'vdaily-theme'); ?></span>
                <p class="listing-text"><?php esc_html_e('Find project collaborators', 'vdaily-theme'); ?></p>
            </a>
        </div>
        <a href="#" class="see-all-link"><?php esc_html_e('See all', 'vdaily-theme'); ?></a>
    </div>

    <!-- Popular Posts Widget -->
    <?php if ($popular_query->have_posts()) : ?>
        <div class="devto-trending-card">
            <h3 class="card-title"><?php esc_html_e('Trending on VDaily', 'vdaily-theme'); ?></h3>
            <div class="trending-posts">
                <?php
                $post_count = 0;
                while ($popular_query->have_posts()) :
                    $popular_query->the_post();
                    $post_count++;
                    $comments_count = get_comments_number();
                    $reactions_count = rand(5, 50); // Placeholder for reactions
                ?>
                    <article class="trending-post-item">
                        <a href="<?php the_permalink(); ?>" class="trending-post-link">
                            <div class="trending-post-header">
                                <span class="trending-number"><?php echo esc_html($post_count); ?></span>
                                <div class="trending-post-author">
                                    <img src="<?php echo esc_url(get_avatar_url(get_the_author_meta('ID'), array('size' => 24))); ?>" 
                                         alt="<?php echo esc_attr(get_the_author()); ?>" 
                                         class="author-mini-avatar">
                                    <span class="author-mini-name"><?php echo esc_html(get_the_author()); ?></span>
                                </div>
                            </div>
                            <h4 class="trending-post-title"><?php the_title(); ?></h4>
                            <div class="trending-post-meta">
                                <span class="meta-item">💬 <?php echo esc_html($comments_count); ?></span>
                                <span class="meta-item">❤️ <?php echo esc_html($reactions_count); ?></span>
                            </div>
                        </a>
                    </article>
                <?php
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- Help Card -->
    <div class="devto-help-card">
        <h3 class="card-title"><?php esc_html_e('#help', 'vdaily-theme'); ?></h3>
        <p class="help-description">
            <?php esc_html_e('Need help with development? Ask the community!', 'vdaily-theme'); ?>
        </p>
        <a href="#" class="help-submit-btn"><?php esc_html_e('Submit', 'vdaily-theme'); ?></a>
    </div>

    <!-- Recent Comments -->
    <?php
    $recent_comments = get_comments(array(
        'number' => 5,
        'status' => 'approve',
    ));
    
    if (!empty($recent_comments)) :
    ?>
        <div class="devto-comments-card">
            <h3 class="card-title"><?php esc_html_e('Recent Activity', 'vdaily-theme'); ?></h3>
            <div class="recent-comments-list">
                <?php foreach ($recent_comments as $comment) : ?>
                    <div class="recent-comment-item">
                        <img src="<?php echo esc_url(get_avatar_url($comment->user_id ?: $comment->comment_author_email, array('size' => 24))); ?>" 
                             alt="<?php echo esc_attr($comment->comment_author); ?>" 
                             class="comment-avatar">
                        <div class="comment-content">
                            <a href="<?php echo esc_url(get_comment_link($comment)); ?>" class="comment-link">
                                <strong><?php echo esc_html($comment->comment_author); ?></strong>
                                <?php echo wp_trim_words($comment->comment_content, 10); ?>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- Tags Cloud (Alternative) -->
    <div class="devto-tags-cloud-card">
        <h3 class="card-title"><?php esc_html_e('Popular Tags', 'vdaily-theme'); ?></h3>
        <?php
        wp_tag_cloud(array(
            'smallest' => 12,
            'largest'  => 16,
            'number'   => 20,
            'orderby'  => 'count',
            'order'    => 'DESC',
            'format'   => 'flat',
            'separator' => ' ',
            'show_count' => true,
        ));
        ?>
    </div>
</div>
