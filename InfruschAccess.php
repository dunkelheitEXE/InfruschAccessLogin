<?php
// -- LLAMAR A LA CONECCION E INICIO DE SESION
// CALLING DB CONNECTION AND SESSION START
session_start();
require "config/app.php";
$message="";
if(isset($_SESSION['user-id'])) {
    header('Location: home.php');
} else {
    require "controllers/LoginSuccessfull.php";
}

// # COMPONENTS
include("src/includes/header.php");
if($message != "") {
    echo "<div class='tg tg-danger'>" . $message . "</div>";
}
include("src/includes/ComFormInfruschAccess.php");

//FOOTER
include("src/includes/footer.php");
?>
