<html>

<head>
	<link rel="shortcut icon" href="../icons/icon-viewer.png" />
	<link rel="stylesheet" href="styles-browse.css">
	<link rel="stylesheet" href="../styles-general.css">
	<meta http-equiv="Content-Type" content=”text/html; charset=UTF-8″ />
	<meta name="viewport" content="width=device-width, user-scalable=no">
	<title>BayArt! - Browse</title>
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

$reset = "true";

if (!empty($_GET["tags"])) {
	$tags = $_GET["tags"];
} else {
	$tags = "null";
}

if (!empty($_GET["index"])) {
	$index = $_GET["index"];

	if ($index < 1) {
		$index = 1;
	}
	if ($index > $_SESSION["maxIndex"]) {
		$index = $_SESSION["maxIndex"];
	}
	$reset = "false";
} else {
	$index = 1;
}

if (empty($_GET["index"]) && !empty($_GET["tags"])) {
	$openFilters = true;
} else {
	$openFilters = false;
}

$API_URL = "http://localhost:8888/api/browse/" . $_SESSION["idUser"] . "/" . $index . "/" . $reset;
$requestBody = json_encode(array("tags" => $tags));
$res = postUrlRequestBody($API_URL, $requestBody);
$status = $res[0];
$infoResponse = $res[1];
$resultado = json_decode($infoResponse, true);

$infoImages = array();

if ($status == 200) { // ok

	if (empty($_GET["index"])) {
		$_SESSION["maxIndex"] = $resultado["maxIndex"];
	}

	$encodedImages        = $resultado["imagesEncoded"];
	$encodedProfiles      = $resultado["profileImages"];
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
		saveImage('../images/artistsProfileImages/', $username, $encodedProfile);

		$infoImage = array();

		array_push($infoImage, $username);
		array_push($infoImage, $srcImageProfile);
		array_push($infoImage, $title);
		array_push($infoImage, $srcImage);

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

			<button id="button-browse" class="options">
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
			<h2 id="h2-subtitle">BROWSE</h2>

			<button id="button-arrow">

				<img id="img-arrow" src="../icons/arrow.png" class="img-buttons">
				<h3 id="h3-filter">FILTER</h3>

			</button>
		</nav>

		<div id="div-filter">
			<div id="div-column1">

				<input type="checkbox" id="3D-checkBox" class="input-checkbox"> <label id="3D-label">3D</label> <br>
				<input type="checkbox" id="Animation-checkBox" class="input-checkbox"> <label id="Animation-label">Animation</label> <br>
				<input type="checkbox" id="Anime-checkBox" class="input-checkbox"> <label id="Anime-label">Anime</label> <br>
				<input type="checkbox" id="Comics-checkBox" class="input-checkbox"> <label id="Comics-label">Comics</label> <br>
				<input type="checkbox" id="Emoji-checkBox" class="input-checkbox"> <label id="Emoji-label">Emoji</label> <br>
				<input type="checkbox" id="Horror-checkBox" class="input-checkbox"> <label id="Horror-label">Horror</label> <br>
				<input type="checkbox" id="DigitalArt-checkBox" class="input-checkbox"> <label id="DigitalArt-label">Digital Art</label>

			</div>

			<div id="div-column2">

				<input type="checkbox" id="Fractal-checkBox" class="input-checkbox"> <label id="Fractal-label">Fractal</label> <br>
				<input type="checkbox" id="PixelArt-checkBox" class="input-checkbox"> <label id="PixelArt-label">PixelArt</label> <br>
				<input type="checkbox" id="Photograpy-checkBox" class="input-checkbox"> <label id="Photograpy-label">Photograpy</label> <br>
				<input type="checkbox" id="StreetArt-checkBox" class="input-checkbox"> <label id="StreetArt-label">Street Art</label> <br>
				<input type="checkbox" id="Fantasy-checkBox" class="input-checkbox"> <label id="Fantasy-label">Fantasy</label> <br>
				<input type="checkbox" id="ScienceFiction-checkBox" class="input-checkbox"> <label id="ScienceFiction-label">Science Fiction</label> <br>
				<input type="checkbox" id="Wallpaper-checkBox" class="input-checkbox"> <label id="Wallpaper-label">Wallpaper</label>

			</div>

		</div>
		<input id="input-tags" name="tags" type="hidden" value="<?php echo $tags ?>">

	</header>

	<main id="main-images">
	</main>

</body>

<script src="../jquery.js"></script>
<script src="../basic-functions.js"></script>

<script>
	var index = <?php echo $index ?>;

	window.onload = function() {

		var infoImages = <?php echo json_encode($infoImages) ?>;
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

	};

	var tagList = [];

	if ($("#input-tags").val() != "null") {

		tagList = $("#input-tags").val().split(',');
		for (var i = 0; i < tagList.length; i++) {
			$("#" + tagList[i] + "-checkBox").prop('checked', true);
			checkBoxState(tagList[i] + "-checkBox", "white", "#7c7c7c");
		}

	}

	$(".input-checkbox").click(function() {

		var idCheckBox = $(this).attr("id");

		if (!$(this).prop('checked')) {
			tagList.splice(tagList.indexOf(idCheckBox.split('-')[0]), 1);
			if (tagList.length == 0) {
				tagList = "null";
			}
		} else {
			tagList.push(idCheckBox.split('-')[0]);
		}

		$("#input-tags").val(tagList);

		window.location.href = "browse.php?index=&tags=" + $("#input-tags").val();

	});

	if (<?php echo json_encode($openFilters) ?>) {
		changeArrow();
	}

</script>

</html>