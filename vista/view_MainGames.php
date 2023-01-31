<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8" />
		<title>GAMEX</title>
		<link rel="stylesheet" type="text/css" href="css/general.css">
        <link rel="stylesheet" type="text/css" href="css/generalheader.css">
        <link rel="stylesheet" type="text/css" href="css/maingames.css">
        <link rel="stylesheet" type="text/css" href="css/form.css">
        <link rel="stylesheet" type="text/css" href="css/search.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css"/>
        <script src="js/login.js"></script> 
        <script src="js/search.js"></script>
        <script src="js/slider.js"></script>
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
                    <div id='h1-newGame'>
                        <h1>PRÓXIMO JUEGO:</h1>
                    </div>
                    <?php
                        echo $divNewGame;
                    ?>
                    <div id='h1-AllAgeGames'>
                        <h1>PARA TODOS:</h1>
                    </div>
                    <?php
                        echo $divAllAgeGames;
                    ?>
                </main>
                <footer id='footer'>
                    <p>Copyright</p>
                    <p>Contacto</p>
                    <p>GAMEX 2023</p>
                </footer>
            </div>
        </div>
		
	
	</body>
</html>