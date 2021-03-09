<html>

<head>
	<link rel="shortcut icon" href="../icons/icon-viewer.png" />
	<link rel="stylesheet" href="styles-homepage.css">
	<link rel="stylesheet" href="../styles-general.css">
	<meta http-equiv="Content-Type" content=”text/html; charset=UTF-8″ />
	<meta name="viewport" content="width=device-width, user-scalable=no">
	<title>BayArt! - Homepage</title>
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

$API_URL = "http://localhost:8888/api/homepage/" . $_SESSION["idUser"] . "/" . $index;
$res = getUrl($API_URL);
$status = $res[0];
$infoResponse = $res[1];
$resultado = json_decode($infoResponse, true);

$infoImages = array();
$infoProfileImages = array();

if ($status == 200) { // ok

	if ($index == 1) {
		$_SESSION["maxIndex"] = $resultado["maxIndex"];
	}

	$encodedImages        = $resultado["imagesEncoded"];
	$encodedProfiles      = $resultado["profileImages"];
	$images               = $resultado["images"];
	$artists              = $resultado["artists"];

	foreach ($artists as $artist) {

		$idArtist        = $artist["idUser"];
		$username        = $artist["username"];
		$encodedProfile  = $encodedProfiles[$idArtist];

		$srcImageProfile = '../images/artistsProfileImages/' . $username . getExtension($encodedProfile[0]);
		saveImage('../images/artistsProfileImages/', $username, $encodedProfile);

		$infoProfile = array();
		array_push($infoProfile, $srcImageProfile);
		array_push($infoProfile, $username);
		array_push($infoProfileImages, $infoProfile);
	}


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

		array_push($infoImages, $infoImage);
	}
}

$API_URL = "http://localhost:8888/api/dailyRewards/" . $_SESSION["idUser"];
$resultado =  getUrl($API_URL);
$status = $resultado[0];
$dailyRewards = array(0);
$claimed = false;

if ($status == 200) {
	$dailyRewards = json_decode($resultado[1], true)["dailyReward"];
	$_SESSION["bpoints"] += $dailyRewards[sizeof($dailyRewards) - 1];
} else {
	$claimed = true;
}
?>

<body class="scrollbar">

	<div id="green-line" class="line"></div>

	<header>

		<!--Header Principal-->

		<div id="div-buttons">

			<button id="button-homepage" class="options">
				<img src="../icons/house.png" class="img-buttons">
			</button>

			<button id="button-browse" class="options" onclick="location.href='../browse/browse.php'">
				<img src="../icons/browse.png" class="img-buttons">
			</button>

			<button id="button-store" class="options" onclick="location.href='../store/store.php'">
				<img src="../icons/store.png" class="img-buttons">
			</button>

		</div>
<<<<<<< HEAD
		
		<form id="form-search" style="display: inline">
			<div id="div-search-bar">

				<input id="input-search-bar" type="text">

				<button id="button-magnifier">
					<img id="img-magnifier" src="../icons/magnifier.png" class="img-buttons">
				</button>
			</div>
		</form>
=======

		<div id="div-search-bar">
			<input id="input-search-bar" type="text">

			<button id="button-magnifier" onclick="location.href='../search/search.php'">
				<img id="img-magnifier" src="../icons/magnifier.png" class="img-buttons">
			</button>
		</div>
>>>>>>> d8d30ef8c71a05a3c367f1d0651cf2253999a83d

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
			<scroll-container>
				<button id="button-carousel-left" class="button-carousel">
					< </button> <button id="button-carousel-right" class="button-carousel"> >
				</button>
				<scroll-container id="carousel-images-profiles">
					<!-- imagenes de perfil -->
				</scroll-container>
			</scroll-container>
		</nav>

	</header>

	<main id="main-images">
	</main>

<<<<<<< HEAD
=======
	<div id="div-index">
		<button id="button-index-left" class="button-index" type="submit">
			< </button> <label id="label-index"><?php echo $index ?></label>
				<button id="button-index-right" class="button-index" type="submit"> > </button>
	</div>

