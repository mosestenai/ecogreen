<?php
require 'config.php';

$sql = "CREATE TABLE items (id SERIAL ,item varchar(500),description varchar(500),url varchar(500),price varchar(500),status varchar(500),username varchar(500))";
$db->query($sql);
?>
