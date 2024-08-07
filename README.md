# Laravel API for Submissions

This project is a simple Laravel API that demonstrates job queues, database operations, migrations, and event handling.

## Table of Contents

- [Installation](#installation)
- [Running Migrations](#running-migrations)
- [Testing the API Endpoint](#testing-the-api-endpoint)
- [Unit Tests](#unit-tests)

## Installation

1. **Clone the repository**:
   ```bash
   git clone https://github.com/as-yakovenko/1datatec.git
   cd 1datatec
   ```

2. **Install dependencies**:
Make sure you have Composer installed. Run the following command:
composer install

3. **Set up the environment**:
Copy the .env.example file to .env:
```cp .env.example .env```
Generate the application key:
``` php artisan key:generate```

5. **Set up your database**:
Update your .env file with your database configuration (DB_CONNECTION, DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD).

For example:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=name
DB_USERNAME=user
DB_PASSWORD=password
```
## Running Migrations
Running Migrations
To create the necessary database tables, run the following command:
```php artisan migrate```

This will create the submissions table and any other tables defined in your migrations.

## Testing the API Endpoint


**Testing with Postman**

Open Postman and create a new request.
Set the request type to POST.
Enter the URL for your local server, e.g., http://localhost/api/submit.
In the body tab, select raw and choose JSON as the format.
Paste the following JSON into the body
Endpoint
URL: POST /submit
Request Body (JSON):
```
{
    "name": "Tester",
    "email": "test@mydomain.local",
    "message": "Text message, Text message, Text message"
}
```

**Validations**

```
name: required, string, max: 6 characters
email: required, string, must be a valid email format, max: 20 characters
message: required, string, max: 1000 characters
```

## Unit Tests

To run the unit tests, use the following command:
```php artisan test```

This will run all the unit tests defined in your project and provide a report on the results.
