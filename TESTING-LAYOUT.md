# Testing Guide for Layout Specification Implementation

## Overview
This guide provides instructions for testing the newly implemented homepage layout specification for the vdaily-theme WordPress theme.

## Testing Checklist

### 1. Header Testing

#### Logo
- [ ] Navigate to the homepage
- [ ] Verify "2k1" logo appears in the top-left corner (or custom logo if set)
- [ ] Click the logo to verify it links to the homepage

#### Navigation Menu
- [ ] Verify navigation menu displays with the following structure:
  - HOME
  - PROGRAMMING (with dropdown if category has children)
  - SYSTEM (with dropdown if category has children)
  - DESIGN (with dropdown if category has children)
  - APPLICATIONS (with dropdown if category has children)
  - TECH (with dropdown if category has children)
- [ ] Test mobile responsive menu (hamburger icon on small screens)
- [ ] Verify dropdown menus work on hover/click

#### Social Media Icons
- [ ] Configure social media URLs in WordPress Admin:
  - Go to Appearance > Customize > Social Media Links
  - Add URLs for Facebook, Twitter, GitHub, YouTube
- [ ] Verify icons appear in the header (top-right)
- [ ] Click each icon to verify they open in new tabs
- [ ] Verify search icon opens search modal

#### Search Modal
- [ ] Click the search icon in the header
- [ ] Verify modal overlay appears with search form
- [ ] Type a search query and submit
- [ ] Close the modal by clicking the X button or overlay
- [ ] Verify ESC key closes the modal

### 2. Hero Section Testing

#### Layout
- [ ] Verify hero section displays with 3 featured posts:
  - 1 large post on the left (2/3 width)
  - 2 smaller posts on the right (1/3 width each)
- [ ] Verify posts display with:
  - Thumbnail background image
  - Post title
  - Author name
  - Date
  - Category tag (yellow "BLOG" or category name)

#### Featured Posts Selection
- [ ] Posts marked as featured (using `_vdaily_featured` custom field) appear first
- [ ] If no featured posts exist, latest 3 posts are shown
- [ ] Hover effects work correctly (slight upward movement and shadow)

### 3. Content Section Testing

#### Tabs
- [ ] Verify tabs display in this order:
  - Bài mới (New Posts)
  - ALL
  - PROGRAMMING
  - SYSTEM
  - DESIGN
  - APPLICATIONS
  - TECH
- [ ] Click each tab to filter posts by category
- [ ] Verify active tab is highlighted with accent color underline
- [ ] Test tab functionality on mobile (tabs should wrap to multiple lines if needed)

#### Articles List
- [ ] Verify each article displays:
  - Thumbnail image (left, 200px wide)
  - Title (right)
  - Author name
  - Date
  - Comments count
  - Short excerpt (120 characters)
- [ ] Hover effects work correctly (shadow and slight upward movement)
- [ ] Click article to verify it opens the single post page

#### Pagination
- [ ] If more than 10 posts exist, verify pagination appears
- [ ] Test pagination navigation

### 4. Sidebar Testing

#### Popular Posts Widget
- [ ] Go to Appearance > Widgets
- [ ] Add "VDaily: Popular Posts" widget to Sidebar
- [ ] Configure the widget:
  - Set title to "POPULAR POST"
  - Set number of posts (default: 5)
- [ ] Verify sidebar displays on the right (300px width)
- [ ] Verify popular posts widget shows:
  - First post (rank 01) with featured styling (gradient background)
  - Thumbnail for first post
  - Title and date for first post
  - Rank numbers (01, 02, 03, etc.) for all posts
  - Post titles for remaining posts

### 5. Footer Testing

#### Navigation Menu
- [ ] Go to Appearance > Menus
- [ ] Create or assign a footer menu
- [ ] Verify footer navigation displays correctly
- [ ] Test footer menu links

#### Social Media Icons
- [ ] Verify social media icons appear in footer
- [ ] Icons should have gray background circles
- [ ] Hover effect: background turns accent color, icon turns white
- [ ] Icons should match those configured in header

#### Copyright
- [ ] Verify footer displays:
  - "Powered by WordPress"
  - "Theme: VDaily"
  - Copyright year (current year)

### 6. Responsive Design Testing

#### Desktop (1200px+)
- [ ] 2-column layout (main content + sidebar)
- [ ] Hero grid shows 1 large + 2 smaller posts
- [ ] All elements properly aligned

#### Tablet (768px - 1023px)
- [ ] Single column layout (sidebar moves below content)
- [ ] Hero grid shows 1 large + 2 smaller posts
- [ ] Tabs remain horizontal with wrapping

#### Mobile (< 768px)
- [ ] Single column layout
- [ ] Hero grid shows 3 posts stacked vertically
- [ ] Hamburger menu for navigation
- [ ] Articles display thumbnail above content
- [ ] Tabs wrap to multiple rows with smaller font
- [ ] Social icons reduce in size

### 7. Visual Style Testing

#### Colors
- [ ] Yellow tag color (#ffd700) for "BLOG" category labels
- [ ] Accent color (#06c) for links and highlights
- [ ] White background
- [ ] Proper contrast for readability

#### Layout Elements
- [ ] Rounded corners (4px border-radius) on cards
- [ ] Subtle shadows on hover
- [ ] Proper spacing between elements
- [ ] Clean sans-serif typography

#### Images
- [ ] All images maintain 16:9 aspect ratio (landscape)
- [ ] Images cover their containers properly
- [ ] No image distortion or stretching

### 8. Accessibility Testing

- [ ] Keyboard navigation works for all interactive elements
- [ ] ARIA labels present for icon buttons
- [ ] Color contrast meets WCAG 2.1 AA standards
- [ ] Screen reader announces modal open/close
- [ ] Focus indicators visible

### 9. Performance Testing

- [ ] Page loads in under 3 seconds
- [ ] CSS and JS files are minified (in production build)
- [ ] Images load efficiently
- [ ] No console errors

### 10. Browser Testing

Test in the following browsers:
- [ ] Chrome (latest)
- [ ] Firefox (latest)
- [ ] Safari (latest)
- [ ] Edge (latest)
- [ ] Mobile Safari (iOS)
- [ ] Chrome Mobile (Android)

## Setup Instructions

### Initial Setup
1. Install WordPress 6.0 or higher
2. Activate the vdaily-theme
3. Create sample categories: PROGRAMMING, SYSTEM, DESIGN, APPLICATIONS, TECH
4. Create at least 15 sample posts with featured images
5. Assign categories to posts
6. Create sample menus for primary and footer navigation

### Configure Social Media
1. Go to Appearance > Customize
2. Navigate to "Social Media Links"
3. Add URLs for:
   - Facebook
   - Twitter
   - GitHub
   - YouTube
4. Click "Publish"

### Configure Widgets
1. Go to Appearance > Widgets
2. Add "VDaily: Popular Posts" to Sidebar
3. Set title to "POPULAR POST"
4. Set number of posts to 5
5. Save widget

### Set Featured Posts (Optional)
To mark posts as featured for hero section:
1. Edit a post
2. Add custom field: `_vdaily_featured` with value `1`
3. Save post
4. Repeat for 2-3 posts

## Known Issues
None at this time.

## Support
For issues or questions, please create an issue in the GitHub repository.
