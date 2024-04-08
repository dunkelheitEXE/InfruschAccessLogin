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
$searchType = $_GET['search_type'] ?? 'nombre'; 
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['search']) && trim($_GET['search']) !== '') {
    $search = trim($_GET['search']);
    $clientes = $database->buscarClientes($search, $searchType);
} else {
    $clientes = $database->buscarClientes();
}

include("src/includes/header.php");
?>

<link rel="stylesheet" type="text/css" href="/InfruschAccessLogin/public/css/clientes.css">

<h2>Listado de Clientes</h2>

<form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <select name="search_type">
        <option value="id" <?php echo $searchType === 'id' ? 'selected' : ''; ?>>ID</option>
        <option value="nombre" <?php echo $searchType === 'nombre' ? 'selected' : ''; ?>>Nombre</option>
        <option value="email" <?php echo $searchType === 'email' ? 'selected' : ''; ?>>Email</option>
        <option value="direccion" <?php echo $searchType === 'direccion' ? 'selected' : ''; ?>>Dirección</option>
        <option value="telefono" <?php echo $searchType === 'telefono' ? 'selected' : ''; ?>>Teléfono</option>
    </select>
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
