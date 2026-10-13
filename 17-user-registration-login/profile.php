<?php
require_once 'bootstrap.php';
require_login();

$query = $conn->prepare('SELECT username, email FROM users WHERE id = ?');
$query->execute([$_SESSION['user_id']]);
$user = $query->fetch(PDO::FETCH_ASSOC);
?>
<h2>Welcome, <?= clean($user['username']) ?>!</h2>
<p>Email: <?= clean($user['email']) ?></p>
<p><a href="logout.php">Logout</a></p>
