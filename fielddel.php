<?php 
session_start();
$username = "root";
$password = "";
$database = "farm";
$mysqli = new mysqli("localhost", $username, $password, $database);

$user = $_COOKIE['username'];
if(isset($_POST['but_delete'])){

  if(isset($_POST['delete'])){
    foreach($_POST['delete'] as $deleteid){

      $deleteUser = "Update field set CROP = null, SOW_DATE = null, W_ID = null, I_ACTION = null WHERE farm_no = '$deleteid' AND user ='$user'";
    $result =  mysqli_query($mysqli, $deleteUser);
if($result)
{

$_SESSION['fielddelete'] = "  Record deleted successfully";

}    

if(!$result)
{

$_SESSION['fielddelete1'] = "  Error : Unable to delete record , try again";

}    


}
  }
 
}
 header("location: field.php")
?>