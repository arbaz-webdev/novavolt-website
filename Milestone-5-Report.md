# Milestone 5 — Client Corrections & Final QA

**Site:** NovaVolt Systems (staging)
**Theme version:** 4.0.4
**Prepared by:** Jawad
**Date:** 18 August 2026

This responds to each of the 17 points in your Milestone 4 feedback, then reports the final QA pass you asked for. Sixteen are complete; only the contact-form delivery test remains, and that needs a mailbox from you. Everything marked **Done** has been applied to the staging site and verified by measurement, not by eye.

---

## 1. Encryption / security wording — Done

Every broad encryption claim has been replaced with your approved wording:

> "Secure communications with encrypted signaling and industry-standard security practices."

Changed in five places: the homepage security band (heading "Encrypted end to end" → "Secure by design"), the homepage services card, the Security & Reliability service page (heading, body copy, feature card, and the "Encryption active / In transit and at rest" status row), and the reusable Security pattern in the theme.

Two related claims were softened at the same time, because they carry the same risk:

| Was | Now |
|---|---|
| "99.99% uptime SLA" | "Reliable by design" |
| "U.S. data centers … geo-distributed" | "U.S.-based infrastructure … redundant" |

**Still needs your confirmation:** the Security page also claims *fraud protection* ("unusual calling patterns are flagged to protect you from toll fraud") and offers to "confirm the exact data centre locations during onboarding." Neither appears on your current live site. Tell me if they are accurate and I will keep them, or I will remove them.

## 2. Number porting wording — Done

Now reads: **"Free number porting with a smooth, hassle-free transition."**

The absolute claim ("no downtime during the switch") is gone from all three places it appeared: the Business Phone Systems page, the homepage FAQ, and the reusable FAQ pattern. The Business Phone Systems bullet "Number porting included" now reads "Free number porting."

## 3. Placeholder customers, testimonials and statistics — Done

Everything implying existing customers has been removed:

- **Trust bar** — the eight invented company names (Northwind, BrightPath, Meridian Group, Cascade Co., Vertex Labs, Harbor Health, Summit Legal, TrueNorth) and the "Trusted by growing U.S. businesses" heading are gone. Replaced with a strip of your actual commercial terms: no setup fees · free number porting · cancel anytime · Dallas-based support · 14-day free trial.
- **Testimonials** — all three fake quotes (Dana Whitfield, Marcus Reyes, Priya Nair) and their star ratings removed. That section is now "Built to be easy to say yes to", six cards built only from terms published on your live site.
- **Statistics** — "3,000+ businesses connected", "40% more calls answered" and the "4.9/5 customer rating" are gone from the About page band, replaced with 50 states served · 24/7 AI answering · $0 setup fees · 14-day trial.
- **Demo data** — the product screenshots are kept, because they explain the product, but they are now unmistakably examples. The dashboard is titled "NovaVolt Dashboard — illustrative example", the caller is "Example Caller" rather than a named dental practice, and a caption underneath reads **"Illustrative product example. Not actual customer data."**

Importantly, this was also fixed in the **reusable patterns inside the theme**, not just on the pages. Six patterns still contained the invented names and the 99.99% claim; anyone building a new page could have inserted them straight back in. They are all clean now.

## 4. Integrations — Done

The section now shows only your five confirmed integrations — **Microsoft Teams, ConnectWise, QuickBooks Online, Google Contacts, Outlook** — plus a "CRM integrations available" tile using your suggested general wording.

Removed: Salesforce, HubSpot, Slack, Zapier, Pipedrive, Zoho CRM, the broad "Google Workspace" claim, and "+ 50 more integrations."

Marks remain neutral lettered monograms rather than official vendor logos. Displaying a provider's real logo needs that provider's brand approval, so I would not add them until each integration is live and permission is confirmed.

## 5. Products, plans and pricing — Done

I used your live website as the approved reference and carried the commercial detail into V2 as a new **Pricing page** (`/pricing/`), now linked in the main and footer navigation:

| Plan | Monthly | Annual |
|---|---|---|
| Starter | $29.99/user/mo | $24.99/user/mo |
| Professional (most popular) | $39.99/user/mo | $32.99/user/mo |
| Advanced | $59.99/user/mo | $49.99/user/mo |

