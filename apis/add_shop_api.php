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


        $password_1 =  $data->password;
        $username =  $data->username;
        $name = $data->name;
        $description =  $data->description;
        $phone =  $data->phone;
        $location =  $data->location;
        $paybill =  $data->paybill;
        $date = $data->date;
        $url =  $data->url;


        if (empty($username) or empty($password_1) or empty($name) or empty($description) or empty($phone) or empty($location) or empty($paybill)) {
            //error message when any field is empty
            echo json_encode(array(
                'error' => "Fill all fields"
            ));
        } else {

            // first check the database to make sure 
            // a user does not already exist with the same username and/or email
            $user_check_query = "SELECT * FROM shops WHERE username='$username'  LIMIT 1";
            $result = $db->query($user_check_query);
            if ($result->rowCount() > 0) {
                $user = $result->fetch(PDO::FETCH_OBJ);


                if ($user) { // if user exists
                    if ($user->username == $username) {
                        echo json_encode(array(
                            'error' => "username already exits"
                        ));
                    }
                }
            } else {
                $usertable = str_replace(' ', '', $username); //remove white spaces from the username
                $shop = strtoupper($name); //Change shop name to uppercase
                $password = password_hash($password_1, PASSWORD_DEFAULT, array('cost' => 9)); //encrypt the password before saving in the database
                $query = "INSERT INTO  shops (username,date,password,location,shop,phone,status,description,paybill,profile_url) 
                        VALUES ('$username','$date','$password','$location','$shop','$phone','Approved','$description','$paybill','$url')";
                $query2 = "CREATE TABLE $usertable (id SERIAL , MpesaReceiptNumber VARCHAR(100) ,TransactionDate VARCHAR(50) ,
                            PhoneNumber VARCHAR(255) ,Amount VARCHAR(255),item VARCHAR(255))";
                $db->query($query2) or die($db->error);
                $db->query($query);

                echo json_encode(
                    array(
                        'error' => "Success" //return successs message as an error after a successful insertion in the database
                    )
                );
            }
        }
    }
}
