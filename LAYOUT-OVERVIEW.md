# Layout Specification Implementation - Visual Overview

## Page Structure

```
┌─────────────────────────────────────────────────────────────────┐
│                           HEADER                                 │
│  ┌────────┐  ┌────────────────────┐  ┌─────────────────────┐  │
│  │  2k1   │  │  Navigation Menu   │  │  Social & Search    │  │
│  └────────┘  └────────────────────┘  └─────────────────────┘  │
└─────────────────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────────────────┐
│                        HERO SECTION                              │
│  ┌─────────────────────────────┐  ┌──────────────────────────┐ │
│  │                             │  │   Featured Post 2         │ │
│  │     Main Featured Post      │  │   (Secondary)             │ │
│  │     (2/3 width)             │  └──────────────────────────┘ │
│  │                             │  ┌──────────────────────────┐ │
│  │                             │  │   Featured Post 3         │ │
│  │                             │  │   (Secondary)             │ │
│  └─────────────────────────────┘  └──────────────────────────┘ │
└─────────────────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────────────────┐
│                     CONTENT AREA                                 │
│  ┌──────────────────────────────────┐  ┌──────────────────────┐│
│  │  CONTENT SECTION                 │  │    SIDEBAR           ││
│  │  ┌────────────────────────────┐  │  │  ┌────────────────┐ ││
│  │  │  Bài mới | ALL | PROG...  │  │  │  │ POPULAR POST   │ ││
│  │  └────────────────────────────┘  │  │  ├────────────────┤ ││
│  │                                   │  │  │ 01 Featured    │ ││
│  │  ┌────────────────────────────┐  │  │  │    Post        │ ││
│  │  │ [img] Article Title       │  │  │  ├────────────────┤ ││
│  │  │       Author • Date • Cmts│  │  │  │ 02 Post Title  │ ││
│  │  │       Excerpt...          │  │  │  ├────────────────┤ ││
│  │  └────────────────────────────┘  │  │  │ 03 Post Title  │ ││
│  │                                   │  │  ├────────────────┤ ││
│  │  ┌────────────────────────────┐  │  │  │ 04 Post Title  │ ││
│  │  │ [img] Article Title       │  │  │  ├────────────────┤ ││
│  │  │       Author • Date • Cmts│  │  │  │ 05 Post Title  │ ││
│  │  │       Excerpt...          │  │  │  └────────────────┘ ││
│  │  └────────────────────────────┘  │  │                     ││
│  │                                   │  │                     ││
│  └──────────────────────────────────┘  └──────────────────────┘│
└─────────────────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────────────────┐
│                           FOOTER                                 │
│  ┌────────────────┐  ┌────────────────┐  ┌─────────────────┐  │
│  │  Navigation    │  │   Follow Us    │  │   Widgets       │  │
│  │  - Home        │  │   [f] [t] [g]  │  │                 │  │
│  │  - About       │  │   [y]          │  │                 │  │
│  │  - Contact     │  │                │  │                 │  │
│  └────────────────┘  └────────────────┘  └─────────────────┘  │
│  ┌─────────────────────────────────────────────────────────┐  │
│  │  © 2025 All rights reserved | Powered by WordPress      │  │
│  └─────────────────────────────────────────────────────────┘  │
└─────────────────────────────────────────────────────────────────┘
```

## Component Details

### Header Components
1. **Logo**: "2k1" text logo (top-left)
2. **Navigation Menu**: 
   - HOME
   - PROGRAMMING ▼
   - SYSTEM ▼
   - DESIGN ▼
   - APPLICATIONS ▼
   - TECH ▼
3. **Icons** (top-right):
   - Facebook icon
   - Twitter icon
   - GitHub icon
   - YouTube icon
   - Search icon (opens modal)

### Hero Section
- **Main Featured Post** (left, 2/3 width):
  - Full-height thumbnail background
  - Gradient overlay
  - Yellow "BLOG" tag
  - Post title (larger font)
  - Author and date metadata
  
- **Secondary Posts** (right, 1/3 width each):
  - Stacked vertically
  - Thumbnail backgrounds
  - Gradient overlays
  - Category tags
  - Post titles (smaller font)
  - Author and date metadata

### Content Section
- **Tabs**:
  - Bài mới (New Posts)
  - ALL
  - PROGRAMMING
  - SYSTEM
  - DESIGN
  - APPLICATIONS
  - TECH
  - Active tab highlighted with accent color

- **Articles List**:
  - Horizontal layout per article
  - Left: Thumbnail (200x150px)
  - Right: Content area
    - Title
    - Author • Date • Comments count
    - Short excerpt

### Sidebar
- **Popular Posts Widget**:
  - Featured post (rank 01):
    - Gradient background (purple)
    - Thumbnail image
    - Title and date
    - White text
  - Other posts (ranks 02-05):
    - Gray border
    - Rank number in circle
    - Title only
    - Hover effect

### Footer
- **Three Column Layout**:
  1. Navigation links
  2. Social media icons (circular backgrounds)
  3. Widget area (optional)
  
- **Copyright Bar**:
  - WordPress credit
  - Theme name
  - Current year

## Responsive Breakpoints

### Desktop (≥1200px)
- Full 2-column layout
- Hero grid: 2/3 + 1/3 split
- All elements in multi-column layouts

### Tablet (768px - 1199px)
- Single column layout
- Sidebar below content
- Hero grid maintains structure
- Tabs wrap if needed

### Mobile (<768px)
- Single column stacked layout
- Hero posts stacked vertically
- Article thumbnails above content
- Hamburger menu for navigation
- Smaller social icons

## Color Scheme

- **Primary**: #1a1a1a (text)
- **Accent**: #0066cc (links, highlights)
- **Tag Background**: #ffd700 (yellow for BLOG tags)
- **Background**: #ffffff (white)
- **Gray Light**: #f5f5f5
- **Gray**: #cccccc
- **Gray Dark**: #666666

## Typography

- **Font Family**: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif
- **Logo Size**: 1.5rem (24px)
- **H1 (Hero Main)**: 1.75rem (28px)
- **H2 (Hero Secondary)**: 1.25rem (20px)
- **H3 (Article Titles)**: 1.125rem (18px)
- **Body Text**: 1rem (16px)
- **Small Text**: 0.875rem (14px)
- **Tab Text**: 0.875rem (14px)

## Spacing

- Extra Small: 0.5rem (8px)
- Small: 1rem (16px)
- Medium: 1.5rem (24px)
- Large: 2rem (32px)
- Extra Large: 3rem (48px)

## Border & Shadow

- **Border Radius**: 4px (rounded corners)
- **Shadow Small**: 0 1px 3px rgba(0,0,0,0.12)
- **Shadow Medium**: 0 4px 6px rgba(0,0,0,0.1)
- **Shadow Large**: 0 10px 20px rgba(0,0,0,0.15)

## Transitions

- **Speed**: 0.2s ease
- **Hover Effects**:
  - Card lift: translateY(-2px to -4px)
  - Shadow increase
  - Color change to accent

## Accessibility Features

- ARIA labels on all icon buttons
- Keyboard navigation support
- Focus indicators
- Semantic HTML structure
- WCAG 2.1 AA color contrast
- Screen reader friendly
