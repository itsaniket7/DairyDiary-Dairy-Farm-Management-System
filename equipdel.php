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

      $deleteUser = "delete from equipments where e_no = '$deleteid' And user = '$user'";
    $result =  mysqli_query($mysqli, $deleteUser);
if($result)
{

$_SESSION['equipdelete'] = "  Record deleted successfully";

}    

if(!$result)
{

$_SESSION['equipdelete1'] = "  Error : Unable to delete record , try again!";

}    


}
  }
 
}
 header("location: equipments.php")
?>