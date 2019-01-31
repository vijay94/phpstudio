<?php

function display1($dir,$path){
	echo $path;
	foreach($dir as $next){
		if($next->isDir()  && !$next->isDot()){
			echo '<h3><a href="index.php?open=';echo $next->getFilename(); echo '">'.$next->getFilename().'</a></h3>';
		}
	}
}

function display2($dir,$path){
	foreach($dir as $next){
		if($next->isDir()  && !$next->isDot()){
			echo '<option>'.$next->getFilename().'</option>';
		}
	}
}