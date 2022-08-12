let img__slider = document.getElementsByClassName('img__slider'); //stock les img dans let img__slider

let etape = 0;

let nbr__img = img__slider.length; //stock le nombre d'image dans let nbr__img

let prev = document.querySelector('.left');

let next = document.querySelector('.right');

//retire la class active de toutes les img
function enleverActiveImage() {
    for (let i = 0; i < nbr__img; i++) {
        img__slider[i].classList.remove('active'); 
    }
}

next.addEventListener('click', function() {
    etape++;
    if(etape >= nbr__img) {
        etape = 0;
    }
    enleverActiveImage();
    img__slider[etape].classList.add('active');
})

prev.addEventListener('click', function() {
    etape--;
    if(etape < 0) {
        etape = nbr__img - 1; //renvoie vers la dernière img du slider
    }
    enleverActiveImage();
    img__slider[etape].classList.add('active');
})

setInterval(function() {
    etape++;
    if(etape >= nbr__img) {
        etape = 0;
    }
    enleverActiveImage();
    img__slider[etape].classList.add('active');

}, 1500) //3 sec entre chaque slide