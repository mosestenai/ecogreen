<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
require 'config.php';
if ($_SERVER['REQUEST_METHOD'] != 'GET') {
    //error message when any field is empty
    echo json_encode(array(
        'error' => "Bad request.ERROR 400"
    ));
} else {
    $token = $_REQUEST['5$fgk'];
    if (empty($token)) {
        //returning a an error response code if a request is made without a validation token (UNAUTHORISED REQUEST)
        http_response_code($response_code = 401);
    } else {

        //fetching all records in the database items table
        $name = $_REQUEST['name'];
        if (empty($name)) {
            $query = "SELECT * FROM items ";
            $result = $db->query($query);
            if ($result->rowCount() > 0) {
                if ($result = $db->query($query)) {
                    $posts_arr = array();
                    $posts_arr = array();
                    while ($user = $result->fetch(PDO::FETCH_OBJ)) {
                        $post_item = array(
                            'item' => $user->item,
                            'url' => $user->url,
                            'description' => $user->description,
                            'price' => $user->price . ' ksh',
                            'username' => $user->username,
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
        } else {
            $query = "SELECT * FROM items WHERE item='$name' ";
            $result = $db->query($query);
            if ($result->rowCount() > 0) {
                if ($result = $db->query($query)) {
                    $posts_arr = array();
                    $posts_arr = array();
                    while ($user = $result->fetch(PDO::FETCH_OBJ)) {
                        $post_item = array(
                            'item' => $user->item,
                            'url' => $user->url,
                            'description' => $user->description,
                            'price' => $user->price . ' ksh',
                            'username' => $user->username,
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
}
