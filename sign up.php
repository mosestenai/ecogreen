<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
<title>Registration</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<br><br>
<p align="center">
<img src="images/logo1.jpg" width="250" height="150"></p>
<form method="post">
<?php include('errors.php'); ?><div class="select">
<select type="text" list="sort" name="location" ><datalist id="sort">
<option>LOCATION </option>
<option>NAIROBI</option>
<option>NAKURU</option>
<option>KISUMU</option>
<option>ELDORET</option>
<option>KITALE</option>
<option>KISII</option>
<option>NYERI</option>
<option>MOMBASA</option>
<option>KAKAMEGA</option>
</datalist></select></div><br><br>
<div class="input-group">
<label>Username</label>
<input type="text" name="username" value="<?php echo $username;?>">
</div><br>
<div class="input-group">
<label>Email</label>
<input type="email" name="email" value="<?php echo $email;?>">
</div><br>
<div class="input-group">
<label>Password</label>
<input type="password" name="password_1">
</div><br>
<div class="input-group">
<label>Confirm password</label>
<input type="password" name="password_2">
</div>
<br><br>
By continuing, you agree to Ecogreen's <a href="terms.php"><font color="navy">Terms of service </font></a>and <a href="terms.php"><font color="navy">Privacy Policy.</font></a>
<div class="input-group">
<button type="submit" class="loginbtn" name="reg_user">PROCEED</button>
</div>
<p>
Have an account?<a href="login.php">Log in</a>
</p><br>
&copy 2020 <font color="teal"><u>ECOGREEN</u></font>. Powered by <font color="teal"><u>TENAI TECH</u></font><br>
 <br>

</form>

</body>
</html>