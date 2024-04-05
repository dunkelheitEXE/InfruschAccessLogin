<?php
session_start();
require 'config/databasesolicoti.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: InfruschAccess.php');
    exit;
}

$database = new DatabaseSolicoti();
$solicitudes = [];
$search = '';

// Comprobar si se envió el formulario de búsqueda
if ($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_GET['search'])) {
    $search = $_GET['search'];
    $stmt = $database->connection->prepare("SELECT * FROM infrusch__solicitud_cotizacion WHERE cliente LIKE :search OR descripcion LIKE :search");
    $stmt->execute(['search' => '%' . $search . '%']);
} else {
    $stmt = $database->connection->query("SELECT * FROM infrusch__solicitud_cotizacion");
}

if ($stmt) {
    $solicitudes = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

include("src/includes/header.php");
?>

<!-- Enlace al archivo CSS -->
<link rel="stylesheet" type="text/css" href="/InfruschAccessLogin/public/css/versolisitud.css">

<h2>Solicitudes de Cotización</h2>

<!-- Formulario de búsqueda -->
<form method="get" action="ver_solicitudes.php">
    <input type="text" name="search" placeholder="Buscar por cliente o descripción" value="<?php echo htmlspecialchars($search); ?>">
    <input type="submit" value="Buscar">
</form>


<a href="solicitud_cotizacioninfrusch.php" class="back-button">Regresar a Cotizaciones</a>

<table>
    <tr>
        <th>ID</th>
        <th>Cliente</th>
        <th>Descripción</th>
        <th>Fecha</th>
    </tr>
    <?php foreach ($solicitudes as $solicitud): ?>
    <tr>
        <td><?php echo htmlspecialchars($solicitud['id']); ?></td>
        <td><?php echo htmlspecialchars($solicitud['cliente']); ?></td>
        <td><?php echo htmlspecialchars($solicitud['descripcion']); ?></td>
        <td><?php echo htmlspecialchars($solicitud['fecha']); ?></td>
    </tr>
    <?php endforeach; ?>
</table>

<?php include("src/includes/footer.php"); ?>
