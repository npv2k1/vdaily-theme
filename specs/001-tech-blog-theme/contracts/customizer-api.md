# Theme Customizer API Contract

**Feature**: Modern Tech Blog WordPress Theme  
**Date**: October 26, 2025  
**Purpose**: Define Theme Customizer settings and controls for user customization

## Overview

This document specifies all WordPress Theme Customizer panels, sections, settings, and controls provided by the theme for end-user customization.

---

## Customizer Structure

### Panels

#### `vdaily_design_panel`

**Title**: "VDaily Design Options"  
**Priority**: 30  
**Description**: "Customize the visual design and layout of your tech blog"

---

## Sections

### Colors Section

**ID**: `vdaily_colors`  
**Panel**: `vdaily_design_panel`  
**Title**: "Color Scheme"  
**Priority**: 10

#### Settings

**`vdaily_primary_color`**

- **Type**: `option`
- **Capability**: `edit_theme_options`
- **Default**: `#1a1a1a` (near-black)
- **Sanitize**: `sanitize_hex_color`
- **Control**: Color Picker
- **Label**: "Primary Color"
- **Description**: "Main text color used throughout the theme"

**`vdaily_accent_color`**

- **Type**: `option`
- **Capability**: `edit_theme_options`
- **Default**: `#0066cc` (blue)
- **Sanitize**: `sanitize_hex_color`
- **Control**: Color Picker
- **Label**: "Accent Color"
- **Description**: "Used for links, buttons, and highlights"

**`vdaily_background_color`**

- **Type**: `theme_mod` (WordPress default)
- **Capability**: `edit_theme_options`
- **Default**: `#ffffff` (white)
- **Sanitize**: `sanitize_hex_color`
- **Control**: Color Picker
- **Label**: "Background Color"
- **Description**: "Main background color for the site"

**`vdaily_code_background`**

- **Type**: `option`
- **Capability**: `edit_theme_options`
- **Default**: `#f5f5f5` (light gray)
- **Sanitize**: `sanitize_hex_color`
- **Control**: Color Picker
- **Label**: "Code Block Background"
- **Description**: "Background color for code blocks"

---

### Typography Section

**ID**: `vdaily_typography`  
**Panel**: `vdaily_design_panel`  
**Title**: "Typography"  
**Priority**: 20

#### Settings

**`vdaily_body_font`**

- **Type**: `option`
- **Capability**: `edit_theme_options`
- **Default**: `system-ui`
- **Sanitize**: `sanitize_text_field`
- **Control**: Select
- **Label**: "Body Font"
- **Description**: "Font family for body text"
- **Choices**:
  - `system-ui`: System Default
  - `georgia`: Georgia (serif)
  - `helvetica`: Helvetica (sans-serif)
  - `menlo`: Menlo (monospace, for code-heavy sites)

**`vdaily_heading_font`**

- **Type**: `option`
- **Capability**: `edit_theme_options`
- **Default**: `system-ui`
- **Sanitize**: `sanitize_text_field`
- **Control**: Select
- **Label**: "Heading Font"
- **Description**: "Font family for headings"
- **Choices**: (same as body font)

**`vdaily_font_size`**

- **Type**: `option`
- **Capability**: `edit_theme_options`
- **Default**: `16`
- **Sanitize**: `absint` (absolute integer)
- **Control**: Range
- **Label**: "Base Font Size"
- **Description**: "Base font size in pixels (14-20px recommended)"
- **Input Attrs**:
  - `min`: 14
  - `max`: 20
  - `step`: 1

**`vdaily_line_height`**

- **Type**: `option`
- **Capability**: `edit_theme_options`
- **Default**: `1.7`
- **Sanitize**: `vdaily_sanitize_float`
- **Control**: Range
- **Label**: "Line Height"
- **Description**: "Line height for body text (1.5-2.0 recommended)"
- **Input Attrs**:
  - `min`: 1.4
  - `max`: 2.0
  - `step`: 0.1

---

### Layout Section

**ID**: `vdaily_layout`  
**Panel**: `vdaily_design_panel`  
**Title**: "Layout"  
**Priority**: 30

#### Settings

**`vdaily_content_width`**

- **Type**: `option`
- **Capability**: `edit_theme_options`
- **Default**: `700`
- **Sanitize**: `absint`
- **Control**: Range
- **Label**: "Content Width"
- **Description**: "Maximum width of article content in pixels (600-900px recommended)"
- **Input Attrs**:
  - `min`: 600
  - `max`: 900
  - `step`: 10

