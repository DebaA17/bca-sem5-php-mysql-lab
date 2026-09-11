<form method="post">
    What is 2 + 2?<br>
    <input type="radio" name="answer" value="3"> 3
    <input type="radio" name="answer" value="4"> 4
    <input type="radio" name="answer" value="5"> 5
    <input type="submit" value="Submit">
</form>

<?php
if ($_POST) {
    if (!isset($_POST['answer'])) echo "You must select one answer";
    elseif ($_POST['answer'] == 4) echo "Your answer is correct";
    else echo "Your answer is incorrect";
}
?>