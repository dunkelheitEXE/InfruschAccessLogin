<?php
$results = $connection->getClienteData($_GET['clienteid']);
if(isset($_POST['submit'])) {
    $message = $connection->deleteCliente($_GET['clienteid']);
    echo $message;
}
?>