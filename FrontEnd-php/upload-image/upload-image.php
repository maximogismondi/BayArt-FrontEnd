<html>
	<head>
		<link rel="shortcut icon" href="../icons/icon-viewer.png"/>
		<link rel="stylesheet" href="styles-upload-image.css">
		<link rel="stylesheet" href="../styles-general.css">
		<meta http-equiv="Content-Type" content=”text/html; charset=UTF-8″ />
		<meta name="viewport" content="width=device-width, user-scalable=no">
		<title>BayArt! - Upload Image</title>
	</head>

<body class="scrollbar">

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
				<label id="label-bpoints">1234</label>
			</div>
			<div id="div-name-type">
				<label id="label-name">Soledad1</label><br>
				<label id="label-type">Viewer</label>
			</div>

			<div id="div-profile-picture"></div>
		</div>

		<!--Header Secundario-->

		<nav id="nav-subtitle">
			<h2 id="h2-subtitle">UPLOAD IMAGE</h2>
		</nav>
	</header>


<?php 

	include "../php-functions.php";

	session_start();

	$_SESSION["bpoints"] = 1000;

/*
	$putImage = false;

	$titleErr = $imgErr = "";
	$title = $description = $img = $tags = $price = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if(empty($_POST["title"])){
			$titleErr = "Title is required";
		} else {
			$title = test_input($_POST["title"]);
		}
		
		$description = test_input($_POST["description"]);
	}
*/
?>


	<main>
		<form action="upload-image.php" method="post" id="form" onsubmit="return validateForm()" name="form-upload-image">
			<div id="div-title">
				<input type="text" name="title" maxlength="60" id="input-title-image" placeholder="Title">
				<span id="span-title" class="error">Title is required</span>
			</div>
			<div id="div-image-description">
				<div id="div-image">
					<div id="div-cancel-image">
						<img src="../icons/cancel.png" id="img-cancel-image">
					</div>
					<img id="img-uploaded" src="">
					<div id="div-drag-drop">
						<div id="div-upload-image">
							<img id="img-icon-upload" src="../Icons/upload.png">
							<label id="label-input-image" for="input-image">
								<h2 id="h2-input-image" style="font-size: 17;">Upload Image</h2>
							</label>
							<span id="span-image-uploaded" class="error">Image is required</span>
						</div>
					</div>
					<input type="file" id="input-image" accept="image/*" style="display:none">
				</div>
				<div id="div-description">
					<span id="span-description" class="error">description is required</span>
					<h3 id="h3-descrption-title">Description</h3>
					<h4 id="h4-character-counter">0 out of 1000 characters</h4>
					<div id="div-description-text">
						<textarea type="text" name="description" id="textarea-description" maxlength="1000" placeholder="Write the description of your picture" onkeyup="charcountupdate(this.value)"></textarea>
					</div>
				</div>
			</div>
			<div id="div-tags-price-button-post">
				<div id="div-tags-price">
					<div id="div-tags">
						<label id="button-arrow">

							<img src="../icons/arrow.png" class="img-buttons"  id="img-arrow">
							<h3 id="h3-number-filter">0</h3>
							<h3 id="h3-filter">FILTERS</h3>
		
						</label>

						<div id="div-filter">
							<div id="div-column1">
							
								<input type="checkbox" id="input-checkBox1" class="input-checkbox" > <label id="label1">3D</label> <br>
								<input type="checkbox" id="input-checkBox2" class="input-checkbox" > <label id="label2">Animation</label> <br>
								<input type="checkbox" id="input-checkBox3" class="input-checkbox" > <label id="label3">Anime</label> <br>
								<input type="checkbox" id="input-checkBox4" class="input-checkbox" > <label id="label4">Comics</label> <br>
								<input type="checkbox" id="input-checkBox5" class="input-checkbox" > <label id="label5">Emoji</label>  <br>
								<input type="checkbox" id="input-checkBox6" class="input-checkbox" > <label id="label6">Horror</label> <br>
								<input type="checkbox" id="input-checkBox7" class="input-checkbox" > <label id="label7">Digital Art</label>
							
							</div>
			
							<div id="div-column2">
			
								<input type="checkbox" id="input-checkBox8" class="input-checkbox" > <label id="label8">Fractal</label> <br>
								<input type="checkbox" id="input-checkBox9" class="input-checkbox" > <label id="label9">PixelArt</label> <br>
								<input type="checkbox" id="input-checkBox10" class="input-checkbox" > <label id="label10">Photograpy</label>  <br>
								<input type="checkbox" id="input-checkBox11" class="input-checkbox" > <label id="label11">Street Art</label>  <br>
								<input type="checkbox" id="input-checkBox12" class="input-checkbox" > <label id="label12">Fantasy</label>  <br>
								<input type="checkbox" id="input-checkBox13" class="input-checkbox" > <label id="label13">Science Fiction</label>  <br>
								<input type="checkbox" id="input-checkBox14" class="input-checkbox" > <label id="label14">Wallpaper</label>
							
							</div>		
						</div>
					</div>
					<div id="div-price">
						<input type="checkbox" id="input-checkBox-price">
						<h3 id="h3-price">SET PRICE</h3>
						<div id="div-input-price">
							<input id="input-price" type="number" min="1">
							<img src="../icons/bpoints.png" id="img-bpoints-price">
						</div>
					</div>
				</div>
				<div id="div-button-post">
					<button id="button-post">
						<img src="../icons/bpoints.png" id="button-img-bpoints">
						<div id="div-price-number">1000</div>
					</button>
				</div>
			</div>
			<!-- variables para php -->
			<input id="TAGLIST" 	name="TAGLIST" 		class="php-variables">
			<input id="TITLE" 		name="TITLE" 		class="php-variables">
			<input id="DESCRIPTION" name="DESCRIPTION" 	class="php-variables">
			<input id="PRICE"	 	name="PRICE" 		class="php-variables">
			<input id="IMAGE"	 	name="IMAGE" 		class="php-variables">
			
		</form>
	</main>


