<?php 
session_start();
$username = "root";
$password = "";
$database = $_COOKIE['username'];
$mysqli = new mysqli("localhost", $username, $password, $database);


if(isset($_POST['but_delete'])){

  if(isset($_POST['delete'])){
    foreach($_POST['delete'] as $deleteid){
      $deleteUser = "DELETE from notedata WHERE note_name='$deleteid'";
 $result = mysqli_query($mysqli,$deleteUser); 
   
if($result)
{

$_SESSION['notedelete'] = "  Record deleted successfully";

}    
else
{

$_SESSION['notedelete1'] = "  Error : Unable to delete record , try again";

}    


}    
  } 
}
 header("location: note.php")
?>