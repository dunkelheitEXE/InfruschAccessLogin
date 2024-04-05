<?php
$clientes = [];
$search = '';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_GET['search'])) {
    $search = $_GET['search'];
    $clientes = $connection->buscarClientes($search);
} else {
    $clientes = $connection->buscarClientes();
}
?>