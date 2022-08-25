const menuButton = document.querySelector('.nav-button');
const menu = document.querySelector('.nav-menu');

menuButton.addEventListener('click', (event)=>{
    event.preventDefault();
    menu.classList.toggle('open');
})