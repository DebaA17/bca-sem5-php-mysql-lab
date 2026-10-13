# Code 17: User Registration and Login System

This short example implements registration, login, a protected profile page,
and logout using PHP, MySQL, sessions, prepared statements, and
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

The password is stored as a hash in `users.password_hash`, not as plain text.
