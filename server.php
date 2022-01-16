<?php error_reporting(E_ALL ^ E_NOTICE); ?>
<?php
session_start();
// including database connection file
require 'config.php';
// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = ($_POST['username']);
  $email = ($_POST['email']);
  $password_1 = ($_POST['password_1']);
  $password_2 = ($_POST['password_2']);
  $location = $_POST['location'];

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) {
    array_push($errors, "Username is required");
  }
  if (empty($email)) {
    array_push($errors, "Email is required");
  }
  if (empty($password_1)) {
    array_push($errors, "Password is required");
  }
  if ($location == 'LOCATION') {
    array_push($errors, "Specify your location");
  }
  if ($password_1 != $password_2) {
    array_push($errors, "Passwords do not match");
  }


  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = $db->query($user_check_query);
  $user = $result->fetch(PDO::FETCH_OBJ);


  if ($user) { // if user exists
    if ($user->username == $username) {
      array_push($errors, "Username already exists");
    }

    if ($user->email == $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
    $usertable = str_replace(' ', '', $username);
    $password = password_hash($password_1, PASSWORD_DEFAULT, array('cost' => 9)); //encrypt the password before saving in the database
    $query = "INSERT INTO users (username, email, password,location) 
  			  VALUES('$username', '$email', '$password','$location')";
    $query2 = "CREATE TABLE $usertable (id SERIAL , message VARCHAR(100) ,client VARCHAR(50) ,
  comment VARCHAR(255),sender VARCHAR(255) ,date VARCHAR(255) ,time VARCHAR(255))";
    $db->query($query2) or die($db->error);
    $db->query($query);
    $_SESSION['username'] = $username;
    $_SESSION['success'] = "You are now logged in";
    header('location: all.php');
  }
}

//login user
//checking if the user has entered both the username and password
if (isset($_POST['login_user'])) {
  $username = ($_POST['username']);
  $password = ($_POST['password']);
  //displaying an error message when a fied is empty
  if (empty($username)) {
    array_push($errors, "Username is required");
  }
  if (empty($password)) {
    array_push($errors, "Password is required");
  }
  //checking in the database if the username and paaword exists
  if (count($errors) == 0) {
    $query = "SELECT * FROM users WHERE username='$username' LIMIT 1";
    $query2 = "SELECT * FROM admin WHERE username='$username'";
    $query3 = "SELECT * FROM shops WHERE username='$username'";
    $results = $db->query($query);
    $results2 = $db->query($query2);
    $results3 = $db->query($query3);

    if ($results2->rowCount() == 1) {
      $user = $results2->fetch(PDO::FETCH_OBJ);
      if (password_verify($password, $user->password) == 1) {
        $_SESSION['username'] = $username;
        $_SESSION['success'] = "You are now logged in";
        header('location: admin.php');
      }
    }
    if ($results->rowCount() == 1) {
      $user = $results->fetch(PDO::FETCH_OBJ);
      if (password_verify($password, $user->password) == 1) {
        $_SESSION['username'] = $username;
        $_SESSION['success'] = "You are now logged in";
        header('location: all.php');
      }
    }
    if ($results3->rowCount() == 1) {
      $user = $results3->fetch(PDO::FETCH_OBJ);
      if (password_verify($password, $user->password) == 1) {
        $_SESSION['username'] = $username;
        $_SESSION['success'] = "You are now logged in";
        header('location: shopowner.php');
      }
    } else {
      array_push($errors, "Wrong username/password");
    }
  }
}

