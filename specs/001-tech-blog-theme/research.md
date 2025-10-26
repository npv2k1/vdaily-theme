# Research: Modern Tech Blog WordPress Theme

**Phase**: 0 - Outline & Research  
**Date**: October 26, 2025  
**Feature**: [spec.md](./spec.md) | [plan.md](./plan.md)

## Overview

This document consolidates research findings for building a modern WordPress theme optimized for technical blogs. Key areas researched: syntax highlighting solutions, performance optimization techniques, SEO best practices, accessibility requirements, and WordPress theme development standards.

## Research Areas

### 1. Syntax Highlighting Solutions

**Decision**: Use Prism.js for client-side syntax highlighting

**Rationale**:

- **Lightweight**: Prism.js core is ~2KB gzipped, supports 20+ languages with additional plugins
- **Extensible**: Modular architecture allows loading only needed languages
- **Customizable**: Multiple themes available, CSS-based styling for easy customization
- **Performance**: Client-side highlighting with async loading doesn't block page rendering
- **WordPress Integration**: Easy to enqueue via `wp_enqueue_script()`, works with Gutenberg code blocks
- **Copy Button Plugin**: Prism has official copy-to-clipboard plugin
- **Line Numbers**: Built-in line numbers plugin available

**Alternatives Considered**:

