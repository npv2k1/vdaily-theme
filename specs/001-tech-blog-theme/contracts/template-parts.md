# Template Parts Contract

**Feature**: Modern Tech Blog WordPress Theme  
**Date**: October 26, 2025  
**Purpose**: Define contracts for reusable template components

## Overview

This document specifies the interface contracts for all template parts in the theme. Template parts are reusable PHP files that can be included using WordPress `get_template_part()` function.

---

## Content Template Parts

### content-single.php

**Location**: `template-parts/content/content-single.php`

**Purpose**: Display full single post content

**Required Context Variables**: None (uses global `$post`)

**Expected Global State**:

- `$post` - Current post object
- Inside The Loop

**Output Structure**:

```html
<article id="post-{ID}" class="post single-post">
  <header class="entry-header">
    <h1 class="entry-title">{post_title}</h1>
    <div class="entry-meta">{author} | {date} | {reading_time}</div>
  </header>

  <div class="entry-content">{post_content with filters applied}</div>

  <footer class="entry-footer">
    <div class="post-categories">{categories}</div>
    <div class="post-tags">{tags}</div>
  </footer>
</article>
```

**Hooks Fired**:

- `vdaily_before_article_content` (before entry-content)
- `vdaily_after_article_content` (after entry-content)

**Functions Called**:

- `the_title()`
- `the_content()`
- `vdaily_posted_on()` - Custom function for date
- `vdaily_posted_by()` - Custom function for author
- `vdaily_reading_time()` - Custom function for reading time
- `the_category()`
- `the_tags()`

**CSS Classes**:

- `.post` - Base post class
- `.single-post` - Single post identifier
- `.entry-header` - Post header
- `.entry-title` - Post title
- `.entry-meta` - Post metadata
- `.entry-content` - Post content
- `.entry-footer` - Post footer

**Example Usage**:

```php
// In single.php
while (have_posts()) {
    the_post();
    get_template_part('template-parts/content/content', 'single');
}
```

---

### content-archive.php

**Location**: `template-parts/content/content-archive.php`

**Purpose**: Display post excerpt in archive/category/tag listings

**Required Context Variables**: None (uses global `$post`)

**Expected Global State**:

- `$post` - Current post object
- Inside The Loop

**Output Structure**:

```html
<article id="post-{ID}" class="post archive-post">
  <a href="{permalink}" class="post-link">
    {if has_post_thumbnail}
    <div class="post-thumbnail">
      <img src="{thumbnail_url}" alt="{title}" />
    </div>
    {endif}

    <div class="post-content-wrapper">
      <header class="entry-header">
        <h2 class="entry-title">{post_title}</h2>
        <div class="entry-meta">{date} | {reading_time}</div>
      </header>

      <div class="entry-excerpt">{post_excerpt}</div>

      <div class="read-more">Read More →</div>
    </div>
  </a>
</article>
```

**Hooks Fired**: None

**Functions Called**:

- `get_permalink()`
- `has_post_thumbnail()`
- `get_the_post_thumbnail()` with size 'vdaily-archive'
- `the_title()`
- `get_the_excerpt()` or `vdaily_custom_excerpt()`
- `vdaily_posted_on()`
- `vdaily_reading_time()`

**CSS Classes**:

- `.post` - Base post class
- `.archive-post` - Archive post identifier
- `.post-link` - Wrapper link
- `.post-thumbnail` - Featured image container
- `.post-content-wrapper` - Content wrapper
- `.entry-header`, `.entry-title`, `.entry-meta`, `.entry-excerpt` - Content sections

**Example Usage**:

```php
// In archive.php
while (have_posts()) {
    the_post();
    get_template_part('template-parts/content/content', 'archive');
}
```

---

### content-search.php

**Location**: `template-parts/content/content-search.php`

**Purpose**: Display search result item

**Required Context Variables**: None (uses global `$post`)

**Expected Global State**:

- `$post` - Current post object
- Inside The Loop
- `is_search()` returns true

**Output Structure**:

```html
<article id="post-{ID}" class="post search-result">
  <header class="entry-header">
    <h2 class="entry-title">
      <a href="{permalink}">{post_title with search term highlighted}</a>
    </h2>
    <div class="entry-meta">{date} in {categories}</div>
  </header>

  <div class="entry-summary">{excerpt with search term highlighted}</div>
</article>
```

**Hooks Fired**: None

**Functions Called**:

- `get_permalink()`
- `the_title()`
- `get_search_query()` - For highlighting
- `vdaily_highlight_search_terms()` - Custom function
- `vdaily_posted_on()`
- `the_category()`

