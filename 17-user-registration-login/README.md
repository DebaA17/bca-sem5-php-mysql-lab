# Code 17: User Registration and Login System

This example implements registration, login, a protected profile page, and
logout using PHP, MySQL, sessions, prepared statements, CSRF tokens, and
`password_hash()`/`password_verify()`.

## Setup

1. Create the database and table:

   ```bash
   mysql -u devuser -p < schema.sql
   ```

2. If your MySQL credentials differ, update the constants in
   [`config.php`](config.php).

3. Serve this directory through Apache or PHP's development server:

   ```bash
   php -S localhost:8000
   ```

4. Open `http://localhost:8000/register.php` and create an account.

The password is never stored as plain text. The `users.password_hash` column
stores the result of `password_hash()` instead.
