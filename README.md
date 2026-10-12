# Restaurant system

This is a work-in-progress PHP/MySQL restaurant system. It contains initial features for account registration and login, menu/category management, and order and sales pages. Development is ongoing, so some features and setup details may change.

## Requirements

- PHP with the `mysqli` and `pdo_mysql` extensions enabled
- MySQL or MariaDB
- Composer

## Local setup

1. Clone the repository into your local web server's document root.
2. From the project directory, install Composer's generated autoloader:

   ```sh
   composer install
   ```

3. Import [`database/ffos_db.sql`](database/ffos_db.sql) using phpMyAdmin or the MySQL command line.
4. Update the database settings and `base_url` for your local setup. For XAMPP, the default database user is often `root` with an empty password; change these values if your MySQL server uses different credentials.
5. Start Apache and MySQL, then open the URL configured as `base_url` in your browser.
6. Register an account through the app to try the account flow.


## Source acknowledgment

This project is based on [Fast Food Ordering System in PHP/OOP Free Source Code](https://www.sourcecodester.com/php/15366/fast-food-ordering-system-phpoop-free-source-code.html). The original source describes the code as being developed for educational purposes and says it may be downloaded and modified. This repository contains my modifications. That statement does not clearly specify whether public redistribution is permitted.

## Development status

This repository is an early development snapshot, not a production-ready application. Features, configuration, and database setup may change as development continues.
