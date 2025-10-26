# Data Model: Modern Tech Blog WordPress Theme

**Phase**: 1 - Design & Contracts  
**Date**: October 26, 2025  
**Feature**: [spec.md](./spec.md) | [plan.md](./plan.md) | [research.md](./research.md)

## Overview

This document defines the data structures used in the WordPress theme. The theme leverages native WordPress data structures (posts, taxonomies, users) with custom fields and metadata to support tech blog requirements.

## WordPress Native Entities

### Post (Article)

WordPress native `wp_posts` table with custom fields and meta data.

**Core Fields** (from `wp_posts` table):

- `ID`: Unique post identifier (auto-increment)
- `post_author`: Foreign key to `wp_users.ID` (author)
- `post_date`: Publication timestamp
- `post_date_gmt`: Publication timestamp (GMT)
- `post_content`: Article body content (HTML)
- `post_title`: Article headline
- `post_excerpt`: Short summary (150-160 characters for SEO)
- `post_status`: Publication status (`publish`, `draft`, `pending`, etc.)
- `post_name`: URL slug (sanitized from title)
- `post_modified`: Last modification timestamp
- `post_modified_gmt`: Last modification timestamp (GMT)
- `post_type`: Content type (default: `post`)
- `post_mime_type`: MIME type (null for posts)

**Custom Meta Fields** (via `wp_postmeta` table):

- `_vdaily_reading_time`: Estimated reading time in minutes (integer, calculated on save)
- `_vdaily_code_blocks_count`: Number of code blocks in article (integer)
- `_vdaily_primary_language`: Primary programming language featured (string)
- `_thumbnail_id`: Featured image ID (WordPress default, used for social sharing)

**Taxonomies**:

- `category`: WordPress native hierarchical taxonomy (broad classification)
- `post_tag`: WordPress native non-hierarchical taxonomy (granular labels)

**Relationships**:

- Many-to-One with `wp_users` (author)
- Many-to-Many with `wp_terms` via `wp_term_relationships` (categories, tags)
- One-to-One with featured image via `_thumbnail_id` → `wp_posts.ID` (attachment)

**Validation Rules**:

- `post_title`: Required, 1-200 characters
- `post_excerpt`: Optional, 150-160 characters recommended for SEO
- `post_content`: Required, minimum 100 characters
- `_thumbnail_id`: Required (enforced by theme)
- `_vdaily_reading_time`: Auto-calculated (200 words/minute average)

**State Transitions**:

```
draft → pending → publish
draft → publish
publish → draft (unpublish)
```

**Indexes** (WordPress defaults):

- Primary: `ID`
- Index: `post_author`, `post_status`, `post_type`, `post_date`

---

### Category

WordPress native `wp_terms` table with taxonomy `category`.

**Core Fields**:

- `term_id`: Unique category identifier
- `name`: Category display name
- `slug`: URL-friendly identifier
- `term_group`: WordPress internal grouping (usually 0)

**Taxonomy Fields** (via `wp_term_taxonomy` table):

- `term_taxonomy_id`: Unique taxonomy term ID
- `taxonomy`: Always `category` for categories
- `description`: Category description (optional, used in archive pages)
- `parent`: Parent category ID for hierarchical structure (0 for top-level)
- `count`: Number of posts in category (auto-maintained)

**Relationships**:

- Many-to-Many with Posts via `wp_term_relationships`
- Self-referential (parent-child hierarchy)

**Validation Rules**:

- `name`: Required, 1-200 characters, unique
- `slug`: Required, auto-generated from name, unique, lowercase, alphanumeric + hyphens
- `parent`: Must reference existing category or 0 for top-level
- Maximum nesting depth: 3 levels (theme recommendation)

**Examples**:

```
Web Development (parent: 0)
├── JavaScript (parent: Web Development)
├── PHP (parent: Web Development)
└── CSS (parent: Web Development)

DevOps (parent: 0)
├── Docker (parent: DevOps)
└── Kubernetes (parent: DevOps)
```

---

### Tag

WordPress native `wp_terms` table with taxonomy `post_tag`.

**Core Fields**:

- `term_id`: Unique tag identifier
- `name`: Tag display name
- `slug`: URL-friendly identifier

**Taxonomy Fields** (via `wp_term_taxonomy` table):

- `term_taxonomy_id`: Unique taxonomy term ID
- `taxonomy`: Always `post_tag` for tags
- `description`: Tag description (rarely used)
- `parent`: Always 0 (tags are non-hierarchical)
- `count`: Number of posts with this tag

**Relationships**:

- Many-to-Many with Posts via `wp_term_relationships`

**Validation Rules**:

- `name`: Required, 1-50 characters, unique
- `slug`: Required, auto-generated from name, unique, lowercase, alphanumeric + hyphens
- Recommended: 3-10 tags per post

**Examples**:

```
react, hooks, performance, tutorial, beginner-friendly
python, machine-learning, tensorflow, data-science
wordpress, php, theme-development, hooks
```

---

### Author (User)

WordPress native `wp_users` and `wp_usermeta` tables.

**Core Fields** (from `wp_users`):

