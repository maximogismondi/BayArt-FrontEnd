<html>

<head>
    <title>BayArt! - Register</title>
    <link rel="shortcut icon" href="../icons/icon-register.png" />
    <link rel="stylesheet" href="styles-register.css">
    <link rel="stylesheet" href="../styles-general.css">
    <meta http-equiv="Content-Type" content=”text/html; charset=UTF-8″ />
    <meta name="viewport" content="width=device-width, user-scalable=no">
</head>

<body>

    <body>
        <!--Div que engloba tanto botones usuarios como formulario-->
        <!--flecha volver-->
        <a href="../Login/Login.php" id="a-back">
            <</a> <div id="div-all">
                <div id="div-buttons-choice">
                    <!--boton artista-->
                    <button class="button-users" type="submit" id="buttom-artist">
                        ARTIST
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-brush-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M15.825.12a.5.5 0 0 1 .132.584c-1.53 3.43-4.743 8.17-7.095 10.64a6.067 6.067 0 0 1-2.373 1.534c-.018.227-.06.538-.16.868-.201.659-.667 1.479-1.708 1.74a8.117 8.117 0 0 1-3.078.132 3.658 3.658 0 0 1-.563-.135 1.382 1.382 0 0 1-.465-.247.714.714 0 0 1-.204-.288.622.622 0 0 1 .004-.443c.095-.245.316-.38.461-.452.393-.197.625-.453.867-.826.094-.144.184-.297.287-.472l.117-.198c.151-.255.326-.54.546-.848.528-.739 1.2-.925 1.746-.896.126.007.243.025.348.048.062-.172.142-.38.238-.608.261-.619.658-1.419 1.187-2.069 2.175-2.67 6.18-6.206 9.117-8.104a.5.5 0 0 1 .596.04z" />
                        </svg>
                    </button>
                    <!--boton espectador-->
                    <button class="button-users" type="submit" id="buttom-viewer">
                        VIEWER
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                            <path fill-rule="evenodd" d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                        </svg>
                    </button>
                </div>

                <?php

                include "../php-functions.php";

                session_start();

                // define variables and set to empty values
                $nameErr = $passwordErr = $passwordConfErr = $emailErr = $emailConfErr = $calenderErr = "";
                $name = $password = $passwordConf = $email = $emailConf = $day = $month = $year = $userType = "";

                if ($_SERVER["REQUEST_METHOD"] == "POST") {

                    if (empty($_POST["name"])) {
                        $nameErr = "Username is required";
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

                    if (empty($_POST["email"])) {
                        $emailErr = "Email is required";
                    } else {
                        $email = test_input($_POST["email"]);

                        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            $emailErr = "Invalid email format";
                        } else {
                            if (empty($_POST["emailConf"])) {
                                $emailConfErr = "Confirmation is required";
                            } else {
                                $emailConf = test_input($_POST["emailConf"]);

                                if ($email != $emailConf) {
                                    $emailConfErr = "Error when confirm email";
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
                                } else {
                                    if (empty($_POST["passwordConf"])) {
                                        $passwordConfErr = "Confirmation is required";
                                    } else {
                                        $passwordConf = test_input($_POST["passwordConf"]);

                                        if ($password != $passwordConf) {
                                            $passwordConfErr = "Error when confirm password";
                                        }
                                    }
                                }
                            }
                        }
                    }

                    $day   = test_input($_POST["day"]);
                    $month = test_input($_POST["month"]);
                    $year  = test_input($_POST["year"]);
                    $userType = test_input($_POST["userType"]);

                    if (empty($_POST["day"]) || empty($_POST["month"]) || empty($_POST["year"])) {
                        $calenderErr = "Complete your birth date";
                    } else {
                        if (!checkdate($month, $day, $year)) {
                            $calenderErr = "Set a valid date";
                        }
                    }

                    if ($nameErr == "" && $passwordErr == "" && $passwordConfErr == "" && $emailErr == "" && $emailConfErr == "" && $calenderErr == "") {
                        $API_URL = "http://localhost:8888/api/register/" . $name . "/" . $email . "/" . $password . "/" . $day . "/" . $month . "/" . $year . "/" . $userType;
                        $res = postURL($API_URL);
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
                            saveImage("../images/profileImages/", $_SESSION["username"], $_SESSION["encodedProfilePicture"]);

                            if (sizeof($resultado) == 2) {
                                $_SESSION["userType"]  = "viewer";
                            } else {
                                $_SESSION["userType"]  = "artist";
                                $_SESSION["srcBanner"] = "..images/profileImages/" . $_SESSION["username"] . getExtension($resultado["encodedBanner"][0]);;
                                $_SESSION["notificationsInformSponsor"]  = $resultado["artist"]["notificationsInformSponsor"];
                                $_SESSION["notificationsNewPublication"] = $resultado["artist"]["notificationsNewPublication"];

                                saveImage("../images/artistsBanners/", $_SESSION["username"], $_SESSION["encodedBanner"]);
                            }

                            header('Location: ' . "../browse/browse.php");
                        } else {
                            if ($resultado["error"] == "username") {
                                $nameErr = "The username is already choosen";
                            } else {
                                $emailErr = "The email is already choosen";
                            }
                        }
                    }
                }

                ?>
                <!--Formulario-->
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="form-register">
                    <div class="div-inputs">
                        <input type="text" placeholder="Choose a username" class="input-register" name="name" value="<?php echo $name; ?>">
                    </div>
                    <span class="error"> <?php echo $nameErr; ?></span>
                    <div class="div-inputs">
                        <input type="text" placeholder="Add your email" class="input-register" name="email" value="<?php echo $email; ?>">
                    </div>
                    <span class="error"> <?php echo $emailErr; ?></span>
                    <div class="div-inputs">
                        <input type="text" placeholder="Confirm Email" class="input-register" name="emailConf" value="<?php echo $emailConf; ?>">
                    </div>
                    <span class="error"> <?php echo $emailConfErr; ?></span>
                    <div class="div-inputs">
                        <input type="password" placeholder="Choose a password" class="input-register" id="input-password" name="password" value="<?php echo $password; ?>">
                        <img id="img-eye" src="../icons/open-eye.png" onclick="showPassword">
                    </div>
                    <span class="error"> <?php echo $passwordErr; ?></span>
                    <div class="div-inputs">
                        <input type="password" placeholder="Confirm password" class="input-register" name="passwordConf" value="<?php echo $passwordConf; ?>">
                    </div>
                    <span class="error"> <?php echo $passwordConfErr; ?></span>
                    <div id="div-date">
                        <input type="number" name="day" placeholder="Day" value="<?php echo $day; ?>" class="input-register" id="input-day" min="1" max="31">
                        <input type="number" name="month" placeholder="Month" value="<?php echo $month; ?>" class="input-register" id="input-month" min="1" max="12">
                        <input type="number" name="year" placeholder="Year" value="<?php echo $year; ?>" class="input-register" id="input-year" min="1950" max="2003">
                    </div>
                    <span class="error" style="margin-top: 5px"> <?php echo $calenderErr; ?></span>
                    <div>
                        <button class="button-register" type="submit">REGISTER</button>
                    </div>
                    <div style=" display: none;">
                        <input id="userType" name="userType" class="php-variables" value="artist">
                    </div>
                </form>
                </div>
                <div id="div-waves">
                    <!--Waves Container-->
                    <div>
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
                </div>
    </body>

    <script src="../jquery.js"></script>
    <script src="../basic-functions.js"></script>

    <script>
        /*Funciones cambiar color borde (tipo artista)*/
        function cambiarFondoArtista() {
            $("#userType").val("artist");
            $("#div-all").css("background", "#00a797");
            $(".button-register").css("background", "#00a797");
            $("#buttom-viewer").css("height", "30px");
            $("#buttom-artist").css("height", "40px");
        }

        /*Funciones cambiar color borde (tipo espectador)*/
        function cambiarFondoEspectador() {
            $("#userType").val("viewer");
            $("#div-all").css("background", "#674ea7");
            $(".button-register").css("background", "#674ea7");
            $("#buttom-artist").css("height", "30px");
            $("#buttom-viewer").css("height", "40px");
        }

        $("#buttom-artist").click(cambiarFondoArtista);
        $("#buttom-viewer").click(cambiarFondoEspectador);
    </script>

</html>