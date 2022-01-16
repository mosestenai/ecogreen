<!DOCTYPE html>
<html>
<head>
  <title>pay</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<p align="center">
<img src="images/logo1.jpg" width="250" height="150"></p>
<form method="get" action="pay.php">
<?php include('errors.php'); ?><br><br><br><br>
<div class="input-group">
  		<label>PHONE NUMBER</label>
  		<input type="number" name="number" placeholder="*BEGIN WITH 254">
  	</div>
  	<div class="input-group">
  		<label>AMOUNT</label>
  		<input type="number" name="amount" placeholder="<--amount you would wish to donate-->">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="loginbtn" name="pay">CONTRIBUTE</button>
  	</div><br>
	</form>
	<?php
	if (isset($_GET['pay'])){
	
	$phonenumber= $_GET['number'];
	$amount= $_GET['amount'];
	
	require_once'troj/register.php';
	echo pay($phonenumber,$amount);
	}
	
	?>
	</body>
	</html>