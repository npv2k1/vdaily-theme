# Dev.to-Style Home Layout - Visual Guide

## Desktop View (≥1280px)

```
┌──────────────────────────────────────────────────────────────────────────────┐
│ HEADER                                                                        │
│ ┌──────┐  ┌─────────────────────────────────┐  ┌──────────────────────────┐ │
│ │ 2k1  │  │ Home Programming System Design  │  │ [f][t][g][y] [Search🔍] │ │
│ └──────┘  └─────────────────────────────────┘  └──────────────────────────┘ │
└──────────────────────────────────────────────────────────────────────────────┘

┌─────────────┬──────────────────────────────────────────┬──────────────────────┐
│ LEFT        │              MAIN FEED                    │      RIGHT           │
│ SIDEBAR     │                                           │      SIDEBAR         │
│             │                                           │                      │
│ ┌─────────┐ │ ┌───────────────────────────────────────┐│ ┌──────────────────┐│
│ │  🏠 Home│ │ │ [Relevant] [Latest] [Top]             ││ │ Listings         ││
│ │         │ │ └───────────────────────────────────────┘│ │  • events        ││
│ │ 💻 Prog │ │                                           │ │  • jobs          ││
│ │         │ │ ┌───────────────────────────────────────┐│ │  • collabs       ││
│ │ 📚 Tuto │ │ │ ┌────┐ John Doe                       ││ │ [See all]        ││
│ │         │ │ │ │img │ Posted on Oct 27, 2025         ││ └──────────────────┘│
│ │ 🚀 Tech │ │ │ └────┘                                 ││                      │
│ └─────────┘ │ │                                         ││ ┌──────────────────┐│
│             │ │ How to Build a Dev.to Clone in 2025    ││ │ Trending         ││
│ Popular     │ │ #javascript #webdev #tutorial          ││ │                  ││
│ Tags        │ │                                         ││ │ 1. ┌──┐         ││
│ ┌─────────┐ │ │ [Featured Image]                       ││ │    │  │ Post 1  ││
│ │#javascript││ │                                         ││ │    └──┘         ││
│ │#python   ││ │ ❤️ 0  🦄 0  🔖 0  💬 5  ⏱️ 3min         ││ │    ❤️ 42 💬 12  ││
│ │#webdev   ││ └───────────────────────────────────────┘│ │                  ││
│ │#react    ││                                           │ │ 2. Post 2        ││
│ │#nodejs   ││ ┌───────────────────────────────────────┐│ │    ❤️ 35 💬 8   ││
│ │#tutorial ││ │ ┌────┐ Jane Smith                     ││ │                  ││
│ │#devops   ││ │ │img │ Posted on Oct 26, 2025         ││ │ 3. Post 3        ││
│ │#docker   ││ │ └────┘                                 ││ │    ❤️ 28 💬 6   ││
│ │#database ││ │                                         ││ └──────────────────┘│
│ │#css      ││ │ Understanding CSS Grid Layout          ││                      │
│ └─────────┘ │ │ #css #frontend #design                 ││ ┌──────────────────┐│
│             │ │                                         ││ │ #help            ││
│ [Social]    │ │ [Featured Image]                       ││ │ Need help?       ││
│ [f][t][g][y]│ │                                         ││ │ Ask community!   ││
│             │ │ ❤️ 0  🦄 0  🔖 0  💬 12  ⏱️ 5min        ││ │ [Submit]         ││
│             │ └───────────────────────────────────────┘│ └──────────────────┘│
│             │                                           │                      │
│             │ [More posts...]                           │ ┌──────────────────┐│
│             │                                           │ │ Recent Activity  ││
│             │ [Pagination: ← 1 2 3 4 5 →]              │ │ • User comment   ││
│             │                                           │ │ • User comment   ││
└─────────────┴──────────────────────────────────────────┴──────────────────────┘

┌──────────────────────────────────────────────────────────────────────────────┐
│ FOOTER                                                                        │
│ [Navigation] [Social Media] [© 2025 All rights reserved]                    │
└──────────────────────────────────────────────────────────────────────────────┘
```

## Tablet View (768px - 1024px)

```
┌────────────────────────────────────────────────────────────────┐
│ HEADER                                                          │
│ [2k1] [Menu] [Social] [Search]                                 │
└────────────────────────────────────────────────────────────────┘

┌────────────────────────────────┬───────────────────────────────┐
│        MAIN FEED               │     RIGHT SIDEBAR             │
│                                │                               │
│ [Tabs]                         │ [Listings]                    │
│                                │ [Trending]                    │
│ [Post Cards]                   │ [Help]                        │
│ [...]                          │ [Activity]                    │
│                                │                               │
└────────────────────────────────┴───────────────────────────────┘

┌────────────────────────────────────────────────────────────────┐
│ FOOTER                                                          │
└────────────────────────────────────────────────────────────────┘
```

