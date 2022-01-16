<?php error_reporting(E_ALL  ^ E_NOTICE && E_WARNING); ?>
<?php include('reset_linkk.php') ?>
<html>

<head>
    <title>create#ne%pass</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <h1 align="middle">
        <font color="navy">ECOGREEN</font>
    </h1><br><br>

    <?php
    $selector = $_GET["selector"]; //getting the token(selector and validator) inside the url
    $validator = $_GET["validator"];
    //checking if there exist a token
    if (empty($selector) || empty($validator)) {
        echo '<h3 align="middle"><font color="blue">could not validate your requests</font></h3>';
    } //checking if the tokens are legit
    else {
        if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false) {
    ?>
            <form action="create-new-password.php" method="post">
                <?php include('errors.php'); ?>
                <input type="hidden" name="selector" value="<?php echo $selector ?>">
                <input type="hidden" name="validator" value="<?php echo $validator ?>">
                <div class="input-group">
                    <label>
                        <font color="black">Enter your new password</font>
                    </label>
                    <input type="password" name="pwd" placeholder="Enter a new password,,"><br>
                    <label>
                        <font color="black">Repeat your new password</font>
                    </label>
                    <input type="password" name="pwd-repeat" placeholder="Repeat new password,,">
                </div>
                <button type="submit" class="loginbtn" name="reset-linkk-submit">Reset password</button>
            </form>
    <?php
        }
    }

    ?>
    </form>