<?php
$name = $_POST['name'] ?? '';
$age = $_POST['age'] ?? '';
$gender = $_POST['gender'] ?? '';
?>
<form method="post">
    Name: <input name="name" value="<?= $name ?>"><br>
    Email: <input type="email" name="email"><br>
    Age: <input type="number" name="age" value="<?= $age ?>"><br>
    Gender: <input name="gender" value="<?= $gender ?>"><br>
    <input type="submit" value="Submit">
</form>