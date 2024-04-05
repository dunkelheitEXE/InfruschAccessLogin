<?php
if(isset($_POST['submit'])) {
    $route="";
    require "controllers/ProcesarArchivos.php";
    $message = $connection->insertCliente($route, $_POST['usuario'], $_POST['direccion'], $_POST['telefono'], $_POST['email']);

    echo $message;
}
?>