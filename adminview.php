<?php
session_start();
if(!isset($_SESSION['admin'])){
	header("location:index.php");
}

?>
<html>
<head>
</head>
<body>
<h1>create users</h1><br>

						<div id="register">
  
						<form method="post" id="reg" action="register.php">
						<p>Name * :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="input-large" type="text" id="name" name="name" onBlur="validate()"><br>
						</p>
						<p>Email id *:&nbsp;&nbsp; <input class="input-large" name="email" id="email" type="text" onBlur="validate1()"><br>
						</p>
						<p>Password *:<input class="input-large"  name="pass" id="pass" type="password"  onBlur="validate2()"><br>
						</p>

						<p>Confirm password *:<br>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="password" id="confirmpassword" name="confirmpassword" onBlur="validate3()"><br>
					
						<input class="btn btn-primary" type="submit" value="register" id="submit">
						<input type="reset" class="btn btn-danger" value="reset"/>
						</p>
						</form>						
						</div>
						<br><br><a href="logout.php" id="logout">logout</a>
</body>
</html>