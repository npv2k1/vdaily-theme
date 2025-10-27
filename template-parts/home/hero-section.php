<?php
/**
 * Template part for displaying hero section with featured posts
 *
 * @package VDaily_Theme
 * @since 1.0.0
 */

// Get featured posts (posts with sticky flag or latest posts)
$featured_args = array(
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'posts_per_page' => 3,
    'meta_query'     => array(
        array(
            'key'     => '_vdaily_featured',
            'compare' => 'EXISTS',
        ),
    ),
);

$featured_query = new WP_Query($featured_args);

// Fallback to latest posts if no featured posts
if (!$featured_query->have_posts()) {
    $featured_args = array(
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => 3,
    );
    $featured_query = new WP_Query($featured_args);
}

if ($featured_query->have_posts()) :
?>
    <section class="hero-section">
        <div class="hero-grid">
            <?php
            $post_count = 0;
            while ($featured_query->have_posts()) :
                $featured_query->the_post();
                $post_count++;
                $post_class = ($post_count === 1) ? 'hero-post-main' : 'hero-post-secondary';
            ?>
                <article class="hero-post <?php echo esc_attr($post_class); ?>">
                    <a href="<?php the_permalink(); ?>" class="hero-post-link">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="hero-post-thumbnail">
                                <?php the_post_thumbnail($post_count === 1 ? 'vdaily-featured' : 'vdaily-archive'); ?>
                                <div class="hero-post-overlay"></div>
                            </div>
                        <?php endif; ?>
                        
                        <div class="hero-post-content">
                            <?php
                            $categories = get_the_category();
                            if (!empty($categories)) :
                            ?>
                                <span class="hero-post-tag"><?php echo esc_html(strtoupper($categories[0]->name)); ?></span>
                            <?php endif; ?>
                            
                            <h2 class="hero-post-title"><?php the_title(); ?></h2>
                            
                            <div class="hero-post-meta">
                                <?php vdaily_posted_by(); ?>
                                <span class="meta-separator">•</span>
                                <?php vdaily_posted_on(); ?>
                            </div>
                        </div>
                    </a>
                </article>
            <?php
            endwhile;
            wp_reset_postdata();
            ?>
        </div>
    </section>
<?php
endif;
