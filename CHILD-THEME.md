# Child Theme Support

VDaily Tech Blog Theme is fully compatible with WordPress child themes, allowing you to customize the theme without modifying the parent theme files.

## What is a Child Theme?

A child theme is a separate theme that inherits all functionality and styling from a parent theme. When you activate a child theme, it loads the parent theme's templates and styles first, then applies your customizations on top.

## Benefits of Using a Child Theme

1. **Update-Safe**: Customizations won't be lost when the parent theme is updated
2. **Organized**: Keep all customizations in one place
3. **Reversible**: Easy to switch back to the parent theme if needed
4. **Development-Friendly**: Test changes without affecting the parent theme
5. **Maintainable**: Clear separation between core theme and customizations

## Quick Start

We provide a sample child theme to get you started:

```bash
# Copy the sample to your themes directory
cp -r vdaily-child-theme-sample /path/to/wordpress/wp-content/themes/my-vdaily-child

# Or create a ZIP to upload via WordPress Admin
cd vdaily-child-theme-sample
zip -r vdaily-child-theme.zip .
```

Then activate the child theme in WordPress Admin → Appearance → Themes.

## Creating a Child Theme from Scratch

### Step 1: Create Directory

Create a new directory in `/wp-content/themes/` for your child theme:

```bash
mkdir wp-content/themes/vdaily-child
```

### Step 2: Create style.css

Create `style.css` with the following header (required):

```css
/*
Theme Name: VDaily Child Theme
Template: vdaily-theme
Version: 1.0.0
*/

/* Your custom styles here */
```

**Important**: The `Template:` line must match the parent theme's directory name exactly.

### Step 3: Create functions.php

Create `functions.php` to enqueue styles properly:

```php
<?php
/**
 * Enqueue parent and child theme styles
 */
function vdaily_child_enqueue_styles() {
    // Enqueue parent theme stylesheet
    wp_enqueue_style(
        'vdaily-parent-style',
        get_template_directory_uri() . '/assets/css/main.css',
        array(),
        wp_get_theme(get_template())->get('Version')
    );
    
    // Enqueue child theme stylesheet
    wp_enqueue_style(
        'vdaily-child-style',
        get_stylesheet_uri(),
        array('vdaily-parent-style'),
        wp_get_theme()->get('Version')
    );
}
add_action('wp_enqueue_scripts', 'vdaily_child_enqueue_styles', 15);
```

### Step 4: Activate

Go to WordPress Admin → Appearance → Themes and activate your child theme.

## Common Customizations

### Override Template Files

Copy any template from the parent theme to your child theme with the same directory structure:

```
Parent:  vdaily-theme/single.php
Child:   vdaily-child/single.php
```

WordPress will use the child theme version automatically.

### Add Custom Styles

Add CSS to your child theme's `style.css`:

```css
/* Change primary color */
:root {
    --color-primary: #3498db;
}

/* Customize article width */
.article-content {
    max-width: 800px;
}

/* Add custom font */
body {
    font-family: 'Georgia', serif;
}
```

### Use Theme Hooks

The parent theme provides action and filter hooks for customization:

```php
// In your child theme's functions.php

// Customize excerpt length
add_filter('vdaily_post_excerpt_length', function($length) {
    return 30;
});

// Customize reading time
add_filter('vdaily_reading_time_wpm', function($wpm) {
    return 250;
});

// Add content before articles
add_action('vdaily_before_article_content', function() {
    echo '<div class="article-notice">Custom notice</div>';
});
```

### Add Custom Functionality

```php
// In your child theme's functions.php

// Add custom post type
function vdaily_child_register_portfolio() {
    register_post_type('portfolio', array(
        'labels' => array(
            'name' => 'Portfolio',
            'singular_name' => 'Portfolio Item'
        ),
        'public' => true,
        'has_archive' => true,
    ));
}
add_action('init', 'vdaily_child_register_portfolio');

// Add custom widget area
function vdaily_child_widgets() {
    register_sidebar(array(
        'name' => 'Custom Sidebar',
        'id' => 'custom-sidebar',
    ));
}
add_action('widgets_init', 'vdaily_child_widgets');
```

## Available Hooks

### Action Hooks

| Hook | Description | Location |
|------|-------------|----------|
| `vdaily_theme_setup` | After theme setup | After theme initialization |
| `vdaily_before_article_content` | Before article content | single.php |
| `vdaily_after_article_content` | After article content | single.php |
| `vdaily_before_related_posts` | Before related posts | content-single.php |
| `vdaily_after_related_posts` | After related posts | content-single.php |
| `vdaily_enqueue_scripts` | After scripts enqueued | After asset loading |

### Filter Hooks

