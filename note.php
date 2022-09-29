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
<link rel="stylesheet" href="design.css"/>
  <link rel="shortcut icon" type="image/x-icon" href="logo.ico" />
</head>
<body>
<nav class="navbar navbar-custom navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
    <a class="navbar-brand" href="http://localhost/A%20Capston%20DairyDiary/milk.php" data-toggle="tooltip" title="a.DairyDiary.com"><img src="logo2.png" alt="logo" height="50px" width="200px"></a>
    </div>

<form class="navbar-form navbar-left" action="">
  <div class="input-group input-custom">
    <input type="text" class="form-control" placeholder="Search ..." id="myInput" data-toggle="tooltip" title="Search for records">  
  </div>
</form>

   <ul class="nav navbar-nav navbar-right">  

<div class="dropdown">

<li class="dropdown-toggle"  data-toggle="dropdown" data-toggle="tooltip" title="Profile"><img src="logo.ico" alt="Avtar" class="avtar"></li>
  <ul class="dropdown-menu">
    <li><a href="profile.php">Profile</a></li>
    <li class="divider"></li>
     <li data-toggle="tooltip" title="Logout"><a href="http://localhost/A%20Capston%20DairyDiary/logout.php"  style="color:Tomato;"> Log Out</a></li> 
  </ul>
   
</div>
  </div>

<hr>


<ul class="nav nav-tabs  nav-justified">
  <li data-toggle="tooltip" title="Milk records"><a href="http://localhost/A%20Capston%20DairyDiary/milk.php" style="color:black;">Milk</a></li>
  <li data-toggle="tooltip" title="Feed records"><a href="http://localhost/A%20Capston%20DairyDiary/feed.php" style="color:black;">Feed</a></li>
  <li  class="active" data-toggle="tooltip" title="Notes"><a href="http://localhost/A%20Capston%20DairyDiary/note.php" style="color:black;"></span>Notes</a></li>
  <li data-toggle="tooltip" title="Payment receipts"><a href="http://localhost/A%20Capston%20DairyDiary/Bill.php" style="color:black;"><span class="glyphicon glyphicon-usd"></span> Bill</a></li>
</ul>
</nav>


<form method='post' action='notedel.php'>
<div class="container" style="margin-top:150px">
<div>

<div  id="myTable">

<?php
session_start();
$username = "root";
$password = "";
$database =$_COOKIE['username'];
$mysqli = new mysqli("localhost", $username, $password, $database);
$query = "SELECT * FROM notedata";

if ($result = $mysqli->query($query)) {
  while ($row = $result->fetch_assoc()) {
      $field1name = $row["day_date"];
      $field2name = $row["note_name"];
       $field3name = $row["note_body"];
?>



<div  class="card carduse" style="width: 60%; margin-top:1%; position:relative; left:20%; text-font:courier;" >
  <ul class="list-group list-group-flush">
    <li class="list-group-item"><b><pre><?= $field2name ?>                                                               <?= $field1name ?>   <input  style="cursor:pointer;"   type="checkbox" id="delcheck" name="delete[]" value="<?= $field2name ?>"></pre></b></li>
    <li class="list-group-item" style="min-height:200px"><?= $field3name ?></li>

  </ul>
</div>
</form>
<br><br>

    <?php
     }
  $result->free();
}

    ?>




</div>

</div>
<div class="btn">
<a href="#myModal" class="float-add" data-toggle="modal"><button name="add" id="add" data-toggle="tooltip" title="Create Note" class="btn btn-success btn-rounded my-float float-add"><span class="glyphicon glyphicon-plus"></span> Create</button></a>

<a href="#" class="float-del"><button type="submit" name="but_delete" id="del" class="btn btn-danger btn-rounded my-float float-del" data-toggle="tooltip" title="Delete selected notes"><span class="glyphicon glyphicon-trash"></span> Delete</button></a>

</div>
</form>


<form method="post" action="noteinsert.php">
<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Note</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
    <div class="form-group">
    <label for="dateinput">Date</label>
    <input type="date" class="form-control" id="dateinput" name="field1" data-toggle="tooltip" title="Select date" required>
  </div>
  <div class="form-group">
    <label for="notename">Note name</label>
    <input type="text" class="form-control" id="notename" name="field2" placeholder="Enter note name" data-toggle="tooltip" title="Enter note name" required>
  </div>
   <div class="form-group">
    <label for="notebody">Note</label>
    <textarea class="form-control" id="notebody" name="field3" rows="3" data-toggle="tooltip" title="Enter note" required></textarea>
  </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" data-toggle="tooltip" title="Cancel">Cancel</button>
                <button type="submit" class="btn btn-primary" data-toggle="tooltip" title="Save note">Save</button>
            </div>
        </div>
    </div>
</div>
<?php
if(isset($_SESSION['notedel'])){
echo'
<div id="snackbar" style="
  background-color: rgb(211,211,211);
  color: red;"><span class="glyphicon glyphicon-warning-sign"></span>'.$_SESSION["notedel"].'</div>
<script>

  var x = document.getElementById("snackbar");
  x.className = "show";
  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);

</script>
';
session_unset();
}

if(isset($_SESSION['noteinsert'])){
echo'
<div id="snackbar" style="
  background-color: rgb(211,211,211);
  color: green;"><span class="glyphicon glyphicon-ok "></span>'.$_SESSION["noteinsert"].'</div>
<script>

  var x = document.getElementById("snackbar");
  x.className = "show";
  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);

</script>
';
session_unset();
}

if(isset($_SESSION['notedelete'])){
echo'
<div id="snackbar" style="
  background-color: rgb(211,211,211);
  color: green;"><span class="glyphicon glyphicon-ok "></span>'.$_SESSION["notedelete"].'</div>
<script>

  var x = document.getElementById("snackbar");
  x.className = "show";
  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);

</script>
';
session_unset();
}

if(isset($_SESSION['notedelete1'])){
echo'
<div id="snackbar" style="
  background-color: rgb(211,211,211);
  color: red;"><span class="glyphicon glyphicon-warning-sign"></span>'.$_SESSION["notedelete1"].'</div>
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





</body>
</html>