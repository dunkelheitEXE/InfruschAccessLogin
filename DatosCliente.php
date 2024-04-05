<?php
session_start();
require "config/app.php";

if(!isset($_SESSION['user-id'])) {
    header('Location: index.php');
}

require "controllers/DatosClienteController.php";
include("src/includes/header.php");
include("src/includes/components/ComTablaClientes.php");
include("src/includes/footer.php");
?>