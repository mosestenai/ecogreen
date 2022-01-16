<?php
require 'config.php'; //including database connection file

//checking if the submit button in the create new password file was clicked
if (isset($_POST["reset-linkk-submit"])) {
  $selector = $_POST["selector"];
  $validator = $_POST["validator"];
  $password = $_POST["pwd"];
  $passwordRepeat = $_POST["pwd-repeat"];

  if (empty($password) || empty($passwordRepeat)) {
    array_push($errors, "Password field is empty");
  } elseif ($password != $passwordRepeat) {
    array_push($errors, "The two passwords do not match");
  }
  if (count($errors) == 0) {
    //checking if token has expired
    $currentDate = date("U");


    //sql statement to select the actual token
    $sql = "SELECT * FROM pwdReset WHERE pwdResetSelector=? AND pwdResetExpires <= ?";
    $stmt = $db->prepare($sql); //prepare statement
    $stmt->execute([$selector, $currentDate]); //replacing the question mark with the selector

    //fetch row that contains the token and stores inside associative array
    if ($stmt->rowCount() == 0) {
      echo '<h3 align="middle"><font color="blue">You need to re-submit your reset request.</font></h3';
    } //match the token from the form and that from the database
    else {
      $row = $stmt->fetch(PDO::FETCH_OBJ);
      //convert validator token from hexadecimal to binary
      $tokenBin = hex2bin($validator);
      $tokenCheck = password_verify($tokenBin, $row->pwdResetToken);

      if ($tokenCheck === false) {
        echo '<h3 align="middle"><font color="blue">You need to re-submit your reset request.</font></h3';
      } // uodate the user credentials
      elseif ($tokenCheck === true) {

        $tokenEmail = $row->pwdRestEmail;
        $sql = "SELECT * FROM students WHERE email=?;";
        $stmt = $db->prepare($sql);
        $stmt->execute([$tokenEmail]);

        if ($stmt->rowCount() == 0) {
          echo '<h3 align="middle"><font color="blue">There was an error!!</font></h3>';
        } else {
          $po = $_SESSION['campus'];
          $sql = "UPDATE students SET password=? WHERE email=?";
          $stmt = $db->prepare($sql);

          //encrypting the password that wa reset by the user
          $newPwdHash = password_hash($password, PASSWORD_DEFAULT, array('cost' => 9));
          $stmt->execute([$newPwdHash, $tokenEmail]);

          $sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?"; //sql to delete any existing token
          $stmt = $db->prepare($sql); //prepare statement

          $stmt->execute([$tokenEmail]); //replacing the question mark in sql before executing the statement
         // header("Location: login.php?newpwd=passwordupdated");
         array_push($errors, "Password reset successful.Proceed to the app to login");
        }
      }
    }
  }
}
