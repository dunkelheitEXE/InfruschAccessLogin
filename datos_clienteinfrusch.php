<?php
session_start();
require 'config/databaseclients.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: InfruschAccess.php');
    exit;
}

$database = new DatabaseClients();
$clientes = [];
$search = '';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_GET['search'])) {
    $search = $_GET['search'];
    $clientes = $database->buscarClientes($search);
} else {
    $clientes = $database->buscarClientes();
}

include("src/includes/header.php");
?>

<link rel="stylesheet" type="text/css" href="/InfruschAccessLogin/public/css/clientes.css">

<h2>Listado de Clientes</h2>


<form method="get" action="datos_clienteinfrusch.php">
    <input type="text" name="search" placeholder="Buscar clientes" value="<?php echo htmlspecialchars($search); ?>">
    <input type="submit" value="Buscar">
</form>


<a href="menuinfrusch.php" class="back-button">Regresar al Menú</a>

<table>
    <tr>
        <th>ID</th>
        <th>Constancia</th>
        <th>Nombre</th>
        <th>Dirección</th>
        <th>Teléfono</th>
        <th>Email</th>
    </tr>
    <?php foreach ($clientes as $cliente): ?>
    <tr>
        <td><?php echo htmlspecialchars($cliente['id']); ?></td>
        <td><?php echo htmlspecialchars($cliente['constancia']); ?></td>
        <td><?php echo htmlspecialchars($cliente['nombre']); ?></td>
        <td><?php echo htmlspecialchars($cliente['direccion']); ?></td>
        <td><?php echo htmlspecialchars($cliente['telefono']); ?></td>
        <td><?php echo htmlspecialchars($cliente['email']); ?></td>
    </tr>
    <?php endforeach; ?>
</table>

<div class="logout-container">
    <a href="logout.php" class="logout-button">Cerrar Sesión</a>
</div>

<?php include("src/includes/footer.php"); ?>
