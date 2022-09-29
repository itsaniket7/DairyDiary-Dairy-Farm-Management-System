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

$query = "INSERT INTO workers(F_NAME, L_NAME, NO_OF_DAYS, DAILY_WAGES, user, w_no)
          VALUES ('{$fname}','{$lname}','{$nodays}','{$daily_wages}','{$user}','{$wid}')";

$result = $mysqli->query($query);

if(!$result)
{
    $_SESSION['workinsert'] = "Unable! to insert data try again!";
}
if($result)
{
 $_SESSION['workinsert'] = "  Successfully inserted!";
}


$mysqli->close();

header('Location: workers.php');
?>
</body>
</html>