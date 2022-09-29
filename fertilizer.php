<?php
         if(! isset($_COOKIE["username"]))
           header("location:login-user.php");
session_start();
  ?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>
ManageFarm
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
  <link rel="shortcut icon" type="image/x-icon" href="logo.ico" />
</head>
<body>

<nav class="navbar navbar-custom navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="field.php" data-toggle="tooltip" title="a.ManageFarm.com">ManageFarm</a>
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
     <li><a href="logout.php"  style="color:Tomato;" data-toggle="tooltip" title="Log Out"> Log Out</a></li> 
  </ul>
   
</div>
  </div>
<hr>
 
<ul class="nav nav-tabs  nav-justified">
  <li data-toggle="tooltip" title="Field records"><a href="field.php" style="color:black;">Field</a></li>
  <li  data-toggle="tooltip" title="Equipments records"><a href="equipments.php" style="color:black;">Equipments</a></li>
  <li  data-toggle="tooltip" title="Workers records"><a href="workers.php" style="color:black;">Workers</a></li>
  <li data-toggle="tooltip" title="Income records"><a href="income.php" style="color:black;"><span class="glyphicon glyphicon-usd"></span>Income</a></li>
  <li class="active"  data-toggle="tooltip" title="Fertilizer records"><a href="fertilizer.php" style="color:black;">Fertilizer</a></li>
  <li data-toggle="tooltip" title="Pesticide records"><a href="pesticide.php" style="color:black;">Pesticide</a></li>
</ul>

</nav>

<form method='post' action='fertdel.php'>
<div class="container" style="margin-top:150px">
<div>
<table class="table table-bordered table-striped table-hover" style="width:60%;">
<thead data-toggle="tooltip" title="fertilizer records">
<tr>
        <th> Field ID </th>
        <th> Fertilizer Name</th>
        <th> Total Cost</th>
        <th> Date</th>
      
</tr>
</thead>
<tbody id="myTable">

<?php
$username = "root";
$password = "";
$database = "farm";
$user = $_COOKIE['username'];
$mysqli = new mysqli("localhost", $username, $password, $database);
$query = "SELECT * FROM fert_used where f_id in(select f_id from field where user='$user') order by date_used DESC";

if ($result = $mysqli->query($query)) {
  while ($row = $result->fetch_assoc()) {
      
      $temp = $row["F_ID"];
      $query1 = "SELECT * FROM field where f_id = $temp";
      $result1 = $mysqli->query($query1);
      $row1 = $result1->fetch_assoc();
      $area = $row1["TOTAL_AREA"];
      $field1name = $row1["farm_no"];
      $field2name = $row["FERT_NAME"];

      $query1 = "SELECT PRICE FROM fertilizer where fert_name = '$field2name'";
      $result1 = $mysqli->query($query1);
      $row1 = $result1->fetch_assoc();

      $field3name = $row1["PRICE"]* $area;
      $field4name = $row["DATE_USED"];
?>
<tr id="tr_<?= $field1name ?>">

        <td><?= $field1name ?></td>
        <td><?= $field2name ?></td>
        <td><?= $field3name ?></td>
        <td><?= $field4name ?></td>
        <!-- <td><input type='checkbox' name='delete[]' value='<?= $field1name ?>' style="cursor:pointer;" ></td> -->
 
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
<a href="#myModal" class="float-add" data-toggle="modal"><button name="add" id="add" class="btn btn-success btn-rounded my-float float-add" data-toggle="tooltip" title="Add record"><span class="glyphicon glyphicon-plus"></span> Add</button></a>

<!-- <a href="#" class="float-del"><button  data-toggle="tooltip" title="Delete selected record"  type="submit" name="but_delete" id="del" class="btn btn-danger btn-rounded my-float float-del"><span class="glyphicon glyphicon-trash"></span> Delete</button></a> -->

</div>
</form>

<form method="post" action="fertinsert.php">
<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add new record</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">

  <div class="form-group">
    <label for="fnoinput">Field ID</label>
    <select name="field1" class="form-control" data-toggle="tooltip" title="Select Field ID" required>
    <?php

    $query = "SELECT * FROM field where user = '$user'";
    if ($result = $mysqli->query($query)) {
    while ($row = $result->fetch_assoc()) {
        $field4name = $row["farm_no"];
        $crop = $row["CROP"];
    ?>
        <option value='<?= $field4name ?>'><?= $field4name ?> - <?= $crop ?></option>
        <?php
        }
    $result->free();
    }
        ?>

        
    </select>
  </div>

  <div class="form-group">
    <label for="cropname">Fertilizer Name</label>
    <select name="field2" class="form-control" data-toggle="tooltip" title="Select fertilizer Name" required>
    <?php

    $query = "SELECT * FROM fertilizer";
    if ($result = $mysqli->query($query)) {
    while ($row = $result->fetch_assoc()) {
        $field4name = $row["FERT_NAME"];
    ?>
        <option value='<?= $field4name ?>'><?= $field4name ?></option>
        <?php
        }
    $result->free();
    }
        ?>

        
    </select>
  </div>

  <div class="form-group">
    <label for="sowdate">Date</label>
    <input type="date" class="form-control" id="sowdate" name="field3" data-toggle="tooltip" title="Select date" required>
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
if(isset($_SESSION['fertdel'])){
echo'
<div id="snackbar" style="
  background-color: rgb(211,211,211);
  color: red;"><span class="glyphicon glyphicon-warning-sign"></span>'.$_SESSION["fertdel"].'</div>
<script>

  var x = document.getElementById("snackbar");
  x.className = "show";
  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);

</script>
';
session_unset();
}

if(isset($_SESSION['fertinsert'])){
echo'
<div id="snackbar" style="
  background-color: rgb(211,211,211);
  color: green;"><span class="glyphicon glyphicon-ok "></span>'.$_SESSION["fertinsert"].'</div>
<script>

  var x = document.getElementById("snackbar");
  x.className = "show";
  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);

</script>
';
session_unset();
}

if(isset($_SESSION['fertdelete'])){
echo'
<div id="snackbar" style="
  background-color: rgb(211,211,211);
  color: green;"><span class="glyphicon glyphicon-ok "></span>'.$_SESSION["fertdelete"].'</div>
<script>

  var x = document.getElementById("snackbar");
  x.className = "show";
  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);

</script>
';
session_unset();
}

if(isset($_SESSION['fertdelete1'])){
echo'
<div id="snackbar" style="
  background-color: rgb(211,211,211);
  color: red;"><span class="glyphicon glyphicon-warning-sign"></span>'.$_SESSION["fertdelete1"].'</div>
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