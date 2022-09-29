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
  <li class="active"  data-toggle="tooltip" title="Equipments records"><a href="equipments.php" style="color:black;">Equipments</a></li>
  <li  data-toggle="tooltip" title="Workers records"><a href="workers.php" style="color:black;">Workers</a></li>
  <li data-toggle="tooltip" title="Income records"><a href="income.php" style="color:black;"><span class="glyphicon glyphicon-usd"></span>Income</a></li>
  <li data-toggle="tooltip" title="Field records"><a href="fertilizer.php" style="color:black;">Fertilizer</a></li>
  <li data-toggle="tooltip" title="Equipments records"><a href="pesticide.php" style="color:black;">Pesticide</a></li>
</ul>

</nav>

<form method='post' action='equipdel.php'>
<div class="container" style="margin-top:150px">
<div>
<table class="table table-bordered table-striped table-hover" id = "myTable" style="width:60%;">
<thead data-toggle="tooltip" title="Equipments records">
<tr>
        <th> Equipment ID </th>
        <th> Name</th>
        <th> Price</th>
        <th> Maintenance Period</th>
        <th> Available </th>
        <th> delete </th>
</tr>
</thead>
<tbody id="myTable">

<?php
$username = "root";
$password = "";
$database = "farm";
$user = $_COOKIE['username'];
$mysqli = new mysqli("localhost", $username, $password, $database);
$query = "SELECT * FROM equipments where user = '$user' order by e_id";

if ($result = $mysqli->query($query)) {
  while ($row = $result->fetch_assoc()) {
      $field1name = $row["e_no"];
      $field2name = $row["E_NAME"];
      $field3name = $row["PRICE"];
      $field4name = $row["M_PERIOD"];
      $field5name = $row["AVAILABLE"];
     
?>
<tr id="tr_<?= $field1name ?>">

        <td><?= $field1name ?></td>
        <td><?= $field2name ?></td>
        <td><?= $field3name ?></td>
        <td><?= $field4name ?></td>
        <td><?= $field5name ?></td>
        <td><input type='checkbox' name='delete[]' value='<?= $field1name ?>' style="cursor:pointer;" ></td>
        <td><a href="#myModal1" data-toggle="modal"><input type='button' class="btn btn-rounded btnSelect" id='equipassign' value='Assign' style="cursor:pointer;" ></a></td>
    
 
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

<a href="#" class="float-del"><button  data-toggle="tooltip" title="Delete selected record"  type="submit" name="but_delete" id="del" class="btn btn-danger btn-rounded my-float float-del"><span class="glyphicon glyphicon-trash"></span> Delete</button></a>

</div>
</form>

<form method="post" action="equipinsert.php">
<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add new record</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">

    <div class="form-group">
    <label for="fnoinput">Equipment ID</label>
    <input type="number" class="form-control" id="fnoinput" name="field1" data-toggle="tooltip" title="Give unique no to your equipment" min="0" required>
  </div>
  <div class="form-group">
    <label for="cropname">Equipment Name</label>
    <input type="text" class="form-control" id="cropname" name="field2" placeholder="e.g. Sprayer/Tracter" data-toggle="tooltip" title="Equipment Name"  required>
  </div>

  <div class="form-group">
    <label for="sowdate">Price</label>
    <input type="number" class="form-control" id="sowdate" name="field3" data-toggle="tooltip" title="Enter Price" min = '0' required>
  </div>
  <div class="form-group">
    <label for="tarea">Maintenance Period</label>
    <input type="number" class="form-control" id="tarea" name="field4" placeholder="Period" data-toggle="tooltip" title="Maintenance Gap" min="0" required>
  </div>
  
  <div class="form-group">
    <label for="igap">Available</label>
    <input type="number" class="form-control" id="igap" name="field5" data-toggle="tooltip" title="Total Available of this type" min="0" required>
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
if(isset($_SESSION['equipdel'])){
echo'
<div id="snackbar" style="
  background-color: rgb(211,211,211);
  color: red;"><span class="glyphicon glyphicon-warning-sign"></span>'.$_SESSION["equipdel"].'</div>
<script>

  var x = document.getElementById("snackbar");
  x.className = "show";
  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);

</script>
';
session_unset();
}

if(isset($_SESSION['equipinsert'])){
echo'
<div id="snackbar" style="
  background-color: rgb(211,211,211);
  color: green;"><span class="glyphicon glyphicon-ok "></span>'.$_SESSION["equipinsert"].'</div>
<script>

  var x = document.getElementById("snackbar");
  x.className = "show";
  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);

</script>
';
session_unset();
}

if(isset($_SESSION['equipdelete'])){
echo'
<div id="snackbar" style="
  background-color: rgb(211,211,211);
  color: green;"><span class="glyphicon glyphicon-ok "></span>'.$_SESSION["equipdelete"].'</div>
<script>

  var x = document.getElementById("snackbar");
  x.className = "show";
  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);

</script>
';
session_unset();
}

if(isset($_SESSION['equipdelete1'])){
echo'
<div id="snackbar" style="
  background-color: rgb(211,211,211);
  color: red;"><span class="glyphicon glyphicon-warning-sign"></span>'.$_SESSION["equipdelete1"].'</div>
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


<form method="post" action="equipassign.php">
<div id="myModal1" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add new record</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">

    <div class="form-group">
    <label for="fnoinput">Equipment ID</label>
    <input type="number" class="form-control" id="fnoinput1" name="field1" data-toggle="tooltip" title="Choose equipment ID" min="0" required>
  </div>
  
  <div class="form-group">
    <label for="wid">ID of a Worker</label>
    <select name="field2" class="form-control" id ="wid" data-toggle="tooltip" title="Select Worker ID" required>
    <?php

    $query = "SELECT * FROM workers where user = '$user'";
    if ($result = $mysqli->query($query)) {
    while ($row = $result->fetch_assoc()) {
        $field4name = $row["w_no"];
        $wiid = $row["w_id"];
        $name = $row["F_NAME"];
        $lname = $row["L_NAME"];
    ?>
        <option value='<?= $wiid ?>'><?= $field4name ?> - <?= $name ?> <?= $lname ?></option>
        <?php
        }
    $result->free();
    }
        ?>

        
    </select>
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

if(isset($_SESSION['equipa'])){
echo'
<div id="snackbar" style="
  background-color: rgb(211,211,211);
  color: green;"><span class="glyphicon glyphicon-ok "></span>'.$_SESSION["equipa"].'</div>
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


$(document).ready(function(){

$("#myTable").on('click','.btnSelect',function(){
     var currentRow=$(this).closest("tr"); 
     var col1=currentRow.find("td:eq(0)").text(); 
     $("#fnoinput1").val(col1);
    //  alert(data);
});
});

</script>





</body>
</html>