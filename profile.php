 <?php

         if(! isset($_COOKIE["username"]))
           header("location: login-user.php");

  ?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>
DairyDiary
</title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="design.css">
  <link rel="shortcut icon" type="image/x-icon" href="logo.ico"/>

<style>
body {
  font-family: Arial, Helvetica, sans-serif;
}

.flip-card {
  background-color: transparent;
  width: 800px;
  height: 300px;
  perspective: 1000px;
position: absolute;
left: 20%;
top: 30%;
}

.flip-card-inner {
  position: relative;
  width: 100%;
  height: 100%;
  text-align: center;
  transition: transform 0.6s;
  transform-style: preserve-3d;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
}

.flip-card:hover .flip-card-inner {
  transform: rotateY(180deg);
}

.flip-card-front, .flip-card-back {
  position: absolute;
  width: 100%;
  height: 100%;
  -webkit-backface-visibility: hidden;
  backface-visibility: hidden;
}

.flip-card-front {
  background-color:rgb(250,250,255);
  color: black;
}

.flip-card-back {
  background-color: #2980b9;
  color: white;
  transform: rotateY(180deg);
}
</style>


</head>
<body>

<nav class="navbar navbar-custom navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="field.php" data-toggle="tooltip" title="a.ManageFarm.com">ManageFarm</a>
    </div>

<form class="navbar-form navbar-left" action="">
  <div class="input-group input-custom" data-toggle="tooltip" title="Search for record">
    <input type="text" class="form-control" placeholder="Search ..." id="myInput" disabled="true">  
  </div>
</form>

   <ul class="nav navbar-nav navbar-right">  

<div class="dropdown">

<li class="dropdown-toggle"  data-toggle="dropdown" data-toggle="tooltip" title="Profile"><img src="logo.ico" alt="Avtar" class="avtar"></li>
  <ul class="dropdown-menu">
    <li><a href="profile.php">Profile</a></li>
    <li class="divider"></li>
     <li><a href="logout.php"  style="color:Tomato;" data-toggle="tooltip" title="Log Out"> Log Out</a></li> 
  </ul>
   
</div>
  </div>
<hr>
 
<ul class="nav nav-tabs  nav-justified">
  <li  data-toggle="tooltip" title="Field records"><a href="field.php" style="color:black;">Field</a></li>
  <li  data-toggle="tooltip" title="Equipments records"><a href="equipments.php" style="color:black;">Equipments</a></li>
  <li  data-toggle="tooltip" title="Workers records"><a href="workers.php" style="color:black;">Workers</a></li>
  <li data-toggle="tooltip" title="Income records"><a href="income.php" style="color:black;"><span class="glyphicon glyphicon-usd"></span>Income</a></li>
  <li data-toggle="tooltip" title="Field records"><a href="fertilizer.php" style="color:black;">Fertilizer</a></li>
  <li data-toggle="tooltip" title="Equipments records"><a href="pesticide.php" style="color:black;">Pesticide</a></li>
</ul>

</nav>

<?php

$username = "root";
$password = "";
$database = "farm";
$mysqli = new mysqli("localhost", $username, $password, $database);
$user = $_COOKIE["username"];
$query = 'SELECT * FROM usertable where user = "'.$user.'"';
echo $user;


if ($result = $mysqli->query($query)) {
  while ($row = $result->fetch_assoc()) {
      $fname = $row["fname"];
      $lname = $row["lname"];
       $email = $row["email"];
      $password = $row["password"];
    $password = str_repeat("*",strlen($password));
echo'

<div class="flip-card">
  <div class="flip-card-inner">
    <div class="flip-card-front">
      <h1>ManageFarm</h1>
      <hr>
      <h4> Developed By</h5>
      <h5>aniket.sawant@spit.ac.in</h5>
      <h5>adwait.nyayadhish@spit.ac.in</h5>
      <h2>Database Management System</h2>
    </div>
    <div class="flip-card-back">
      <h1>'.$fname.' '.$lname.'</h1> 
      <p> Email : '.$email.' </p>
      <p> Username : '.$user.' </p> 
      <p>password : '.$password.'</p>
     </div>
  </div>
</div>';
  }
  $result->free();
}
?>





</body>
</html>