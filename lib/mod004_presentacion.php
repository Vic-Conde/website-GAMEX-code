<?php
	require ( "mod003_logica.php");
    require ( "mod003i_debug.php" );

    /** Graba en el array de jottings en la posición "allInf" el contenido como finalizado y el tiempo dedicado.
            -- Arguments:
                - arJottings                    : array asociativo con los datos de todos los jottings.
                - idContent                     : idContent que tiene el contenido que ha sido finalizado.
                - dataAjaxState                 : El resultado de la grabación en la base de datos.
            -- Return:

                - arJottings
            -- Author:

                - Fernando Diezma.
            -- Dates:

                - Creation          : 2020 - Ene
                - Review            :
    */

    /** Graba en el array de jottings en la posición "allInf" el contenido como finalizado y el tiempo dedicado.
            -- Arguments:
            
            -- Return:
            -- Author:
            -- Dates:

                - Creation          : 2020 - Ene
                - Review            :
    */

    function mod004_getNewGame(){
        $arGameComingSoon = mod003_getNewGame();
        $photoNewGame = "";
        if ( $arGameComingSoon[ "status" ][ "codError" ] === "000" ){
            $photoNewGame .=        "<div class='newGame-image'>";
            $photoNewGame .=                "<a href='gamesSheet.php?idGame={$arGameComingSoon[ "data" ][ 0 ][ "idGame" ]}'><img src='{$arGameComingSoon[ "data" ][ 0 ][ "photoGames" ]}'/></a>";
            $photoNewGame .=        "</div>";
        } else if ( $arGameComingSoon[ "status" ][ "codError" ] === "001" ) {
            $photoNewGame = "No tenemos imagen de ese nuevo videojuego";
        }
        return $photoNewGame;
    }

    /** Muestra el próximo videojuego que va a salir debajo de la cabecera en el main enviando el idGame para acceder al síncrono de la ficha del videojuego próximo.
            -- Arguments:

            -- Return:
                - photoNewGame                    : foto, sobre <img> del videojuego más actual con una etiqueta '<a></a>' que redirige a la ficha de ese videojuego.
            -- Author:
                - Víctor Ubago Conde
            -- Dates:

                - Creation          : 2022 - Nov
                - Review            :
    */

    function mod004_getHeader(){
        $header = "";
        $header .=      "<div class='logo'>";
        $header .=          "<div class='logo-flex'>";
        $header .=              "<a href='mainGames.php'><img src='images/logo/logo.svg' class='width100' /></a>";
        $header .=          "</div>";
        $header .=      "</div>";
        $header .=      "<nav id='nav-menu'>";
        $header .=          "<div class='items-nav'>";
        $header .=              "<a class='nav-link' href='games.php'>VIDEOGAMES</a>";
        $header .=          "</div>";
        $header .=          "<div class='items-nav'>";
        $header .=              "<a class='nav-link' href='platforms.php'>PLATFORMS</a>";
        $header .=          "</div>";
        $header .=      "</nav>";
        $header .=      "<div class='buscador'><div><input type='text' name='busqueda' placeholder='buscador'/></div></div>";
        if ( isset( $_SESSION[ "nameUser" ], $_SESSION[ "idUser" ] ) ) {
            $header .= "<div>";
                $header .= "<p class='nameNick'> Hola, {$_SESSION[ 'nameUser' ]}</p>";
                $header .= "<a href='logout.php'><p class='logout'>Logout</p></a>";
            $header .= "</div>";
        } else {
            $header .= "<div class='iniciosesion'>INICIO SESIÓN</div>";
        }
        $header .= "<div class='login hiddenD'>";
        $header .=   "<form name='login' method='POST' onsubmit='return validateLogin();' action='login.php'>";
        $header .=     "<div><input type='text' name='email' placeholder='Tu email'/></div>";
        $header .=     "<div><input type='password' name='password' placeholder='Tu password'/></div>";
        $header .=     "<div><input type='submit' name='ir' value='Ir' /></div>";
        $header .=   "</form>";
        $header .= "</div>";
		/* $header .= "<div class='logo'><a href='mainGames.php'><img src='images/logo/logo.svg' class='width100' /></a></div>";
        $header .= "<nav><a href='games.php'>VIDEOGAMES</a><a href='platforms.php'>PLATFORMS</a></nav>";
        $header .= "<div class='buscador'><div><input type='text' name='busqueda' placeholder='buscador'/></div></div>";
        if ( isset( $_SESSION[ "nameUser" ], $_SESSION[ "idUser" ] ) ) {
            $header .= "<div>";
                $header .= "<p class='nameNick'> Hola, {$_SESSION[ 'nameUser' ]}</p>";
                $header .= "<a href='logout.php'><p class='logout'>Logout</p></a>";
            $header .= "</div>";
        } else {
            $header .= "<div class='iniciosesion'>Inicio Sesión</div>";
        }
        $header .= "<div class='login hiddenD'>";
        $header .=   "<form name='login' method='POST' onsubmit='return validateLogin();' action='login.php'>";
        $header .=     "<div><input type='text' name='email' placeholder='Tu email'/></div>";
        $header .=     "<div><input type='password' name='password' placeholder='Tu password'/></div>";
        $header .=     "<div><input type='submit' name='ir' value='Ir' /></div>";
        $header .=   "</form>";
        $header .= "</div>"; */
        return $header;
    }

    /** Muestra la cabecera de la página dentro del <header> y contiene elementos como el login ( que permite iniciar sesión ), VIDEOGAMES o PLATFORMS ( dos h1 que redirigen de manera síncrona a games.php y platforms.php respectivamente ) y la imagen GAME redirige a la página principal.
            -- Arguments:

            -- Return:
                - header                    : formateo que muestra el logo, dos páginas principales con su href, un buscador funcional y unos imputs para iniciar sesión.
            -- Author:
                - Víctor Ubago Conde
            -- Dates:

                - Creation          : 2022 - Nov
                - Review            :
    */
    
    function mod004_getPlatforms(){
        $arDataPlatforms = mod003_getPlatforms();
        $listPlatforms = "";
        if ( $arDataPlatforms[ "status" ][ "codError" ] === "000"){
            $listPlatforms .= "<div class='platforms'>";
            foreach ( $arDataPlatforms[ "data" ] as $arDataPlatform ) {
                $listPlatforms .= "<div class='center'>";
                $listPlatforms .=       "<div class='imgplatforms'>";
                $listPlatforms .=   "<a href='platformsSheet.php?idPlatform={$arDataPlatform[ "idPlatform" ]}'>";
                    $listPlatforms .=           "<img class='width100 radius15' src='{$arDataPlatform[ "photoPlatforms" ]}'/>";
                    $listPlatforms .=   "</a>";
                    $listPlatforms .=   "<a href='platformsSheet.php?idPlatform={$arDataPlatform[ "idPlatform" ]}'>";
                    $listPlatforms .=       "</div>";
                    $listPlatforms .=       "<p class='namesplatforms hiddenD'>{$arDataPlatform[ "description" ]}</p>";
                    $listPlatforms .= "</div>";
                    $listPlatforms .=   "</a>";
                }
            $listPlatforms .= "</div>";
        } else if ( $arDataPlatform[ "status" ][ "codError" ] === "001" ) {
            // Sin datos.
            $listPlatforms.= "<p>No tenemos plataformas hoy.</p>";
        }
        return $listPlatforms;
    }

    /** Mostrar las plataformas en platforms.php. y envía el idPlatform para acceder al archivo 'platformsSheet' que es la ficha de las plataformas.
            -- Arguments:

            -- Return:
                - listPlatforms                    : formateo de las imágenes y los nombres con <a></a> sobre ellos de las plataformas.
            -- Author:
                - Víctor Ubago Conde
            -- Dates:

                - Creation          : 2022 - Nov
                - Review            :
    */

    function mod004_getGamesSheet( $idGame ){
        $arDataGamesSheet = mod003_getGamesSheet( $idGame );
        $listSheet = "";
        if ( $arDataGamesSheet[ "status" ][ "codError" ] === "000"){
            $listSheet .= "<h2>{$arDataGamesSheet[ "data" ][ 0 ][ "nameGames" ]}</h2>";
            $listSheet .= "<p>{$arDataGamesSheet[ "data" ][ 0 ][ "dateGames" ]}</p>";
            $listSheet .= "<p>{$arDataGamesSheet[ "data" ][ 0 ][ "description" ]}</p>";
            $listSheet .= "<img class='width5' src= '{$arDataGamesSheet[ "data" ][ 0 ][ "PEGI" ]}'/>";
        } else if ( $arDataPlatform[ "status" ][ "codError" ] === "001" ){
            // Sin datos.
            $listSheet.= "<p>No tenemos fichas hoy.</p>";
        }
        return $listSheet;
    }

    /** Muestra el nombre, la fecha, el PEGI y la descripción de un videojuego mediante el recibimiento de la variable idGame.
            -- Arguments:
                - idGame                       : variable que trae el identificador de un videojuego.
            -- Return:
                - listSheet                    : formateo del nombre ( <h2></h2> ), de la fecha y la descripción ( <p></p> ) y una etiqueta <img> sobre la foto de la edad recomendada.
            -- Author:
                - Víctor Ubago Conde
            -- Dates:

                - Creation          : 2022 - Nov
                - Review            :
    */

    function mod004_getGamesFiles( $idGame ){
        $arDataGamesFiles = mod003_getGamesFiles( $idGame );
        $listFiles = "";
        if ( $arDataGamesFiles[ "status" ][ "codError" ] === "000"){
            foreach ( $arDataGamesFiles[ "data" ] as $arDataGamesFile ) {
                $listFiles .= "<div class='left'><img class='width50' src='{$arDataGamesFile["photoGames"]}'title='{$arDataGamesFile["nameGames"]}'/></div>";
            }
            
        } else if ( $arDataPlatform[ "status" ][ "codError" ] === "001" ){
            // Sin datos.
            $listFiles.= "<p>No tenemos fotos de ese juego.</p>";
        }
        return $listFiles;
    }

    /** Muestra las imágenes de un videojugeo en concreto.
            -- Arguments:
                - idGame                           : variable que trae el identificador de un videojuego.
            -- Return:
                - listFiles                        : formateo de las fotos de un videojuego sobre una etiqueta img y un div.
            -- Author:
                - Víctor Ubago Conde
            -- Dates:

                - Creation          : 2022 - Nov
                - Review            :
    */

    function mod004_getGameReviews( $idGame ){
        $arDataGamesReviews = mod003_getGameReviews( $idGame );
        $listReviews = "";
        if ( $arDataGamesReviews[ "status" ][ "codError" ] === "000"){
            foreach ( $arDataGamesReviews[ "data" ] as $key => $arDataGamesReview ) {
                $listReviews .= "<h2>{$arDataGamesReview["titleComent"]}</h2>";
                $listReviews .= "<p>{$arDataGamesReview["comentGames"]}</p>";
            }
        } else if ( $arDataGamesReviews[ "status" ][ "codError" ] === "001" ){
            // Sin datos.
            $listReviews.= "<p>No tenemos comentarios de ese videojuego.</p>";
        }
        return $listReviews;
    }

    /** Muestra el título y el contenido de un comentario sobre un videojuego.
            -- Arguments:
                - idGame                           : variable que trae el identificador de un videojuego.
            -- Return:
                - listReviews                    : formateo del título del comentario en <h2></h2> y el contenido del comentario en <p></p>.
            -- Author:
                - Víctor Ubago Conde
            -- Dates:

                - Creation          : 2022 - Nov
                - Review            :
    */

    function mod004_getPlatformSheet( $idPlatform ){
        $arDataPlatformsSheets = mod003_getPlatformSheet( $idPlatform );
        $listPlatformsSheets = "";
        if ( $arDataPlatformsSheets[ "status" ][ "codError" ] === "000"){
                $listPlatformsSheets .= "<h2>{$arDataPlatformsSheets[ "data" ][ 0 ]["namesPlatforms"]}</h2>";
                $listPlatformsSheets .= "<div class='center'><img class='width50' src='{$arDataPlatformsSheets[ "data" ][ 0 ][ "photoPlatforms" ]}'/></div>";
        } else if ( $arDataPlatformsSheets[ "status" ][ "codError" ] === "001" ){
            // Sin datos.
            $listPlatformsSheets.= "<p>No tenemos ficha de plataformas hoy.</p>";
        }
        return $listPlatformsSheets;
    }

    /** Muestra el nombre de la plataforma y la imagen de la plataforma.
            -- Arguments:
                - idPlatform                    : variable que trae el identificador de una plataforma.
            -- Return:
                - listPlatformsSheets           : formateo del nombre de la plataforma en <h2></h2> y un div que contiene un img con la imagen correspondiente.
            -- Author:
                - Víctor Ubago Conde
            -- Dates:

                - Creation          : 2022 - Nov
                - Review            :
    */

    function mod004_getGamesPerPlatform( $idPlatform ){
        $arDataGamesPlatform = mod003_getGamesPerPlatform( $idPlatform );
        $listDataGamesPlatform = "";
        if ( $arDataGamesPlatform[ "status" ][ "codError" ] === "000"){
            foreach ( $arDataGamesPlatform[ "data" ] as $arDataGamePlatform ) {
                $listDataGamesPlatform .= "<a href='gamesSheet.php?idGame={$arDataGamePlatform[ "idGame" ]}'><p>{$arDataGamePlatform[ "nameGames" ]}</p></a>";
            }
        } else if ( $arDataGamesPlatform[ "status" ][ "codError" ] === "001" ){
            // Sin datos.
            $listDataGamesPlatform.= "<p>No tenemos videojuegos en esa plataforma.</p>";
        }
        return $listDataGamesPlatform;
    }

    /** Muestra los videojuegos correspondientes a cada plataforma enviando el idGame para acceder de manera síncrona al juego correspondiente.
            -- Arguments:
                - idPlatform                 : variable que trae el identificador de una plataforma.
            -- Return:
                - listDataGamesPlatform      : etiqueta <a></a> con el nombre del juego en cada plataforma, un href a dicho juego y en <p></p> .
            -- Author:
                - Víctor Ubago Conde
            -- Dates:

                - Creation          : 2022 - Nov
                - Review            :
    */

    function mod004_getPlatformsByGame( $idGame ){
        $arDataGamesPlatformSheet = mod003_getPlatformsByGame( $idGame );
        //dump( $arDataGamesPlatformSheet );
        $listDataGamesPlatformSheet = "";
        if ( $arDataGamesPlatformSheet[ "status" ][ "codError" ] === "000"){
            foreach ( $arDataGamesPlatformSheet[ "data" ] as $arDataGamePlatformSheet ) {
                $listDataGamesPlatformSheet .= "<p title='¡Compra ya!  ' data-idPlatform='{$arDataGamePlatformSheet[ "idPlatform" ]}' data-idGame='{$arDataGamePlatformSheet[ "idGame" ]}' class='platformsStyle'>{$arDataGamePlatformSheet[ "namesPlatforms" ]}</p>";
            }
        } else if ( $arDataGamesPlatformSheet[ "status" ][ "codError" ] === "001" ){
            // Sin datos.
            $listDataGamesPlatformSheet.= "<p>No tenemos plataformas en este videojuego.</p>";
        }
        return $listDataGamesPlatformSheet;
    }

    /** Muestra las plataformas correspondientes a cada videojuego enviando el idGame y el idPlatform para acceder a las ediciones.
            -- Arguments:
                - idGame                       : variable que trae el identificador de un videojuego.
            -- Return:
                - listDataGamesPlatformSheet   : etiqueta p con el idGame e idPlatform en su data.
            -- Author:
                - Víctor Ubago Conde
            -- Dates:

                - Creation          : 2022 - Nov
                - Review            :
    */

    function mod004_getAllAgeGames(){
        $arDataAllAgeGames = mod003_getAllAgeGames();
        $listPegiForAll = "";
        if ( $arDataAllAgeGames[ "status" ][ "codError" ] === "000" ){
            $nameClass= "";
            $listPegiForAll .=      "<div id='slider'>";
                                        foreach ($arDataAllAgeGames[ "data" ] as $key => $arDataAllAgeGame ){
                                            $listPegiForAll .= "<div class='slider-image  $nameClass'>";
                                                $listPegiForAll .= "<a href='gamesSheet.php?idGame={$arDataAllAgeGames[ "data" ][ $key ][ "idGame" ]}'><img src='{$arDataAllAgeGame[ "photoGames" ]}'/></a>";
                                            $listPegiForAll .=  "</div>";
                                            $nameClass= "hiddenD";
                                        }
            $listPegiForAll .=      "</div>";
        } else if ( $arDataAllAgeGames[ "status" ][ "codError" ] === "001" ) {
            $listPegiForAll = "No tenemos ese videojuego";
        }
        return $listPegiForAll;
    }

    /** Muestra el videojuego con una edad recomendada para todos los públicos.
            -- Arguments:

            -- Return:
                - listPegiForAll       : implementación de un slider de varias imágenes en lugar de una imagen fija
            -- Author:
                - Víctor Ubago Conde
            -- Dates:

                - Creation          : 2022 - Nov
                - Review            :
    */

    function mod004_getListGamesFiles( $initialRow, $pageRows){
        $arDataListGamesFiles = mod003_getListGamesFiles( $initialRow, $pageRows);
        $listGamesFiles = "";
        if ( $arDataListGamesFiles[ "status" ][ "codError" ] === "000" ){
            $listGamesFiles .= "<div class='gamespagination'>";
                foreach ( $arDataListGamesFiles[ "data" ] as $arDataListGamesFile ){
                    $listGamesFiles .= "<div class='games'>";
                        $listGamesFiles .= "<div class='game'>";
                            $listGamesFiles .= "<div class='logogame'>";
                                $listGamesFiles .= "<a href='gamesSheet.php?idGame={$arDataListGamesFile[ "idGame" ]}'><img class='width100 radius10 newGamePhoto' src='{$arDataListGamesFile[ "photoGame" ]}'/></a>";
                            $listGamesFiles .= "</div>";
                            $listGamesFiles .= "<h2 class='gameTitleH2'>";
                                $listGamesFiles .= "<span class='gameTitleSpan'>";
                                    $listGamesFiles .= "<a href='gamesSheet.php?idGame={$arDataListGamesFile[ "idGame" ]}'>{$arDataListGamesFile[ "nameGame" ]}</a>";
                                $listGamesFiles .= "</span>";
                            $listGamesFiles .= "</h2>";
                        $listGamesFiles .= "</div>";
                    $listGamesFiles .= "</div>";
                }
            $listGamesFiles .= "</div>";
            
            $listGamesFiles .= "<div class='nextPreviousDiv'>";

                    if ( $initialRow !== 0 ) {
                        $prevRow = $initialRow - $pageRows;
                        $listGamesFiles.= "<div id='previousInitial'>";
                        $listGamesFiles.= "<button class='firstPage'>";
                        $listGamesFiles.=       "<a href='games.php?row=0'><span class='paginationP'><</span></a>";
                        $listGamesFiles.= "</button>";
                        $listGamesFiles.= "<button class='previous'>";
                        $listGamesFiles.=       "<a href='games.php?row=$prevRow'><span class='paginationP'>Anterior</span></a>";
                        $listGamesFiles.= "</button>";
                        $listGamesFiles.= "</div>";
                    }

                $listGamesFiles .= " ";

                    if ( $initialRow + $pageRows < $arDataListGamesFiles[ "totalRows" ] ) {
                        $nextRow = $initialRow + $pageRows;
                        $listGamesFiles.= "<div id='nextLast'>";
                        $listGamesFiles.= "<button class='next'>";
                        $listGamesFiles.=       "<a href='games.php?row=$nextRow'><span class='paginationP'>Siguiente</span></a>";
                        $listGamesFiles.= "</button>";
                        $totalPages = ceil( $arDataListGamesFiles[ "totalRows" ]/$pageRows );
                        $lastpage = ( $totalPages - 1 ) * $pageRows;
                        $listGamesFiles.= "<button class='lastPage'>";
                        $listGamesFiles.=       "<a href='games.php?row=$lastpage'><span class='paginationP'>></span></a>";
                        $listGamesFiles.= "</button>";
                        $listGamesFiles.= "</div>";
                    }
            $listGamesFiles .= "</div>";
        } else if ( $arDataListGamesFiles[ "status" ][ "codError" ] === "001" ) {
            $listGamesFiles = "No tenemos los datos de los juegos";
        }
        return $listGamesFiles;
    }

    /** Muestra una paginación de la lista de juegos, limitados a dos por página, con su imagen y su título. Además, añade un siguiente ( para los dos siguientes juegos ) o un anterior ( dos anteriores juegos ) y unos símbolos ( '<' '>' ) para el inicio de la paginación o el final. Envía el id correspondiente para acceder a cada juego.
            -- Arguments:
                - initialRow                    : variable que contiene la fila en la que estoy.
                - pageRows                      : variable que tiene la cantidad de registros por página.
            -- Return:
                - listGamesFiles                : estructura de varios div con una <a></a> que redirige al juego y una paginación adelante o atrás y principio o final; título en <p></p>.
            -- Author:
                - Víctor Ubago Conde
            -- Dates:

                - Creation          : 2022 - Nov
                - Review            :
    */

    function mod004_getDetailPlatforms( $idPlatform, $idGame ){
        $arDataDetailPlatforms = mod003_getDetailPlatforms( $idPlatform, $idGame );
        $listDetails = "";
        $listDetails .= "<div class='edition'>";
            $listDetails .= "<table>";
        foreach ( $arDataDetailPlatforms[ "data" ] as $key => $arDataDetailPlatform ) {
            foreach ( $arDataDetailPlatform as $key => $dataDetail ) {
                $listDetails .= "<tr>";
                    $listDetails .= "<td>";
                        $listDetails .= $dataDetail;
                    $listDetails .= "</td>";
                $listDetails .= "</tr>";
            }
        }
            $listDetails .= "</table>";
        $listDetails .= "</div>";
        return $listDetails;
    }

    /** Muestra las edciones correspondientes a cada plataforma.
            -- Arguments:
                - idPlatform                    : variable que trae el identificador de una plataforma.
                - idGame                        : variable que trae el identificador de un videojuego.
            -- Return:
                - listPlatforms                 : formateo de un div que contiene un table y el dato, es decir, las ediciones.
            -- Author:
                - Víctor Ubago Conde
            -- Dates:

                - Creation          : 2022 - Nov
                - Review            :
    */

    function mod004_getPegiAges(){
        $arDataPegi = mod003_getPegiAges();
        $listPegi = "";
        $listPegi .= "<select name='idPegi'>";
        foreach ( $arDataPegi[ "data" ] as $key => $items )  {
            $listPegi .=    "<option value={$items[ "idPegi" ]}>{$items[ "titlePegi" ]}</option>";
        }
        $listPegi .="</select>";
        return $listPegi;
    }

    /** Muestra un desplegable de todas las edades recomendades de un videojuego para insertar en el nuevo videojuego.
            -- Arguments:

            -- Return:
                - listPegi            : etiqueta <select></select> que tiene en sus <option></option> posee los nombres de las edades recomendadas.
            -- Author:
                - Víctor Ubago Conde
            -- Dates:

                - Creation          : 2022 - Nov
                - Review            :
    */

?>
