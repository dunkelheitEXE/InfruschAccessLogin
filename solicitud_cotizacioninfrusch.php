<?php
session_start();
require 'config/databasesolicoti.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: InfruschAccess.php');
    exit;
}

$database = new DatabaseSolicoti();
$mensajeCorreo = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cliente = $_POST['cliente'];
    $descripcion = $_POST['descripcion'];

    if ($database->insertarSolicitud($cliente, $descripcion)) {
        $to = 'correo_destino@example.com';
        $subject = 'Nueva Solicitud de Cotización';
        $message = "Cliente: $cliente\nDescripción: $descripcion";
        $headers = "From: tu_correo@example.com";

        if(mail($to, $subject, $message, $headers)) {
            $mensajeCorreo = 'El correo ha sido enviado correctamente.';
        } else {
            $mensajeCorreo = 'Fallo al intentar enviar el correo.';
        }

        $_SESSION['mensaje'] = 'Solicitud de cotización enviada correctamente. ' . $mensajeCorreo;
        header('Refresh: 5; url=menuinfrusch.php');
        exit;
    } else {
        $_SESSION['mensaje'] = 'Error al enviar la solicitud.';
    }
}

include("src/includes/header.php");
?>
<link rel="stylesheet" type="text/css" href="/InfruschAccessLogin/public/css/solicitud_cotizacioninfrusch.css">

<div id="submenu-container">
    <h2>SOLICITUD DE COTIZACION</h2>
    <?php
    if (isset($_SESSION['mensaje'])) {
        echo '<p class="error">' . htmlspecialchars($_SESSION['mensaje']) . '</p>';
        // Limpia el mensaje después de mostrarlo
        unset($_SESSION['mensaje']);
    }
    ?>
    <form id="form-solicitud-cotizacion" method="post">
        <!-- Tus campos de formulario -->
        <div class="form-group">
            <input type="text" id="cliente" name="cliente" placeholder="Asigna cliente" required>
        </div>
        <div class="form-group">
            <textarea id="descripcion" name="descripcion" placeholder="Descripción de los requerimientos del equipo del cliente" required></textarea>
        </div>
        <div class="form-group">
            <input type="submit" value="Enviar Solicitud">
        </div>
    </form>
    <a href="ver_solicitudes.php" class="view-solicitudes-button">Ver Solicitudes</a>
    <a href="menuinfrusch.php" class="back-button">Regresar al Menú</a>

</div>

<div class="logout-container">
    <a href="logout.php" class="logout-button">Cerrar Sesión</a>
</div>

<?php include("src/includes/footer.php"); ?>
