 <?php
session_start();
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


<nav class="navbar navbar-custom navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand name" href="http://localhost/A%20Capston%20DairyDiary/milk.php" data-toggle="tooltip" title="a.DairyDiary.com"><img src="logo2.png" alt="logo" height="50px" width="200px"></a>
    </div>

<form class="navbar-form navbar-left" action="">
  <div class="input-group input-custom" data-toggle="tooltip" title="Search for record">
    <input type="text" class="form-control" placeholder="Search ..." id="myInput">  
  </div>
</form>

  <ul class="nav navbar-nav navbar-right">
      <div class="dropdown">

<li class="dropdown-toggle"  data-toggle="dropdown" data-toggle="tooltip" title="Profile"><img src="logo.ico" alt="Avtar" class="avtar"></li>
  <ul class="dropdown-menu">
    <li><a href="profile.php">Profile</a></li>
    <li class="divider"></li>
     <li><a data-toggle="tooltip" title="Log Out" href="http:logout.php"  style="color:Tomato;"> Log Out</a></li> 
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

<form method='post' action='billdel.php'>
<div class="container" style="margin-top:150px">
<div >

<?php
$username = "root";
$password = "";
$database =$_COOKIE['username'];
$mysqli = new mysqli("localhost", $username, $password, $database);
$query = "SELECT * FROM billdata";

if ($result = $mysqli->query($query)) {
  while ($row = $result->fetch_assoc()) {
      $billname = $row["bill_name"];
      $start = $row["bill_sdate"];
       $end = $row["bill_edate"];
      $price = $row["price"];
      $advance = $row["advance"];
     $feed_pay = $row["feed_pay"];
      $total_pay = $row["total_pay"];
    $last_pay = $row["last_pay"];

echo'

<div  class="card carduse" style="width: 60%; margin-top:1%; position:relative; left:20%; text-font:courier;" data-toggle="tooltip" title="'.$billname.'  |  '.$start .'  to  '. $end.' |  '. $price.'  |  '. $advance.' |  '. $feed_pay .'  |  '. $total_pay.' |  '.$last_pay.'" onclick="select()">
  <ul class="list-group list-group-flush">
    <li class="list-group-item"><b><pre>'.$billname.'                                           '.$start.'  to  '.$end.'   <input  style="cursor:pointer;" type="checkbox" id="delcheck" name="delete[]" value="'.$billname.'" onclick="toggleit()"></pre></b></li>
    <li class="list-group-item">Price/L : '.$price.'</li>
    <li class="list-group-item">Advance :'.$advance.'</li>
<li class="list-group-item">Feed expenditure:'.$feed_pay.'</li>
<li class="list-group-item">Total payment :'.$total_pay.'</li>
<li class="list-group-item">In hand :'.$last_pay.'</li>
<!-- <li class="list-group-item"><button type="button" id="save" name="save" class="btn btn-success" style="width: 100%;">Save</button></li> -->
  </ul>
</div>';


?>
   
    <?php
     }
  $result->free();
}
    ?>

</tbody>
</table>
</div>
<div class="btn">
<a href="#myModal" class="float-add" data-toggle="modal"><button data-toggle="tooltip" title="Add record" name="add" id="add" class="btn btn-success btn-rounded my-float float-add"><span class="glyphicon glyphicon-plus"></span> Generate</button></a>

<a href="#" class="float-del"><button  data-toggle="tooltip" title="Delete selected record"  type="submit" name="but_delete" id="del" class="btn btn-danger btn-rounded my-float float-del"><span class="glyphicon glyphicon-trash"></span> Delete</button></a>

</div>
</form>

<form method="post" action="bill_receipt.php">
<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Generate Bill</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">

 <div class="form-group">
    <label for="billname">Name</label>
    <input type="text" class="form-control" id="billname" name="name" placeholder="Enter receipt name" data-toggle="tooltip" title="Enter receipt name" required>
  </div>

   <div class="form-group">
    <label for="dateinput">From date</label>
    <input type="date" class="form-control" id="dateinput" name="start" data-toggle="tooltip" title="Select from which date you want to calculate" required>
  </div>

   <div class="form-group">
    <label for="dateinput">To date</label>
    <input type="date" class="form-control" id="dateinput" name="end" data-toggle="tooltip" title="Select upto which date you want to calculate" required>
  </div>

  <div class="form-group">
    <label for="price">Price\L</label>
    <input type="number" class="form-control" id="price" name="price" placeholder="Enter current price per litter" data-toggle="tooltip" title="Enter current price per litter" min="0" required>
  </div>

  <div class="form-group">
    <label for="Cash">Advanced taken cash</label>
    <input data-toggle="tooltip" title="Enter cash taken in advance from dairymen" type="number" class="form-control" id="Cash" name="advance" placeholder="Enter cash taken in advance from dairymen" " min="0" required>
  </div>

<!-- <div class="form-group">
    <label for="extracash">Extra bill to minus (if any)</label>
    <input data-toggle="tooltip" title="Enter extra money you want to minus if any" type="number" class="form-control" id="Cash" name="extra" placeholder="Enter extra money you want to minus if any" " min="0" default=0>
  </div> -->


            </div>
            <div class="modal-footer">
<button type="submit" data-toggle="tooltip" title="Add record" name="generate" class="form-control btn btn-primary">Generate</button>
            </div>
        </div>
    </div>
</div>
<?php
if(isset($_SESSION['billdel'])){
echo'
<div id="snackbar" style="
  background-color: rgb(211,211,211);
  color: red;"><span class="glyphicon glyphicon-warning-sign"></span>'.$_SESSION["billdel"].'</div>
<script>

  var x = document.getElementById("snackbar");
  x.className = "show";
  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);

</script>
';
session_unset();
}

if(isset($_SESSION['billinsert'])){
echo'
<div id="snackbar" style="
  background-color: rgb(211,211,211);
  color: green;"><span class="glyphicon glyphicon-ok "></span>'.$_SESSION["billinsert"].'</div>
<script>

  var x = document.getElementById("snackbar");
  x.className = "show";
  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);

</script>
';
session_unset();
}

if(isset($_SESSION['billdelete'])){
echo'
<div id="snackbar" style="
  background-color: rgb(211,211,211);
  color: green;"><span class="glyphicon glyphicon-ok "></span>'.$_SESSION["billdelete"].'</div>
<script>

  var x = document.getElementById("snackbar");
  x.className = "show";
  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);

</script>
';
session_unset();
}

if(isset($_SESSION['billdelete1'])){
echo'
<div id="snackbar" style="
  background-color: rgb(211,211,211);
  color: red;"><span class="glyphicon glyphicon-warning-sign"></span>'.$_SESSION["billdelete1"].'</div>
<script>

  var x = document.getElementById("snackbar");
  x.className = "show";
  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);

</script>
';
session_unset();
}

?>

</form>

<script>
$(document).ready(function(){
  $('#myInput').on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $(".card").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>

<script>
/*function select()
{
if(document.getElementById("delcheck").checked="false"){
document.getElementById("delcheck").checked = "true";
}
if(document.getElementById("delcheck").checked="true"){
{
document.getElementById("delcheck").checked = "false";
}
}*/
</script>



</body>
</html>