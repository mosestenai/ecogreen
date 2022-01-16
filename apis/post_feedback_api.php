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


    
        $feedback =  $data->feedback;
        date_default_timezone_set("Africa/Nairobi");
        $time = date("h:i:sa");
        $date= date("d/m/Y");
        

        if (empty($feedback)) {
            //error message when any field is empty
            echo json_encode(array( 
                'error' => "Fill all fields"
            ));
        } else {

                $query = "INSERT INTO feedback (feedback,date,time) VALUES ('$feedback','$date','$time')";
                $db->query($query) or die($db->error);

                echo json_encode(
                    array(
                        'error' => "Success" //return successs message as an error after a successful insertion in the database
                    )
                );
            
        }
    }
}
