<?php
include("php_file_tree.php");
include 'need.php';
//code to add files
if(isset($_POST["type"])){
		$dir=$_POST["directory"];
		$filename=$_POST["filename"];
		$type=$_POST["type"];
		$project=$_SESSION["project"];
		if($dir != 'root'){
			$path="projects\\".$_SESSION["mailid"]."\\".$project."\\".$dir."\\".$filename.".".$type;
		}else{
			$path="projects\\".$_SESSION["mailid"]."\\".$project."\\".$filename.".".$type;
		}
		fopen($path,"w");
	}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome <?php echo $_SESSION["username"]?></title>

	<link href="scripts/bootstrap.css" rel="stylesheet" type="text/css" media="all">
	<link href="scripts/style.css" rel="stylesheet" type="text/css" media="all" />
  <script src="scripts/jquery.min.js"></script>
	<script src="scripts/bootstrap.min.js"></script>
	<script>
	function getemptyname(){
		var projectname=prompt("enter the project name");
		window.location="createemptyproject.php"+"?name="+projectname;
	}
	function getmvcname(){
		var projectname=prompt("enter the project name");
		window.location="createmvcproject.php"+"?name="+projectname;
	}
	function openproject(){
		document.getElementById('light').style.display='block';
		document.getElementById('fade').style.display='block';
	}
	function addfile(){
		document.getElementById('light1').style.display='block';
		document.getElementById('fade1').style.display='block';
	}
</script>
<script src="scripts/jquery.js"></script>
<script src="php_file_tree_jquery.js" type="text/javascript"></script>
<link href="css/default.css" rel="stylesheet" type="text/css" media="screen" />
<link rel="stylesheet" href="css/style.css">
</head>
<body style="background-color:#ADD8E6;">
<div class="header">
<ul class="nav nav-pills" >
		<li class="dropdown">
			<a  class=" btn btn-info dropdown-toggle" id="sem1" data-toggle="dropdown">FIle<b class="caret"></b></a>
			<ul class="dropdown-menu">
				<li class="dropdown-submenu">
					<a tapindex="-1" class="btn btn-info">new</a>
					<ul class="dropdown-menu">
					<li><a class="btn btn-info" onclick="getemptyname()">Empty Project</a></li>
					<li><a class="btn btn-info" onclick="getmvcname()">MVC Project</a></li>
					<li><a class="btn btn-info" onclick="gettemplatename()">Template Project</a></li>
					</ul>
				</li>
				<li><a class="btn btn-info" onclick="openproject()">open</a></li>
				<li><a class="btn btn-info" onclick="addfile()">add file</a></li>

			</ul>
		</li>
		<li class="dropdown">
			<a class="btn btn-info" href="phpmyadmin/index.php" target="_blank">Database</a>
		</li>



		<div style="float:right;"><li class="dropdown"><h4><a href="logout.php" id="logout">[Log out]</a></h4></li></div>
		<div style="float:right;"><li><h4><a id="usernane">[<?php  echo $_SESSION["mailid"]; ?>]</a></h4></li></div>
	</ul>

</div>
<br />
<br />
<div class="explorer">
<div class="col-xs-12 col-md-3">

<div id="accordion">
<?php
//code to display tree structure
	function displayfiles($dir,$path){
		echo "<div>";
	foreach($dir as $next){
	 if($next->isFile()){
			echo "<a href='index.php?open=".$_GET["open"]."&path=".$path."&file=".$next->getFilename()."'>".$next->getFilename()."</a></br>";
		}
	}
		echo "</div>";
	}
	function displaydir($dir,$path){
	foreach($dir as $next){
		if($next->isDir()  && !$next->isDot()){
			echo "<h3>".$next->getFilename()."</h3>";
			displayfiles(new DirectoryIterator($path."\\".$next),$path.$next);
		}
		}
	}
if(isset($_GET["open"])){
	$_SESSION["project"]=$_GET["open"];
	$path='projects\\'.$_SESSION["mailid"].'\\'.$_GET["open"]."\\";
	$dirtraverse=new DirectoryIterator($path);
	displaydir($dirtraverse,$path);
	 echo '<h3>files</h3>';
	 displayfiles($dirtraverse,$path);
}

