<?php
include 'connection.php';
session_start();
if(!$_SESSION['username']){
	header("location:login.php");
}
?>

