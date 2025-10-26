# Quickstart Guide: VDaily Tech Blog Theme

**Date**: October 26, 2025  
**Version**: 1.0.0  
**Feature Branch**: `001-tech-blog-theme`

## Overview

VDaily is a modern WordPress theme optimized for technical blogs. This guide helps developers get started with theme development, testing, and deployment.

---

## Prerequisites

### Required Software

- **PHP**: 8.0 or higher
- **WordPress**: 6.0 or higher
- **Node.js**: 18.x or higher (for build tools)
- **npm**: 9.x or higher
- **Composer**: 2.x or higher (for PHP dependencies)
- **Git**: 2.x or higher

### Recommended Tools

- **Local Development**: Local by Flywheel, XAMPP, or MAMP
- **Code Editor**: VS Code with PHP and WordPress extensions
- **Browser**: Chrome/Firefox with DevTools
- **Testing**: Lighthouse, axe DevTools (browser extensions)

---

## Installation

### 1. Clone Repository

```bash
git clone <repository-url> vdaily-theme
cd vdaily-theme
git checkout 001-tech-blog-theme
```

### 2. Install Dependencies

```bash
# Install Node dependencies (for build tools)
npm install

# Install Composer dependencies (if any)
composer install
```

### 3. Build Assets

```bash
# Development build (unminified, with source maps)
npm run dev

# Production build (minified, optimized)
npm run build

# Watch mode (auto-rebuild on file changes)
npm run watch
```

### 4. Install in WordPress

**Option A: Symlink (Development)**

```bash
# Create symlink from WordPress themes directory
ln -s /path/to/vdaily-theme /path/to/wordpress/wp-content/themes/vdaily-theme
```

**Option B: Copy Files**

```bash
# Copy entire theme directory
cp -r /path/to/vdaily-theme /path/to/wordpress/wp-content/themes/
```

**Option C: ZIP Upload**

```bash
# Create ZIP file
zip -r vdaily-theme.zip vdaily-theme/ -x "*.git*" "node_modules/*" "src/*"

# Upload via WordPress Admin → Appearance → Themes → Add New → Upload
```

### 5. Activate Theme

1. Log in to WordPress admin
2. Navigate to **Appearance → Themes**
3. Find "VDaily" theme
4. Click **Activate**

---

## Project Structure

```
vdaily-theme/
├── assets/              # Compiled assets (output)
│   ├── css/            # Compiled stylesheets
│   ├── js/             # Compiled JavaScript
│   └── images/         # Theme images
│
├── inc/                # PHP includes
│   ├── setup.php       # Theme setup functions
│   ├── enqueue.php     # Asset enqueuing
│   ├── template-tags.php  # Custom template functions
│   ├── customizer.php  # Theme customizer
│   ├── seo.php         # SEO features
│   ├── performance.php # Performance optimizations
│   └── code-highlighting.php  # Syntax highlighting
│
├── src/                # Source files (input for build)
│   ├── scss/           # SCSS source
│   └── js/             # JavaScript source
│
├── template-parts/     # Reusable template components
│   ├── content/        # Content templates
│   ├── navigation/     # Navigation templates
│   └── components/     # Smaller components
│
├── tests/              # Automated tests
│   ├── php/            # PHPUnit tests
│   ├── js/             # Jest tests
│   └── lighthouse/     # Performance tests
│
├── functions.php       # Main theme functions file
├── style.css           # Theme header/metadata
├── index.php           # Main template file
├── single.php          # Single post template
├── archive.php         # Archive template
├── header.php          # Header template
├── footer.php          # Footer template
├── package.json        # npm configuration
├── webpack.config.js   # Build configuration
└── README.md           # Documentation
```

---

## Development Workflow

### 1. Start Development Server

```bash
# Start WordPress local development environment
# (Using Local by Flywheel, XAMPP, etc.)

# Start asset watch mode
npm run watch
```

### 2. Make Changes

**Editing Styles**:

```bash
# Edit SCSS files in src/scss/
src/scss/_variables.scss    # CSS variables, colors
src/scss/_typography.scss   # Font settings
src/scss/_layout.scss       # Grid, layout
src/scss/_components.scss   # Component styles
src/scss/_code.scss         # Code block styles
```

**Editing JavaScript**:

```bash
# Edit JS files in src/js/
src/js/main.js              # Main JavaScript
src/js/code-copy.js         # Copy code functionality
src/js/reading-progress.js  # Reading progress bar
src/js/navigation.js        # Mobile navigation
```

**Editing PHP**:

```bash
# Edit theme template files and includes
inc/setup.php               # Theme configuration
inc/seo.php                 # SEO functions
template-parts/             # Template components
```

### 3. Test Changes

```bash
# Run PHP linting
npm run lint:php

# Run JavaScript linting
npm run lint:js

# Run CSS linting
npm run lint:css

# Run all linters
npm run lint

# Run PHP unit tests
npm run test:php

# Run JavaScript unit tests
npm run test:js

# Run Lighthouse performance tests
npm run test:lighthouse
```

