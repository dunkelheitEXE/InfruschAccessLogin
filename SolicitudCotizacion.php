<?php
session_start();
if(!isset($_SESSION['user-id'])) {
    header('Location: index.php');
}

include("src/includes/header.php");
include("src/components/ComSolicitudCotizacion.php");
include("src/includes/footer.php");
?>