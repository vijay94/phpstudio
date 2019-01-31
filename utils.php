<?php

$fileContent = "";
$filePath = "";
$currentFileName= "";

if (empty($_SESSION["latestOpenedFile"]) === false) {
	$currentFileName = explode("/", $_SESSION["latestOpenedFile"]);
	$currentFileName = $currentFileName[count($currentFileName) - 1];

	$file = fopen($file_path.$_SESSION["latestOpenedFile"],"r");
	$filePath = $_SESSION["latestOpenedFile"];
	while($buff=fread($file, 10000)){
		$fileContent .= $buff;
	}
	fclose($file);
}