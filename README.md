# Pixel Positions — Laravel Job Portal

Pixel Positions is a full-stack job portal web application built with Laravel. It connects applicants with employers and provides workflows for managing job listings, applications, resumes, and interviews.

## Features

* User authentication and role-based access
* Employer job posting and management
* Applicant job browsing and applications
* Resume submission with job applications
* Employer application review, acceptance, and rejection
* Interview scheduling and management
* Server-side validation and database-backed workflows
* Responsive frontend interface

## Tech Stack

* **Backend:** PHP, Laravel
* **Database:** MySQL
* **Frontend:** Blade, HTML, CSS, JavaScript
* **Styling:** Tailwind CSS (if applicable)
* **Build Tools:** Vite (if applicable)

## Installation

1. Clone the repository.
2. Install PHP dependencies with `composer install`.
3. Copy `.env.example` to `.env`.
4. Configure your local database credentials in `.env`.
5. Generate the application key with `php artisan key:generate`.
6. Create the database and run `php artisan migrate`.
7. Install frontend dependencies with `npm install`.
8. Build frontend assets with `npm run build`.
9. Start the Laravel development server with `php artisan serve`.

```bash
git clone https://github.com/YOUR-USERNAME/pixel-positions.git
cd pixel-positions
composer install
```

Complete the remaining setup steps above from the project directory.

## Security

Never commit `.env` files, passwords, API keys, or other private credentials.
