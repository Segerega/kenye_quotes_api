# Laravel Kanye West Quotes Application

This Laravel application connects to the `api.kanye.rest` to fetch random Kanye West quotes. It includes features such as caching quotes and generating a `next` token for pagination-like functionality.

## Requirements

- PHP >= 7.3
- Composer
- A web server like Apache or Nginx
- MySQL or another Laravel-supported database system

## Installation

1. **Clone the Repository**

    ```
    git clone https://github.com/Segerega/kenye_quotes_api.git
    cd kenye_quotes_api
    ```

2. **Install Dependencies**

    ```
    composer install
    ```

3. **Environment File**

   Copy the `.env.example` file to a new file named `.env`.

    ```
    cp .env.example .env
    ```

   Then, open `.env` and set your database credentials and other environment variables as required.

4. **Generate Application Key**

    ```
    php artisan key:generate
    ```

5. **Run Migrations** (If you have any database migrations)

    ```
    php artisan migrate
    ```

6. **Run the Server**

    ```
    php artisan serve
    ```

   This will start the server at `http://localhost:8000`.

## Usage

The application provides endpoints to access Kanye West quotes. To use these endpoints, you will need to include an API token in the request header as a Bearer token.

- **Get a Random Quote**: Access `/api/kanye-quote` to get a random Kanye West quote.
- **Get Multiple Quotes**: Access `/api/kanye-quotes/{count}` to get multiple quotes.
- **Refresh Quotes**: Access `/api/refresh-kanye-quotes` to refresh and get new quotes.


### Endpoints

- **Get a Random Quote**

  Access `/api/kanye-quote` to get a random Kanye West quote.

  ```bash
  curl -X GET http://localhost:8000/api/kanye-quote \
  -H "Authorization: Bearer {Your_Api_Token}"

## Testing

The application includes both feature tests and unit tests.

1. **Run Tests**

   Run the PHPUnit test suite:

    ```
    php artisan test
    ```

   This command runs all the tests and outputs the results.

2. **Specific Tests**

   To run specific tests, use the PHPUnit command:

    ```
    ./vendor/bin/phpunit --filter NameOfTheTest
    ```

## Notes

- If you encounter any issues during setup, ensure your server and PHP environments meet Laravel's requirements.
- For detailed documentation on Laravel, visit [Laravel Documentation](https://laravel.com/docs).
