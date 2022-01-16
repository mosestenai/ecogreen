
<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
//including a file that contains database connection
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

        $selector = bin2hex(random_bytes(8));
        $token = random_bytes(32);
        //link to the reset password page and token
        $url = "https://ecogreenapp.herokuapp.com/create_new_password.php?selector=" . $selector . "&validator=" . bin2hex($token);
        //time at which the token expires
        $expires = date("U") + 1800;


        //fetching the submitted email
        $userEmail = $data->email;
        if (empty($userEmail)) {
            echo json_encode(array(
                'error' => "Email field is empty"
            ));
        }
        if (count($errors) == 0) {

            $sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?"; //sql to delete any existing token
            $stmt = $db->prepare($sql); //prepare statement
            $stmt->execute([$userEmail]); //replacing the question mark with the email submitted
            $stmt = null;

            $sql = "INSERT INTO pwdReset(pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?, ?, ?,
                    ?)";
            $stmt = $db->prepare($sql); //prepare statement
            $hashedToken = password_hash($token, PASSWORD_DEFAULT, array('cost' => 9)); //encrypting the token using default hashing method
            $stmt->execute([$userEmail, $selector, $hashedToken, $expires]); //replacing the four question marks with the values here

            $stmt = null;


            //sending email


            require 'vendor/autoload.php'; // If you're using Composer (recommended)
            // Comment out the above line if not using Composer
            //require("sendgrid/sendgrid-php.php");
            // If not using Composer, uncomment the above line and
            // download sendgrid-php.zip from the latest release here,
            // replacing <PATH TO> with the path to the sendgrid-php.php file,
            // which is included in the download:
            // https://github.com/sendgrid/sendgrid-php/releases
            $API_KEY = "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";
            $email = new \SendGrid\Mail\Mail();
            $email->setFrom("ecogreen@gmail.com", "ecogreen.com");
            $email->setSubject("Reset your password");
            $email->addTo($userEmail, $userEmail);
            $email->addContent("text/plain", "Ecogreen reset password email");
            $email->addContent(
                "text/html",
                "<p>We received a password reset request.The link to reset you password is below,if you did not make
                this request, you can ignore this email</p><br>
                <font color='red'>*Note</font> the link expires after 30 minutes since the reset password request was made
                <p>Here is your password reset link: <br>
                <a href= $url > $url  </a></p>"
            );

            $sendgrid = new \SendGrid($API_KEY);

            if ($sendgrid->send($email)) {
                echo json_encode(array(
                    'error' => "Success"
                )); //success message to be displayed in the reset password page
            }
        }
    }
}
?>