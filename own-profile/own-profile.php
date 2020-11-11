<html>

<head>
	<link rel="shortcut icon" href="../icons/icon-viewer.png" />
	<link rel="stylesheet" href="styles-own-profile.css">
	<link rel="stylesheet" href="../styles-general.css">
	<meta http-equiv="Content-Type" content=”text/html; charset=UTF-8″ />
	<meta name="viewport" content="width=device-width, user-scalable=no">
	<title>BayArt! - My Profile</title>
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

if (!empty($_GET["index"])) {
	$index = $_GET["index"];

	if ($index < 1) {
		$index = 1;
	}
	if ($index > $_SESSION["maxIndex"]) {
		$index = $_SESSION["maxIndex"];
	}
} else {
	$index = 1;
}

$API_URL = "http://localhost:8888/api/artistProfile/" . $_SESSION["idUser"] . "/" . $_SESSION["username"] . "/" . $index;
$res = getUrl($API_URL);
$status = $res[0];
$infoResponse = $res[1];
$resultado = json_decode($infoResponse, true);

$infoUploadedImages = array();

if ($status == 200) { // ok

	if ($index == 1) {
		$_SESSION["maxIndex"] = $resultado["maxIndex"];
	}

	$encodedImages        = $resultado["encodedImages"];
	$images               = $resultado["images"];

	foreach ($images as $image) {
		$idImage         = $image["idImage"];
		$encodedImage    = $encodedImages[$image["idImage"]];
		$title    		 = $image["name"];
		$srcImage        = '../images/images/' . $title . getExtension($encodedImage[0]);

		saveImage('..images/images/', $title, $encodedImage);

		$infoImage = array();

		array_push($infoImage, $_SESSION["username"]);
		array_push($infoImage, $srcImageProfileUser);
		array_push($infoImage, $title);
		array_push($infoImage, $srcImage);

		array_push($infoUploadedImages, $infoImage);
	}
}
/*
	$API_URL = "http://localhost:8888/api/library/". $_SESSION["idUser"] ."/" . $index;
	$res = getUrl($API_URL);
	$status = $res[0];
	$infoResponse = $res[1];
	$resultado = json_decode($infoResponse, true);

	$infoLibraryImages = array();

	if($status == 200){ // ok

		if($index == 1){
			$_SESSION["maxIndex"] = $resultado["maxIndex"];
		}

		$encodedImages        = $resultado["encodedImages"];
		$images               = $resultado["images"];

		foreach($images as $image){
			$idImage         = $image["idImage"];
			$encodedImage    = $encodedImages[$image["idImage"]];
			$title    		 = $image["name"];
			$srcImage        = '../images/images/' . $title . getExtension($encodedImage[0]);

			saveImage('../images/images/',$title,$encodedImage);

			$infoImage = array();

			array_push($infoImage,$_SESSION["username"]);
			array_push($infoImage,$srcImageProfileUser);
			array_push($infoImage,$title);
			array_push($infoImage,$srcImage);

			array_push($infoLibraryImages,$infoImage);
		}
	} */

?>

<body class="scrollbar">

	<div id="green-line" class="line"></div>

	<header>

		<!--Header Principal-->

		<div id="div-buttons">

			<button id="button-homepage" class="options" onclick="location.href='../homepage/homepage.php'">
				<img src="../icons/house.png" class="img-buttons">
			</button>

			<button id="button-browse" class="options" onclick="location.href='../browse/browse.php'">
				<img src="../icons/browse.png" class="img-buttons">
			</button>

			<button id="button-store" class="options" onclick="location.href='../store/store.php'">
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
				<label id="label-type" style="color: #674ea7 !important;"><?php echo $_SESSION["userType"]; ?></label>
			</div>

			<img src="<?php echo $_SESSION["srcProfilePicture"] ?>" id="profile-picture">
		</div>

	</header>

	<main id="main-top">
		<div id="div-banner-picture">
			<img src="<?php echo $_SESSION["srcBanner"] ?>" id="img-banner">
			<div id="div-artist-picture">
				<img src="<?php echo $_SESSION["srcProfilePicture"] ?>" id="img-artist-picture">
				<h2 style="color: white"><?php echo $_SESSION["username"] ?></h2>
			</div>
		</div>

		<a href="../upload-image/upload-image.php" id="a-upload-image" class="a-buttons">
			<button id="button-submit-upload-image" type="submit" class="button-submit">
				<img src="../icons/upload.png" id="button-img-upload-image" class="button-img-own-profile">
				<div id="div-price-number-upload-image" class="div-price-number"></div>
			</button>
		</a>
		<a href="../settings/settings.php" id="a-edit-profile" class="a-buttons">
			<button id="button-submit-edit-profile" type="submit" class="button-submit">
				<img src="../icons/icon-settings-green.png" id="button-img-edit-profile" class="button-img-own-profile">
				<div id="div-price-number-edit-profile" class="div-price-number"></div>
			</button>
		</a>
	</main>
	<main id="main-bottom">
		<div id="div-container-buttons">
			<button id="button-uploaded-images" disabled onclick="buttonUploaded()">
				<div class="div-img-word">
					<img src="../icons/upload-own-profile.png" id="img-uploaded-images">
					UPLOADED
				</div>

				<div id="div-background-uploaded"></div>
			</button>
			<button id="button-library-images" onclick="buttonLibrary()">
				<div class="div-img-word">
					<img src="../icons/icon-library-white.png" id="img-library-images">
					LIBRARY
				</div>

				<div id="div-background-library"></div>
			</button>
		</div>
		<div id="div-uploaded-images"></div>
		<div id="div-library-images"></div>

		<div id="div-index">
			<button id="button-index-left" class="button-index" type="submit">
				< </button> <label id="label-index"><?php echo $index ?></label>
					<button id="button-index-right" class="button-index" type="submit"> > </button>
		</div>

	</main>

