<?php
include("php_file_tree.php");
$file_path = "./";
include 'need.php';
include 'functions.php';
include 'utils.php';

$path = "./projects/".$_SESSION["mailid"];

?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Welcome <?php echo $_SESSION["username"]?></title>

	<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	<link href="css/default.css" rel="stylesheet" type="text/css" media="screen" />
	<link rel="stylesheet" href="css/codemirror.css">
	<link rel="stylesheet" href="css/context.css">
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
			<li class="dropdown">
		        <a class="dropdown-toggle" href="javascript:void(0)" data-toggle="modal" data-target="#new-project">New Project</a>
		    </li>
		    <li>
		    	<a href="phpmyadmin/" target="_blank">DataBase</a>
		    </li>
	      </ul>
	      
	    </div>
	  </div>
	</nav>
	<div class="container-fluid pr">
		<div class="explorer">
			<div id="accordion">
				<?php
					echo php_file_tree($path, "[link]");
				?>
			</div>
		</div>
		<div class="col-xs-12 pd-lt-250 editor">
			<?php
				if ($currentFileName !== "") {
			?>
				<p class="current-file">Current File: <?php echo $currentFileName; ?></p>
			<?php
				} else {
			?>
				<p class="current-file"></p>
			<?php 
				}
			?>
			<textarea id="editor" data-file="<?php echo $filePath; ?>" data-file-content="<?php echo htmlspecialchars($fileContent); ?>" name="editortext"></textarea>
			<div class="col-xs-12">
				<input class="btn btn-info" id="save" value="save"/>
				
				<?php 
					if(isset($filePath))
					{
						echo '<a class="btn btn-info" id="run" href="'.$filePath.'" target="_blank">Run</a>';
					}
				?> 
			</div>
			<div class="col-md-12">
				<h3>your database name is:
					<?php echo $_SESSION['dbname'];  ?>
					&nbsp;
					your database username is:<?php echo $_SESSION['sqluser']; ?>
				<h3>
			</div>
		</div>
	</div>

	<div class="toast" id="error">
		<p></p>
	</div>
	<div class="toast" id="success">
		<p></p>
	</div>

	<div class="modal fade" id="new-file" role="dialog">
	    <div class="modal-dialog">
	    
	      <!-- Modal content-->
	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Create New FIle</h4>
	        </div>
	        <div class="modal-body">
	        	<form id="new-file-form" method="post" action="ajax/createFile.php">
	        		<select  name="extension" required>
	        			<option value="">Select Extension</option>
	        			<option value="php">Php</option>
	        			<option value="html">Html</option>
	        			<option value="js">Js</option>
	        			<option value="css">Css</option>
	        		</select>
	         		<input type="text" placeholder="File Name Without Extension" name="fileName" required>
	         		<button type="submit" class="button-primary">Add</button>
	        	</form>
	        	
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        </div>
	      </div>
	      
	    </div>
	</div>
	<div class="modal fade" id="new-project" role="dialog">
	    <div class="modal-dialog">
	    
	      <!-- Modal content-->
	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Create New FIle</h4>
	        </div>
	        <div class="modal-body">
	        	<form id="new-project-form" method="post" action="ajax/createProject.php">
	         		<input type="text" placeholder="Project Name" name="projectName" required>
	         		<button type="submit" class="button-primary">Add</button>
	        	</form>
	        	
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        </div>
	      </div>
	      
	    </div>
	</div>
</body>
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/php_file_tree_jquery.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/codemirror.js"></script>
	<script type="text/javascript" src="js/css.js"></script>
	<script type="text/javascript" src="js/htmlmixed.js"></script>
	<script type="text/javascript" src="js/javascript.js"></script>
	<script type="text/javascript" src="js/matchbrackets.js"></script>
	<script type="text/javascript" src="js/xml.js"></script>
	<script type="text/javascript" src="js/clike.js"></script>
	<script type="text/javascript" src="js/php.js"></script>
	<script type="text/javascript" src="js/context.js"></script>
	<script type="text/javascript" src="js/ui-position.js"></script>
	<script type="text/javascript" src="js/script.js"></script>
</html>
