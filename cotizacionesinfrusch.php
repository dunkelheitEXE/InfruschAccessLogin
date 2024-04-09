<?php
session_start();
require 'config/databaseservi.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: InfruschAccess.php');
    exit;
}

$database = new databaseservi();
$mensaje = '';

// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cliente = $_POST['cliente'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';
    $fecha = $_POST['fecha'] ?? '';

    // Lógica para manejar la subida de archivos y guardado en base de datos
    if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] === UPLOAD_ERR_OK) {
        // Proceso de carga del archivo
        $archivoTmpPath = $_FILES['archivo']['tmp_name'];
        $archivoNombre = $_FILES['archivo']['name'];
        $archivoDestino = "uploads/" . $archivoNombre;
        
        // Intentar insertar cotización en la base de datos
        $exito = $database->insertarCotizacion($cliente, $descripcion, $archivoDestino, $fecha);
        
        if ($exito) {
            $_SESSION['mensaje'] = "Cotización guardada y archivo subido correctamente.";
            header('Location: menuinfrusch.php');
            exit;
        } else {
            $mensaje = "Error al guardar la cotización.";
        }
    } else {
        $mensaje = "Error en la carga del archivo. Código de error: " . $_FILES['archivo']['error'];
    }
}

include("src/includes/header.php");
?>

<link rel="stylesheet" type="text/css" href="/InfruschAccessLogin/public/css/servipeninf.css">

<div class="container">
    <h2>Cotizaciones</h2>

    <?php if ($mensaje): ?>
        <p class="error"><?php echo $mensaje; ?></p>
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
