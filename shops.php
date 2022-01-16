<!DOCTYPE html>
<html>
<head>
  <title>shops</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" type="text/css" href="style.css">
 
</head>
<body>
<br><br>
<header class="navheader">
<h1></h1>
<input type="checkbox" class="nav-toggle" id="nav-toggle">
<p><font color="white">jghjfhjfj</font></p>
<nav class="navburger">
   <br><br>
   <ul>
	 <li>
	    <a href="addshop.php">REGISTER A SHOP</a>
	</li><br><br>
	<li>
	    <a href="items.php">YOUR ITEMS</a>
	</li><br><br>
	<li>
	    <a href="account2.php">ACCOUNT</a>
	</li><br><br>
	 <li>
	    <a href="index.php">HOME</a>
	</li><br><br>
</ul>
</nav>
<label for="nav-toggle" class="nav-toggle-label">
<span></span></label>
</header><br><br><br><br><br>
<?php error_reporting (E_ALL ^ E_NOTICE  && E_WARNING);?>
 <?php 
 session_start();
  require 'config.php';
  $query= "SELECT * FROM shops";
  $results= $db->query($query) or die($db->error);
  if ($results->rowCount() > 0){
  if ($results= $db->query($query)) {
  while ($row = $results->fetch(PDO::FETCH_OBJ)){
 ?>
 <div class="onety">
 <font color="navy">
  <?php echo $row->shop;?></font><font color="white"></font><p class="op"><font color="red"><?php echo $row->status;?></font></p><br><br>
  <img class="img" src="<?php echo $row->profile_url; ?>"><br>
  
  
   <font color="black"><b>DESCRIPTION</b><p class="ss"><i><?php echo $row->description;?></i></p></font><br>
   
  <font color="black"><b>CONTACT <?php echo $row->phone;?> <font color="white">fgfg</font><?php echo $row->location;?></b></font>
   <a href=viewshop.php?id=<?php echo $row->id;?> >View</a>
  </div>
  <?php
  } }}
  else{
  echo '<h3 align="middle"><font color="red">NO SHOPS YET</font></h3>';
  }
  ?>
  </body>
  </html>