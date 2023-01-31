<?php
    session_start();
    require ("lib/mod004_presentacion.php");
    $divHeader    = mod004_getHeader();
	if ( isset ( $_GET[ "idGame" ] ) ) {
        if ( $idGame = $_GET[ "idGame" ] ){
            $gameSheet          = mod004_getGamesSheet( $idGame );
            $gameComent         = mod004_getGameReviews( $idGame );
            $gameFile           = mod004_getGamesFiles( $idGame );
            $platformsByGame    = mod004_getPlatformsByGame( $idGame );
        } else {

        }
        
    } else {
        // foo
    }
	
	require ("vista/view_gamesSheet.php");
 
?>