**`vdaily_sidebar_position`**

- **Type**: `option`
- **Capability**: `edit_theme_options`
- **Default**: `none`
- **Sanitize**: `vdaily_sanitize_select`
- **Control**: Radio
- **Label**: "Sidebar Position"
- **Description**: "Where to display the sidebar (if widgets are active)"
- **Choices**:
  - `none`: No Sidebar (full width)
  - `right`: Right Sidebar
  - `left`: Left Sidebar

**`vdaily_archive_layout`**

- **Type**: `option`
- **Capability**: `edit_theme_options`
- **Default**: `list`
- **Sanitize**: `vdaily_sanitize_select`
- **Control**: Radio
- **Label**: "Archive Layout"
- **Description**: "How to display posts on archive pages"
- **Choices**:
  - `list`: List View (vertical stack)
  - `grid`: Grid View (2 columns on desktop)
  - `card`: Card View (3 columns on desktop)

---

### Code Display Section

**ID**: `vdaily_code_display`  
**Panel**: `vdaily_design_panel`  
**Title**: "Code Display"  
**Priority**: 40

#### Settings

**`vdaily_syntax_theme`**

- **Type**: `option`
- **Capability**: `edit_theme_options`
- **Default**: `tomorrow`
- **Sanitize**: `vdaily_sanitize_select`
- **Control**: Select
- **Label**: "Syntax Highlighting Theme"
- **Description**: "Color scheme for code blocks"
- **Choices**:
  - `tomorrow`: Tomorrow (light)
  - `tomorrow-night`: Tomorrow Night (dark)
  - `solarized-light`: Solarized Light
  - `solarized-dark`: Solarized Dark
  - `vs-code`: VS Code (light)
  - `vs-code-dark`: VS Code Dark

**`vdaily_show_line_numbers`**

- **Type**: `option`
- **Capability**: `edit_theme_options`
- **Default**: `false`
- **Sanitize**: `vdaily_sanitize_checkbox`
- **Control**: Checkbox
- **Label**: "Show Line Numbers"
- **Description**: "Display line numbers in code blocks by default"

**`vdaily_code_font_size`**

- **Type**: `option`
- **Capability**: `edit_theme_options`
- **Default**: `14`
- **Sanitize**: `absint`
- **Control**: Range
- **Label**: "Code Font Size"
- **Description**: "Font size for code blocks in pixels (12-18px)"
- **Input Attrs**:
  - `min`: 12
  - `max`: 18
  - `step`: 1

---

### Performance Section

**ID**: `vdaily_performance`  
**Panel**: `vdaily_design_panel`  
**Title**: "Performance"  
**Priority**: 50

#### Settings

**`vdaily_lazy_load_images`**

- **Type**: `option`
- **Capability**: `edit_theme_options`
- **Default**: `true`
- **Sanitize**: `vdaily_sanitize_checkbox`
- **Control**: Checkbox
- **Label**: "Enable Lazy Loading"
- **Description**: "Load images only when they enter the viewport (improves page speed)"

**`vdaily_webp_images`**

- **Type**: `option`
- **Capability**: `edit_theme_options`
- **Default**: `true`
- **Sanitize**: `vdaily_sanitize_checkbox`
- **Control**: Checkbox
- **Label**: "Serve WebP Images"
- **Description**: "Use WebP format for images when supported by browser (smaller file sizes)"

**`vdaily_minify_css`**

- **Type**: `option`
- **Capability**: `edit_theme_options`
- **Default**: `true`
- **Sanitize**: `vdaily_sanitize_checkbox`
- **Control**: Checkbox
- **Label**: "Minify CSS"
- **Description**: "Remove whitespace from CSS files (improves load time)"

---

### Content Section

**ID**: `vdaily_content_options`  
**Title**: "Content Options" (no panel, top-level section)  
**Priority**: 40

#### Settings

**`vdaily_excerpt_length`**

- **Type**: `option`
- **Capability**: `edit_theme_options`
- **Default**: `160`
- **Sanitize**: `absint`
- **Control**: Range
- **Label**: "Excerpt Length"
- **Description**: "Number of characters for post excerpts (100-300)"
- **Input Attrs**:
  - `min`: 100
  - `max`: 300
  - `step`: 10

**`vdaily_related_posts_count`**

