<html>
<head>
	<link rel="shortcut icon" href="../icons/icon-viewer.png" />
	<link rel="stylesheet" href="styles-individual-image.css">
	<link rel="stylesheet" href="../styles-general.css">
	<meta http-equiv="Content-Type" content=”text/html; charset=UTF-8″ />
	<meta name="viewport" content="width=device-width, user-scalable=no">
	<title>BayArt! - Image</title>
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

$API_URL = "http://localhost:8888/api/individualImage/" . $_SESSION["idUser"] . "/" . $_GET["title"];
$res = getUrl($API_URL);
$status = $res[0];
$infoResponse = $res[1];
$resultado = json_decode($infoResponse, true);

if ($status == 200) { //ok
	$encodedImage          = $resultado["encodedImage"];
	$encodedProfilePicture = $resultado["encodedProfilePicture"];
	$image                 = $resultado["image"];
	$artist                = $resultado["artist"];
	$bookmark              = $resultado["bookmark"];
	$subscribed            = json_encode($resultado["subscribed"]);

	saveImage('../images/images/', $_GET["title"], $encodedImage);
	$srcImage        = '../images/images/' . $_GET["title"] . getExtension($encodedImage[0]);

	saveImage('../images/artistsProfileImages/', $artist["username"], $encodedProfilePicture);
	$srcImageProfile = '../images/artistsProfileImages/' .  $artist["username"] . getExtension($encodedProfilePicture[0]);

	$tags = "";

	if (!empty($image["tags"])) {
		$tags = $image["tags"][0];

		for ($i = 1; $i < sizeof($image["tags"]); $i++) {
			$tags = $tags . " - " . $image["tags"][$i];
		}
	}

	$price = $image["price"];

	if ($subscribed == "true") {
		$price = "<s>" . $price . "</s> " . ($price * 0.8);
	}

	if ($artist["username"] == $_SESSION["username"]) {
		$hrefArtist = " ../own-profile/own-profile.php";
	} else {
		$hrefArtist = " ../artist-profile/artist-profile.php?index=&artist=" . $artist["username"];
	}
}

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

	</header>
	<main>
		<div id="div-title-image">
			<h4 id="h4-title"><?php echo $image["name"] ?></h4>
		</div>

		<div id="div-tags">
			<h4 id="h4-tags"><?php echo $tags ?></h4>
		</div>
		<section id="section-all">
			<div id="div-image-description">
				<div id="div-image">
					<img src="<?php echo $srcImage ?>" id="img-image">
				</div>
				<div id="div-title-description">
					<h4 id="h4-description">Description</h4>
					<div id="div-description" class="scrollbar-description">
						<p id="p-description">
							<?php echo $image["description"] ?>
						</p>
					</div>
				</div>
			</div>
			<div id="div-artist">
				<div id="div-circle">
					<img src="<?php echo $srcImageProfile ?>" id="img-circle">
				</div>
				<a href="<?php echo $hrefArtist ?>" style="text-decoration: none;">
					<h4 id="h4-username-artist"><?php echo $artist["username"] ?></h4>
				</a>
				<button id="button-bookmark">
					<img src="../icons/bookmark-disable.png" id="img-bookmark">
				</button>
			</div>
			<button id="button-buy-image" type="submit">
				<img src="../icons/bpoints.png" id="button-img-bpoints-image">
				<div id="div-price-number-image"><?php echo $price ?></div>
			</button>

		</section>
		<span id="span-buy-error" class="error">You don't have enought bpoint to buy this image</span>

	</main>

</body>

<script src="../jquery.js"></script>
<script src="../basic-functions.js"></script>