**CSS Classes**:

- `.post` - Base post class
- `.search-result` - Search result identifier
- `.entry-header`, `.entry-title`, `.entry-meta`, `.entry-summary` - Content sections
- `.search-highlight` - Applied to highlighted search terms

**Example Usage**:

```php
// In search.php
while (have_posts()) {
    the_post();
    get_template_part('template-parts/content/content', 'search');
}
```

---

## Navigation Template Parts

### nav-primary.php

**Location**: `template-parts/navigation/nav-primary.php`

**Purpose**: Display primary navigation menu

**Required Context Variables**: None

**Expected Global State**:

- Primary menu registered via `register_nav_menus()`
- Menu assigned in WordPress admin

**Output Structure**:

```html
<nav
  id="primary-navigation"
  class="primary-nav"
  role="navigation"
  aria-label="Primary Navigation"
>
  <button
    class="menu-toggle"
    aria-expanded="false"
    aria-controls="primary-menu"
  >
    <span class="sr-only">Menu</span>
    <span class="hamburger-icon"></span>
  </button>

  <div id="primary-menu" class="menu-wrapper">{wp_nav_menu output}</div>
</nav>
```

**Hooks Fired**: None (WordPress `wp_nav_menu` fires its own hooks)

**Functions Called**:

- `wp_nav_menu()` with args:
  - `theme_location` => 'primary'
  - `container` => false
  - `menu_class` => 'nav-menu'
  - `fallback_cb` => `vdaily_nav_fallback`

**CSS Classes**:

- `.primary-nav` - Navigation wrapper
- `.menu-toggle` - Mobile menu button
- `.hamburger-icon` - Menu icon
- `.menu-wrapper` - Menu container
- `.nav-menu` - WordPress menu UL
- `.current-menu-item` - Current page (WordPress default)
- `.menu-item-has-children` - Parent menu items (WordPress default)

**JavaScript Dependencies**:

- `assets/js/navigation.js` - Mobile menu toggle

**Accessibility Requirements**:

- `role="navigation"`
- `aria-label` on nav element
- `aria-expanded` on menu toggle button
- `aria-controls` linking button to menu
- Keyboard navigation support

**Example Usage**:

```php
// In header.php
get_template_part('template-parts/navigation/nav', 'primary');
```

---

### nav-breadcrumb.php

**Location**: `template-parts/navigation/nav-breadcrumb.php`

**Purpose**: Display breadcrumb navigation showing current page location

**Required Context Variables**: None (uses WordPress conditional tags)

**Expected Global State**:

- WordPress query context (is_single, is_category, etc.)

**Output Structure**:

```html
<nav class="breadcrumb" aria-label="Breadcrumb">
  <ol
    class="breadcrumb-list"
    vocab="https://schema.org/"
    typeof="BreadcrumbList"
  >
    <li property="itemListElement" typeof="ListItem">
      <a property="item" typeof="WebPage" href="{home_url}">
        <span property="name">Home</span>
      </a>
      <meta property="position" content="1" />
    </li>
    <li class="separator" aria-hidden="true">→</li>
    <li property="itemListElement" typeof="ListItem">
      <a property="item" typeof="WebPage" href="{category_url}">
        <span property="name">{category_name}</span>
      </a>
      <meta property="position" content="2" />
    </li>
    <li class="separator" aria-hidden="true">→</li>
    <li property="itemListElement" typeof="ListItem">
      <span property="name">{current_page_title}</span>
      <meta property="position" content="3" />
    </li>
  </ol>
</nav>
```

**Hooks Fired**: None

**Functions Called**:

- `home_url()`
- `get_the_title()`
- `get_the_category()`
- `get_category_link()`
- Custom logic for different page types

**CSS Classes**:

- `.breadcrumb` - Breadcrumb wrapper
- `.breadcrumb-list` - OL element
- `.separator` - Separator between items

**Schema.org Integration**:

- BreadcrumbList structured data using RDFa Lite
- Position meta properties for proper indexing

**Example Usage**:

```php
// In single.php before article
if (!is_front_page()) {
    get_template_part('template-parts/navigation/nav', 'breadcrumb');
}
```

---

### nav-pagination.php

**Location**: `template-parts/navigation/nav-pagination.php`

**Purpose**: Display numbered pagination for archives and search results

**Required Context Variables**: None (uses global `$wp_query`)

**Expected Global State**:

- `$wp_query` - Global query object with pagination info

**Output Structure**:

