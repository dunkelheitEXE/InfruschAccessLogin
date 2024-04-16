<form action="" method="post" class="form" enctype="multipart/form-data">
    <p class="form-title">Editar cliente</p>
    <p class="form-subtitle">Constancia:</p>
    <a href="EditarConstancia.php?clienteid=<?= $_GET['clienteid'] ?>" class="form-btn-alt">Editar Constancia</a>
    <input type="text" name="usuario" class="form-control" placeholder="usuario" value="<?= $results['cliente_nombre'] ?>">
    <input type="text" name="direccion" class="form-control" placeholder="direccion" value="<?= $results['cliente_direccion'] ?>">
    <input type="text" name="telefono" class="form-control" placeholder="telefono" value="<?= $results['cliente_telefono'] ?>">
    <input type="email" name="email" class="form-control" placeholder="email" value="<?= $results['cliente_email'] ?>">
    <a href="EditarPassword.php?clienteid=<?= $_GET['clienteid'] ?>" class="form-btn-alt">Editar Contraseña</a>
    <input type="submit" name="submit" value="Registrar" class="form-btn">
</form>