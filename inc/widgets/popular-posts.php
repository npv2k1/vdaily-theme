<?php
/**
 * Popular Posts Widget
 *
 * @package VDaily_Theme
 * @since 1.0.0
 */

class VDaily_Popular_Posts_Widget extends WP_Widget {

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct(
            'vdaily_popular_posts',
            __('VDaily: Popular Posts', 'vdaily-theme'),
            array(
                'description' => __('Display popular posts based on view count', 'vdaily-theme'),
            )
        );
    }

    /**
     * Front-end display of widget
     */
    public function widget($args, $instance) {
        $title = !empty($instance['title']) ? $instance['title'] : __('Popular Post', 'vdaily-theme');
        $title = apply_filters('widget_title', $title);
        $number = !empty($instance['number']) ? absint($instance['number']) : 5;

        echo $args['before_widget'];

        if (!empty($title)) {
            echo $args['before_title'] . $title . $args['after_title'];
        }

        // Query popular posts
        $popular_posts = new WP_Query(array(
            'post_type'      => 'post',
            'post_status'    => 'publish',
            'posts_per_page' => $number,
            'orderby'        => 'comment_count',
            'order'          => 'DESC',
        ));

        if ($popular_posts->have_posts()) :
        ?>
            <div class="popular-posts-widget">
                <?php
                $post_count = 0;
                while ($popular_posts->have_posts()) :
                    $popular_posts->the_post();
                    $post_count++;
                    $is_featured = ($post_count === 1);
                ?>
                    <article class="popular-post-item <?php echo $is_featured ? 'featured' : ''; ?>">
                        <a href="<?php the_permalink(); ?>" class="popular-post-link">
                            <?php if ($is_featured && has_post_thumbnail()) : ?>
                                <div class="popular-post-thumbnail">
                                    <?php the_post_thumbnail('vdaily-related'); ?>
                                </div>
                            <?php endif; ?>
                            
                            <div class="popular-post-content">
                                <span class="popular-post-rank">
                                    <?php echo sprintf('%02d', $post_count); ?>
                                </span>
                                <h3 class="popular-post-title"><?php the_title(); ?></h3>
                                
                                <?php if ($is_featured) : ?>
                                    <div class="popular-post-meta">
                                        <?php vdaily_posted_on(); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </a>
                    </article>
                <?php
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
        <?php
        endif;

        echo $args['after_widget'];
    }

    /**
     * Back-end widget form
     */
    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : __('Popular Post', 'vdaily-theme');
        $number = !empty($instance['number']) ? absint($instance['number']) : 5;
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
                <?php esc_html_e('Title:', 'vdaily-theme'); ?>
            </label>
            <input class="widefat" 
                   id="<?php echo esc_attr($this->get_field_id('title')); ?>" 
                   name="<?php echo esc_attr($this->get_field_name('title')); ?>" 
                   type="text" 
                   value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('number')); ?>">
                <?php esc_html_e('Number of posts:', 'vdaily-theme'); ?>
            </label>
            <input class="tiny-text" 
                   id="<?php echo esc_attr($this->get_field_id('number')); ?>" 
                   name="<?php echo esc_attr($this->get_field_name('number')); ?>" 
                   type="number" 
                   step="1" 
                   min="1" 
                   value="<?php echo esc_attr($number); ?>" 
                   size="3">
        </p>
        <?php
    }

    /**
     * Sanitize widget form values as they are saved
     */
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? sanitize_text_field($new_instance['title']) : '';
        $instance['number'] = (!empty($new_instance['number'])) ? absint($new_instance['number']) : 5;
        return $instance;
    }
}

/**
 * Register popular posts widget
 */
function vdaily_register_popular_posts_widget() {
    register_widget('VDaily_Popular_Posts_Widget');
}
add_action('widgets_init', 'vdaily_register_popular_posts_widget');
