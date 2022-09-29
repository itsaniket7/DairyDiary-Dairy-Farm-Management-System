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
<nav class="navbar navbar-custom navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="http://localhost/A%20Capston%20DairyDiary/milk.php" data-toggle="tooltip" title="a.DairyDiary.com"><img src="logo2.png" alt="logo" height="50px" width="200px"></a>
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
     <li><a data-toggle="tooltip" title="Log Out" href="http://localhost/A%20Capston%20DairyDiary/logout.php"  style="color:Tomato;"> Log Out</a></li> 
  </ul>
</div>
    </ul>
</div>
  
<hr>

<ul class="nav nav-tabs  nav-justified">
<li data-toggle="tooltip" title="Milk records"><a href="http://localhost/A%20Capston%20DairyDiary/milk.php" style="color:black;">Milk</a></li>
  <li  class="active" data-toggle="tooltip" title="Feed records"><a href="http://localhost/A%20Capston%20DairyDiary/feed.php" style="color:black;">Feed</a></li>
  <li  data-toggle="tooltip" title="Notes"><a href="http://localhost/A%20Capston%20DairyDiary/note.php" style="color:black;">Notes</a></li>
  <li data-toggle="tooltip" title="Payment receipts"><a href="http://localhost/A%20Capston%20DairyDiary/Bill.php" style="color:black;"><span class="glyphicon glyphicon-usd"></span> Bill</a></li>
</ul>

</nav>

<form method='post' action='feeddel.php'>
<div class="container" style="margin-top:150px">
<div >
<table class="table table-bordered table-striped table-hover" style="width:60%;">
<thead data-toggle="tooltip" title="Milk records">
<tr>
        <th> Date </th>
        <th> Feed Name</th>
        <th> Quantity </th>
        <th>Feed price </th>
  <th>Total paid</th>
         <th>Delete </th>
</tr>
</thead>
<tbody id="myTable">

<?php
$username = "root";
$password = "";
$database =$_COOKIE['username'];
$mysqli = new mysqli("localhost", $username, $password, $database);
$query = "SELECT * FROM feeddata";

if ($result = $mysqli->query($query)) {
  while ($row = $result->fetch_assoc()) {
      $field1name = $row["day_date"];
      $field2name = $row["feed_name"];
      $field3name = $row["quantity"];
      $field4name = $row["price"];
      $field5name = $row["t_paid"];
?>

     <tr id="tr_<?= $field1name ?>" data-toggle="tooltip" title="<?= $field1name ?>  |  <?= $field2name ?>  |  <?= $field3name ?>  |  <?= $field4name ?>">

        <td><?= $field1name ?></td>
        <td><?= $field2name ?></td>
        <td><?= $field3name ?></td>
        <td><?= $field4name ?></td>
<td><?= $field5name ?></td>

        <!-- Checkbox -->
        <td><input  style="cursor:pointer;" type='checkbox' id="delcheck" name='delete[]' value='<?= $field1name ?>' onclick="toggleit()"></td>
 
    </tr>
    <?php
     }
  $result->free();
}
    ?>

</tbody>
</table>
</div>
<div class="btn">
<a href="#myModal" class="float-add" data-toggle="modal"><button data-toggle="tooltip" title="Add record" name="add" id="add" class="btn btn-success btn-rounded my-float float-add"><span class="glyphicon glyphicon-plus"></span> Add</button></a>

<a href="#" class="float-del"><button  data-toggle="tooltip" title="Delete selected record"  type="submit" name="but_delete" id="del" class="btn btn-danger btn-rounded my-float float-del"><span class="glyphicon glyphicon-trash"></span> Delete</button></a>

</div>
</form>

<form method="post" action="feedinsert.php">
<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add new record</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
   <div class="form-group">
    <label for="dateinput">Date</label>
    <input type="date" class="form-control" id="dateinput" name="field1" data-toggle="tooltip" title="Select date" required>
  </div>
  <div class="form-group">
    <label for="feedname">Feed name</label>
    <input type="text" class="form-control" id="feedname" name="field2" placeholder="Enter feed name" data-toggle="tooltip" title="Enter feed name" required>
  </div>
  <div class="form-group">
    <label for="quantity">Quantity</label>
    <input data-toggle="tooltip" title="Enter quantity" type="number" class="form-control" id="quantity" name="field3" placeholder="Enter quantity e.g. 5" min="0" required>
  </div>
  <div class="form-group">
    <label for="price">Feed price</label>
    <input type="number" data-toggle="tooltip" title="Enter price/pack" class="form-control" id="price" name="field4" placeholder="Enter price/pack" min="0" required>
  </div>

            </div>
            <div class="modal-footer">
                <button data-toggle="tooltip" title="Cancel" type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" data-toggle="tooltip" title="Add record" class="btn btn-primary">Add</button>
            </div>
        </div>
    </div>
</div>

<?php
if(isset($_SESSION['feeddel'])){
echo'
<div id="snackbar" style="
  background-color: rgb(211,211,211);
  color: red;"><span class="glyphicon glyphicon-warning-sign"></span>'.$_SESSION["feeddel"].'</div>
<script>

  var x = document.getElementById("snackbar");
  x.className = "show";
  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);

</script>
';
session_unset();
}

if(isset($_SESSION['feedinsert'])){
echo'
<div id="snackbar" style="
  background-color: rgb(211,211,211);
  color: green;"><span class="glyphicon glyphicon-ok "></span>'.$_SESSION["feedinsert"].'</div>
<script>

  var x = document.getElementById("snackbar");
  x.className = "show";
  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);

</script>
';
session_unset();
}


if(isset($_SESSION['feeddelete'])){
echo'
<div id="snackbar" style="
  background-color: rgb(211,211,211);
  color: green;"><span class="glyphicon glyphicon-ok "></span>'.$_SESSION["feeddelete"].'</div>
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
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>


</body>
</html>