### 4. Build for Production

```bash
# Create optimized production build
npm run build

# Build also runs automatically:
# - SCSS compilation
# - JavaScript bundling
# - Minification
# - Asset optimization
```

---

## Configuration

### Environment Variables

Create `.env` file in theme root (optional):

```bash
# Development mode
WP_ENV=development

# Asset URLs
ASSET_URL=http://localhost:8000/wp-content/themes/vdaily-theme

# API keys (if needed)
GOOGLE_ANALYTICS_ID=UA-XXXXXX-X
```

### Webpack Configuration

Edit `webpack.config.js` to customize build:

```javascript
module.exports = {
  entry: {
    main: "./src/js/main.js",
    "code-copy": "./src/js/code-copy.js",
  },
  output: {
    path: path.resolve(__dirname, "assets/js"),
    filename: "[name].js",
  },
  // ... more configuration
};
```

### PHP Configuration

Edit `inc/setup.php` for theme setup:

```php
function vdaily_setup() {
    // Add theme support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');

    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'vdaily-theme'),
    ));

    // Add image sizes
    add_image_size('vdaily-featured', 1200, 630, true);
}
add_action('after_setup_theme', 'vdaily_setup');
```

---

## Testing

### PHP Unit Tests (PHPUnit)

```bash
# Run all PHP tests
npm run test:php

# Run specific test file
./vendor/bin/phpunit tests/php/test-setup.php

# Run with coverage
./vendor/bin/phpunit --coverage-html coverage/
```

### JavaScript Tests (Jest)

```bash
# Run all JavaScript tests
npm run test:js

# Run in watch mode
npm run test:js:watch

# Run with coverage
npm run test:js -- --coverage
```

### Performance Testing (Lighthouse)

```bash
# Run Lighthouse CI
npm run test:lighthouse

# This will:
# 1. Build production assets
# 2. Start local server (if needed)
# 3. Run Lighthouse on key pages
# 4. Generate performance report
```

### Accessibility Testing

```bash
# Run axe-core accessibility tests
npm run test:a11y

# Manual testing:
# 1. Install axe DevTools browser extension
# 2. Open theme pages in browser
# 3. Run axe scan
# 4. Fix reported issues
```

### Manual Testing Checklist

- [ ] Test on Chrome, Firefox, Safari, Edge (latest versions)
- [ ] Test responsive design (320px, 768px, 1024px, 1920px)
- [ ] Test keyboard navigation (Tab, Enter, Escape)
- [ ] Test with JavaScript disabled
- [ ] Test with screen reader (NVDA, JAWS, or VoiceOver)
- [ ] Test print stylesheet
- [ ] Test code block copy functionality
- [ ] Test reading progress indicator
- [ ] Test related posts
- [ ] Test search functionality
- [ ] Test social sharing meta tags (Facebook Debugger, Twitter Card Validator)

---

## Customization

### Adding Custom Colors

```php
// In functions.php or child theme
function custom_theme_colors() {
    // Override default colors
    add_filter('vdaily_primary_color', function() {
        return '#2c3e50';
    });
}
add_action('after_setup_theme', 'custom_theme_colors');
```

### Adding Custom Template

```php
// Create custom page template
// File: template-custom.php

<?php
/**
 * Template Name: Custom Template
 */

get_header();
// Custom content here
get_footer();
```

### Extending Functionality

```php
// Add custom function via hooks
function add_custom_content_after_post($post_id) {
    echo '<div class="custom-content">Custom content here</div>';
}
add_action('vdaily_after_article_content', 'add_custom_content_after_post');
```

---

## Common Tasks

### Adding a New Page Template

1. Create file in theme root: `template-{name}.php`
2. Add template header comment:
   ```php
   <?php
   /**
    * Template Name: {Name}
    */
   ```
3. Use template in Pages → Edit → Template dropdown

### Adding Custom Widget Area

```php
// In inc/setup.php
function vdaily_register_custom_sidebar() {
    register_sidebar(array(
        'name' => __('Custom Sidebar', 'vdaily-theme'),
        'id' => 'custom-sidebar',
        'description' => __('Custom widget area', 'vdaily-theme'),
        'before_widget' => '<div class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}
add_action('widgets_init', 'vdaily_register_custom_sidebar');
```

### Adding Custom Post Type

```php
// In functions.php or custom plugin
function vdaily_register_custom_post_type() {
    register_post_type('portfolio', array(
        'public' => true,
        'label' => 'Portfolio',
        'supports' => array('title', 'editor', 'thumbnail'),
    ));
}
add_action('init', 'vdaily_register_custom_post_type');
```

### Modifying Excerpt Length

```php
// Override default excerpt length
function custom_excerpt_length($length) {
    return 200; // characters
}
add_filter('vdaily_post_excerpt_length', 'custom_excerpt_length');
```

---

## Deployment

### Prepare for Production

```bash
# 1. Run production build
npm run build

# 2. Run all tests
npm run test

# 3. Verify no errors/warnings
npm run lint

# 4. Check file sizes
ls -lh assets/css/
ls -lh assets/js/
```

