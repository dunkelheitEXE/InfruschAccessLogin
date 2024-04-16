<?php
session_start();
if(!isset($_SESSION['user-id'])) {
    header('Location: index.php');
}

require "controllers/EditarClienteController.php";
$editarConstancia = new EditarClienteController();

include("src/includes/header.php");
if(isset($_POST['submit'])) {
    $ruta="src/database/Docs/".$_FILES['archivo']['name'];
    $mes = $editarConstancia->editarConstancia($_GET['clienteid'], $ruta);
    move_uploaded_file($_FILES['archivo']['tmp_name'], $ruta);
    if($mes != "ERROR") {
        header('Location: DatosCliente.php');
    } else {
        echo $mes;
    }
}
include("src/components/ComEditarConstancia.php");
include("src/includes/footer.php");
?>