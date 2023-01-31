window.addEventListener( "load", load );

function validateNewGame(){
    return true;
}

function load(){
    let node;
    node = document.querySelector( ".newVideogameP" );
    node.addEventListener( "click",  newGame);
    
    /* node = document.querySelector( ".newVideogame" );
    node.addEventListener( "click",  newGame); */

    node = document.querySelector( ".overlay" );
    node.addEventListener( "click", hiddenOverlay_click );  
    
    node = document.querySelector( "form[name='newgame'] input[name='grabar']" );
    node.addEventListener( "click", saveNewGame );
}

function newGame(){
    let node = document.querySelector( ".overlay" );
    node.classList.remove( "hiddenD" );
}

function hiddenOverlay_click( event ){
    if ( event.target === this ) {
        initOverlay();
    }
}

function initOverlay () {
    node = document.querySelector( ".overlay" );
    node.classList.add( "hiddenD" );
    newgame.title.value = "";
    newgame.description.value = "";
    newgame.releasedate.value = "";
    newgame.idPegi.value = "";
}

function saveNewGame() {
    
    const datos = {
        action          : "setNewGame",
        titleGame       : newgame.title.value,
        description     : newgame.description.value,
        releasedate     : newgame.releasedate.value,
        idPegi          : newgame.idPegi.value
    }; 
    console.log( datos );
    

    $.ajax ( {
        url: "ajax/controladorAJAX.php",
        type: "POST",
        data: datos,
        error: function() {
            alert ("Se ha producido un error.");
        },
        success: function ( dataServer ) {
            console.log( "He recibido :" + dataServer );
            const objDataServer = JSON.parse( dataServer );
            console.log( objDataServer );
            if ( objDataServer[ "status" ][ "codError" ] === "000" ) {
                let strNewGame, node;

                strNewGame = "<p>";
                strNewGame+= `<a href='playersheet.php?idGame=${objDataServer[ 'status' ][ 'insert_id' ]}'>${newplayer.title.value}</a>`;
                strNewGame+= "</p>";
                node = document.querySelector( ".newgame" );
                node.insertAdjacentHTML( 'beforebegin', strNewGame );

                
                initOverlay();
            } else {

            }

                                   
        }
    }); 
}

function matchPositions() {
    var previousInitial = document.querySelector('#previousInitial');
    var nextLast = document.querySelector('#nextLast');
    var image = document.querySelector('img');
  
    previousInitial.style.top = image.offsetTop + 'px';
    previousInitial.style.left = image.offsetLeft - previousInitial.offsetWidth + 'px';
  
    nextLast.style.top = image.offsetTop + 'px';
    nextLast.style.left = image.offsetLeft + image.offsetWidth + 'px';
}
  