- `ID`: Unique user identifier
- `user_login`: Username (unique)
- `user_nicename`: URL-friendly name
- `user_email`: Email address (unique)
- `user_registered`: Registration timestamp
- `display_name`: Public display name

**Meta Fields** (via `wp_usermeta`):

- `first_name`: Author first name
- `last_name`: Author last name
- `description`: Author biography (rich text, supports HTML)
- `_vdaily_author_twitter`: Twitter handle (custom field)
- `_vdaily_author_github`: GitHub username (custom field)
- `_vdaily_author_linkedin`: LinkedIn profile URL (custom field)
- `_vdaily_author_website`: Personal website URL (custom field)

**Relationships**:

- One-to-Many with Posts (author of multiple posts)

**Validation Rules**:

- `display_name`: Required, 1-250 characters
- `user_email`: Required, valid email format
- `description`: Optional, maximum 5000 characters
- Social media fields: Optional, validated format (Twitter: @handle, GitHub: username, LinkedIn: full URL)

**Display Requirements**:

- Author bio shown on single post pages
- Author archive page available at `/author/{user_nicename}/`
- Gravatar image integration via `user_email`

---

### Featured Image (Attachment)

WordPress native `wp_posts` table with `post_type = 'attachment'` and `wp_postmeta`.

**Core Fields**:

- `ID`: Unique attachment identifier
- `post_title`: Image title
- `post_content`: Image description
- `post_excerpt`: Image caption
- `post_name`: File slug
- `post_mime_type`: MIME type (e.g., `image/jpeg`, `image/png`, `image/webp`)
- `guid`: Full URL to file

**Meta Fields**:

- `_wp_attached_file`: Relative file path from uploads directory
- `_wp_attachment_metadata`: Serialized array with image metadata
  - `width`: Original image width
  - `height`: Original image height
  - `file`: File path
  - `sizes`: Array of generated image sizes
    - `thumbnail`, `medium`, `large`, `full`
    - Custom: `vdaily-featured` (1200x630), `vdaily-archive` (600x400), `vdaily-related` (400x250)
- `_wp_attachment_image_alt`: Alt text for accessibility (REQUIRED by theme)

**Image Sizes** (generated automatically):

```php
// WordPress defaults
'thumbnail'       => 150x150 (cropped)
'medium'          => 300x300 (scaled)
'large'           => 1024x1024 (scaled)
'full'            => original dimensions

// Custom theme sizes
'vdaily-featured' => 1200x630 (cropped, for social sharing)
'vdaily-archive'  => 600x400 (cropped, for archive listings)
'vdaily-related'  => 400x250 (cropped, for related posts)
```

**Relationships**:

- Many-to-One with Posts via `_thumbnail_id` meta field
- Attached to parent post via `post_parent` field (optional)

**Validation Rules**:

- `_wp_attachment_image_alt`: Required by theme (enforced via editor warning)
- Supported formats: JPEG, PNG, WebP, GIF
- Recommended dimensions: Minimum 1200x630 for social sharing
- Maximum file size: Defined by WordPress/server settings (typically 2-10MB)

**WebP Support**:

- Theme generates WebP versions alongside original formats
- Served via `<picture>` element with fallback:

```html
<picture>
  <source srcset="image.webp" type="image/webp" />
  <img src="image.jpg" alt="Alt text" />
</picture>
```

---

## Theme-Specific Virtual Entities

### Code Block

Not stored as separate entity - embedded within `post_content` as Gutenberg blocks.

**Gutenberg Block**: `core/code` or custom `vdaily/code-block`

**Block Attributes**:

```json
{
  "content": "string (code content)",
  "language": "string (e.g., 'javascript', 'python', 'php')",
  "lineNumbers": "boolean (show line numbers)",
  "highlightLines": "string (comma-separated line numbers to highlight)",
  "fileName": "string (optional file name to display)",
  "caption": "string (optional code block caption)"
}
```

**Rendering**:

- Parsed from HTML during `the_content` filter
- Wrapped in `<pre><code>` tags with language class
- Prism.js applied client-side for syntax highlighting
- Copy button injected via JavaScript

**Validation**:

- `language`: Must match supported language list (20+ languages)
- `content`: Required, no maximum length (but UX recommendation: <500 lines)

**State**:

- Stored as HTML in `post_content`
- Example HTML output:

```html
<pre class="language-javascript line-numbers">
  <code class="language-javascript">
    const greeting = 'Hello, World!';
    console.log(greeting);
  </code>
</pre>
```

---

### Related Posts (Calculated)

Not stored - dynamically calculated and cached.

**Calculation Algorithm**:

```
Score = (Shared Categories × 3) + (Shared Tags × 1)

Sort by Score DESC, post_date DESC
Limit to 3-5 results
```

**Cache Strategy**:

- WordPress Transient: `vdaily_related_{post_id}`
- Expiration: 12 hours
- Invalidation: On post update, category/tag change

**Fallback**:

```
If score = 0 for all posts:
  Return latest posts from same primary category
If no category match:
  Return latest posts site-wide
```

**Query Structure**:

