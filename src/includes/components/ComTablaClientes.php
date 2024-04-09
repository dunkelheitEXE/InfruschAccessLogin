<link rel="stylesheet" href="public/css/TablaClientes.css">
<h2>Listado de Clientes</h2>
<form method="get" action="DatosCliente.php">
    <select name="search_type">
        <option value="cliente_id" <?php echo $searchType === 'cliente_id' ? 'selected' : ''; ?>>ID</option>
        <option value="cliente_nombre" <?php echo $searchType === 'cliente_nombre' ? 'selected' : ''; ?>>Nombre</option>
        <option value="cliente_email" <?php echo $searchType === 'cliente_email' ? 'selected' : ''; ?>>Email</option>
        <option value="cliente_direccion" <?php echo $searchType === 'cliente_direccion' ? 'selected' : ''; ?>>Dirección</option>
        <option value="cliente_telefono" <?php echo $searchType === 'cliente_telefono' ? 'selected' : ''; ?>>Teléfono</option>
    </select>
    <input type="text" name="search" placeholder="Buscar clientes">
    <input type="submit" value="Buscar">
</form>


<a href="home.php" class="back-button">Regresar al Menú</a>

<table>
    <tr>
        <th>ID</th>
        <th>Constancia</th>
        <th>Nombre</th>
        <th>Dirección</th>
        <th>Teléfono</th>
        <th>Email</th>
        <th>Editar</th>
        <th>Eliminar</th>
    </tr>
    <?php foreach($clientes as $cliente):?>
    <tr>
        <th><?= $cliente['cliente_id']?></th>
        <th><a href="<?= $cliente['cliente_constancia']?>" class="src-btn">CONSTANCIA</a></th>
        <th><?= $cliente['cliente_nombre']?></th>
        <th><?= $cliente['cliente_direccion']?></th>
        <th><?= $cliente['cliente_telefono']?></th>
        <th><?= $cliente['cliente_email']?></th>
        <th><a href="EditarCliente.php?clienteid=<?=$cliente['cliente_id']?>" class="edit-btn">Editar</a></th>
        <th><button onclick="openPop('EliminarCliente.php?clienteid=<?=$cliente['cliente_id']?>')" class="delete-btn">Eliminar</button></th>
    </tr>
    <?php endforeach; ?>
</table>

<div class="logout-container">
    <a href="logout.php" class="logout-button">Cerrar Sesión</a>
</div>