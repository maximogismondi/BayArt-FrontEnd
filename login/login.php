<!DOCTYPE HTML>
<html>

<head>
    <title>BayArt! - Login</title>
    <link rel="shortcut icon" href="../icons/icon-viewer.png" />
    <link rel="stylesheet" href="styles-login.css">
    <link rel="stylesheet" href="../styles-general.css">
    <meta http-equiv="Content-Type" content=”text/html; charset=UTF-8″ />
    <meta name="viewport" content="width=device-width, user-scalable=no">
</head>

<body>

    <?php

    include "../php-functions.php";

    session_start();

    $_SESSION["profileImage"] = null;

    $_SESSION["userType"] = null;
    $_SESSION["idUser"] = null;
    $_SESSION["username"] = null;
    $_SESSION["email"] = null;
    $_SESSION["password"] = null;
    $_SESSION["bpoints"] = null;
    $_SESSION["srcProfilePicture"] = null;
    $_SESSION["srcBanner"] = null;
    $_SESSION["notificationsNewPublication"] = null;
    $_SESSION["notificationsBuyAlert"] = null;
    $_SESSION["notificationsInformSponsor"] = null;
    $_SESSION["idUser"] = null;
    $_SESSION["notificationsInformSponsor"] = null;
    $_SESSION["notificationsNewPublication"] = null;

    //--------

    $_SESSION["maxIndex"] = null;

    // define variables and set to empty values
    $nameErr = $passwordErr = $logInErr = "";
    $name = $password = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (empty($_POST["name"])) {
            $nameErr = "Name is required";
        } else {
            $name = test_input($_POST["name"]);

            if (strlen($name) < 8) {
                $nameErr = "Name be over 8 caracters";
            } else {
                if (strlen($name) > 20) {
                    $nameErr = "Name need be under 20 caracters";
                } else {
                    if (!preg_match("/^[a-zA-Z0-9' ]*$/", $name)) {
                        $nameErr = "Only letters and numbers allowed";
                    }
                }
            }
        }

        if (empty($_POST["password"])) {
            $passwordErr = "Password is required";
        } else {
            $password = test_input($_POST["password"]);

            if (strlen($password) < 8) {
                $passwordErr = "Password be over 8 caracters";
            } else {
                if (strlen($password) > 20) {
                    $passwordErr = "Password must be under 20 caracters";
                } else {
                    if (!preg_match("/^[a-zA-Z0-9' ]*$/", $password)) {
                        $passwordErr = "Only letters and numbers allowed";
                    }
                }
            }
        }

        if ($nameErr == "" && $passwordErr == "") {
            $API_URL = "http://localhost:8888/api/logIn/" . $name . "/" . $password;
            $res = getUrl($API_URL);
            $status = $res[0];
            $infoResponse = $res[1];
            $resultado = json_decode($infoResponse, true);

            if ($status == 200) { // ok

                $_SESSION["idUser"]          = $resultado["user"]["idUser"];
                $_SESSION["username"]        = $resultado["user"]["username"];
                $_SESSION["email"]           = $resultado["user"]["email"];
                $_SESSION["password"]        = $resultado["user"]["password"];
                $_SESSION["inscriptionDate"] = $resultado["user"]["inscriptionDate"];
                $_SESSION["birthDate"]       = $resultado["user"]["birthDate"];
                $_SESSION["bpoints"]         = $resultado["user"]["bpoints"];
                $_SESSION["notificationsNewPublication"] = $resultado["user"]["notificationsNewPublication"];
                $_SESSION["notificationsBuyAlert"]       = $resultado["user"]["notificationsBuyAlert"];
                $_SESSION["notificationsInformSponsor"]  = $resultado["user"]["notificationsInformSponsor"];
                
                $_SESSION["srcProfilePicture"] = "../images/profileImages/" . $_SESSION["username"] . getExtension($resultado["encodedProfilePicture"][0]);
                saveImage("../images/profileImages/", $_SESSION["username"], $resultado["encodedProfilePicture"]);

                if (sizeof($resultado) == 2) {
                    $_SESSION["userType"]  = "viewer";
                } else {
                    $_SESSION["userType"]  = "artist";
                    $_SESSION["srcBanner"] = "../images/profileBanner/" . $_SESSION["username"] . getExtension($resultado["encodedBanner"][0]);;                    

                    saveImage("../images/profileBanner/", $_SESSION["username"], $resultado["encodedBanner"]);
                }

                header('Location: ' . "../homepage/homepage.php");
            } else {
                $logInErr = "Username or/and Password are incorrect";
            }
        }
    }

    ?>
    <div id="div-login">

        <!--Logo-->

        <div id="div-logo">
            <img id="img-logo" src="../icons/logo.png">
        </div>

        <form method="post" id="form-login" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <span class="error" style="margin-top: 0;"> <?php echo $logInErr; ?></span>
            <div id="div-username">
                <input type="text" name="name" placeholder="Username" class="input-login" value="<?php echo $name; ?>">
            </div>
            <span class="error"> <?php echo $nameErr; ?></span>
            <div id="div-password">
                <img id="img-eye" src="../icons/open-eye.png">
                <input type="password" name="password" placeholder="Password" class="input-login" id="input-password" value="<?php echo $password; ?>">
            </div>
            <span class="error"> <?php echo $passwordErr; ?></span>
            <div id="div-log-in-register">
                <button id="button-submit" type="submit" name="submit" value="Submit">LOG IN</button>
                <a id="a-register" href="../Register/Register.php">Register into BayArt!</a>
            </div>
        </form>
    </div>
    </div>
    <!--Waves Container-->
    <div id="div-waves">
        <svg id="svg-waves" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
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