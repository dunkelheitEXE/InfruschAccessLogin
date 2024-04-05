<form action="" method="post" class="form" enctype="multipart/form-data">
    <p class="form-title">Registro de Nuevo cliente</p>
    <p class="form-subtitle">Constancia:</p>
    <input type="file" name="archivo" class="form-control" accept=".pdf, .docx" required>
    <input type="text" name="usuario" class="form-control" placeholder="usuario" required>
    <input type="text" name="direccion" class="form-control" placeholder="direccion" required>
    <input type="text" name="telefono" class="form-control" placeholder="telefono" required>
    <input type="email" name="email" class="form-control" placeholder="email" required>
    <input type="submit" name="submit" value="Registrar" class="form-btn">
</form>

<style>
    .form-subtitle {
        width: 70%;
        font-size: 15px;
        color: var(--color-blue-dark);
    }
</style>