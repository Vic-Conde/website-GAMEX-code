<?php
	session_start();
    require ("lib/mod004_presentacion.php");
	$divHeader    = mod004_getHeader();
	if ( isset( $_GET[ "row" ] ) ) {
        $initialRow = intval( $_GET[ "row" ] );
    } else {
        $initialRow = 0;
    }
    $pageRows = 2;
	$divGames   = mod004_getListGamesFiles( $initialRow, $pageRows);
    $selectPEGI = mod004_getPegiAges();
	require ("vista/view_games.php");
 
?>