<html>

<head>
	<link rel="shortcut icon" href="../icons/icon-viewer.png" />
	<link rel="stylesheet" href="styles-upload-image.css">
	<link rel="stylesheet" href="../styles-general.css">
	<meta http-equiv="Content-Type" content=”text/html; charset=UTF-8″ />
	<meta name="viewport" content="width=device-width, user-scalable=no">
	<title>BayArt! - Upload Image</title>
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

$title = $description = $imageEncode = $srcImage = $tags = "";
$price = 0;
$titleErr = $descriptionErr = $priceErr = $imageEncodeErr = $uploadErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (!preg_match("/^[a-zA-Z0-9]*$/", $_POST["title"])) {
		$titleErr = "Only letters, numbers and '-' allowed";
	}
	if (strlen(test_input($_POST["tags"])) != 0) {
		$tags = test_input($_POST["tags"]);
	}

	$title = test_input($_POST["title"]);
	$price = test_input($_POST["price"]);

	if (empty($_POST["description"])) {
		$descriptionErr = "Description is required";
	} else {
		$description = test_input($_POST["description"]);
	}

	if (empty($_POST["encode-image"])) {
		$imageEncodeErr = "Image is required";
	} else {
		$imageEncode = $_POST["encode-image"];

		$data = explode(',', $imageEncode);

		$extension = explode(';', explode('/', $data[0])[1])[0];

		$ifp = fopen('../images/images/' . $title . '.' . $extension, 'wb');

		$srcImage = '../images/images/' . $title . '.' . $extension;

		fwrite($ifp, base64_decode($data[1]));
		fclose($ifp);
	}


	if ($titleErr == "" && $descriptionErr == "" && $priceErr == "" && $imageEncodeErr == "" && $uploadErr == "") {

		if ($tags == "") {
			$API_URL = "http://localhost:8888/api/uploadImage/" . $_SESSION["idUser"] . "/" . $title . "/" . "null" . "/" . $price;
		} else {
			$API_URL = "http://localhost:8888/api/uploadImage/" . $_SESSION["idUser"] . "/" . $title . "/" . $tags . "/" . $price;
		}
		$requestBody = json_encode(array("encodedImage" => explode(',', $imageEncode)[1], "description" => $description));
		$res = postUrlRequestBody($API_URL, $requestBody);
		$status = $res[0];
		$infoResponse = $res[1];
		$resultado = json_decode($infoResponse, true);

		if ($status != 200) { // ok
			$titleErr = "The title is already used";
		} else {
			$_SESSION["bpoints"] -= 500;
			array_map('unlink', array_filter((array) glob("../tempImages/*")));
			header('Location: ' . "../own-profile/own-profile.php");
		}
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
				<label id="label-type" style="color: #674ea7 !important"><?php echo $_SESSION["userType"] ?></label>
			</div>

			<img src="<?php echo $_SESSION["srcProfilePicture"] ?>" id="profile-picture">

		</div>

		<!--Header Secundario-->

		<nav id="nav-subtitle">
			<h2 id="h2-subtitle">UPLOAD IMAGE</h2>
		</nav>
	</header>
	<main>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="form" name="form-upload-image" onsubmit="return checkTitleAndPrice()">
			<div id="div-title">
				<input type="text" name="title" maxlength="60" id="input-title-image" placeholder="Title" value="<?php echo $title; ?>">
				<span id="span-title" class="error" minlength="5"> <?php echo $titleErr; ?></span>
			</div>
			<div id="div-image-description">
				<div id="div-image">
					<div id="div-cancel-image">
						<img src="../icons/cancel.png" id="img-cancel-image">
					</div>
					<img id="img-uploaded" src="<?php echo $srcImage; ?>">
					<div id="div-drag-drop">
						<div id="div-upload-image">
							<img id="img-icon-upload" src="../Icons/upload.png">
							<label id="label-input-image" for="input-image">
								<h2 id="h2-input-image" style="font-size: 17;">Upload Image</h2>
							</label>
							<span id="span-image-uploaded" class="error"> <?php echo $imageEncodeErr; ?></span>
						</div>
					</div>
					<input type="file" id="input-image" name="input-image" accept="image/*" style="display:none" src="<?php echo $srcImage; ?>">
					<input type="hidden" id="input-encode-image" name="encode-image" value="<?php echo $imageEncode; ?>">
				</div>
				<div id="div-description">
					<span id="span-description" class="error"> <?php echo $descriptionErr; ?></span>
					<h3 id="h3-descrption-title">Description</h3>
					<h4 id="h4-character-counter">0 / 1000</h4>
					<div id="div-description-text">
						<textarea type="text" name="description" id="textarea-description" maxlength="1000" placeholder="Write the description of your picture" onkeyup="charcountupdate(this.value)" value="<?php echo $description; ?>"><?php echo $description; ?></textarea>
					</div>
				</div>
			</div>
			<div id="div-tags-price-button-post">
				<div id="div-tags-price">
					<div id="div-tags">
						<label id="button-arrow">

							<img src="../icons/arrow.png" class="img-buttons" id="img-arrow">
							<h3 id="h3-number-filter">0</h3>
							<h3 id="h3-filter">TAGS</h3>

						</label>

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
					</div>
					<div id="div-price">
						<input type="checkbox" id="input-checkBox-price">
						<h3 id="h3-price">SET PRICE</h3>
						<div id="div-input-price">
							<input id="input-price" type="number" name="price" max="10000" value="<?php echo $price; ?>">
							<img src="../icons/bpoints.png" id="img-bpoints-price">
						</div>
					</div>
				</div>
				<div id="div-button-post">
					<span id="span-button-uploaded" class="error"></span>
					<button id="button-post">
						<img src="../icons/bpoints.png" id="button-img-bpoints">
						<div id="div-price-number">500</div>
					</button>
				</div>
			</div>
		</form>
	</main>


</body>

<script src="../jquery.js"></script>
<script src="../basic-functions.js"></script>
<script src="select-image.js"></script>
<script src="drag-drop-image.js"></script>
<script>
	window.onload = function() {
		if (($("#img-uploaded").attr("src")).length > 0) {
			uploadImageOrder();
		}

		editHeader();
	};

	/*activar precio*/

	if ($("#input-price").val() != 0) {
		$("#input-checkBox-price").prop('checked', true);
		$("#h3-price").css("color", "white");
		$("#div-input-price").css("opacity", "1");
		$("#div-input-price").css("pointer-events", "auto");
	}

	$("#input-checkBox-price").click(function() {
		if ($(this).prop('checked')) {
			$("#h3-price").css("color", "white");
			$("#div-input-price").css("opacity", "1");
			$("#div-input-price").css("pointer-events", "auto");
		} else {
			$("#h3-price").css("color", "#7c7c7c");
			$("#div-input-price").css("opacity", "0.5");
			$("#div-input-price").css("pointer-events", "none");
			$("#input-price").val(0);
		}
	});

	/*Limitar a 3 tags*/

	var bpointsUser = <?php echo $_SESSION["bpoints"] ?>;

	function checkTitleAndPrice() {
		if (bpointsUser < 500) {
			$("#span-button-uploaded").html("You don't have enought bpoints");
			return false;
		} else {
			$("#span-button-uploaded").html("");
			if (($("#input-title-image").val()).length > 4) {
				return true;
			}
			if (($("#input-title-image").val()).length == 0) {
				$("#span-title").html("Title is required");
			} else {
				$("#span-title").html("The title be over 4 characters")
			}

			return false;
		}
	}

	var tagList = [];
	if ($("#input-tags").val() != "") {
		var tagList = $("#input-tags").val().split(',');
		for (var i = 0; i < tagList.length; i++) {
			$("#" + tagList[i] + "-checkBox").prop('checked', true);
			checkBoxState(tagList[i] + "-checkBox", "white", "#7c7c7c");
		}
		document.getElementById("h3-number-filter").innerHTML = tagList.length;
		if (tagList.length == 3) displayCheckbox(0.3, "none");
	}

	$(".input-checkbox").click(function() {

		var idCheckBox = $(this).attr("id");

		if (!$(this).prop('checked')) {
			tagList.splice(tagList.indexOf(idCheckBox.split('-')[0]), 1);
			if (tagList.length == 2) displayCheckbox(1, "auto");

		} else if (tagList.length < 3) {
			tagList.push(idCheckBox.split('-')[0]);
			if (tagList.length == 3) displayCheckbox(0.3, "none");
		}

		$("#input-tags").val(tagList);

		checkBoxState(idCheckBox, "white", "#7c7c7c");
		document.getElementById("h3-number-filter").innerHTML = tagList.length;

	});

	/*cambiar boton*/
	function changeButtonBpoints(shown) {
		if (shown) {
			$("#button-img-bpoints").css("opacity", "0");
			$("#div-price-number").css("opacity", "0");
			setTimeout(function() {
				$("#button-post").css("border", "5px solid white")
				$("#div-price-number").html("UPLOAD");
				$("#button-img-bpoints").css("display", "none");
				$("#div-price-number").css("opacity", "1");
			}, 100);
			setTimeout(function() {
				$("#button-post").css("border", "2px solid white")
			}, 300);
		} else {
			$("#div-price-number").css("opacity", "0");
			$("#button-post").css("border", "none")
			setTimeout(function() {
				$("#div-price-number").html("500");
				$("#button-img-bpoints").css("opacity", "1");
				$("#button-img-bpoints").css("display", "inline-block")
				$("#div-price-number").css("opacity", "1");

			}, 100);
		}
	}

	$("#button-post").mouseenter(function() {
		changeButtonBpoints(true)
	});
	$("#button-post").mouseleave(function() {
		changeButtonBpoints(false)
	});

	/*Borrar imagen (se cancela con settings asi que lo ponemos aca)*/

	$("#div-cancel-image").click(function() {
		$("#input-encode-image").val("");
		$("#img-uploaded").attr("src","");
		deleteImage();
	});

</script>

</html>