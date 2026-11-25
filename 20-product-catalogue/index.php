<?php
// swallow the "connected" echo from connect.php so it doesn't show on the page
ob_start();
require 'connect.php';
ob_end_clean();

$q = isset($_GET['q']) ? trim($_GET['q']) : '';
$searched = isset($_GET['q']);
$results = [];

if ($searched) {
    $like = '%' . $q . '%';
    $stmt = mysqli_prepare($con,
        "SELECT p.title, p.description, p.price, c.name AS category
         FROM products p JOIN categories c ON c.id = p.category_id
         WHERE p.title LIKE ? OR p.description LIKE ? OR c.name LIKE ?
         ORDER BY p.title");
    mysqli_stmt_bind_param($stmt, "sss", $like, $like, $like);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    while ($row = mysqli_fetch_assoc($res)) $results[] = $row;
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Product Search</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        background: #f4f4f4;
    }

    .bar {
        display: flex;
        align-items: center;
        gap: 10px;
        background: #222;
        padding: 12px 20px;
    }

    .bar form {
        flex: 1;
        display: flex;
        gap: 8px;
    }

    .bar input[type=text] {
        flex: 1;
        padding: 8px;
        border: none;
        border-radius: 4px;
        font-size: 16px;
    }

    .bar button,
    .bar a.admin {
        padding: 8px 16px;
        border: none;
        border-radius: 4px;
        background: #3b82f6;
        color: #fff;
        font-size: 16px;
        cursor: pointer;
        text-decoration: none;
    }

    .bar a.admin {
        background: #555;
    }

    .list {
        padding: 20px;
    }

    .card {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        background: #fff;
        border-radius: 6px;
        padding: 14px 18px;
        margin-bottom: 10px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, .1);
    }

    .card .info {
        flex: 1;
    }

    .card h3 {
        margin: 0 0 4px;
    }

    .card p {
        margin: 0;
        color: #555;
    }

    .cat {
        font-size: 12px;
        background: #e5e7eb;
        padding: 2px 8px;
        border-radius: 10px;
    }

    .price {
        font-size: 20px;
        font-weight: bold;
        white-space: nowrap;
    }

    .msg {
        color: #666;
        text-align: center;
        margin-top: 40px;
    }
</style>
</head>
<body>

<div class="bar">
  <form method="get" action="index.php">
    <input type="text" name="q" placeholder="Search products..." value="<?= htmlspecialchars($q) ?>">
    <button type="submit">Search</button>
  </form>
  <a class="admin" href="admin.php">Admin</a>
</div>

<div class="list">
<?php if (!$searched): ?>
  <p class="msg">Type something and hit Search.</p>
<?php elseif (!$results): ?>
  <p class="msg">No products found.</p>
<?php else: foreach ($results as $p): ?>
  <div class="card">
    <div class="info">
      <h3><?= htmlspecialchars($p['title']) ?> <span class="cat"><?= htmlspecialchars($p['category']) ?></span></h3>
      <p><?= htmlspecialchars($p['description']) ?></p>
    </div>
    <div class="price">Rs.<?= number_format($p['price'], 2) ?></div>
  </div>
<?php endforeach; endif; ?>
</div>

</body>
</html>