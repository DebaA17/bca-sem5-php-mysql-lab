<?php
require_once 'bootstrap.php';

$message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if ($username == '' || !filter_var($email, FILTER_VALIDATE_EMAIL) || $password == '') {
        $message = 'Please fill all fields correctly.';
    } else {
        $query = $conn->prepare(
            'INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)'
        );
        try {
            $query->execute([$username, $email, password_hash($password, PASSWORD_DEFAULT)]);
            $message = 'Registration successful. <a href="login.php">Login here</a>.';
        } catch (PDOException $error) {
            $message = 'Username or email already exists.';
        }
    }
}
?>
<h2>Registration</h2>
<p><?= $message ?></p>
<form method="post">
    Username: <input name="username" required><br><br>
    Email: <input type="email" name="email" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <button>Register</button>
</form>
<p><a href="login.php">Login</a></p>
