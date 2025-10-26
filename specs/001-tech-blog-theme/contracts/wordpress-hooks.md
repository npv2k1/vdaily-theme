# WordPress Hooks Contract

**Feature**: Modern Tech Blog WordPress Theme  
**Date**: October 26, 2025  
**Purpose**: Define WordPress action and filter hooks provided by the theme for extensibility

## Overview

This document specifies all custom WordPress hooks (actions and filters) that the theme provides for developers to extend functionality. Standard WordPress hooks are not documented here - only theme-specific hooks.

---

## Action Hooks

### Theme Setup Hooks

#### `vdaily_theme_setup`

Fires during theme setup, after all theme supports have been registered.

**Location**: `functions.php` → `vdaily_setup()`

**Use Case**: Register additional theme supports, modify theme configuration

**Parameters**: None

**Example**:

```php
add_action('vdaily_theme_setup', 'custom_theme_modifications');
function custom_theme_modifications() {
    // Add custom image size
    add_image_size('custom-size', 800, 600, true);
}
```

---

#### `vdaily_enqueue_scripts`

Fires after theme scripts and styles are enqueued.

**Location**: `inc/enqueue.php` → `vdaily_enqueue_assets()`

**Use Case**: Enqueue additional scripts or styles, modify existing enqueues

**Parameters**: None

**Example**:

```php
add_action('vdaily_enqueue_scripts', 'add_custom_script');
function add_custom_script() {
    wp_enqueue_script('my-script', get_stylesheet_directory_uri() . '/js/custom.js', array(), '1.0', true);
}
```

---

### Content Display Hooks

#### `vdaily_before_article_content`

Fires before the main article content is displayed.

**Location**: `template-parts/content/content-single.php`

**Use Case**: Add custom content before article (ads, notifications, etc.)

**Parameters**:

- `int $post_id` - Current post ID

**Example**:

```php
add_action('vdaily_before_article_content', 'add_reading_time_notice', 10, 1);
function add_reading_time_notice($post_id) {
    $reading_time = get_post_meta($post_id, '_vdaily_reading_time', true);
    echo '<p class="reading-time">Estimated reading time: ' . $reading_time . ' minutes</p>';
}
```

---

#### `vdaily_after_article_content`

Fires after the main article content is displayed, before related posts.

**Location**: `template-parts/content/content-single.php`

**Use Case**: Add custom content after article (author bio, call-to-action, etc.)

**Parameters**:

- `int $post_id` - Current post ID

**Example**:

```php
add_action('vdaily_after_article_content', 'add_share_buttons', 10, 1);
function add_share_buttons($post_id) {
    // Display social sharing buttons
    get_template_part('template-parts/components/share-buttons');
}
```

---

#### `vdaily_before_related_posts`

Fires before the related posts section.

**Location**: `template-parts/components/related-posts.php`

**Use Case**: Add heading or custom content before related posts

**Parameters**:

- `int $post_id` - Current post ID
- `array $related_posts` - Array of related post objects

**Example**:

```php
add_action('vdaily_before_related_posts', 'custom_related_heading', 10, 2);
function custom_related_heading($post_id, $related_posts) {
    if (!empty($related_posts)) {
        echo '<h3>Continue Reading</h3>';
    }
}
```

---

#### `vdaily_after_related_posts`

Fires after the related posts section.

**Location**: `template-parts/components/related-posts.php`

**Use Case**: Add additional content recommendations, newsletter signup, etc.

**Parameters**:

- `int $post_id` - Current post ID
- `array $related_posts` - Array of related post objects

**Example**:

```php
add_action('vdaily_after_related_posts', 'add_newsletter_signup');
function add_newsletter_signup() {
    get_template_part('template-parts/components/newsletter');
}
```

---

### Code Block Hooks

#### `vdaily_before_code_block`

Fires before a code block is rendered.

**Location**: `inc/code-highlighting.php` → `vdaily_format_code_blocks()`

**Use Case**: Add custom wrapper, analytics tracking for code blocks

**Parameters**:

- `string $language` - Programming language of code block
- `string $code` - Code content (raw)

**Example**:

