<?php
include '../need.php';
include 'header.php';

if(empty($_POST["projectName"]) === false){

	$projectname = $_POST["projectName"];

	$path = $file_path.'./projects/'.$_SESSION["mailid"].'/'.$projectname;
	
	mkdir($path,0755);

	$indexpath=$path."/index.php";
	$file = fopen($indexpath,"w");

	if ($file) {
		fclose($file);
		$data["success"] = 1;
	} else {
		$data["success"] = 0;
	}

}else{
	$data["success"] = 0;
}

$data["content"] = "";

echo json_encode($data);
