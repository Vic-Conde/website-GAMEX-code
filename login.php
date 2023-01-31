<?php
	session_start();
    require ("lib/mod004_presentacion.php");
	if ( isset( $_POST[ "email" ], $_POST[ "password" ] ) ){
		$email     = $_POST[ "email" ];
		$password  = $_POST[ "password" ];
		//echo $email . " " . $password;
		$arRetorno = mod003_getValidateUser( $email, $password );
	}
 
?>