```php
add_action('vdaily_before_code_block', 'track_code_language', 10, 2);
function track_code_language($language, $code) {
    // Track which languages are used most
    $count = get_option('vdaily_language_usage', array());
    $count[$language] = isset($count[$language]) ? $count[$language] + 1 : 1;
    update_option('vdaily_language_usage', $count);
}
```

---

#### `vdaily_after_code_block`

Fires after a code block is rendered.

**Location**: `inc/code-highlighting.php` → `vdaily_format_code_blocks()`

**Use Case**: Add custom footer, download button, etc.

**Parameters**:

- `string $language` - Programming language of code block
- `string $code` - Code content (raw)

**Example**:

```php
add_action('vdaily_after_code_block', 'add_run_code_button', 10, 2);
function add_run_code_button($language, $code) {
    if ($language === 'javascript') {
        echo '<button class="run-code">Run Code</button>';
    }
}
```

---

## Filter Hooks

### Content Filters

#### `vdaily_post_excerpt_length`

Filters the excerpt length (in characters, not words).

**Location**: `inc/template-tags.php` → `vdaily_custom_excerpt()`

**Default**: 160 characters (optimal for SEO meta description)

**Parameters**:

- `int $length` - Current excerpt length

**Returns**: `int` - Modified excerpt length

**Example**:

```php
add_filter('vdaily_post_excerpt_length', 'custom_excerpt_length');
function custom_excerpt_length($length) {
    return 200; // Increase to 200 characters
}
```

---

#### `vdaily_reading_time_wpm`

Filters the words-per-minute rate used for reading time calculation.

**Location**: `inc/template-tags.php` → `vdaily_calculate_reading_time()`

**Default**: 200 words per minute (average reading speed)

**Parameters**:

- `int $wpm` - Current words per minute

**Returns**: `int` - Modified words per minute

**Example**:

```php
add_filter('vdaily_reading_time_wpm', 'adjust_reading_speed');
function adjust_reading_speed($wpm) {
    return 250; // Faster reading speed for technical audience
}
```

---

#### `vdaily_related_posts_count`

Filters the number of related posts to display.

**Location**: `inc/template-tags.php` → `vdaily_get_related_posts()`

**Default**: 5 posts

**Parameters**:

- `int $count` - Current post count
- `int $post_id` - Current post ID

**Returns**: `int` - Modified post count (1-10 range recommended)

**Example**:

```php
add_filter('vdaily_related_posts_count', 'custom_related_count', 10, 2);
function custom_related_count($count, $post_id) {
    return 3; // Show only 3 related posts
}
```

---

#### `vdaily_related_posts_args`

Filters the WP_Query arguments for related posts.

**Location**: `inc/template-tags.php` → `vdaily_get_related_posts()`

**Default**: See data-model.md for default query args

**Parameters**:

- `array $args` - Current WP_Query arguments
- `int $post_id` - Current post ID

**Returns**: `array` - Modified WP_Query arguments

**Example**:

```php
add_filter('vdaily_related_posts_args', 'customize_related_posts', 10, 2);
function customize_related_posts($args, $post_id) {
    // Only show posts from last 6 months
    $args['date_query'] = array(
        array(
            'after' => '6 months ago',
        ),
    );
    return $args;
}
```

---

### SEO Filters

#### `vdaily_meta_description`

Filters the meta description for SEO.

**Location**: `inc/seo.php` → `vdaily_output_meta_tags()`

**Default**: Post excerpt or auto-generated from content

**Parameters**:

- `string $description` - Current meta description
- `int $post_id` - Current post ID

**Returns**: `string` - Modified meta description (150-160 characters recommended)

**Example**:

```php
add_filter('vdaily_meta_description', 'custom_meta_description', 10, 2);
function custom_meta_description($description, $post_id) {
    // Add category name to description
    $categories = get_the_category($post_id);
    if (!empty($categories)) {
        $description = $categories[0]->name . ': ' . $description;
    }
    return $description;
}
```

---

#### `vdaily_schema_article`

Filters the Schema.org Article structured data.

**Location**: `inc/seo.php` → `vdaily_output_schema_org()`

**Default**: Standard Article schema with required properties

**Parameters**:

