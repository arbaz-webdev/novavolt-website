# NovaVolt — Custom WordPress Block Theme

Enterprise block theme for NovaVolt Systems. Native Gutenberg, no build step, `theme.json` design tokens, reusable block patterns.

## Install (2 minutes)

**Option A — Upload via WordPress (easiest)**
1. Zip this `novavolt` folder → you get `novavolt.zip` (Windows: right-click the folder → *Send to → Compressed (zipped) folder*).
2. In wp-admin: **Appearance → Themes → Add New Theme → Upload Theme**.
3. Choose `novavolt.zip` → **Install Now** → **Activate**.

**Option B — Hostinger File Manager**
1. Upload the `novavolt` folder into `wp-content/themes/`.
2. wp-admin → **Appearance → Themes → Activate NovaVolt**.

## After activating
1. **Settings → Reading → Your homepage displays → A static page** (the front page uses `front-page.html` automatically, but set a Posts page for the blog).
2. Create these pages so the nav links resolve: About Us (`/about-us`), Services (`/services`), Portfolio (`/portfolio`), Blog (`/blog`), FAQ (`/faq`), Contact (`/contact`).
3. Optional plugins for later: a forms plugin (Contact Form 7 / Fluent Forms) for the contact form, and a newsletter plugin for signups.

## Editing
- **Colors / fonts / spacing:** Appearance → Editor → Styles, or edit `theme.json`. Real brand colors swap in under `settings.color.palette` (the `primary` slug = main blue).
- **Homepage sections:** Appearance → Editor → Templates → Front Page. Each section is a pattern under the **NovaVolt** category.
- **Header / footer:** Appearance → Editor → Patterns → Template Parts.

## Structure
```
novavolt/
├── style.css          Theme header + interaction/polish CSS
├── theme.json         Design system (colors, type, spacing, layout)
├── functions.php      Fonts, menus, pattern category
├── assets/js/         Scroll-reveal enhancement
├── parts/             header.html, footer.html
├── patterns/          hero, trust-bar, services, features, stats, testimonials, faq, cta
└── templates/         front-page, page, page-wide, single, index, 404
```

## Notes
- Placeholder brand palette: deep navy `#0A1E46` + NovaVolt blue `#2563EB` + cyan accent `#22D3EE`. Swap for real brand colors when available.
- Logos, testimonials, and stats use placeholder copy — replace with real assets/quotes before launch.
