<?php
	session_start();
?>
<html>

	<head>
		<link rel="shortcut icon" href="../icons/icon-viewer.png"/>
		<link rel="stylesheet" href="styles-settings.css">
		<link rel="stylesheet" href="../styles-general.css">
		<meta http-equiv="Content-Type" content=”text/html; charset=UTF-8″ />
		<meta name="viewport" content="width=device-width, user-scalable=no">
		<title>BayArt! - Settings</title>
		
	</head>

	<body class="scrollbar">
        <?php
            include "../php-functions.php";

            
			
			$newPwError= $passwordConfErr = $passwordErr = $usernameError = $emailError="";
			
            if ($_SERVER["REQUEST_METHOD"] == "POST" /*&& !$_SESSION["newsession"]*/) {
				if (isset($_POST['changeBanner'])) {
					$img = file_get_contents( $_GET["banner"]); 
					$data = base64_encode($img);
					
					

				} else if(isset($_POST['changeProfPic'])){
					// Get the image and convert into string 
					$img = file_get_contents( $_GET["profileImg"]); 
			  
					$data = base64_encode($img); 
				
				} else if(isset($_POST['changePW'])){

					//llama a api
				}else if(isset($_POST['changeUsername'])){
					
					$newUsername = test_input($_POST["newUsername"]);
					
					//llamada a api
				}else if(isset($_POST['changeEmail'])){

					//llamada a api

				}else if(isset($_POST['deleteHistory'])){

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

				} /*funca*/else if(isset($_POST['getOut'])){
					$_SESSION = array();

					// Note: This will destroy the session, and not just the session data!
					if (ini_get("session.use_cookies")) {
						$params = session_get_cookie_params();
						setcookie(session_name(), '', time() - 42000,
							$params["path"], $params["domain"],
							$params["secure"], $params["httponly"]
						);
					}

					// Finally, destroy the session.
					session_destroy();
					header('Location: '. "../Login/Login.php");
				}else if(isset($_POST["saveHist"])){
					echo'<script type="text/javascript">alert("Configuración agregada. Dar a aceptar");</script>';

				}else if(isset($_POST["publicLib"])){
					echo'<script type="text/javascript">alert("Configuración agregada. Dar a aceptar");</script>';

				}else if(isset($_POST['theme'])){
					if($_SESSION["theme"]=="Dark"){
						$_SESSION["theme"]="Light";
						echo'<script type="text/javascript">alert("Light");</script>';
					}
					else{
						$_SESSION["theme"]="Dark";
						echo'<script type="text/javascript">alert("Dark");</script>';
					}

				}else if(isset($_POST["newSubs"])){
					echo'<script type="text/javascript">alert("Notificación agregada. Dar a aceptar");</script>';

				}else if(isset($_POST["saleNot"])){
					echo'<script type="text/javascript">alert("Notificación agregada. Dar a aceptar");</script>';

				}else if(isset($_POST["invNot"])){
					echo'<script type="text/javascript">alert("Notificación agregada. Dar a aceptar");</script>';

				}else if(isset($_POST["artPub"])){
					echo'<script type="text/javascript">alert("Notificación agregada. Dar a aceptar");</script>';

				}else if(isset($_POST["purNot"])){
					echo'<script type="text/javascript">alert("Notificación agregada. Dar a aceptar");</script>';

				}else if(isset($_POST["spoRep"])){
					echo'<script type="text/javascript">alert("Notificación agregada. Dar a aceptar");</script>';

				}else if(isset($_POST["subExh"])){
					echo'<script type="text/javascript">alert("Notificación agregada. Dar a aceptar");</script>';
				}
            }
            
            
        ?>

		<div id="green-line" class="line"></div>

		<header>

			<!--Header Principal-->

			<div id="div-buttons">

				<button id="button-homePage" class="options" onclick="location.href='../homepage/homepage.html'">
					<img src="../icons/house.png" class="img-buttons">
				</button>

				<button id="button-browse" class="options" onclick="location.href='../browse/browse.html'">
					<img src="../icons/browse.png" class="img-buttons">
				</button>

				<button id="button-store" class="options" onclick="location.href='../store/store.html'">
					<img src="../icons/store.png" class="img-buttons">
				</button>

			</div>

			<div id="div-search-bar">
				<input id="input-search-bar" type="text">

				<button id="button-magnifier" onclick="location.href='../search/search.html'">
					<img id="img-magnifier" src="../icons/magnifier.png" class="img-buttons">
				</button>
			</div>

			<div id="div-secondary-buttons">
				<a href="../library/library.html" class="a-secondary-buttons"  id="a-secondary-button-library">
					<div class="div-img-secondary-buttons" id="div-secondary-button-library">
						<img src="../icons/icon-library-white.png" class="img-secondary-buttons" id="img-secondary-button-library-white">
						<img src="../icons/icon-library-green.png" class="img-secondary-buttons" id="img-secondary-button-library-green">
					</div>
					<div class="div-secondary-buttons-text" id="div-secondary-button-library-text">library</div>
				</a>

				<a href="../settings/settings.html" class="a-secondary-buttons" style="margin-left: 30px;" id="a-secondary-button-settings">
					<div class="div-img-secondary-buttons" id="div-secondary-button-settings">
						<img src="../icons/icon-settings-white.png" class="img-secondary-buttons" id="img-secondary-button-settings-white">
						<img src="../icons/icon-settings-green.png" class="img-secondary-buttons" id="img-secondary-button-settings-green">
					</div>
					<div class="div-secondary-buttons-text" id="div-secondary-button-settings-text">settings</div>
				</a>
			</div>
			
			<div id="div-profile">
				
				<div id="div-bpoints">
					<img src="../icons/bpoints.png" id="img-bpoints">
					<label id="label-bpoints"><?php echo $bPoints;?></label>
				</div>
				<div id="div-name-type">
					<label id="label-name"><?php echo $_SESSION["username"];?></label><br>
					<label id="label-type"><?php echo $userType?></label>
				</div>

				<div id="div-profile-picture"></div>
			</div>

			<!--Header Secundario-->

			<nav id="nav-subtitle">
				<h2 id="h2-subtitle">SETTINGS</h2>
			</nav>

		</header>

		<main>
			<div id="div-all-settings">
				<div>
					<h2 id="h2-name-user">Hi! <?php echo $_SESSION["username"];?></h2>
				</div>
				<div id="div-all-profile">
					<h3>Profile</h3>
					<div class="things-settings">
						<div ><h4>Banner</h4><button id="button-change-banner" class="button-change-setting"> <img src="../icons/bpoints.png" id="img-bpoints-settings">change</button></div>
						<div ><h4>Profile image</h4><button id="button-change-image" class="button-change-setting"> <img src="../icons/bpoints.png" id="img-bpoints-settings">change</button></div>
						<div ><h4>Username</h4><button id="button-change-username" class="button-change-setting"> <img src="../icons/bpoints.png" id="img-bpoints-settings">change</button></div>
						<div ><h4>Email</h4><button id="button-change-email" class="button-change-setting">change</button></div>
						<div ><h4>Password</h4><button id="button-change-password" class="button-change-setting">change</button></div>
					</div>
				</div>
				<div>
					<h3>Privacy</h3>
					
						<div class="things-settings">
							<form action="settings.php" method="post">
								<div ><h4>Delete history</h4><button id="button-delete-history"  class="button-change-setting">delete</button></div>
							</form>
							<form action="settings.php" method="post">
								<div ><h4>Save history</h4><label class="switch"><input type="checkbox" name="saveHist" onChange="this.form.submit()"><div class="slider round"></div></label></div>
							</form>
							<form action="settings.php" method="post">
								<div ><h4>Public library</h4><label class="switch"><input type="checkbox" name="publicLib" onChange="this.form.submit()"><div class="slider round"></div></label></div>
							</form>	
						</div>
					
				</div>
				<div>
					<h3>Appearance</h3>
					<div class="things-settings">
						<form action="settings.php" method="post">
							<div ><h4 id="h4-cb"><?php echo $_SESSION["theme"];?></h4><label class="switch"><input type="checkbox" id="theme-checkbox" name="theme" onChange="this.form.submit()"><div class="slider round"></div></label></div>
						</form>
						<form action="settings.php" method="post" name="language-form">
							<div><h4>Language</h4><div id="select-language"><select><option value="0">English</option><option value="value2">Spanish</option></select></div></div>
						</form>
						
					</div>
				</div>
				<div>
					<h3>Notifications</h3>
					<form action="" method="POST">
						<div class="things-settings">
							<div ><h4>New subscription</h4><label class="switch"><input type="checkbox" name="newSubs" onChange="this.form.submit()"><div class="slider round"></div></label></div>
							<div ><h4>Sale notice</h4><label class="switch"><input type="checkbox" name="saleNot" onChange="this.form.submit()"><div class="slider round"></div></label></div>
							<div ><h4>Investment notice</h4><label class="switch"><input type="checkbox" name="invNot" onChange="this.form.submit()"><div class="slider round"></div></label></div>
							<div ><h4>Artist publication</h4><label class="switch"><input type="checkbox" name="artPub" onChange="this.form.submit()"><div class="slider round"></div></label></div>
							<div ><h4>Purchase notice</h4><label class="switch"><input type="checkbox" name="purNot" onChange="this.form.submit()"><div class="slider round"></div></label></div>
							<div ><h4>Sponsor report</h4><label class="switch"><input type="checkbox" name="spoRep" onChange="this.form.submit()"><div class="slider round"></div></label></div>
							<div ><h4>Subscription exhaustion</h4><label class="switch"><input type="checkbox" name="subExh" onChange="this.form.submit()"><div class="slider round"></div></label></div>
						</div>
					</form>
					
				</div>
				<div>
					<h3>Activity</h3>
					<div class="things-settings">
						<div ><h4>Subscriptions</h4><button id="button-view-subs" class="button-change-setting">view</button></div>
						<div ><h4>Monthly purchases</h4><button id="button-view-mounthly-purchases" class="button-change-setting">view</button></div>
					</div>
				</div>
				<div>
					<h3>Account</h3>
					<div class="things-settings">
						<div ><h4>Sign off</h4><button id="button-get-out" class="button-change-setting">get out</button></div>
					</div>
				</div>
			</div>
		</main>
		
		<div id="div-pop-up-background"></div>
		
		<!--POPS UPS-->
		<div id="div-pop-up">
			<div id="div-cancel-image">
				<img src="../icons/cancel.png" id="img-cancel-image">
			</div>
			
			<form action="" method="POST" id="form-settings-banner" class="form-settings">

				<!--change banner img-->
				<div id="div-change-banner-img">
					<div id="div-img-actual-banner">
						<img src="../ImgPrueba/17.jpg" id="img-actual-banner">
					</div>
					<img id="img-uploaded-banner">
					<div id="div-drag-drop-banner">
						<div id="div-upload-banner">
							<label id="label-input-banner" for="input-banner">
								<h5 id="h5-input-banner">Upload Image</h5>
							</label>
						</div>
						<input type="file" id="input-banner" class="input-settings" name="banner" accept="image/*" style="display:none" required>
					</div>
				</div>
				<button id="button-submit-banner" type="submit" name="changeBanner" class="button-submit">
					<img src="../icons/bpoints.png" id="button-img-bpoints-banner" class="button-img-bpoints">
					<div id="div-price-number-banner" class="div-price-number">1500</div>
				</button>
			</form>

			<form action="" method="POST" id="form-settings-image" class="form-settings">

				<!--change profile img-->
				<div id="div-change-profile-img">
					<div id="div-img-actual">
						<img src="../ImgPrueba/3.jpg" id="img-actual">
					</div>
					<img id="img-uploaded">
					<div id="div-drag-drop">
						<div id="div-upload-image">
							<img id="img-icon-upload" src="../Icons/upload.png">
							<label id="label-input-image" for="input-image">
								<h5 id="h5-input-image">Upload Image</h5>
							</label>
						</div>
						<input type="file" id="input-image" class="input-settings" name="profileImg" accept="image/*" style="display:none" required>
					</div>
				</div>
				<button id="button-submit-image" type="submit" name="changeProfPic" class="button-submit">
					<img src="../icons/bpoints.png" id="button-img-bpoints-image" class="button-img-bpoints">
					<div id="div-price-number-image" class="div-price-number">2000</div>
				</button>
			</form>

			<form action="settings.php" method="post" id="form-settings-username" name="username-form" onsubmit="return validateUsername();" class="form-settings">
				<div>
					<h4>Username:</h4>
					<h3 id="h3-username"><?php echo $_SESSION["username"];?></h3>
					<div>
						<h4>Change username:</h4>
						<div id="div-change-username-input">
							<input type="text" id="input-username" class="input-write" name="newUsername" required>
							<span class="error" id="username-error"></span>
						</div>
					</div>
					<button id="button-submit-username" type="submit" name="changeUsername" class="button-submit">
						<img src="../icons/bpoints.png" id="button-img-bpoints-username" class="button-img-bpoints">
						<div id="div-price-number-username" class="div-price-number">3000</div>
    				</button>
				</div>
			</form>
			
			<form action="settings.php" method="post" id="form-settings-email" name="email-form" onsubmit="return validateEmail();" class="form-settings">

				<!--change email-->
				<div>
    				<h4>Email:</h4>
					<h3 id="h3-email"><?php echo $email?></h3>
					<div>
						<h4>Change email:</h4>
						<div id="div-change-email-input">
							<input type="text" class="input-write" name="newEmail" required>
							<span class="error" id="email-error"></span>
						</div>
					</div>
					<button id="button-submit-email" type="submit" name="changeEmail" class="button-submit">
						<div>CHANGE</div>
					</button>
				</div>
				
			</form>

			<form action="settings.php" method="post" id="form-settings-password" name="pw-form" onsubmit="return validatePW();" class="form-settings">
				<!--change password-->
				<div>
					<h4>Actual password:</h4>
					<div id="div-change-password-input">
						<input type="password" class="input-write" id="input-actual-password" name="pw" required>
					</div>
					<span class="error" id="pw-error"></span>
					<h4>Change password:</h4>
					<div id="div-change-password-input">
						<input type="password" class="input-write" id="input-password" name="newpw" required>
					</div>
					<span class="error" id="newpw-error"></span>
					<img id="img-eye" src="../icons/open-eye.png">
					<h4>Confirm password:</h4>
					<div id="div-change-password-input">
						<input type="password" class="input-write" id="input-confirm-password" name="confpw" required>
					</div>
					<span class="error" id="confpw-error"></span>
					<button id="button-submit-password" type="submit" name="changePW" class="button-submit">
						<div>CHANGE</div>
					</button>
				</div>-->
				<!--Name: <input type="text" name="pw">
				Name: <input type="text" name="newpw">
				Name: <input type="text" name="confpw">
  				<input type="submit" value="Submit">-->
				
			</form>
			
			<form action="" method="POST" id="form-settings-delete-history" class="form-settings">

				<!--delete history-->
				<div>
					<h4>Are you sure you want to delete your whole </br> history?</h4>
					<button id="button-submit-delete-history" type="submit" name="deleteHistory" class="button-submit">
						<div>DELETE</div>
					</button>
				</div>
				
			</form>

			<form action="" method="POST" id="form-settings-subs" class="form-settings">

				<!--view subscriptions-->
				<h4>Subscriptions</h4>
				<div id="div-view-subs" class="scrollbar-description">

                    <?php
                        $subName="";
                        $subTime="";
                        for($i=0;$i<=10;$i++){//hay que obtener las subcripciones del usuario
                            $subName="";
                            $subTime="";
                    ?>
                        <h3 id="h3-view-subs"><?php echo $subName ?> - <?php echo $subTime ?> days</h3>
                    <?php   
                        }
                    ?>    
				</div>
				
			</form>

			<form action="" method="POST" id="form-settings-view-mounthly-purchases" class="form-settings">

				<!--view mounthly purchases-->
				<h4>Mounthly purchases</h4>
				<div id="div-view-mounthly-purchases" class="scrollbar-description">
				<?php
                        $purchaseName="";
                        $price=0;
                        for($i=0;$i<=10;$i++){//hay que obtener las subcripciones del usuario
                            $purchaseName="";
                            $price=0;
                    ?>
                        <h3 id="h3-view-mounthly-purchases"><?php echo $purchaseName?> - <img src="../icons/bpoints.png" 	id="img-bpoints-bought" class="button-img-bpoints"><?php echo $price?></h3>
                    <?php   
                        }
                    ?> 
				</div>
				
			</form>

			<form action="" method="POST" id="form-settings-get-out" class="form-settings">

				<!--get out-->
				<div>
					<h4>Are you sure you want to get out?</h4>
					<button id="button-submit-get-out" type="submit" name="getOut" class="button-submit">
						<div>GET OUT</div>
					</button>
				</div>
				
			</form>

		</div>
		
	</body>

	<script src="../jquery.js"></script>
	<script src="../basic-functions.js"></script>
	<script src="select-image.js"></script>
	<script src="drag-drop-image.js"></script>
	<script src="select-banner.js"></script>
	<script src="drag-drop-banner.js"></script>
	
	<script>
		/*Efecto boton bpoints pop-up*/

		function changeButtonBpoints(shown, name){
			if(shown){
				$("#button-img-bpoints-"+name).css("opacity","0");
				$("#div-price-number-"+name).css("opacity","0");
				setTimeout( function(){
					$("#button-submit-"+name).css("border", "5px solid white");
					$("#div-price-number-"+name).html("CHANGE");
					$("#button-img-bpoints-"+name).css("display","none");	
					$("#div-price-number-"+name).css("opacity","1");
       			}, 100);
				setTimeout( function(){
					$("#button-submit-"+name).css("border", "2px solid white")
       			}, 300);
			}
			else{
				$("#div-price-number-"+name).css("opacity","0");
				$("#button-submit-"+name).css("border", "none");
				setTimeout( function(){
					$("#button-img-bpoints-"+name).css("opacity","1");
					if(name == "image"){
						$("#div-price-number-"+name).html("2000");
						$("#button-img-bpoints-"+name).css("display","none");
					}
					else if(name == "username"){
						$("#div-price-number-"+name).html("3000");
						$("#button-img-bpoints-"+name).css("display","none");	
					}
					else if(name == "banner"){
						$("#div-price-number-"+name).html("1500");
						$("#button-img-bpoints-"+name).css("display","none");	
					}
					$("#button-img-bpoints-"+name).css("display","inline-block");
					$("#div-price-number-"+name).css("opacity","1");
					
       			}, 100);
			}
		}

		$("#button-submit-image").mouseenter(function(){changeButtonBpoints(true,"image")});
		$("#button-submit-image").mouseleave(function(){changeButtonBpoints(false,"image")});

		$("#button-submit-username").mouseenter(function(){changeButtonBpoints(true,"username")});
		$("#button-submit-username").mouseleave(function(){changeButtonBpoints(false,"username")});

		$("#button-submit-banner").mouseenter(function(){changeButtonBpoints(true,"banner")});
		$("#button-submit-banner").mouseleave(function(){changeButtonBpoints(false,"banner")});

		/*Abrir popup*/

		$(".button-change-setting").click(function(){
			$("#div-pop-up-background").css("display","block");
			$("#div-pop-up").css("display","block");
		})

		/*Contenido Pop-up*/

		$("#button-change-banner").click(function(){
			$("#form-settings-banner").css("display","block");
		});

		$("#button-change-image").click(function(){
			$("#form-settings-image").css("display","block");
		});

		$("#button-change-username").click(function(){
			$("#form-settings-username").css("display","block");
		});

		$("#button-change-email").click(function(){
			$("#form-settings-email").css("display","block");
		});

		$("#button-change-password").click(function(){
			$("#form-settings-password").css("display","block");
		});

		$("#button-delete-history").click(function(){
			$("#form-settings-delete-history").css("display","block");
		});

		$("#button-view-subs").click(function(){
			$("#form-settings-subs").css("display","block");
		});

		$("#button-view-mounthly-purchases").click(function(){
			$("#form-settings-view-mounthly-purchases").css("display","block");
		});

		$("#button-get-out").click(function(){
			$("#form-settings-get-out").css("display","block");
		});

		/*salir popup*/
		
		$("#div-cancel-image").click(function(){
			$("#div-pop-up-background").css("display","none");
			$("#div-pop-up").css("display","none");
			$(".form-settings").css("display","none");
			
			//Resetear IMG-UPLOADED
			$("#div-drag-drop").css("display","inline-block");
			$("#img-uploaded").css("display","none");
			$("#input-image").val(null);

			$("#div-drag-drop-banner").css("display","inline-block");
			$("#img-uploaded-banner").css("display","none");
			$("#input-banner").val(null);

		});
		/*prevent default*/
		function validateUsername(){
			var x = document.forms["username-form"]["newUsername"].value;
			var ln=x.length; 
			var regex = /^[A-Za-z0-9 ]+$/;
			var specialCh=regex.test(x);
			var username = '<?php echo $_SESSION["username"];?>';
			if(x == ""){
				document.getElementById("username-error").textContent="Insert a username";
    			return false;
			}else if(ln>20){
				document.getElementById("username-error").textContent="Username must have less than 20 characters";
    			return false;
			}else if(!specialCh){
				document.getElementById("username-error").textContent="Do not use special symbols";
    			return false;
			}else if(x==username){
				document.getElementById("username-error").textContent="Insert a different username";
    			return false;
			}
		}

		function validateEmail(){
			var x = document.forms["email-form"]["newEmail"].value;
			/*var username = '<?php echo $_SESSION["username"];?>';*/
			if(!/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(x)){
				document.getElementById("email-error").textContent="Insert a valid email";
    			return false;
			}
		}

		function validatePW(){
			var pw = document.forms["pw-form"]["pw"].value;
			console.log(pw);
			var newpw = document.forms["pw-form"]["newpw"].value;
			console.log(newpw);
			var confpw = document.forms["pw-form"]["confpw"].value;
			console.log(confpw);
			var regex = /^[A-Za-z0-9 ]+$/;
			/*var username = '<?php echo $_SESSION["username"];?>';*/
			if(!regex.test(pw)){
				document.getElementById("pw-error").textContent="Password must only have letters and numbers";
    			return false;
			}
			if(newpw==pw){
				document.getElementById("newpw-error").textContent="Insert a different password";
    			return false;
			}
			if(newpw.length>20){
				document.getElementById("newpw-error").textContent="Password must have less than 20 characters";
    			return false;
			}
			if(!regex.test(newpw)){
				document.getElementById("newpw-error").textContent="Password must only have letters and numbers";
    			return false;
			}
			if(!regex.test(confpw)){
				document.getElementById("confpw-error").textContent="Password must only have letters and numbers";
    			return false;
			}
			if(confpw.localeCompare(newpw)!=0){
				document.getElementById("confpw-error").textContent="Insert your password again";
    			return false;
			}
		}
		/*checkbox*/
		
		
	</script>
</html>