- `array $schema` - Current schema array
- `int $post_id` - Current post ID

**Returns**: `array` - Modified schema array

**Example**:

```php
add_filter('vdaily_schema_article', 'add_schema_properties', 10, 2);
function add_schema_properties($schema, $post_id) {
    // Add 'keywords' property
    $tags = get_the_tags($post_id);
    if ($tags) {
        $schema['keywords'] = implode(', ', wp_list_pluck($tags, 'name'));
    }
    return $schema;
}
```

---

#### `vdaily_open_graph_image`

Filters the Open Graph image URL for social sharing.

**Location**: `inc/seo.php` → `vdaily_output_open_graph()`

**Default**: Featured image URL (vdaily-featured size: 1200x630)

**Parameters**:

- `string $image_url` - Current image URL
- `int $post_id` - Current post ID

**Returns**: `string` - Modified image URL

**Example**:

```php
add_filter('vdaily_open_graph_image', 'custom_og_image', 10, 2);
function custom_og_image($image_url, $post_id) {
    // Use custom image for specific category
    if (has_category('featured', $post_id)) {
        $image_url = get_stylesheet_directory_uri() . '/assets/images/featured-og.jpg';
    }
    return $image_url;
}
```

---

### Code Highlighting Filters

#### `vdaily_syntax_highlighting_languages`

Filters the list of supported programming languages for syntax highlighting.

**Location**: `inc/code-highlighting.php` → `vdaily_get_supported_languages()`

**Default**: Array of 20+ languages (see research.md)

**Parameters**:

- `array $languages` - Current supported languages array

**Returns**: `array` - Modified languages array

**Example**:

```php
add_filter('vdaily_syntax_highlighting_languages', 'add_custom_language');
function add_custom_language($languages) {
    $languages[] = 'elixir';
    $languages[] = 'kotlin';
    return $languages;
}
```

---

#### `vdaily_code_block_classes`

Filters the CSS classes applied to code blocks.

**Location**: `inc/code-highlighting.php` → `vdaily_format_code_blocks()`

**Default**: `language-{lang}` and optional `line-numbers`

**Parameters**:

- `array $classes` - Current CSS classes
- `string $language` - Programming language
- `array $attributes` - Block attributes (lineNumbers, etc.)

**Returns**: `array` - Modified CSS classes

**Example**:

```php
add_filter('vdaily_code_block_classes', 'add_code_theme_class', 10, 3);
function add_code_theme_class($classes, $language, $attributes) {
    $classes[] = 'theme-vscode';
    return $classes;
}
```

---

### Performance Filters

#### `vdaily_lazy_load_images`

Filters whether to enable lazy loading for images.

**Location**: `inc/performance.php` → `vdaily_add_lazy_loading()`

**Default**: `true` (enabled)

**Parameters**:

- `bool $enable` - Current lazy loading state
- `string $context` - Context ('content', 'thumbnail', 'archive')

**Returns**: `bool` - Modified lazy loading state

**Example**:

```php
add_filter('vdaily_lazy_load_images', 'disable_lazy_load_above_fold', 10, 2);
function disable_lazy_load_above_fold($enable, $context) {
    // Disable lazy loading for featured images (above the fold)
    if ($context === 'thumbnail') {
        return false;
    }
    return $enable;
}
```

---

#### `vdaily_critical_css`

Filters the critical CSS to inline in `<head>`.

**Location**: `inc/performance.php` → `vdaily_inline_critical_css()`

**Default**: Minified CSS for above-the-fold content

**Parameters**:

- `string $css` - Current critical CSS

**Returns**: `string` - Modified critical CSS

**Example**:

```php
add_filter('vdaily_critical_css', 'add_custom_critical_css');
function add_custom_critical_css($css) {
    $css .= '.custom-banner { display: block; }';
    return $css;
}
```

---

### Accessibility Filters

#### `vdaily_skip_link_text`

Filters the "Skip to content" link text.

**Location**: `header.php` → skip-to-content link

**Default**: "Skip to content"

**Parameters**:

- `string $text` - Current skip link text

**Returns**: `string` - Modified skip link text

**Example**:

