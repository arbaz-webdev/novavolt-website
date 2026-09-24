# NovaVolt site update — 25 September 2026

## Published work

- Home hero broadened to business communications, with the requested supporting copy.
- AI copy changed to “Ready to answer. Ready to engage.”
- Contract, number availability, VoIP, and setup FAQ wording updated on Home, Services, and FAQ where applicable.
- Back-to-Top button added after scrolling.
- Mobile navigation shows the main pages first and expands Services on selection.

The live custom theme is version 4.1.1. The published page content and mobile interactions were checked after the update. This repository contains the corresponding CSS, JavaScript, page content exports, and reusable hero, services, and FAQ patterns. A direct PHP file edit failed WordPress's server loopback check, so the aligned theme was uploaded through WordPress's theme replacement flow. The installed pattern files and public pages were checked after deployment.

## Backup

Complete UpdraftPlus backup sets were created before and after the edits (24 September 2026, 19:47 and 20:23 server time). The downloaded offline archive was checked locally: the outer ZIP and all six final-backup components (database, plugins, themes, uploads, must-use plugins, and others) passed integrity checks. The offline archive is retained outside Git because it includes database and site data.

After the final page correction and theme replacement, a third complete, manually retained backup succeeded at **21:11 server time** with all six components. The downloaded offline archive is the earlier 20:23 snapshot. Download the 21:11 set from UpdraftPlus if an exact current-state offline copy is needed. The `site-content/` exports and theme source in Git reflect the current state.

## Milestone 4 follow-up on production

The repository's earlier `Milestone-4-Report.md` describes staging QA and lists remaining launch work. A fresh production check on 25 September found:

- Privacy Policy and Terms pages load successfully. Their legal content still needs client and qualified legal review.
- The anonymous WordPress users endpoint returns 404, XML-RPC returns 403, and the expected security headers are present. Limit Login Attempts Reloaded is active in WordPress.
- `/readme.html` still returns 200 and should be removed with Hostinger file access. The WordPress theme editor also remains enabled; disabling it requires a `wp-config.php` change by the hosting administrator.
- The Home page still displays a 99.99% claim. The client should confirm this and other placeholder claims, testimonials, and integrations before final sign-off.

The earlier staging form, cross-browser, and link checks were not treated as a new production sign-off.

## Editing handoff and ownership

The [written editing guide](editing-guide.md) and [narrated walkthrough video](basic-editing-walkthrough.mp4) are available. The video uses captured WordPress screens to show the basic Pages → Edit → Save → Review flow.

The site owner reports that no paid plugins are used. Hosting and domain billing are managed by the client, so renewal dates belong in the client's account records.

## Remaining handoff items

1. Have the host investigate the intermittent cPanel default-page response for the Home URL, WordPress.org connection timeout, and failed PHP loopback check; remove `/readme.html` and disable the file editor in `wp-config.php`.
2. Have the client confirm hosting and domain renewal details and any external service subscriptions in its own account records.
3. Resolve the Milestone 4 host and content items above, complete production QA, and obtain final client sign-off.

The visible copy and interaction edits are live. The items above remain open for full handoff.