//add a shop
if (isset($_POST['reg_shop'])) {
  $username = ($_POST['username']);
  $date = ($_POST['date']);
  $password_1 = ($_POST['password_1']);
  $password_2 = ($_POST['password_2']);
  $location = $_POST['location'];
  $description = $_POST['description'];
  $shop = $_POST['shop'];
  $phone = $_POST['phone'];

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) {
    array_push($errors, "Username is required");
  }
  if (empty($shop)) {
    array_push($errors, "Shop name is required");
  }
  if (empty($description)) {
    array_push($errors, "Shop description  is required");
  }
  if (empty($password_1)) {
    array_push($errors, "Password is required");
  }
  if ($location == 'LOCATION') {
    array_push($errors, "Specify your location");
  }
  if ($password_1 != $password_2) {
    array_push($errors, "Passwords do not match");
  }

  $user_check_query = "SELECT * FROM shops WHERE username='$username' ";
  $result = $db->query($user_check_query);
  $user = $result->fetch(PDO::FETCH_OBJ);


  if ($user) { // if user exists
    if ($user->username == $username) {
      array_push($errors, "Username already exists");
    }
  }
  if (count($errors) == 0) {
    $password = password_hash($password_1, PASSWORD_DEFAULT, array('cost' => 9)); //encrypt the password before saving in the database
    $usertable = str_replace(' ', '', $username);
    $shopp = strtoupper($shop);
    $query = "INSERT INTO shops (username,date,password,location,shop,phone,status,description) VALUES ('$username','$date','$password','$location','$shopp','$phone','Approved','$description')";
    $query2 = "CREATE TABLE $usertable (id SERIAL , message VARCHAR(100) ,client VARCHAR(50) ,
  comment VARCHAR(255) ,sender VARCHAR(255) ,date VARCHAR(255) ,time VARCHAR(255), url varchar(255), description varchar(5000),price varchar(255),item varchar(255) )";
    $db->query($query2) or die($db->error);
    $db->query($query);

    array_push($errors, "ADDED SUCCESSFULLY");
  }
}

//post an item
if (isset($_POST['post_item'])) {
  $item = ($_POST['item']);
  $description = ($_POST['description']);
  $price = $_POST['price'];
  $ts = $_SESSION['username'];
  $usertable = str_replace(' ', '', $ts);
  if (empty($item)) {
    array_push($errors, "item name is required");
  }
  if (empty($description)) {
    array_push($errors, "description is required");
  }

  if (count($errors) == 0) {
    $target_dir = "images/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    //check if image is actual image or fake image 

    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
    } else {
      echo "File is not an image.";
      $uploadOk = 0;
    }


    //check file size
    if ($_FILES["fileToUpload"]["size"] > 700000) {
      echo "Sorry ,your file is too large.";
      $uploadOk = 0;
    }

    //ALLOW CERTAIN FILE FORMATS
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
      echo "Only JPG,JPEG,PNG & GIF files are allowed.";
      $uploadOk = 0;
    }

    //check if $upload ok is set to 0 by an error
    if ($uploadOk == 0) {
      echo "Sorry your file was not uploaded.";
      //if everything is ok
    } else {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

        $query = "INSERT INTO items (item,description,url,price,status,username) VALUES ('$item','$description','$target_file','$price','approved','$ts')";
        $db->query($query) or die($db->error);
        array_push($errors, "succesfully posted");
      }
    }
  }
}

//ADD A COLLECTION CENTRE
if (isset($_POST['reg_centre'])) {
  $centre = ($_POST['centre']);
  $description = ($_POST['description']);
  $location = $_POST['location'];
  $contact = $_POST['contact'];
  $type = $_POST['type'];

  //error reporting
  if (empty($centre)) {
    array_push($errors, "centre  name is required");
  }
  if (empty($description)) {
    array_push($errors, "description is required");
  }
  if (empty($contact)) {
    array_push($errors, "contact is required");
  }
  if ($location == 'LOCATION') {
    array_push($errors, "specify your centre's location");
  }
  if ($type == 'TYPE') {
    array_push($errors, "specify your centre's type");
  }

  //inserting into the database
  if (count($errors) == 0) {
    $query = "INSERT INTO centres (centre,description,location,contact,type) VALUES('$centre','$description','$location','$contact','$type')";
    $db->query($query);
    header('location: collection.php');
  }
}


