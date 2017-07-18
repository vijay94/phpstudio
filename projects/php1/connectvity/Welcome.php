<?php
include("Config.php");
session_start();
?>
<html>
<head>
<title>Welcome Page</title>
</head>
<body>
WELCOME 
<?php
echo $_SESSION['login_user'];
?>
</body>
</html>