window.addEventListener( "load", loadPlatforms );

function loadPlatforms(){
    let nodeOverlay, nodesPlatforms;
    nodesPlatforms = document.querySelectorAll( ".platformsStyle" );
    nodesPlatforms.forEach(( element ) => {
        console.log( element );
        element.addEventListener( "click", getDetailPlatforms );
    });
    nodeOverlay = document.querySelector( "div.overlay" );
    nodeOverlay.addEventListener( "click", hiddenOverlay ); 
}

function hiddenOverlay( event ){
    if( event.target === this ){
        let nodeEdition;
        this.classList.add( "hiddenD" );
        nodeEdition = document.querySelector( "div.edition" );
        nodeEdition.remove();
    }
}

function getDetailPlatforms(){
    const datos = {
        action      : "getDetailPlatforms",
        idPlatform  : this.getAttribute( "data-idPlatform" ),
        idGame      : this.getAttribute( "data-idGame" )
    };
    
    $.ajax ( {
        url: "ajax/controladorAJAX.php",
        type: "POST",
        data: datos,
        error: function() {
            alert ("Se ha producido un error.");
        },
        success: function ( dataServer ) {
            console.log( "He recibido :" + dataServer );
            let node 
            node = document.querySelector ( ".overlay" );
            node.classList.remove( "hiddenD" );
            node.innerHTML = "";
            node.insertAdjacentHTML( "beforeend", dataServer );
           /*  node = document.querySelector( "div.edition" );
            node.addEventListener( "click", hiddenEdition ); */
        }
    });
}