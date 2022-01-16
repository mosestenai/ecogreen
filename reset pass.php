<?php include('send_linkk.php') ?>
<html>	
<link rel="stylesheet" type="text/css" href="style.css">
  <body>
  <br><br><br>
  <p align="center">
<img src="images/logo1.jpg" width="250" height="150"></p><br>
    <form method="post" action="reset pass.php">
	<?php include('errors.php'); ?>
	<h2> Forgot your<br>
password?</h2><br><br>
	  <h4><font color = "black">Enter your <br>
Email</font></h4><br>
      <div class="input-group">
	  <label>User email</label>
	  <input type="text" name="email"></div>
	  <div class="input-group">
      <button type="submit" name="submit_email" class="loginbtn">SUBMIT</button>
	  </div>
    </form>
	<?php
	require 'config.php';
	  if (isset($_GET["reset"])){//checks the url for a reset GET parameter
	   if ($_GET["reset"] == "success"){
	    echo '<h3 align="middle"><font color="red">Success!!Check out your email</font></h3>';
	   }
	  }
	  ?>
  </body> 
</html>
