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
        //returning a an error response code if a request is made without a validation token (UNAUTHORISED REQUEST)
        http_response_code($response_code = 401);
    } else {

        $json = file_get_contents('php://input');
        $data = json_decode($json);


        $username =  $data->username;

        if (empty($username)) {
            http_response_code($response_code = 401);
        } else {

            //fetching all records in the database shops table
            $query = "SELECT * FROM shops WHERE username='$username' ";
            $result = $db->query($query);
            if ($result->rowCount() > 0) {
                if ($result = $db->query($query)) {

                    while ($user = $result->fetch(PDO::FETCH_OBJ)) {
                        $post_item = array(
                            'phone' => $user->phone,
                            'description' => $user->description,
                            'shop' => $user->shop,
                            'paybill' => $user->paybill,
                            'location' => $user->location,
                        );
                        echo json_encode($post_item);
                    }
                }
            } else {
                //resource not found
                http_response_code($response_code = 404);
            }
        }
    }
}
