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

        $json = file_get_contents('php://input');
        $data = json_decode($json);

        
        //fetching all records in the database shops table
        $query = "SELECT * FROM feedback ";
        $result = $db->query($query);
        if ($result->rowCount() > 0) {
            if ($result = $db->query($query)) {
                $posts_arr = array();
                $posts_arr = array();
                while ($user = $result->fetch(PDO::FETCH_OBJ)) {
                    $post_item = array(
                        'feedback' => $user->feedback,
                        'time' => $user->time.' '.$user->date,
                    );
                    //echo json_encode($post_item,);
                    array_push($posts_arr, $post_item);
                }
                echo json_encode($posts_arr);
            }
        } else {
            //resource not found
            http_response_code($response_code = 404);
        }
    }
}
