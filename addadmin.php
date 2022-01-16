
<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
  ?>
  <?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
<title>addadmin</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<p align="center">
<img src="images/logo1.jpg" width="250" height="150"></p>
<form method="post" >
<?php include('errors.php'); ?>
<br><br><br><br>
<div class="input-group">
<input type="text" name="username" value="<?php echo $username;?>" placeholder="username"><br><br>
</div>
<div class="input-group">
<input type="email" name="email" placeholder="Email" value="<?php echo $email;?>">
</div><br><br>
<div class="input-group">
<input type="password" name="password_1" placeholder="Password">
</div><br><br>
<div class="input-group">
<input type="password" name="password_2" placeholder="Confirm password">
</div>
<br><br>
<div class="input-group">
<button type="submit" class="loginbtn" name="reg_admin">Register</button>
</div>

&copy 2020 <font color="teal"><u>ECOGREEN</u></font>. Designed by <font color="teal"><u>TENAI TECH</u></font><br>
 <br>

</form>

</body>
</html>