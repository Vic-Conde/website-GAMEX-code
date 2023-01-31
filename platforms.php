<?php
	session_start();
    require ("lib/mod004_presentacion.php");
	$divPlatforms = mod004_getPlatforms();
	$divHeader    = mod004_getHeader();
	require ("vista/view_platforms.php");
 
?>