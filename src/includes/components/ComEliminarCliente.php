<form action="" method="post" class="form">
    <div class="form-title">Informacion Del Cliente</div>
    <div class="form-subtitle">Nombre Del Cliente</div>
    <input type="text" class="form-control" value=<?=$results['cliente_nombre']?> disabled>
    <input type="submit" name="submit" class="delete-btn" value="Eliminar">
    <a href="DatosCliente.php" class="back-button">Regresar</a>
</form>