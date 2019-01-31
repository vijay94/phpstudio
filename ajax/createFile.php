<?php
include '../need.php';
include 'header.php';

$data = [];

if (empty($_POST["projectName"]) === false && empty($_POST["extension"]) === false && empty($_POST["fileName"]) === false) {
	
	$path = $file_path."./projects/".$_SESSION["mailid"]."/".$_POST["projectName"]."/".$_POST["fileName"].".".$_POST["extension"];

	$file = fopen($path,"w");
	if ($file) {
		fclose($file);
		$data["success"] = 1;
	} else {
		$data["success"] = 0;
	}
} else {
	$data["success"] = 0;
}

$data["content"] = "";

echo json_encode($data);