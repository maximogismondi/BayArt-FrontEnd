<?php

function test_input($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

function getUrl($url)
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$res = curl_exec($ch);
	$ret = (curl_getinfo($ch))["http_code"];
	curl_close($ch);

	return array($ret, $res);
}

function postUrl($url)
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POST, true);
	$res = curl_exec($ch);
	$ret = (curl_getinfo($ch))["http_code"];
	curl_close($ch);

	return array($ret, $res);
}

function postUrlRequestBody($url, $parametros)
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $parametros);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
	$res = curl_exec($ch);
	$ret = (curl_getinfo($ch))["http_code"];
	curl_close($ch);
	return array($ret, $res);
}

function getTitle($idImage, $images)
{
	foreach ($images as $image) {
		if ($image["idImage"] == $idImage) {
			return $image["name"];
		}
	}
}

function getUsername($idArtist, $artists)
{
	foreach ($artists as $artist) {
		if ($artist["idUser"] == $idArtist) {
			return $artist["username"];
		}
	}
}

function getIdArtist($idImage, $images)
{
	foreach ($images as $image) {
		if ($image["idImage"] == $idImage) {
			return $image["idUser"];
		}
	}
}

function saveImage($folder, $title, $imageEncoded)
{
	$ifp = fopen($folder . $title . getExtension($imageEncoded[0]), 'wb');
	fwrite($ifp, base64_decode($imageEncoded));
	fclose($ifp);
}

function getExtension($char)
{
	switch ($char) {
		case '/':
			return ".jpg";
			break;
		case 'i':
			return ".png";
			break;
		case 'R':
			return ".gif";
			break;
		case 'U':
			return ".webp";
			break;
	}
}

function limpiarTodasLasCarpetas()
{
}
