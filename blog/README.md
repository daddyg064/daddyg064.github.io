# Personal Blog (PHP + MySQL)

This folder contains a simple, modern blog layout with a Facebook-style feed, a dark-mode switcher, and a lightweight PHP/MySQL backend.

## Quick start (cPanel / superhosting.bg)
1. **Create a database**
   - In cPanel, open **MySQL Databases**.
   - Create a new database and user, then assign the user **All Privileges**.
2. **Upload the `blog/` folder**
   - Use the File Manager to upload the entire `blog` directory to your hosting root (for example, `public_html/blog`).
3. **Update configuration**
   - Open `config.php` and update the database credentials (`DB_HOST`, `DB_NAME`, `DB_USER`, `DB_PASS`).
   - If you install the blog in a subfolder (for example `/blog`), set `BASE_URL` to `/blog`.
   - Update `SITE_NAME` and `SITE_TAGLINE` to your personal branding.
4. **Create the tables**
   - Open **phpMyAdmin** in cPanel.
   - Select your database and import `schema.sql`.
5. **Create your admin user**
   - Visit `https://your-domain.com/blog/setup.php`.
   - Create the initial admin username and password.
   - **Delete `setup.php` after the admin account is created.**
6. **Log in and publish**
   - Visit `https://your-domain.com/blog/login.php`.
   - Create posts from the dashboard.

## File map
- `index.php` – Public blog feed.
- `login.php` / `logout.php` – Login flow.
- `dashboard.php` – Manage posts.
- `create_post.php` – Create posts.
- `assets/style.css` – Modern styling and dark mode.
- `assets/app.js` – Dark mode toggle.

## Notes
- This is a minimal starter. If you want comments, categories, or media uploads, we can extend it.
