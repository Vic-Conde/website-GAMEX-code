<?php
    require ("../lib/mod004_presentacion.php");

    $action = $_POST[ "action" ];

    switch ( $action ) {
        case "getDetailPlatforms":
            $idPlatform = $_POST[ "idPlatform" ];
            $idGame = $_POST[ "idGame" ];
            $detailPlatforms  = mod004_getDetailPlatforms( $idPlatform, $idGame );
            
        
            echo $detailPlatforms;
            break;
        case "setNewGame":
            if ( isset( $_POST[ "titleGame" ], $_POST[ "description" ], $_POST[ "releasedate" ], $_POST[ "idPegi" ]  ) ) {
                $arSaveNewGame =  mod003_setNewGame( $_POST[ "titleGame" ], $_POST[ "description" ], $_POST[ "releasedate" ], $_POST[ "idPegi" ] );
                echo json_encode( $arSaveNewGame );
            }
            break;
        case "search":
            if ( isset( $_POST[ "itemToSearch" ], ) ) {

                $arDataSearch =  mod003_search( $_POST[ "itemToSearch" ] );
                echo json_encode( $arDataSearch );
            }
            break;
        default:
            echo "Te has confundido al teclear. El case no coincide con el action.";
    }
?>