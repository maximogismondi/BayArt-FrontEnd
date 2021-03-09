<html>

<head>
	<link rel="shortcut icon" href="../icons/icon-viewer.png" />
	<link rel="stylesheet" href="styles-library.css">
	<link rel="stylesheet" href="../styles-general.css">
	<meta http-equiv="Content-Type" content=”text/html; charset=UTF-8″ />
	<meta name="viewport" content="width=device-width, user-scalable=no">
	<title>BayArt! - Library</title>
</head>
<?php

include "../php-functions.php";

session_start();

$download = false;

if(!empty($_GET["download"])){

	$download = true;

	$API_URL = "http://localhost:8888/api/download/" . $_SESSION["idUser"];
	$res = getUrl($API_URL);
	$status = $res[0];
	$infoResponse = $res[1];
	$resultado = json_decode($infoResponse, true);

	array_map( 'unlink', array_filter((array) glob("../raspberry-files/Raspberry/images/*") ) );  
	array_map( 'unlink', array_filter((array) glob("../raspberry-files/Raspberry/txts/var.txt") ) );  
	array_map( 'unlink', array_filter((array) glob("../raspberry-zips/" . $_SESSION["username"] . ".zip") ) );  
	$usernames = fopen("../raspberry-files/Raspberry/txts/usernames.txt", "w");
	$picNames = fopen("../raspberry-files/Raspberry/txts/picNames.txt", "w");
	$var = fopen("../raspberry-files/Raspberry/txts/var.txt", "w");
	$indexImages = 0;

	if($status == 200){
		$encodedImages        = $resultado["encodedImages"];
		$images               = $resultado["images"];
		$artists              = $resultado["artists"];

		foreach ($images as $image) {
			$idImage         = $image["idImage"];
			$idArtist        = $image["idUser"];
			$encodedImage    = $encodedImages[$idImage];
			$title    		 = $image["name"];
			$username 	 	 = getUsername($image["idUser"], $artists);

			saveImage('../images/images/', $title, $encodedImage);

			saveImage('../raspberry-files/Raspberry/images/', $indexImages, $encodedImage);

			fwrite($usernames, $username . "\n");

			fwrite($picNames, $title . "\n");

			$infoImage = array();

			$indexImages++;

		}

		fclose($usernames);
		fclose($picNames);
		fclose($var);
		zip('../raspberry-files', '../raspberry-zips/' . $_SESSION["username"] . '.zip');
	}

	

}



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

$API_URL = "http://localhost:8888/api/library/" . $_SESSION["idUser"] . "/" . $index;
$res = getUrl($API_URL);
$status = $res[0];
$infoResponse = $res[1];
$resultado = json_decode($infoResponse, true);

$infoImages = array();

if ($status == 200) { // ok

	if ($index == 1) {
		$_SESSION["maxIndex"] = $resultado["maxIndex"];
	}

	$encodedImages        = $resultado["encodedImages"];
	$encodedProfiles      = $resultado["encodedProfilePicture"];
	$images               = $resultado["images"];
	$artists              = $resultado["artists"];

	foreach ($images as $image) {
		$idImage         = $image["idImage"];
		$idArtist        = $image["idUser"];
		$encodedProfile  = $encodedProfiles[$idArtist];
		$encodedImage    = $encodedImages[$idImage];
		$title    		 = $image["name"];
		$username 	 	 = getUsername($image["idUser"], $artists);
		$srcImage        = '../images/images/' . $title . getExtension($encodedImage[0]);
		$srcImageProfile = '../images/artistsProfileImages/' . $username . getExtension($encodedProfile[0]);

		saveImage('../images/images/', $title, $encodedImage);

		$infoImage = array();

		array_push($infoImage, $username);
		array_push($infoImage, $srcImageProfile);
		array_push($infoImage, $title);
		array_push($infoImage, $srcImage);
		array_push($infoImage, $encodedImage);

		array_push($infoImages, $infoImage); 
	}
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
				<label id="label-type" style="color: #674ea7 !important;"><?php echo $_SESSION["userType"]; ?></label>
			</div>

			<img src="<?php echo $_SESSION["srcProfilePicture"] ?>" id="profile-picture">
		</div>

		<!--Header Secundario-->

		<nav id="nav-subtitle">
			<h2 id="h2-subtitle">LIBRARY</h2>
			<img src="../icons/raspberry.png" id="img-raspberry">
			
		</nav>

	</header>

	<main id="main-images">
	</main>

	<div id="div-pop-up-background"></div>

	<!--POPS UPS-->
	<div id="div-pop-up">
		<div id="div-cancel-image">
			<img src="../icons/cancel.png" id="img-cancel-image">
		</div>

		<div id="div-raspberry-library" class="form-settings">
			<div>
				<h4>Do you want to download the executable + the images for the raspberry?</h4>
				<button id="button-download">
				<a id="a-download">
					<img src="../icons/upload-own-profile.png" id="img-download">
				</a>
				</button>
			</div>

		</div>
	</div>

</body>

<script src="../jquery.js"></script>
<script src="../basic-functions.js"></script>
<script src="../dist/jszip.min.js"></script>
<script src="../dist/jszip.js"></script>
<script src="../dist/FileSaver.js"></script>

<script>
	/*Abrir popup*/

	$("#img-raspberry").click(function() {
		$("#div-pop-up-background").css("display", "block");
		$("#div-pop-up").css("display", "block");
		$("#div-raspberry-library").css("display", "block");
	})

	/*salir popup*/

	$("#div-cancel-image").click(function() {
		$("#div-pop-up-background").css("display", "none");
		$("#div-pop-up").css("display", "none");
		$(".form-settings").css("display", "none");
	});

	var infoImages = <?php echo json_encode($infoImages) ?>;

	/*Order Main Images*/

	window.onload = function() {

		var index = <?php echo $index ?>;
		var maxIndex = <?php echo $_SESSION["maxIndex"]; ?>;

		/*Order Main Images*/

		if (window.screen.width > 1000) {
			orderImages("main-images", 200, 20, infoImages, index, maxIndex);
		} else if (window.screen.width > 500) {
			orderImages("main-images", 150, 15, infoImages, index, maxIndex);
		} else {
			orderImages("main-images", 100, 10, infoImages, index, maxIndex);
		}

		editHeader();

		if (<?php echo json_encode($download)?>){
			window.open("../raspberry-zips/<?php echo $_SESSION["username"] ?>.zip", "_self");
			window.history.pushState('library', 'Title', 'library.php');
			$('#a-download').click(function(){
				window.open("../raspberry-zips/<?php echo $_SESSION["username"] ?>.zip", "_self");
			});
		} else {
			$('#a-download').click(function(){
				startLoad();
				window.location = (window.location+"").split("?")[0] + "?index=1&download=true";
			});
		}

	};
</script>

</html>