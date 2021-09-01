var hamburger = document.querySelector('#hamburger');
var cross = document.querySelector('#closeMenu');
var menuBlock = document.querySelector('.menu');

menuBlock.style.marginLeft = '-250px';

hamburger.addEventListener('click', openMenu);

function openMenu() {
    menuBlock.style.marginLeft = '0';
    hamburger.style.display = 'none';
}

cross.addEventListener('click', closeMenu);

function closeMenu() {
    menuBlock.style.marginLeft = '-250px';
    setTimeout(function() {
        hamburger.style.display = 'block';
    }, 200);
}