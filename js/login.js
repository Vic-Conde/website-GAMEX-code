window.addEventListener( "load", loadLogin );

function loadLogin(){
    let node;
    let nodes;
    node = document.querySelector( ".iniciosesion" );
    node.addEventListener( "click", hiddenSession );
    node = document.querySelector( ".login" );
    node.addEventListener( "click", hiddenLogin );
    nodes = document.querySelectorAll( ".imgplatforms" );

    for (let i = 0; i < nodes.length; i++) {
        nodes[i].addEventListener('mouseover', moveDiv);
    }

}

function hiddenLogin( event ){
    if( event.target === this ){
        node = document.querySelector( ".iniciosesion" );
        node.classList.remove( "hiddenD" );
        node = document.querySelector( ".login" );
        node.classList.add( "hiddenD" );
    }
}

function hiddenSession(){
    node = document.querySelector( ".iniciosesion" );
    node.classList.add( "hiddenD" );
    node = document.querySelector( ".login" );
    node.classList.remove( "hiddenD" );
}

function validateLogin(){
    let isValidate = true;
    email = login.email.value;
    if ( email.length === 0 ){
        isValidate = false;
    }
    password = login.password.value;
    if( password.length < 5 ){
        isValidate = false;
    }

    /* if( email.length === 0 || password.length < 5 ){
        isValidate = false;
    } */ //no podrás avisar al usuario
    return isValidate;
}

/* let imgplatforms = document.querySelector('.imgplatforms');

imgplatforms.addEventListener('mouseover', function(){
  imgplatforms.style.left = '-50px';
}); */

function moveDiv(){
    nodes = document.querySelectorAll( ".imgplatforms" );
    for (i = 0; i < nodes.length; i++) {
        nodes[i].classList.add( ".translate200" );
        console.log("meterme me meto");
    }
}