Full feature lists are reproduced per plan, with the add-ons (AI Receptionist Basic $59.99/mo and Pro $119.99/mo, Communication Suite Standard $15/user/mo and Pro $25/user/mo, plus custom-priced vanity numbers, international calling and integrations), and the terms: no setup fees, cancel anytime, free number porting, 14-day free trial with no credit card, annual billing saving roughly 17%.

A pricing page was not in the original page list, so please confirm you want it public. If you would rather hold pricing back until launch, I can unpublish it in a minute.

## 6. Contact email — Done

**contact@novavoltsystems.com** now appears on the Contact page and in the footer. The old `hello@novavoltsystems.com` is gone from the site.

## 7. Phone numbers — Done

- **Toll-free (800) 430-3317** is now the primary call-to-action number. It appears as a click-to-call link in the site header on every page, in the footer, on the Contact page, and as the primary button in every call-to-action band across the site (previously "Book a demo", which pointed at a form).
- **Dallas / local (214) 430-3317** appears on the Contact page and in the footer.

Both are proper `tel:` links, so they dial directly on mobile.

## 8. Location / mailing address — Done

General references now read **Dallas, Texas**. The full address appears in only two places, explicitly labelled:

> **Mailing Address:** 1910 Pacific Ave, Suite 2000, Dallas, TX 75201

It is also encoded in the site's structured data so search engines associate the business with Dallas.

## 9. Social media — Done

The four placeholder social icons, which linked nowhere, have been removed from the footer. The markup is commented so the block can be restored in one edit once you send the official URLs.

## 10. Contact forms — Partially done

**Done:** both forms — the Contact page form and the footer newsletter signup — now deliver to **contact@novavoltsystems.com**. The newsletter form's subject line was also fixed; it previously referenced a subject field that form does not have.

**Not done — needs a decision from you.** I have not sent a live test, because the test lands in your real inbox and I cannot read that mailbox to confirm arrival. More importantly, a success message on screen does not prove delivery: the site currently sends through basic PHP mail as `wordpress@lightyellow-kingfisher-780485.hostingersite.com`, and mail sent from a shared host on one domain to an address on a different domain is frequently spam-filtered or rejected outright.

I have installed **WP Mail SMTP** ready to fix this properly. To finish it I need a mailbox and app password for novavoltsystems.com. Once that is in place the forms will send authenticated, and I will run an end-to-end test and confirm receipt. Until then, please treat form delivery as unverified.

## 11. Privacy Policy — Done

Replaced in full with the finalized text you supplied, all ten sections, dated **Last Updated: August 16, 2026**. The public "Draft for review" notice has been removed.

## 12. Terms of Service — Done

Replaced in full with the finalized text you sent, all fifteen sections, dated **Last Updated: August 16, 2026**. The public "Draft for review" notice has been removed.

Two small presentational touches: the Privacy Policy reference in section 10 is a working link, and the contact address in section 15 is clickable. The wording itself is exactly as you supplied it.

## 13. Remaining server-level security items — Done, with clarification

You asked what each remaining item is, whether it is required or recommended, whether I can do it, and whether you need to act in Hostinger. All three are now resolved:

| Item | What it is | Required? | Who | Status |
|---|---|---|---|---|
| `/readme.html` | Ships with WordPress and states the exact version, which tells an attacker which exploits to try | Required | Me | **Done** — deleted, and blocked in `.htaccess` so it stays blocked when WordPress recreates it on the next update |
| `/license.txt` | Same problem, not previously flagged | Recommended | Me | **Done** — deleted and blocked |
| Login attempt limiting | Without it, the login form can be brute-forced indefinitely | Required | Me | **Done** — Limit Login Attempts Reloaded installed and active |
| `DISALLOW_FILE_EDIT` | Stops anyone who gains admin access from editing theme code from the dashboard | Recommended | Me, at handover | **Deliberately deferred** — see below |

**Nothing is needed from you in Hostinger.** I had panel access and completed the work.

On `DISALLOW_FILE_EDIT`: this is the setting that also disables the mechanism used to deploy theme changes. Applying it now would mean any further correction requires undoing it first. It should be the last change made before handover, once you have approved the site. Say the word at that point and it takes two minutes.

## 14. Final security verification — Done

Re-tested every fix from Milestone 4, anonymously (logged out), against the live staging site:

