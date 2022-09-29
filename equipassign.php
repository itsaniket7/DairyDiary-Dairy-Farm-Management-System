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
$w_id = $_POST['field2'];

$query = "SELECT * FROM equipments where user = '$user' and e_no = $e_id";
$result = $mysqli->query($query);
$row = $result->fetch_assoc();

$e_id = $row["e_id"];

echo $e_id;

$query = "INSERT INTO equip_assign(E_ID, w_id)
          VALUES ({$e_id},{$w_id})";
$result = $mysqli->query($query);

$query1 = "Update equipments set available = (select available from equipments where e_id = $e_id) - 1 where e_id = $e_id";
$result1 = $mysqli->query($query1);

$query2 = "Update workers set e_assigned = (select e_assigned from workers where w_id = $w_id) + 1 where w_id = $w_id";
$result2 = $mysqli->query($query2);

if(!$result)
{
    $_SESSION['equipa'] = "Unable to assign try again!";
}
if($result)
{
 $_SESSION['equipa'] = "  Successfully Assigned!";
}


$mysqli->close();

header('Location: equipments.php');
?>
</body>
</html>