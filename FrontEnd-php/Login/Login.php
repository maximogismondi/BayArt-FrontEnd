<!DOCTYPE HTML>  
<html>
<head>
    <title>BayArt! - Login</title>
    <link rel="shortcut icon" href="../icons/icon-login.png"/>
    <link rel="stylesheet" href="styles-login.css">
    <link rel="stylesheet" href="../styles-general.css">
    <meta http-equiv="Content-Type" content=”text/html; charset=UTF-8″ />
    <meta name="viewport" content="width=device-width, user-scalable=no">
</head>
<body>  

<?php

include "../php-functions.php";

session_start();


$_SESSION["idUser"] = -1;

// define variables and set to empty values
$nameErr = $passwordErr = $logInErr = "";
$name = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" /*&& !$_SESSION["newsession"]*/) {

    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = test_input($_POST["name"]);

    if (!preg_match("/^[a-zA-Z0-9' ]*$/",$name)) {
        $nameErr = "Only letters and white space allowed";
        }
    }
    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
    } else {
        $password = test_input($_POST["password"]);

        if(strlen($password) < 8){
            $passwordErr = "Password need more than 8 caracters";
        } else {
            if (!preg_match("/^[a-zA-Z0-9' ]*$/",$password)) {
                $passwordErr = "Only letters and white space allowed";
            }
        }
    }
    
    if($nameErr == "" && $passwordErr == ""){
        /*
        API

        $API_URL = "/logIn/" . $name . "/" . $password;
        $jsonRes = getUrl(API_URL);
        $resultado = json_decode($jsonRes, true);

        if(http_response_code() == 200){ // ok
            $_SESSION["idUser"] = $resultado["idUser"];
        } else {
            $logInErr = "F";
        }
        */

        header('Location: '. "../homepage/homepage.php");
    }
    
}

?>
<div id="div-login">

    <!--Logo-->

    <div id="div-logo">
        <img id="img-logo" src="../icons/logo.png">
    </div>

    <form method="post" id="form-login" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
        <span class="error"> <?php echo $logInErr;?></span>
        <div id="div-username">
            <input type="text" name="name" placeholder="Username" class="input-login" value="<?php echo $name;?>">
        </div>
        <span class="error"> <?php echo $nameErr;?></span>
        <div id="div-password">
            <input type="password" name="password" placeholder="Password" class="input-login" id="input-password" value="<?php echo $password;?>">
            <img id="img-eye" src="../icons/open-eye.png" onclick="showPassword();">
        </div>
        <span class="error"> <?php echo $passwordErr;?></span>
        <div id="div-log-in-register">
            <button id="button-submit" type="submit" name="submit" value="Submit">LOG IN</button>
            <a id="a-register" href="../Register/Register.php">Register into BayArt!</a>
        </div>  
    </form>
</div>
</div>
  <!--Waves Container-->
    <div id="div-waves">
        <svg id="svg-waves" 
        viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
            <defs>
                <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
            </defs>
            <g class="parallax">
                <use xlink:href="#gentle-wave" x="48" y="0" fill="#674ea7" />
                <use xlink:href="#gentle-wave" x="48" y="3" fill="#00a797" />
            </g>
        </svg>
    </div>
  <!--Waves end-->

</body>
    <script src="../jquery.js"></script>
    <script src="../basic-functions.js"></script>
</html>