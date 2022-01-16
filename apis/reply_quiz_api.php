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


       
        $id =  $data->id;
        $answer=  $data->answer;
        

        if (empty($answer) or empty($id)) {
            //error message when any field is empty
            echo json_encode(array( 
                'error' => "Fill all fields"
            ));
        } else {

            
           
                $query = "UPDATE quizes SET answer='$answer' WHERE id='$id' ";
                $db->query($query) or die($db->error);

                echo json_encode(
                    array(
                        'error' => "Success" //return successs message as an error after a successful insertion in the database
                    )
                );
            
        }
    }
}
