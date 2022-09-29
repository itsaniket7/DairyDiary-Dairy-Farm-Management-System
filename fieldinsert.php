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
$crop = $mysqli->real_escape_string($_POST['field2']);
$sow_date = $mysqli->real_escape_string($_POST['field3']);
$total = $_POST['field4'];
$igap = $_POST['field5'];
$wid = $mysqli->real_escape_string($_POST['field6']);


$original_date = "$sow_date";

$timestamp = strtotime($original_date);

$new_date = date("y-m-d", $timestamp);


$user_check = "SELECT * FROM field WHERE farm_no = '$farm_no' AND  user ='$user'";
    $res = $mysqli->query($user_check);
    if(mysqli_num_rows($res) > 0){
      $query = "UPDATE field set CROP = '{$crop}', SOW_DATE='{$new_date}', TOTAL_AREA = {$total}, I_GAP = {$igap}, W_ID = {$wid} WHERE farm_no = $farm_no AND user ='$user'";
      $result = $mysqli->query($query);
      if($result)
      {
      $_SESSION['fieldinsert'] = "Updated Successfully!";
      }
    }
    else
    {
      $query = "INSERT INTO field(CROP, SOW_DATE, TOTAL_AREA, I_GAP, W_ID, farm_no, user)
          VALUES ('{$crop}','{$new_date}',{$total},{$igap},{$wid},{$farm_no},'{$user}')";

      $result = $mysqli->query($query);
      if($result)
      {
      $_SESSION['fieldinsert'] = "  Successfully inserted!";
      }

    }


$mysqli->close();

header('Location: field.php');
?>
</body>
</html>