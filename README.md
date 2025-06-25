# joyeriawendi1

Simple jewelry shop application with basic authentication and Google OAuth example.

## Setup

1. Install PHP dependencies using Composer:
   ```bash
   composer install
   ```
2. Copy `.env.example` to `.env` and set your Google OAuth credentials.
3. Serve the application using PHP's built-in server:
   ```bash
   php -S localhost:8000 -t public
   ```
4. Visit `http://localhost:8000/auth/register` or `/auth/login`.
