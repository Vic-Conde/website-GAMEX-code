<?php
	session_start();
    require ("lib/mod004_presentacion.php");
	$divNewGame     = mod004_getNewGame();
	$divAllAgeGames = mod004_getAllAgeGames();
	$divHeader      = mod004_getHeader();
	
	require ("vista/view_MainGames.php");
 
?>