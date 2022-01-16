
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
<title>add centre</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<p align="center">
<img src="images/logo1.jpg" width="250" height="150"></p>
<form method="post" >
<?php include('errors.php'); ?><div class="select">
<br><br><select type="text" list="sort" name="location" ><datalist id="sort">
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
</datalist></select>
<select type="text" list="sort" name="type" ><datalist id="sort">
<option>TYPE </option>
<option>METAL</option>
<option>PLASTIC</option>
<option>PAPER</option>
<option>GLASS</option>
<option>ELECTRONICS</option>
</datalist></select></div><br>
<div class="input-group">
<input type="text" name="centre" placeholder="collection centre name"><br><br>
</div>
<div class="input-group">
<input type="text" name="contact" placeholder="CONTACT">
</div><br><br>
<label>Description:</label><br><textarea rows="10" cols="50" name="description" placeholder="<---brief description-->"></textarea><br>
<div class="input-group">
<button type="submit" class="loginbtn" name="reg_centre">Register</button>
</div>

&copy 2020 <font color="teal"><u>TENTECH</u></font><br>
 <br>

</form>

</body>
</html>