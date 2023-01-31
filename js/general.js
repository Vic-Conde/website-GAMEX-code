window.addEventListener( "load", elementPosition );

/* function elementPosition{
    let node;
    node = document.querySelector(".previousInitial");
    node.addEventListener( "click", function(){
    console.log( "Estás haciendo click, supuestamente, en el previousInitial"})
} */

function elementPosition{
    let node = document.getElementById("#previousInitial");
    node.addEventListener("click", clickOn);
}

function clickOn{
    console.log("Estás haciendo click en previousInitial");
}