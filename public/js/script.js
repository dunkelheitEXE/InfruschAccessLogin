const acceder = document.getElementById("acceder");
const menu = document.getElementById("menu");
let accederStatus = false;
acceder.addEventListener("click", ()=>{
    if(accederStatus == false) {
        menu.classList.remove("menu");
        menu.classList.add("menu-visible");
        accederStatus = true;
    } else {
        menu.classList.remove("menu-visible");
        menu.classList.add("menu");
        accederStatus = false;
    }
});