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


        $centre = $data->centre;
        $description = $data->description;
        $location = $data->location;
        $contact = $data->contact;
        $type = $data->type;


        if (empty($centre) or empty($location) or empty($contact) or empty($description) or empty($type)) {
            //error message when any field is empty
            echo json_encode(array(
                'error' => "Fill all fields"
            ));
        } else {



            $query = "INSERT INTO centres (centre,description,location,contact,type) VALUES('$centre','$description','$location','$contact','$type')";
            $db->query($query);
            echo json_encode(
                array(
                    'error' => "Success" //return successs message as an error after a successful insertion in the database
                )
            );
        }
    }
}
