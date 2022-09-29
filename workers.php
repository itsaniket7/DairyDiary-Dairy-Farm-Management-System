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
  <li  data-toggle="tooltip" title="Field records"><a href="field.php" style="color:black;">Field</a></li>
  <li  data-toggle="tooltip" title="Equipments records"><a href="equipments.php" style="color:black;">Equipments</a></li>
  <li  class="active" data-toggle="tooltip" title="Workers records"><a href="workers.php" style="color:black;">Workers</a></li>
  <li data-toggle="tooltip" title="Income records"><a href="income.php" style="color:black;"><span class="glyphicon glyphicon-usd"></span>Income</a></li>
  <li data-toggle="tooltip" title="Field records"><a href="fertilizer.php" style="color:black;">Fertilizer</a></li>
  <li data-toggle="tooltip" title="Equipments records"><a href="pesticide.php" style="color:black;">Pesticide</a></li>
</ul>

</nav>

<form method='post' action='workdel.php'>
<div class="container" style="margin-top:150px">
<div>
<table id = "mytable" class="table table-bordered table-striped table-hover" style="width:83%; left: 100px;">
<thead data-toggle="tooltip" title="workers records">
<tr>
        <th> Worker ID </th>
        <th> First Name</th>
        <th> Last Name</th>
        <th> No of days</th>
        <th> Daily Wages</th>
        <th> No of equipments Assigned</th>
        <th> Equipments</th>
        <th> Delete</th>
        <th> Change to paid</th>
        <!-- <th> Update </th> -->
</tr>
</thead>
<tbody id="myTable">

<?php
$username = "root";
$password = "";
$database = "farm";
$user = $_COOKIE['username'];
$mysqli = new mysqli("localhost", $username, $password, $database);
$query = "select * from workers where user = '$user'";

if ($result = $mysqli->query($query)) {
  while ($row = $result->fetch_assoc()) {
      $field1name = $row["w_no"];
      $field2name = $row["F_NAME"];
      $field3name = $row["L_NAME"];
      $field4name = $row["NO_OF_DAYS"];
      $field5name = $row["DAILY_WAGES"];
      $field6name = $row["E_ASSIGNED"];
?>
<tr id="tr_<?= $field1name ?>">

        <td><?= $field1name ?></td>
        <td><?= $field2name ?></td>
        <td><?= $field3name ?></td>
        <td><?= $field4name ?></td>
        <td><?= $field5name ?></td>
        <td><?= $field6name ?></td>
        <td>
        <?php

        $query3 = "select * from workers where user = '$user' and w_no = $field1name";
        $result3 = $mysqli->query($query3);
        $row3 = $result3->fetch_assoc();

        $wid = $row3["w_id"];

        $query1 = "select e_name from (equipments inner join equip_assign on equipments.e_id = equip_assign.e_id) where w_id = $wid and user='$user';";

        if ($result1 = $mysqli->query($query1)) {
          while ($row1 = $result1->fetch_assoc()) {
              $field7name = $row1["e_name"];
              echo $field7name.", ";
          }
        }
      ?>
        </td>
        <td><input type='checkbox' name='delete[]' value='<?= $field1name ?>' style="cursor:pointer;" ></td>
        <form action="worker_paid.php" method="post">
        <td><input type='submit' name='update[]' value='<?= $field1name ?>' style="cursor:pointer;" ></td>
        </form>
        <td><a href="#myModal1" data-toggle="modal"><input type='button' class="btn btn-rounded btnSelect" id='workupdate' value='Update' style="cursor:pointer;" ></a></td>
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

<form method="post" action="workinsert.php">
<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add new record</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">

    <div class="form-group">
    <label for="fnoinput">Worker ID</label>
    <input type="number" class="form-control" id="fnoinput" name="field1" data-toggle="tooltip" title="Give unique no to worker" required>
  </div>
  <div class="form-group">
    <label for="cropname">Worker First Name</label>
    <input type="text" class="form-control" id="cropname" name="field2" placeholder="e.g. Ram" data-toggle="tooltip" title="First Name"  required>
  </div>

  <div class="form-group">
    <label for="sowdate">Worker Last Name</label>
    <input type="text" class="form-control" id="sowdate" name="field3" data-toggle="tooltip" title="Last Name" required>
  </div>
  <div class="form-group">
    <label for="tarea">No of days on field</label>
    <input type="number" class="form-control" id="tarea" name="field4" placeholder="e.g. 20" data-toggle="tooltip" title="Days on field" min="0" required>
  </div>
  
  <div class="form-group">
    <label for="igap">Daily Wages</label>
    <input type="number" class="form-control" id="igap" name="field5" data-toggle="tooltip" title="Daily wages" min="0" required>
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
if(isset($_SESSION['workdel'])){
echo'
<div id="snackbar" style="
  background-color: rgb(211,211,211);
  color: red;"><span class="glyphicon glyphicon-warning-sign"></span>'.$_SESSION["workdel"].'</div>
<script>

  var x = document.getElementById("snackbar");
  x.className = "show";
  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);

</script>
';
session_unset();
}

if(isset($_SESSION['workinsert'])){
echo'
<div id="snackbar" style="
  background-color: rgb(211,211,211);
  color: green;"><span class="glyphicon glyphicon-ok "></span>'.$_SESSION["workinsert"].'</div>
<script>

  var x = document.getElementById("snackbar");
  x.className = "show";
  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);

</script>
';
session_unset();
}

