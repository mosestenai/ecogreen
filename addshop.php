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
admin</title>
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
<form method="post"  class="form2">
<h2 align ="middle"><font color="navy">Add a shop</font></h2>
<?php include('errors.php'); ?><br>
<div class="input-group2">

<input type="text" name="shop" placeholder="Shop name"> <br><br>
 <br><textarea rows="10" cols="50" name="description" placeholder="<---Shop description-->"></textarea><br><br>
<input type="text" name="phone" placeholder="Phone number"><br><br>

</div>
<div class="select">
<select type="text" list="sort" name="location" ><datalist id="sort">
<option>LOCATION </option>
<option>NAIROBI</option>
<option>NAKURU</option>
<option>KISUMU</option>
<option>ELDORET</option>
<option>KITALE</option>
<option>KISII</option>
<option>NYERI</option>
<option>MOMBASA</option>
<option>KAKAMEGA</option>
</datalist></select></div><br><br>
<div class="input-group2">
<input type="date" name="date" placeholder="DATE">
</div><br>


<br>
<button type="submit" class="loginbtn" name="reg_shops">ADD</button>
<br><br>
&copy 2020 <font color="teal"><u>TENTECH</u></font>
 <br>

</form>

</body>
</html>