# ReNew — Refurbished Laptop Catalogue

ReNew is a Laravel web application developed for the Web Programming II course assignment.

## Project Overview

The application will provide a catalogue of refurbished laptops, allowing visitors to browse laptop information and registered users to access additional features.

## Planned Features

- User authentication and role-based access
- Laptop catalogue using Laravel Eloquent ORM
- Database migrations and seeders
- Contact form with validation and message storage
- Message history for registered users
- Chart.js data visualization
- Admin-only CRUD operations
- Responsive user interface

## Technology Stack

- PHP
- Laravel
- Blade
- SQLite for local development
- MySQL for hosted deployment, if required
- Chart.js
- Git and GitHub

## Local Setup

1. Clone the repository.
2. Install PHP dependencies with `composer install`.
3. Create your environment file with `cp .env.example .env`.
4. Generate the application key with `php artisan key:generate`.
5. Configure your database in `.env`.
6. Run migrations with `php artisan migrate`.
7. Start the development server with `php artisan serve`.

## Project Status

Initial Laravel project setup completed. Features and database integration are under development.
