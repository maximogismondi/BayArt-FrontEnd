<html>

<head>
	<link rel="shortcut icon" href="../icons/icon-viewer.png" />
	<link rel="stylesheet" href="styles-settings.css">
	<link rel="stylesheet" href="../styles-general.css">
	<meta http-equiv="Content-Type" content=”text/html; charset=UTF-8″ />
	<meta name="viewport" content="width=device-width, user-scalable=no">
	<title>BayArt! - Settings</title>
</head>
<?php
include "../php-functions.php";

session_start();

$API_URL = "http://localhost:8888/api/bpoints/" . $_SESSION["idUser"];
$res = getUrl($API_URL);
$status = $res[0];
$infoResponse = $res[1];
$resultado = json_decode($infoResponse, true);

$_SESSION["bpoints"] = $resultado["bpoints"];

$API_URL = "http://localhost:8888/api/infoUsuario/" . $_SESSION["idUser"];
$res = getUrl($API_URL);
$status = $res[0];
$infoResponse = $res[1];
$resultado = json_decode($infoResponse, true);

if ($status == 200) { // ok

	$_SESSION["username"]        = $resultado["infoUsuario"]["username"];
	$_SESSION["email"]           = $resultado["infoUsuario"]["email"];
	$_SESSION["password"]        = $resultado["infoUsuario"]["password"];
	$_SESSION["notificationsNewPublication"] = $resultado["infoUsuario"]["notificationsNewPublication"];
	$_SESSION["notificationsBuyAlert"]       = $resultado["infoUsuario"]["notificationsBuyAlert"];
	$_SESSION["notificationsInformSponsor"]  = $resultado["infoUsuario"]["notificationsInformSponsor"];
	$_SESSION["notificationsNewSub"]         = $resultado["artist"]["notificationsNewSub"];
	$_SESSION["notificationsSell"]           = $resultado["artist"]["notificationsSell"];
	$_SESSION["notificationsSponsor"]        = $resultado["artist"]["notificationsSponsor"];

	$_SESSION["srcProfilePicture"] = "../images/profileImages/" . $_SESSION["username"] . getExtension($resultado["encodedProfilePicture"][0]);
	saveImage("../images/profileImages/", $_SESSION["username"], $resultado["encodedProfilePicture"]);

	
	if($_SESSION["userType"]  == "artist"){
		$_SESSION["srcBanner"] = "../images/profileBanner/" . $_SESSION["username"] . getExtension($resultado["encodedBanner"][0]);;                    

    	saveImage("../images/profileBanner/", $_SESSION["username"], $resultado["encodedBanner"]);
	}
}

$API_URL = "http://localhost:8888/api/settings/" . $_SESSION["idUser"];
$res = getUrl($API_URL);
$status = $res[0];
$infoResponse = $res[1];
$resultado = json_decode($infoResponse, true);

if ($status == 200) { // ok

	$subscriptions = $resultado["subscriptions"];
	$sponsorsArtists = $resultado["sponsoredArtists"];
	$sponsorsPercentage = $resultado["sponsorsPercentage"];
	$subscriptors = $resultado["subscriptors"];
	$sponsors = $resultado["sponsors"];
	
}


?>

