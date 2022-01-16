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
        // Access forbidden 
        http_response_code($response_code = 403);
    } else {
        $json = file_get_contents('php://input');
        $data = json_decode($json);


        $password_1 =  $data->password;
        $username =  $data->username;
        $email = $data->email;
        $location = $data->location;

        if (empty($username) or empty($password_1) or empty($email) or empty($location)) {
            //error message if any field is empty
            echo json_encode(array(
                'error' => "Fill all fields"
            ));
        } else {

            // first check the database to make sure 
            // a user does not already exist with the same username and/or email
            $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
            $result = $db->query($user_check_query);
            if ($result->rowCount() > 0) {
                $user = $result->fetch(PDO::FETCH_OBJ);


                if ($user) { // if user exists
                    if ($user->username == $username) {
                        echo json_encode(array(
                            'error' => "username already exits"
                        ));
                    }

                    if ($user->email == $email) {
                        echo json_encode(array(
                            'error' => "email already exits"
                        ));
                    }
                }
            } else {
                $usertable = str_replace(' ', '', $username); //remove white spaces from the username
                $password = password_hash($password_1, PASSWORD_DEFAULT, array('cost' => 9)); //encrypt the password before saving in the database
                $query = "INSERT INTO  users (username,email,password,location) VALUES('$username','$email','$password','$location')";
                /* $query2 = "CREATE TABLE $usertable (id SERIAL , message VARCHAR(100) ,client VARCHAR(50) ,
                        comment VARCHAR(255),sender VARCHAR(255) ,date VARCHAR(255) ,time VARCHAR(255))";
                $db->query($query2) or die($db->error);*/
                $db->query($query) or die($db->error);
                $expires = date("U") + 1800;
                echo json_encode(
                    array(
                        'token' => $expires,
                        'username' => $username,
                        'permission' => 'user',
                        'id' => 'null'
                    )
                );
            }
        }
    }
}
