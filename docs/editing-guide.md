# NovaVolt: everyday WordPress edits

![WordPress Pages screen](novavolt-pages-admin.png)

1. Sign in at [NovaVolt WordPress admin](https://novavoltsystems.com/wp-admin/). Open **Pages → All Pages**. Search for **Home**, **Pricing**, **FAQ**, or another page, then choose **Edit**.
2. If the editor shows HTML, open the top-right **Options (⋮) → Visual editor** for ordinary text changes. Click the text you want, edit it, use **Preview**, then **Save**. WordPress’s [block editor guide](https://wordpress.org/documentation/article/wordpress-block-editor/) explains the top toolbar and block controls.
3. For a text or button link, select its text and use the **Link** control to change the destination. Check the link in Preview before saving. See [WordPress link editing](https://wordpress.org/documentation/article/link-editing/).
4. To update an FAQ, edit the **FAQ** page. Each question is a **Details** block: edit its summary for the question and the paragraph inside it for the answer. The Services page also contains its own editable FAQ copy; update both pages if the same answer must match. See [WordPress Details block](https://wordpress.org/documentation/article/details-block/).
5. To change a published page’s title or body, edit that page and save. To create a page, choose **Pages → Add Page**, enter a title and content, preview it, then publish it. Add the page to navigation separately in **Appearance → Editor → Navigation** if visitors need it in the menu.
6. For **Pricing**, open the Pricing page. Its headline and explanatory paragraphs are ordinary blocks, while the plan prices and add-on prices are inside **Custom HTML** blocks. For a price, use **Options (⋮) → Code editor**, find the exact old amount (for example, `$29.99`), change only that amount, then Preview and Save. Preserve the surrounding HTML tags and check every displayed price. Changing the pricing card layout or billing logic should be handled as a code change.

Before a larger edit, take an UpdraftPlus backup. After saving, check the page on desktop and mobile, test links, and confirm that forms still work. Avoid sharing passwords or license keys in page content or screenshots.

**Walkthrough limitation:** This is a written and illustrated walkthrough. A narrated screen recording still needs to be made. The visual editor canvas did not render reliably in the Codex browser during capture, although published pages and the code editor remained accessible.
