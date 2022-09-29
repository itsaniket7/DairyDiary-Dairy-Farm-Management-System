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

$farm_no = $_POST['field1'];
$pest_name = $mysqli->real_escape_string($_POST['field2']);
$sow_date = $mysqli->real_escape_string($_POST['field3']);

$original_date = "$sow_date";

$timestamp = strtotime($original_date);

$new_date = date("y-m-d", $timestamp);

$query1 = "SELECT F_ID FROM field where user = '$user' and farm_no = '$farm_no'";
$result1 = $mysqli->query($query1);
$row1 = $result1->fetch_assoc();
$fid = $row1["F_ID"];
      $query = "INSERT INTO pesti_used(F_ID, PEST_NAME, DATE_USED)
          VALUES ({$fid},'{$pest_name}','{$new_date}')";

      $result = $mysqli->query($query);
      if($result)
      {
      $_SESSION['pestinsert'] = "  Successfully inserted!";
      }
      else
      {
        $_SESSION['pestinsert'] = "Error: Unable to insert";
      }


$mysqli->close();

header('Location: pesticide.php');
?>
</body>
</html>