```html
<nav class="pagination" role="navigation" aria-label="Posts Navigation">
  <div class="nav-links">
    <a class="prev page-numbers" href="{prev_url}">← Previous</a>
    <span class="page-numbers current">1</span>
    <a class="page-numbers" href="{page_2_url}">2</a>
    <a class="page-numbers" href="{page_3_url}">3</a>
    <span class="page-numbers dots">…</span>
    <a class="page-numbers" href="{last_page_url}">10</a>
    <a class="next page-numbers" href="{next_url}">Next →</a>
  </div>
</nav>
```

**Hooks Fired**: None

**Functions Called**:

- `the_posts_pagination()` with custom args
- OR custom implementation using `paginate_links()`

**CSS Classes**:

- `.pagination` - Pagination wrapper
- `.nav-links` - Links container
- `.page-numbers` - Page number/link
- `.current` - Current page
- `.dots` - Ellipsis indicator
- `.prev`, `.next` - Previous/next links

**Accessibility Requirements**:

- `role="navigation"`
- `aria-label` on nav element
- Clear visual indication of current page

**Example Usage**:

```php
// In archive.php after loop
if (have_posts()) {
    // Loop here
    get_template_part('template-parts/navigation/nav', 'pagination');
}
```

---

## Component Template Parts

### related-posts.php

**Location**: `template-parts/components/related-posts.php`

**Purpose**: Display related articles based on categories and tags

**Required Context Variables**:

- `$args` array with `post_id` key (optional, defaults to current post)

**Expected Global State**:

- Called from single post context

**Input Contract**:

```php
$args = array(
    'post_id' => int, // Optional, defaults to get_the_ID()
    'count' => int,   // Optional, defaults to 5
);
get_template_part('template-parts/components/related-posts', null, $args);
```

**Output Structure**:

```html
<aside class="related-posts">
  <h3 class="related-posts-title">Related Articles</h3>
  <div class="related-posts-grid">
    <article class="related-post">
      <a href="{permalink}">
        {if thumbnail}
        <div class="related-post-thumbnail">
          <img src="{thumbnail}" alt="{title}" />
        </div>
        {endif}
        <h4 class="related-post-title">{title}</h4>
        <div class="related-post-meta">{date}</div>
      </a>
    </article>
    <!-- Repeat for each related post -->
  </div>
</aside>
```

**Hooks Fired**:

- `vdaily_before_related_posts`
- `vdaily_after_related_posts`

**Functions Called**:

- `vdaily_get_related_posts($post_id, $count)` - Returns WP_Post array
- `get_permalink()`
- `has_post_thumbnail()`
- `get_the_post_thumbnail()` with size 'vdaily-related'
- `get_the_title()`
- `vdaily_posted_on()`

**CSS Classes**:

- `.related-posts` - Section wrapper
- `.related-posts-title` - Section heading
- `.related-posts-grid` - Grid container (CSS Grid)
- `.related-post` - Individual related post
- `.related-post-thumbnail`, `.related-post-title`, `.related-post-meta` - Post elements

**Performance**:

- Results cached via WordPress transients (12 hours)
- Maximum 5 posts to prevent performance issues

**Example Usage**:

```php
// In single.php after article
get_template_part('template-parts/components/related-posts', null, array(
    'count' => 3
));
```

---

### post-meta.php

**Location**: `template-parts/components/post-meta.php`

**Purpose**: Display post metadata (author, date, reading time)

**Required Context Variables**: None (uses global `$post`)

**Expected Global State**:

- `$post` - Current post object
- Inside The Loop

**Output Structure**:

```html
<div class="post-meta">
  <span class="post-author">
    <img src="{gravatar}" alt="{author_name}" class="author-avatar" />
    By <a href="{author_url}">{author_name}</a>
  </span>
  <span class="post-date">
    <time datetime="{iso_date}">{formatted_date}</time>
  </span>
  <span class="post-reading-time"> {reading_time} min read </span>
</div>
```

**Hooks Fired**: None

**Functions Called**:

- `get_avatar()` - Gravatar image
- `get_the_author()`
- `get_author_posts_url()`
- `get_the_date()` with format 'c' (ISO 8601)
- `get_the_date()` with custom format
- `get_post_meta($post->ID, '_vdaily_reading_time', true)`

**CSS Classes**:

- `.post-meta` - Wrapper
- `.post-author`, `.post-date`, `.post-reading-time` - Individual meta items
- `.author-avatar` - Avatar image

**Accessibility Requirements**:

