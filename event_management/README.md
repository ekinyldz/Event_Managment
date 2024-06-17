# Event Management System

## Introduction

This is an Event Management System developed in PHP. Users can register, log in, and manage events they organize.

## Requirements

- PHP 7.0+
- MySQL
- A local server environment (XAMPP/WAMP)

## Setup Instructions

1. Clone or download the project files.
2. Place the project folder in the `htdocs` (for XAMPP) or `www` (for WAMP) directory.
3. Create a database named `event_management_db` in phpMyAdmin.
4. Import the provided SQL script to create the necessary tables.
5. Start the Apache and MySQL services from the XAMPP/WAMP control panel.
6. Open a browser and navigate to `http://localhost/event_management`.
7. Register a new user, log in, and start managing events.

## Code Structure

- **config.php**: Configuration file for database connection.
- **classes/**: Directory containing the class files.
- **index.php**: Home page.
- **register.php**: User registration form and handling.
- **login.php**: User login form and handling.
- **logout.php**: User logout handling.
- **events.php**: Event management interface.

## Classes and Methods

- **Database**: Class to handle database connection.
  - `connect()`
- **User**: Class to handle user-related operations.
  - `register($username, $email, $password)`
  - `login($username, $password)`
  - `isLoggedIn()`
  - `logout()`
- **Event**: Class to handle event-related operations.
  - `create($user_id, $event_name, $description, $event_date, $location)`
  - `read($user_id)`
  - `update($id, $event_name, $description, $event_date, $location)`
  - `delete($id)`
- **Session**: Class to manage sessions.
  - `start()`
  - `destroy()`
  - `get($key)`
  - `set($key, $value)`

## Security

- Passwords are securely hashed using `password_hash()`.
- Sessions are managed securely.
- Input data is validated to prevent SQL injection and XSS attacks.
