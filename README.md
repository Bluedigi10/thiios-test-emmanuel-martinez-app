Setup Instructions
Environment Setup:

Make sure you have PHP and Composer installed.
Install Laravel Breeze by running the following commands:

composer require laravel/breeze --dev
php artisan breeze:install
npm install && npm run dev

Configure your database settings in the .env file.
Database Configuration:

DB_CONNECTION=your db name connection
DB_HOST=your db host
DB_PORT=your db port
DB_DATABASE= your db name
DB_USERNAME=your db username
DB_PASSWORD=your db password

Run the database migrations:

php artisan migrate

Running Tests:

Make sure PHPUnit is installed (it comes with Laravel by default).
Run the tests using the following command:

php artisan test

Brief Report
Application Architecture:
This application was made using laravel, the login and register methods were implemented usign the breeze starter tool, just need little modification to make it as was require.


Key Decisions:
I used basic configuration for laravel and using vue for the front, for their practicity 

Test-Driven Development (TDD):
The tests cover the login, register, delete and everthing related with the authotization



Brief Report
Application Architecture
Our application is built using the Laravel framework, following the Model-View-Controller (MVC) architectural pattern. The frontend is powered by vue, a minimal and customizable authentication scaffold. The backend leverages Laravel's Eloquent ORM for database interactions.

Key Decisions
Laravel Breeze: Chose Breeze for its simplicity and ease of customization for authentication and user management features.
PHPUnit: Selected PHPUnit as the testing framework for its tight integration with Laravel and robust features.
Database: Utilized Laravel migrations for seamless database schema updates and rollbacks.
Test-Driven Development (TDD)
Test-Driven Development was a core practice in our development process. Each feature or change started with a failing test, followed by the implementation to make the test pass. This approach ensured the reliability of our codebase and facilitated continuous integration