| Hook | Description | Default | Return Type |
|------|-------------|---------|-------------|
| `vdaily_post_excerpt_length` | Excerpt length in words | 55 | integer |
| `vdaily_reading_time_wpm` | Words per minute for reading time | 200 | integer |
| `vdaily_related_posts_count` | Number of related posts | 3 | integer |
| `vdaily_content_width` | Maximum content width | 700 | integer |
| `vdaily_meta_description` | Meta description | Auto-generated | string |
| `vdaily_schema_article` | Schema.org structured data | Array | array |

See `/specs/001-tech-blog-theme/contracts/wordpress-hooks.md` for complete hook documentation.

## Best Practices

1. **Never modify the parent theme** - Always use a child theme for customizations
2. **Use hooks when possible** - Prefer hooks over template overrides
3. **Minimize overrides** - Only override templates when necessary
4. **Version your child theme** - Track changes with version control
5. **Test after parent updates** - Verify compatibility after updating parent theme
6. **Document customizations** - Comment your code for future reference
7. **Keep dependencies minimal** - Avoid adding too many plugins or libraries

## File Structure

Typical child theme structure:

```
vdaily-child/
├── style.css              # Required: Theme header and custom styles
├── functions.php          # Recommended: Custom functions and enqueues
├── screenshot.png         # Optional: Theme screenshot (1200x900px)
├── README.md              # Optional: Documentation
├── template-parts/        # Optional: Override template parts
│   └── content/
│       └── content-single.php
├── single.php             # Optional: Override single post template
├── archive.php            # Optional: Override archive template
├── assets/                # Optional: Custom assets
│   ├── css/
│   ├── js/
│   └── images/
└── inc/                   # Optional: Custom includes
    └── custom-functions.php
```

## Troubleshooting

### Child theme not activating

**Problem**: "The parent theme is missing. Please install the 'vdaily-theme' parent theme."

**Solution**: Ensure the parent theme (VDaily Tech Blog Theme) is installed in `/wp-content/themes/vdaily-theme/`

### Styles not loading

**Problem**: Child theme styles not appearing

**Solution**: 
1. Clear browser cache and WordPress cache
2. Verify `functions.php` properly enqueues styles
3. Check that `style.css` header includes `Template: vdaily-theme`
4. Inspect page source to see if stylesheets are loaded

### Template overrides not working

**Problem**: Modified template not being used

**Solution**:
1. Verify file name matches parent theme exactly (case-sensitive)
2. Check directory structure matches parent theme
3. Clear all caches
4. Check for PHP errors in template file

### Hooks not firing

**Problem**: Custom hooks not executing

**Solution**:
1. Verify hook name matches parent theme hooks
2. Check function priority if multiple callbacks
3. Ensure parent theme version supports the hook
4. Add error logging to debug

## Examples

### Example 1: Simple Style Customization

```css
/* style.css */
/*
Theme Name: My VDaily Theme
Template: vdaily-theme
*/

/* Change colors */
:root {
    --color-primary: #2ecc71;
    --color-accent: #3498db;
}

/* Increase font size */
body {
    font-size: 18px;
}
```

### Example 2: Add Custom Header

```php
/* functions.php */
<?php
function vdaily_child_enqueue_styles() {
    wp_enqueue_style('vdaily-parent-style', 
        get_template_directory_uri() . '/assets/css/main.css');
    wp_enqueue_style('vdaily-child-style', 
        get_stylesheet_uri(), 
        array('vdaily-parent-style'));
}
add_action('wp_enqueue_scripts', 'vdaily_child_enqueue_styles', 15);

function vdaily_child_custom_header() {
    ?>
    <div class="custom-announcement">
        Important announcement here!
    </div>
    <?php
}
add_action('wp_body_open', 'vdaily_child_custom_header');
```

### Example 3: Override Single Post Template

```php
/* single.php - copied from parent and modified */
<?php
get_header();

while (have_posts()) : the_post();
    // Add custom message before content
    echo '<div class="custom-intro">Welcome to my article!</div>';
    
    // Display the post content
    get_template_part('template-parts/content/content', 'single');
    
    // Add custom message after content
    echo '<div class="custom-outro">Thanks for reading!</div>';
endwhile;

get_footer();
```

## Resources

- [WordPress Child Theme Documentation](https://developer.wordpress.org/themes/advanced-topics/child-themes/)
- [Theme Handbook](https://developer.wordpress.org/themes/)
- [Template Hierarchy](https://developer.wordpress.org/themes/basics/template-hierarchy/)
- [Plugin API/Action Reference](https://codex.wordpress.org/Plugin_API/Action_Reference)
- [Plugin API/Filter Reference](https://codex.wordpress.org/Plugin_API/Filter_Reference)

## Support

For child theme support:
- Sample child theme: See `vdaily-child-theme-sample/`
- Parent theme issues: [GitHub Issues](https://github.com/npv2k1/vdaily-theme/issues)
- WordPress forums: [WordPress.org Support](https://wordpress.org/support/)

## License

Child themes inherit the license from the parent theme (GPL v2 or later).
