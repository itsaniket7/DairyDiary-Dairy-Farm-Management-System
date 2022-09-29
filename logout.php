<?php
   setcookie( "username", "", time()- 60, "/","", 0);
header("location:login-user.php")
?>