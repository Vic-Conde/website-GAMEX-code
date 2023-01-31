 <?php
	require ("mod001_conexion.php");
    
    // Función generalista que ejecuta una query y obtiene y transforma los datos de la query con el array $arAttributes.
    function mod002_executeQueryOLD( $strSQL, $arAttributes ) {
        $link = mod001_conectoBD();
        
        if ( $result = $link -> query( $strSQL ) ) {
            if ( $result -> num_rows !== 0 ) {
                $arRetorno[ "status" ][ "codError" ] = "000"; // Con datos.
                $arRetorno[ "status" ][ "numRows" ]  = $result -> num_rows;
                
                $i = 0;
                while ( $row = $result -> fetch_array( MYSQLI_ASSOC ) ) {
                    foreach( $arAttributes as $element ) {
                        if ( isset( $element[ 2 ] ) ) {
                            if ( $element[ 2 ] === "bool" ) {
                                $arRetorno[ "data" ][ $i ][ $element[ 1 ] ] = (bool)$row[ $element[ 0 ] ];
                            } else if ( $element[ 2 ] === "int" ) {
                                if ( $row[ $element[ 0 ] ] !== null ) {
                                    $arRetorno[ "data" ][ $i ][ $element[ 1 ] ] = intval( $row[ $element[ 0 ] ] );
                                } else {
                                    $arRetorno[ "data" ][ $i ][ $element[ 1 ] ] = null;
                                }
                            }
                        } else {
                            $arRetorno[ "data" ][ $i ][ $element[ 1 ] ] = $row[ $element[ 0 ] ];
                        }                 
                    }
                    $i++;
                }
            } else {
                $arRetorno[ "status" ][ "codError" ]    = "001"; // Sin datos.
                $arRetorno[ "status" ][ "strSQL" ]      = $strSQL;
            }
        } else {
            $arRetorno[ "status" ][ "codError" ]        = "002"; // Error Query.
            $arRetorno[ "status" ][ "strSQL" ]          = $strSQL;
            $arRetorno[ "status" ][ "codSQL" ]          = $link -> errno;
            $arRetorno[ "status" ][ "desSQL" ]          = $link -> error;
        }
       
        mod001_desconectoBD($link);

        return $arRetorno;
    }

    function mod002_executeQuery( $strSQL, $arAttributes ) {
        $link = mod001_conectoBD();
        
        if ( $result = $link -> query( $strSQL ) ) {
            if ( $result -> num_rows !== 0 ) {
                $arRetorno[ "status" ][ "codError" ] = "000"; // Con datos.
                $arRetorno[ "status" ][ "numRows" ]  = $result -> num_rows;
                
                $i = 0;
                while ( $row = $result -> fetch_array( MYSQLI_ASSOC ) ) {
                    foreach( $arAttributes as $element ) {
                        if ( isset( $element[ 2 ] ) ) {
                            if ( $element[ 2 ] === "bool" ) {
                                $arRetorno[ "data" ][ $i ][ $element[ 1 ] ] = (bool)$row[ $element[ 0 ] ];
                            } else if ( $element[ 2 ] === "int" ) {
                                if ( $row[ $element[ 0 ] ] !== null ) {
                                    $arRetorno[ "data" ][ $i ][ $element[ 1 ] ] = intval( $row[ $element[ 0 ] ] );
                                } else {
                                    $arRetorno[ "data" ][ $i ][ $element[ 1 ] ] = null;
                                }
                            } else if ( $element[ 2 ] === "float" ) {
                                $arRetorno[ "data" ][ $i ][ $element[ 1 ] ] = floatval( $row[ $element[ 0 ] ] );
                            }
                        } else {
                            $arRetorno[ "data" ][ $i ][ $element[ 1 ] ] = $row[ $element[ 0 ] ];
                        }                 
                    }
                    $i++;
                }
            } else {
                $arRetorno[ "status" ][ "codError" ]    = "001"; // Sin datos.
                $arRetorno[ "status" ][ "strSQL" ]      = $strSQL;
            }
        } else {
            $arRetorno[ "status" ][ "codError" ]        = "002"; // Error Query.
            $arRetorno[ "status" ][ "strSQL" ]          = $strSQL;
            $arRetorno[ "status" ][ "codSQL" ]          = $link -> errno;
            $arRetorno[ "status" ][ "desSQL" ]          = $link -> error;
        }
       
        mod001_desconectoBD($link);

        return $arRetorno;
    }

    function mod002_getNewGame(){
        $arAttributes = [
            [ "nomimagenvideo",           "photoGames"            ],
            [ "idvideojuego",             "idGame",      "int"    ]
        ];

        $strSQL = "SELECT VIDEOJUEGOS.idvideojuego, nomimagenvideo
                    FROM VIDEOJUEGOS
                    INNER JOIN IMAGENESVIDEOS
                    ON VIDEOJUEGOS.idvideojuego = IMAGENESVIDEOS.idvideojuego
                    WHERE DATE(feclanzamiento) > DATE( NOW() )";

        $arRetorno = mod002_executeQuery( $strSQL, $arAttributes );

        return $arRetorno;
    }

    /** Query que trae las imágenes y el id de un videojuego.
            -- Arguments:

            -- Return:
                - arRetorno         : array asociativo con status y data, en data, todos los datos de la query.
            -- Author:
                - Víctor Ubago Conde
            -- Dates:

                - Creation          : 2022 - Nov
                - Review            :
    */

    function mod002_getListGamesFiles( $initialRow, $pageRows) {
        $arAttributes = [
            [ "idvideojuego",      "idGame",      "int"            ],
            [ "titulo",            "nameGame"                      ],
            [ "nomimagenvideo",    "photoGame"                     ]
        ];
       
        $strSQL = "SELECT VIDEOJUEGOS.idvideojuego, titulo, nomimagenvideo
                    FROM VIDEOJUEGOS
                    INNER JOIN IMAGENESVIDEOS
                    ON VIDEOJUEGOS.idvideojuego = IMAGENESVIDEOS.idvideojuego
                    GROUP BY VIDEOJUEGOS.idvideojuego
                    LIMIT $initialRow, $pageRows";
    
        $arRetorno = mod002_executeQuery( $strSQL, $arAttributes );
        
        return $arRetorno;
    }

    /** Query que trae el id, el título y las imágenes de un videojuego.
            -- Arguments:
                - initialRow                : variable que contiene la fila en la que estoy.
                - pageRows                  : variable que tiene la cantidad de registros por página.
            -- Return:
                - arRetorno                 : array asociativo con status y data, en data, todos los datos de la query y, en uno de ellos, el parámetro.
            -- Author:
                - Víctor Ubago Conde
            -- Dates:

                - Creation          : 2022 - Nov
                - Review            :
    */

    function mod02getTotalGames(){
        $arAttributes = [
            [ "totaljuegos",      "totalGames",      "int"            ]
        ];
       
        $strSQL = "SELECT COUNT( * ) AS totaljuegos
                    FROM VIDEOJUEGOS";
    
        $arRetorno = mod002_executeQuery( $strSQL, $arAttributes );
        
        return $arRetorno;
    }

    /** Query que trae la suma total de los videojuegos .
            -- Arguments:

            -- Return:
                - arRetorno         : : array asociativo con status y data, en data, todos los datos de la query.
            -- Author:
                - Víctor Ubago Conde
            -- Dates:

                - Creation          : 2022 - Nov
                - Review            :
    */

    function mod002_getPlatforms(){
        $arAttributes = [
            [ "idplataforma",       "idPlatform",           "int"   ],
            [ "descripcion",        "description"                   ],
            [ "imgplataforma",      "photoPlatforms"                ]
        ];

        $strSQL = "SELECT descripcion, idplataforma, imgplataforma
                    FROM PLATAFORMAS
                    ORDER BY idplataforma";

        $arRetorno = mod002_executeQuery( $strSQL, $arAttributes );

        return $arRetorno;
    }

    /** Query que trae el id, el nombre y la imagen o imágenes de una plataforma.
            -- Arguments:
                
            -- Return:
                - arRetorno         : array asociativo con status y data, en data, todos los datos de la query.
            -- Author:
                - Víctor Ubago Conde
            -- Dates:

                - Creation          : 2022 - Nov
                - Review            :
    */

    function mod002_getGamesSheet(  $idGame ){
        $arAttributes = [
            [ "idvideojuego",            "idGame",        "int"       ],
            [ "titulo",                  "nameGames"                  ],
            [ "descripcion",             "description"                ],
            [ "feclanzamiento",          "dateGames"                  ],
            [ "imgpegiedad",             "PEGI"                       ]

            
        ];

        $strSQL = "SELECT titulo, idvideojuego, descripcion, feclanzamiento, imgpegiedad
                    FROM VIDEOJUEGOS
                    INNER JOIN PEGIEDADES
                    ON VIDEOJUEGOS.idpegiedad = PEGIEDADES.idpegiedad
                    WHERE idvideojuego = $idGame";

        $arRetorno = mod002_executeQuery( $strSQL, $arAttributes );

        return $arRetorno;
    }

    /** Query que trae el id, el nombre, la descripción, la fecha y la edad recomendada de un videojuego .
            -- Arguments:
                - idGame            : variable que trae el identificador de un videojuego.
            -- Return:
                - arRetorno         : array asociativo con status y data, en data, todos los datos de la query y, en uno de ellos, el parámetro.
            -- Author:
                - Víctor Ubago Conde
            -- Dates:

                - Creation          : 2022 - Nov
                - Review            :
    */

    function mod002_getGamesFiles( $idGame ){
        $arAttributes = [
            [ "idvideojuego",             "idGame",       "int"       ],
            [ "titulo",                   "nameGames"                 ],
            [ "nomimagenvideo",           "photoGames"                ],
            [ "iorden",                   "order"                     ]
        ];

        $strSQL = "SELECT VIDEOJUEGOS.idvideojuego, nomimagenvideo, iorden, titulo
                    FROM VIDEOJUEGOS
                    INNER JOIN IMAGENESVIDEOS
                    ON VIDEOJUEGOS.idvideojuego = IMAGENESVIDEOS.idvideojuego
                    WHERE VIDEOJUEGOS.idvideojuego = $idGame
                    ORDER BY iorden ASC";

        $arRetorno = mod002_executeQuery( $strSQL, $arAttributes );

        return $arRetorno;
    }

    /** Query que trae el id, el nombre y las imágenes de un videojuegos ordenados, ascendentemente por el iorden.
            -- Arguments:
                - idGame            : variable que trae el identificador de un videojuego.
            -- Return:
                - arRetorno         : array asociativo con status y data, en data, todos los datos de la query y, en uno de ellos, el parámetro.
            -- Author:
                - Víctor Ubago Conde
            -- Dates:

                - Creation          : 2022 - Nov
                - Review            :
    */

    function mod002_getGameReviews( $idGame ){
        $arAttributes = [
            [ "idvideojuego",             "idGame",              "int"       ],
            [ "titulo",                   "titleComent",                     ],
            [ "comentario",               "comentGames"                      ]
        ];

        $strSQL = "SELECT VIDEOJUEGOS.idvideojuego, CRITICAS.titulo, comentario
                    FROM VIDEOJUEGOS
                    INNER JOIN CRITICAS
                    ON VIDEOJUEGOS.idvideojuego = CRITICAS.idvideojuego
                    WHERE VIDEOJUEGOS.idvideojuego = $idGame";

        $arRetorno = mod002_executeQuery( $strSQL, $arAttributes );

        return $arRetorno;
    }

    /** Query que trae el id, el título y el contenido de uno o varios comentarios de un videojuego.
            -- Arguments:
                - idGame            : variable que trae el identificador de un videojuego.
            -- Return:
                - arRetorno         : array asociativo con status y data, en data, todos los datos de la query y, en uno de ellos, el parámetro.
            -- Author:
                - Víctor Ubago Conde
            -- Dates:

                - Creation          : 2022 - Nov
                - Review            :
    */

    function mod002_getPlatformSheet( $idPlatform ){
        $arAttributes = [
            [ "idplataforma",       "idPlatform",           "int"   ],
            [ "nomplataforma",      "namesPlatforms"                ],
            [ "imgplataforma",      "photoPlatforms"                ]
        ];

        $strSQL = "SELECT nomplataforma, idplataforma, imgplataforma
                    FROM PLATAFORMAS
                    WHERE idplataforma = $idPlatform
                    ORDER BY idplataforma";

        $arRetorno = mod002_executeQuery( $strSQL, $arAttributes );

        return $arRetorno;
    }

    /** Query que trae el id, el nomnbre y las imágenes de una plataforma.
            -- Arguments:
                - idPlatform        : variable que trae el identificador de una plataforma.
            -- Return:
                - arRetorno         : array asociativo con status y data, en data, todos los datos de la query y, en uno de ellos, el parámetro.
            -- Author:
                - Víctor Ubago Conde
            -- Dates:

                - Creation          : 2022 - Nov
                - Review            :
    */

    function mod002_getGamesPerPlatform( $idPlatform ){
        $arAttributes = [
            [ "idvideojuego",             "idGame",            "int"     ],
            [ "titulo",                  "nameGames"                     ],
            [ "idplataforma",            "idPlatform",         "int"     ]
            
        ];

        $strSQL = "SELECT DISTINCT `titulo`, `VIDEOJUEGOS`.`idvideojuego`, `PLATAFORMAS`.`idplataforma`
                    FROM `VIDEOJUEGOS`
                    INNER JOIN `VIDEOJUEGOSPLATAFORMAS`
                    ON `VIDEOJUEGOS`.`idvideojuego` = `VIDEOJUEGOSPLATAFORMAS`.`idvideojuego`
                    INNER JOIN `PLATAFORMAS`
                    ON `VIDEOJUEGOSPLATAFORMAS`.`idplataforma` = `PLATAFORMAS`.`idplataforma`
                    WHERE `PLATAFORMAS`.idplataforma = $idPlatform";

        $arRetorno = mod002_executeQuery( $strSQL, $arAttributes );

        return $arRetorno;
    }

    /** Query que trae el id, el nombre de un videojuego, así como el id de una plataforma.
            -- Arguments:
                - idPlatform        : variable que trae el identificador de una plataforma.
            -- Return:
                - arRetorno         : array asociativo con status y data, en data, todos los datos de la query y, en uno de ellos, el parámetro.
            -- Author:
                - Víctor Ubago Conde
            -- Dates:

                - Creation          : 2022 - Nov
                - Review            :
    */

    function mod002_getPlatformsByGame( $idGame ){
        $arAttributes = [
            [ "idvideojuego",            "idGame",                 "int"      ],
            [ "titulo",                  "nameGames"                          ],
            [ "idplataforma",            "idPlatform",              "int"     ],
            [ "nomplataforma",           "namesPlatforms"                     ]
            
        ];

        $strSQL = "SELECT DISTINCT `titulo`, `VIDEOJUEGOS`.`idvideojuego`, `PLATAFORMAS`.`idplataforma`, `nomplataforma`
                    FROM `VIDEOJUEGOS`
                    INNER JOIN `VIDEOJUEGOSPLATAFORMAS`
                    ON `VIDEOJUEGOS`.`idvideojuego` = `VIDEOJUEGOSPLATAFORMAS`.`idvideojuego`
                    INNER JOIN `PLATAFORMAS`
                    ON `VIDEOJUEGOSPLATAFORMAS`.`idplataforma` = `PLATAFORMAS`.`idplataforma`
                    WHERE `VIDEOJUEGOS`.`idvideojuego` = $idGame";

        $arRetorno = mod002_executeQuery( $strSQL, $arAttributes );

        return $arRetorno;
    }

    /** Query que trae el id y el nombre de un videojuego, así como el id y el nombre de una plataforma.
            -- Arguments:
                - idGame            : variable que trae el identificador de un videojuego.
            -- Return:
                - arRetorno         : array asociativo con status y data, en data, todos los datos de la query y, en uno de ellos, el parámetro.
            -- Author:
                - Víctor Ubago Conde
            -- Dates:

                - Creation          : 2022 - Nov
                - Review            :
    */

    function mod002_getAllAgeGames(){
        $arAttributes = [
            [ "nomimagenvideo",           "photoGames"            ],
            [ "idvideojuego",             "idGame",      "int"    ]
        ];

        $strSQL = "SELECT VIDEOJUEGOS.idvideojuego, nomimagenvideo
                    FROM IMAGENESVIDEOS
                    INNER JOIN VIDEOJUEGOS
                    ON IMAGENESVIDEOS.idvideojuego = VIDEOJUEGOS.idvideojuego
                    INNER JOIN PEGIEDADES
                    ON VIDEOJUEGOS.idpegiedad = PEGIEDADES.idpegiedad 
                    WHERE PEGIEDADES.idpegiedad = 1";

        $arRetorno = mod002_executeQuery( $strSQL, $arAttributes );

        return $arRetorno;
    }

    /** Query que trae las imágenes y el id de un videojuego.
            -- Arguments:

            -- Return:
                - arRetorno         : array asociativo con status y data, en data, todos los datos de la query.    
            -- Author:
                - Víctor Ubago Conde
            -- Dates:

                - Creation          : 2022 - Nov
                - Review            :
    */

    function mod002_getValidateUser( $email, $password ){
        $arAttributes = [
            [ "idusuario",           "idUser",          "int"    ],
            [ "nomusuario",        "nameUser",                   ],
            [ "nomnick",            "nameNick",                  ]
        ];

        $strSQL = "SELECT USUARIOS.idusuario, nomusuario, nomnick
                    FROM USUARIOS
                    LEFT JOIN NICKUSUARIOS
                    ON USUARIOS.idusuario = NICKUSUARIOS.idusuario
                    WHERE email = '$email'
                    AND passwordusuario = '$password'
                    ORDER BY fecinicio DESC
                    LIMIT 1";

        $arRetorno = mod002_executeQuery( $strSQL, $arAttributes );

        return $arRetorno;
    }

    /** Query que trae el id, el nombre y el nick de un usuario .
            -- Arguments:
                - email             : variable que trae el correo electrónico de un usuario.
                - password          : variable que trae la contraseña de un usuario.
            -- Return:
                - arRetorno         : array asociativo con status y data, en data, todos los datos de la query y, en uno de ellos, el parámetro.
            -- Author:
                - Víctor Ubago Conde
            -- Dates:

                - Creation          : 2022 - Nov
                - Review            :
    */

    function mod002_getDetailPlatforms( $idPlatform, $idGame ){
        $arAttributes = [
            [ "nomedicion",          "nameEdition"                     ],
            [ "precio",              "price",                 "float"  ]

        ];

        $strSQL = "SELECT nomedicion, precio
                    FROM PLATAFORMAS
                    INNER JOIN PACKSCONEDICIONES
                    ON PLATAFORMAS.idplataforma = PACKSCONEDICIONES.idplataforma
                    INNER JOIN EDICIONES
                    ON EDICIONES.idedicion = PACKSCONEDICIONES.idedicion
                    WHERE PLATAFORMAS.idplataforma = $idPlatform
                    AND idvideojuego = $idGame";

        $arRetorno = mod002_executeQuery( $strSQL, $arAttributes );
        return $arRetorno;
    }

    /** Query que trae el nombre y el precio de cada edición.
            -- Arguments:
                - idPlatform        : variable que trae el identificador de una plataforma.
                - idGame            : variable que trae el identificador de un videojuego.
            -- Return:
                - arRetorno         : array asociativo con status y data, en data, todos los datos de la query y, en uno de ellos, el parámetro.
            -- Author:
                - Víctor Ubago Conde
            -- Dates:

                - Creation          : 2022 - Nov
                - Review            :
    */

    function mod002_getPegiAges(){
        $arAttributes = [
            [ "idpegiedad",          "idPegi",           "int"   ],
            [ "titulopegiedad",      "titlePegi"                 ]
        ];

        $strSQL = "SELECT idpegiedad, titulopegiedad
                    FROM PEGIEDADES";

        $arRetorno = mod002_executeQuery( $strSQL, $arAttributes );

        return $arRetorno;
    }

    /* Query que trae el id y el título de las edades recomendadas.
            -- Arguments:

            -- Return:
                - arRetorno
            -- Author:
                - Víctor Ubago Conde
            -- Dates:

                - Creation          : 2022 - Nov
                - Review            :
    */

    function mod002_setNewGame( $titleGame, $description, $relasedate, $idPegi ){
        $link = mod001_conectoBD ();
        $strSQL = "INSERT INTO `VIDEOJUEGOS` ( 
                    `idvideojuego`, 
                    `titulo`, 
                    `descripcion`, 
                    `feclanzamiento`,
                    `idpegiedad`
                )
				VALUES
				( 
                    null, 
                    '$titleGame', 
                    '$description', 
                    '$relasedate',
                    $idPegi
                )";

        if ( $result = $link -> query( $strSQL ) ) {
            if ( $link -> affected_rows > 0 ) {
                $arRetorno[ "status" ][ "codError" ]    = "000"; // Con datos.
                $arRetorno[ "status" ][ "insert_id" ]   = $link -> insert_id;
            } else {
                $arRetorno[ "status" ][ "codError" ]    = "001"; // Sin datos.
            }
        } else if ( $link -> errno ) {
            
            $arRetorno[ "status" ][ "codError" ]        = "002";
            $arRetorno[ "status" ][ "errorno" ]         = $link -> errno;
            $arRetorno[ "status" ][ "errordescriprion" ]= $link -> error;
        }

        mod001_desconectoBD( $link) ;
        
        return $arRetorno;
    }

    /** Insert into que introduce un nuevo nombre, descripción, fecha e idpegi sobre un nuevo videojuego.
            -- Arguments:
                - titleGame         : variable que envía el título de un videojuego.
                - description       : variable que envía la descripción de un videojuego.
                - relasedate        : variable que envía la fecha de un videojuego.
                - idPegi            : variable que envía la edad recomendada de un videojuego.
            -- Return:
                - arRetorno         : array asociativo con status y data, en data, todos los datos de la query y, en uno de ellos, el parámetro.
            -- Author:
                - Víctor Ubago Conde
            -- Dates:

                - Creation          : 2022 - Nov
                - Review            :
    */

    function mod002_getGamesSearch( $itemToSearch ){
        $arAttributes = [
            [ "idvideojuego",          "idGame",             "int"   ],
            [ "titulo",                "nameGame"                    ],
            [ "nomimagenvideo",        "photoGame"                   ]
        ];

        $strSQL = "SELECT VIDEOJUEGOS.idvideojuego, titulo, nomimagenvideo
                    FROM VIDEOJUEGOS
                    INNER JOIN IMAGENESVIDEOS
                    ON VIDEOJUEGOS.idvideojuego = IMAGENESVIDEOS.idvideojuego
                    WHERE titulo LIKE '%$itemToSearch%'
                    LIMIT 5";

        $arRetorno = mod002_executeQuery( $strSQL, $arAttributes );

        return $arRetorno;
    }

    /** Query que trae los datos de los videojuegos que coinciden con la letra o palabra alojada en la variable escrita por el usuario.
            -- Arguments:
                - idPlatform        : variable que trae el identificador de una plataforma.
                - idGame            : variable que trae el identificador de un videojuego.
            -- Return:
                - listDetails       : array asociativo con status y data, en data, los datos correspondientes a la variable escrita por el usuario.
            -- Author:
                - Víctor Ubago Conde
            -- Dates:

                - Creation          : 2022 - Nov
                - Review            :
    */

    function mod002_getPlatformsSearch( $itemToSearch ){
        $arAttributes = [
            [ "idplataforma",          "idPlatform",           "int"   ],
            [ "nomplataforma",         "namePlatform"                  ],
            [ "imgplataforma",         "photoPlatform"                 ]
        ];

        $strSQL = "SELECT idplataforma, nomplataforma, imgplataforma
                    FROM PLATAFORMAS
                    WHERE nomplataforma LIKE '%$itemToSearch%'
                    LIMIT 5";

        $arRetorno = mod002_executeQuery( $strSQL, $arAttributes );

        return $arRetorno;
    }

    /** Query que trae los datos de los plataforma que coinciden con la letra o palabra alojada en la variable escrita por el usuario.
            -- Arguments:
                - idPlatform        : variable que trae el identificador de una plataforma.
                - idGame            : variable que trae el identificador de un videojuego.
            -- Return:
                - listDetails       : array asociativo con status y data, en data, los datos correspondientes a la variable escrita por el usuario.
            -- Author:
                - Víctor Ubago Conde
            -- Dates:

                - Creation          : 2022 - Nov
                - Review            :
    */
?>
