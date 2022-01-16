<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
require 'config.php';
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    //Bad request error
    http_response_code($response_code = 400);
} else {
    $token = $_REQUEST['5$fgk'];
    if (empty($token)) {
        http_response_code($response_code = 403);
    } else {
        $json = file_get_contents('php://input');
        $data = json_decode($json);


        $item =  $data->item;
        $url =  $data->url;
        $description =  $data->description;
        $price =  $data->price;
        $username =  $data->username;
        

        if (empty($username) or empty($item) or empty($url) or empty($description) or empty($price) ) {
            //error message when any field is empty
            echo json_encode(array( 
                'error' => "Fill all fields"
            ));
        } else {

            
           
                $query = "INSERT INTO items (item,description,url,price,username) VALUES ('$item','$description','$url','$price','$username')";
                $db->query($query) or die($db->error);

                echo json_encode(
                    array(
                        'error' => "Success" //return successs message as an error after a successful insertion in the database
                    )
                );
            
        }
    }
}
