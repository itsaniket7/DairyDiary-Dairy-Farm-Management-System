 <?php
         if(! isset($_COOKIE["username"]))
           header("location: http://localhost/A Capston DairyDiary/login.php");
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>
D A I R Y D I A R Y
</title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="universal.css"/>

</head>
<body>
<nav class="navbar navbar-custom navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="http://localhost/A%20Capston%20DairyDiary/milk.php"><img src="logo2.png" alt="logo" height="50" width="250"></a>
    </div>

<form class="navbar-form navbar-left" action="">
  <div class="input-group input-custom">
    <input type="text" class="form-control" placeholder="Search ..." id="myInput">  
  </div>
</form>

   <ul class="nav navbar-nav navbar-right">  

<div class="dropdown">

<li class="dropdown-toggle"  data-toggle="dropdown"><img src="Avtar.jpg" alt="Avtar" class="avtar"></li>
  <ul class="dropdown-menu">
    <li><a href="#">Profile</a></li>
    <li class="divider"></li>
     <li><a href="http://localhost/A%20Capston%20DairyDiary/logout.php"  style="color:Tomato;"> Log Out</a></li> 
  </ul>
   
</div>
  </div>
<hr>
  <div class="container-fluid">
<ul class="nav nav-pills  nav-justified">
  <li data-toggle="tooltip" title="Hooray!"><a href="http://localhost/A%20Capston%20DairyDiary/milk.php">Milk</a></li>
  <li><a href="http://localhost/A%20Capston%20DairyDiary/feed.php">Feed</a></li>
  <li  class="active" ><a href="http://localhost/A%20Capston%20DairyDiary/note.php"></span>Notes</a></li>
  <li><a href="http://localhost/A%20Capston%20DairyDiary/Bill.php"><span class="glyphicon glyphicon-usd"></span> Bill</a></li>
</ul>
 </div>
</nav>

<form method='post' action='notedel.php'>
<div class="container" style="margin-top:150px">
<div>

<div  id="myTable">

<?php
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

<div class="panel panel-primary" id="tr_<?= $field1name ?>">

      <div class="panel-heading"><text><?= $field1name ?></text><text><?= $field2name ?></text></div>
      <div class="panel-body"><?= $field3name ?></div>
    </div>
<input type='checkbox' name='delete[]' value='<?= $field1name ?>' >
<br><br><br>
</div>

<div class="btn">
<a href="#myModal" class="float-add" data-toggle="modal"><button name="add" id="add" class="btn btn-primary btn-rounded my-float float-add"><span class="glyphicon glyphicon-plus"></span> Create</button></a>

<a href="#" class="float-del"><button type="submit" name="but_delete" id="del" class="btn btn-primary btn-rounded my-float float-del"><span class="glyphicon glyphicon-trash"></span> Delete</button></a>

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
    <input type="date" class="form-control" id="dateinput" name="field1">
  </div>
  <div class="form-group">
    <label for="notename">Note name</label>
    <input type="text" class="form-control" id="notename" name="field2" placeholder="Enter note name">
  </div>
   <div class="form-group">
    <label for="notebody">Note</label>
    <textarea class="form-control" id="notebody" name="field3" rows="3"></textarea>
  </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
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