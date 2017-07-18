<?php
session_start();
if(!$_SESSION['username']){
	header("location:login.php");
}

$conn=mysqli_connect("localhost",$_SESSION['sqluser'],$_SESSION['sqluser'],$_SESSION['dbname'])or die("cannot connect");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- TemplateBeginEditable name="doctitle" -->
<title>Welcome <?php echo $_SESSION["username"]?></title>

	<link href="scripts/bootstrap.css" rel="stylesheet" type="text/css" media="all">
</head>
<body>

<h3>use the text area to type your query and execute</h3>
<form method="post" action="">
<textarea name="sql" id="sql" rows="5" cols="50"></textarea>
<input class="btn btn-danger" type="submit" value="execute"/>
</form>
<?php
echo "<h5>";
if(isset($_POST['sql'])){
	$sql=$_POST['sql'];
	$result=mysqli_query($conn,$sql);
	if($result){
		echo "query executed successfully";
	}
	$_POST['sql']="";
}
echo "</h1>";
?>
</body>
</html>