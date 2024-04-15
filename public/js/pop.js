const modal = document.getElementById("modal");
const modalTarget = document.getElementById("modalChild");
const button = document.getElementById("modal-close");

let modalStmt = false;
let a = document.createElement("a");
let text = document.createTextNode("Eliminar");

function openPop(cliente) {
    if(modalStmt == false) {
        modal.classList.remove("modal-container");
        modal.classList.add("modal-container-visible");
        a.href = cliente;
        a.appendChild(text);
        a.classList.add("confirm-btn");
        modalTarget.appendChild(a);
        modalStmt = true;
    } else if(modalStmt == true) {
        modal.classList.remove("modal-container-visible");
        modal.classList.add("modal-container");
        a.classList.remove("confirm-btn");
        modalTarget.removeChild(a);
        modalStmt = false;
    }
}

function backPop() {
    a.classList.remove("confirm-btn");
    modalTarget.removeChild(a);
    modal.classList.remove("modal-container-visible");
    modal.classList.add("modal-container");
    modalStmt = false;
}

button.addEventListener("click", () => {
    backPop();
});