| Check | Result |
|---|---|
| Username disclosure via `/?author=1` | Redirects to home |
| Username disclosure via REST API | Returns 404 |
| XML-RPC | Returns 403 |
| WordPress version in page source | Absent |
| WordPress version in asset URLs | Absent |
| `X-Content-Type-Options`, `X-Frame-Options`, `Referrer-Policy`, `Permissions-Policy` | All present |
| `X-Pingback` header | Absent |
| Uploads directory listing | 403 |
| `/wp-config.php.bak`, `/.env` probes | 403 |
| `/readme.html`, `/license.txt` | 404 |

**One real problem found and fixed.** The server was applying a blanket seven-day public cache to *everything*, including API responses. The practical effect was that a cached copy of the old username-leaking API response could still be served to a visitor even though the underlying fix was working correctly — the fix was right, but a stale copy could outlive it. API and JSON responses are now set to never cache, and browser caching of pages has been corrected too, which also means content changes are visible immediately instead of up to a week later.

**Two additions:** HSTS (`Strict-Transport-Security`) is now sent, and the hardening rules live outside the WordPress-managed block in `.htaccess`, so re-saving permalinks will not silently wipe them.

## 15. SEO — Done

The remaining points behind the ~92 score were missing page metadata. Fixed:

- **Meta descriptions** on all 14 content pages, individually written, each within the 120–158 character range search engines display. Previously there were none at all — this was the main deduction.
- **Open Graph and Twitter Card tags** so links shared to LinkedIn, Facebook or Slack render a proper title, description and image instead of a bare URL.
- **Organization structured data** on the homepage carrying the Dallas address, toll-free number and contact email.
- **Homepage title shortened** from 88 to 54 characters, so it no longer truncates in search results.
- WordPress's XML sitemap is present and serving.

These are generated by the theme from each page's Excerpt field, so your team can edit any description in the page editor without a plugin — and without adding the page weight an SEO plugin would bring to a site we spent Milestone 4 optimising.

> **Launch blocker — please note.** `robots.txt` currently contains `User-agent: Googlebot` / `Disallow: /`. That is correct for a staging site and stops Google indexing a duplicate of your site. **It must be removed at launch, or the production site will never appear in Google.** I have deliberately left it in place while the site is on the temporary domain.

## 16. Scope and completeness check — Done

Checked against the requirements you sent at kickoff:

| Required | Status |
|---|---|
| Home, About Us, Services, individual service pages, Portfolio/Case Studies, Blog, FAQ, Contact | All present and working (16 pages) |
| Customer Portal | Correctly excluded — you confirmed it is a future project |
| Contact form | Present, routing corrected (delivery test outstanding, item 10) |
| Newsletter signup | Present, routing corrected |
| FAQ sections | Present on the homepage and the FAQ page |
| Blog | Present. The WordPress sample "Hello world!" post has been moved to trash |
| Testimonials | **Built, then removed at your instruction** in item 3. The section and pattern are ready to restore the moment you have real, permissioned quotes |
| Social media links | **Built, then removed at your instruction** in item 9, pending your URLs |
| Live chat, CRM integration, AI tools, booking, multilingual | Correctly excluded — you confirmed not required at launch |
| Added beyond original scope | Pricing page (item 5) |

**Nothing in the agreed scope is unbuilt.** The two gaps are both deliberate removals you asked for, and both can be restored quickly.

Content still awaiting your sign-off: the Portfolio page still says case studies are coming soon, and the six service page descriptions were written from your brief and have not been formally confirmed.

## 17. Baza AI chatbot readiness — Done

The site is ready for the chatbot without redevelopment. Specifically:

- **A permanent home for the widget.** Paste the vendor snippet into **Settings → General → "Chatbot embed code"** and it appears site-wide. No code, no developer.
- **A code-level hook** (`novavolt_chatbot_embed`) so the snippet can instead be supplied by a future NovaVolt plugin, keeping Baza's code outside the theme where it survives any theme change.
- **It loads in the footer, after content**, so it cannot delay rendering or undo the Core Web Vitals work from Milestone 4.
- **A layering guard.** Chat widgets routinely ship with the highest possible stacking priority, which would have covered the mobile menu and its close button. The widget is pinned below the navigation and hidden automatically while the mobile menu is open.

One thing to be aware of: Hostinger's own "Ask AI" assistant plugin is active on this install. It only renders for logged-in administrators, not for visitors, so it is not on your public site — but it is a second chat widget on the same install and should be disabled before Baza goes live to avoid a conflict.