</body>

<script src="../jquery.js"></script>
<script src="../basic-functions.js"></script>
<script src="select-image.js"></script>
<script src="drag-drop-image.js"></script>
	
<script>

	var tagList = [];
	var title, description, price, image;
	var bpoints = parseInt("<?php echo $_SESSION["bpoints"]; ?>");

	function validateForm(){

		var error = false;
		title = document.forms["form-upload-image"]["title"].value;
		description = document.forms["form-upload-image"]["description"].value;
		image = $("#img-uploaded").attr("src");

		if(bpoints - 500 < 0){
			alert("no tenes puntos pa");
			return false;
		} else {
			$("#TAGLIST").html(tagList);

			if (title == "") {
				$("#span-title").css("display","inline-block");
				error = true;
			} 
			else {
				$("#span-title").css("display","none");
				$("#TITLE").html(title);
			}

			if (description == "") {
				$("#span-description").css("display","block");
				error = true;
			} 
			else {
				$("#span-description").css("display","none");
				$("#DESCRIPTION").html(description);
			}

			if(image == ""){
				$("#span-image-uploaded").css("display","block");
				error = true;
			} else {
				$("#span-image-uploaded").css("display","none");
				parseToBase64("input-image");
			}

			if($("#input-checkBox-price").prop('checked')){
				price = $("#input-price").val();
			} else {
				price = 0;
			} $("#PRICE").html(price);


			if(error){
				return false;
			} 

			return false;
		}
	}

	/*activar precio*/
	$("#input-checkBox-price").click(function (){
		if($(this).prop('checked')){
			$("#h3-price").css( "color" , "white");
			$("#div-input-price").css( "opacity" , "1");
			$("#div-input-price").css( "pointer-events" , "auto");
		}
		else{
			$("#h3-price").css( "color" , "#7c7c7c");
			$("#div-input-price").css( "opacity" , "0.5");
			$("#div-input-price").css( "pointer-events" , "none");
		}
	});

	/*Limitar a 3 tags*/

	$(".input-checkbox").click(function (){

		var idCheckBox = $(this).attr("id");
		var newTag = $("#label" + idCheckBox.slice(14)).text();

		if(!$(this).prop('checked')){
			tagList.splice(tagList.indexOf(newTag), 1);
			if(tagList.length == 2) displayCheckbox(1,"auto");
			
		}
		else if(tagList.length < 3){
			tagList.push(newTag);
			if(tagList.length == 3) displayCheckbox(0.3,"none");
		}

		checkBoxState(idCheckBox, "white", "#7c7c7c");
		document.getElementById("h3-number-filter").innerHTML = tagList.length;
	}); 
	
	/*cambiar boton*/
	function changeButtonBpoints(shown){
		if(shown){
			$("#button-img-bpoints").css("opacity","0");
			$("#div-price-number").css("opacity","0");
			setTimeout( function(){
				$("#button-post").css("border", "5px solid white")
				$("#div-price-number").html("UPLOAD");
				$("#button-img-bpoints").css("display","none");
				$("#div-price-number").css("opacity","1");
   			}, 100);
			setTimeout( function(){
				$("#button-post").css("border", "2px solid white")
   			}, 300);
		}
		else{
			$("#div-price-number").css("opacity","0");
			$("#button-post").css("border", "none")
			setTimeout( function(){
				$("#div-price-number").html("1000");
				$("#button-img-bpoints").css("opacity","1");
				$("#button-img-bpoints").css("display","inline-block");
				$("#div-price-number").css("opacity","1");
				
   			}, 100);
		}
	}

	$("#button-post").mouseenter(function(){changeButtonBpoints(true)});
	$("#button-post").mouseleave(function(){changeButtonBpoints(false)});

	/*Borrar imagen (se cancela con settings asi que lo ponemos aca)*/

	$("#div-cancel-image").click(deleteImage);

</script>
</html>