<script>
	var tags = "<?php echo $tags ?>";
	var idUser = <?php echo $_SESSION["idUser"] ?>;
	var idImage = <?php echo $image['idImage'] ?>;
	var price = <?php echo $image["price"] ?>;
	var bpoints = <?php echo $_SESSION["bpoints"] ?>;
	var host = window.location["host"];

	if (<?php echo $subscribed ?>) {
		price = price * 0.8;
	}

	if (tags == "") {
		$("#div-tags").css("display", "none");
	}

	/*cambiar boton de lista de deseados*/
	var bookmark = <?php echo json_encode($bookmark) ?>;
	if (bookmark) {
		$("#img-bookmark").attr("src", "../icons/bookmark.png");
	}

	$("#button-bookmark").click(function() {
		if (!bookmark) {
			$.ajax({
				url: "http://"+host+":8888/api/action/" + idUser + "/" + idImage + "/addBookmark",
				type: 'POST',
				success: function(json) {
					$("#img-bookmark").attr("src", "../icons/bookmark.png");
					bookmark = !bookmark;
				}
			});

		} else {
			$.ajax({
				url: "http://"+host+":8888/api/action/" + idUser + "/" + idImage + "/removeBookmark",
				type: 'POST',
				success: function(json) {
					$("#img-bookmark").attr("src", "../icons/bookmark-disable.png");
					bookmark = !bookmark;
				}
			});
		}
	});

	$("#button-buy-image").click(function() {

		if (bpoints > price) {
			$.ajax({
				url: "http://"+host+":8888/api/action/" + idUser + "/" + idImage + "/buy",
				type: 'POST',
				success: function(json) {
					window.location.href = "../library/library.php";
				}
			});
		} else {
			$("#span-buy-error").css("display", "block");
		}
	});

	/*Setear alto y ancho de imagen*/

	window.onload = function() {

		if (window.screen.width > 570) {
			setWidthHeight("img-image", "div-image", 500, 500);
		} else if (window.screen.width > 551) {
			setWidthHeight("img-image", "div-image", 490, 490);
		} else if (window.screen.width > 541) {
			setWidthHeight("img-image", "div-image", 480, 480);
		} else if (window.screen.width > 531) {
			setWidthHeight("img-image", "div-image", 470, 470);
		} else if (window.screen.width > 521) {
			setWidthHeight("img-image", "div-image", 460, 460);
		} else if (window.screen.width > 511) {
			setWidthHeight("img-image", "div-image", 450, 450);
		} else if (window.screen.width > 501) {
			setWidthHeight("img-image", "div-image", 440, 440);
		} else if (window.screen.width > 491) {
			setWidthHeight("img-image", "div-image", 430, 430);
		} else if (window.screen.width > 481) {
			setWidthHeight("img-image", "div-image", 420, 420);
		} else if (window.screen.width > 471) {
			setWidthHeight("img-image", "div-image", 410, 410);
		} else if (window.screen.width > 461) {
			setWidthHeight("img-image", "div-image", 400, 400);
		} else if (window.screen.width > 451) {
			setWidthHeight("img-image", "div-image", 390, 390);
		} else if (window.screen.width > 441) {
			setWidthHeight("img-image", "div-image", 380, 380);
		} else if (window.screen.width > 431) {
			setWidthHeight("img-image", "div-image", 380, 380);
		} else if (window.screen.width > 421) {
			setWidthHeight("img-image", "div-image", 370, 370);
		} else if (window.screen.width > 411) {
			setWidthHeight("img-image", "div-image", 360, 360);
		} else if (window.screen.width > 401) {
			setWidthHeight("img-image", "div-image", 350, 350);
		} else if (window.screen.width > 391) {
			setWidthHeight("img-image", "div-image", 340, 340);
		} else if (window.screen.width > 381) {
			setWidthHeight("img-image", "div-image", 330, 330);
		} else if (window.screen.width > 371) {
			setWidthHeight("img-image", "div-image", 320, 320);
		} else if (window.screen.width > 361) {
			setWidthHeight("img-image", "div-image", 310, 310);
		} else if (window.screen.width > 351) {
			setWidthHeight("img-image", "div-image", 300, 300);
		} else {
			setWidthHeight("img-image", "div-image", 290, 290);
		}


		$("#div-image-description").css("height", ($("#div-image").height()));

		$("#div-title-description").width($("#div-image-description").width() - $("#div-image").width() -
			parseInt($("#div-title-description").css("marginRight")) - parseInt($("#div-image").css("marginLeft")) - 20);
		$("#div-artist").css("width", ($("#div-image").width()));

		/*Chequea si la imagen se vende*/

		if (<?php echo $image["price"] ?> == 0 || <?php echo json_encode($resultado["purchased"]) ?>) {
			$("#img-bookmark").css("display", "none");
			$("#button-buy-image").css("display", "none");
			$("#div-artist").css("width", "94%");
		} else {
			$("#div-artist").css("width", ($("#div-image").width()));
			if (window.screen.width > 920) {
				$("#button-buy-image").css("margin-right", ($("#div-title-description").width() / 2) +
					parseInt($("#div-title-description").css("marginRight")) - 75);
			}
		}

		editHeader();
	};

	/*Efecto boton bpoints comprar*/

	function changeButtonBpoints(shown) {
		if (shown) {
			$("#button-img-bpoints-image").css("opacity", "0");
			$("#div-price-number-image").css("opacity", "0");
			setTimeout(function() {
				$("#button-buy-image").css("border", "5px solid white");
				$("#div-price-number-image").html("BUY");
				$("#button-img-bpoints-image").css("display", "none");
				$("#div-price-number-image").css("opacity", "1");
			}, 100);
			setTimeout(function() {
				$("#button-buy-image").css("border", "2px solid white")
			}, 300);
		} else {
			$("#div-price-number-image").css("opacity", "0");
			$("#button-buy-image").css("border", "none");
			setTimeout(function() {
				$("#div-price-number-image").html("<?php echo $price ?>");
				$("#button-img-bpoints-image").css("opacity", "1");
				$("#button-img-bpoints-image").css("display", "inline-block");
				$("#div-price-number-image").css("opacity", "1");

			}, 100);
		}
	}

	$("#button-buy-image").mouseenter(function() {
		changeButtonBpoints(true)
	});
	$("#button-buy-image").mouseleave(function() {
		changeButtonBpoints(false)
	});

</script>

</html>