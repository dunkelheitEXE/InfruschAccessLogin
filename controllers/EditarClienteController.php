<?php
$results = $connection->getClienteData($_GET['clienteid']);
if(isset($_POST['submit'])) {
    $message = $connection->editCliente($_POST['usuario'], $_POST['direccion'], $_POST['telefono'], $_POST['email'], $_GET['clienteid']);
    echo $message;
}
?>