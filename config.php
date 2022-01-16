<?php error_reporting (E_ALL ^ E_NOTICE);?><?php

session_start();
// initializing variables
$username = "";
$email    = "";
$errors = array(); 
$minpassword = 7;
$host="ec2-52-71-161-140.compute-1.amazonaws.com";
$user="ovynzfjxmrirvi";
$password="f8808b30c2fcda70054f3f807ede266bf3ebcf8cbb95e470c901f52016057ff5";
$dbname="dakg3vg9lfkp23";
$port="5432";
 
try{
$db = new PDO("pgsql:host=$host;dbname=$dbname;port=$port",$user,$password);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $error)
{
$error->getMessage();
}

?>