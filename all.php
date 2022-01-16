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
viewall</title>
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
	    <a href="account2.php">ACCOUNT</a>
	</li>	<br><br>
	 <li>
	    <a href="viewmessage.php">MESSAGES</a>
	</li><br><br>
	 <li>
	    <a href="events.php">EVENTS</a>
	</li><br><br>
	 <li>
	    <a href="index.php">LOGOUT</a>
	</li><br><br>
	 <li>
	    <a href=signout.php? onclick="return confirm('Are you sure you want to sign out from this site?This action cannot be undone')">SIGN OUT</a>
	</li><br><br>
</ul>
</nav>
<label for="nav-toggle" class="nav-toggle-label">
<span></span></label>
</header><br><br><br>

<div class="fieldset-contact" align="middle">
<br><br>
<a href="collection.php"><button class="btn">COLLECTION CENTRES</button></a>
<br /><br><br>
<a href="ideas.php"><button class="btn">IDEAS</button></a>
<br><br><br>
<a href="shops.php"><button class="btn">SHOPS</button></a>
<br><br><br>
<a href="donate.php"><button class="btn">DONATE</button></a>
<br><br><br>
</div>




</body>
</html>	  