<?php
session_start();
require "config/app.php";
if(!isset($_SESSION['user-id'])) {
    header('Location: index.php');
}

include("src/includes/header.php");
require "controllers/EditarConstanciaController.php";
include("src/includes/components/ComEditarConstancia.php");
include("src/includes/footer.php");
?>