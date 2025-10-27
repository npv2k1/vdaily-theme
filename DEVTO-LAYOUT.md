# Dev.to-Style Home Layout Implementation

This document describes the dev.to-inspired home layout implementation for the VDaily theme.

## Overview

The home page now features a modern 3-column layout inspired by dev.to, providing an improved user experience with better content organization and discovery.

## Layout Structure

### 3-Column Grid Layout

```
┌─────────────────────────────────────────────────────────────────┐
│                         HEADER                                   │
│  [2k1 Logo]  [Navigation Menu]  [Social Icons] [Search]         │
└─────────────────────────────────────────────────────────────────┘

┌──────────────┬─────────────────────────────┬────────────────────┐
│              │                             │                    │
│  LEFT        │      MAIN FEED             │   RIGHT            │
│  SIDEBAR     │      (Center Content)      │   SIDEBAR          │
│              │                             │                    │
│  - Home      │  [Relevant|Latest|Top]     │  - Listings        │
│  - Tags      │                             │  - Trending        │
│  - Nav       │  ┌───────────────────────┐  │  - Activity        │
│              │  │  Post Card            │  │  - Tags Cloud      │
│              │  │  [Author Info]        │  │                    │
│              │  │  [Title]              │  │                    │
│              │  │  [Tags]               │  │                    │
│              │  │  [Image]              │  │                    │
│              │  │  [Reactions] [Meta]   │  │                    │
│              │  └───────────────────────┘  │                    │
│              │                             │                    │
│              │  [More Posts...]           │                    │
│              │                             │                    │
└──────────────┴─────────────────────────────┴────────────────────┘

┌─────────────────────────────────────────────────────────────────┐
│                         FOOTER                                   │
└─────────────────────────────────────────────────────────────────┘
```

## Key Components

### 1. Left Sidebar (`left-sidebar.php`)

**Features:**
- Navigation menu with emoji icons
- Popular tags list with # prefix
- Social media icons
- Sticky positioning for better UX

**Menu Items:**
- 🏠 Home
- 💻 Programming
- 📚 Tutorials
- 🚀 Tech News

### 2. Main Feed (`posts-feed.php`)

**Features:**
- Tab navigation (Relevant, Latest, Top)
- Card-based post layout
- Author information with avatar
- Post tags
- Reaction buttons (❤️, 🦄, 🔖)
- Comment count and reading time
- Featured images
- Pagination

**Post Card Structure:**
```
┌─────────────────────────────────────┐
│ [Avatar] Author Name                │
│         Date                        │
├─────────────────────────────────────┤
│ Post Title                          │
│ #tag1 #tag2 #tag3                   │
├─────────────────────────────────────┤
│ [Featured Image]                    │
├─────────────────────────────────────┤
│ ❤️ 0  🦄 0  🔖 0  |  💬 5  ⏱️ 3min   │
└─────────────────────────────────────┘
```

### 3. Right Sidebar (`right-sidebar.php`)

**Features:**
- Listings (events, jobs, collabs)
- Trending posts with rankings
- Help card
- Recent activity/comments
- Tags cloud

## Responsive Design

### Desktop (≥1280px)
- Full 3-column layout: 240px | 1fr | 320px
- All sidebars visible

### Tablet (1024px - 1279px)
- 2-column layout: Main Feed + Right Sidebar
- Left sidebar hidden

### Mobile (<1024px)
- Single column layout
- Right sidebar hidden
- Stacked content

### Small Mobile (<768px)
- Optimized card layouts
- Wrapped tabs
- Smaller avatars and icons
- Vertical reaction buttons

## CSS Classes Reference

### Layout Classes
- `.devto-layout` - Main layout wrapper
- `.devto-container` - Grid container
- `.devto-left-sidebar` - Left navigation
- `.devto-main-content` - Center feed
- `.devto-right-sidebar` - Right widgets

