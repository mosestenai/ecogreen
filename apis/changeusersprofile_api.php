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
        http_response_code($response_code = 403);//unauthorized access
    } else {
        $json = file_get_contents('php://input');
        $data = json_decode($json);


        $url = $data->url;
        $username = $data->username;



        if (empty($url) or empty($username)) {
            //error message when any field is empty
            echo json_encode(array(
                'error' => "Fill all fields"
            ));
        } else {

            $query = "UPDATE users SET profile_url='$url' WHERE username='$username'";
            $query2 = "UPDATE shops SET profile_url='$url' WHERE username='$username'";
            $db->query($query);
            $db->query($query2);
            echo json_encode(
                array(
                    'error' => "Success" //return successs message as an error after a successful insertion in the database
                )
            );
        }
    }
}