if(isset($_SESSION['workdelete'])){
echo'
<div id="snackbar" style="
  background-color: rgb(211,211,211);
  color: green;"><span class="glyphicon glyphicon-ok "></span>'.$_SESSION["workdelete"].'</div>
<script>

  var x = document.getElementById("snackbar");
  x.className = "show";
  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);

</script>
';
session_unset();
}

if(isset($_SESSION['workdelete1'])){
echo'
<div id="snackbar" style="
  background-color: rgb(211,211,211);
  color: red;"><span class="glyphicon glyphicon-warning-sign"></span>'.$_SESSION["workdelete1"].'</div>
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





<form method="post" action="workupdate.php">
<div id="myModal1" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update record</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
            
    <div class="form-group">
    <input type="hidden" class="form-control" id="fnoinput1" name="field1" data-toggle="tooltip" title="Give unique no to worker" required>
  </div>
  <div class="form-group">
    <label for="cropname">Worker First Name</label>
    <input type="text" class="form-control" id="cropname1" name="field2" placeholder="e.g. Ram" data-toggle="tooltip" title="First Name"  required>
  </div>

  <div class="form-group">
    <label for="sowdate">Worker Last Name</label>
    <input type="text" class="form-control" id="sowdate1" name="field3" data-toggle="tooltip" title="Last Name" required>
  </div>
  <div class="form-group">
    <label for="tarea">No of days on field</label>
    <input type="number" class="form-control" id="tarea1" name="field4" placeholder="e.g. 20" data-toggle="tooltip" title="Days on field" min="0" required>
  </div>
  
  <div class="form-group">
    <label for="igap">Daily Wages</label>
    <input type="number" class="form-control" id="igap1" name="field5" data-toggle="tooltip" title="Daily wages" min="0" required>
  </div>


            </div>
            <div class="modal-footer">
                 <button data-toggle="tooltip" title="Cancel" type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" data-toggle="tooltip" title="Add record" class="btn btn-primary">Update</button>
            </div>
        </div>
    </div>
</div>
<?php

if(isset($_SESSION['workupdate'])){
echo'
<div id="snackbar" style="
  background-color: rgb(211,211,211);
  color: green;"><span class="glyphicon glyphicon-ok "></span>'.$_SESSION["workupdate"].'</div>
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
     var col2=currentRow.find("td:eq(1)").text(); 
     var col3=currentRow.find("td:eq(2)").text(); 
     var col4=currentRow.find("td:eq(3)").text(); 
     var col5=currentRow.find("td:eq(4)").text(); 
     var col6=currentRow.find("td:eq(5)").text(); 
    //  var data=col1+"\n"+col2+"\n"+col3;
     
     $("#fnoinput1").val(col1);
     $("#cropname1").val(col2);
     $("#sowdate1").val(col3);
     $("#tarea1").val(col4);
     $("#igap1").val(col5);
    //  alert(data);
});
});
</script>





</body>
</html>