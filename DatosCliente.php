<?php
session_start();
if(!isset($_SESSION['user-id'])) {
    header('Location: index.php');
}

require "controllers/DatosClienteController.php";
$datosClientes = new DatosClienteController();

include("src/includes/header.php");
$clientes = [];
$search = '';
$searchType = $_GET['search_type'] ?? 'nombre';
if ($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_GET['search'])) {
    $search = trim($_GET['search']);
    $clientes = $datosClientes->buscarClientes($search, $searchType);
} else {
    $clientes = $datosClientes->buscarClientes();
}
include("src/components/ComTablaClientes.php");
include("src/components/ComPopup.php");
include("src/includes/footer.php");
?>