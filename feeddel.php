<?php 

session_start();
$username = "root";
$password = "";
$database = $_COOKIE['username'];
$mysqli = new mysqli("localhost", $username, $password, $database);


if(isset($_POST['but_delete'])){

  if(isset($_POST['delete'])){
    foreach($_POST['delete'] as $deleteid){

      $deleteUser = "DELETE from feeddata WHERE day_date='$deleteid'";
$result= mysqli_query($mysqli,$deleteUser);
if($result)
{

$_SESSION['feeddelete'] = "  Record deleted successfully";

}

if(!$result)
{

$_SESSION['feeddelete'] = "   Error : Unable to delete record";

}

    }
  }
 
}
header("location: http://localhost/A%20Capston%20DairyDiary/feed.php")
?>