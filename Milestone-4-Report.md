# Milestone 4 — Performance, Accessibility, Security & QA

**Site:** NovaVolt Systems (staging)
**Status:** Complete, verified by measurement on the live staging site.

---

## 1. Performance

### Results

| Metric | Before | After | Google "Good" threshold |
|---|---|---|---|
| TTFB (server response) | 2,171 ms | **319 ms** | < 800 ms |
| First Contentful Paint | — | **524 ms** | < 1,800 ms |
| Largest Contentful Paint | — | **524 ms** | < 2,500 ms |
| Cumulative Layout Shift | — | **0** | < 0.1 |
| DOM ready | 2,968 ms | **596 ms** | — |
| Page fully loaded | 3,058 ms | **660 ms** | — |
| Requests | 33 | 31 | — |

**All three Core Web Vitals pass comfortably.** Cached repeat responses return in ~1 ms; uncached ~300 ms.

### What was changed

- **Inter switched to a single variable font** covering weights 400–800, replacing five separate static weight files. Fewer bytes, one request.
- **Emoji polyfill removed** — deleted a JavaScript file, a stylesheet and a third-party DNS lookup to `s.w.org`. WordPress loads this on every page by default and the site does not use it.
- **Theme JavaScript deferred** so it never blocks rendering.
- **Layout shift eliminated** — the logo carries explicit width/height, so nothing jumps as the page loads (CLS measured at exactly 0).
- Server-side caching confirmed active on the host.

---

## 2. Accessibility (WCAG 2.1 AA)

### Fixed

- **Colour contrast: 59 failures → 0.** Brand blue and muted greys failed AA at small sizes. Introduced an accessible on-light blue (`#1C6DB0`, 5.6:1) for small text and links, darkened muted text, trust-bar wordmarks (was 2.14:1), star ratings and the primary button gradient.
- **Keyboard focus indicators added** site-wide — previously missing entirely, which made the site unusable by keyboard.
- **Navigation regions named** — the primary nav had no accessible name and the two footer menus were auto-labelled " 2" and " 3". Now "Primary", "Footer: company", "Footer: services".
- **Heading structure corrected** — an h2 → h4 jump in the footer was breaking the outline. Zero skipped levels now.
- **Reduced-motion support** — all decorative animation (marquee, pulsing dots, hover lifts) is disabled for users who request reduced motion.

### Verified clean

One `h1` per page · all images have alt text · no empty links or unnamed buttons · skip link present · `lang` attribute set · header/main/footer landmarks correct.

---

## 3. Security

| Issue found | Status |
|---|---|
| Username `hearbaz` exposed via `/?author=1` | **Fixed** — redirects to home, author archives disabled |
| Username exposed via REST API `/wp-json/wp/v2/users` | **Fixed** — returns 404 for anonymous requests |
| XML-RPC fully callable (brute-force / DDoS vector) | **Fixed** — endpoint returns 403 |
| WordPress version advertised in page source | **Fixed** — generator tag and asset version strings removed |
| Missing security headers | **Fixed** — `X-Content-Type-Options`, `X-Frame-Options`, `Referrer-Policy`, `Permissions-Policy` added |
| Login errors confirmed valid usernames | **Fixed** — generic failure message |
| `X-Pingback` header advertised | **Fixed** — removed |
| Directory listing on uploads | Already blocked (403) |

### Remaining, needs server access (not possible from WordPress admin)

1. **Delete `/readme.html`** — currently returns 200 and reveals the WordPress version. Remove via Hostinger File Manager.
2. **Disable the file editor** — add `define('DISALLOW_FILE_EDIT', true);` to `wp-config.php` before handover. *Note: this also disables the method used to deploy theme changes, so apply it at the end of the project.*
3. **Login attempt limiting** — worth a plugin such as Limit Login Attempts Reloaded before launch.

---

## 4. QA

- **All 17 internal links crawled** — 2 broken links found (`/privacy-policy/` was an unpublished draft, `/terms/` did not exist). Both pages have now been created and published.
- **Contact form tested end to end** — submits successfully ("Thank you for your message. It has been sent.")
- **Newsletter form tested** — submits successfully.
- **404 page verified** — returns a correct 404 status with the custom branded template.
- **Responsive testing** — verified at 390 px through 2560 px.
- **Bugs found and fixed during QA:** invisible "Why NovaVolt" section, unreadable FAQ text, dead "Book a demo" link, overlapping bento cards on service pages, unreadable CTA button, and the mobile menu showing only one link.

### Known limitation

Cross-browser testing was performed in Chrome only. The layout uses the modern CSS `:has()` selector, supported in Chrome 105+, Safari 15.4+ and Firefox 121+ — current versions of all major browsers, but worth a visual check in Safari and Firefox before launch.

---

## Outstanding before go-live (client actions)

1. **Content verification** — placeholder claims (99.99% SLA, "3,000+ businesses", testimonials, integrations list, U.S. data centres) still need confirming or softening.
2. **Legal review** — the Privacy Policy and Terms pages are structured starting templates and are marked as drafts on-page. They need review by a qualified advisor and real company details.
3. Real brand assets, social media URLs, and the production domain.
