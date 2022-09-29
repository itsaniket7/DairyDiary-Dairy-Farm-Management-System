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

$year = $_POST['fnoinput'];
$field = $_POST['fid'];
$gross_i = $_POST['field3'];


// $f_price = 0;
// $p_price = 0;
// $w_price = 0;

// $query = "select * from fert_used where f_id = $field and date_used between '$year/01/01' and '$year/12/31';";

// if ($fert_used = $mysqli->query($query)) {
//   while ($row = $fert_used->fetch_assoc()) {
//       $fname = $row['FERT_NAME'];

//       $query1 = "select price from fertilizer where fert_name = '$fname'";
//       $result1 = $mysqli->query($query1);

//       $fid = $row['F_ID'];
//       $query2 = "select * from field where f_id = '$fid'";
//       $result2 = $mysqli->query($query2);

//       $f_price = $f_price + $result1->fetch_assoc()['price'] * $result2->fetch_assoc()['TOTAL_AREA'];
//   }
// }

// $query = "select * from pesti_used where f_id = $field and date_used between '$year/01/01' and '$year/12/31';";

// if ($p_used = $mysqli->query($query)) {
//   while ($row = $p_used->fetch_assoc()) {
//       $fname = $row['PEST_NAME'];
//       $query = "select price from pesticide where pest_name = '$fname'";
//       $result = $mysqli->query($query);
//       $p_price = $p_price + $result->fetch_assoc()['price'];
//   }
// }



      $query = "UPDATE income set Gross_income = {$gross_i} WHERE f_id = {$field} AND  I_year ={$year}";
      $result = $mysqli->query($query);
      if($result)
      {
        $_SESSION['incinsert'] = "Inserted Successfully!";
      }
    

$mysqli->close();

header('Location: income.php');
?>
</body>
</html>