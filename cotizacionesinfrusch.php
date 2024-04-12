<?php
session_start();
require 'config/databaseservi.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: InfruschAccess.php');
    exit;
}

$database = new DatabaseServi();
$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cliente = $_POST['cliente'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';
    $fecha = $_POST['fecha'] ?? '';

    if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] === UPLOAD_ERR_OK) {
        $archivoTmpPath = $_FILES['archivo']['tmp_name'];
        $archivoNombre = $_FILES['archivo']['name'];
        $archivoDestino = "uploads/" . $archivoNombre;

        if (move_uploaded_file($archivoTmpPath, $archivoDestino)) {
            $exito = $database->insertarCotizacion($cliente, $descripcion, $archivoDestino, $fecha);

            if ($exito) {
                $_SESSION['mensaje'] = "Cotización guardada y archivo subido correctamente.";
                header('Location: menuinfrusch.php');
                exit;
            } else {
                $mensaje = "Error al guardar la cotización.";
            }
        } else {
            $mensaje = "Error al mover el archivo.";
        }
    } else {
        $mensaje = "Error en la carga del archivo.";
    }
}

include("src/includes/header.php");
?>

<link rel="stylesheet" type="text/css" href="/InfruschAccessLogin/public/css/servipeninf.css">

<div class="container">
    <?php if ($mensaje): ?>
        <p class="error"><?= htmlspecialchars($mensaje); ?></p>
    <?php endif; ?>

    <form method="post" action="cotizaciones.php" enctype="multipart/form-data">
        <div class="form-group">
            <label for="cliente">Cliente:</label>
            <input type="text" id="cliente" name="cliente" required>
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" required></textarea>
        </div>
        <div class="form-group">
            <label for="fecha">Fecha de cotización:</label>
            <input type="date" id="fecha" name="fecha" required>
        </div>
        <div class="form-group">
            <label for="archivo">Archivo de cotización (PDF):</label>
            <input type="file" id="archivo" name="archivo" required>
        </div>
        <div class="form-group">
            <input type="submit" value="Guardar Cotización">
        </div>
    </form>
</div>

<div class="logout-container">
    <a href="logout.php" class="logout-button">Cerrar Sesión</a>
</div>

<?php include("src/includes/footer.php"); ?>
