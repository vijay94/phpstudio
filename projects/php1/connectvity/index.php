<?php
	include("Config.php");
	session_start();
	
	if($_SERVER["REQUEST_METHOD"]=="POST"){
		$myusername=mysqli_real_escape_string($conn,$_POST['username']);
		$mypassword=mysqli_real_escape_string($conn,$_POST['password']);
		$sql="select id from employee where username='$myusername' and password='$mypassword'";
		$result=mysqli_query($conn,$sql);
		$row=mysqli_fetch_array(mysqli_result,MYSQLI_ASSOC);
		$active=$row['id'];
		$count=mysqli_num_rows($result);
		
		if($count==1){
			$_SESSION['login_user']=$myusername;
			header("location:Welcome.php");
		}
		else
		{
			$error="INVALID Username or Password";
		}
	}
?>