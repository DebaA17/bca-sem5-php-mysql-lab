<?php
$name = "Debasis";
$email = "admin@debasisbiswas.in";
?>
<form method="post">
    <input type="hidden" name="name" value="<?= $name ?>">
    <input type="hidden" name="email" value="<?= $email ?>">
    Comment: <textarea name="comment"></textarea><br>
    <input type="submit" value="Submit">
</form>

<?php
if (isset($_POST['comment'])) {
    echo "Thanks for comment, {$_POST['name']}, {$_POST['email']}";
}
?>