<body class="scrollbar">

	<div id="green-line" class="line"></div>

	<header>

		<!--Header Principal-->

		<div id="div-buttons">

			<button id="button-homePage" class="options" onclick="location.href='../homepage/homepage.php'">
				<img src="../icons/house.png" class="img-buttons">
			</button>

			<button id="button-browse" class="options" onclick="location.href='../browse/browse.php'">
				<img src="../icons/browse.png" class="img-buttons">
			</button>

			<button id="button-store" class="options" onclick="location.href='../store/store.php'">
				<img src="../icons/store.png" class="img-buttons">
			</button>

		</div>

		<form id="form-search" style="display: inline">
			<div id="div-search-bar">

				<input id="input-search-bar" type="text">

				<button id="button-magnifier">
					<img id="img-magnifier" src="../icons/magnifier.png" class="img-buttons">
				</button>
			</div>
		</form>		

		<div id="div-secondary-buttons">
			<a href="../own-profile/own-profile.php" class="a-secondary-buttons" id="a-secondary-button-profile">
				<div class="div-img-secondary-buttons" id="div-secondary-button-profile">
					<img src="../icons/icon-profile-white.png" class="img-secondary-buttons" id="img-secondary-button-profile-white">
					<img src="../icons/icon-profile-green.png" class="img-secondary-buttons" id="img-secondary-button-profile-green">
				</div>
				<div class="div-secondary-buttons-text" id="div-secondary-button-profile-text">profile</div>
			</a>

			<a href="../library/library.php" class="a-secondary-buttons" id="a-secondary-button-library">
				<div class="div-img-secondary-buttons" id="div-secondary-button-library">
					<img src="../icons/icon-library-white.png" class="img-secondary-buttons" id="img-secondary-button-library-white">
					<img src="../icons/icon-library-green.png" class="img-secondary-buttons" id="img-secondary-button-library-green">
				</div>
				<div class="div-secondary-buttons-text" id="div-secondary-button-library-text">library</div>
			</a>

			<a href="../settings/settings.php" class="a-secondary-buttons" style="margin-left: 30px;" id="a-secondary-button-settings">
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
				<label id="label-bpoints"><?php echo $_SESSION["bpoints"] ?></label>
			</div>
			<div id="div-name-type">
				<label id="label-name"><?php echo $_SESSION["username"] ?></label><br>
				<label id="label-type" style="color: #674ea7 !important;"><?php echo $_SESSION["userType"] ?></label>
			</div>

			<img src="<?php echo $_SESSION["srcProfilePicture"] ?>" id="profile-picture">
		</div>

		<!--Header Secundario-->

		<nav id="nav-subtitle">
			<h2 id="h2-subtitle">SETTINGS</h2>
		</nav>

	</header>

	<main>
		<div id="div-all-settings">
			<div>
				<h2 id="h2-name-user">Hi! <?php echo $_SESSION["username"] ?></h2>
			</div>
			<div id="div-all-profile">
				<h3>Profile</h3>
				<div class="things-settings">
					<div class="artist-options">
						<h4>Banner</h4><button id="button-change-banner" class="button-change-setting"> <img src="../icons/bpoints.png" class="img-bpoints-settings">change</button>
					</div>
					<div>
						<h4>Profile image</h4><button id="button-change-image" class="button-change-setting"> <img src="../icons/bpoints.png" class="img-bpoints-settings">change</button>
					</div>
					<div>
						<h4>Username</h4><button id="button-change-username" class="button-change-setting"> <img src="../icons/bpoints.png" class="img-bpoints-settings">change</button>
					</div>
					<div>
						<h4>Email</h4><button id="button-change-email" class="button-change-setting">change</button>
					</div>
					<div>
						<h4>Password</h4><button id="button-change-password" class="button-change-setting">change</button>
					</div>
				</div>
			</div>
			<div>
				<h3>Notifications</h3>
				<div class="things-settings">
					<div>
						<h4>Artist publication</h4><label class="switch"><input id="input-notificationsNewPublication" type="checkbox" class="checkOptions">
							<div class="slider round"></div>
						</label>
					</div>
					<div>
						<h4>Purchase notice</h4><label class="switch"><input id="input-notificationsBuyAlert" type="checkbox" class="checkOptions">
							<div class="slider round"></div>
						</label>
					</div>
					<div>
						<h4>Sponsor report</h4><label class="switch"><input id="input-notificationsInformSponsor" type="checkbox" class="checkOptions">
							<div class="slider round"></div>
						</label>
					</div>
					<div class="artist-options">
						<h4>New sub</h4><label class="switch"><input id="input-notificationsNewSub" type="checkbox" class="checkOptions">
							<div class="slider round"></div>
						</label>
					</div>
					<div class="artist-options">
						<h4>Sell</h4><label class="switch"><input id="input-notificationsSell" type="checkbox" class="checkOptions">
							<div class="slider round"></div>
						</label>
					</div>
					<div class="artist-options">
						<h4>Sponsor</h4><label class="switch"><input id="input-notificationsSponsor" type="checkbox" class="checkOptions">
							<div class="slider round"></div>
						</label>
					</div>
				</div>
			</div>
			<div>
				<h3>Activity</h3>
				<div class="things-settings">
					<div>
						<h4>Subscriptions</h4><button id="button-view-subs" class="button-change-setting">view</button>
					</div>
					<div>
						<h4>Sponsors</h4><button id="button-view-sponsors" class="button-change-setting">view</button>
					</div>
					<div class="artist-options">
						<h4>Subscriptors</h4><button id="button-view-subscriptors" class="button-change-setting">view</button>
					</div>
				</div>
			</div>
			<div>
				<h3>Account</h3>
				<div class="things-settings">
					<div>
						<h4>Sign off</h4><button id="button-get-out" class="button-change-setting">get out</button>
					</div>
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

		<div id="form-settings-banner" class="form-settings">

			<!--change banner img-->
			<div id="div-change-banner-img">
				<div id="div-img-actual-banner">
					<img src="<?php echo $_SESSION["srcBanner"] ?>" id="img-actual-banner">
				</div>
				<img id="img-uploaded-banner">
				<div id="div-drag-drop-banner">
					<div id="div-upload-banner">
						<label id="label-input-banner" for="input-banner">
							<h5 id="h5-input-banner">Upload Image</h5>
						</label>
					</div>
					<input type="file" id="input-banner" accept="image/*" style="display:none" required>
					<input type="hidden" id="input-encode-banner" name="encode-banner" value="">
				</div>
			</div>
			<button id="button-submit-banner" class="button-submit">
				<img src="../icons/bpoints.png" id="button-img-bpoints-banner" class="button-img-bpoints">
				<div id="div-price-number-banner" class="div-price-number">200</div>
			</button>
		</div>

		<div id="form-settings-image" class="form-settings">

			<!--change profile img-->
			<div id="div-change-profile-img">
				<div id="div-img-actual">
					<img src="<?php echo $_SESSION["srcProfilePicture"] ?>" id="img-actual">
				</div>
				<img id="img-uploaded">
				<div id="div-drag-drop">
					<div id="div-upload-image">
						<img id="img-icon-upload" src="../Icons/upload.png">
						<label id="label-input-image" for="input-image">
							<h5 id="h5-input-image">Upload Image</h5>
						</label>
					</div>
					<input type="file" id="input-image" accept="image/*" style="display:none" required>
					<input type="hidden" id="input-encode-image" name="encode-image">
				</div>
			</div>
			<button id="button-submit-image" type="submit" class="button-submit">
				<img src="../icons/bpoints.png" id="button-img-bpoints-image" class="button-img-bpoints">
				<div id="div-price-number-image" class="div-price-number">200</div>
			</button>
		</div>

		<div id="form-settings-username" class="form-settings">

			<!--change username-->
			<div>
				<h4>Username:</h4>
				<h3 id="h3-username"><?php echo $_SESSION["username"] ?></h3>
				<div>
					<h4>Change username:</h4>
					<div id="div-change-username-input">
						<input id="input-new-username" type="text" class="input-write" required>
					</div>
				</div>
			</div>

			<button id="button-submit-username" type="submit" class="button-submit">
				<img src="../icons/bpoints.png" id="button-img-bpoints-username" class="button-img-bpoints">
				<div id="div-price-number-username" class="div-price-number">200</div>
			</button>

		</div>

		<div id="form-settings-email" class="form-settings">

			<!--change email-->
			<div>
				<h4>Email:</h4>
				<h3 id="h3-email"><?php echo $_SESSION["email"] ?></h3>

				<div>
					<h4>Change email:</h4>
					<div id="div-change-email-input">
						<input id="input-new-email" type="text" class="input-write" required>
					</div>
				</div>

			</div>
			<button id="button-submit-email" type="submit" class="button-submit">
				<div>CHANGE</div>
			</button>

		</div>

		<div id="form-settings-password" class="form-settings">

			<!--change password-->
			<div>
				<h4>Actual password:</h4>
				<div class="div-change-password-input">
					<input type="password" class="input-write" id="input-actual-password" required>
				</div>

				<h4>Change password:</h4>
				<div class="div-change-password-input">
					<input type="password" class="input-write" id="input-password" required>
				</div>
				<img id="img-eye" src="../icons/open-eye.png">

				<h4>Confirm password:</h4>
				<div class="div-change-password-input">
					<input type="password" class="input-write" id="input-confirm-password" required>
				</div>

				<button id="button-submit-password" type="submit" class="button-submit">
					<div>CHANGE</div>
				</button>
			</div>
		</div>

		<div id="form-settings-subs" class="form-settings">

			<h4>Subscriptions</h4>
			<div id="div-view-subs" class="scrollbar-description">
			</div>

		</div>
		
		<div id="form-settings-subscriptors" class="form-settings">
			
			<h4>Subscriptors</h4>
			<div id="div-view-subscriptors" class="scrollbar-description">
			</div>
				
		</div>
		
		<div id="form-settings-sponsors" class="form-settings">

			<h4>Sponsors</h4>
			<div id="div-view-sponsors" class="scrollbar-description">
			</div>

		</div>
			
		<div id="form-settings-get-out" class="form-settings">

			<!--get out-->
			<div>
				<h4>Are you sure you want to get out?</h4>
				<button id="button-submit-get-out" type="submit" class="button-submit">
					<div>GET OUT</div>
				</button>
			</div>

		</div>

	</div>

