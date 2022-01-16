<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>login</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" type="text/css" href="style.css">
  <meta http-equiv="refresh" content="30">
</head>
<body>
<p align="center">
<img src="images/logo1.jpg" width="250" height="150"></p>
<form method="post" action="login.php">
<?php include('errors.php'); ?><br><br><br><br>
<div class="input-group">
  		<label>Username</label>
  		<input type="text" name="username">
  	</div>
  	<div class="input-group">
  		<label>Password</label>
  		<input type="password" name="password">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="loginbtn" name="login_user">Login</button>
  	</div><br>
	
	Forgot password? <a href="reset pass.php" title="click here to reset your password"><font color="navy"> Reset password</font></a>
	<?php
	if (isset($_GET["newpwd"])){
	 if  ($_GET["newpwd"] == "passwordupdated"){
	 echo '<p align="middle"><font color="blue">Your password has been reset!</font></p>';
	 }
	}
	?><br><br>
	No account?<a href="sign up.php">Sign Up</a>
<br><br><br>
	<footer>
	&copy 2020. <font color="teal"><u>TENTECH</u></font>
	</footer>
	
  </form>
  
 
  </body>
  </html>
