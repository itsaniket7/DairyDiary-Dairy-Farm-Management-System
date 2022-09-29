<!DOCTYPE html>
<html lang="en">
<head>
  <title>DairyDiary - Edit profile</title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<link rel="shortcut icon" type="image/x-icon" href="logo.ico">
<link rel="stylesheet" href="editprofile.css">
<link rel="stylesheet" href="design.css">
  
</head>
<body> 

<nav class="navbar navbar-custom navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="http://localhost/A%20Capston%20DairyDiary/milk.php" data-toggle="tooltip" title="a.DairyDiary.com"><img src="logo2.png" alt="logo" height="50px" width="200px"></a>
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
  <li  data-toggle="tooltip" title="Milk records"><a href="http://localhost/A%20Capston%20DairyDiary/milk.php" style="color:black;">Milk</a></li>
  <li  data-toggle="tooltip" title="Feed records"><a href="http://localhost/A%20Capston%20DairyDiary/feed.php" style="color:black;">Feed</a></li>
  <li  data-toggle="tooltip" title="Notes"><a href="http://localhost/A%20Capston%20DairyDiary/note.php" style="color:black;">Notes</a></li>
  <li data-toggle="tooltip" title="Payment receipts"><a href="http://localhost/A%20Capston%20DairyDiary/Bill.php" style="color:black;"><span class="glyphicon glyphicon-usd"></span> Bill</a></li>
</ul>

</nav>



<div class="container light-style flex-grow-1 container-p-y" style="position:relative; top:130px;">

    <div class="card overflow-hidden">
      <div class="row no-gutters row-bordered row-border-light">
        <div class="col-md-3 pt-0">
          <div class="list-group list-group-flush account-settings-links">
            <a class="list-group-item list-group-item-action active" data-toggle="list" href="#account-general">General</a>
            <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-change-password">Change password</a>
  
          </div>
        </div>
        <div class="col-md-9">
          <div class="tab-content">
            <div class="tab-pane fade active show" id="account-general">

              <hr class="border-light m-0">

              <div class="card-body">
                <div class="form-group">
                  <label class="form-label">Username</label>
                  <input type="text" class="form-control mb-1" placeholder="Enter username">
                </div>
                <div class="form-group">
                  <label class="form-label">First name</label>
                  <input type="text" class="form-control" placeholder="Enter first name">
                </div>
                 <div class="form-group">
                  <label class="form-label">Last name</label>
                  <input type="text" class="form-control" placeholder="Enter last name">
                </div>


                <div class="form-group">
                  <label class="form-label">E-mail</label>
                  <input type="email" class="form-control mb-1" placeholder="Enter E-mail">
                  
                </div>
              </div>
            </div>

            <div class="tab-pane fade" id="account-change-password">
              <div class="card-body pb-2">

                <div class="form-group">
                  <label class="form-label">Current password</label>
                  <input type="password" class="form-control" placeholder="Current password">
                </div>

                <div class="form-group">
                  <label class="form-label">New password</label>
                  <input type="password" class="form-control" placeholder="New password">
                </div>

                <div class="form-group">
                  <label class="form-label">Repeat new password</label>
                  <input type="password" class="form-control" placeholder="confirm password">
                </div>

              </div>
            </div>
           
              
            

              <div class="text-right mt-3 form-group">
      <button type="button" class="btn btn-primary">Save changes</button>&nbsp;
      <button type="button" class="btn btn-default">Cancel</button>
    </div>
           
              </div>
            </div>
          </div>
        </div>
      </div>

  </body>
</html>