### Component Classes
- `.devto-post-card` - Individual post card
- `.post-card-header` - Author info section
- `.post-card-body` - Title and tags
- `.post-card-image` - Featured image
- `.post-card-footer` - Reactions and meta

### Navigation Classes
- `.devto-nav-menu` - Navigation menu list
- `.devto-tags-list` - Tags list
- `.devto-feed-tabs` - Feed filter tabs

## Color Scheme

Following dev.to's clean aesthetic:

- **Background:** #f5f5f5 (light gray)
- **Card Background:** #ffffff (white)
- **Primary Text:** #1a1a1a (near black)
- **Accent:** #0066cc (blue)
- **Borders:** #cccccc (gray)

## Features Implemented

### 1. Card-Based Design
- Clean white cards on light gray background
- Subtle shadows on hover
- Rounded corners (4px border-radius)
- Smooth transitions

### 2. Social Features
- Reaction buttons (likes, unicorns, bookmarks)
- Comment counts
- Reading time estimates
- Author profiles

### 3. Content Discovery
- Tab-based filtering
- Popular tags navigation
- Trending posts widget
- Recent activity feed

### 4. Performance
- Sticky sidebars for better navigation
- Lazy loading ready
- Optimized grid layout
- Minimal CSS overhead (~11KB additional)

## Usage

The layout is automatically applied to the homepage (`front-page.php`). No additional configuration is needed.

### Customization

To customize the layout, edit these files:

1. **Layout Structure:** `front-page.php`
2. **Left Sidebar:** `template-parts/home/left-sidebar.php`
3. **Main Feed:** `template-parts/home/posts-feed.php`
4. **Right Sidebar:** `template-parts/home/right-sidebar.php`
5. **Styles:** `src/scss/_devto-layout.scss`

### Adding Custom Navigation

Edit the WordPress menu in:
**Appearance → Menus → Primary Menu**

### Modifying Tags Display

Adjust the tag query in `left-sidebar.php`:

```php
$popular_tags = get_tags(array(
    'orderby'    => 'count',
    'order'      => 'DESC',
    'number'     => 10,  // Adjust number of tags
    'hide_empty' => true,
));
```

## Accessibility

The layout maintains WCAG 2.1 AA compliance:

- Semantic HTML5 structure
- ARIA labels on interactive elements
- Keyboard navigation support
- High contrast ratios
- Focus indicators
- Screen reader friendly

## Browser Support

- Chrome (latest 2 versions)
- Firefox (latest 2 versions)
- Safari (latest 2 versions)
- Edge (latest 2 versions)

## Notes

- The layout is inspired by dev.to but adapted for WordPress
- All features are theme-native (no plugins required)
- Reactions are placeholder buttons ready for integration
- Trending scores use comment counts by default

## Future Enhancements

Potential improvements for future versions:

1. AJAX-based tab switching
2. Infinite scroll pagination
3. Real-time reaction system
4. User following/favorites
5. Advanced tag filtering
6. Personalized feed recommendations

## Testing

To test the layout:

1. **Docker (Recommended):**
   ```bash
   docker-compose up -d
   # Visit http://localhost:8080
   ```

2. **Local WordPress:**
   - Install WordPress 6.0+
   - Activate the theme
   - Add some posts with featured images
   - Create categories and tags
   - Visit the homepage

## Troubleshooting

### Layout Not Showing
- Clear browser cache
- Clear WordPress cache
- Rebuild theme assets: `npm run build`
- Check if front-page.php is being used

### Sidebars Empty
- Ensure posts exist in the database
- Verify categories and tags are assigned
- Check widget areas are registered

### Styling Issues
- Run `npm run build` to compile SCSS
- Check for CSS conflicts with plugins
- Verify all CSS variables are defined in `_variables.scss`

## Credits

- Layout inspired by [dev.to](https://dev.to)
- Icons: Emoji (built-in)
- Grid system: CSS Grid
- Responsive design: CSS Media Queries
