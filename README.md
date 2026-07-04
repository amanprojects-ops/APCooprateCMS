# 🏢 AP Corporate CMS

<div align="center">
  
  [![AmanProjects Banner](https://img.shields.io/badge/Developed%20By-AmanProjects-blue?style=for-the-badge&logo=laravel&logoColor=white)](https://amanprojects.com)
  
  **AP Corporate CMS** is a secure, modern, and feature-rich Content Management System engineered for corporate websites, SaaS product showcases, and client lead management. 
  
  *Designed, Developed, and Maintained by [AmanProjects (amanprojects.com)](https://amanprojects.com)*
  
  🌐 **Website:** [amanprojects.com](https://amanprojects.com) | 📧 **Email:** [hello@amanprojects.in](mailto:hello@amanprojects.in) | 📱 **Contact:** +91 98765 43210

---

[![Laravel Version](https://img.shields.io/badge/Laravel-12.0-FF2D20?style=flat-square&logo=laravel)](https://laravel.com)
[![PHP Version](https://img.shields.io/badge/PHP-%5E8.2-777BB4?style=flat-square&logo=php)](https://php.net)
[![TailwindCSS](https://img.shields.io/badge/TailwindCSS-v4-06B6D4?style=flat-square&logo=tailwindcss)](https://tailwindcss.com)
[![Alpine.js](https://img.shields.io/badge/Alpine.js-v3-77C1D2?style=flat-square&logo=alpinedotjs)](https://alpinejs.dev)
[![Database](https://img.shields.io/badge/Database-MySQL-4479A1?style=flat-square&logo=mysql)](https://mysql.com)
[![Excel Integration](https://img.shields.io/badge/Excel-Maatwebsite-107C41?style=flat-square&logo=microsoftexcel)](https://docs.laravel-excel.com/)

</div>

---

## 🔒 Security-First by AmanProjects

This CMS is built combining deep Full Stack Laravel development expertise with hands-on ethical hacking principles. Unlike generic templates, AP Corporate CMS features a **secure-by-default architecture** designed to withstand modern web vulnerabilities, using strict input validation, parameterized queries, custom middleware, CSRF protections, and secure authentication flows.

---

## ⚡ Main Modules & Features

AP Corporate CMS provides a comprehensive administrative dashboard alongside a fast, SEO-optimized public-facing frontend:

### ⚙️ 1. Dynamic Settings & Configuration

- **General Settings:** Brand name, corporate address, phone/WhatsApp integration, logos, and favicons.
- **Hero Customization:** Modify homepage headlines, subtexts, and CTA destinations instantly.
- **Section Control:** Dynamically update headings, subtitles, and layout details for all main blocks.
- **SEO Suite:** Page-by-page title overrides, meta descriptions, focus keywords, and dynamic feature images. Contains automated XML Sitemap generation at `/sitemap.xml`.

### 📂 2. Portfolio & Showcase Engine

- **Products Module:** List your proprietary software/SaaS offerings with descriptive content, tech stacks used, and direct links.
- **Projects Module:** Highlight delivered client case studies, complete with client testimonials and details.
- **Screenshot Galleries:** Manage responsive visual screenshot assets per product and project with custom upload rules.
- **Universal Screenshots:** A dedicated gallery view to reuse uploaded UI assets across different listings.

### 🛠️ 3. Service & Tech Stack Manager

- **Services CMS:** Register your corporate offerings. Features soft-deletes and restore actions so you never lose accidental deletions.
- **Tech Stack Catalog:** Organise stack entries (Backend, Frontend, Database, Tools) with dedicated icon/logo bindings.
- **Statistics (Stats) Tracker:** Easily showcase key figures (e.g., _Projects Delivered_, _Happy Clients_) on your homepage counter.

### 💳 4. Flexible Pricing & Plans

- **Pricing Plans:** Define multiple plan tiers (e.g., _Basic_, _Standard_, _Pro_) with billing cycles, featured flags, custom badges, and dynamic call-to-actions.
- **Feature Matrices:** Attach unlimited features (with active/inactive states) to plans to create visual comparison tables.

### 📨 5. Lead Generation & Contact Inquiries

- **Spam-Resistant Contact Forms:** Capture client requests securely.
- **Inquiry Dashboard:** Track inquiries via a unified administrative view. Toggle inquiry status (e.g., _Pending_, _Read_, _Resolved_) and review details.

### ✍️ 6. Blogging & SEO content (CodeBB)

- **Blog Engine:** Rich text editor integrations, draft/publish state management, slug generation, and categories.

### 📊 7. Excel/CSV Data Exchange

- Powered by `maatwebsite/excel`, allowing administrators to export and import system data for easy bulk updates. Supported modules:
    - Services
    - Products & Projects
    - Testimonials & Tech Stacks
    - Blog Posts & General Screenshots

---

## 🛠️ Technology Stack

- **Core Backend:** Laravel `^12.0` (PHP `^8.2`)
- **Interactive Frontend:** Alpine.js, Tailwind CSS (via Vite bundle), Blade View Template engine, FontAwesome icon sets.
- **Database Schema:** MySQL / SQLite
- **Package Extensions:**
    - `maatwebsite/excel` (Import/Export integrations)
    - `laravel/sanctum` (API key authentication)
    - `laravel/tinker` (Interactive REPL console)
    - `laravel/pail` (Enhanced debugging and error logging)

---

## 🏗️ Folder Structure & Architecture

```bash
ap-cooprate-cms/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/             # Admin controllers (Services, Settings, Products, etc.)
│   │   │   └── Frontend/          # Public-facing views & contact handling
│   │   └── Middleware/            # Custom access control and filters
│   └── Models/                    # Eloquent database mapping models
├── bootstrap/                     # Application bootstrap configurations
├── config/                        # Laravel system configurations
├── database/
│   ├── migrations/                # Database schemas
│   └── seeders/                   # Seeder classes (DatabaseSeeder.php seeds defaults)
├── public/                        # Entry points, static assets, dynamic uploads
│   └── assets/                    # Compiled CSS, JS, font packages, and vendor plugins
├── resources/
│   ├── css/                       # Pre-compiled Tailwind & styles
│   ├── js/                        # Core JavaScript & Alpine modules
│   └── views/                     # Blade view layers (Frontend, layouts, and admin)
├── routes/
│   ├── api.php                    # API routes
│   └── web.php                    # Web routes (grouped, guest, and auth middleware)
├── composer.json                  # PHP packages, custom scripts (setup, dev, test)
├── vite.config.js                 # Frontend build compilation rules
└── README.md                      # Documentation
```

---

## 🚀 Installation & Local Setup

Getting started with the AP Corporate CMS on your local development server or XAMPP environment is straightforward:

### Prerequisites

- PHP `^8.2` or higher installed
- Composer package manager
- Node.js (`v18` or higher) & npm
- MySQL or SQLite service

### Step-by-Step Setup

1.  **Clone the Repository** (place it under your `xampp/htdocs/www` or local directory):

    ```bash
    git clone https://github.com/amanprojects-ops/APCooprateCMS.git
    cd APCooprateCMS
    ```

2.  **Run the Automatic Installer**
    This project includes a pre-packaged composer setup script that installs dependencies, copies configuration templates, generates encryption keys, migrates database schemas, and builds frontend assets automatically:

    ```bash
    composer run setup
    ```

    _Under the hood, this command executes:_
    - `composer install`
    - Creates `.env` configuration file from `.env.example`
    - `php artisan key:generate`
    - `php artisan migrate --force`
    - `npm install`
    - `npm run build`

3.  **Database Configuration**
    If you're using MySQL, configure your `.env` credentials:

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=ap_cooprate_cms
    DB_USERNAME=root
    DB_PASSWORD=
    ```

4.  **Seed Default Admin & Settings**
    Populate the system configuration, tech stacks, pricing metrics, and create the default admin account:

    ```bash
    php artisan db:seed
    ```

    **Default Admin Credentials:**
    - **Username:** `admin`
    - **Email:** `admin@amanprojects.com`
    - **Password:** `password`

    > [!IMPORTANT]
    > Always change the default password from the settings dashboard immediately after your first login.

---

## 💻 Running the Application

This CMS features a concurrent development server configuration that starts the Laravel backend server, the queue handler (for background operations), and the Vite compilation server simultaneously.

To start development mode:

```bash
composer run dev
```

- **Frontend Access:** `http://localhost:8000`
- **Admin Dashboard:** `http://localhost:8000/admin`
- **Vite Hot-Reload:** Active on your resources files.

---

## 🧪 Testing and Verification

To run the automated suite of feature and unit tests included in the CMS:

```bash
composer run test
```

---

## 🔒 Watermark & Copyright Licensing

All rights reserved. This corporate codebase is custom-tailored and branded under:

- **Author:** Aman (Laravel Developer & Ethical Hacker)
- **Brand:** [AmanProjects](https://amanprojects.com)
- **Domain:** [amanprojects.com](https://amanprojects.com)
- **Support:** [hello@amanprojects.in](mailto:hello@amanprojects.in)

---

<div align="center">
  <sub>Developed with 💻 & ☕ by <b><a href="https://amanprojects.com">AmanProjects</a></b>. Powered by Laravel 12.</sub>
</div>
