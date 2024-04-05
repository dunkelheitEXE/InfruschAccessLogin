<link rel="stylesheet" href="public/css/TablaClientes.css">
<h2>Listado de Clientes</h2>
<form method="get" action="datos_clienteinfrusch.php">
    <input type="text" name="search" placeholder="Buscar clientes" value="Buscar">
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
    </tr>
    <?php foreach($clientes as $cliente):?>
    <tr>
        <th><?= $cliente['cliente_id']?></th>
        <th><a href="<?= $cliente['cliente_constancia']?>">CONSTANCIA</a></th>
        <th><?= $cliente['cliente_nombre']?></th>
        <th><?= $cliente['cliente_direccion']?></th>
        <th><?= $cliente['cliente_telefono']?></th>
        <th><?= $cliente['cliente_email']?></th>
    </tr>
    <?php endforeach; ?>
</table>

<div class="logout-container">
    <a href="logout.php" class="logout-button">Cerrar Sesión</a>
</div>