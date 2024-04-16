<?php
session_start();
if(!isset($_SESSION['user-id'])) {
    header('Location:index.php');
}

require "controllers/EditarClienteController.php";
$editarPass = new EditarClienteController();

include("src/includes/header.php");
if(isset($_POST['submit'])) {
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $message = $editarPass->editarPassword($_GET['clienteid'], $password);
    if($message == "ERROR") {
        echo '<div class="tg tg-danger">Error en la actualizacion, verifique sus credenciales</div>';
    } else {
        header("Location: DatosCliente.php");
    }
}
include("src/components/ComEditarPassword.php");
include("src/includes/footer.php");
?>