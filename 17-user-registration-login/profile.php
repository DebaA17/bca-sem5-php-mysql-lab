<?php
declare(strict_types=1);

require_once __DIR__ . '/bootstrap.php';
require_login();

$statement = database()->prepare(
    'SELECT username, email, created_at FROM users WHERE id = :id LIMIT 1'
);
$statement->execute(['id' => $_SESSION['user_id']]);
$user = $statement->fetch();

if (!$user) {
    $_SESSION = [];
    header('Location: login.php');
    exit;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Profile - PHP User System</title>
</head>
<body>
    <h1>Welcome, <?= escape($user['username']) ?>!</h1>
    <p>This page is available only to logged-in users.</p>
    <dl>
        <dt>Username</dt>
        <dd><?= escape($user['username']) ?></dd>
        <dt>Email</dt>
        <dd><?= escape($user['email']) ?></dd>
        <dt>Registered</dt>
        <dd><?= escape($user['created_at']) ?></dd>
    </dl>
    <form method="post" action="logout.php">
        <input type="hidden" name="csrf_token" value="<?= escape(csrf_token()) ?>">
        <button type="submit">Log out</button>
    </form>
</body>
</html>
