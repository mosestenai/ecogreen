
<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods");
require 'config.php';

$token = $_REQUEST['5$fgk'];
if (empty($token)) {
    http_response_code($response_code = 403);
} else {
$json = file_get_contents('php://input');
$data = json_decode($json, true);
    $target_dir = "images/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    $tempPath = $_FILES["file"]["tmp_name"];
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    //check if image is actual image or fake image 
    $check = getimagesize($_FILES["file"]["tmp_name"]);
    if ($check !== false) {
    } else {
        http_response_code($response_code = 403);
      $uploadOk = 0;
    }


    //check file size

    if ($_FILES["file"]["size"] > 700000) {
        http_response_code($response_code = 403);
      $uploadOk = 0;
    }

    //ALLOW CERTAIN FILE FORMATS
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
      echo json_encode(array(
        'error' => "Invalid format"
    ));
      $uploadOk = 0;
    }

    //check if $upload ok is set to 0 by an error
    if ($uploadOk == 0) {
        http_response_code($response_code = 403);
      //if everything is ok
    } else {
      move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
      echo json_encode(array(
        'message' => "Upload successful"
    ));
      http_response_code($response_code = 200);
      
    }
    
}