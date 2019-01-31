<?php
include '../need.php';
include 'header.php';

$data = [];

if (empty($_POST["file"]) === false && empty($_POST["content"]) === false) {

	$file = fopen($file_path.$_POST["file"], "w");
	fwrite($file, $_POST["content"]);
	
	fclose($file);
	$data["success"] = 1;
} else {
	$data["success"] = 0;
}

echo json_encode($data);