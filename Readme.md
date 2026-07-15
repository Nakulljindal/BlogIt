# BlogIt

BlogIt is a PHP and MySQL blog publishing app built with Bootstrap 5. It lets users create an account, log in, write posts with cover images, browse published blogs, and manage their own content from a dashboard.

Project URL: https://blogit.freedev.app/

## Features

- User sign up and login with password hashing
- Session-based authentication and protected pages
- Create, update, and delete blog posts
- Cover image upload for blog posts
- Public blog feed on the home page and explore page
- Single blog detail page with author and publish date
- Dashboard with blog count and recent posts table
- Profile page with basic account details

## Tech Stack

- PHP
- MySQL
- Bootstrap 5
- Bootstrap Icons
- HTML, CSS, and a small amount of inline PHP rendering

## Project Structure

- `index.php` - Home page with hero section and featured blogs
- `explore.php` - Public blog listing page
- `displayBlog.php` - Single blog detail view
- `signup.php` - Account registration
- `login.php` - User authentication
- `logout.php` - Session logout
- `write.php` - Create a new blog post
- `updateBlog.php` - Edit an existing blog post
- `deleteBlog.php` - Delete a blog post
- `dashboard.php` - Logged-in dashboard with blog overview
- `myblogs.php` - Logged-in blog management view
- `profile.php` - Logged-in user profile view
- `db.php` - Database connection
- `setup/CreateDB.php` - Script to create the `blogit` database
- `setup/CreateTables.php` - Script to create the `users` and `blogs` tables
- `components/` - Reusable UI parts such as navbar, footer, hero, sidebar, and blog cards
- `css/` - Global styles, shared component styles, and page-specific styles
- `assets/uploads/` - Uploaded images for blog posts and default media

## Requirements

- XAMPP or another PHP + MySQL stack
- PHP 8+ recommended
- MySQL/MariaDB
- A browser for local testing

## Setup

1. Copy the project folder into your local web root, for example `htdocs/BlogIt`.
2. Start Apache and MySQL in XAMPP.
3. Create the database:
	- Open `setup/CreateDB.php` in the browser, or
	- Create a database named `blogit` manually in phpMyAdmin.
4. Create the tables by opening `setup/CreateTables.php` in the browser.
5. Check `db.php` and confirm the connection settings match your local MySQL setup.
6. Open `index.php` in the browser to start using the app.

## Database Schema

### `users`

- `id` - Primary key
- `user_name` - User display name
- `user_email` - Unique email address
- `user_password` - Hashed password
- `created_at` - Timestamp
- `updated_at` - Timestamp

### `blogs`

- `blog_id` - Primary key
- `user_id` - Foreign key to `users.id`
- `blog_title` - Blog title
- `blog_description` - Short summary
- `blog_category` - Blog category
- `blog_content` - Full post content
- `blog_image` - Uploaded cover image filename
- `created_at` - Timestamp
- `updated_at` - Timestamp

## How It Works

- Visitors can read the home page, explore posts, and open individual blogs.
- Users must sign up and log in before accessing write, update, delete, dashboard, my blogs, and profile pages.
- Blog ownership is enforced in the update and delete flows by checking the logged-in `user_id`.
- Uploaded blog images are stored in `assets/uploads/blogs/`.

## Notes

- The explore search bar and newsletter form are currently present in the UI but are not wired to backend processing.
- The app currently uses a simple local database connection in `db.php` with `root` and an empty password, which matches a default XAMPP setup.
- The blog card listing logic is shared across `index.php`, `explore.php`, and `myblogs.php` through `components/blog-cards.php`.

## Common Pages

- Home: `index.php`
- Explore: `explore.php`
- Sign up: `signup.php`
- Login: `login.php`
- Dashboard: `dashboard.php`
- My Blogs: `myblogs.php`
- Profile: `profile.php`
- Write blog: `write.php`

## License

No license has been specified yet.
