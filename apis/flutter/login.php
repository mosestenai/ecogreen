<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
require 'config.php';


    $json = file_get_contents('php://input');
    $data = json_decode($json);

    $username = $_REQUEST['email'];
    $password = $_REQUEST['password'];
   // $password =  $data->password;

   // $username =  $data->email;


    if (empty($username) or empty($password)) {
        //error response code if username and password field is empty
        echo json_encode(array(
            'error' => "Empty email or password"
        ));
    } else {
        $query = "SELECT * FROM users WHERE email='$username' LIMIT 1";
        $query2 = "SELECT * FROM admin WHERE email='$username'";
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
                        'token' => "$expires"
                    )
                );
                exit();
            }else{
                echo json_encode(array(
                    'error' => "Wrong password"
                ));
                exit();
            }
        }
        if ($results2->rowCount() == 1) {
            $user = $results2->fetch(PDO::FETCH_OBJ);
            if (password_verify($password, $user->password) == 1) {
                $expires = date("U") + 1800;
                http_response_code($response_code = 200);
                echo json_encode(
                    array(
                        'token' => "$expires"
                    )
                );
                exit();
            }
            else{
                echo json_encode(array(
                    'error' => "Wrong password"
                ));
                exit();
            }
        }
        if ($results3->rowCount() == 1) {
            $user = $results3->fetch(PDO::FETCH_OBJ);
            if (password_verify($password, $user->password) == 1) {
                $expires = date("U") + 1800;
                http_response_code($response_code = 200);
                echo json_encode(
                    array(
                        'token' => "$expires"
                    )
                );
                exit();
            }
            else{
                echo json_encode(array(
                    'error' => "Wrong password"
                ));
                exit();
            }
        }
       
        //displaying an error message if there password of username wrongly entered 
        else {
            echo json_encode(
                array('error' => 'Invalid credentials')
            );
            exit();
        }
    }
