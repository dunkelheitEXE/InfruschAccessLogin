<?php
session_start();
require "config/app.php";
if(!isset($_SESSION['user-id'])) {
    header('Location: index.php');
}
require "controllers/EliminarClienteController.php";
?>