
<html>
<head><title>
events</title>
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
	    <a href="postevent.php">POST AN EVENT</a>
	</li><br><br>
	 <li>
	    <a href="index.php">LOGOUT</a>
	</li><br><br>
</ul>
</nav>
<label for="nav-toggle" class="nav-toggle-label">
<span></span></label>
</header><br><br><br>


<div class="hostel">
<?php
require 'config.php';
$query="SELECT * FROM events";
$results= $db->query($query) or die($db->error);
if($results->rowCount() > 0){
if($results= $db->query($query) or die($db->error)){
while($row=$results->fetch(PDO::FETCH_OBJ)){


?>

 <div class="fivee"><b>
 <?php echo $row->heading;?>:</font><br>
 <img class="img" src="<?php echo $row->url; ?>"><br>
  <font color="navy">DESCRIPTION</font><br>
   <font color="black"><?php echo $row->description;?></font><br><br>
  <font color="black"><b>CONTACT <?php echo $row->phone;?></b></font>
 </div>
 <?php
 }
}
}
 ?>
  </div>
</body>
</html>