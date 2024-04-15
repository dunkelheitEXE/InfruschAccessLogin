<?php
$clientes = [];
$search = '';
$searchType = $_GET['search_type'] ?? 'nombre';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_GET['search'])) {
    $search = trim($_GET['search']);
    $clientes = $connection->buscarClientes($search, $searchType);
} else {
    $clientes = $connection->buscarClientes();
}
?>