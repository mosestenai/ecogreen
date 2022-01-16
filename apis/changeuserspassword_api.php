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


        $password_1 = $data->password; //password to be changed to
        $username = $data->username;



        if (empty($password) or empty($username)) {
            //error message when any field is empty
            echo json_encode(array(
                'error' => "Fill all fields"
            ));
        } else {

            $password = password_hash($password_1, PASSWORD_DEFAULT, array('cost' => 9)); //encrypt the password before saving in the database
            $query = "UPDATE users SET password='$password' WHERE username='$username'";
            $db->query($query);
            echo json_encode(
                array(
                    'error' => "Success" //return successs message as an error after a successful insertion in the database
                )
            );
        }
    }
}
