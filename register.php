<?php
include 'connection.php';
$myusername=$_POST['name'];
$myemailid=$_POST['email'];
$mypassword=$_POST['pass'];
$mypass=$_POST['confirmpassword'];
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myemailid = stripslashes($myemailid);
$sql="SELECT name FROM users WHERE username='$myemailid'";
$result=mysqli_query($conn,$sql);
$count=mysqli_num_rows($result);

if (strlen($myemailid) < 1 || strlen($myusername) < 1 || strlen($mypassword) < 1) {
	echo "enter data";
} else {
	if(!$count){
		$sql="INSERT INTO users (`name`, `username`, `password`, `userid`) VALUES ('$myusername', '$myemailid', '$mypassword', NULL);";
		$result1=mysqli_query($conn,$sql);
		if($result1){
			$sql="select * from users where username='$myemailid'";
			$result1=mysqli_query($conn,$sql);
			if($array=mysqli_fetch_array($result1)){
				$dbname=$array['userid']."abc";
			}
			session_start();
			$path="projects/".$myemailid;
			mkdir($path,0777);
			$username=$myusername;
			$mailid=$myemailid;
			$sql1="select * from dbtable where userid='".$array['userid']."'";
			$result2=mysqli_query($conn,$sql1);
			$array2=mysqli_fetch_array($result1);
			$count2=mysqli_num_rows($result1);
			$password=$array['password'];

			$sqluser=$dbname.$array['userid'];
			$sql="CREATE DATABASE ".$dbname;

			$result=mysqli_query($conn,$sql);
			
			$sql="create user '".$sqluser."'@'%' identified by '".$sqluser."'";
			
			$result=mysqli_query($conn,$sql);
			
			if(!$result){
				echo "<br>"."user not created"."<br>";	
			}
			$sql="GRANT SELECT, INSERT, UPDATE, DELETE, CREATE, DROP, INDEX, ALTER ON `$dbname`.* TO '".$sqluser."'@'%'";
			
			if(mysqli_query($conn,$sql)){
				
			}else{
				echo "permisson not created";
			}
			
			$sql="REVOKE ALL PRIVILEGES ON *.* FROM '".$sqluser."'@'%'; REVOKE GRANT OPTION ON *.* FROM '".$sqluser."'@'%'; GRANT SELECT, INSERT, UPDATE, DELETE, CREATE, DROP, INDEX, ALTER ON `".$dbname."`.* TO '".$sqluser."'@'%'WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;";
			echo $sql;
			if(mysqli_query($conn,$sql)){
				
			}else{
				echo "permisson not created";
			}
			
			$sql="insert into dbtable values(".$array['userid'].",'".$dbname."')";
			mysqli_query($conn,$sql);
			header("location:adminview.php");
		}else{
			echo 'failed';
		}
	}
	else 
	{
		echo "mail already exits";	
	}
}
?>