

<html>
<head><title>
collection</title>
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
	    <a href="addcentre.php">ADD A COLLECTION CENTRE</a>
	</li><br><br>
	 <li>
	    <a href="index.php">LOGOUT</a>
	</li><br><br>
</ul>
</nav>
<label for="nav-toggle" class="nav-toggle-label">
<span></span></label>
</header><br><br><br>

<form action="collection.php" method="get" class="h">
<div class="field">
<input type="text" placeholder="CENTRE NAME/LOCATION/TYPE" name="h"><button type="submit" name="search" class="loginbtn">Search</button></div>

</form>
<div class="hostel">
<?php
if (isset($_GET['search'])){
$search= ($_GET['h']);

require 'config.php';
$query="SELECT * FROM centres WHERE  centre LIKE '%$search%' OR description LIKE '%$search%' OR location LIKE '%$search%' ";
$results= $db->query($query) or die($db->error);
if($results->rowCount() > 0){
if($results= $db->query($query) or die($db->error)){
while($row=$results->fetch(PDO::FETCH_OBJ)){


?>

 <div class="five">
 <font color="black"><?php echo $row->centre;?></font></b><br>
 <b>LOCATION</b>:
 <?php echo $row->location;?><br>
 <b>TYPE</b>:
 <?php echo $row->type;?> RECYCLING<br>
 <b>DESCRIPTION</b><br>
  <?php echo $row->description;?><br>
  <b>CONTACT</b>:
  <?php echo $row->contact;?><br>

 </div>
 <?php
 }
}
}
else{
echo '<h2 align="middle"><font color="red">NO MATCHES FOUND</font></h2>';
}
}else{
require 'config.php';
$query="SELECT * FROM centres";
$results= $db->query($query) or die($db->error);
if($results->rowCount() > 0){
if($results= $db->query($query) or die($db->error)){
while($row=$results->fetch(PDO::FETCH_OBJ)){


?>

 <div class="five"><b>
 <font color="black"><?php echo $row->centre;?></font></b><br>
 <b>LOCATION</b>:
 <?php echo $row->location;?><br>
 <b>TYPE</b>:
 <?php echo $row->type;?> RECYCLING<br>
 <b>DESCRIPTION</b><br>
  <?php echo $row->description;?><br>
  <b>CONTACT</b>:
  <?php echo $row->contact;?><br>
 </div>
 <?php
 }
}
}

}
 ?>
  </div>
</body>
</html>