<?php
session_start();
require 'config/databaseservi.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: InfruschAccess.php');
    exit;
}

$database = new databaseservi();
$cotizaciones = $database->obtenerServiciosPendientes();

include("src/includes/header.php");
?>

<link rel="stylesheet" type="text/css" href="/InfruschAccessLogin/public/css/servipeninf.css">

<div class="container">
    <h2>Cotizaciones</h2>
    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Descripción</th>
                <th>Fecha</th>
                <th>Cotización PDF</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cotizaciones as $cotizacion): ?>
            <tr>
                <td><?php echo htmlspecialchars($cotizacion['id']); ?></td>
                <td><?php echo htmlspecialchars($cotizacion['cliente']); ?></td>
                <td><?php echo htmlspecialchars($cotizacion['descripcion']); ?></td>
                <td><?php echo htmlspecialchars($cotizacion['fecha']); ?></td>
                <td>
                    <a href="<?php echo htmlspecialchars($cotizacion['Cotizacion_pdf']); ?>" target="_blank">Ver PDF</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="logout-container">
    <a href="logout.php" class="logout-button">Cerrar Sesión</a>
</div>

<?php include("src/includes/footer.php"); ?>
