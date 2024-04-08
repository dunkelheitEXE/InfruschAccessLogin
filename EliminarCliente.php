<?php
session_start();
require "config/app.php";
if(!isset($_SESSION['user-id'])) {
    header('Location: index.php');
}

include("src/includes/header.php");
require "controllers/EliminarClienteController.php";
include("src/includes/components/ComEliminarCliente.php");
include("src/includes/footer.php");
?>