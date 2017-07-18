<?php
?>
<?php

?>
<html><head><title>PHP-Studio</title>
<script>
function validate() {
var a=document.getElementById("name").value;
if (a=="") {
	alert("enter name");
}
}
function validate1(){
	var a1=document.getElementById("email").value;
	if (a1=="") {
	alert('enter email');
}
	else{ 
	    var atpos = a1.indexOf("@");
	    var dotpos = a1.lastIndexOf(".");
	    if (atpos< 1 || dotpos<atpos+2 || dotpos+2>=a1.length) {
	        alert("Not a valid e-mail address");
	        
	    }
	}
}
function validate2(){
var a2=document.getElementById("pass").value;
if (a2.length<1) {
	alert('enter password');
}
}
function validate3(){
var a2=document.getElementById("confirmpassword").value;
var a1=document.getElementById("pass").value;
if (a2.length<1) {
	alert('enter password');
}
if(a2 != a1){
 alert('password mismatches');
}
}
</script>

    </head>
    <body>
    <h1>Welcome to PHP-Studio</h1>
				<div>



					
					      <form method="post" name="login" id="login" action="processlogin.php">
					      <label> login:-</label>
					      
					      <br><input class="input-large" placeholder="UserName(email id)" id="username" name="username" type="text">
					      <br><input class="input-large" placeholder="password" id="password" name="password" type="password"><br>
					      <input type="submit" class="btn btn-primary" value="login">
					    </form>
					
					</div>
					<div> 
					
						

						

						
						

		</div>
	</div>

</div></body></html>