```php
add_filter('vdaily_skip_link_text', 'translate_skip_link');
function translate_skip_link($text) {
    return __('Skip to main content', 'custom-domain');
}
```

---

#### `vdaily_aria_label`

Filters ARIA labels for accessibility.

**Location**: Various template files

**Default**: Context-specific labels

**Parameters**:

- `string $label` - Current ARIA label
- `string $context` - Context identifier (e.g., 'menu', 'search', 'navigation')

**Returns**: `string` - Modified ARIA label

**Example**:

```php
add_filter('vdaily_aria_label', 'custom_aria_labels', 10, 2);
function custom_aria_labels($label, $context) {
    if ($context === 'menu') {
        return 'Primary Navigation Menu';
    }
    return $label;
}
```

---

## Hook Naming Conventions

All theme hooks follow WordPress naming conventions:

**Format**: `vdaily_{context}_{action/property}`

**Examples**:

- `vdaily_before_article_content` (action)
- `vdaily_post_excerpt_length` (filter)
- `vdaily_related_posts_args` (filter)

**Prefixes**:

- `vdaily_before_*` - Action before element
- `vdaily_after_*` - Action after element
- `vdaily_*_args` - Filter WP_Query arguments
- `vdaily_*_classes` - Filter CSS classes
- `vdaily_*_text` - Filter text content

---

## Hook Priority Guidelines

**Standard Priorities**:

- `5` - Early execution (before theme defaults)
- `10` - Default priority (most hooks)
- `15` - Late execution (after theme defaults)
- `20+` - Very late execution (override everything)

**Example**:

```php
// Run before theme default (priority 10)
add_action('vdaily_before_article_content', 'my_function', 5);

// Run after theme default (priority 10)
add_action('vdaily_before_article_content', 'my_other_function', 15);
```

---

## Deprecation Policy

If a hook is deprecated in the future:

1. Mark as deprecated in code with `_deprecated_hook()`
2. Maintain backward compatibility for 2 major versions
3. Document replacement hook in deprecation notice
4. Remove in 3rd major version

**Example**:

```php
// Deprecated hook (still works)
do_action('vdaily_old_hook_name', $args);
_deprecated_hook('vdaily_old_hook_name', '2.0.0', 'vdaily_new_hook_name');

// New hook
do_action('vdaily_new_hook_name', $args);
```

---

## Testing Hooks

Child themes and plugins can test hooks using PHPUnit:

```php
class Test_VDaily_Hooks extends WP_UnitTestCase {
    public function test_before_article_content_hook() {
        $callback_fired = false;

        add_action('vdaily_before_article_content', function() use (&$callback_fired) {
            $callback_fired = true;
        });

        // Trigger the hook
        do_action('vdaily_before_article_content', 1);

        $this->assertTrue($callback_fired);
    }
}
```

---

## Common Use Cases

### Add Custom Content Between Article and Related Posts

```php
add_action('vdaily_after_article_content', 'insert_ad_block', 10, 1);
function insert_ad_block($post_id) {
    echo '<div class="ad-block"><!-- Ad code --></div>';
}
```

### Modify Related Posts Algorithm

```php
add_filter('vdaily_related_posts_args', 'prioritize_recent_posts', 10, 2);
function prioritize_recent_posts($args, $post_id) {
    $args['orderby'] = 'date';
    $args['date_query'] = array(
        array('after' => '3 months ago'),
    );
    return $args;
}
```

### Add Custom Meta Tags

```php
add_action('wp_head', 'add_custom_meta');
function add_custom_meta() {
    if (is_single()) {
        echo '<meta name="robots" content="index, follow">';
    }
}
```

### Track Code Language Usage

```php
add_action('vdaily_before_code_block', 'analytics_track_language', 10, 2);
function analytics_track_language($language, $code) {
    // Send to analytics
    if (function_exists('gtag')) {
        gtag('event', 'code_block_view', [
            'language' => $language
        ]);
    }
}
```

---

## Support & Documentation

For questions about hooks:

- Theme documentation: `README.md`
- WordPress Hook Reference: https://developer.wordpress.org/reference/hooks/
- Open issue: GitHub repository (if applicable)