</body>

<script src="../jquery.js"></script>
<script src="../basic-functions.js"></script>

<script>
	window.onload = function() {
		/*Order Main Images*/

		var infoImages = <?php echo json_encode($infoImages); ?>;

		if (window.screen.width > 1000) {
			orderImages("main-bottom", 200, 20, infoImages);
		} else if (window.screen.width > 500) {
			orderImages("main-bottom", 150, 15, infoImages);
		} else {
			orderImages("main-bottom", 100, 10, infoImages);
		}

		editHeader();

	};

	/*Efecto boton bpoints pop-up*/

	function changeButtonBpoints(shown, name) {
		if (shown) {
			$("#button-img-" + name).css("opacity", "0");
			$("#div-price-number-" + name).css("opacity", "0");
			setTimeout(function() {
				$("#button-submit-" + name).css("border", "5px solid #00a797");
				if (name == "upload-image") {
					$("#div-price-number-" + name).html("UPLOAD IMAGE");
					$("#button-img-" + name).css("display", "none");
				} else if (name == "edit-profile") {
					$("#div-price-number-" + name).html("EDIT PROFILE");
					$("#button-img-" + name).css("display", "none");
				}

				$("#button-img-" + name).css("display", "none");
				$("#div-price-number-" + name).css("opacity", "1");
			}, 100);
			setTimeout(function() {
				$("#button-submit-" + name).css("border", "2px solid #00a797")
			}, 300);
		} else {
			$("#div-price-number-" + name).css("opacity", "0");
			$("#button-submit-" + name).css("border", "none");
			setTimeout(function() {
				$("#button-img-" + name).css("opacity", "1");
				if (name == "upload-image") {
					$("#div-price-number-" + name).html(" ");
				} else if (name == "edit-profile") {
					$("#div-price-number-" + name).html(" ");
				}
				$("#button-img-" + name).css("display", "inline-block");
				$("#div-price-number-" + name).css("opacity", "1");

			}, 100);
		}
	}

	$("#button-submit-upload-image").mouseenter(function() {
		changeButtonBpoints(true, "upload-image")
	});
	$("#button-submit-upload-image").mouseleave(function() {
		changeButtonBpoints(false, "upload-image")
	});

	$("#button-submit-edit-profile").mouseenter(function() {
		changeButtonBpoints(true, "edit-profile")
	});
	$("#button-submit-edit-profile").mouseleave(function() {
		changeButtonBpoints(false, "edit-profile")
	});


	$("#div-uploaded-images").find('img').each(function(index) {
		$(this).clone().appendTo("#div-uploaded-images-copy");
	});

	/*tocar botones cambia de color*/

	$("#button-uploaded-images").click(function buttonUploaded() {
		$("#div-background-library").css("width", "0");
		$("#div-background-uploaded").css("width", "100%");

		document.getElementById("button-uploaded-images").disabled = true;
		setTimeout(function() {
			$("#div-uploaded-images").css("display", "block");
			$("#div-library-images").css("display", "none");

			$("#div-uploaded-images-copy").find('img').each(function(index) {
				$(this).clone().appendTo("#div-uploaded-images");
			});
			$("#div-library-images").find('div').each(function(index) {
				$(this).remove();
			});
			orderImages("div-uploaded-images", 150, 15);
		}, 400);
		setTimeout(function() {
			document.getElementById("button-library-images").disabled = false;
			$("#div-imgs-raspberry").css("opacity", "0");
		}, 400);
	})

	$("#button-library-images").click(function buttonLibrary() {
		$("#div-background-library").css("width", "100%");
		$("#div-background-uploaded").css("width", "0");

		document.getElementById("button-library-images").disabled = true;
		setTimeout(function() {
			$("#div-library-images").css("display", "block");
			$("#div-uploaded-images").css("display", "none");
			$("#div-library-images-copy").find('img').each(function(index) {
				$(this).clone().appendTo("#div-library-images");
			});
			$("#div-uploaded-images").find('div').each(function(index) {
				$(this).remove();
			});
			orderImages("div-library-images", 150, 15);
		}, 400);

		setTimeout(function() {
			document.getElementById("button-uploaded-images").disabled = false;
			$("#div-imgs-raspberry").css("opacity", "1");
		}, 400);
	})

	/*Abrir popup*/

	$(".buttons-profile-artist").click(function() {
		$("#div-pop-up-background").css("display", "block");
		$("#div-pop-up").css("display", "block");
	})

	/*Contenido Pop-up*/
	$("#button-subscribers").click(function() {
		$("#form-artist-profile-subscribe").css("display", "block");
	});

	$("#button-sponsors").click(function() {
		$("#form-artist-profile-sponsor").css("display", "block");
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
	});
</script>

</html>