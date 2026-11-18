<?php
require_once 'config.php';

$search = trim($_GET['search'] ?? '');
$category = $_GET['category'] ?? '';

$categories = $conn->query('SELECT DISTINCT category FROM products ORDER BY category')
    ->fetchAll(PDO::FETCH_COLUMN);

$sql = 'SELECT * FROM products WHERE 1=1';
$values = [];

if ($search != '') {
    $sql .= ' AND (name LIKE ? OR description LIKE ?)';
    $values[] = "%$search%";
    $values[] = "%$search%";
}
if ($category != '') {
    $sql .= ' AND category = ?';
    $values[] = $category;
}

$sql .= ' ORDER BY name';
$query = $conn->prepare($sql);
$query->execute($values);
$products = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Product Catalogue</title>
</head>
<body>
    <h1>Product Catalogue</h1>

    <form method="get">
        <input type="search" name="search" placeholder="Search products"
               value="<?= clean($search) ?>">
        <select name="category">
            <option value="">All categories</option>
            <?php foreach ($categories as $item): ?>
                <option value="<?= clean($item) ?>"
                    <?= $category == $item ? 'selected' : '' ?>>
                    <?= clean($item) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button>Search</button>
    </form>

    <?php if (!$products): ?>
        <p>No products found.</p>
    <?php else: ?>
        <?php foreach ($products as $product): ?>
            <h2><?= clean($product['name']) ?></h2>
            <p>Category: <?= clean($product['category']) ?></p>
            <p>Price: Rs. <?= number_format($product['price'], 2) ?></p>
            <a href="product.php?id=<?= $product['id'] ?>">View details</a>
            <hr>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>
