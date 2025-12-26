# PHP Technical Assessment

A technical assessment project demonstrating PHP and Laravel skills, along with RDBMS analysis.

## Project Structure

- **backend-registration/**: Laravel application for user registration with validation, security, and testing.
- **rdbms-analysis/**: SQL scripts for customer orders database analysis.

## Setup and Run

### Laravel Project (backend-registration)
1. Clone the repository and navigate to `backend-registration/`.
2. Copy environment file: `cp .env.example .env`
3. Build and start containers: `docker-compose up -d --build`
4. Install dependencies: `docker-compose exec app composer install`
5. Generate app key: `docker-compose exec app php artisan key:generate`
6. Run migrations: `docker-compose exec app php artisan migrate`
7. Access the app at `http://localhost:8000`

### RDBMS Analysis (rdbms-analysis)
- Run `query.sql` in a MySQL database to create tables, insert data, and execute the analysis query.
- Results in `output.csv`.