>>>>>>> d8d30ef8c71a05a3c367f1d0651cf2253999a83d
	<div id="div-pop-up-background">
	</div>

	<div id="div-pop-up">
		<!--daily reward-->
		<div>
			<h3 id="h3-reward">Daily reward</h3>

			<div id="div-cancel-image">
				<h4 id="h4-bpoints"> +<?php echo json_encode($dailyRewards[sizeof($dailyRewards) - 1]); ?> <img src="../icons/bpoints.png" id="img-bpoints-reward"></h4>
				<img src="../icons/bpoints.png" id="img-cancel-image">
			</div>

			<div id="div-days-bpoints">

				<div id="monday" class="div-days-of-week">
					<img src="../icons/bpoints-wait.png" class="img-bpoints-daily-reward">
					<h3 class="h3-name-days">M</h3>
				</div>
				<div id="tuesday" class="div-days-of-week">
					<img src="../icons/bpoints-wait.png" class="img-bpoints-daily-reward">
					<h3 class="h3-name-days">T</h3>
				</div>
				<div id="wednesday" class="div-days-of-week">
					<img src="../icons/bpoints-wait.png" class="img-bpoints-daily-reward">
					<h3 class="h3-name-days">W</h3>
				</div>
				<div id="thursday" class="div-days-of-week">
					<img src="../icons/bpoints-wait.png" class="img-bpoints-daily-reward">
					<h3 class="h3-name-days">T</h3>
				</div>
				<div id="friday" class="div-days-of-week">
					<img src="../icons/bpoints-wait.png" class="img-bpoints-daily-reward">
					<h3 class="h3-name-days">F</h3>
				</div>
				<div id="saturday" class="div-days-of-week">
					<img src="../icons/bpoints-wait.png" class="img-bpoints-daily-reward">
					<h3 class="h3-name-days">S</h3>
				</div>
				<div id="sunday" class="div-days-of-week">
					<img src="../icons/bpoints-wait.png" class="img-bpoints-daily-reward">
					<h3 class="h3-name-days">S</h3>
				</div>

			</div>

		</div>
	</div>
</body>
<script src="../jquery.js"></script>
<<<<<<< HEAD
<script src="../caroucel-profiles.js"></script>
=======
<script src="caroucel-profiles.js"></script>
>>>>>>> d8d30ef8c71a05a3c367f1d0651cf2253999a83d
<script src="../basic-functions.js"></script>

<script>
	var dailyRewards = <?php echo json_encode($dailyRewards); ?>;
	var day = "";

	switch (dailyRewards.length) {
		case 1:
			day = "monday";
			break;
		case 2:
			day = "tuesday";
			break;
		case 3:
			day = "wednesday";
			break;
		case 4:
			day = "thursday";
			break;
		case 5:
			day = "friday";
			break;
		case 6:
			day = "saturday";
			break;
		case 7:
			day = "sunday";
			break;
	}

	var i = 0;
	$("#div-days-bpoints").find('img').each(function() {
		if (dailyRewards.length - 1 > i) {
			if (dailyRewards[i] == 50) {
				this.src = "../icons/bpoints-claimed.png"
			} else {
				this.src = "../icons/bpoints-unclaimed.png"
			}
		}
		i++;
	});

	i = 0;
	$("#div-days-bpoints").find('h3').each(function() {
		if (dailyRewards.length - 1 > i) {
			if (dailyRewards[i] == 50) {
				$(this).css("color", "#00a797");
			} else {
				$(this).css("color", "#c02925");
			}
			i++;
		}
	});

	if (<?php echo json_encode($claimed); ?>) {
		leavePopUp();
	} else {
		$("#label-bpoints").html(<?php echo ($_SESSION["bpoints"] - $dailyRewards[sizeof($dailyRewards) - 1]); ?>);
	}

	window.onload = function() {

		var infoImages = <?php echo json_encode($infoImages); ?>;

		var artistsCarrousel = <?php echo json_encode($infoProfileImages); ?>;

		if (artistsCarrousel.length > 0) {
			var carrouselProfiles = document.getElementById("carousel-images-profiles");

			for (var i = 0; i < artistsCarrousel.length; i++) {

				var div = document.createElement("div");
				div.id = "div-profile-image-carrousel-" + artistsCarrousel[i][1];
				div.className = "div-profile-image-carrousel";
				div.style.textAlign = "center";
				div.style.width = "100px";

				var image = document.createElement("img");
				image.src = artistsCarrousel[i][0];
				image.id = "img-carrousel-artist-" + artistsCarrousel[i][1];
				image.className = "img-profile-image-carrousel";
				image.style.transition = "all 0.5s";

				var label = document.createElement("label");
				label.id = "label-carrousel-artist-" + artistsCarrousel[i][1];
				label.innerHTML = artistsCarrousel[i][1];
				label.style.color = "white";
<<<<<<< HEAD
				label.style.fontSize = "12px";
=======
				label.style.fontSize = "15px";
>>>>>>> d8d30ef8c71a05a3c367f1d0651cf2253999a83d
				label.style.fontWeight = "bold";
				label.style.display = "none";
				label.style.display = "none";

				div.appendChild(image);
				div.appendChild(label);
				carrouselProfiles.appendChild(div);
			}

			var imagenesCargadas = 0;

			$("#carousel-images-profiles").find('.img-profile-image-carrousel').each(function() {
				document.getElementById($(this).attr("id")).onload = function() {
					imagenesCargadas++;
					if (imagenesCargadas == artistsCarrousel.length) {
						startCarroucelProfiles();
					}
				};
			});

			$(".div-profile-image-carrousel").click(function() {
<<<<<<< HEAD
				window.location.href = "../artist-profile/artist-profile.php?index=&artist=" + ($(this).attr("id")).split('-')[4];
=======
				window.location.href = "../artist-profile/artist-profile.php?artist=" + ($(this).attr("id")).split('-')[4];
>>>>>>> d8d30ef8c71a05a3c367f1d0651cf2253999a83d
			});

			$(".div-profile-image-carrousel").hover(function() {
				var artist = ($(this).attr("id")).split('-')[4];

				if ($("#label-carrousel-artist-" + artist).css("display") == "none") {
					$("#img-carrousel-artist-" + artist).css("height", "40px");
					$("#img-carrousel-artist-" + artist).css("width", "40px");
					$("#label-carrousel-artist-" + artist).css("display", "inline-block");
				} else {
					$("#img-carrousel-artist-" + artist).css("height", "60px");
					$("#img-carrousel-artist-" + artist).css("width", "60px");
					$("#label-carrousel-artist-" + artist).css("display", "none");
				}
			});
<<<<<<< HEAD
		} else {
			$("#nav-subtitle").css("display","none");
		}

		var index = <?php echo $index ?>;
		var maxIndex = <?php echo $_SESSION["maxIndex"]; ?>;
=======
		}


