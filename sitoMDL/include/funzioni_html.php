<?php

function print_head($tit, $java, $css){
	$print ="";
	$print = "<head>";
	$print =$print. "<title>". $tit ."</title>";

	foreach ($java as $file)//aggiungo tutti i file di scripting
		$print =$print. "<script src=\"".$file."\"></script>";

	foreach ($css as $stile)//aggiungo tutti i file di stile
		$print =$print. "<link rel=\"stylesheet\" type=\"text/css\" href=\"".$stile."\">";

	$print =$print. "</head>";
return $print;	
}


?>