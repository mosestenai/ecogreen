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
<html>
<head><title>
items</title>
<link rel="stylesheet" href="style.css">
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<h2 align="middle"><i> ITEMS</i></h2>
<br><br>
<?php error_reporting (E_ALL ^ E_NOTICE  && E_WARNING);?>
 <?php 
 session_start();
  require 'config.php';
  $po=$_SESSION['username'];
  $usertable = str_replace(' ','',$po);
  $query= "SELECT * FROM items WHERE username='$po' ";
  $results= $db->query($query) or die($db->error);
  if ($results->rowCount() > 0){
  if ($results= $db->query($query)) {
  while ($row = $results->fetch(PDO::FETCH_OBJ)){
 ?>
 <div class="onee">
  
  <img class="img" src="<?php echo $row->url; ?>"><br>
  <font color="navy">
  <?php echo $row->item;?>:</font><br>
   <font color="black"><?php echo $row->description;?></font><br>
  <font color="black"><b>KSh <?php echo $row->price;?></b></font>
   <a href=delete.php?id=<?php echo $row->id;?> onclick="return confirm('Are you sure you want to delete this item?')">Remove</a>
  </div>
  <?php
  } }}
  else{
  echo '<h3 align="middle"><font color="red">NO ITEMS</font></h3>';
  }
  ?>
</body>
</html>