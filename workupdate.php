<?php

  if(! isset($_COOKIE["username"]))
           header("location:login-user.php");
?>
<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" href="design.css">
</head>
<body>
<?php
session_start();
$username = "root";
$password = "";
$database = "farm";

$mysqli = new mysqli("localhost", $username, $password, $database);

$user = $_COOKIE['username'];

$wid = $_POST['field1'];
$fname = $mysqli->real_escape_string($_POST['field2']);
$lname = $mysqli->real_escape_string($_POST['field3']);
$nodays = $_POST['field4'];
$daily_wages = $_POST['field5'];

$query = "Update workers set F_NAME = '$fname', L_NAME = '$lname', NO_OF_DAYS = $nodays, DAILY_WAGES = $daily_wages  where w_no = $wid and user = '$user'";

$result = $mysqli->query($query);

if($result)
{
 $_SESSION['workupdate'] = "Updated successfully!";
}
else
{
    $_SESSION['workupdate'] = "Unable to update record!";
}



$mysqli->close();

header('Location: workers.php');
?>
</body>
</html>