<?php
    session_start();
    require ("lib/mod004_presentacion.php");
    $divHeader         = mod004_getHeader();
	if ( isset ( $_GET[ "idPlatform" ] ) ) {
        $idPlatform    = $_GET[ "idPlatform" ];
        $Platform      = mod004_getPlatformSheet( $idPlatform );
        $gamesPlaform  = mod004_getGamesPerPlatform( $idPlatform );
    } else {
        // foo
    }
	
	require ("vista/view_platformsSheet.php");
 
?>