window.addEventListener("load", sliderAuto2Sec );

/* function changeSliderImageNames() {
    let sliderImages = document.querySelectorAll('.slider-image');
    for (let i = 0; i < sliderImages.length; i++) {
        let currentDiv = sliderImages[i];
        let nextDiv = sliderImages[i + 1];
        if (nextDiv) {
        nextDiv.setAttribute('class', 'slider-image' + (i + 1));
        }
    }
} */

/* function showChildren() {
    var node = document.getElementById("slider");
    var nodes = node.childNodes;
    
    for (var i = 0; i < nodes.length; i++) {
        console.log(nodes[i]);
    }
} */

function sliderAuto2Sec(){
    let currentIndex = 0;

    setInterval(() => {
    const children = document.querySelectorAll('.slider-image');
    children[currentIndex].classList.add('hiddenD');
    currentIndex = (currentIndex + 1) % children.length;
    children[currentIndex].classList.remove('hiddenD');
    }, 2000);
}