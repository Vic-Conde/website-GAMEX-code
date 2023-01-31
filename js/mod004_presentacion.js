function mod004_setOverlaySearch( objDataServer ) {
    
    overlaySearch = "<div class='overlaysearch'>";
    if ( objDataServer.length !== 0 ) {
        objDataServer.forEach(element => {
            console.log( element );
            if ( typeof element.idGame !== "undefined" ) {
                overlaySearch+= `<a href='gamesSheet.php?idGame=${element.idGame}'>`;
                overlaySearch+=     `<div class='itemseek'>`;
                overlaySearch+=         `<div class='itemimag'>`;
                overlaySearch+=             `<img class='width100' src='${element.photoGame}'/>`;
                overlaySearch+=         `</div>`;
                overlaySearch+=         `<p>${element.nameGame}</p>`;
                overlaySearch+=     `</div>`;
                overlaySearch+= `</a>`;
            } else {
                overlaySearch+= `<a href='platformsSheet.php?idPlatform=${element.idPlatform}'>`;
                overlaySearch+=     `<div class='itemseek'>`;
                overlaySearch+=         `<div class='itemimag'>`;
                overlaySearch+=             `<img class='width100' src='${element.photoPlatform}'/>`;
                overlaySearch+=         `</div>`;
                overlaySearch+=             `<p>${element.namePlatform}</p>`;
                overlaySearch+=     `</div>`;
                overlaySearch+= `</a>`;
            }
        });
    } else {
        overlaySearch+=     `<div class='item'>`;
        overlaySearch+=         `<p>No hay contenido.</p>`;
        overlaySearch+=     `</div>`;
    }
    overlaySearch+= `</div>`;
    
    return overlaySearch;
}