# MacSoft WordPress Theme

A lightweight WordPress theme inspired by [macwk.com](https://www.macwk.com/) that spotlights macOS applications with a clean hero section, curated grids, and download-focused detail pages.

## Features

- Sticky glassmorphism header with live search form
- Hero section driven by Customizer controls (title, subtitle, CTA)
- Appearance → MacSoft Options page to override hero metrics + curated CTA copy
- App cards with badges for version, file size, compatibility, and download buttons
- Detail page modeled after macwk with stats grid, sticky download panel, mirror links, and tabbed content
- Custom meta box for managing download URL + metadata per post
- Responsive front page with category filters, featured collections, and secondary sections
- Optimized single template with hero layout, badges, and prominent download panel
- Basic archive, category, search, page, and 404 templates to keep the aesthetic consistent
- Custom image sizes, Google Fonts, and minimal vanilla JS for filtering

## Install

1. Copy the `macsoft-theme` directory into your WordPress `wp-content/themes` folder.
2. In `wp-admin → Appearance → Themes`, activate **MacSoft Theme**.
3. Set a static front page (`Settings → Reading`) and assign the "Front page" to any page using the default template.
4. Visit `Appearance → Customize → Hero Section` to set hero copy and CTA.
5. Visit `Appearance → MacSoft Options` if you want to override the hero statistics or curated CTA text/link.
6. When editing posts, fill out the **App Details** meta box (version/size/language/downloads/mirrors/install notes) so the single page renders stats + download buttons.
7. Assign posts to categories (e.g., Utilities, Creativity, Productivity) to power the filter tabs.

## Development notes

- Main styles live in `assets/css/main.css`; tweak colors or layout there.
- Lightweight jQuery helper in `assets/js/main.js` handles category filtering (uses `data-categories`).
- Template partial for app cards: `template-parts/content-card.php`.
- Theme options admin file: `inc/admin-settings.php` uses the Settings API for hero metrics + curated CTA.
- Single layout + styles live in `single.php` and `assets/css/main.css` (look for `.single-app`, `.app-panel`, `.app-tabs`).
- Add `macsoft_featured` meta (`yes`) to highlight posts in the front-page curated section (e.g., via Custom Fields plugin or code).
- The theme intentionally keeps dependencies minimal for easy customization.
