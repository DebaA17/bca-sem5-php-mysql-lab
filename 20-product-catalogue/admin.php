<?php
ob_start();
require 'connect.php';
ob_end_clean();

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $desc  = trim($_POST['description'] ?? '');
    $price = $_POST['price'] ?? '';
    $cat   = (int)($_POST['category_id'] ?? 0);

    if ($title === '' || $cat === 0 || !is_numeric($price)) {
        $message = 'Please fill in title, price and category.';
    } else {
        $stmt = mysqli_prepare($con,
            "INSERT INTO products (title, description, price, category_id) VALUES (?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "ssdi", $title, $desc, $price, $cat);
        $message = mysqli_stmt_execute($stmt) ? 'Product added!' : 'Error: ' . mysqli_error($con);
    }
}

// load categories for the dropdown
$cats = [];
$res = mysqli_query($con, "SELECT id, name FROM categories ORDER BY name");
while ($row = mysqli_fetch_assoc($res)) $cats[] = $row;
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Admin - Add Product</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        background: #f4f4f4;
    }

    .bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #222;
        padding: 12px 20px;
        color: #fff;
    }

    .bar a {
        color: #fff;
        background: #555;
        padding: 8px 16px;
        border-radius: 4px;
        text-decoration: none;
    }

    form {
        max-width: 450px;
        margin: 30px auto;
        background: #fff;
        padding: 20px;
        border-radius: 6px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, .1);
    }

    label {
        display: block;
        margin-top: 12px;
        font-weight: bold;
    }

    input,
    textarea,
    select {
        width: 100%;
        padding: 8px;
        margin-top: 4px;
        box-sizing: border-box;
        font-size: 15px;
    }

    button {
        margin-top: 16px;
        padding: 10px 20px;
        background: #3b82f6;
        color: #fff;
        border: none;
        border-radius: 4px;
        font-size: 16px;
        cursor: pointer;
    }

    .msg {
        max-width: 450px;
        margin: 20px auto 0;
        text-align: center;
        color: #166534;
    }
</style>
</head>
<body>

<div class="bar">
  <strong>Admin - Add Product</strong>
  <a href="index.php">Back to Search</a>
</div>

<?php if ($message): ?><p class="msg"><?= htmlspecialchars($message) ?></p><?php endif; ?>

<form method="post">
  <label>Title</label>
  <input type="text" name="title" required>

  <label>Description</label>
  <textarea name="description" rows="4"></textarea>

  <label>Category</label>
  <select name="category_id" required>
    <option value="">-- select --</option>
    <?php foreach ($cats as $c): ?>
      <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['name']) ?></option>
    <?php endforeach; ?>
  </select>

  <label>Price</label>
  <input type="number" name="price" step="0.01" min="0" required>

  <button type="submit">Add Product</button>
</form>

</body>
</html>