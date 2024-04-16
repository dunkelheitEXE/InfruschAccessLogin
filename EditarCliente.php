<?php
session_start();
require "config/app.php";
if(!isset($_SESSION['user-id'])) {
    header('Location: index.php');
}

require "controllers/EditarClienteController.php";
$editarClientes = new EditarClienteController();
$results = $editarClientes->obtenerDatosCliente($_GET['clienteid']);

include("src/includes/header.php");
if(isset($_POST['submit'])) {
    $id = $_GET['clienteid'];
    $nombre = isset($_POST['usuario']) ? $_POST['usuario'] : '';
    $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : '';
    $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';

    $message = $editarClientes->editarCliente($nombre, $direccion, $telefono, $email, $id);
    if($message != "ERROR") {
        header('Location: DatosCliente.php');
    } else {
        echo "<div class='tg tg-danger'>Ha sucedido un error, verifique los datos</div>";
    }
}
include("src/components/ComEditarCliente.php");
include("src/includes/footer.php")
?>