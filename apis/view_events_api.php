<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
require 'config.php';

$token = $_REQUEST['5$fgk'];
if (empty($token)) {
    //returning a an error response code if a request is made without a validation token (UNAUTHORISED REQUEST)
    http_response_code($response_code = 401);
} else {

    //fetching all records in the database hostel table
    $query = "SELECT * FROM events ";
    $result = $db->query($query);
    if ($result->rowCount() > 0) {
        if ($result = $db->query($query)) {
            $posts_arr = array();
            $posts_arr = array();
            while ($user = $result->fetch(PDO::FETCH_OBJ)) {
                $post_item = array(
                    'heading' => $user->heading,
                    'description' => $user->description,
                    'location' => $user->location,
                    'phone' => $user->phone,
                    'url'=> $user->url,
                );
             //echo json_encode($post_item,);
                array_push($posts_arr, $post_item);
                
            }
           echo json_encode($posts_arr);

        }
    } else{
        //resource not found
        http_response_code($response_code=404);
    }
}
