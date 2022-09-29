<?php
$username = "root";
$password = "";
$database = $_COOKIE['username'];

$mysqli = new mysqli("localhost", $username, $password, $database);


$field1 = $mysqli->real_escape_string($_POST['field1']);
$field2 = $mysqli->real_escape_string($_POST['field2']);
$field3 = $mysqli->real_escape_string($_POST['field3']);
$field4 = $mysqli->real_escape_string($_POST['field4']);
$field5 = $mysqli->real_escape_string($_POST['field5']);
$field6 = $mysqli->real_escape_string($_POST['field6']);

$original_date = "$field1";

$timestamp = strtotime($original_date);

$new_date = date("y-m-d", $timestamp);

$query = "INSERT INTO feeddata (day_date,feed_name,quantity,price)
          VALUES ('{$new_date}','{$field2}','{$field3}','{$field4}')";
$mysqli->query($query);
$mysqli->close();

header('Location: Bill.php');
?>
