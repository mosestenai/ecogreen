
<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
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

        //get inputs
        $username = $data->username;
        $amountt = $data->amount;
        $phoneNumberr = $data->phone;
        $item =  $data->item;
        $phoneNumber = (int)$phoneNumberr;

        if (empty($username) or empty($amountt) or empty($phoneNumber)) {
            echo json_encode(array(
                'error' => "Fill all fields"
            ));
        } else {

            $gg = substr($phoneNumber, 0, 4);
            if ($gg != +2547) {
                echo json_encode(array(
                    'error' => "You must begin +2547"
                ));
            } elseif (strlen($phoneNumber) < 12) {
                echo json_encode(array(
                    'error' => "Invalid phone number"
                ));
            } else {
                $am = substr($amountt, 0,-3);
                $amount = (int)$am;
                $url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';

                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, $url);
                //$credentials = base64_encode('UrsGc9lFwXGkkhALW6v2mOdJ3pJpAWBD:yLvuma0CU4YOPD0w');
                $credentials = base64_encode('tiYhiP7nH1A1vhZn3IjmevWunfGWZpGg:KFIPQo6INJ31afWi');
                curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Basic ' . $credentials)); //setting a custom header
                curl_setopt($curl, CURLOPT_HEADER, false);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

                $curl_response = curl_exec($curl);

                $responce = json_decode($curl_response)->access_token;
                //dd($responce["access_token"]);
                //dd($responce->access_token);
                $accessToken = $responce; // access token here


                //mpesa user credentials
                $mpesaOnlineShortcode = "174379";
                $BusinessShortCode = $mpesaOnlineShortcode;
                $partyA = $phoneNumber;
                $partyB = $BusinessShortCode;
                $phoneNumber = $partyA;
                $mpesaOnlinePasskey = "bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919";
                date_default_timezone_set('Africa/Nairobi');
                $timestamp =  date('YmdHis');
                $dataToEncode = $BusinessShortCode . $mpesaOnlinePasskey . $timestamp;
                //dd($dataToEncode);
                $password = base64_encode($dataToEncode);
                //dd($password);

                //payment request to safaricom

                $url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';

                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, $url);
                curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Authorization:Bearer ' . $accessToken)); //setting custom header


                $curl_post_data = array(
                    //Fill in the request parameters with valid values
                    'BusinessShortCode' => $BusinessShortCode,
                    'Password' => $password,
                    'Timestamp' => $timestamp,
                    'TransactionType' => 'CustomerPayBillOnline',
                    'Amount' => $amount,
                    'PartyA' => $partyA,
                    'PartyB' => $partyB,
                    'PhoneNumber' => $phoneNumber,
                    'CallBackURL' => 'https://ecogreenapp.herokuapp.com/apis/complete_transaction_api.php?token=Mk087308&username=' . $username.'&item='.$item,
                    'AccountReference' => 'ECOGREEN',
                    'TransactionDesc' => 'PAYING ITEM PRICE FOR ECOGREEN'
                );

                $data_string = json_encode($curl_post_data);

                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_POST, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

                $curl_response = curl_exec($curl);
                // print_r($curl_response);
                $dataa = json_decode($curl_response);
                $response = $dataa->ResponseCode;
                //return($curl_response);
                $df = $curl_response;
                if ($response == 0) {
                    echo json_encode(array(
                        'error' => $curl_response
                    ));
            
                } else {
                    echo json_encode(array(
                        'error' => "There was an error processing your request.Try again later"
                    ));
                }
            }
        }
    }
}
?>