//add a shop
if (isset($_POST['reg_shops'])) {
  $date = ($_POST['date']);
  $location = $_POST['location'];
  $description = $_POST['description'];
  $shop = $_POST['shop'];
  $phone = $_POST['phone'];
  $df = $_SESSION['username'];
  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($shop)) {
    array_push($errors, "Shop name is required");
  }
  if (empty($description)) {
    array_push($errors, "Shop description  is required");
  }
  if ($location == 'LOCATION') {
    array_push($errors, "Specify your location");
  }
  if (empty($phone)) {
    array_push($errors, "enter your contact");
  }


  if (count($errors) == 0) {
    $target_dir = "images/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    //check if image is actual image or fake image 

    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
    } else {
      echo "File is not an image.";
      $uploadOk = 0;
    }


    //check file size
    if ($_FILES["fileToUpload"]["size"] > 700000) {
      echo "Sorry ,your file is too large.";
      $uploadOk = 0;
    }

    //ALLOW CERTAIN FILE FORMATS
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
      echo "Only JPG,JPEG,PNG & GIF files are allowed.";
      $uploadOk = 0;
    }

    //check if $upload ok is set to 0 by an error
    if ($uploadOk == 0) {
      echo "Sorry your file was not uploaded.";
      //if everything is ok
    } else {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

        $shopp = strtoupper($shop);
        $query = "INSERT INTO shops (username,date,location,shop,phone,status,description,url) VALUES ('$df','$date','$location','$shopp','$phone',' ','$description','$target_file')";
        $db->query($query);
        header('location: additem.php');
      }
    }
  }
}



//SHOP OWNER ACCOUNT SETTINGS
if (isset($_POST['changeusername'])) {
  $username = $_POST['username'];
  $fg = $_SESSION['username'];
  $usertable = str_replace(' ', '', $fg);
  $gh = str_replace(' ', '', $username);
  $sql = "UPDATE shops SET username='$username' WHERE username='$fg'";
  $query = "ALTER TABLE $usertable RENAME TO $gh";
  $db->query($query);
  $db->query($sql);
  header('location: login.php');
}

if (isset($_POST['changeprofile'])) {
  $target_dir = "images/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
  //check if image is actual image or fake image 

  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if ($check !== false) {
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }


  //check file size
  if ($_FILES["fileToUpload"]["size"] > 700000) {
    echo "Sorry ,your file is too large.";
    $uploadOk = 0;
  }

  //ALLOW CERTAIN FILE FORMATS
  if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
    echo "Only JPG,JPEG,PNG & GIF files are allowed.";
    $uploadOk = 0;
  }

  //check if $upload ok is set to 0 by an error
  if ($uploadOk == 0) {
    echo "Sorry your file was not uploaded.";
    //if everything is ok
  } else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      $fg = $_SESSION['username'];
      $query = "UPDATE shops SET profile_url='$target_file' WHERE username='$fg'";
      $db->query($query);
      header('location: account.php');
    }
  }
}

if (isset($_POST['changepassword'])) {
  $password_1 = ($_POST['password_1']);
  $password_2 = ($_POST['password_2']);
  $fg = $_SESSION['username'];
  if ($password_1 != $password_2) {
    echo "the two passwords do not match";
  } else {
    $password = password_hash($password_1, PASSWORD_DEFAULT, array('cost' => 9)); //encrypt the password before saving in the database
    $query = "UPDATE shops SET password='$password' WHERE username='$fg'";
    $db->query($query);
    header('location: login.php');
  }
}

//USERS ACCOUNT SETTINGS
if (isset($_POST['changeusernamee'])) {
  $username = $_POST['username'];
  $fg = $_SESSION['username'];
  $usertable = str_replace(' ', '', $fg);
  $gh = str_replace(' ', '', $username);
  $sql = "UPDATE users SET username='$username' WHERE username='$fg'";
  $query = "ALTER TABLE $usertable RENAME TO $gh";
  $db->query($query);
  $db->query($sql);
  header('location: login.php');
}

