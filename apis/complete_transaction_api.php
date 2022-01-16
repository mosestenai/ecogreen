<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
require 'config.php';

if (!isset($_GET["token"])) {
    echo "Technical error";
    exit();
} else {
    if ($_GET["token"] != 'Mk087308') {
        echo "invalid authorisation";
    } else {
        if (!$request = file_get_contents('php://input')) {
            echo "invalid input";
            exit();
        } else {
            $json = file_get_contents('php://input');
            $data = json_decode($json, true);
            $username = $_REQUEST['username'];
            $item = $_GET['item'];

            $usertable = str_replace(' ', '', $username); //remove white spaces from the username

            $MerchantRequestID = $data['Body']['stkCallback']['MerchantRequestID'];
            $CheckoutRequestID = $data['Body']['stkCallback']['CheckoutRequestID'];
            $ResultCode = $data['Body']['stkCallback']['ResultCode'];
            $ResultDesc =  $data['Body']['stkCallback']['ResultDesc'];
            $Amount =  $data['Body']['stkCallback']['CallbackMetadata']['Item']['0']['Value'];
            $MpesaReceiptNumber =  $data['Body']['stkCallback']['CallbackMetadata']['Item']['1']['Value'];
            $TransactionDate = $data['Body']['stkCallback']['CallbackMetadata']['Item']['3']['Value'];
            $PhoneNumber = $data['Body']['stkCallback']['CallbackMetadata']['Item']['4']['Value'];

            date_default_timezone_set("Africa/Nairobi");
            $date = date("d/m/Y");

            $sql = "INSERT INTO $usertable (Amount,MpesaReceiptNumber,TransactionDate,PhoneNumber,item)  
            VALUES  ( '$Amount','$MpesaReceiptNumber', '$date', '$PhoneNumber','$item')";

            $db->query($sql) or die($db->error);
            /*echo
    '{"ResultCode":0,"ResultDesc":"Confirmation received successfully"}';*/
            exit();
        }
    }
}