echo php_file_tree("../phpstudio/", "javascript:alert('You clicked on [link]');");
?>
</div>
</div>
<div class="col-xs-12 col-md-9">
<form method="post" action="<?php if(isset($_GET["open"])&&isset($_GET["path"])&&isset($_GET["file"])){echo "index.php?open=".$_GET["open"]."&path=".$_GET["path"]."&file=".$_GET["file"];}?>">
<textarea id="editortext" name="editortext" style="width:1000px; height:500px;resize:none;">
<?php
//code to save and open file
if(isset($_GET["path"]) && isset($_GET["file"])){
	$path=$_GET["path"];
	$file=$_GET["file"];
	if(isset($_POST["editortext"])){
		$f=fopen($path."\\".$file,"w");
		fwrite($f,$_POST["editortext"]);
	}
	$f=fopen($path."\\".$file,"r");
	while($buff=fread($f,10000)){
		echo $buff;
	}

}

?>
</textarea>
<br>
<input class="btn btn-info" type="submit" value="save"/>
<a class="btn btn-info" <?php if(isset($_GET['path']) && isset($_GET['file']))
										{
											echo 'href="'.$_GET['path'];
											echo $_GET['file'].'"';
											}
											?> target="_blank">Run</a>
</form>
</div>
<div id="light" class="white_content">SELECT YOUR PROJECT:<br>

	<?php
	//code to display the projects
	function display1($dir,$path){
		foreach($dir as $next){
			if($next->isDir()  && !$next->isDot()){
				echo '<h3><a href="index.php?open=';echo $next->getFilename(); echo '">'.$next->getFilename().'</a></h3>';
			}
		}
	}
	$path='projects\\'.$_SESSION["mailid"];
	$dirtraverse=new DirectoryIterator($path);
	display1($dirtraverse,$path);
	?>

	<a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'">Close</a></div>
    <div id="fade" class="black_overlay"></div>
	<div id="light1" class="white_content1">SELECT THE DIRECTORY:<br>
	<?php
	// code to add new file
	function display2($dir,$path){
		foreach($dir as $next){
			if($next->isDir()  && !$next->isDot()){
				echo '<option>'.$next->getFilename().'</option>';
			}
		}
	}
	if(isset($_GET["open"])){
	$path='projects\\'.$_SESSION["mailid"]."\\".$_GET["open"];
	$dirtraverse=new DirectoryIterator($path);
	echo "select directory:
	<form method='post' action=''><select type='select' id='directory' name='directory'><option value='root'>root</option>";
	display2($dirtraverse,$path);
	echo "</select><br/>";
	echo "Select file type:<br/><select id='type' name='type'>";
	echo "<option value='php'>php</option><option value='html'>html</option><option value='css'>css</option><option value='js'>js</option></select>
	File name:<br><input type='text' name='filename' id='filename' placeholder='Only the file name not extension'/><input type='submit'
	class='btn btn-primary' value='create' />
	</form>
	";
	}else{
		echo '<h3>open a project first</h3>';
	}

	?>
	<a href = "javascript:void(0)" onclick = "document.getElementById('light1').style.display='none';document.getElementById('fade1').style.display='none'">Close</a></div>
    <div id="fade1" class="black_overlay1">
	</div>


		<div class="col-md-12"><h3>your database name is:<?php echo $_SESSION['dbname'];  ?>
		&nbsp;
		your database username is:<?php echo $_SESSION['sqluser']; ?>
		<h3></div>

<script>
$.ctrl = function(key, callback, args) {
    var isCtrl = false;
    $(document).keydown(function(e) {
        if(!args) args=[]; // IE barks when args is null

        if(e.ctrlKey) isCtrl = true;
        if(e.keyCode == key.charCodeAt(0) && isCtrl) {
            callback.apply(this, args);
            return false;
        }
    }).keyup(function(e) {
        if(e.ctrlKey) isCtrl = false;
    });
};
// $( "#accordion" ).accordion();
$.ctrl('S', function() {
    alert("Ctrl+s disabled");
});
</script>
</body>
</html>
