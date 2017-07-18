<?php
include 'need.php';
$dir=$_POST["directory"];
$filename=$_POST["filename"];
$type=$_POST["type"];
$project=$_SESSION["project"];
if($dir != 'root'){
$path="projects\\".$_SESSION["mailid"]."\\".$project."\\".$dir."\\".$filename.".".$type;
}else{
	$path="projects\\".$_SESSION["mailid"]."\\".$project."\\".$filename.".".$type;
}
$f=fopen($path,"w");
$f.fclose();
?>
