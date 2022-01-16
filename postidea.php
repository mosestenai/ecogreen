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
post idea</title>
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
	    <a href="index.php">LOGOUT</a>
	</li><br><br>
</ul>
</nav>
<label for="nav-toggle" class="nav-toggle-label">
<span></span></label>
</header><br><br><br>
<form method="post"  enctype="multipart/form-data">
<h2 align ="middle"><font color="navy">post an idea</font></h2>
<?php include('errors.php'); ?><br>
<div class="input-group2">

<input type="text" name="heading" placeholder="heading"> <br><br>
<label>Video link</label><br>
<input type="text" name="link" placeholder="add a video link if any"> <br><br>
 
 <br><textarea rows="20" cols="60" name="description" placeholder="<---idea description-->"></textarea><br><br>
<input type="text" name="phone" placeholder="contacts"><br><br>

</div>
<h4>Attach an image;</h4>
<input type="file" name="fileToUpload" id="fileToUpload">
<br>



<br>
<button type="submit" class="loginbtn" name="reg_idea">ADD</button>
<br><br>
&copy 2020 <font color="teal"><u>TENTECH</u></font>
 <br>

</form>

</body>
</html>