### Create Distribution Package

```bash
# Create ZIP excluding development files
zip -r vdaily-theme-v1.0.0.zip vdaily-theme/ \
  -x "*.git*" \
  -x "node_modules/*" \
  -x "src/*" \
  -x "tests/*" \
  -x ".env" \
  -x "webpack.config.js" \
  -x "package.json" \
  -x "composer.json"
```

### Upload to Production

**Option 1: FTP/SFTP**

```bash
# Upload via FTP client to:
# /wp-content/themes/vdaily-theme/
```

**Option 2: WordPress Admin**

```bash
# Upload ZIP via:
# Appearance → Themes → Add New → Upload Theme
```

**Option 3: Git Deployment**

```bash
# SSH into server
cd /path/to/wordpress/wp-content/themes/
git clone <repository-url> vdaily-theme
cd vdaily-theme
npm install
npm run build
```

### Post-Deployment Checklist

- [ ] Activate theme in WordPress admin
- [ ] Configure customizer settings
- [ ] Assign menus
- [ ] Add widgets (if needed)
- [ ] Set homepage (Settings → Reading)
- [ ] Test all pages
- [ ] Run Lighthouse audit
- [ ] Verify social sharing meta tags
- [ ] Submit sitemap to Google Search Console

---

## Troubleshooting

### Build Errors

**Error: `npm install` fails**

```bash
# Clear npm cache
npm cache clean --force

# Delete node_modules and package-lock.json
rm -rf node_modules package-lock.json

# Reinstall
npm install
```

**Error: Webpack build fails**

```bash
# Check Node version
node --version  # Should be 18.x+

# Update webpack
npm update webpack webpack-cli
```

### WordPress Errors

**Error: Theme styles not loading**

```php
// Check asset URLs in browser DevTools
// Verify path in inc/enqueue.php:
wp_enqueue_style('vdaily-style', get_stylesheet_directory_uri() . '/assets/css/main.css');
```

**Error: PHP warnings/errors**

```bash
# Enable WordPress debugging
# In wp-config.php:
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);

# Check debug.log:
tail -f wp-content/debug.log
```

### Performance Issues

**Issue: Slow page load**

```bash
# 1. Check Lighthouse report
npm run test:lighthouse

# 2. Enable caching in customizer
# Performance → Enable Lazy Loading
# Performance → Serve WebP Images

# 3. Use caching plugin
# Install: WP Super Cache or W3 Total Cache
```

**Issue: Large file sizes**

```bash
# Check asset sizes
ls -lh assets/css/
ls -lh assets/js/

# Optimize images
# Use: ImageOptim, TinyPNG, or Squoosh

# Verify minification
npm run build
```

---

## Resources

### Documentation

- **Theme Docs**: `README.md` in theme root
- **WordPress Codex**: https://codex.wordpress.org/
- **WordPress Theme Handbook**: https://developer.wordpress.org/themes/
- **WordPress Code Reference**: https://developer.wordpress.org/reference/

### Contracts & Specifications

- [Data Model](./data-model.md) - WordPress entities and relationships
- [WordPress Hooks](./contracts/wordpress-hooks.md) - Theme actions and filters
- [Template Parts](./contracts/template-parts.md) - Reusable template components
- [Customizer API](./contracts/customizer-api.md) - Theme customizer settings

### Testing Tools

- **Lighthouse**: https://developers.google.com/web/tools/lighthouse
- **axe DevTools**: https://www.deque.com/axe/devtools/
- **WAVE**: https://wave.webaim.org/
- **Google Rich Results Test**: https://search.google.com/test/rich-results
- **Facebook Sharing Debugger**: https://developers.facebook.com/tools/debug/
- **Twitter Card Validator**: https://cards-dev.twitter.com/validator

### Support

- **Issues**: Open issue in GitHub repository
- **Discussions**: WordPress Support Forums
- **Documentation**: Theme README.md

---

## Quick Command Reference

```bash
# Development
npm install              # Install dependencies
npm run dev              # Development build
npm run watch            # Watch mode
npm run build            # Production build

# Testing
npm run lint             # Run all linters
npm run lint:php         # PHP linting
npm run lint:js          # JavaScript linting
npm run lint:css         # CSS linting
npm run test             # Run all tests
npm run test:php         # PHP unit tests
npm run test:js          # JavaScript tests
npm run test:lighthouse  # Performance tests

# Utilities
npm run clean            # Clean build artifacts
npm run format           # Format code
npm run validate         # Validate theme structure
```

---

## Next Steps

1. **Review documentation**: Read through [data-model.md](./data-model.md) and [contracts/](./contracts/)
2. **Explore code**: Browse PHP files in `inc/` and templates in `template-parts/`
3. **Make changes**: Edit SCSS in `src/scss/` and test with `npm run watch`
4. **Run tests**: Ensure everything works with `npm run test`
5. **Deploy**: Build production version with `npm run build`

Happy coding! 🚀
