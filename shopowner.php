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
  <html>
<head><title>
you</title>
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
	    <a href="items.php">MY ITEMS</a>
	</li><br><br>
	 <li>
	    <a href="messages.php">MESSAGES</a>
	</li><br><br>
	<li>
	    <a href="account.php">ACCOUNT</a>
	</li><br><br>
	 <li>
	    <a href="index.php">LOGOUT</a>
	</li><br><br>
</ul>
</nav>
<label for="nav-toggle" class="nav-toggle-label">
<span></span></label>
</header><br><br><br>
<h3 align="middle"><i>POST AN ITEM</i></h3>
<form method="post" enctype="multipart/form-data">
<?php include('errors.php'); ?><br><br>
<div class="input-group">
  		<label>NAME OF AN ITEM</label>
  		<input type="text" name="item" placeholder="item name">
  	</div>
	<br><div class="input-group2">
<input type="number" name="price" placeholder="price"></div><br>
	 <label>Description:</label><br><textarea rows="10" cols="50" name="description" placeholder="<---brief description-->"></textarea><br>
	 
<?php error_reporting (E_ALL ^ E_NOTICE) ;?>

<h4>Attach an image;</h4>
<input type="file" name="fileToUpload" id="fileToUpload">
<br>
	 
	 <div class="input-group">
  		<button type="submit" class="loginbtn" name="post_item">POST</button>
  	</div><br>
	 </form>
</body>
</html>