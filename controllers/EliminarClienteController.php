<?php
//$results = $connection->getClienteData($_GET['clienteid']);

$message = $connection->deleteCliente($_GET['clienteid']);
echo $message;
header("Location: DatosCliente.php");
?>