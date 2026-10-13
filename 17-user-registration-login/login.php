<?php
require_once 'bootstrap.php';

$message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $query = $conn->prepare('SELECT * FROM users WHERE email = ?');
    $query->execute([$_POST['email']]);
    $user = $query->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($_POST['password'], $user['password_hash'])) {
        $_SESSION['user_id'] = $user['id'];
        header('Location: profile.php');
        exit;
    }
    $message = 'Invalid email or password.';
}
?>
<h2>Login</h2>
<p><?= $message ?></p>
<form method="post">
    Email: <input type="email" name="email" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <button>Login</button>
</form>
<p><a href="register.php">Create an account</a></p>
