
<?php
$Server="localhost";
$User="test";
$Password="test";
$db="test";
$con=mysqli_connect($Server,$User,$Password,$db);
if($con)
echo "connected";
else
echo "Fail to Connect";
?>
