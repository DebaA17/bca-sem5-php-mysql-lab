<?php
require_once 'config.php';

$query = $conn->prepare('SELECT * FROM products WHERE id = ?');
$query->execute([$_GET['id'] ?? 0]);
$product = $query->fetch(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Product Details</title>
</head>
<body>
    <?php if (!$product): ?>
        <h1>Product not found</h1>
    <?php else: ?>
        <h1><?= clean($product['name']) ?></h1>
        <p><strong>Category:</strong> <?= clean($product['category']) ?></p>
        <p><strong>Description:</strong> <?= clean($product['description']) ?></p>
        <p><strong>Price:</strong> Rs. <?= number_format($product['price'], 2) ?></p>
    <?php endif; ?>
    <p><a href="index.php">Back to catalogue</a></p>
</body>
</html>