>>>>>>> d8d30ef8c71a05a3c367f1d0651cf2253999a83d

		/*Order Main Images*/

		if (window.screen.width > 1000) {
<<<<<<< HEAD
			orderImages("main-images", 200, 20, infoImages, index, maxIndex);
		} else if (window.screen.width > 500) {
			orderImages("main-images", 150, 15, infoImages, index, maxIndex);
		} else {
			orderImages("main-images", 100, 10, infoImages, index, maxIndex);
=======
			orderImages("main-images", 200, 20, infoImages);
		} else if (window.screen.width > 500) {
			orderImages("main-images", 150, 15, infoImages);
		} else {
			orderImages("main-images", 100, 10, infoImages);
>>>>>>> d8d30ef8c71a05a3c367f1d0651cf2253999a83d
		}

		editHeader();

<<<<<<< HEAD
=======
		var index = <?php echo $index ?>;

		$("#button-index-left").click(function() {
			index--;
			window.location.href = "homepage.php?index=" + index;
		});

		$("#button-index-right").click(function() {
			index++;
			window.location.href = "homepage.php?index=" + index;
		});

		var maxIndex = <?php echo $_SESSION["maxIndex"]; ?>;

		if (index == 1) {
			$("#button-index-left").css("opacity", "0", "pointer-events", "null");
		}
		if (index == maxIndex) {
			$("#button-index-right").css("opacity", "0", "pointer-events", "null");
		}
		if (index == 1 && index == maxIndex) {
			$("#label-index").css("display", "none");
			$("#div-index").height(20);
		}



