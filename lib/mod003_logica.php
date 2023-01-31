 <?php
	require ("mod002_accesoadatos.php");
	//require ("internaslogica.php");
	//require ("accesoadisco.php");

    function mod003_getNewGame(){
        $arGameComingSoon = mod002_getNewGame();
        return $arGameComingSoon;
    }

    /** Llama a una función del modelo 002 que trae el próximo juego.
            -- Arguments:

            -- Return:
                - arGameComingSoon  : array asociativo con status y data, en data, todos los datos de la query.
            -- Author:
                - Víctor Ubago Conde
            -- Dates:

                - Creation          : 2022 - Nov
                - Review            :
    */

    function mod003_getPlatforms(){
        $arDataPlatforms = mod002_getPlatforms();
        return $arDataPlatforms;
    }

    /** Llama a una función del modelo 002 que trae las plataformas.
            -- Arguments:

            -- Return:
                - arDataPlatforms  : array asociativo con status y data, en data, todos los datos de la query.
            -- Author:
                - Víctor Ubago Conde
            -- Dates:

                - Creation          : 2022 - Nov
                - Review            :
    */

    function mod003_getGamesSheet( $idGame ){
        $arDataGamesSheet = mod002_getGamesSheet( $idGame );
        if ( $arDataGamesSheet[ "status" ][ "codError" ] === "000"){
            $arDataGamesSheet[ "data" ][ 0 ][ "nameGames" ] = strtoupper( $arDataGamesSheet[ "data" ][ 0 ][ "nameGames" ] );
            $arDataGamesSheet[ "data" ][ 0 ][ "dateGames" ] = date( "Y, M, d ", strtotime ($arDataGamesSheet[ "data" ][ 0 ][ "dateGames" ]) );
        }
        return $arDataGamesSheet;
    }

    /** Llama a una función del modelo 002 que trae los datos de un videojuego, convierte el nombre a mayúsculas ( strtoupper ) y transforma la fecha a un formato legible( date( ,(strtotime)  ) ).
            -- Arguments:
                - idGame                     : variable que trae el identificador de un videojuego.
            -- Return:
                - arDataGamesSheet           : array asociativo con status y data, en data, todos los datos de la query y, en uno de ellos, el parámetro.
            -- Author:
                - Víctor Ubago Conde
            -- Dates:

                - Creation          : 2022 - Nov
                - Review            :
    */

    function mod003_getGamesFiles( $idGame ){
        $arDataGamesFiles = mod002_getGamesFiles( $idGame );
        return $arDataGamesFiles;
    }

    /** Llama a una función del modelo 002 que trae las imágenes de los videojuegos.
            -- Arguments:
                - idGame                      : variable que trae el identificador de un videojuego.
            -- Return:
                - arDataGamesFiles            : array asociativo con status y data, en data, todos los datos de la query y, en uno de ellos, el parámetro.
            -- Author:
                - Víctor Ubago Conde
            -- Dates:

                - Creation          : 2022 - Nov
                - Review            :
    */

    function mod003_getGameReviews( $idGame ){
        $arDataGamesReviews = mod002_getGameReviews( $idGame );
        if ( $arDataGamesReviews[ "status" ][ "codError" ] === "000"){
                $arDataGamesReviews[ "data" ][ 0 ][ "comentGames" ] = ucfirst( $arDataGamesReviews[ "data" ][ 0 ][ "comentGames" ] );      
        }
        return $arDataGamesReviews;
    }

    /** Llama a una función del modelo 002 que trae los comentarios de un videojuego y convierte la primera letra del comentario a mayúsculas ( ucfirst ).
            -- Arguments:
                - idGame                       : variable que trae el identificador de un videojuego.
            -- Return:
                - arDataGamesReviews           : array asociativo con status y data, en data, todos los datos de la query y, en uno de ellos, el parámetro.
            -- Author:
                - Víctor Ubago Conde
            -- Dates:

                - Creation          : 2022 - Nov
                - Review            :
    */

    function mod003_getPlatformSheet( $idPlatform ){
        $arDataPlatformsSheet = mod002_getPlatformSheet( $idPlatform );
        return $arDataPlatformsSheet;
    }

    /** Llama a una función del modelo 002 que trae los datos de una plataforma.
            -- Arguments:
                - idPlatform                  : variable que trae el identificador de una plataforma.
            -- Return:
                - arDataPlatformsSheet        : array asociativo con status y data, en data, todos los datos de la query y, en uno de ellos, el parámetro.
            -- Author:
                - Víctor Ubago Conde
            -- Dates:

                - Creation          : 2022 - Nov
                - Review            :
    */

    function mod003_getGamesPerPlatform( $idPlatform ){
        $arDataGamesPlatform = mod002_getGamesPerPlatform( $idPlatform );
        return $arDataGamesPlatform;
    }

    /** Llama a una función del modelo 002 que trae los juegos por cada plataforma.
            -- Arguments:
                - idPlatform                    : variable que trae el identificador de una plataforma.
            -- Return:
                - arDataGamesPlatform           : array asociativo con status y data, en data, todos los datos de la query y, en uno de ellos, el parámetro.
            -- Author:
                - Víctor Ubago Conde
            -- Dates:

                - Creation          : 2022 - Nov
                - Review            :
    */

    function mod003_getPlatformsByGame( $idGame ){
        $arDataGamesPlatformSheet = mod002_getPlatformsByGame( $idGame );
        return $arDataGamesPlatformSheet;
    }

    /** Llama a una función del modelo 002 que trae las plataformas por cada videojuego.
            -- Arguments:
                - idGame                        : variable que trae el identificador de un videojuego.
            -- Return:
                - arDataGamesPlatformSheet      : array asociativo con status y data, en data, todos los datos de la query y, en uno de ellos, el parámetro.
            -- Author:
                - Víctor Ubago Conde
            -- Dates:

                - Creation          : 2022 - Nov
                - Review            :
    */

    function mod003_getAllAgeGames(){
        $arDataAllAgeGames = mod002_getAllAgeGames();
        
        return $arDataAllAgeGames;
    }

    /** Llama a una función del modelo 002 que trae los juegos con edad recomendada para todos los públicos.
            -- Arguments:

            -- Return:
                - arDataAllAgeGames       : array asociativo con status y data, en data, todos los datos de la query y, en uno de ellos, el parámetro.
            -- Author:
                - Víctor Ubago Conde
            -- Dates:

                - Creation          : 2022 - Nov
                - Review            :
    */

    function mod003_getValidateUser( $email, $password ){
        $arDataValidateUser = mod002_getValidateUser( $email, $password );
        if ( $arDataValidateUser[ "status" ][ "codError" ] === "000" ) {
            if ( $arDataValidateUser[ "status" ][ "numRows"] === 1 ) {
                
                $_SESSION[ "idUser" ]   = $arDataValidateUser[ "data" ][ 0 ][ "idUser" ];
                if ( $arDataValidateUser[ "data" ][ 0 ][ "nameNick" ] === null ) {
                    $_SESSION[ "nameUser" ] = $arDataValidateUser[ "data" ][ 0 ][ "nameUser" ];
                } else {
                    $_SESSION[ "nameUser" ] = $arDataValidateUser[ "data" ][ 0 ][ "nameNick" ];
                }
                header( "Location:mainGames.php" );
            } else {
                echo "Intentas hackearme, no vuelvas a intentarlo.";
               
            }

        } else if ( $arDataValidateUser[ "status" ][ "codError" ] === "001" ) {
            echo "Email y contraseña incorrectos.";
        }
    }

    /** Validar si el $_SESSION contiene el nombre del usuario, el nick o el id del usuario.
            -- Arguments:
                - email                        : variable que trae el correo electrónico de un usuario.
                - password                     : variable que trae la contraseña de un usuario.

            -- Return:

            -- Author:
                - Víctor Ubago Conde
            -- Dates:

                - Creation          : 2022 - Nov
                - Review            :
    */

    function mod003_getDestroySession(){
        session_destroy();
        $_SESSION = array();
        header( "Location:mainGames.php" );
    }

    /** Destruir la sesión de un usuario y redirigirlo a la página principal.
            -- Arguments:

            -- Return:

            -- Author:
                - Víctor Ubago Conde
            -- Dates:

                - Creation          : 2022 - Nov
                - Review            :
    */

    function mod003_getListGamesFiles( $initialRow, $pageRows){
        $arDataListGamesFiles = mod002_getListGamesFiles( $initialRow, $pageRows);
        $arTotalGames = mod02getTotalGames();
        
        if ( $arTotalGames[ "status" ][ "codError" ] === "000" ) {
            $totalRows = $arTotalGames[ "data" ][ 0 ][ "totalGames" ];
        
            if ( $arDataListGamesFiles[ "status" ][ "codError" ] === "000" ) {
                $arDataListGamesFiles[ "totalRows" ] = $totalRows;
            }
            
        }
        return $arDataListGamesFiles;
    }

    /** Llama a dos funciones del modelo 002 ( mod002_getListGamesFiles y mod02getTotalGames ) para crear una estructura que genere una nueva posición con el total de las filas.
            -- Arguments:
                - initialRow                    : variable que contiene la fila en la que estoy.
                - pageRows                      : variable que tiene la cantidad de registros por página.
            -- Return:
                - arDataListGamesFiles          : array asociativo con status, data y totalRows, en data, todos los datos de la query y, en unos de ellos, los parámetros.
            -- Author:
                - Víctor Ubago Conde
            -- Dates:

                - Creation          : 2022 - Nov
                - Review            :
    */

    function mod003_getDetailPlatforms( $idPlatform, $idGame ){
         $arDataDetailPlatforms = mod002_getDetailPlatforms( $idPlatform, $idGame);
        return $arDataDetailPlatforms;
    }

    /** Llama a una función del modelo 002 que trae los detalles de cada edición en cada plataforma.
            -- Arguments:
                - idPlatform                    : variable que trae el identificador de una plataforma.
                - idGame                        : variable que trae el identificador de un videojuego.
            -- Return:
                - arDataDetailPlatforms         : array asociativo con status y data, en data, todos los datos de la query y, en unos de ellos, los parámetros.
            -- Author:
                - Víctor Ubago Conde
            -- Dates:

                - Creation          : 2022 - Nov
                - Review            :
    */

    function mod003_getPegiAges(){
        $arDataPegi = mod002_getPegiAges();
        return $arDataPegi;
    }

    /** Llama a una función del modelo 002 que trae las edades recomendadas de un videojuego.
            -- Arguments:

            -- Return:
                - arDataPegi        : array asociativo con status y data, en data, todos los datos de la query.
            -- Author:
                - Víctor Ubago Conde
            -- Dates:

                - Creation          : 2022 - Nov
                - Review            :
    */

    function mod003_setNewGame( $titleGame, $description, $relasedate, $idPegi ){
        return mod002_setNewGame( $titleGame, $description, $relasedate, $idPegi );
    }

    /** Envía los parámetros del título, la descripción, la fecha y la edad recomendada de un videojuego nuevo para introducirse en la BD.
            -- Arguments:
                - titleGame                     : variable que envía el título de un videojuego.
                - description                   : variable que envía la descripción de un videojuego.
                - relasedate                    : variable que envía la fecha de un videojuego.
                - idPegi                        : variable que envía la edad recomendada de un videojuego.
            -- Return:
                - mod002_setNewGame( $titleGame, $description, $relasedate, $idPegi )  : una función con parámetros que se introducen en la BDD.
            -- Author:
                - Víctor Ubago Conde
            -- Dates:

                - Creation          : 2022 - Nov
                - Review            :
    */

    function mod003_search( $itemToSearch ) {

        // OK. array_merge falla cuando uno de los arrays no devuelve datos.
        // OK. No hay nada que devuelva Sin datos.
        // OK. hay que hacer busquedas por palabras tecleadas.( cuando son dos palabras)
        // OK. Cuando son 3 palabras hay que hacer otros tipos de busquedas.
        // Si las palabras tienen artículos( un, el, la, y ) hay que decidir.
        // Que pasa con las tildes, las comillas, los carracteres especiales.
        // Falta quitar duplicados por idPlayer y por supuesto idTeam.
        // Máximo x resultados.

        $arDataGames = mod002_getGamesSearch( $itemToSearch );
        if ( $arDataGames[ "status" ][ "codError"] === "001" ) {
            $arDataGames[ "data" ] = [];
        }
        /* echo "arDataPlayers\n";
        dump( $arDataPlayers ); */
        $arWords = explode( " ", $itemToSearch );

        
       // dump( $arWords );
        
        if ( count( $arWords ) > 1 ) {
            foreach ( $arWords as $word ) {
                //dump( $word );
                if ( $word !== "" ) {
                    $arArray1 = mod002_getGamesSearch( $word );
                    if ( $arArray1[ "status" ][ "codError" ] === "000" ) { 
                        $arDataGames[ "data" ] = array_merge( $arDataGames[ "data" ], $arArray1[ "data" ] );
                    } else {
                        //$arDataPlayersTMP[ "data" ] = [];
                        $arDataGames[ "data" ] = array_merge( $arDataGames[ "data" ], [] );
                    }
                    /* echo "\narDataPlayersTMP\n";
                    dump( $arDataPlayersTMP ); */
                }
            }
        }

        $arDataPlatforms = mod002_getPlatformsSearch( $itemToSearch );
        if ( $arDataPlatforms[ "status" ][ "codError"] === "001" ) {
            $arDataPlatforms[ "data" ] = [];
        }
        $arDataSearch = array_merge( $arDataPlatforms[ "data" ], $arDataGames[ "data" ] );

        

        $arDataSearchWithoutDuplicates = [];
        foreach ($arDataSearch as $element) {
            $bFound = false;
            if ( isset( $element[ "idGame" ] ) ) {
                foreach ( $arDataSearchWithoutDuplicates as $element2 ) {
                    if ( isset( $element2[ "idGame" ] ) ) {
                        if ( $element2[ "idGame" ] === $element[ "idGame" ] ) {
                            $bFound = true;
                        }
                    }
                }
                if ( !$bFound ) { 
                    $arDataSearchWithoutDuplicates[] = $element;
                }
            } else if ( isset( $element[ "idPlatform" ] ) ) {
                foreach ( $arDataSearchWithoutDuplicates as $element2 ) {
                    if ( isset( $element2[ "idPlatform" ] ) ) {
                        if ( $element2[ "idPlatform" ] === $element[ "idPlatform" ] ) {
                            $bFound = true;
                        }
                    }
                }
                if ( !$bFound ) { 
                    $arDataSearchWithoutDuplicates[] = $element;
                }
            }
        }


        return $arDataSearchWithoutDuplicates;
    }

    /** Llama a dos funciones del modelo 002 que trae lo que los parámetros ( letras o palabras del buscador ) indican y crea un estructura para combinar los dos arryas de cada función; se condiciona para no duplicar información.
            -- Arguments:

            -- Return:
                - arDataSearchWithoutDuplicates    : array con tres posiciones asociativas del id, el nombre y la foto de videojuegos o plataformas.
            -- Author:
                - Víctor Ubago Conde
            -- Dates:

                - Creation          : 2022 - Nov
                - Review            :
    */
?>
