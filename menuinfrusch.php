<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: InfruschAccess.php');
    exit;
}
include("src/includes/header.php");
?>

<link rel="stylesheet" type="text/css" href="/InfruschAccessLogin/public/css/menuinfLog.css">

<div id="menu-container">
    <h1>ACCESO INFRUSCH</h1>
    <div class="menu-item"><a href="datos_cliente.php">DATOS CLIENTE</a></div>
    <div class="menu-row">
        <div class="menu-item"><a href="alta_servicios.php">ALTA DE SERVICIOS</a></div>
        <div class="menu-item"><a href="servicios_pendientes.php">SERVICIOS PENDIENTES</a></div>
    </div>
    <div class="menu-row">
        <div class="menu-item"><a href="solicitud_cotizacion.php">SOLICITUD DE COTIZACION</a></div>
        <div class="menu-item"><a href="cotizaciones.php">COTIZACIONES</a></div>
    </div>
    <div class="menu-item"><a href="agenda.php">AGENDA</a></div>
    <div class="menu-item"><a href="facturacion.php">FACTURACION</a></div>
</div>
<div class="logout-container">
    <a href="logout.php" class="logout-button">Cerrar Sesión</a>
</div>

<?php include("src/includes/footer.php"); ?>