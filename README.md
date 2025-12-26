# PHP Technical Assessment

A technical assessment project demonstrating PHP and Laravel skills, along with RDBMS analysis.

## Project Structure

- **backend-registration/**: Laravel application for user registration with validation, security, and testing.
- **rdbms-analysis/**: SQL scripts for customer orders database analysis.

## Setup and Run

### Laravel Project (backend-registration)
1. Navigate to `backend-registration/`.
2. Run `./setup.sh` to set up Docker environment.
3. Access at `http://localhost:8000`.
4. Run tests: `docker-compose exec app php artisan test`.

### RDBMS Analysis (rdbms-analysis)
- Run `query.sql` in a MySQL database to create tables, insert data, and execute the analysis query.
- Results in `output.csv`.