```php
$args = [
  'post_type' => 'post',
  'post_status' => 'publish',
  'posts_per_page' => 5,
  'post__not_in' => [$current_post_id],
  'tax_query' => [/* category/tag query */],
  'orderby' => 'date',
  'order' => 'DESC'
];
```

---

## Data Flow Diagrams

### Post Publication Flow

```
[Author] → Create Draft
  ↓
Edit Content
  ↓
Add Featured Image → [Validate Alt Text]
  ↓
Assign Categories/Tags
  ↓
Submit for Review (optional)
  ↓
[Editor] → Approve (optional)
  ↓
Publish
  ↓
[Automatic]:
  - Calculate reading time
  - Count code blocks
  - Invalidate related posts cache
  - Notify search engines (sitemap)
  - Generate social sharing meta
```

### Page Load Flow

```
[User Request] → WordPress Template Hierarchy
  ↓
single.php → get_header()
  ↓
Load Post Data:
  - post_content (article body)
  - post_title, post_date, post_author
  - _thumbnail_id → featured image
  - categories, tags (via term_relationships)
  ↓
Render Template:
  - Header (navigation, logo)
  - Article content
    → Filter: syntax highlight classes
    → Lazy load images
  - Metadata (author, date, reading time)
  - Related posts (check cache → calculate if miss)
  ↓
get_footer()
  ↓
Enqueue Scripts:
  - Prism.js (async)
  - Copy button script (async)
  - Reading progress (async)
  ↓
[Client-Side]:
  - Apply syntax highlighting
  - Add copy buttons
  - Initialize reading progress
```

### Search Flow

```
[User] → Search Query
  ↓
WordPress REST API: /wp-json/wp/v2/search
  ↓
Query: wp_posts
  - LIKE post_title
  - LIKE post_content
  - LIKE post_excerpt
  ↓
Return JSON:
  [{
    id, title, url, excerpt, date, featured_image
  }]
  ↓
[Theme JavaScript] → Render Results
```

---

## Database Indexes

**Existing WordPress Indexes** (utilized by theme):

- `wp_posts.post_author` - Author archive pages
- `wp_posts.post_status` - Published posts only
- `wp_posts.post_date` - Chronological sorting
- `wp_term_relationships.object_id` - Category/tag queries
- `wp_term_taxonomy.taxonomy` - Taxonomy filtering

**Recommended Custom Indexes** (if performance issues):

```sql
-- For related posts queries
CREATE INDEX idx_post_category_date
  ON wp_posts(post_status, post_date);

-- For author archive pagination
CREATE INDEX idx_author_status_date
  ON wp_posts(post_author, post_status, post_date);
```

---

## Data Constraints Summary

| Entity         | Required Fields                | Unique Fields     | Max Length       | Special Rules              |
| -------------- | ------------------------------ | ----------------- | ---------------- | -------------------------- |
| Post           | title, content, featured_image | slug              | title: 200 chars | Min 100 chars content      |
| Category       | name, slug                     | slug              | name: 200 chars  | Max 3 levels deep          |
| Tag            | name, slug                     | slug              | name: 50 chars   | 3-10 tags/post recommended |
| Author         | display_name, email            | email, user_login | bio: 5000 chars  | Valid email format         |
| Featured Image | alt_text                       | -                 | -                | Min 1200x630 for social    |

---

## Meta Field Naming Convention

All custom meta fields use prefix `_vdaily_` to avoid conflicts:

**Private Meta** (prefixed with `_`, hidden from custom fields UI):

- `_vdaily_reading_time`
- `_vdaily_code_blocks_count`
- `_vdaily_primary_language`
- `_vdaily_author_twitter`
- `_vdaily_author_github`
- `_vdaily_author_linkedin`
- `_vdaily_author_website`

**Public Meta** (no underscore prefix, visible in custom fields UI):

- None currently defined

---

## Data Migration Considerations

**From Other Themes**:

- Featured images: Standard WordPress, no migration needed
- Categories/Tags: Standard WordPress, no migration needed
- Custom fields: May need mapping script for reading time calculation

**Export/Import**:

- WordPress XML export includes all native data
- Custom meta fields included in export
- Theme provides calculation functions to regenerate meta on import

---

## Performance Considerations

**Query Optimization**:

- Use `WP_Query` with specific fields: `fields => 'ids'` when only IDs needed
- Limit related posts queries to necessary fields
- Cache expensive queries with transients (12-hour expiration)

**Database Growth**:

- 1000 posts ≈ 1000 rows in `wp_posts`
- Average 10 categories, 50 tags ≈ 60 rows in `wp_terms`
- Average 5 post meta fields per post ≈ 5000 rows in `wp_postmeta`
- Total: ~6-7 MB for 1000 posts (excluding images)

**Cache Strategy**:

- Transients: Related posts, complex taxonomy queries
- Object cache: Post metadata (if persistent object cache available)
- Page cache: Full page caching via plugin (WP Super Cache, W3 Total Cache)

---

## Next Steps

1. Define API contracts for template parts and hooks → `contracts/`
2. Create quickstart guide for theme setup → `quickstart.md`
3. Update agent context with technology stack → Run `.specify/scripts/bash/update-agent-context.sh`
