<?php
include 'connection.php';
$myusername=$_POST['username'];
$mypassword=$_POST['password'];
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$sql="SELECT * FROM users WHERE username='$myusername' and password='$mypassword'";
$result=mysqli_query($conn,$sql);
$array=mysqli_fetch_array($result);
$user=$array['name'];
$id=$array['userid'];
if($myusername!="admin"){
	echo $myusername;
$sql1="select * from dbtable where userid='".$id."'";
$result1=mysqli_query($conn,$sql1);
$array1=mysqli_fetch_array($result1);
$count1=mysqli_num_rows($result1);
$dbname=$array1['dbname'];
$count=mysqli_num_rows($result);
}
if($myusername=="admin"){

	session_start();
	$_SESSION['mailid']=$myusername;
	$_SESSION['username']=$user;
	$_SESSION['userid']=$array['userid'];
	$_SESSION["password"]=$array['password'];
	$_SESSION['admin']=1;
	header("location:adminview.php");
}else if($count==1 && $count1==1)
{
	
	session_start();
	$_SESSION['mailid']=$myusername;
	$_SESSION['username']=$user;
	$_SESSION['userid']=$array['userid'];
	$_SESSION["password"]=$array['password'];
	$_SESSION["dbname"]=$dbname;
	$_SESSION['sqluser']=$dbname.$id;
	
     header("location:index.php");
	
}
else {
	header("location:login.php");
} 
?>