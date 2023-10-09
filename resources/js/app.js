import './bootstrap';
import '../css/app.css'; 

let menuDropDown = document.getElementById("myMenuDropDown");
let openMenuDrop = document.getElementById("openMenu");
let closeMenu = document.getElementById("closeMenu");

openMenuDrop.onclick = openUserMenu;
closeMenu.onclick = closeMenuDrop;

/* Set the width of the side navigation to 250px */
function openUserMenu() {
  menuDropDown.classList.add("active");
}

/* Set the width of the side navigation to 0 */
function closeMenuDrop() {
  menuDropDown.classList.remove("active");
}

