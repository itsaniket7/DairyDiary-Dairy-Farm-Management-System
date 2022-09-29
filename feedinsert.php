<?php
session_start();
$username = "root";
$password = "";
$database = $_COOKIE['username'];

$mysqli = new mysqli("localhost", $username, $password, $database);


$field1 = $mysqli->real_escape_string($_POST['field1']);
$field2 = $mysqli->real_escape_string($_POST['field2']);
$field3 = $mysqli->real_escape_string($_POST['field3']);
$field4 = $mysqli->real_escape_string($_POST['field4']);

$field5 = $field3 * $field4;


$original_date = "$field1";

$timestamp = strtotime($original_date);

$new_date = date("y-m-d", $timestamp);

$query = "INSERT INTO feeddata (day_date,feed_name,quantity,price,t_paid)
          VALUES ('{$new_date}','{$field2}','{$field3}','{$field4}','{$field5}')";
$result = $mysqli->query($query);

if(!$result)
{

$_SESSION['feeddel'] = "   Record with same date already exist !";


}

if($result)
{

$_SESSION['feedinsert'] = "  Successfully inserted !";


}

$mysqli->close();

header('Location: http://localhost/A%20Capston%20DairyDiary/feed.php');
?>