if (isset($_POST['changeprofilee'])) {
  $target_dir = "images/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
  //check if image is actual image or fake image 

  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if ($check !== false) {
    echo "attach a file";
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }


  //check file size
  if ($_FILES["fileToUpload"]["size"] > 700000) {
    echo "Sorry ,your file is too large.";
    $uploadOk = 0;
  }

  //ALLOW CERTAIN FILE FORMATS
  if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
    echo "Only JPG,JPEG,PNG & GIF files are allowed.";
    $uploadOk = 0;
  }

  //check if $upload ok is set to 0 by an error
  if ($uploadOk == 0) {
    echo "Sorry your file was not uploaded.";
    //if everything is ok
  } else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      $fg = $_SESSION['username'];
      $query = "UPDATE shops SET profile_url='$target_file' WHERE username='$fg'";
      $query2 = "UPDATE users SET profile_url='$target_file' WHERE username='$fg'";
      $db->query($query);
      $db->query($query2);
      header('location: account2.php');
    }
  }
}


if (isset($_POST['changepasswordd'])) {
  $password_1 = ($_POST['password_1']);
  $password_2 = ($_POST['password_2']);
  $fg = $_SESSION['username'];
  if ($password_1 != $password_2) {
    echo "the two passwords do not match";
  } else {
    $password = password_hash($password_1, PASSWORD_DEFAULT, array('cost' => 9)); //encrypt the password before saving in the database
    $query = "UPDATE users SET password='$password' WHERE username='$fg'";
    $db->query($query);
    header('location: account2.php');
  }
}

//post an idea
if (isset($_POST['reg_idea'])) {
  $heading = $_POST['heading'];
  $description = $_POST['description'];
  $link = $_POST['link'];
  $phone = $_POST['phone'];

  // by adding (array_push()) corresponding error unto $errors array
  if (empty($heading)) {
    array_push($errors, "insert a heading");
  }
  if (empty($description)) {
    array_push($errors, "idea description  is required");
  }
  if (empty($phone)) {
    array_push($errors, "enter your contact");
  }

  $target_dir = "images/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
  //check if image is actual image or fake image 

  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if ($check !== false) {
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }


  //check file size
  if ($_FILES["fileToUpload"]["size"] > 700000) {
    echo "Sorry ,your file is too large.";
    $uploadOk = 0;
  }

  //ALLOW CERTAIN FILE FORMATS
  if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
    echo "Only JPG,JPEG,PNG & GIF files are allowed.";
    $uploadOk = 0;
  }

  //check if $upload ok is set to 0 by an error
  if ($uploadOk == 0) {
    echo "Sorry your file was not uploaded.";
    //if everything is ok
  } else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      $query = "INSERT INTO ideas (heading,description,link,phone,url) VALUES ('$heading','$description','$link','$phone','$target_file')";

      $db->query($query);
      header('location: ideas.php');
    }
  }
}

//post an event
if (isset($_POST['reg_event'])) {
  $heading = $_POST['heading'];
  $description = $_POST['description'];
  $phone = $_POST['phone'];
  $location = $_POST['location'];

  // by adding (array_push()) corresponding error unto $errors array
  if (empty($heading)) {
    array_push($errors, "insert a heading");
  }
  if (empty($description)) {
    array_push($errors, "Event description  is required");
  }
  if (empty($phone)) {
    array_push($errors, "enter your contact");
  }
  if (empty($location)) {
    array_push($errors, "enter events location");
  }

  $target_dir = "images/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
  //check if image is actual image or fake image 

  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if ($check !== false) {
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }


  //check file size
  if ($_FILES["fileToUpload"]["size"] > 700000) {
    echo "Sorry ,your file is too large.";
    $uploadOk = 0;
  }

  //ALLOW CERTAIN FILE FORMATS
  if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
    echo "Only JPG,JPEG,PNG & GIF files are allowed.";
    $uploadOk = 0;
  }

  //check if $upload ok is set to 0 by an error
  if ($uploadOk == 0) {
    echo "Sorry your file was not uploaded.";
    //if everything is ok
  } else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      $query = "INSERT INTO events (heading,description,phone,url,location) VALUES ('$heading','$description','$phone','$target_file','$location')";

      $db->query($query);
      header('location: events.php');
    }
  }
}
?>