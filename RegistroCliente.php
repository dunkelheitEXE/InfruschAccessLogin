<?php
session_start();
if(!isset($_SESSION['user-id'])) {
    header('Location: index.php');
}

require "controllers/RegistroClientesController.php";
$registroCliente = new RegistroClientesController();

include("src/includes/header.php");
if(isset($_POST['submit'])) {
    $constanciaName = isset($_FILES['archivo']['name']) ? $_FILES['archivo']['name'] : '';
    $constancia = 'src/database/Docs/'.$constanciaName;
    move_uploaded_file($_FILES['archivo']['tmp_name'], $constancia);
    
    $nombre = isset($_POST['usuario']) ? $_POST['usuario'] : '';
    $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : '';
    $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    $message = $registroCliente->registrarCliente($constancia, $nombre, $direccion, $telefono, $email, $password);
    if($message == "ERROR") {
        echo '
            <div class="tg tg-danger">No se ha podidio registrar el cliente. Verifique sus datos</div>
        ';
    } else {
        echo '
            <div class="tg tg-success">'. $message .'</div>
        ';
    }
}
include("src/components/ComRegistroCliente.php");
include("src/includes/footer.php");
?>