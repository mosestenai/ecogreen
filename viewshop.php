<html>
<head><title>
viewshop</title>
<link rel="stylesheet" href="style.css">
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php error_reporting (E_ALL ^ E_NOTICE  && E_WARNING);?>
 <?php 
 session_start();
  require 'config.php';
  $po=$_GET['id'];
  $query= "SELECT * FROM shops WHERE id='$po' ";
  $results= $db->query($query) or die($db->error);
  if ($results->rowCount() > 0){
  if ($results= $db->query($query)) {
  while ($row = $results->fetch(PDO::FETCH_OBJ)){
  $description= $row->description;
  $sd= $row->username;
  ?>
  <h3 align="middle"><i><?php echo $sd;?></i></h3>
  <img src="<?php echo $row->profile_url; ?>" height="200" width="200"><br>
  <h4>About us</h4>
  <p><font color="navy"><?php echo $description;?></font><br><br>
  CONTACT <?php echo $row->phone;?></p>
  <h4>OUR ITEMS</h4>
  <?php
  $fg= $row->status;
  if($fg == 'Approved'){
  
  $usertable = str_replace(' ','',$sd);
  $query2= "SELECT * FROM $usertable";
  $results2= $db->query($query2) or die($db->error);
  if ($results2->rowCount() > 0){
  if ($results2= $db->query($query2)) {
  while ($roww = $results2->fetch(PDO::FETCH_OBJ)){
  ?>
  <div class="onee">
  
  <img class="img" src="<?php echo $roww->url; ?>" ><br>
  <font color="navy">
  <?php echo $roww->item;?>:</font><br>
   <font color="black"><?php echo $roww->description;?></font><br>
  <font color="black"><b>KSh <?php echo $roww->price;?></b></font>
  </div>
  <?php
  }}}
  }
  else{
  
 echo '<p align="middle"><font color="red">refer to the sites items</font></p>';
  }
  }}}
 ?>
 </body>
 </html>