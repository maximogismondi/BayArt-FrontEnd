<html>

<head>
	<link rel="shortcut icon" href="../icons/icon-viewer.png" />
	<link rel="stylesheet" href="styles-artist-profile.css">
	<link rel="stylesheet" href="../styles-general.css">
	<meta http-equiv="Content-Type" content=”text/html; charset=UTF-8″ />
	<meta name="viewport" content="width=device-width, user-scalable=no">
	<title>BayArt! - Profile Artist</title>
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

$API_URL = "http://localhost:8888/api/artistProfile/" . $_SESSION["idUser"] . "/" . $_GET["artist"] . "/" . $index;
$res = getUrl($API_URL);
$status = $res[0];
$infoResponse = $res[1];
$resultado = json_decode($infoResponse, true);

$infoImages = array();

if ($status == 200) { // ok

	$idArtist = $resultado["artist"]["idUser"];

	//---------------------------------------------------------------------------------
	$subs = $resultado["subscribers"];
	$bpointsArtist = $resultado["artist"]["bpoints"];

	$encodedBanner   = $resultado["encodedBanner"];
	$srcImageBanner  = '../images/artistsBanners/' . $_GET["artist"] . getExtension($encodedBanner[0]);
	saveImage('../images/artistsBanners/', $_GET["artist"], $encodedBanner);

	$encodedProfile         = $resultado["encodedProfilePicture"];
	$srcImageProfileArtist  = '../images/artistsProfileImages/' . $_GET["artist"] . getExtension($encodedProfile[0]);
	saveImage('../images/artistsProfileImages/', $_GET["artist"], $encodedProfile);

	$isSub = json_encode($resultado["subscribed"]);
	$sponsor = $resultado["sponsor"];

	$profit = intval($sponsor / 100 * $bpointsArtist / 100);

	//---------------------------------------------------------------------------------

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

		saveImage('../images/images/', $title, $encodedImage);

		$infoImage = array();

		array_push($infoImage, $_GET["artist"]);
		array_push($infoImage, $srcImageProfileArtist);
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

			<button id="button-magnifier" onclick="location.href='../search/search.php'">
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
				<label id="label-bpoints"><?php echo $_SESSION["bpoints"]?></label>
			</div>
			<div id="div-name-type">
				<label id="label-name"><?php echo $_SESSION["username"]?></label><br>
				<label id="label-type" style="color: #674ea7 !important;"><?php echo $_SESSION["userType"]; ?></label>
			</div>

			<img src="<?php echo $_SESSION["srcProfilePicture"]?>" id="profile-picture">
		</div>

	</header>

	<main id="main-top">
		<div id="div-banner-picture">
			<img src="<?php echo $srcImageBanner ?>" id="img-banner">
			<div id="div-artist-picture">
				<img src="<?php echo $srcImageProfileArtist ?>" id="img-artist-picture">
				<h2 style="color: white"><?php echo $_GET["artist"] ?></h2>
			</div>
		</div>
		<div id="div-buttons-artist-profile">
			<button class="buttons-profile-artist" id="button-subscribers">
				<img src="../icons/icon-register.png" id="button-img-subscribers">
				<div id="div-subscribers-number"><?php echo $subs ?></div>
			</button>
			<button class="buttons-profile-artist" id="button-sponsors">
				<img src="../icons/bpoints.png" id="button-img-sponsors">
				<div id="div-sponsors-number"><?php echo $bpointsArtist ?></div>
			</button>
		</div>
	</main>

	<main id="main-bottom">
	</main>

	<div id="div-index">
		<button id="button-index-left" class="button-index" type="submit">
			< </button> <label id="label-index"><?php echo $index ?></label>
				<button id="button-index-right" class="button-index" type="submit"> > </button>
	</div>

	<div id="div-pop-up-background"></div>

	<!--POPS UPS-->
	<div id="div-pop-up">
		<div id="div-cancel-image">
			<img src="../icons/cancel.png" id="img-cancel-image">
		</div>

		<!--subs-->
		<div id="div-confirm-sub">
			<h4>Are you sure you want to subscribe?</h4>
			<h4>You will have a 20% discount on artist purchases and it will appear on the homepage</h4>
			<h4 id="span-sub-error" class="error">You don't have enought bpoint to subscribe to this artists</h4>
			<button id="button-artist-profile-subscribe" type="submit" class="button-submit">
				<img src="../icons/bpoints.png" id="button-img-bpoints">
				<div id="div-price-number">200</div>
			</button>
		</div>

		<!--unsubs-->
		<div id="div-confirm-leave">
			<h4>Are you sure you want to leave?</h4>
			<h4>This action cannot be undone</h4>
			<h4>To re-subscribe you must pay again</h4>
			<button id="button-artist-profile-leave" type="submit" class="button-submit">
				<div id="div-leave">LEAVE</div>
			</button>
		</div>


		<!--sponsor-->
		<form action="" method="post">
			<div id="div-confirm-sponsor">
				<h4>Are you sure you want to invest in this artist?</h4>
				<h4>You can cancel the investment whenever you want</h4>
				<div id="div-price">
					<h4>To invest</h4>
					<div>
						<input id="input-price" type="number" min="1" max="<?php echo $_SESSION["bpoints"] ?>" value="1" style="font-size: 15">
						<img src="../icons/bpoints.png" id="img-bpoints-price">
					</div>
					<h4 id="h4-sponsor" style="margin-left: 0">0%</h4>
				</div>
				<button id="button-artist-profile-sponsor" class="button-submit">
					<div>SPONSOR</div>
				</button>
			</div>
		</form>

		<!--withdraw-->
		<div id="div-confirm-withdraw">
			<h4>You represent <label style="color: #00a797"><?php echo $sponsor / 100 ?>% </label> of the artist</h4>
			<h4>If you cancel the sponsor now, you will get <label style="color: #00a797"><?php echo $profit ?> bpoints</label> </h4>
			<button id="button-artist-profile-withdraw" class="button-submit">
				<div>WITHDRAW</div>
			</button>
		</div>
</body>

<script src="../jquery.js"></script>
<script src="../basic-functions.js"></script>

<script>
	/*cambiar botones*/
	var isSub = <?php echo $isSub ?>;
	var sponsor = <?php echo $sponsor ?>;
	var mensageSub, mensageSponsor = "";

	function changeButtonArtistProfile(shown, name) {
		if (shown) {
			$("#button-img-" + name).css("opacity", "0");
			$("#div-" + name + "-number").css("opacity", "0");
			setTimeout(function() {
				$("#button-" + name).css("border", "10px solid white")
				if (name == "subscribers") {
					$("#div-" + name + "-number").html(mensageSub);
				} else {
					$("#div-" + name + "-number").html(mensageSponsor);
				}
				$("#button-img-" + name).css("display", "none");
				$("#div-" + name + "-number").css("opacity", "1");
			}, 100);
			setTimeout(function() {
				$("#button-" + name).css("border", "2px solid white")
			}, 300);
		} else {
			$("#div-" + name + "-number").css("opacity", "0");
			$("#button-" + name).css("border", "none")
			setTimeout(function() {
				if (name == "subscribers") {
					$("#div-" + name + "-number").html(<?php echo $subs ?>);
				} else {
					var bPointsInt = <?php echo $bpointsArtist ?>;

					if (bPointsInt >= 1000000) {
						$("#div-sponsors-number").html(parseInt(bPointsInt / 1000000) + "M");
					} else if (bPointsInt >= 1000) {
						$("#div-sponsors-number").html(parseInt(bPointsInt / 1000) + "K");
					} else {
						$("#div-sponsors-number").html(bPointsInt);
					}
				}
				$("#button-img-" + name).css("opacity", "1");
				$("#button-img-" + name).css("display", "inline-block");
				$("#div-" + name + "-number").css("opacity", "1");

			}, 100);

		}
	}

	$("#button-subscribers").mouseenter(function() {
		changeButtonArtistProfile(true, "subscribers")
	});
	$("#button-subscribers").mouseleave(function() {
		changeButtonArtistProfile(false, "subscribers")
	});

	$("#button-sponsors").mouseenter(function() {
		changeButtonArtistProfile(true, "sponsors")
	});
	$("#button-sponsors").mouseleave(function() {
		changeButtonArtistProfile(false, "sponsors")
	});

	/*Order Main Images*/

	$(document).ready(function() {

		var infoImages = <?php echo json_encode($infoImages); ?>;

		if (window.screen.width > 1000) {
			orderImages("main-bottom", 200, 20, infoImages);
		} else if (window.screen.width > 500) {
			orderImages("main-bottom", 150, 15, infoImages);
		} else {
			orderImages("main-bottom", 100, 10, infoImages);
		}

		editHeader();

		if (isSub) {
			$("#button-subscribers").css("background", "#7c7c7c");
			mensageSub = "LEAVE";
		} else {
			mensageSub = "SUBSCRIBE";
		}

		if (sponsor != 0) {
			$("#button-sponsors").css("background", "#7c7c7c");
			mensageSponsor = "WITHDRAW";
		} else {
			mensageSponsor = "SPONSOR";
		}

		var index = <?php echo $index ?>;

		$("#button-index-left").click(function() {
			index--;
			window.location.href = "artist-profile.php?artist=<?php echo $_GET["artist"] ?>&index=" + index;
		});

		$("#button-index-right").click(function() {
			index++;
			window.location.href = "artist-profile.php?artist=<?php echo $_GET["artist"] ?>&index=" + index;
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

		var bPointsInt = parseInt($("#div-sponsors-number").text());

		if (bPointsInt >= 1000000) {
			$("#div-sponsors-number").html(parseInt(bPointsInt / 1000000) + "M");
		} else if (bPointsInt >= 1000) {
			$("#div-sponsors-number").html(parseInt(bPointsInt / 1000) + "K");
		} else {
			$("#div-sponsors-number").html(bPointsInt);
		}
	});

	/*Abrir popup*/

	$(".buttons-profile-artist").click(function() {
		$("#div-pop-up-background").css("display", "block");
		$("#div-pop-up").css("display", "block");
	})

	/*Contenido Pop-up*/

	var idUser = <?php echo $_SESSION["idUser"] ?>;
	var idArtist = <?php echo $idArtist ?>;
	var bpoints = <?php echo $_SESSION["bpoints"] ?>;
	var bpointsArtist = <?php echo $bpointsArtist ?>;

	$("#button-subscribers").click(function() {
		$("#div-confirm-sponsor").css("display", "none");
		$("#div-confirm-withdraw").css("display", "none");

		if (isSub) {
			$("#div-confirm-leave").css("display", "block");
		} else {
			$("#div-confirm-sub").css("display", "block");
		}

		$("#button-artist-profile-leave").click(function() {
			$.ajax({
				url: "http://localhost:8888/api/stopSubscription/" + idUser + "/" + idArtist,
				type: 'POST',
				success: function(json) {
					window.location.href = "artist-profile.php?artist=<?php echo $_GET["artist"] ?>";
				}
			});
		});

		$("#button-artist-profile-subscribe").click(function() {
			if (bpoints - 200 >= 0) {
				$.ajax({
					url: "http://localhost:8888/api/subscribe/" + idUser + "/" + idArtist,
					type: 'POST',
					success: function(json) {
						window.location.href = "artist-profile.php?artist=<?php echo $_GET["artist"] ?>";
					}
				});
			} else {
				$("#span-sub-error").css("display", "inline-block");
			}

		});
	});

	$("#button-sponsors").click(function() {
		$("#div-confirm-leave").css("display", "none");
		$("#div-confirm-sub").css("display", "none");

		if (sponsor == 0) {
			$("#div-confirm-sponsor").css("display", "block");
		} else {
			$("#div-confirm-withdraw").css("display", "block");
		}

		$("#input-price").keyup(function() {
			sponsor = parseInt($("#input-price").val());
			var percentage = (parseInt(((sponsor * 100) / (bpointsArtist + sponsor)) * 100)) / 100 + "%";
			$("#h4-sponsor").html(percentage);
		});

		$("#button-artist-profile-sponsor").click(function() {
			if (sponsor <= bpoints && sponsor > 0) {
				$.ajax({
					url: "http://localhost:8888/api/sponsor/" + idUser + "/" + idArtist + "/" + $("#input-price").val(),
					type: 'POST',

					success: function(json) {
						window.location.href = "artist-profile.php?artist=<?php echo $_GET["artist"] ?>";
					}
				});
			}
		});

		$("#button-artist-profile-withdraw").click(function() {
			$.ajax({
				url: "http://localhost:8888/api/stopSponsor/" + idUser + "/" + idArtist,
				type: 'POST',

				success: function(json) {
					window.location.href = "artist-profile.php?artist=<?php echo $_GET["artist"] ?>";
				}
			});
		});
	});

	/*salir popup*/

	$("#div-cancel-image").click(function() {
		$("#div-pop-up-background").css("display", "none");
		$("#div-pop-up").css("display", "none");

	});

	/*cambiar botones pops ups*/

	function changeButtonBpoints(shown) {
		if (shown) {
			$("#button-img-bpoints").css("opacity", "0");
			$("#div-price-number").css("opacity", "0");
			setTimeout(function() {
				$("#button-artist-profile-subscribe").css("border", "5px solid white")
				$("#div-price-number").html("SUBSCRIBE");
				$("#button-img-bpoints").css("display", "none");
				$("#div-price-number").css("opacity", "1");
			}, 100);
			setTimeout(function() {
				$("#button-artist-profile-subscribe").css("border", "2px solid white")
			}, 300);
		} else {
			$("#div-price-number").css("opacity", "0");
			$("#button-artist-profile-subscribe").css("border", "none")
			setTimeout(function() {
				$("#div-price-number").html("200");
				$("#button-img-bpoints").css("opacity", "1");
				$("#button-img-bpoints").css("display", "inline-block");
				$("#div-price-number").css("opacity", "1");

			}, 100);
		}
	}

	$("#button-artist-profile-subscribe").mouseenter(function() {
		changeButtonBpoints(true)
	});
	$("#button-artist-profile-subscribe").mouseleave(function() {
		changeButtonBpoints(false)
	});
</script>

</html>