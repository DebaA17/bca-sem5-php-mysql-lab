<form method="post">
    Name: <input name="name"><br>
    Email: <input type="email" name="email"><br>
    Comment: <textarea name="comment"></textarea><br>
    <input type="submit" value="Send">
</form>

<?php
if ($_POST) {
    $name = trim($_POST['name']);
    $comment = trim($_POST['comment']);

    if (!$name) echo "Name is required.<br>";
    if (!$comment) echo "Comment is required.<br>";
    if ($name && $comment) echo "Thank you, $name. We will reply to your mail.";
}
?>