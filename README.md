# NovaVolt website

This repository tracks the custom WordPress block theme and the Home, Services, and FAQ page content published on [novavoltsystems.com](https://novavoltsystems.com/).

- [`novavolt/`](novavolt/) is the custom theme source. Its CSS, JavaScript, and `functions.php` were synced from the 24 September 2026 post-change backup. The hero, services, and FAQ source patterns were aligned with the updated page copy in this repository.
- [`site-content/`](site-content/) contains Gutenberg Code Editor exports of the three updated pages. WordPress stores page content in its database, so changing these files alone does not update the live pages.
- [`docs/editing-guide.md`](docs/editing-guide.md) covers basic page edits.
- [`docs/basic-editing-walkthrough.mp4`](docs/basic-editing-walkthrough.mp4) is a short narrated walkthrough built from captured WordPress screens.
- [`docs/site-update-2026-09-25.md`](docs/site-update-2026-09-25.md) records deployment and handoff status.

The complete WordPress backup is held offline separately. Database dumps, plugin archives, uploads, and credentials are intentionally excluded from Git.
