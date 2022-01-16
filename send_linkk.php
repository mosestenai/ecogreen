<?php error_reporting (E_ALL  ^ E_NOTICE && E_WARNING);?>
<?php

if (isset($_POST["submit_email"])){

 $selector = bin2hex(random_bytes(8));	
 $token = random_bytes(32);
$po = $_SESSION['campus'];
//link to the reset password page and token
 $url = "http://eazistay.herokuapp.com/".$po."/create-new-password.php?selector=" . $selector ."& validator=" . bin2hex($token);
//time at which the token expires
$expires = date("U") + 1800;
//including a file that contains database connection
 require 'config.php';
 
 //fetching the submitted email
 $userEmail = $_POST["email"];
   if (empty($userEmail)) {
  	array_push($errors, "Email field is empty");
  }
if (count($errors) == 0) {

 $sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?";//sql to delete any existing token
 $stmt=$db->prepare($sql);//prepare statement
 $stmt->execute([$userEmail]);//replacing the question mark with the email submitted
 $stmt = null;

 $sql = "INSERT INTO pwdReset(pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?, ?, ?,
 ?)";
 $stmt = $db->prepare($sql);//prepare statement
 $hashedToken = password_hash($token, PASSWORD_DEFAULT,array('cost' => 9));//encrypting the token using default hashing method
 $stmt->execute([$userEmail, $selector, $hashedToken, $expires]);//replacing the four question marks with the values here
 
 $stmt = null;
 
 
 //sending email to the user
 $to = $userEmail;
 
 $subject = 'Reset  password for your account';
 //message to be sent to the user
 $message = '<p>We received a password reset request.The link to reset you password is below,if you did not make
 this request, you can ignore this email</p><br>
 <p>Here is your password reset link: </br>
 <a href="' . $url . '">' . $url . '</a></p>';//link to reset password
 
 $headers = "From: eazistayjagonz@gmail.com>\r\n";//admin email
 $headers .="Reply-To:  eazistayjagonz@gmail.com\r\n";
 $headers .="Content-type: text/html\r\n";//line that allows html to be used in the email
 
 mail($to, $subject, $message, $headers);  //content of the email to be sent to the user
 
 header("Location: reset pass.php?reset=success");//success message to be displayed in the reset password page
 
}
}
?>