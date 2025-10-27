# VDaily Child Theme Sample

This is a sample child theme for the VDaily Tech Blog Theme. Use this as a starting point to create your own customizations without modifying the parent theme.

## What is a Child Theme?

A child theme is a WordPress theme that inherits all the functionality and styling of another theme (the parent theme). Child themes allow you to customize a theme without modifying the parent theme's files, making it easier to update the parent theme without losing your customizations.

## Installation

### Method 1: Upload via WordPress Admin

1. Compress the `vdaily-child-theme-sample` folder into a ZIP file
2. Go to WordPress Admin → Appearance → Themes → Add New → Upload Theme
3. Upload the ZIP file and click Install
4. Activate the child theme
5. **Important**: Make sure the parent theme (VDaily Tech Blog Theme) is also installed

### Method 2: Manual Installation

1. Copy the `vdaily-child-theme-sample` folder to `/wp-content/themes/` directory
2. Rename the folder to your preferred name (e.g., `vdaily-child-theme`)
3. Go to WordPress Admin → Appearance → Themes
4. Activate the child theme
5. **Important**: Make sure the parent theme (VDaily Tech Blog Theme) is also installed

## Customization

### 1. Basic Information

Edit the `style.css` header to change:
- Theme Name
- Description
- Author information
- Version

### 2. Custom Styles

Add your custom CSS to `style.css` after the header comments. The parent theme styles are automatically inherited, so you only need to add or override specific styles.

Example:
```css
/* Change primary color */
:root {
    --color-primary: #3498db;
}

/* Customize article layout */
.article-content {
    max-width: 800px;
}
```

### 3. Custom Functions

Use `functions.php` to add custom functionality or override parent theme functions. Several examples are included with commented code.

Common customizations:
- Change excerpt length
- Modify reading time calculation
- Add custom header/footer code
- Register additional menus or widget areas
- Add custom post types or taxonomies

### 4. Template Overrides

To override a parent theme template:

1. Copy the template file from the parent theme to your child theme
2. Maintain the same directory structure
3. Modify the copied file as needed

Example:
- Parent: `vdaily-theme/single.php`
- Child: `vdaily-child-theme/single.php`

WordPress will automatically use the child theme version.

### 5. Using Parent Theme Hooks

The parent theme provides numerous hooks for customization:

**Action Hooks:**
```php
// After theme setup
add_action('vdaily_theme_setup', 'your_custom_function');

// Before/after article content
add_action('vdaily_before_article_content', 'your_function');
add_action('vdaily_after_article_content', 'your_function');
```

**Filter Hooks:**
```php
// Customize excerpt length
add_filter('vdaily_post_excerpt_length', function($length) {
    return 30;
});

// Customize reading time
add_filter('vdaily_reading_time_wpm', function($wpm) {
    return 250;
});
```

## File Structure

```
vdaily-child-theme/
├── style.css          # Child theme stylesheet (required)
├── functions.php      # Child theme functions (optional but recommended)
├── screenshot.png     # Theme screenshot (optional)
├── README.md          # This file
└── [template files]   # Override parent templates as needed
```

## Best Practices

1. **Never modify the parent theme** - All customizations should be in the child theme
2. **Use hooks when possible** - Prefer hooks over template overrides
3. **Keep it minimal** - Only override what you need to change
4. **Comment your code** - Document your customizations for future reference
5. **Test after updates** - Test your site after updating the parent theme
6. **Use version control** - Track your child theme changes with Git

## Common Customization Examples

### Change Site Colors

```css
/* In style.css */
:root {
    --color-primary: #2c3e50;
    --color-accent: #e74c3c;
    --color-text: #333333;
    --color-background: #ffffff;
}
```

### Add Custom Logo Size

```php
/* In functions.php */
function vdaily_child_logo_size($args) {
    $args['height'] = 150;
    $args['width'] = 500;
    return $args;
}
add_filter('vdaily_custom_logo_args', 'vdaily_child_logo_size');
```

### Modify Content Width

```php
/* In functions.php */
function vdaily_child_content_width() {
    return 800; // pixels
}
add_filter('vdaily_content_width', 'vdaily_child_content_width');
```

### Add Custom CSS for Code Blocks

```css
/* In style.css */
.code-block {
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}
```

## Troubleshooting

### Styles Not Loading

1. Clear your browser cache
2. Clear WordPress cache (if using a caching plugin)
3. Check that parent theme is installed and activated
4. Verify the `Template:` header in style.css matches the parent theme directory name

### Functions Not Working

1. Check for PHP errors in debug log
2. Ensure functions.php has proper PHP opening tag
3. Verify hook names match parent theme hooks
4. Check function priority if hooking into existing actions

### Template Not Overriding

1. Verify file name matches parent theme exactly
2. Check directory structure matches parent theme
3. Clear all caches
4. Ensure no syntax errors in template file

## Support

For questions about the parent theme:
- Parent Theme Documentation: See VDaily Theme README
- GitHub Issues: https://github.com/npv2k1/vdaily-theme/issues

For child theme specific help:
- WordPress Codex: [Child Themes](https://developer.wordpress.org/themes/advanced-topics/child-themes/)
- WordPress Support Forums

## License

This child theme inherits the license from the parent theme:
GNU General Public License v2 or later
http://www.gnu.org/licenses/gpl-2.0.html

## Changelog

### Version 1.0.0
- Initial child theme release
- Basic structure and example customizations
- Comprehensive documentation
