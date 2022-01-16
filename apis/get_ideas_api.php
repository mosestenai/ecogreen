<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
require 'config.php';

    $token = $_REQUEST['5$fgk'];
    if (empty($token)) {
        //returning a an error response code if a request is made without a validation token (UNAUTHORISED REQUEST)
        http_response_code($response_code = 401);
    } else {

        $name= $_REQUEST['name'];

        if(empty($name)){
             //fetching all records in the database ideas table
        $query = "SELECT * FROM ideas ";
        $result = $db->query($query);
        if ($result->rowCount() > 0) {
            if ($result = $db->query($query)) {
                $posts_arr = array();
                $posts_arr = array();
                while ($user = $result->fetch(PDO::FETCH_OBJ)) {
                    $post_item = array(
                        'heading' => $user->heading,
                        'description' => $user->description,
                        'link' => $user->link,
                        'phone' => $user->phone,
                        'url' => $user->url,
                    );
                    //echo json_encode($post_item,);
                    array_push($posts_arr, $post_item);
                }
                echo json_encode($posts_arr);
            }
        } else {
            //resource not found
            http_response_code($response_code = 404);
        }
        }else{
            $query = "SELECT * FROM ideas WHERE heading LIKE '%$name%'";
            $result = $db->query($query);
            if ($result->rowCount() > 0) {
                if ($result = $db->query($query)) {
                    $posts_arr = array();
                    $posts_arr = array();
                    while ($user = $result->fetch(PDO::FETCH_OBJ)) {
                        $post_item = array(
                            'heading' => $user->heading,
                            'description' => $user->description,
                            'link' => $user->link,
                            'phone' => $user->phone,
                            'url' => $user->url,
                        );
                        //echo json_encode($post_item,);
                        array_push($posts_arr, $post_item);
                    }
                    echo json_encode($posts_arr);
                }
            } else {
                //resource not found
                http_response_code($response_code = 404);
            }

        }




        //fetching all records in the database ideas table
       
    }

