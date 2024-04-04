<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: InfruschAccess.php');
    exit;
}
include("src/includes/header.php");
?>

<link rel="stylesheet" type="text/css" href="/InfruschAccessLogin/public/css/solicitud_cotizacioninfrusch.css">

<div id="submenu-container">
    <h2>SOLICITUD DE COTIZACION</h2>
    <form id="form-solicitud-cotizacion" action="procesar_solicitud_cotizacion.php" method="post">
        <div class="form-group">
            <label for="cliente">Asigna cliente:</label>
            <input type="text" id="cliente" name="cliente" required>
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción de los requerimientos del equipo del cliente:</label>
            <textarea id="descripcion" name="descripcion" required></textarea>
        </div>
        <div class="form-group">
            <input type="submit" value="Enviar Solicitud">
        </div>
    </form>
</div>

<div class="logout-container">
    <a href="logout.php" class="logout-button">Cerrar Sesión</a>
</div>

<?php include("src/includes/footer.php"); ?>
