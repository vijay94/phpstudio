<?php
if(isset($_GET["name"])){
	session_start();
	$projectname=$_GET["name"];
	$path='projects\\'.$_SESSION["mailid"].'\\'.$projectname;
	mkdir($path,0777);
	$imagepath=$path."\\image";
	mkdir($imagepath,0777);
	$jspath=$path."\\js";
	mkdir($jspath,0777);
	$csspath=$path."\\css";
	mkdir($csspath,0777);
	$controllerpath=$path."\\controller";
	mkdir($controllerpath,0777);
	$modelpath=$path."\\model";
	mkdir($modelpath,0777);
	$readme=fopen($modelpath."\\readme.txt","w");
	fwrite($readme,"this folder is for creating your database connection files");
	$readme=fopen($controllerpath."\\readme.txt","w");
	fwrite($readme,"this folder is for creating your controller files");
	$indexpath=$path."\\index.php";
	$index=fopen($indexpath,"w");
	fclose($index);
	header("location:index.php?open=$projectname");
}else{
	header("location:index.php");
}
?>