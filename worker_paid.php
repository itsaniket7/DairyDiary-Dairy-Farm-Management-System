<?php 
session_start();
$username = "root";
$password = "";
$database = "farm";
$mysqli = new mysqli("localhost", $username, $password, $database);

$user = $_COOKIE['username'];

  if(isset($_POST['update'])){
    foreach($_POST['update'] as $deleteid){

      $deleteUser = "Update workers set no_of_days = 0 where user = '$user' and w_no = $deleteid";
    $result =  mysqli_query($mysqli, $deleteUser);
if($result)
{

$_SESSION['workdelete'] = "Paid successfully";

}    

if(!$result)
{

$_SESSION['workdelete1'] = "  Error : Unable to update record , try again";

}    


}
  }
 
 header("location: workers.php")
?>