<p align="center">
  <img src="public/images/chirper_logo.svg" alt="Chirper Logo" width="400">
</p>

# Chirper

Chirper is a completed demo application developed as part of the **Laravel Learn Bootcamp**.  
The project has been fully implemented following the course, covering the complete lifecycle of a modern Laravel application.

## Project Status

✅ **Finished**  
All planned features from the bootcamp have been implemented and tested.

## Features Implemented

- User registration, login and logout
- Authentication and authorization with policies
- Full CRUD for Chirps (create, read, update, delete)
- Ownership-based permissions (users can only edit/delete their own chirps)
- Database migrations and Eloquent ORM
- Form validation with user-friendly feedback
- Blade components and layouts
- Tailwind CSS + DaisyUI for UI styling
- SQLite database for local development
- Vite for asset bundling

## Screenshots

The application provides a simple social feed where authenticated users can publish, edit and delete chirps, with timestamps and edit indicators.

## Tech Stack

- **Laravel** 12
- **PHP** 8.5
- **Blade**
- **Tailwind CSS**
- **DaisyUI**
- **SQLite**
- **Vite**

## Installation

```bash
git clone <your-repo-url>
cd chirper
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate
composer run dev
```

## Notes

This repository represents the final state of the Chirper application after completing the Laravel Learn Bootcamp.  
It is intended for learning, reference and portfolio purposes.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
