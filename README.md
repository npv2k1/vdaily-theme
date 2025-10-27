# VDaily Tech Blog Theme

A modern WordPress theme optimized for technical blogs with focus on exceptional readability, minimal design, SEO performance, and developer-friendly code display.

## Features

- **Readability First**: Optimal line width (600-750px), comfortable font sizes (16px+), high contrast (4.5:1)
- **SEO Optimized**: Open Graph tags, Schema.org markup, performance score 90+
- **Code-Friendly**: Syntax highlighting for 20+ programming languages with copy buttons
- **Minimal Design**: Clean layout, limited color palette, ample white space
- **Accessible**: WCAG 2.1 AA compliant, keyboard navigation, ARIA labels
- **Performance**: Lazy loading, optimized assets, minified files, caching

## Requirements

- WordPress 6.0 or higher
- PHP 8.0 or higher
- Node.js 18.x or higher (for development)

## Installation

### Quick Install

1. Download the theme ZIP file
2. Go to WordPress Admin → Appearance → Themes → Add New → Upload Theme
3. Upload the ZIP file and click Install
4. Activate the theme

### Manual Install

1. Clone or download this repository
2. Copy the theme folder to `/wp-content/themes/`
3. Go to WordPress Admin → Appearance → Themes
4. Activate "VDaily Tech Blog Theme"

## Development

### Docker Development (Recommended)

The easiest way to develop and preview the theme is using Docker Compose:

```bash
# Copy environment file
cp .env.example .env

# Start WordPress with the theme
docker-compose up -d

# Access WordPress at http://localhost:8080
# Access phpMyAdmin at http://localhost:8081
```

See [DOCKER.md](DOCKER.md) for complete Docker setup documentation.

### Local Development

If you prefer local development without Docker:

#### Prerequisites

```bash
node -v  # Should be 18.x or higher
npm -v   # Should be 9.x or higher
```

#### Setup

```bash
# Install dependencies
npm install

# Development build (with source maps)
npm run dev

# Production build (minified)
npm run build

# Watch mode (auto-rebuild on changes)
npm run watch
```

### Project Structure

```
vdaily-theme/
├── assets/              # Compiled assets (output)
│   ├── css/            # Compiled stylesheets
│   └── js/             # Compiled JavaScript
├── inc/                # PHP includes
│   ├── setup.php       # Theme setup
│   ├── enqueue.php     # Asset enqueuing
│   ├── template-tags.php  # Custom functions
│   ├── customizer.php  # Theme customizer
│   ├── seo.php         # SEO features
│   ├── performance.php # Performance optimizations
│   ├── accessibility.php  # Accessibility features
│   └── code-highlighting.php  # Syntax highlighting
├── src/                # Source files (input for build)
│   ├── scss/           # SCSS source
│   └── js/             # JavaScript source
├── template-parts/     # Reusable template components
│   ├── content/        # Content templates
│   ├── navigation/     # Navigation templates
│   └── components/     # Smaller components
├── functions.php       # Main theme functions file
├── style.css           # Theme header/metadata
└── *.php               # Template files
```

## Customization

### Theme Customizer

Go to WordPress Admin → Appearance → Customize to access:

- **Color Scheme**: Primary color, accent color, code background
- **Layout**: Content width, sidebar position, archive layout
- **Code Display**: Syntax theme, line numbers, code font size
- **Content Options**: Excerpt length, related posts count, reading time
- **Social Media**: Twitter handle, Facebook page, default OG image

### Custom Colors

```php
// In functions.php or child theme
add_filter('vdaily_primary_color', function() {
    return '#2c3e50';
});
```

### Custom Hooks

The theme provides numerous hooks for customization. See `/specs/001-tech-blog-theme/contracts/wordpress-hooks.md` for full documentation.

**Action Hooks:**
- `vdaily_theme_setup` - After theme setup
- `vdaily_before_article_content` - Before article content
- `vdaily_after_article_content` - After article content
- `vdaily_before_related_posts` - Before related posts
- `vdaily_after_related_posts` - After related posts

**Filter Hooks:**
- `vdaily_post_excerpt_length` - Excerpt length
- `vdaily_reading_time_wpm` - Words per minute for reading time
- `vdaily_related_posts_count` - Number of related posts
- `vdaily_meta_description` - Meta description
- `vdaily_schema_article` - Schema.org structured data

## Performance

### Optimization Tips

1. **Use a caching plugin**: WP Super Cache or W3 Total Cache
2. **Enable lazy loading**: Enabled by default in theme
3. **Optimize images**: Use WebP format, compress images
4. **Minimize plugins**: Only use essential plugins
5. **Use CDN**: Consider Cloudflare or similar

### Performance Features

- Lazy loading for images
- Minified CSS and JavaScript
- Async script loading
- Optimized database queries
- Transient caching for expensive operations

## Accessibility

The theme meets WCAG 2.1 Level AA standards:

- Semantic HTML5 markup
- Keyboard navigation support
- ARIA labels and roles
- Skip to content link
- High contrast ratios (4.5:1 minimum)
- Focus indicators for all interactive elements
- Screen reader friendly

## Browser Support

- Chrome (latest 2 versions)
- Firefox (latest 2 versions)
- Safari (latest 2 versions)
- Edge (latest 2 versions)

## License

This theme is licensed under the GNU General Public License v2 or later.

## Credits

- **Syntax Highlighting**: Prism.js
- **Icons**: Built-in emoji icons
- **Fonts**: System font stack for performance

## Support

- **Documentation**: See `/specs/001-tech-blog-theme/` directory
- **Issues**: Report bugs on GitHub repository
- **WordPress Forums**: WordPress.org theme support

## Changelog

### Version 1.0.0 (2025-10-26)
- Initial release
- Modern tech blog theme with full feature set
- SEO optimized with Schema.org markup
- Syntax highlighting for 20+ languages
- WCAG 2.1 AA accessible
- Performance optimized (Lighthouse 90+)

## Release Process

### Automated Releases via GitHub Actions

The theme uses GitHub Actions to automatically build and release clean theme archives:

1. **Create a version tag**: `git tag -a v1.0.0 -m "Release version 1.0.0"`
2. **Push the tag**: `git push origin v1.0.0`
3. **GitHub Actions will**:
   - Install dependencies
   - Build production assets
   - Create a clean theme archive (excluding dev files)
   - Publish as a GitHub release

The released archive will contain only WordPress theme files - no git, specs, node_modules, or development files.

### Manual Build for Testing

You can build the theme archive locally for testing:

```bash
# Build with version number
./build-theme.sh 1.0.0

# Build with default "dev" version
./build-theme.sh

# The archive will be created in: build/vdaily-theme-{version}.zip
```

The build script:
- Installs dependencies
- Builds production assets (webpack)
- Creates a clean theme archive
- Excludes all development files

## Contributing

Contributions are welcome! Please read the contribution guidelines before submitting pull requests.

## Author

VDaily Team

---

**Note**: This theme is designed for technical blogs. For other use cases, consider customization or a different theme.
