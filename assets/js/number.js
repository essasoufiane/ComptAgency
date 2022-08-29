"use strict";

const valueDisplays = document.querySelectorAll(".num") // On récupère et sauvegarde les nodes avec la classe ".chiffre" dans une variable, ici appelé "num"
const sectionNumber = document.querySelector(".sectionNumber"); // Sauvegarde la node pour juste en dessous récupéré la position et la sauvegardé

let positionDeLaBalise = sectionNumber.getBoundingClientRect() // "getBoundingClientRect" retourne un Objet remplis d'infos à propos d'une node du DOM (d'un élément**)

let interval = 1500;

let alreadyPLayed = false;

window.addEventListener("scroll", () => {
    // {{ window.scrollY + window.innerHeight }} ici on additione le taux en défilement vertical éffectué ( donné par scrollY ) + la taille en pixel du viewport ( innerHeight ) (car on veut obtenir la valeur en pixel du bas de l'écran)

    if((window.scrollY +  window.innerHeight) > (positionDeLaBalise.y.toFixed()) && !alreadyPLayed) { // ici on déclanche l'animation du chiffre en rentrant uniquement dans le bloc "if" si la position enregistré lors du scroll est supérieure à la position de l'élément qu'on veux animé
        valueDisplays.forEach(valueDisplays => {
            let startValue = 0;
            let endValue = parseInt(valueDisplays.getAttribute("data-val"));
            let duration = Math.floor(interval / endValue);
            let counter = setInterval(function () {
                startValue += 1;
                valueDisplays.textContent = startValue;
                if (startValue == endValue) {
                    clearInterval(counter);
                    alreadyPLayed = true;
                }
            }, duration);
        });
    } 
})