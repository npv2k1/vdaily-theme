<?php
/**
 * Template part for related posts
 *
 * @package VDaily_Theme
 * @since 1.0.0
 */

// Get arguments
$args = wp_parse_args($args, array(
    'post_id' => get_the_ID(),
    'count'   => get_option('vdaily_related_posts_count', 5),
));

// Get related posts
$related_posts = vdaily_get_related_posts($args['post_id'], $args['count']);

if (empty($related_posts)) {
    return;
}

do_action('vdaily_before_related_posts', $args['post_id'], $related_posts);
?>

<aside class="related-posts">
    <h3 class="related-posts-title"><?php esc_html_e('Related Articles', 'vdaily-theme'); ?></h3>
    
    <div class="related-posts-grid">
        <?php foreach ($related_posts as $post) : setup_postdata($post); ?>
            
            <article class="related-post">
                <a href="<?php the_permalink(); ?>">
                    
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="related-post-thumbnail">
                            <?php the_post_thumbnail('vdaily-related'); ?>
                        </div>
                    <?php endif; ?>
                    
                    <h4 class="related-post-title"><?php the_title(); ?></h4>
                    
                    <div class="related-post-meta">
                        <?php vdaily_posted_on(); ?>
                    </div>
                    
                </a>
            </article>
            
        <?php endforeach; wp_reset_postdata(); ?>
    </div><!-- .related-posts-grid -->
    
</aside><!-- .related-posts -->

<?php
do_action('vdaily_after_related_posts', $args['post_id'], $related_posts);
