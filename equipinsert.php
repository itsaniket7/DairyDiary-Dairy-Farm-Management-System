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

$e_id = $_POST['field1'];
$e_name = $mysqli->real_escape_string($_POST['field2']);
$price = $_POST['field3'];
$m_period = $_POST['field4'];
$avail = $_POST['field5'];

$query = "INSERT INTO equipments(e_no, E_NAME, PRICE, M_PERIOD, AVAILABLE, user)
          VALUES ('{$e_id}','{$e_name}','{$price}','{$m_period}','{$avail}','{$user}')";

$result = $mysqli->query($query);

if(!$result)
{
    $_SESSION['equipinsert'] = "It seems like data for given equipment ID is already exists";
}
if($result)
{
 $_SESSION['equipinsert'] = "  Successfully inserted!";
}


$mysqli->close();

header('Location: equipments.php');
?>
</body>
</html>