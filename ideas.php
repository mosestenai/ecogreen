
<html>
<head><title>
ideas</title>
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
	    <a href="postidea.php">POST AN IDEA</a>
	</li><br><br>
	 <li>
	    <a href="index.php">LOGOUT</a>
	</li><br><br>
</ul>
</nav>
<label for="nav-toggle" class="nav-toggle-label">
<span></span></label>
</header><br><br><br>

<form action="ideas.php" method="get" class="h">
<div class="field">
<input type="text" placeholder="IDEA DESCRIPTION" name="h"><button type="submit" name="search" class="loginbtn">Search</button></div>

</form>
<div class="hostel">
<?php
if (isset($_GET['search'])){
$search= ($_GET['h']);

require 'config.php';
$query="SELECT * FROM ideas WHERE  heading LIKE '%$search%' OR description LIKE '%$search%' ";
$results= $db->query($query) or die($db->error);
if($results->rowCount() > 0){
if($results= $db->query($query) or die($db->error)){
while($row=$results->fetch(PDO::FETCH_OBJ)){


?>

 <div class="five">
 <?php echo $row->heading;?>:</font><br>
 <img class="img" src="<?php echo $row->url; ?>"><br>
  <font color="navy">DESCRIPTION</font><br>
   <font color="black"><?php echo $row->description;?></font><br><br>
  <font color="black"><b>CONTACT <?php echo $row->phone;?></b></font>
  <a href="<?php echo $row->link; ?>">

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
$query="SELECT * FROM ideas";
$results= $db->query($query) or die($db->error);
if($results->rowCount() > 0){
if($results= $db->query($query) or die($db->error)){
while($row=$results->fetch(PDO::FETCH_OBJ)){


?>

 <div class="five"><b>
 <?php echo $row->heading;?>:</font><br>
 <img class="img" src="<?php echo $row->url; ?>"><br>
  <font color="navy">DESCRIPTION</font><br>
   <font color="black"><?php echo $row->description;?></font><br><br>
  <font color="black"><b>CONTACT <?php echo $row->phone;?></b></font>
  <a href="<?php echo $row->link; ?>">
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