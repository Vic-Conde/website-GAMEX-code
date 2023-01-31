<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8" />
		<title>Listado Videojuegos</title>
		<link rel="stylesheet" type="text/css" href="css/general.css">
		<link rel="stylesheet" type="text/css" href="css/generalheader.css">
		<link rel="stylesheet" type="text/css" href="css/form.css">
		<link rel="stylesheet" type="text/css" href="css/gamespagination.css">
		<link rel="stylesheet" type="text/css" href="css/search.css">
		<script src="js/login.js"></script>
		<script src="js/newGame.js"></script>
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
						echo $divGames;
					?>
					<div class='newVideogameDiv'>
						<p>¿Echas en falta algún videojuego? </p>
					</div>
					<div class='newVideogameDiv'>
						<p class='newVideogameP'> Click aquí </p>
					</div>
				</main>
				<footer id='footer'>
                    <p>Copyrightgit</p>
                    <p>Contacto</p>
                    <p>GAMEX 2023</p>
                </footer>
			</div>
		</div>
		<div class='overlay hiddenD'>
            <section>
                <h1>¡Introduce el nuevo videojuego!</h1>
                <article>
                    <form name='newgame' method='POST' onsubmit='return validateNewGame();'>
                        <div>
                            <input type='text' name='title' placeholder='Escribe el título del juego' maxlength="15" />
                        </div>
                        <div>
                            <input id="description" type='text' name='description' placeholder='Descripción' min="150" max="500" />
                        </div>
                        <div>
							<label for="releasedate">¿Cúando salió ese juego?</label>
                            <input type='date' name='releasedate'/>
                        </div>
						<div>
							<label for='idPegi'>PEGI</label>
							<?php
								echo $selectPEGI;
							?>
                        </div>
                        <div>
                            <input type='button' name='grabar' value='Dar de alta'/>
                        </div>
                    </form>
                </article>
            </section>
        </div>
	</body>
</html>