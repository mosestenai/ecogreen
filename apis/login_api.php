<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
require 'config.php';

$token = $_REQUEST['5$fgk'];
if (empty($token)) {
    //returning a an error response code if a request is made without a validation token 
    http_response_code($response_code = 403);
} else {
    $json = file_get_contents('php://input');
    $data = json_decode($json);

    //$username = $_REQUEST['username'];
    $password =  $data->password;
    $username =  $data->username;


    if (empty($username) or empty($password)) {
        //error response code if username and password field is empty
        echo json_encode(array(
            'error' => "Empty username or password"
        ));
    } else {
        $query = "SELECT * FROM users WHERE username='$username' LIMIT 1";
        $query2 = "SELECT * FROM admin WHERE username='$username'";
        $query3 = "SELECT * FROM shops WHERE username='$username'";
       
        $results = $db->query($query);
        $results2 = $db->query($query2);
        $results3 = $db->query($query3);
       
        //logging in the user if the credentials are found in the database
        if ($results->rowCount() == 1) {
            $user = $results->fetch(PDO::FETCH_OBJ);
            if (password_verify($password, $user->password) == 1) {
                $expires = date("U") + 1800;
                http_response_code($response_code = 200);
                echo json_encode(
                    array(
                        'token' => $expires,
                        'username' => $user->username,
                        'permission' => 'user',
                        'id' => $user->id,
                    )
                );
            }else{
                echo json_encode(array(
                    'error' => "Wrong password"
                ));
            }
        }
        if ($results2->rowCount() == 1) {
            $user = $results2->fetch(PDO::FETCH_OBJ);
            if (password_verify($password, $user->password) == 1) {
                $expires = date("U") + 1800;
                http_response_code($response_code = 200);
                echo json_encode(
                    array(
                        'token' => $expires,
                        'username' => $user->username,
                        'permission' => 'admin',
                        'id' => $user->id,
                    )
                );
            }
            else{
                echo json_encode(array(
                    'error' => "Wrong password"
                ));
            }
        }
        if ($results3->rowCount() == 1) {
            $user = $results3->fetch(PDO::FETCH_OBJ);
            if (password_verify($password, $user->password) == 1) {
                $expires = date("U") + 1800;
                http_response_code($response_code = 200);
                echo json_encode(
                    array(
                        'token' => $expires,
                        'username' => $user->username,
                        'permission' => 'shop',
                        'id' => $user->id,
                    )
                );
            }
            else{
                echo json_encode(array(
                    'error' => "Wrong password"
                ));
            }
        }
       
        //displaying an error message if there password of username wrongly entered 
        else {
            echo json_encode(
                array('error' => 'Invalid credentials')
            );
        }
    }
}