- **Type**: `option`
- **Capability**: `edit_theme_options`
- **Default**: `5`
- **Sanitize**: `absint`
- **Control**: Range
- **Label**: "Related Posts Count"
- **Description**: "Number of related posts to show (3-10)"
- **Input Attrs**:
  - `min`: 3
  - `max`: 10
  - `step`: 1

**`vdaily_show_reading_time`**

- **Type**: `option`
- **Capability**: `edit_theme_options`
- **Default**: `true`
- **Sanitize**: `vdaily_sanitize_checkbox`
- **Control**: Checkbox
- **Label**: "Show Reading Time"
- **Description**: "Display estimated reading time on posts"

**`vdaily_show_reading_progress`**

- **Type**: `option`
- **Capability**: `edit_theme_options`
- **Default**: `true`
- **Sanitize**: `vdaily_sanitize_checkbox`
- **Control**: Checkbox
- **Label**: "Show Reading Progress"
- **Description**: "Display reading progress bar at top of single posts"

---

### Social Media Section

**ID**: `vdaily_social`  
**Title**: "Social Media" (no panel, top-level section)  
**Priority**: 50

#### Settings

**`vdaily_twitter_handle`**

- **Type**: `option`
- **Capability**: `edit_theme_options`
- **Default**: `''` (empty)
- **Sanitize**: `sanitize_text_field`
- **Control**: Text
- **Label**: "Twitter Handle"
- **Description**: "Your Twitter username (without @) for social meta tags"
- **Placeholder**: "yourusername"

**`vdaily_facebook_page`**

- **Type**: `option`
- **Capability**: `edit_theme_options`
- **Default**: `''` (empty)
- **Sanitize**: `esc_url_raw`
- **Control**: URL
- **Label**: "Facebook Page URL"
- **Description**: "Full URL to your Facebook page"
- **Placeholder**: "https://facebook.com/yourpage"

**`vdaily_default_og_image`**

- **Type**: `option`
- **Capability**: `edit_theme_options`
- **Default**: `''` (empty)
- **Sanitize**: `esc_url_raw`
- **Control**: Image Upload
- **Label**: "Default Social Sharing Image"
- **Description**: "Default image for posts without featured images (1200x630px recommended)"

---

## Custom Sanitization Functions

### `vdaily_sanitize_float($value)`

**Purpose**: Sanitize decimal numbers  
**Returns**: Float between 0 and 10

```php
function vdaily_sanitize_float($value) {
    $value = floatval($value);
    return ($value >= 0 && $value <= 10) ? $value : 1.7;
}
```

### `vdaily_sanitize_select($value, $setting)`

**Purpose**: Validate select/radio options  
**Returns**: Valid choice or default

```php
function vdaily_sanitize_select($value, $setting) {
    $choices = $setting->manager->get_control($setting->id)->choices;
    return array_key_exists($value, $choices) ? $value : $setting->default;
}
```

### `vdaily_sanitize_checkbox($value)`

**Purpose**: Sanitize boolean checkbox values  
**Returns**: Boolean

```php
function vdaily_sanitize_checkbox($value) {
    return (bool) $value;
}
```

---

## Accessing Settings in Templates

### Get Option Value

```php
// For 'option' type settings
$accent_color = get_option('vdaily_accent_color', '#0066cc');

// For 'theme_mod' type settings
$background = get_theme_mod('vdaily_background_color', '#ffffff');
```

### Use in CSS

Settings can be output as CSS custom properties:

```php
// In header.php or functions.php
function vdaily_customizer_css() {
    $primary_color = get_option('vdaily_primary_color', '#1a1a1a');
    $accent_color = get_option('vdaily_accent_color', '#0066cc');
    $font_size = get_option('vdaily_font_size', 16);

    ?>
    <style type="text/css">
        :root {
            --color-primary: <?php echo esc_attr($primary_color); ?>;
            --color-accent: <?php echo esc_attr($accent_color); ?>;
            --font-size-base: <?php echo esc_attr($font_size); ?>px;
        }
    </style>
    <?php
}
add_action('wp_head', 'vdaily_customizer_css');
```

---

## Customizer Partials (Selective Refresh)

For better UX, enable selective refresh for specific controls:

```php
$wp_customize->selective_refresh->add_partial('vdaily_accent_color', array(
    'selector' => ':root',
    'container_inclusive' => true,
    'render_callback' => 'vdaily_customizer_css',
));
```

**Supported Partials**:

