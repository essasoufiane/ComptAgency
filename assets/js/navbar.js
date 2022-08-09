let burgerMenu = document.getElementById('burger-menu1');
let overlay = document.getElementById('menu1');

burgerMenu.addEventListener('click', function() {
    this.classList.toggle("close");
    overlay.classList.toggle("overlay");
});
