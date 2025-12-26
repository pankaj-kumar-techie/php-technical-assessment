# Laravel User Registration

A simple user registration system built with Laravel.

## Prerequisites
- Docker and Docker Compose

## Setup
1. Clone the repository and navigate to `backend-registration/`.
2. Copy environment file: `cp .env.example .env`
3. Build and start containers: `docker-compose up -d --build`
4. Install dependencies: `docker-compose exec app composer install`
5. Generate app key: `docker-compose exec app php artisan key:generate`
6. Run migrations: `docker-compose exec app php artisan migrate`
7. Access the app at `http://localhost:8000`

## Features
- User registration with input validation
- Secure password hashing
- CSRF protection

## Testing
Run tests: `docker-compose exec app php artisan test`

Includes 3 key test cases: successful registration, required fields, and password strength.

## Routes
- GET `/register` - Registration form
- POST `/register` - Handle registration
