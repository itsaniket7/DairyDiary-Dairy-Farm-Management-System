<html style="border:4px solid black;">
<body style="background-color:brown;">
  <h3 align="center" style="border:2px solid black; background-color:white">LOGIN</h1>


<?php session_start();
if(isset($_POST['Submit'])){
$logins = array('username' => '8530257641');
$logins = array('aniket'=>'sawant');

$Username = isset($_POST['Username']) ? $_POST['Username'] : '';
$Password = isset($_POST['Password']) ? $_POST['Password'] : '';

if (isset($logins[$Username]) && $logins[$Username] == $Password){
$_SESSION['UserData']['Username']=$logins[$Username];
header("location:http://localhost/A Capston DairyDiary/MAINHOME.php");
exit;
} else {
$msg="<span style='color:yellow'>Invalid Login Details</span>";
}
}
?>

<form action="" method="post" name="Login_Form">
  <table width="400" border="0" align="center" cellpadding="5" cellspacing="1" class="Table">
    <?php if(isset($msg)){?>
    <tr>
      <td colspan="2" align="center" valign="top"><?php echo $msg;?></td>
    </tr>
    <?php } ?>

    <tr>
      <td align="right" valign="top">Username</td>
      <td><input name="Username" type="text" class="Input"></td>
    </tr>
    <tr>
      <td align="right">Password</td>
      <td><input name="Password" type="password" class="Input"></td>
    </tr>
    <tr>
      <td> </td>
      <td><input name="Submit" type="submit" value="Login" class="Button3"></td>
    </tr>
  </table>


</body>
</html>
