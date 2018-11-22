<?php

	$conectado = 1;
	$puerto = $_SERVER['SERVER_PORT'];
	$rutaserv2=str_replace("index.php", "",$_SERVER["PHP_SELF"]);
	$foldersite="http://". $_SERVER["SERVER_NAME"].($puerto!=80?":".$puerto."/":"").$rutaserv2;
    $domain =    $foldersite;
	$section = empty($_REQUEST['section']) ? 'home' : $_REQUEST['section'];
	$id = empty($_REQUEST['id'])? 0: $_REQUEST['id'];	

?>
