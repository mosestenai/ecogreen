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


        $heading = $data->heading;
        $description = $data->description;
        $link = $data->link;
        $phone = $data->phone;
        $url = $data->url;


        if (empty($heading) or empty($link) or empty($phone) or empty($description) or empty($url)) {
            //error message when any field is empty
            echo json_encode(array(
                'error' => "Fill all fields"
            ));
        } else {

            $query = "INSERT INTO ideas (heading,description,link,phone,url) VALUES ('$heading','$description','$link','$phone','$url')";
            $db->query($query);
            echo json_encode(
                array(
                    'error' => "Success" //return successs message as an error after a successful insertion in the database
                )
            );
        }
    }
}
