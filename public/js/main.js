// start loader
window.onload = () => {
    setTimeout( _ => {
        const box = document.querySelector('.loading');
        box.style.display = 'none';
    }, 2000);
}
// end loader
// start cursor
// set the starting position of the cursor outside of the screen
let clientX = 100;
let clientY = 100;
const innerCursor = document.querySelector(".cursor--small");

const initCursor = () => {
// add listener to track the current mouse position
document.addEventListener("mousemove", e => {
    clientX = e.clientX;
    clientY = e.clientY;
});
const render = () => {
    innerCursor.style.transform = `translate(${clientX}px, ${clientY}px)`;
    requestAnimationFrame(render);
};
requestAnimationFrame(render);
};

initCursor();
// end cursor
// start side menu
const menu = document.querySelector('#toggle');  
const menuItems = document.querySelector('#overlay');  
const menuContainer = document.querySelector('.menu-container');  
const menuIcon = document.querySelector('i');  

function toggleMenu(e) {
    menuItems.classList.toggle('open');
    menuContainer.classList.toggle('full-menu');
    menuIcon.classList.toggle('fa-bars');
    menuIcon.classList.add('fa-bars');
    e.preventDefault();
}

menu.addEventListener('click', toggleMenu, false);
// end side menu
// start images
document.querySelector(".one").addEventListener("click", _ => window.location.href = "/gallery.html");
document.querySelector(".two").addEventListener("click", _ => window.location.href = "/gallery.html");
document.querySelector(".three").addEventListener("click", _ => window.location.href = "/gallery.html");
document.querySelector(".four").addEventListener("click", _ => window.location.href = "/gallery.html");
document.querySelector(".five").addEventListener("click", _ => window.location.href = "/gallery.html");
document.querySelector(".six").addEventListener("click", _ => window.location.href = "/gallery.html");
// end images
// start change header background
function changeBg() {
    const header = document.getElementById("header");
    const scroll = window.scrollY;
    if (scroll < 150) {
        header.classList.remove('headerBg');
    } else {
        header.classList.add('headerBg');
    }
}
window.addEventListener("scroll",changeBg);
// end change header background