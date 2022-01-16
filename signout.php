<?php
 session_start(); 
$fg= $_SESSION['username'];

require 'config.php';

$query1 = "DELETE FROM users WHERE username='$fg'";
$usertable = str_replace(' ','',$fg);
$query2 = "DROP TABLE $usertable";
$db->query($query1);
$db->query($query2);
session_destroy();
header ('location: http://ecogreen.herokuapp.com');
?>