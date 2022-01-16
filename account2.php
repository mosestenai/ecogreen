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
 <?php error_reporting (E_ALL ^ E_NOTICE  && E_WARNING);?>
 <?php 
 session_start();
  require 'config.php';
  $fg=$_SESSION['username'];
  $query= "SELECT * FROM users WHERE username='$fg' ";
  $results= $db->query($query) or die($db->error);
  if ($results->rowCount() > 0){
  if ($results= $db->query($query)) {
  while ($row = $results->fetch(PDO::FETCH_OBJ)){
 
  
  ?>
<!DOCTYPE html>
<html>
<head>
  <title>Account settingss</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body><br><br><br><br>
<form method="get" action="account2.php">
<p align="center">
USERNAME<br>
<?php echo $row->username;?><br>
<button type="submit" class="loginbtn" name="username">CHANGE USERNAME</button><br><br>
<button type="submit" class="loginbtn" name="profile">CHANGE PROFILE PIC</button><br><br>
<img src="<?php echo $row->profile_url;?>" width="200" height="200"><br>
<button   type="submit" class="loginbtn" name="password">CHANGE PASSWORD</button><br><br>
</p>
</form>
</body>
</html>
<?php
if(isset($_GET['username'])){
echo '<form method="post" action="server.php"><br><div class="input-group">
  		<label>ENTER NEW USERNAME</label>
  		<input type="text" name="username">
  	</div><button type="submit" class="loginbtn" name="changeusernamee">change</button></form>';
}
if(isset($_GET['profile'])){
echo '<form method="post" action="server.php" enctype="multipart/form-data"><br><h4>Select an image;</h4>
<input type="file" name="fileToUpload" id="fileToUpload">
<br><button type="submit" class="loginbtn" name="changeprofilee">change</button></form>';
}
if(isset($_GET['password'])){
echo '<form method="post" action="server.php"><br><div class="input-group">
  		<label>ENTER NEW PASSWORD</label>
  		<input type="password" name="password_1"><br>
		<label>CONFIRM NEW PASSWORD</label>
  		<input type="password" name="password_2">
		
  	</div><button type="submit" class="loginbtn" name="changepasswordd">change</button></form>';
}
  }}}
?>