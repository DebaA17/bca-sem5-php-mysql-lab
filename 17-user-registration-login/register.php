<?php
declare(strict_types=1);

require_once __DIR__ . '/bootstrap.php';

$errors = [];
$username = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim((string) ($_POST['username'] ?? ''));
    $email = trim((string) ($_POST['email'] ?? ''));
    $password = (string) ($_POST['password'] ?? '');
    $confirmPassword = (string) ($_POST['confirm_password'] ?? '');

    if (!verify_csrf_token($_POST['csrf_token'] ?? null)) {
        $errors[] = 'The form expired. Please try again.';
    }
    if (!preg_match('/^[A-Za-z0-9_]{3,30}$/', $username)) {
        $errors[] = 'Username must contain 3-30 letters, numbers, or underscores.';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Enter a valid email address.';
    }
    if (strlen($password) < 8) {
        $errors[] = 'Password must contain at least 8 characters.';
    }
    if ($password !== $confirmPassword) {
        $errors[] = 'Passwords do not match.';
    }

    if (!$errors) {
        $statement = database()->prepare(
            'SELECT id FROM users WHERE username = :username OR email = :email LIMIT 1'
        );
        $statement->execute(['username' => $username, 'email' => $email]);

        if ($statement->fetch()) {
            $errors[] = 'That username or email address is already registered.';
        } else {
            $statement = database()->prepare(
                'INSERT INTO users (username, email, password_hash)
                 VALUES (:username, :email, :password_hash)'
            );
            $statement->execute([
                'username' => $username,
                'email' => $email,
                'password_hash' => password_hash($password, PASSWORD_DEFAULT),
            ]);

            header('Location: login.php?registered=1');
            exit;
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Register - PHP User System</title>
</head>
<body>
    <h1>Create an account</h1>
    <?php if ($errors): ?>
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= escape($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <form method="post">
        <input type="hidden" name="csrf_token" value="<?= escape(csrf_token()) ?>">
        <label>
            Username
            <input type="text" name="username" value="<?= escape($username) ?>" required>
        </label>
        <br>
        <label>
            Email
            <input type="email" name="email" value="<?= escape($email) ?>" required>
        </label>
        <br>
        <label>
            Password
            <input type="password" name="password" required>
        </label>
        <br>
        <label>
            Confirm password
            <input type="password" name="confirm_password" required>
        </label>
        <br>
        <button type="submit">Register</button>
    </form>
    <p>Already registered? <a href="login.php">Log in</a>.</p>
</body>
</html>
