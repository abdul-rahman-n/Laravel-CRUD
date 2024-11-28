# Laravel CRUD Task with Excel Import/Export

This is a Laravel project that implements a simple Customer Management System. The project supports CRUD (Create, Read, Update, Delete) operations on customer data, Excel file import/export, with data validation

## Features
- **CRUD Operations**: Manage customer data (Name, Email, Phone).
- **Excel Import**: Import customer data from an Excel file.
- **Excel Export**: Export customer data to an Excel file.
- **Validation**: Data validation for customer fields and Excel import data.

## Requirements
- PHP 7.3+
- Laravel 8.0+
- Composer
- MySQL or any other supported database
- `maatwebsite/excel` package for Excel import/export

## Installation

### 1. Clone the Repository

Clone the project from GitHub:

```bash

git clone git@github.com:abdul-rahman-n/Laravel-CRUD.git
cd Laravel-CRUD

```


### 2. Install Dependencies

Run the following command to install the project dependencies:

```bash

composer install

```


### 3. Set Up Environment Variables

Copy the .env.example file to .env:

```bash

cp .env.example .env

```

Open the .env file and set up your database configuration:

```env

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password

```

### 4. Generate Application Key

Generate the Laravel application key:

```bash

php artisan key:generate

```


### 5. Run Migrations

Run the database migrations to create the necessary tables:

```bash

php artisan migrate

```


## Usage

### 1. Start the Development Server

Start the Laravel development server:

```bash

php artisan serve

```

The application will be available at http://localhost:8000.


### 2. Access Customer Management
- **Add Customer**: `Navigate to Customers > Add Customer to add a new customer.`
- **List Customers**: `View all customers.`
- **Edit Customer**: `Edit customer details.`
- **Delete Customer**: `Remove customers from the list.`
- **Import Excel**: `Upload an Excel file to import customers.`
- **Export Excel**: `Download all customer data in an Excel file.`


## Excel File Format

The Excel file for import must have the following columns:

- **name**
- **email**
- **phone**

Ensure that these columns are properly named in the Excel file.