- **Highlight.js**: More languages (191 vs Prism's 270+), but larger bundle size (~23KB core)
  - Rejected: Bundle size impact on performance metrics (Lighthouse score requirement)
- **Server-side highlighting (PHP)**: Using libraries like GeSHi or php-highlight
  - Rejected: Increases server processing time, harder to update themes, limited customization
- **WordPress Gutenberg native**: Basic highlighting in code blocks
  - Rejected: Limited language support, no line numbers, no copy button out of box

**Implementation Notes**:

- Load Prism.js asynchronously after page content
- Use intersection observer to highlight code blocks only when visible
- Bundle common languages (JS, Python, PHP, HTML, CSS) in main bundle
- Lazy load specialized languages (Rust, Go, etc.) on demand
- CDN fallback for performance: jsDelivr or cdnjs

### 2. Performance Optimization Techniques

**Decision**: Multi-layered performance strategy using WordPress best practices, modern CSS, and progressive enhancement

**Rationale**:

- **Critical CSS**: Inline critical above-the-fold CSS (~14KB limit), defer non-critical styles
- **Resource Hints**: Use `dns-prefetch`, `preconnect` for external resources
- **Image Optimization**: WordPress native lazy loading (loading="lazy"), WebP with JPEG/PNG fallback via `<picture>` element
- **JavaScript Strategy**: Defer non-critical JS, use `async` for third-party scripts, minimize main thread blocking
- **Asset Minification**: Webpack for CSS/JS bundling and minification
- **HTTP/2 Push**: Leverage WordPress support for HTTP/2 server push for critical assets
- **Database Queries**: Use WordPress transients API for caching expensive queries (related posts, etc.)
- **No jQuery Dependency**: Use vanilla JavaScript to avoid 30KB+ jQuery overhead

**Alternatives Considered**:

- **Full Static Site Generation**: Pre-render all pages as static HTML
  - Rejected: Loses WordPress CMS benefits, complex update workflow, not suitable for dynamic content
- **Service Worker Caching**: Aggressive offline-first caching
  - Rejected: Complexity vs benefit for blog use case, cache invalidation challenges
- **AMP (Accelerated Mobile Pages)**: Google's AMP framework
  - Rejected: Restrictive markup limitations, diminishing SEO benefits, poor developer experience

**Key Metrics to Monitor**:

- First Contentful Paint (FCP): Target <1.5s
- Largest Contentful Paint (LCP): Target <2.5s
- Cumulative Layout Shift (CLS): Target <0.1
- Time to Interactive (TTI): Target <3.5s
- Total Blocking Time (TBT): Target <200ms

### 3. SEO Best Practices for WordPress Themes

**Decision**: Built-in SEO features following Schema.org standards and Open Graph protocol, avoiding third-party SEO plugins

**Rationale**:

- **Structured Data**: Implement Schema.org Article markup natively using JSON-LD format
  - Required properties: headline, image, datePublished, dateModified, author, publisher
  - WordPress post data maps directly to Schema properties
- **Meta Tags**: Generate meta descriptions from post excerpts (150-160 char limit)
- **Open Graph**: Implement og:title, og:description, og:image, og:type, og:url for social sharing
  - Use WordPress featured images for og:image with 1200x630px recommended size
- **Semantic HTML**: Use HTML5 semantic elements (`<article>`, `<header>`, `<nav>`, etc.)
- **Heading Hierarchy**: Enforce single H1 per page (post title), proper heading nesting
- **Sitemap**: WordPress core (5.5+) generates XML sitemaps automatically
- **Performance = SEO**: Fast loading times directly impact search rankings

**Alternatives Considered**:

- **Yoast SEO Plugin**: Most popular WordPress SEO plugin
  - Rejected: Adds overhead, feature bloat for theme use case, users can still install if desired
- **Rank Math**: Newer SEO plugin with AI features
  - Rejected: Same reasoning as Yoast, theme should be plugin-agnostic
- **All-in-One SEO**: Another popular alternative
  - Rejected: Theme should provide baseline SEO, let users choose plugins

**Implementation Notes**:

- Hook into `wp_head` to inject meta tags and structured data
- Use WordPress functions: `get_the_excerpt()`, `get_the_post_thumbnail_url()`, `get_the_author_meta()`
- Provide theme customizer options for social media defaults (Twitter handle, Facebook page)
- Validate structured data using Google Rich Results Test

### 4. Accessibility Requirements (WCAG 2.1 Level AA)

**Decision**: Implement comprehensive accessibility features following WCAG 2.1 Level AA guidelines

**Rationale**:

- **Color Contrast**: Minimum 4.5:1 for normal text, 3:1 for large text (18pt+/14pt+ bold)
  - Use tools: WebAIM Contrast Checker, Chrome DevTools
- **Keyboard Navigation**: All interactive elements accessible via keyboard
  - Visible focus indicators (outline or custom styling)
  - Skip-to-content link for keyboard users
  - Logical tab order following visual flow
- **ARIA Labels**: Proper roles, states, and properties
  - `role="navigation"`, `role="search"`, `role="main"`
  - `aria-label` for icon buttons (search, menu toggle)
  - `aria-current="page"` for current navigation item
- **Semantic HTML**: Use correct elements for their purpose
  - `<nav>` for navigation, `<main>` for main content, `<aside>` for sidebars
- **Form Labels**: All inputs have associated `<label>` elements
- **Alt Text**: Require alt text for images via WordPress media uploader
- **Focus Management**: Manage focus for dynamic content (mobile menu, modals)
- **Motion Preferences**: Respect `prefers-reduced-motion` media query

**Alternatives Considered**:

- **WCAG 2.1 Level AAA**: Highest accessibility standard
  - Rejected: Level AA is industry standard, AAA can be restrictive for design, AA meets legal requirements
- **Accessibility Plugin Dependency**: Rely on accessibility plugins
  - Rejected: Accessibility should be built-in, not optional

**Testing Strategy**:

- Automated: axe DevTools, WAVE, Lighthouse accessibility audit
- Manual: Keyboard navigation testing, screen reader testing (NVDA, JAWS, VoiceOver)
- Checklist: WebAIM WCAG 2.1 Checklist

### 5. WordPress Theme Development Standards

**Decision**: Follow WordPress coding standards and best practices for theme development

**Rationale**:

- **Template Hierarchy**: Use WordPress template hierarchy for organization
  - `index.php` (fallback), `single.php` (single posts), `archive.php` (archives), `page.php` (pages)
- **Template Tags**: Use WordPress functions for data retrieval
  - `the_title()`, `the_content()`, `get_template_part()`, `wp_nav_menu()`
- **Hooks and Filters**: Provide extensibility via WordPress hooks
  - Actions: `after_setup_theme`, `wp_enqueue_scripts`, `widgets_init`
  - Filters: `the_content`, `excerpt_length`, `body_class`
- **Theme Support**: Declare theme features via `add_theme_support()`
  - `post-thumbnails`, `title-tag`, `custom-logo`, `html5`, `responsive-embeds`
- **Customizer API**: Use Theme Customizer for user settings
  - Color schemes, typography options, layout settings
- **Internationalization**: Use `__()`, `_e()` for translatable strings
  - Text domain: `vdaily-theme`
- **Security**: Escape output, sanitize input
  - `esc_html()`, `esc_attr()`, `esc_url()`, `wp_kses_post()`, `sanitize_text_field()`
- **Enqueuing**: Proper script/style registration and enqueuing
  - `wp_register_script()`, `wp_enqueue_style()` with dependencies and versions

**Alternatives Considered**:

- **Headless WordPress**: Decouple WordPress backend from frontend
  - Rejected: Complexity overhead, loses theme ecosystem benefits, requires JavaScript framework
- **Block Theme (FSE)**: Full Site Editing block-based themes
  - Rejected: FSE still maturing, traditional PHP themes more stable and flexible for this use case
- **Theme Framework**: Use framework like Genesis or Underscores
  - Rejected: Want full control, avoid framework overhead, custom implementation more educational

**Key Resources**:

- WordPress Theme Handbook: https://developer.wordpress.org/themes/
- WordPress Coding Standards: https://developer.wordpress.org/coding-standards/
- Theme Review Guidelines: https://make.wordpress.org/themes/handbook/review/

### 6. Code Block Features & Patterns

**Decision**: Implement collapsible long code blocks, language indicators, and copy functionality

**Rationale**:

- **Collapsible Blocks**: Use `<details>` and `<summary>` HTML elements for long code (500+ lines)
  - Progressive enhancement: Works without JavaScript
  - Accessible: Native browser support for keyboard navigation
- **Language Badges**: Display programming language in top-right corner of code blocks
  - Extract from Gutenberg block attributes or class names (e.g., `language-javascript`)
- **Copy Button**: JavaScript-based clipboard API
  - Fallback: `document.execCommand('copy')` for older browsers
  - Visual feedback: Tooltip showing "Copied!" confirmation
- **Line Numbers**: Optional per-block via Prism line-numbers plugin
  - CSS-based, doesn't interfere with copy functionality
- **Horizontal Scroll**: CSS `overflow-x: auto` for long lines
  - Mobile: Ensure scrollable without breaking layout
  - Indicator: Subtle fade gradient showing more content available

**Implementation Pattern**:

```javascript
// Copy button functionality
function addCopyButtons() {
  document.querySelectorAll('pre[class*="language-"]').forEach((block) => {
    const button = document.createElement("button");
    button.className = "copy-code-button";
    button.textContent = "Copy";
    button.addEventListener("click", () => {
      const code = block.querySelector("code").textContent;
      navigator.clipboard.writeText(code).then(() => {
        button.textContent = "Copied!";
        setTimeout(() => (button.textContent = "Copy"), 2000);
      });
    });
    block.appendChild(button);
  });
}
```

### 7. Related Posts Algorithm

**Decision**: Category and tag-based similarity with caching via WordPress transients

**Rationale**:

- **Similarity Scoring**: Weight shared categories (3 points) and tags (1 point) to find related posts
- **Performance**: Cache results using WordPress transients API (12-hour expiration)
  - Cache key: `related_posts_{post_id}`
  - Invalidate on post update
- **Fallback**: If no related posts found, show latest posts from same category
- **Limit**: Show 3-5 related posts (configurable via customizer)
- **Query Optimization**: Use `WP_Query` with specific fields to minimize database load

**Alternatives Considered**:

- **Plugin Dependency**: YARPP (Yet Another Related Posts Plugin) or similar
  - Rejected: Keep theme self-contained, avoid plugin dependencies
- **Content Analysis**: TF-IDF or similar algorithms for content similarity
  - Rejected: Computationally expensive, overkill for typical blog scale
- **Machine Learning**: Recommendation engine based on user behavior
  - Rejected: Complexity, requires significant traffic data, privacy concerns

### 8. Mobile Navigation Pattern

**Decision**: Hamburger menu with slide-in drawer, progressive enhancement

**Rationale**:

- **Pattern**: Three-line hamburger icon opens full-screen or slide-in navigation drawer
  - Industry standard: Recognized by users, minimal learning curve
  - Screen real estate: Preserves space for content on small screens
- **Breakpoint**: Switch to mobile nav at 768px (tablet portrait and below)
- **Accessibility**:
  - Button with `aria-label="Menu"` and `aria-expanded` state
  - Focus trap when menu open (tab cycles through menu items only)
  - Escape key closes menu
  - Focus returns to menu button when closed
- **Animation**: Slide-in from left with CSS transforms (200ms transition)
  - Respect `prefers-reduced-motion` for users with motion sensitivity
- **No JavaScript Fallback**: Display all navigation items in stacked layout if JS disabled

**Alternatives Considered**:

- **Tab Bar Navigation**: Bottom navigation bar (iOS style)
  - Rejected: Not standard for blogs, better for app-like interfaces
- **Off-Canvas Menu**: Menu slides in from side pushing content
  - Rejected: Can be disorienting, more complex implementation
- **Select/Dropdown Menu**: Navigation in `<select>` element
  - Rejected: Poor user experience, limited styling, accessibility issues

### 9. Reading Progress Indicator

**Decision**: Fixed position progress bar at top of viewport using Intersection Observer

**Rationale**:

- **Visual**: Thin horizontal bar (2-3px) at very top of viewport, fills left-to-right as user scrolls
- **Performance**: Use Intersection Observer API to calculate progress based on article content visibility
  - More accurate than scroll position for multi-column layouts
  - Better performance than scroll event listeners
- **Progressive Enhancement**: Non-critical feature, doesn't affect core reading if JavaScript disabled
- **Styling**: Use accent color from theme palette, subtle and non-distracting
- **Accessibility**: `aria-hidden="true"` (decorative element), doesn't interfere with screen readers

**Implementation Pattern**:

```javascript
// Simplified progress bar using scroll position
const progressBar = document.querySelector(".reading-progress");
const article = document.querySelector("article");

window.addEventListener(
  "scroll",
  () => {
    const winScroll = window.scrollY;
    const height = article.scrollHeight - window.innerHeight;
    const scrolled = (winScroll / height) * 100;
    progressBar.style.width = scrolled + "%";
  },
  { passive: true }
);
```

### 10. Image Handling Strategy

**Decision**: WordPress responsive images with WebP format support via `<picture>` element

**Rationale**:

- **Responsive Images**: WordPress automatically generates multiple image sizes
  - Use `srcset` and `sizes` attributes for automatic size selection
  - Sizes: thumbnail (150x150), medium (300x300), large (1024x1024), full (original)
- **WebP Support**: Serve WebP format with JPEG/PNG fallback
  - 25-35% smaller file size than JPEG for same quality
  - Use `<picture>` element for fallback support
- **Lazy Loading**: WordPress native `loading="lazy"` attribute (WordPress 5.5+)
  - Browser-native, no JavaScript required
  - Skip for above-the-fold images
- **Alt Text Validation**: WordPress media library requires alt text
  - Theme enforces via CSS warning for images without alt text in editor
- **Placeholder**: Low-quality placeholder or solid color background while loading
  - Prevent layout shift (CLS metric)

**WordPress Image Sizes**:

```php
// Custom image sizes for theme
add_image_size('vdaily-featured', 1200, 630, true); // Social media sharing
add_image_size('vdaily-archive', 600, 400, true);   // Archive thumbnails
add_image_size('vdaily-related', 400, 250, true);   // Related posts
```

## Technology Stack Summary

### Core Technologies

- **PHP**: 8.0+ (WordPress requirement)
- **WordPress**: 6.0+ (modern features, native lazy loading, sitemaps)
- **CSS**: CSS3 with Grid, Flexbox, Custom Properties
- **JavaScript**: ES6+ (native, no jQuery)
- **Build Tools**: Webpack 5, Babel, PostCSS, Autoprefixer

### Primary Libraries

- **Prism.js**: Syntax highlighting (2KB core + language modules)
- **Normalize.css**: CSS reset for cross-browser consistency

### Development Tools

- **PHPUnit**: PHP unit testing
- **Jest**: JavaScript unit testing
- **Lighthouse CI**: Automated performance testing
- **axe DevTools**: Accessibility testing
- **PHPCS**: PHP CodeSniffer with WordPress standards
- **ESLint**: JavaScript linting
- **Stylelint**: CSS linting

### WordPress APIs Used

- **Template Hierarchy**: Standard WordPress templating
- **Theme Customizer API**: User-facing settings
- **REST API**: Search functionality, dynamic content loading
- **Transients API**: Query caching for performance
- **Hooks & Filters**: Extensibility and customization

## Implementation Priorities

### Phase 1: Core Foundation (P1 Requirements)

1. Basic theme structure and template hierarchy
2. Responsive typography and readability (FR-001 to FR-005)
3. Semantic HTML5 markup (FR-011)
4. SEO meta tags and Open Graph (FR-012, FR-013)
5. Schema.org structured data (FR-014)
6. Performance optimization (FR-015, FR-016, FR-017)
7. Mobile-responsive design (FR-033, FR-034, FR-035, FR-036)

### Phase 2: Code Display (P2 Requirements)

1. Prism.js integration (FR-006)
2. Copy-to-clipboard functionality (FR-007)
3. Inline code styling (FR-008)
4. Code block overflow handling (FR-009)
5. Optional line numbers (FR-010)

### Phase 3: Design & UX (P2 Requirements)

1. Minimal design system (FR-021, FR-022)
2. Animation controls and reduced motion (FR-023)
3. Print stylesheet (FR-024)
4. Reading progress indicator (FR-025)
5. Accessibility features (FR-027, FR-028, FR-029)

### Phase 4: Navigation & Discovery (P3 Requirements)

1. Search functionality (FR-030)
2. Related posts (FR-031)
3. Breadcrumb navigation (FR-032)
4. Mobile navigation pattern (FR-035)

## Open Questions & Decisions

### Resolved

- ✅ Syntax highlighting: Prism.js chosen over Highlight.js and server-side solutions
- ✅ Performance strategy: Multi-layered approach with critical CSS, lazy loading, minimal JavaScript
- ✅ SEO approach: Built-in features, no plugin dependency
- ✅ Accessibility standard: WCAG 2.1 Level AA
- ✅ WordPress standards: Traditional PHP theme, not FSE/block theme
- ✅ Related posts: Category/tag similarity with caching

### Deferred to Implementation

- Typography choices: Font families, size scales (will determine during design phase)
- Color palette: Specific color values (will determine during design phase)
- Customizer options: Extent of user customization (will determine based on user feedback)
- Widget areas: Number and placement of widget areas (standard sidebar vs multiple areas)

## Next Steps

1. **Phase 1**: Create data model defining WordPress entities and relationships
2. **Phase 1**: Define contracts for template parts, hooks, and customizer settings
3. **Phase 1**: Generate quickstart guide for theme setup and development
4. **Phase 2**: Break down implementation into discrete tasks (via `/speckit.tasks` command)

## References

- [WordPress Theme Handbook](https://developer.wordpress.org/themes/)
- [WordPress Coding Standards](https://developer.wordpress.org/coding-standards/)
- [WCAG 2.1 Guidelines](https://www.w3.org/WAI/WCAG21/quickref/)
- [Prism.js Documentation](https://prismjs.com/)
- [Web.dev Performance](https://web.dev/performance/)
- [Schema.org Article](https://schema.org/Article)
- [Open Graph Protocol](https://ogp.me/)
