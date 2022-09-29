<?php 
session_start();
$username = "root";
$password = "";
$database = $_COOKIE['username'];
$mysqli = new mysqli("localhost", $username, $password, $database);


if(isset($_POST['but_delete'])){

  if(isset($_POST['delete'])){
    foreach($_POST['delete'] as $deleteid){

      $deleteUser = "DELETE from field WHERE f_id='$deleteid'";
    $result =  mysqli_query($mysqli,$deleteUser);
if($result)
{

$_SESSION['milkdelete'] = "  Record deleted successfully";

}    

if(!$result)
{

$_SESSION['milkdelete1'] = "  Error : Unable to delete record , try again";

}    


}
  }
 
}
 header("location: http://localhost/A%20Capston%20DairyDiary/milk.php")
?>