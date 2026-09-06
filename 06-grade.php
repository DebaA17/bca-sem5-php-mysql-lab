<form method="post">
    Enter marks: <input type="number" name="marks" min="0" max="100" required>
    <input type="submit" value="Find Grade">
</form>

<?php
if (isset($_POST['marks'])) {
    $marks = $_POST['marks'];

    if ($marks >= 90) $grade = "A";
    elseif ($marks >= 80) $grade = "B";
    elseif ($marks >= 70) $grade = "C";
    elseif ($marks >= 60) $grade = "D";
    else $grade = "F";

    echo "Grade: $grade";
}
?>