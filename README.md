# Smart Form CMS

A bilingual (Arabic/English) CMS built with Laravel 12 for managing dynamic pages, services, hosting plans, and contact methods.

## Prerequisites

- **PHP**: >= 8.2
- **Composer**
- **Node.js & NPM**
- **MySQL / MariaDB**
- **XAMPP / WAMP** (Optional, for local development)

## Installation Guide

Follow these steps to set up the project locally:

### 1. Clone the Repository
```bash
git clone <repository_url>
cd smart-form
```

### 2. Install Dependencies
```bash
composer install
npm install
```

### 3. Environment Configuration
Copy the example environment file and update your database credentials:
```bash
cp .env.example .env
```
Open `.env` and set your database name, username, and password:
```env
DB_DATABASE=smart_form
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Application Key & Storage
```bash
php artisan key:generate
php artisan storage:link
```

### 5. Database Setup
Run the migrations and seed the database with initial data (Admin user, default services, etc.):
```bash
php artisan migrate:fresh --seed
```

### 6. Build Assets
```bash
npm run build
# OR for development
npm run dev
```

### 7. Run the Application
```bash
php artisan serve
```
The site will be available at `http://127.0.0.1:8000`.

---

## Admin Dashboard

- **URL**: `http://127.0.0.1:8000/admin`
- **Default Login**: 
  - **Email**: `admin@admin.com`
  - **Password**: `password`

## Key Features

- **Multilingual Support**: Arabic and English support for all content using JSON columns and `spatie/laravel-translatable`.
- **Dynamic Pages**: Create pages with custom slugs for both languages.
- **Service Management**: Associate services with specific pages or show them globally.
- **Slider Management**: Upload and manage images for the homepage/internal pages.
- **Contact Methods**: Manage different contact options (WhatsApp, Phone, etc.) dynamically.

## Developer Notes

- The project uses **Spatie Translatable** for model translations.
- Slugs are stored as JSON: `{"en": "about-us", "ar": "من-نحن"}`.
- Admin authentication is handled via `AdminMiddleware`.