---

> **Please open the site with a hard refresh** (Ctrl+Shift+R on Windows, Cmd+Shift+R on Mac), or use this link: **https://lightyellow-kingfisher-780485.hostingersite.com/?v=milestone5**
>
> The site was previously sending a seven-day browser-cache instruction on its pages. That is now fixed, but any browser that visited before the fix may still be holding the old page and would show you the previous version of the site rather than the corrections. A hard refresh or the link above bypasses it. New visitors are unaffected.

## Final QA results

| Area | Result |
|---|---|
| **Links** | All 16 pages crawled, plus category and archive routes. Zero broken links. Every `tel:` and `mailto:` link resolves to the correct new details. No stray external links remain |
| **Forms** | Both forms present, correctly configured, and routed to contact@novavoltsystems.com. Live delivery test outstanding — see item 10 |
| **Contact information** | Verified across header, footer, Contact page and structured data. No occurrence of the old email or the (555) placeholder number remains anywhere |
| **Content accuracy** | Full-text sweep of all 16 pages plus all 9 theme patterns for every flagged claim, invented name, and removed integration. Zero matches |
| **Desktop** | Verified at 1024px, 1280px and 2560px |
| **Mobile** | Verified at 390px, 768px and 1024px. No horizontal overflow on any page tested |
| **Accessibility** | One `h1` per page. Zero skipped heading levels (four pages fixed during this pass). All images have alt text. No empty links, no unnamed buttons, all form inputs labelled. Skip link, `lang` attribute and header/main/footer/nav landmarks all correct. **Colour contrast re-audited by calculation across all 16 pages — see below — now 0 failures** |
| **Performance** | TTFB ~400ms, DOM ready ~540ms, fully loaded ~575ms, **Cumulative Layout Shift 0**. In line with the Milestone 4 baseline despite the added pages; figures vary a little run to run, CLS 0 is consistent |
| **Security** | Full re-verification passed — see item 14 |
| **Browser compatibility** | **Chrome only.** Unchanged from Milestone 4: the layout uses the modern CSS `:has()` selector, supported in current Chrome, Safari and Firefox, but a visual check in Safari and Firefox before launch is still worth doing |

---

### Colour contrast — re-audited and fixed

Milestone 4 reported contrast as resolved. On this pass I re-checked it properly, calculating the ratio for every piece of text on all 16 pages rather than judging by eye, and found several places still below the WCAG AA minimum. Measured against white:

| Colour | Ratio | Verdict |
|---|---|---|
| `#2B7FC4` (brand blue) | 4.25 | Fails for normal text (needs 4.5) |
| `#4FA3DE` | 2.75 | Fails |
| `#86CDEA` | 1.75 | Fails |

The most significant were the **"Talk to Sales" button on every page** and the **Contact form's submit button**. Both are white text on a gradient that ran into a light blue, so the lighter half of each button was below the minimum — the form's submit button was the worst at 2.75. Also affected: the "CRM integrations available" tile, the keyboard skip link, the hero supporting text and demo caption, and the stat labels on the dark service page headers.

All are corrected. Gradients now end at `#2170B3` (5.21) instead of the lighter blues — a barely perceptible change in hue that takes every instance over the line. Nothing moved and no wording changed.

**Result: 0 contrast failures across all 16 pages**, confirmed by re-running the audit.

## Outstanding — what I need from you

1. **A mailbox and app password for novavoltsystems.com** (item 10) so form delivery can be made reliable and actually tested.
2. **Confirmation on the fraud-protection and data-centre claims** on the Security page (item 1).
3. **Confirmation that the Pricing page should be public** (item 5).
4. **Official social media URLs** when the accounts are ready (item 9).
5. **Sign-off on the six service page descriptions** and the Portfolio page.

## Before go-live

1. **Remove the Googlebot block from `robots.txt`** — otherwise the site will never be indexed. This is the single most important launch step.
2. Apply `DISALLOW_FILE_EDIT` as the final change after approval (item 13).
3. Disable Hostinger's "Ask AI" plugin before the Baza chatbot goes live (item 17).
4. Point the production domain at the site, then re-check the canonical URLs and structured data.
5. Visual check in Safari and Firefox.
6. Two unused Hostinger Reach scripts load on every page. Minor, but worth removing at launch for a slightly lighter site.
