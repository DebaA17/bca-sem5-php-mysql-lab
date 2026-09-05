<?php
$days = array("Monday", "Tuesday", "Wednesday");
$months = array("Jan" => "January", "Feb" => "February", "Mar" => "March");

foreach ($days as $day) echo "$day<br>";
foreach ($months as $short => $month) echo "$short => $month<br>";

sort($days);
echo "<br>Sorted days:<br>";
foreach ($days as $day) echo "$day<br>";
?>