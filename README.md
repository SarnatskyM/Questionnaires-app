# Laravel Project Quiz/Testing with Filament Admin Panel

## Overview

This project is a Laravel application featuring an admin panel built with Filament. The admin panel allows for the management of tests, questions, and results. The core features include:

- **Tests**: Create and manage various tests.
- **Questions**: Add questions and answer options linked to tests.
- **Results**: View and export test results for further analysis.

### Unique Test URLs

When creating a test, a unique URL is generated for each test. This URL can be shared with participants, allowing them to take the test. The results of each submission are tracked and can be viewed in the **Results** section of the admin panel.

## Requirements

- PHP >= 8.0
- Composer
- MySQL or another supported database

## Installation

Follow the steps below to set up the project on your local environment.

### 1. Clone the Repository

```bash
git clone https://github.com/SarnatskyM/Questionnaires-app.git
cd Questionnaires-app
```

### 2. Install Dependencies

Use Composer to install the project dependencies:

```bash
composer install
```

### 3. Set Up Environment

Copy the `.env.example` file to `.env` and configure your database and other settings:

```bash
cp .env.example .env
php artisan key:generate
```

Update the `.env` file with your database credentials:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

### 4. Run Migrations

Run the migrations to create the necessary tables in your database:

```bash
php artisan migrate
```

### 5. Create Admin User

Create an admin user to access the Filament admin panel:

```bash
php artisan make:filament-user
```

Follow the prompts to enter the user's name, email, and password.

## Running the Application

To start the Laravel development server, use the following command:

```bash
php artisan serve
```

Once the server is running, open your web browser and go to:

```
http://localhost:8000/admin
```

Log in using the credentials you set up earlier. After logging in, you will see the following sections in the admin panel:

- **Tests**: Create and manage tests. Each test generates a unique URL that can be shared with participants. You can monitor and analyze the results of these tests in the **Results** section.
- **Questions**: Manage questions and associate them with tests. You can also define possible answers for each question.
- **Results**: View test results, with the option to export data for analysis.

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## License

This project is open-sourced software licensed under the [MIT license](LICENSE).
