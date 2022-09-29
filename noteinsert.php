<?php
session_start();
  if(! isset($_COOKIE["username"]))
           header("location:login-user.php");

?>


<?php
$username = "root";
$password = "";
$database = $_COOKIE['username'];

$mysqli = new mysqli("localhost", $username, $password, $database);

$lit = $_POST['field2'];
$field1 = $mysqli->real_escape_string($_POST['field1']);
$field2 = $mysqli->real_escape_string($lit);
$field3 = $mysqli->real_escape_string($_POST['field3']);

$original_date = "$field1";

$timestamp = strtotime($original_date);

$new_date = date("y-m-d", $timestamp);

$query = "INSERT INTO notedata (day_date,note_name,note_body)
          VALUES ('{$new_date}','{$field2}','{$field3}')";



$result = $mysqli->query($query);

if(!$result)
{

$_SESSION['notedel'] = "Note with same name already exist !";


}

if($result)
{

$_SESSION['noteinsert'] = "Note with name ".$field2." successfully created !";


}



$mysqli->close();

header('Location: note.php');
?>