## Mobile View (<768px)

```
┌──────────────────────────┐
│ HEADER                   │
│ [☰] [2k1] [🔍]          │
└──────────────────────────┘

┌──────────────────────────┐
│     MAIN FEED            │
│                          │
│ [Tabs - Wrapped]         │
│                          │
│ ┌──────────────────────┐ │
│ │ [Author Avatar]      │ │
│ │ Post Title           │ │
│ │ #tags                │ │
│ │                      │ │
│ │ [Full-width Image]   │ │
│ │                      │ │
│ │ ❤️ 0  🦄 0  🔖 0     │ │
│ │ 💬 5  ⏱️ 3min        │ │
│ └──────────────────────┘ │
│                          │
│ ┌──────────────────────┐ │
│ │ [Next Post...]       │ │
│ └──────────────────────┘ │
│                          │
│ [Pagination]             │
│                          │
└──────────────────────────┘

┌──────────────────────────┐
│ FOOTER (Stacked)         │
└──────────────────────────┘
```

## Key Features Illustrated

### Post Card Structure
```
┌─────────────────────────────────────────┐
│ ┌────┐  Author Name                     │
│ │img │  Posted on Date                  │  ← Header with Author Info
│ └────┘                                   │
├─────────────────────────────────────────┤
│                                          │
│  Large, Bold Post Title Goes Here       │  ← Title (clickable)
│  Making it Easy to Read                 │
│                                          │
│  #tag1 #tag2 #tag3                      │  ← Tags (clickable)
│                                          │
├─────────────────────────────────────────┤
│                                          │
│     [Featured Image - Full Width]       │  ← Optional Featured Image
│                                          │
├─────────────────────────────────────────┤
│ ❤️ 0  🦄 0  🔖 0  |  💬 5  ⏱️ 3min      │  ← Footer with Reactions & Meta
└─────────────────────────────────────────┘
```

### Color Palette
```
Background:         #f5f5f5  ████████ (Light Gray)
Cards:              #ffffff  ████████ (White)
Primary Text:       #1a1a1a  ████████ (Near Black)
Secondary Text:     #666666  ████████ (Medium Gray)
Accent/Links:       #0066cc  ████████ (Blue)
Borders:            #cccccc  ████████ (Light Gray)
Hover:              #f5f5f5  ████████ (Very Light Gray)
```

### Spacing System
```
Extra Small (xs):   8px    ├──┤
Small (sm):         16px   ├────┤
Medium (md):        24px   ├──────┤
Large (lg):         32px   ├────────┤
Extra Large (xl):   48px   ├────────────┤
```

### Typography Scale
```
Post Title:         1.5rem (24px)  ▓▓▓▓▓
Tab Text:           0.875rem (14px) ▓▓▓
Body Text:          1rem (16px)     ▓▓▓▓
Meta Text:          0.813rem (13px) ▓▓
```

## Interactive Elements

### Tabs
```
┌─────────────────────────────────────────┐
│ [Relevant] [Latest] [Top]               │  ← Tab Navigation
│  ▔▔▔▔▔▔▔▔                               │  (Active underlined)
└─────────────────────────────────────────┘
```

### Tag Display
```
[#javascript] [#webdev] [#tutorial]        ← Border, rounded corners
                                            Hover: highlighted
```

### Navigation Links
```
🏠 Home          ← Default state
💻 Programming   ← Hover: background gray
📚 Tutorials     ← Active: background + accent color
🚀 Tech News
```

### Trending Posts
```
1  ┌──┐ User Name                         ← Rank + Avatar + Info
   │  │ Post Title That Is Trending
   └──┘ ❤️ 42  💬 12                       ← Reaction counts
```

## Responsive Behavior

### Breakpoints
- **1280px+**: Full 3-column (240px | auto | 320px)
- **1024-1279px**: 2-column (main + right)
- **768-1023px**: 2-column (main + right, smaller)
- **<768px**: Single column (mobile)

### Grid Collapse Sequence
1. First to hide: Left sidebar (≤1024px)
2. Second to hide: Right sidebar (≤768px)
3. Cards adjust: Vertical stack on mobile

## Accessibility Features

✓ Semantic HTML5 structure
✓ ARIA labels on icons/buttons
✓ Keyboard navigation support
✓ High contrast ratios (WCAG AA)
✓ Focus indicators
✓ Alt text for images
✓ Screen reader friendly

## Performance

- Sticky sidebars (position: sticky)
- CSS Grid for layout (no JS)
- Minimal CSS overhead (~11KB)
- Optimized selectors
- No heavy animations
- Lazy loading ready
