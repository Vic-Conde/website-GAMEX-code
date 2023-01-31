<?php
	session_start();
    require ("lib/mod004_presentacion.php");
	if ( isset( $_SESSION[ "idUser" ], $_SESSION[ "nameUser" ] ) ){
		 mod003_getDestroySession();
	}
 
?>