>>>>>>> d8d30ef8c71a05a3c367f1d0651cf2253999a83d
	};

	/*Pop up*/

	function changeButtonBpoints(shown) {
		if (shown) {
			$("#img-cancel-image").attr("src", "../icons/icon-viewer.png");
		} else {
			$("#img-cancel-image").attr("src", "../icons/bpoints.png");
		}
	}

	$("#img-cancel-image").mouseenter(function() {
		changeButtonBpoints(true)
	});
	$("#img-cancel-image").mouseleave(function() {
		changeButtonBpoints(false)
	});

	function transformDailyReward() {

		var X = 0;
		var Y = 0;
		var heightImg = 0;

		if (day == "monday") {
			$(document).ready(function() {
				if (window.screen.width > 533) {
					X = -200;
					Y = 105;
					heightImg = 60;
				} else if (window.screen.width > 510) {
					X = -192;
					Y = 101;
					heightImg = 56;
				} else if (window.screen.width > 490) {
					X = -192;
					Y = 95;
					heightImg = 54;
				} else if (window.screen.width > 471) {
					X = -182;
					Y = 90;
					heightImg = 52;
				} else if (window.screen.width > 438) {
					X = -173;
					Y = 90;
					heightImg = 50;
				} else if (window.screen.width > 423) {
					X = -170;
					Y = 88;
					heightImg = 48;
				} else if (window.screen.width > 395) {
					X = -153;
					Y = 85;
					heightImg = 46;
				} else if (window.screen.width > 371) {
					X = -145;
					Y = 79;
					heightImg = 46;
				} else if (window.screen.width > 349) {
					X = -140;
					Y = 76;
					heightImg = 46;
				}
				$("#img-cancel-image").css("height", heightImg);
				$("#img-cancel-image").css("transform", "translate(" + X + "px," + Y + "px)");
				setTimeout(function() {
					$("#monday").css("color", "#00a797");
					$("#h4-bpoints").css("display", "block");
				}, 600);
			});
		} else if (day == "tuesday") {
			$(document).ready(function() {

				if (window.screen.width > 533) {
					X = -130;
					Y = 105;
					heightImg = 60;
				} else if (window.screen.width > 510) {
					X = -124;
					Y = 101;
					heightImg = 56;
				} else if (window.screen.width > 490) {
					X = -127;
					Y = 95;
					heightImg = 54;
				} else if (window.screen.width > 471) {
					X = -119;
					Y = 90;
					heightImg = 52;
				} else if (window.screen.width > 438) {
					X = -113;
					Y = 90;
					heightImg = 50;
				} else if (window.screen.width > 423) {
					X = -113;
					Y = 88;
					heightImg = 48;
				} else if (window.screen.width > 395) {
					X = -99;
					Y = 85;
					heightImg = 46;
				} else if (window.screen.width > 371) {
					X = -95;
					Y = 79;
					heightImg = 46;
				} else if (window.screen.width > 349) {
					X = -92;
					Y = 76;
					heightImg = 46;
				}
				$("#img-cancel-image").css("height", heightImg);
				$("#img-cancel-image").css("transform", "translate(" + X + "px," + Y + "px)");
				setTimeout(function() {
					$("#tuesday").css("color", "#00a797");
					$("#h4-bpoints").css("display", "block");
				}, 600);
			});
		} else if (day == "wednesday") {
			$(document).ready(function() {

				if (window.screen.width > 533) {
					X = -60;
					Y = 105;
					heightImg = 60;
				} else if (window.screen.width > 510) {
					X = -58;
					Y = 101;
					heightImg = 56;
				} else if (window.screen.width > 490) {
					X = -62;
					Y = 95;
					heightImg = 54;
				} else if (window.screen.width > 471) {
					X = -55;
					Y = 90;
					heightImg = 52;
				} else if (window.screen.width > 438) {
					X = -54;
					Y = 90;
					heightImg = 50;
				} else if (window.screen.width > 423) {
					X = -56;
					Y = 88;
					heightImg = 48;
				} else if (window.screen.width > 395) {
					X = -45;
					Y = 85;
					heightImg = 46;
				} else if (window.screen.width > 371) {
					X = -43;
					Y = 79;
					heightImg = 46;
				} else if (window.screen.width > 349) {
					X = -40;
					Y = 76;
					heightImg = 46;
				}
				$("#img-cancel-image").css("height", heightImg);
				$("#img-cancel-image").css("transform", "translate(" + X + "px," + Y + "px)");
				setTimeout(function() {
					$("#wednesday").css("color", "#00a797");
					$("#h4-bpoints").css("display", "block");
				}, 600);
			});
		} else if (day == "thursday") {
			$(document).ready(function() {

				if (window.screen.width > 533) {
					X = 9;
					Y = 105;
					heightImg = 60;
				} else if (window.screen.width > 510) {
					X = 9;
					Y = 101;
					heightImg = 56;
				} else if (window.screen.width > 490) {
					X = 4;
					Y = 95;
					heightImg = 54;
				} else if (window.screen.width > 471) {
					X = 7;
					Y = 90;
					heightImg = 52;
				} else if (window.screen.width > 438) {
					X = 7;
					Y = 90;
					heightImg = 50;
				} else if (window.screen.width > 423) {
					X = 1;
					Y = 88;
					heightImg = 48;
				} else if (window.screen.width > 395) {
					X = 10;
					Y = 85;
					heightImg = 46;
				} else if (window.screen.width > 371) {
					X = 8;
					Y = 79;
					heightImg = 46;
				} else if (window.screen.width > 349) {
					X = 10;
					Y = 76;
					heightImg = 46;
				}
				$("#img-cancel-image").css("height", heightImg);
				$("#img-cancel-image").css("transform", "translate(" + X + "px," + Y + "px)");
				setTimeout(function() {
					$("#thursday").css("color", "#00a797");
					$("#h4-bpoints").css("display", "block");
				}, 600);
			});
		} else if (day == "friday") {
			$(document).ready(function() {

				if (window.screen.width > 533) {
					X = 79;
					Y = 105;
					heightImg = 60;
				} else if (window.screen.width > 510) {
					X = 76;
					Y = 101;
					heightImg = 56;
				} else if (window.screen.width > 490) {
					X = 68;
					Y = 95;
					heightImg = 54;
				} else if (window.screen.width > 471) {
					X = 70;
					Y = 90;
					heightImg = 52;
				} else if (window.screen.width > 438) {
					X = 67;
					Y = 90;
					heightImg = 50;
				} else if (window.screen.width > 423) {
					X = 59;
					Y = 88;
					heightImg = 48;
				} else if (window.screen.width > 395) {
					X = 63;
					Y = 85;
					heightImg = 46;
				} else if (window.screen.width > 371) {
					X = 60;
					Y = 79;
					heightImg = 46;
				} else if (window.screen.width > 349) {
					X = 60;
					Y = 76;
					heightImg = 46;
				}
				$("#img-cancel-image").css("height", heightImg);
				$("#img-cancel-image").css("transform", "translate(" + X + "px," + Y + "px)");
				setTimeout(function() {
					$("#friday").css("color", "#00a797");
					$("#h4-bpoints").css("display", "block");
				}, 600);
			});
		} else if (day == "saturday") {
			$(document).ready(function() {

				if (window.screen.width > 533) {
					X = 149;
					Y = 105;
					heightImg = 60;
				} else if (window.screen.width > 510) {
					X = 143;
					Y = 101;
					heightImg = 56;
				} else if (window.screen.width > 490) {
					X = 133;
					Y = 95;
					heightImg = 54;
				} else if (window.screen.width > 471) {
					X = 133;
					Y = 90;
					heightImg = 52;
				} else if (window.screen.width > 438) {
					X = 127;
					Y = 90;
					heightImg = 50;
				} else if (window.screen.width > 423) {
					X = 116;
					Y = 88;
					heightImg = 48;
				} else if (window.screen.width > 395) {
					X = 118;
					Y = 85;
					heightImg = 46;
				} else if (window.screen.width > 371) {
					X = 111;
					Y = 79;
					heightImg = 46;
				} else if (window.screen.width > 349) {
					X = 110;
					Y = 76;
					heightImg = 46;
				}
				$("#img-cancel-image").css("height", heightImg);
				$("#img-cancel-image").css("transform", "translate(" + X + "px," + Y + "px)");
				setTimeout(function() {
					$("#saturday").css("color", "#00a797");
					$("#h4-bpoints").css("display", "block");
				}, 600);
			});
		} else if (day == "sunday") {
			$(document).ready(function() {

				if (window.screen.width > 533) {
					X = 219;
					Y = 105;
					heightImg = 60;
				} else if (window.screen.width > 510) {
					X = 210;
					Y = 101;
					heightImg = 56;
				} else if (window.screen.width > 490) {
					X = 199;
					Y = 95;
					heightImg = 54;
				} else if (window.screen.width > 471) {
					X = 196;
					Y = 90;
					heightImg = 52;
				} else if (window.screen.width > 438) {
					X = 187;
					Y = 90;
					heightImg = 50;
				} else if (window.screen.width > 423) {
					X = 173;
					Y = 88;
					heightImg = 48;
				} else if (window.screen.width > 395) {
					X = 172;
					Y = 85;
					heightImg = 46;
				} else if (window.screen.width > 371) {
					X = 162;
					Y = 79;
					heightImg = 46;
				} else if (window.screen.width > 349) {
					X = 161;
					Y = 76;
					heightImg = 46;
				}
				$("#img-cancel-image").css("height", heightImg);
				$("#img-cancel-image").css("transform", "translate(" + X + "px," + Y + "px)");
				setTimeout(function() {
					$("#sunday").css("color", "#00a797");
					$("#h4-bpoints").css("display", "block");
				}, 600);
			});
		}

		setTimeout(function() {
			leavePopUp();
		}, 2000);
		setTimeout(function() {
			$("#label-bpoints").html(<?php echo $_SESSION["bpoints"]; ?>);
			editHeader();
		}, 600);
	}

	$("#img-cancel-image").click(transformDailyReward);

	/*salir popup*/
	function leavePopUp() {
		$("#div-pop-up-background").css("display", "none");
		$("#div-pop-up").css("display", "none");
		$(".form-reward").css("display", "none");
	};
<<<<<<< HEAD
	
=======
>>>>>>> d8d30ef8c71a05a3c367f1d0651cf2253999a83d
</script>

</html>