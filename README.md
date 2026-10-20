# Restaurant System

A work-in-progress PHP/MySQL restaurant system. The current implementation includes account registration and login, menu and category listings, point-of-sale order entry, order history, and receipt printing. Development is ongoing, and features and setup details may change.

## Requirements

- PHP with the `mysqli` and `pdo_mysql` extensions enabled
- MySQL or MariaDB
- Composer

## Local setup

1. Clone the repository into your local web server's document root.
2. From the project directory, install Composer dependencies and generate the autoloader:

   ```sh
   composer install
   ```

3. Create a local database named `ffos_db` and import [`database/ffos_db.sql`](database/ffos_db.sql) using phpMyAdmin or the MySQL command line.
4. Create your local database configuration by copying [`src/config/database.example.php`](src/config/database.example.php):

   ```bat
   copy src\config\database.example.php src\config\database.php
   ```

   Edit `src/config/database.php` with your database host, username, password, and database name. This local file is ignored by Git; only the example configuration is intended to be shared.
5. Update the `base_url` in [`src/public/index.php`](src/public/index.php) to match your local URL. With XAMPP, start Apache and MySQL, then open that URL in your browser.
6. Register an account through the app to try the account flow.

## Current features

- **Account access:** Register and sign in with username and password. Registration validates names, usernames, and password requirements, checks for an existing username, and stores a password hash. Success and error messages are shown through flash notifications.
- **Menu and category browsing:** View category and menu listings, status, and individual record details.
- **Point of sale:** Build an order from available menu items, set quantities, review the total, enter the tendered amount, and submit the order.
- **Order processing:** Submitted orders are associated with the signed-in user and receive a transaction code and queue number.
- **Order history and receipts:** Browse saved orders, delete an order, and open a printable receipt showing transaction and payment details.
- **Application shell:** A home page and navigation link to the current sales, order, category, and menu pages.

The project is still in progress; links for reports, kitchen operations, and other legacy screens are not listed as completed features.


## Source acknowledgment

This project is based on [Fast Food Ordering System in PHP/OOP Free Source Code](https://www.sourcecodester.com/php/15366/fast-food-ordering-system-phpoop-free-source-code.html). The original source describes the code as being developed for educational purposes and says it may be downloaded and modified. This repository contains my modifications. That statement does not clearly specify whether public redistribution is permitted.

## Development status

This repository is an early development snapshot, not a production-ready application. Features, configuration, and database setup may change as development continues.
