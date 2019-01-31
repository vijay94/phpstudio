<?php
include('config.php' );
session_start();
if($_SERVER["REQUEST_METHOD"]=="POST")
{
$myusername=mysqli_real_escape_string($conn,$_POST['username']);
$mypassword=mysqli_real_escape_string($conn,$_POST['password']);
$sql="SELECT id from admin where username='$myusername' and password='$mypassword'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
$action=$row['id'];
$count=mysqli_num_row($result);
if($count==1)
{
$_SESSION['login_user'];
header("location:success.jsp");
}else
{
$error="cant login";
}
}
?>