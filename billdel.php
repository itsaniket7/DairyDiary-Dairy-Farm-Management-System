<?php 
session_start();
$username = "root";
$password = "";
$database = $_COOKIE['username'];
$mysqli = new mysqli("localhost", $username, $password, $database);


if(isset($_POST['but_delete'])){

  if(isset($_POST['delete'])){
    foreach($_POST['delete'] as $deleteid){

      $deleteUser = "DELETE from billdata WHERE bill_name='$deleteid'";
$result = mysqli_query($mysqli,$deleteUser);
   
if($result)
{

$_SESSION['billdelete'] = "  Record deleted successfully";

}    

if(!$result)
{

$_SESSION['billdelete1'] = "  Error : Unable to delete record , try again";

}    



 }
  }
 
}
header("location: Bill.php")
?>