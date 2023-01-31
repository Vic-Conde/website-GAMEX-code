window.addEventListener("load", load );

function load() {
    let node;
    node = document.querySelector( "input[name='busqueda']" );
    node.addEventListener( "input", beginSearch );
    node.addEventListener( "focus", focusSearch );             
    node.addEventListener( "keydown", beginSearchSynchronous );
    
    // Debería cuando el input está definir el evento focus y escribir codigo.
    // Hover sobre los elementos buscados.
    // Ok. definir el evento keydown y cuando se pulsa el enter lanzar una busqueda sincrona.
    // Ok. Que no busque nada  vacío.
}

function  beginSearchSynchronous( event ) {
    console.log( event );
    if ( event.keyCode === 13 ) {
        $empty = "";
        if( location.href = `search.php?q=${this.value}` ){
            location.href = `search.php?q=${this.value}`;
        } else if ( location.href = `search.php?q=${empty}` ){
            location.href = `search.php`;
        }
    }
}
function focusSearch() {
    console.log( "focus" );
}

function beginSearch () {
    const itemToSearch = this.value;
    console.log( `itemToSearch:${itemToSearch}` );
    if ( itemToSearch !== "" ) {
        const datos = {
            action          : "search",
            itemToSearch    : itemToSearch
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
                let data_html;
                let node;
                console.log( "He recibido :" + dataServer );
                const objDataServer = JSON.parse( dataServer );
                console.log( objDataServer );
                data_html = mod004_setOverlaySearch( objDataServer );
                node = document.querySelector( "input[name='busqueda']" );
                destroyOverlaySearch ();
                node.insertAdjacentHTML( "afterend", data_html );
                
                node = document.querySelector ( ".wrapper" );
                node.addEventListener( "click", destroyOverlaySearch );

            }
        });
    } else {
        node = document.querySelector( "input[name='busqueda']" );
        destroyOverlaySearch ();
        
    }
}

function destroyOverlaySearch () {
    let node = document.querySelector( ".overlaysearch" );
    if ( node !== null ) {
        node.remove();
    }
    
    this.removeEventListener( "click", destroyOverlaySearch );
}