<?php 
  session_start(); 

  if (isset($_SESSION['username'])) {
  	session_destroy();
  }
  
  ?>
<!DOCTYPE html>
<html>
<head>
  <title>home</title>
  <link rel="shortcut icon" type="image/jpg" href="images/logo1.jpg"/>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<p align="center">
<img src="images/logo1.jpg" width="250" height="150"></p>
<header class="navheader">
<h1></h1>
<input type="checkbox" class="nav-toggle" id="nav-toggle">
<p><font color="white">jghjfhjfj</font></p>
<nav class="navburger">
   <br>
   <ul>
   <li>
	    <a href="ideas.php">Ideas</a>
	</li>
     <li>
	    <a href="events.php">Events</a>
	</li>	
	<li>
	    <a href="sign up.php">Sign up</a>
	</li>	
	 <li>
	    <a href="about us.php">About Us</a>
	</li>
	 <li>
	    <a href="donate.php">Donate</a>
	</li>
	 <li>
	    <a href="terms.php">Terms and Conditions</a>
	</li>
	
</ul>
</nav>
<label for="nav-toggle" class="nav-toggle-label">
<span></span></label>
</header><br><br><br>

<nav> <div class="three"><ul class="nav-links"  >
          <a href="login.php">LOGIN</a>
           
		   
		   
        </ul></div></nav>
<br><br><br><br>

<br><br>
<div class="hit"><div class ="shop"><a href="shops.php">SHOPS</a></div><a href="collection.php">CENTRES</a></div>
<br>
<?php error_reporting (E_ALL ^ E_NOTICE  && E_WARNING);?>
 <?php 
 session_start();
  require 'config.php';
  $query= "SELECT * FROM items";
  $results= $db->query($query) or die($db->error);
  if ($results->rowCount() > 0){
  if ($results= $db->query($query)) {
  while ($row = $results->fetch(PDO::FETCH_OBJ)){
 ?>
 <div class="one">
 
  <img src="<?php echo $row->url; ?>" width="75%" height="75%" ><br>
  <font color="navy">
  <?php echo $row->item;?>:</font><br>
   <font color="black"><?php echo $row->description;?></font><br>
  <font color="black"><b>KSh <?php echo $row->price;?></b></font>
  </div>
  
  <?php
  } }}
  else{
  echo '<h3 align="middle"><font color="red">NO HOPS YET</font></h3>';
  }
  ?>

</body>
</html>