<?php
declare(strict_types=1);

require_once __DIR__ . '/bootstrap.php';

if (isset($_SESSION['user_id'])) {
    header('Location: profile.php');
    exit;
}

$errors = [];
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim((string) ($_POST['email'] ?? ''));
    $password = (string) ($_POST['password'] ?? '');

    if (!verify_csrf_token($_POST['csrf_token'] ?? null)) {
        $errors[] = 'The form expired. Please try again.';
    } else {
        $statement = database()->prepare(
            'SELECT id, username, password_hash FROM users WHERE email = :email LIMIT 1'
        );
        $statement->execute(['email' => $email]);
        $user = $statement->fetch();

        if (!$user || !password_verify($password, $user['password_hash'])) {
            $errors[] = 'Invalid email or password.';
        } else {
            session_regenerate_id(true);
            $_SESSION['user_id'] = (int) $user['id'];
            $_SESSION['username'] = $user['username'];

            if (password_needs_rehash($user['password_hash'], PASSWORD_DEFAULT)) {
                $statement = database()->prepare(
                    'UPDATE users SET password_hash = :password_hash WHERE id = :id'
                );
                $statement->execute([
                    'password_hash' => password_hash($password, PASSWORD_DEFAULT),
                    'id' => $user['id'],
                ]);
            }

            header('Location: profile.php');
            exit;
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Login - PHP User System</title>
</head>
<body>
    <h1>Log in</h1>
    <?php if (isset($_GET['registered'])): ?>
        <p>Registration successful. You can now log in.</p>
    <?php endif; ?>
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
            Email
            <input type="email" name="email" value="<?= escape($email) ?>" required>
        </label>
        <br>
        <label>
            Password
            <input type="password" name="password" required>
        </label>
        <br>
        <button type="submit">Log in</button>
    </form>
    <p>Need an account? <a href="register.php">Register</a>.</p>
</body>
</html>
