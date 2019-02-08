<?php
session_start();
if(!isset($_SESSION['admin'])){
	header("location:index.php");
}

?>
<html>
	<head>
		<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>

		<nav class="navbar navbar-inverse">
		  <div class="container-fluid">
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span> 
			  </button>
			  <a class="navbar-brand" href="#">PHPStudio</a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
			  <ul class="nav navbar-nav">
				<li>
					<a href="logout.php" id="logout">logout</a>
				</li>
			  </ul>
			  
			</div>
		  </div>
		</nav>

		<div class="container">
			<h1>create users</h1>

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
		</div>

	</body>
</html>