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

$API_URL = "http://localhost:8888/api/infoUsuario/" . $_SESSION["idUser"];
$res = getUrl($API_URL);
$status = $res[0];
$infoResponse = $res[1];
$resultado = json_decode($infoResponse, true);

if ($status == 200) { // ok

	$_SESSION["username"]        = $resultado["infoUsuario"]["username"];
	$_SESSION["email"]           = $resultado["infoUsuario"]["email"];
	//$_SESSION["password"]        = $resultado["infoUsuario"]["password"];
	$_SESSION["notificationsNewPublication"] = $resultado["infoUsuario"]["notificationsNewPublication"];
	$_SESSION["notificationsBuyAlert"]       = $resultado["infoUsuario"]["notificationsBuyAlert"];
	$_SESSION["notificationsInformSponsor"]  = $resultado["infoUsuario"]["notificationsInformSponsor"];
	
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
					<div id="edit-banner">
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
				</div>
			</div>
			<div>
				<h3>Activity</h3>
				<div class="things-settings">
					<div>
						<h4>Subscriptions</h4><button id="button-view-subs" class="button-change-setting">view</button>
					</div>
					<div>
						<h4>Purchases</h4><button id="button-view-mounthly-purchases" class="button-change-setting">view</button>
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
					<input type="hidden" id="input-encode-banner" name="encode-banner" value="<?php echo $bannerEncoded; ?>">
				</div>
			</div>
			<button id="button-submit-banner" class="button-submit">
				<img src="../icons/bpoints.png" id="button-img-bpoints-banner" class="button-img-bpoints">
				<div id="div-price-number-banner" class="div-price-number">200</div>
			</button>
		</div>

		<form action="" method="POST" id="form-settings-image" class="form-settings">

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
		</form>

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

		<form action="" method="POST" id="form-settings-password" class="form-settings">

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
		</form>

		<form action="" method="POST" id="form-settings-subs" class="form-settings">

			<!--view subscriptions-->
			<h4>Subscriptions</h4>
			<div id="div-view-subs" class="scrollbar-description">
				<h3 id="h3-view-subs">Isabela341</h3>
				<h3 id="h3-view-subs">LoboDelCalla</h3>
				<h3 id="h3-view-subs">Gianpa_dibujos</h3>
				<h3 id="h3-view-subs">JUAN</h3>
				<h3 id="h3-view-subs">Valentin_Tin</h3>
				<h3 id="h3-view-subs">XAIO</h3>
				<h3 id="h3-view-subs">Maradona10</h3>
				<h3 id="h3-view-subs">BEN10</h3>
				<h3 id="h3-view-subs">LoboSolitario</h3>
				<h3 id="h3-view-subs">EL_PIBE_10</h3>
				<h3 id="h3-view-subs">Gianaig_dibujos_xD</h3>
				<h3 id="h3-view-subs">JUAN_JOSE</h3>
				<h3 id="h3-view-subs">XD</h3>
				<h3 id="h3-view-subs">Pintor123</h3>
			</div>

		</form>

		<form action="" method="POST" id="form-settings-view-mounthly-purchases" class="form-settings">

			<!--view mounthly purchases-->
			<h4>Mounthly purchases</h4>
			<div id="div-view-mounthly-purchases" class="scrollbar-description">
				<h3 id="h3-view-mounthly-purchases">Subscription - <img src="../icons/bpoints.png" id="img-bpoints-bought" class="button-img-bpoints">1000</h3>
				<h3 id="h3-view-mounthly-purchases">Subscription - <img src="../icons/bpoints.png" id="img-bpoints-bought" class="button-img-bpoints">1000</h3>
				<h3 id="h3-view-mounthly-purchases">Subscription - <img src="../icons/bpoints.png" id="img-bpoints-bought" class="button-img-bpoints">1000</h3>
				<h3 id="h3-view-mounthly-purchases">Profile image - <img src="../icons/bpoints.png" id="img-bpoints-bought" class="button-img-bpoints">2000</h3>
				<h3 id="h3-view-mounthly-purchases">Username - <img src="../icons/bpoints.png" id="img-bpoints-bought" class="button-img-bpoints">3000</h3>
				<h3 id="h3-view-mounthly-purchases">Subscription - <img src="../icons/bpoints.png" id="img-bpoints-bought" class="button-img-bpoints">1000</h3>
				<h3 id="h3-view-mounthly-purchases">Picture - <img src="../icons/bpoints.png" id="img-bpoints-bought" class="button-img-bpoints">500</h3>
				<h3 id="h3-view-mounthly-purchases">Subscription - <img src="../icons/bpoints.png" id="img-bpoints-bought" class="button-img-bpoints">1000</h3>
				<h3 id="h3-view-mounthly-purchases">Picture - <img src="../icons/bpoints.png" id="img-bpoints-bought" class="button-img-bpoints">600</h3>
				<h3 id="h3-view-mounthly-purchases">Picture - <img src="../icons/bpoints.png" id="img-bpoints-bought" class="button-img-bpoints">900</h3>
				<h3 id="h3-view-mounthly-purchases">Subscription - <img src="../icons/bpoints.png" id="img-bpoints-bought" class="button-img-bpoints">1000</h3>
				<h3 id="h3-view-mounthly-purchases">Picture - <img src="../icons/bpoints.png" id="img-bpoints-bought" class="button-img-bpoints">800</h3>
				<h3 id="h3-view-mounthly-purchases">Subscription - <img src="../icons/bpoints.png" id="img-bpoints-bought" class="button-img-bpoints">1000</h3>
				<h3 id="h3-view-mounthly-purchases">Picture - <img src="../icons/bpoints.png" id="img-bpoints-bought" class="button-img-bpoints">100</h3>
				<h3 id="h3-view-mounthly-purchases">Picture - <img src="../icons/bpoints.png" id="img-bpoints-bought" class="button-img-bpoints">200</h3>
				<h3 id="h3-view-mounthly-purchases">Subscription - <img src="../icons/bpoints.png" id="img-bpoints-bought" class="button-img-bpoints">1000</h3>
				<h3 id="h3-view-mounthly-purchases">Picture - <img src="../icons/bpoints.png" id="img-bpoints-bought" class="button-img-bpoints">300</h3>
				<h3 id="h3-view-mounthly-purchases">Subscription - <img src="../icons/bpoints.png" id="img-bpoints-bought" class="button-img-bpoints">1000</h3>
				<h3 id="h3-view-mounthly-purchases">Picture - <img src="../icons/bpoints.png" id="img-bpoints-bought" class="button-img-bpoints">900</h3>
				<h3 id="h3-view-mounthly-purchases">Picture - <img src="../icons/bpoints.png" id="img-bpoints-bought" class="button-img-bpoints">800</h3>
				<h3 id="h3-view-mounthly-purchases">Subscription - <img src="../icons/bpoints.png" id="img-bpoints-bought" class="button-img-bpoints">1000</h3>
			</div>

		</form>

		<form action="" method="POST" id="form-settings-get-out" class="form-settings">

			<!--get out-->
			<div>
				<h4>Are you sure you want to get out?</h4>
				<button id="button-submit-get-out" type="submit" class="button-submit">
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
	var host = window.location["host"];

	window.onload = function() {
		
		editHeader();

		if ("<?php echo $_SESSION["userType"] ?>" != "artist") {
			$("#edit-banner").css("display", "none");
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

	};

	/*Efecto boton bpoints pop-up*/

	var idUser = <?php echo $_SESSION["idUser"] ?>

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

	$("#button-submit-image").mouseenter(function() {
		changeButtonBpoints(true, "image")
	});
	$("#button-submit-image").mouseleave(function() {
		changeButtonBpoints(false, "image")
	});

	//---------------------------
	$("#button-submit-username").click(function() {
		
		var parametros = JSON.stringify({ change: $("#input-new-username").val() });  
	
		if(<?php echo $_SESSION["bpoints"];?> > 200){
			if ($("#input-new-username").val() != "") {
				$.ajax({

					url: "http://localhost:8888/api/settings/" + idUser + "/username",
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

	$("#button-submit-username").mouseenter(function() {
		changeButtonBpoints(true, "username")
	});
	$("#button-submit-username").mouseleave(function() {
		changeButtonBpoints(false, "username")
	});

	//---------------------------
	$("#button-submit-banner").click(function() {
		
		var parametros = JSON.stringify({ "banner": $("#input-encode-banner").val().split(",")[1]});  
		console.log(parametros);
		if ($("#input-encode-banner").val() != "") {
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

	});
	$("#button-submit-banner").mouseenter(function() {
		changeButtonBpoints(true, "banner")
	});
	$("#button-submit-banner").mouseleave(function() {
		changeButtonBpoints(false, "banner")
	});
	//------------------------------
	$(".checkOptions").click(function() {
		var parametros = JSON.stringify({ change: $(this).prop('checked') });  
		var field      = $(this).attr("id").split("-")[1];

		$.ajax({

			url: "http://localhost:8888/api/settings/" + idUser + "/" + field,
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

	/*Contenido Pop-up*/

	$("#button-change-banner").click(function() {
		$("#form-settings-banner").css("display", "block");
	});

	$("#button-change-image").click(function() {
		$("#form-settings-image").css("display", "block");
	});

	$("#button-change-username").click(function() {
		$("#form-settings-username").css("display", "block");
	});

	$("#button-change-email").click(function() {
		$("#form-settings-email").css("display", "block");
	});

	$("#button-submit-email").click(function() {
		
		var parametros = JSON.stringify({ change: $("#input-new-email").val() });

		const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		  
		if(re.test($("#input-new-email").val())){
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


	$("#button-change-password").click(function() {
		$("#form-settings-password").css("display", "block");
	});

	$("#button-view-subs").click(function() {
		$("#form-settings-subs").css("display", "block");
	});

	$("#button-view-mounthly-purchases").click(function() {
		$("#form-settings-view-mounthly-purchases").css("display", "block");
	});

	$("#button-get-out").click(function() {
		$("#form-settings-get-out").css("display", "block");
	});

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