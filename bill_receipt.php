 <?php
         if(! isset($_COOKIE["username"]))
           header("location: login-user.php");
session_start();
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
<link rel="stylesheet" href="design.css"/>

<script>

function toogleit(){
if(document.getElementById("delcheck").checked == "false" )
{
document.getElementById("del").disabled = "true";
}
else
{
document.getElementById("del").disabled = "false";
}}
</script>

  <link rel="shortcut icon" type="image/x-icon" href="logo.ico" />
</head>
<body>


<?php
$name = $start = $end = $price = $advance = $extra = $feed = "0";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = test_input($_POST["name"]);
  $start = test_input($_POST["start"]);
  $end = test_input($_POST["end"]);
  $price = test_input($_POST["price"]);
  $advance = test_input($_POST["advance"]);
$extra = test_input($_POST["extra"]);
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>


<nav class="navbar navbar-custom navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand name" href="http://localhost/A%20Capston%20DairyDiary/milk.php" data-toggle="tooltip" title="a.DairyDiary.com"><img src="logo2.png" alt="logo" height="50" width="250"></a>
    </div>

<form class="navbar-form navbar-left" action="">
  <div class="input-group input-custom" data-toggle="tooltip" title="Search for record">
    <input type="text" class="form-control" placeholder="Search ..." id="myInput">  
  </div>
</form>

  <ul class="nav navbar-nav navbar-right">
      <div class="dropdown">

<li class="dropdown-toggle"  data-toggle="dropdown" data-toggle="tooltip" title="Profile"><img src="steve.ico" alt="Avtar" class="avtar"></li>
  <ul class="dropdown-menu">
    <li><a href="#">Profile</a></li>
    <li class="divider"></li>
     <li><a data-toggle="tooltip" title="Log Out" href="http://localhost/A%20Capston%20DairyDiary/logout.php"  style="color:Tomato;"> Log Out</a></li> 
  </ul>
</div>
    </ul>
</div>
  
<hr>

<ul class="nav nav-tabs  nav-justified">	
<li data-toggle="tooltip" title="Milk records"><a href="http://localhost/A%20Capston%20DairyDiary/milk.php"  style="color:black;">Milk</a></li>
  <li  data-toggle="tooltip" title="Feed records"><a href="http://localhost/A%20Capston%20DairyDiary/feed.php"  style="color:black;">Feed</a></li>
  <li  data-toggle="tooltip" title="Notes"><a href="http://localhost/A%20Capston%20DairyDiary/note.php"  style="color:black;">Notes</a></li>
  <li  class="active" data-toggle="tooltip" title="Payment receipts"><a href="http://localhost/A%20Capston%20DairyDiary/Bill.php"  style="color:black;"><span class="glyphicon glyphicon-usd"></span> Bill</a></li>
</ul>

</nav>

<?php
if(isset($_POST["generate"])){

$username = "root";
$password = "";
$database = $_COOKIE['username'];
$mysqli = new mysqli("localhost", $username, $password, $database);

$name = $start = $end = $price = $advance = $extra = $feed = "";
  $name = $_POST["name"];
  $start =$_POST["start"];
  $end = $_POST["end"];
  $price =$_POST["price"];
  $advance = $_POST["advance"];
$extra = $_POST["extra"];




$original_date = "$start";
$timestamp = strtotime($original_date);
$start1 = date("y-m-d", $timestamp);

$original_date = "$end";
$timestamp = strtotime($original_date);
$end1 = date("y-m-d", $timestamp);

$query="SELECT SUM(litter) AS totalsum FROM milkdata WHERE day_date BETWEEN '$start1'AND '$end1'";
$query1="SELECT SUM(t_paid) AS totalsum1 FROM feeddata WHERE day_date BETWEEN '$start1'AND '$end1'";

$result = $mysqli->query($query);
$row = mysqli_fetch_assoc($result);

$result1 = $mysqli->query($query1);
$row1 = mysqli_fetch_assoc($result1);

$sum1=$row1["totalsum1"];
$sum = $row["totalsum"];
$advancemix=$sum1+$advance;
$payment1=$sum*$price;
$payment=$payment1-$advancemix;

echo '
<form style="margin-top:150px; position:relative; left:30%; text-font:courier;">

<div class="card carduse" style="width: 40%;">
  <ul class="list-group list-group-flush">
    <li class="list-group-item"><b><pre>'.$name.'                            '.$start.'  to  '.$end.'</pre></b></li>
    <li class="list-group-item">Price/L : '.$price.'</li>
    <li class="list-group-item">Advance :'.$advance.'</li>
<li class="list-group-item">Feed expenditure:'.$sum1.'</li>
<li class="list-group-item">Total payment :'.$payment1.'</li>
<li class="list-group-item">In hand :'.$payment.'</li>
<li class="list-group-item"><button type="button" id="save" name="save" class="btn btn-success" style="width: 100%;" onclick="save()">Save</button></li>
  </ul>
</div>
</form>';



$username = "root";
$password = "";
$database = $_COOKIE["username"];

$mysqli = new mysqli("localhost", $username, $password, $database);

$query = "INSERT INTO billdata (bill_name,bill_sdate,bill_edate,price,advance,feed_pay,total_pay,last_pay)
          VALUES ('{$name}','{$start1}','{$end1}','{$price}','{$advance}','{$sum1}','{$payment1}','{$payment}')";

$result = $mysqli->query($query);

if(!$result)
{

$_SESSION['billdel'] = "Bill with same name already exist !";


}

if($result)
{

$_SESSION['billinsert'] = "Successfully created !";


}

$mysqli->close();
header('Location: Bill.php');
}


else
{
header('Location: Bill.php');
}

?>




</body>
</html>