- `<time>` element with `datetime` attribute
- Alt text for avatar images

**Example Usage**:

```php
// In content-single.php within entry-header
get_template_part('template-parts/components/post', 'meta');
```

---

### reading-progress.php

**Location**: `template-parts/components/reading-progress.php`

**Purpose**: Display reading progress indicator bar

**Required Context Variables**: None

**Expected Global State**:

- Single post context (is_single())

**Output Structure**:

```html
<div class="reading-progress-container" aria-hidden="true">
  <div class="reading-progress-bar"></div>
</div>
```

**Hooks Fired**: None

**Functions Called**: None (pure HTML/CSS, JavaScript-driven)

**CSS Classes**:

- `.reading-progress-container` - Fixed position container (top of viewport)
- `.reading-progress-bar` - Progress bar element (width updated via JS)

**JavaScript Dependencies**:

- `assets/js/reading-progress.js` - Updates progress bar width on scroll

**Accessibility**:

- `aria-hidden="true"` - Decorative, not announced to screen readers

**Performance**:

- Uses passive scroll listener
- Throttled updates for performance

**Example Usage**:

```php
// In single.php before get_header()
if (is_single()) {
    get_template_part('template-parts/components/reading', 'progress');
}
```

---

## Template Part Conventions

### File Naming

- **Pattern**: `{context}-{variant}.php`
- **Examples**: `content-single.php`, `content-archive.php`, `nav-primary.php`

### Loading with get_template_part()

**Basic**:

```php
get_template_part('template-parts/content/content', 'single');
// Loads: template-parts/content/content-single.php
```

**With Arguments (WordPress 5.5+)**:

```php
get_template_part('template-parts/components/related-posts', null, array(
    'post_id' => 123,
    'count' => 3
));

// In template file, access via:
$args = wp_parse_args($args, array(
    'post_id' => get_the_ID(),
    'count' => 5
));
```

### Fallback Behavior

If specific variant doesn't exist, WordPress looks for base template:

```php
get_template_part('template-parts/content/content', 'custom');
// 1. Tries: content-custom.php
// 2. Falls back to: content.php
```

### Child Theme Override

Child themes can override template parts by creating same path:

```
parent-theme/template-parts/content/content-single.php
child-theme/template-parts/content/content-single.php  ← This loads
```

---

## Global Functions Contract

Template parts rely on these global theme functions (defined in `inc/template-tags.php`):

### `vdaily_posted_on()`

**Returns**: `string` - Formatted post date with microdata
**Example**: `<time datetime="2025-10-26">October 26, 2025</time>`

### `vdaily_posted_by()`

**Returns**: `string` - Formatted author link
**Example**: `By <a href="/author/john/">John Doe</a>`

### `vdaily_reading_time()`

**Returns**: `string` - Formatted reading time
**Example**: `5 min read`

### `vdaily_custom_excerpt($length = 160)`

**Parameters**: `int $length` - Character limit
**Returns**: `string` - Trimmed excerpt without HTML
**Example**: `"This is a great article about..."` (160 chars)

### `vdaily_get_related_posts($post_id, $count = 5)`

**Parameters**:

- `int $post_id` - Post to find related posts for
- `int $count` - Number of posts to return
  **Returns**: `array` - Array of WP_Post objects
  **Caching**: Results cached via transients (12 hours)

---

## Performance Considerations

### Template Part Caching

- Use WordPress transients for expensive queries in template parts
- Cache key format: `vdaily_{template_part}_{context_id}`
- Default expiration: 12 hours

### Lazy Loading

- Archive template parts should not load related posts (expensive query)
- Only load heavy components (related posts) on single post view

### Query Optimization

- Limit `posts_per_page` in archive queries
- Use specific fields in WP_Query when full post object not needed
- Avoid N+1 queries by pre-fetching metadata

---

## Testing Template Parts

Template parts should be tested in context:

```php
// PHPUnit test
class Test_Template_Parts extends WP_UnitTestCase {
    public function test_related_posts_template() {
        $post_id = $this->factory->post->create();

        ob_start();
        get_template_part('template-parts/components/related-posts', null, array(
            'post_id' => $post_id
        ));
        $output = ob_get_clean();

        $this->assertStringContainsString('related-posts', $output);
    }
}
```

---

## Future Template Parts (Planned)

- `components/newsletter-signup.php` - Email subscription form
- `components/share-buttons.php` - Social sharing buttons
- `components/table-of-contents.php` - Auto-generated article TOC
- `navigation/nav-footer.php` - Footer navigation menu
