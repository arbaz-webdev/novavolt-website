# NovaVolt site update — 25 September 2026

## Published work

- Home hero broadened to business communications, with the requested supporting copy.
- AI copy changed to “Ready to answer. Ready to engage.”
- Contract, number availability, VoIP, and setup FAQ wording updated on Home, Services, and FAQ where applicable.
- Back-to-Top button added after scrolling.
- Mobile navigation shows the main pages first and expands Services on selection.

The live custom theme is version 4.1.1. The published page content and mobile interactions were checked after the update. This repository now contains the corresponding CSS, JavaScript, and page content exports. Its reusable hero, services, and FAQ patterns also carry the new wording for a later deployment; the live PHP pattern files could not be edited through WordPress because the server loopback check failed.

## Backup

Complete UpdraftPlus backup sets were created before and after the edits (24 September 2026, 19:47 and 20:23 server time). The downloaded offline archive was checked locally: the outer ZIP and all six final-backup components (database, plugins, themes, uploads, must-use plugins, and others) passed integrity checks. The offline archive is retained outside Git because it includes database and site data.

The offline snapshot predates a punctuation-only correction on the Home and Services pages on 25 September. The `site-content/` exports and the Services source pattern include that correction.

## Remaining handoff items

1. Have the host investigate the intermittent cPanel default-page response for the Home URL, WordPress.org connection timeout, and failed PHP loopback check. Deploy the updated reusable PHP patterns after the loopback issue is resolved.
2. Confirm paid service/license owners and renewal dates in the billing accounts.
3. Review the Milestone #4 launch checklist and complete final production sign-off.
4. Record a narrated editing walkthrough. The written [editing guide](editing-guide.md) is available now.

The visible copy and interaction edits are live. The items above remain open for full handoff.
