# Laravel Project: User Authentication and Product Upload

This is a Laravel project where users can create an account, login (with manual approval), and upload their products using an Excel file. The uploaded data can be mapped to the database table columns in case the order of columns in the Excel file differs from that in the database.

## Features
- User authentication with manual approval
- Password validation rules (minimum 8 and maximum 20 characters, at least one uppercase, one lowercase, one special character, and one digit)
- Email validation rules (unique domain, e.g., `hello@ABC.com`, and only one email can be registered within a domain except for `gmail`)
- Import products using an Excel file
- Mapping of Excel columns to database table columns
- Default column names for product name, type, and quantity

## Installation
1. Clone the repository:
   ```
   git clone https://github.com/Saad-Dev-hub/TestProject.git
   ```
2. Install dependencies:
   ```
   composer install
   ```
3. Create a `.env` file by copying the `.env.example` file:
   ```
   cp .env.example .env
   ```
4. Generate an application key:
   ```
   php artisan key:generate
   ```
5. Configure your database credentials in the `.env` file:
   ```
   DB_HOST=localhost
   DB_DATABASE=your_database_name
   DB_USERNAME=your_database_username
   DB_PASSWORD=your_database_password
   ```
6. Migrate the database:
   ```
   php artisan migrate
   ```
7. Start the development server:
   ```
   php artisan serve
   ```

## Usage
1. Register a new user and that will need to change its status to "Approved" from the database.
2. Login with your credentials.
3. Click on "Upload Products" and select an Excel file.
4. Submit the form to import the products.
