<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
require 'config.php';

$token = $_REQUEST['5$fgk'];
if (empty($token)) {
    //returning a an error response code if a request is made without a validation token (UNAUTHORISED REQUEST)
    http_response_code($response_code = 401);
} else {

    $json = file_get_contents('php://input');
    $data = json_decode($json);

    $username = $_REQUEST['username'];
    if (empty($username)) {
        http_response_code($response_code = 403);
    } else {
        $usertable = str_replace(' ', '', $username); //remove white spaces from the username

        //fetching  records in the database shop table
        $query = "SELECT * FROM $usertable ";
        $result = $db->query($query);
        if ($result->rowCount() > 0) {
            if ($result = $db->query($query)) {
                $posts_arr = array();
                $posts_arr = array();
                while ($user = $result->fetch(PDO::FETCH_OBJ)) {
                    $post_item = array(
                        'item' => $user->item,
                        'amount' => $user->amount,
                        'phone' => $user->phonenumber,
                        'date' => $user->transactiondate,
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