</body>

<script src="../jquery.js"></script>
<script src="../basic-functions.js"></script>
<script src="select-image.js"></script>
<script src="drag-drop-image.js"></script>
<script src="select-banner.js"></script>
<script src="drag-drop-banner.js"></script>

<script>
	var host = window.location["host"];

	window.onload = function() {
		
		editHeader();

		if ("<?php echo $_SESSION["userType"] ?>" != "artist") {
			$(".artist-options").css("display", "none");
		}
		if (<?php echo json_encode($_SESSION["notificationsNewPublication"]) ?>) {
			$("#input-notificationsNewPublication").attr("checked", "checked");
		}
		if (<?php echo json_encode($_SESSION["notificationsBuyAlert"]) ?>) {
			$("#input-notificationsBuyAlert").attr("checked", "checked");
		}
		if (<?php echo json_encode($_SESSION["notificationsInformSponsor"]) ?>) {
			$("#input-notificationsInformSponsor").attr("checked", "checked");
		}
		if (<?php echo json_encode($_SESSION["notificationsNewSub"]) ?>) {
			$("#input-notificationsNewSub").attr("checked", "checked");
		}
		if (<?php echo json_encode($_SESSION["notificationsSell"]) ?>) {
			$("#input-notificationsSell").attr("checked", "checked");
		}
		if (<?php echo json_encode($_SESSION["notificationsSponsor"]) ?>) {
			$("#input-notificationsSponsor").attr("checked", "checked");
		}

		finishLoad();

	};

	/*Efecto boton bpoints pop-up*/

	var idUser = <?php echo $_SESSION["idUser"]; ?>;

	function changeButtonBpoints(shown, name) {
		if (shown) {
			$("#button-img-bpoints-" + name).css("opacity", "0");
			$("#div-price-number-" + name).css("opacity", "0");
			setTimeout(function() {
				$("#button-submit-" + name).css("border", "5px solid white");
				$("#div-price-number-" + name).html("CHANGE");
				$("#button-img-bpoints-" + name).css("display", "none");
				$("#div-price-number-" + name).css("opacity", "1");
			}, 100);
			setTimeout(function() {
				$("#button-submit-" + name).css("border", "2px solid white")
			}, 300);
		} else {
			$("#div-price-number-" + name).css("opacity", "0");
			$("#button-submit-" + name).css("border", "none");
			setTimeout(function() {
				$("#button-img-bpoints-" + name).css("opacity", "1");
				if (name == "image") {
					$("#div-price-number-" + name).html("200");
					$("#button-img-bpoints-" + name).css("display", "none");
				} else if (name == "username") {
					$("#div-price-number-" + name).html("200");
					$("#button-img-bpoints-" + name).css("display", "none");
				} else if (name == "banner") {
					$("#div-price-number-" + name).html("200");
					$("#button-img-bpoints-" + name).css("display", "none");
				}
				$("#button-img-bpoints-" + name).css("display", "inline-block");
				$("#div-price-number-" + name).css("opacity", "1");

			}, 100);
		}
	}

	$("#button-submit-image").click(function() {
		
		var parametros = JSON.stringify({ "imageProfile": $("#input-encode-image").val().split(",")[1]});  

		if(<?php echo $_SESSION["bpoints"];?> > 200){
			if ($("#input-encode-image").val() != "") {
				startLoad();

				$.ajax({

					url: "http://"+host+":8888/api/settings/" + idUser + "/imageProfile",
					data:parametros,
					Accept : "application/json",
					contentType: "application/json",
					type: 'POST',
					success: function(json) {
						location.reload();
					},
					error: function(xhr, status, errorsg) {
						var error=JSON.parse(xhr.responseText);
						alert(error['error']);
					}
				});
			}
		} else {
			alert("insuficiente");
		}
	});
	$("#button-change-image").click(function() {
		$("#form-settings-image").css("display", "block");
	});
	$("#button-submit-image").mouseenter(function() {
		changeButtonBpoints(true, "image")
	});
	$("#button-submit-image").mouseleave(function() {
		changeButtonBpoints(false, "image")
	});

	//---------------------------

	$("#button-submit-username").click(function() {
		
		var parametros = JSON.stringify({ username: $("#input-new-username").val() });  
	
		if(<?php echo $_SESSION["bpoints"];?> > 200){
			if ($("#input-new-username").val() != "") {
				startLoad();

				$.ajax({

					url: "http://"+ host +":8888/api/settings/" + idUser + "/username",
					data:parametros,
					Accept : "application/json",
					contentType: "application/json",
					type: 'POST',
					success: function(json) {
						location.reload();
					},
					error: function(xhr, status, errorsg) {
						alert("ya esta tomado");
					}
				});
			}
		} else {
			alert("insuficiente");
		}	
	});
	$("#button-change-username").click(function() {
		$("#form-settings-username").css("display", "block");
	});
	$("#button-submit-username").mouseenter(function() {
		changeButtonBpoints(true, "username")
	});
	$("#button-submit-username").mouseleave(function() {
		changeButtonBpoints(false, "username")
	});

	//---------------------------

	$("#button-change-email").click(function() {
		$("#form-settings-email").css("display", "block");
	});
	$("#button-submit-email").click(function() {
		
		var parametros = JSON.stringify({ email: $("#input-new-email").val() });

		const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		  
		if(re.test($("#input-new-email").val())){
			startLoad();

			$.ajax({

				url: "http://"+ host +":8888/api/settings/" + idUser + "/email",
				data:parametros,
				Accept : "application/json",
				contentType: "application/json",
				type: 'POST',
				success: function(json) {
					location.reload();
				},
				error: function(xhr, status, errorsg) {
					alert("ya esta tomado");
				}
			});
		} else{
			alert("invalido");
		}
	});

	//---------------------------

	$("#button-submit-banner").click(function() {
		
		var parametros = JSON.stringify({ "banner": $("#input-encode-banner").val().split(",")[1]});  

		if(<?php echo $_SESSION["bpoints"];?> > 200){
			if ($("#input-encode-banner").val() != "") {
				startLoad();

				$.ajax({

					url: "http://"+host+":8888/api/settings/" + idUser + "/banner",
					data:parametros,
					Accept : "application/json",
					contentType: "application/json",
					type: 'POST',
					success: function(json) {
						location.reload();
					},
					error: function(xhr, status, errorsg) {
						var error=JSON.parse(xhr.responseText);
						alert(error['error']);
					}
				});
			}
		} else {
			alert("insuficiente");
		}
	});
	$("#button-change-banner").click(function() {
		$("#form-settings-banner").css("display", "block");
	});
	$("#button-submit-banner").mouseenter(function() {
		changeButtonBpoints(true, "banner")
	});
	$("#button-submit-banner").mouseleave(function() {
		changeButtonBpoints(false, "banner")
	});

	//---------------------------

	$("#button-change-password").click(function() {
		$("#form-settings-password").css("display", "block");
	});
	$("#button-submit-password").click(function(){

		if(<?php echo $_SESSION["password"] ?> == $("#input-actual-password").val()){

			if($("#input-password").val().length >= 8){

				if($("#input-password").val() == $('#input-confirm-password').val()){

					var parametros = JSON.stringify({ "password": $("#input-confirm-password").val()});
					startLoad();

					$.ajax({

						url: "http://"+host+":8888/api/settings/" + idUser + "/password",
						data:parametros,
						Accept : "application/json",
						contentType: "application/json",
						type: 'POST',
						success: function(json) {
							location.reload();
						},
						error: function(xhr, status, errorsg) {
							var error=JSON.parse(xhr.responseText);
							alert(error['error']);
						}
					});

				} else {
					alert("password desigual");
				}

			} else {
				alert("password invalida");
			}

		} else {
			alert("password incorrecta");
		}
	});

	//---------------------------

	$("#button-view-subs").click(function() {
		$("#form-settings-subs").css("display", "block");
	});
	$("#button-view-sponsors").click(function() {
		$("#form-settings-sponsors").css("display", "block");
	});
	$("#button-view-subscriptors").click(function() {
		$("#form-settings-subscriptors").css("display", "block");
	});
	$("#button-get-out").click(function() {
		$("#form-settings-get-out").css("display", "block");
	});

	//---------------------------

	$("#button-submit-get-out").click(function(){
		window.location = "../login/login.php";
	});


	var subscriptions = <?php echo json_encode($subscriptions) ?>;
	var sponsorsArtists = <?php echo json_encode($sponsorsArtists) ?>;
	var sponsorsPercentage = <?php echo json_encode($sponsorsPercentage) ?>;
	var subscriptors = <?php echo json_encode($subscriptors) ?>;
	var sponsors = <?php echo json_encode($sponsors) ?>;

	var divSubs = document.getElementById("div-view-subs");
	var divSponsors = document.getElementById("div-view-sponsors");
	var divSubscriptors = document.getElementById("div-view-subscriptors");

	for (var i = 0; i < subscriptions.length; i++) {
		var sub = document.createElement("h3");
		sub.className = "h3-activities";
		sub.innerHTML = subscriptions[i];
		divSubs.appendChild(sub);
	}

	for (var i = 0; i < sponsorsArtists.length; i++) {
		var sponsor = document.createElement("h3");
		sponsor.className = "h3-activities";
		sponsor.innerHTML = sponsorsArtists[i] + "<label style = 'float:right'>" + sponsorsPercentage[i] + "%    </label>";
		divSponsors.appendChild(sponsor);
	}

	for (var i = 0; i < subscriptors.length; i++) {
		var sub = document.createElement("h3");
		sub.className = "h3-activities";
		sub.innerHTML = subscriptors[i];
		divSubscriptors.appendChild(sub);
	}

	$(".h3-activities").click(function(){
		window.location = " ../artist-profile/artist-profile.php?index=&artist=" + $(this).html().split("<")[0];
	});
	
	$(".checkOptions").click(function() {
		var parametros = JSON.stringify({ change: $(this).prop('checked') });  
		var field      = $(this).attr("id").split("-")[1];

		$.ajax({
			url: "http://"+ host +":8888/api/settings/" + idUser + "/" + field,
			data:parametros,
			Accept : "application/json",
			contentType: "application/json",
			type: 'POST',
			error: function(xhr, status, errorsg) {
				var error=JSON.parse(xhr.responseText);
				alert(error['error']);
			}
		});
	});

	/*Abrir popup*/

	$(".button-change-setting").click(function() {
		$("#div-pop-up-background").css("display", "block");
		$("#div-pop-up").css("display", "block");
	})

	/*salir popup*/

	$("#div-cancel-image").click(function() {
		$("#div-pop-up-background").css("display", "none");
		$("#div-pop-up").css("display", "none");
		$(".form-settings").css("display", "none");

		//Resetear IMG-UPLOADED
		$("#div-drag-drop").css("display", "inline-block");
		$("#img-uploaded").css("display", "none");
		$("#input-image").val(null);
		$("#input-encode-banner").val("")

		$("#div-drag-drop-banner").css("display", "inline-block");
		$("#img-uploaded-banner").css("display", "none");
		$("#input-banner").val(null);
		$("#input-encode-image").val("")
	});

</script>

</html>