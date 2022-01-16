<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
require 'config.php';
if ($_SERVER['REQUEST_METHOD'] != 'GET') {
    //Bad request error
    http_response_code($response_code = 400);
} else {
    $token = $_REQUEST['5$fgk'];
    if (empty($token)) {
        //returning a an error response code if a request is made without a validation token (UNAUTHORISED REQUEST)
        http_response_code($response_code = 401);
    } else {

        //fetching all records in the database shops table
        $query = "SELECT * FROM shops ";
        $result = $db->query($query);
        if ($result->rowCount() > 0) {
           
            $posts_arr = array();
            if ($result = $db->query($query)) {
                while ($user = $result->fetch(PDO::FETCH_OBJ)) {
                    $post_item = array(
                        'shop' => $user->shop,
                        'description' => $user->description,
                        'status' => $user->status,
                        'phone' => $user->phone,
                        'location' => $user->location,
                        'url' => $user->profile_url,
                        'username' => $user->username,
                    );
                
                    //echo json_encode($post_item,);
                    array_push($posts_arr, $post_item);
                }
                
            }
            echo json_encode ($posts_arr);
            http_response_code($response_code = 200);
        } else {
            //resource not found
            http_response_code($response_code = 404);
        }
    }
}
