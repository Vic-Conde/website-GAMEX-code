<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8" />
		<title>Ficha de Videojuego</title>
		<link rel="stylesheet" type="text/css" href="css/general.css">
		<link rel="stylesheet" type="text/css" href="css/generalheader.css">
		<link rel="stylesheet" type="text/css" href="css/form.css">
		<link rel="stylesheet" type="text/css" href="css/gamesSheet.css">
		<link rel="stylesheet" type="text/css" href="css/search.css">
		<script src="js/login.js"></script>
		<script src="js/edition.js"></script>
		<script src="js/search.js"></script>
		<script src="js/mod004_presentacion.js"></script>
		<script
        src="https://code.jquery.com/jquery-3.6.1.js"
        integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
        crossorigin="anonymous"></script>
	</head>
	<body>
		<div class='wrapper'>
			<div class='subwrapper'>
				<header id='header'>
					<?php
						echo $divHeader;
					?>
				</header>
				<main id='main'>
					<?php
						echo $gameFile;
						echo $platformsByGame;
						echo $gameSheet;
						echo $gameComent;
					?>
				</main>
				<footer id='footer'>
                    <p>Copyright</p>
                    <p>Contacto</p>
                    <p>GAMEX 2023</p>
                </footer>
			</div>
		</div>
		<div class='overlay hiddenD'>
		<div class='purchase'>
			<input type='submit' name='COMPRAR' value='COMPRAR' />
		</div>
		</div>
	</body>
</html>