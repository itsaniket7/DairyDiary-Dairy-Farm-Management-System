<?php 
session_start();
$username = "root";
$password = "";
$database = "farm";
$mysqli = new mysqli("localhost", $username, $password, $database);

$user = $_COOKIE['username'];
if(isset($_POST['but_delete'])){

  if(isset($_POST['delete'])){
    $deleteid = $_POST['delete'];
    for ($x = 0; $x <= count($_POST['delete']); $x=$x+2) {
      $xp = $x+1;
      $deleteUser = "delete from income where i_year ='$deleteid[$x]' AND f_id = '$deleteid[$xp]'";
      $result =  mysqli_query($mysqli, $deleteUser);
      if($result)
      {
      
      $_SESSION['incdelete'] = "  Record deleted successfully";
      
      }    
      
      if(!$result)
      {
      
      $_SESSION['incdelete1'] = "  Error : Unable to delete record , try again";
      
      }   
    } 
  }
 
}
//  header("location: income.php")
?>