- `vdaily_accent_color` - Refresh CSS custom properties
- `vdaily_primary_color` - Refresh CSS custom properties
- `vdaily_font_size` - Refresh CSS custom properties
- `vdaily_show_reading_progress` - Refresh progress bar visibility

---

## Customizer Controls Organization

```
Theme Customizer
│
├── Site Identity (WordPress default)
│   ├── Site Title
│   ├── Tagline
│   └── Site Icon
│
├── Colors (WordPress default)
│   └── Background Color
│
├── VDaily Design Options (Panel)
│   ├── Color Scheme
│   │   ├── Primary Color
│   │   ├── Accent Color
│   │   └── Code Block Background
│   │
│   ├── Typography
│   │   ├── Body Font
│   │   ├── Heading Font
│   │   ├── Base Font Size
│   │   └── Line Height
│   │
│   ├── Layout
│   │   ├── Content Width
│   │   ├── Sidebar Position
│   │   └── Archive Layout
│   │
│   ├── Code Display
│   │   ├── Syntax Highlighting Theme
│   │   ├── Show Line Numbers
│   │   └── Code Font Size
│   │
│   └── Performance
│       ├── Enable Lazy Loading
│       ├── Serve WebP Images
│       └── Minify CSS
│
├── Content Options
│   ├── Excerpt Length
│   ├── Related Posts Count
│   ├── Show Reading Time
│   └── Show Reading Progress
│
├── Social Media
│   ├── Twitter Handle
│   ├── Facebook Page URL
│   └── Default Social Sharing Image
│
├── Menus (WordPress default)
├── Widgets (WordPress default)
└── Homepage Settings (WordPress default)
```

---

## Default Values Summary

| Setting               | Default Value | Type     |
| --------------------- | ------------- | -------- |
| Primary Color         | `#1a1a1a`     | Color    |
| Accent Color          | `#0066cc`     | Color    |
| Background Color      | `#ffffff`     | Color    |
| Code Background       | `#f5f5f5`     | Color    |
| Body Font             | `system-ui`   | Select   |
| Heading Font          | `system-ui`   | Select   |
| Font Size             | `16px`        | Range    |
| Line Height           | `1.7`         | Range    |
| Content Width         | `700px`       | Range    |
| Sidebar Position      | `none`        | Radio    |
| Archive Layout        | `list`        | Radio    |
| Syntax Theme          | `tomorrow`    | Select   |
| Show Line Numbers     | `false`       | Checkbox |
| Code Font Size        | `14px`        | Range    |
| Lazy Load Images      | `true`        | Checkbox |
| WebP Images           | `true`        | Checkbox |
| Minify CSS            | `true`        | Checkbox |
| Excerpt Length        | `160` chars   | Range    |
| Related Posts         | `5`           | Range    |
| Show Reading Time     | `true`        | Checkbox |
| Show Reading Progress | `true`        | Checkbox |

---

## Export/Import Settings

Settings can be exported/imported using WordPress Customizer Export/Import plugins or custom implementation:

```php
// Export all VDaily settings
function vdaily_export_settings() {
    $settings = array();
    $options = wp_load_alloptions();

    foreach ($options as $key => $value) {
        if (strpos($key, 'vdaily_') === 0) {
            $settings[$key] = $value;
        }
    }

    return json_encode($settings);
}
```

---

## Reset to Defaults

Provide a reset function for users:

```php
function vdaily_reset_customizer_settings() {
    // List of all VDaily options
    $options = array(
        'vdaily_primary_color',
        'vdaily_accent_color',
        'vdaily_font_size',
        // ... all settings
    );

    foreach ($options as $option) {
        delete_option($option);
    }
}
```

---

## Testing Customizer Settings

```php
// PHPUnit test
class Test_Customizer extends WP_UnitTestCase {
    public function test_default_accent_color() {
        $color = get_option('vdaily_accent_color', '#0066cc');
        $this->assertEquals('#0066cc', $color);
    }

    public function test_sanitize_select() {
        $valid = vdaily_sanitize_select('grid', $mock_setting);
        $this->assertEquals('grid', $valid);

        $invalid = vdaily_sanitize_select('invalid', $mock_setting);
        $this->assertEquals('list', $invalid); // Falls back to default
    }
}
```

---

## Browser Compatibility

All Customizer features work in:

- Chrome 90+
- Firefox 88+
- Safari 14+
- Edge 90+

Live preview requires JavaScript enabled.
