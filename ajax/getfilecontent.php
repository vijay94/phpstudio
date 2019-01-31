<?php
include '../need.php';
include 'header.php';

$data = [];

if (empty($_POST["file"]) === false) {
	$_SESSION["latestOpenedFile"] = $_POST["file"];
	$file = fopen($file_path.$_POST["file"],"r");
	$str = "";
	while($buff=fread($file, 10000)){
		$str .= $buff;
	}
	fclose($file);
	$data["success"] = 1;
	$data["content"] = $str;
} else {
	$data["success"] = 0;
	$data["content"] = "";
}
echo json_encode($data);