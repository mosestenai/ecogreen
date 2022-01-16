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


        $current_username = $data->current_username; //username to be changed
        $username = $data->username; //username to be changed to



        if (empty($current_username) or empty($username)) {
            //error message when any field is empty
            echo json_encode(array(
                'error' => "Fill all fields"
            ));
        } else {
            
            $usertable = str_replace(' ', '', $current_username);//remove white spaces from username
            $gh = str_replace(' ', '', $username);
            $sql = "UPDATE shops SET username='$username' WHERE username='$current_username'";
            $query = "ALTER TABLE $usertable RENAME TO $gh"; //change table name
            $db->query($query);
            $db->query($sql);
            echo json_encode(
                array(
                    'error' => "Success" //return successs message as an error after a successful insertion in the database
                )
            );
        }
    }
}
