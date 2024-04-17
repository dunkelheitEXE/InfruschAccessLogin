<link rel="stylesheet" href="public/css/solicitudCotizacion.css">
<div id="submenu-container">
    <h2>SOLICITUD DE COTIZACION</h2>
    <form id="form-solicitud-cotizacion" method="post">
        <!-- Tus campos de formulario -->
        <div class="form-group">
            <input type="text" id="cliente" name="cliente" placeholder="Asigna cliente" required>
        </div>
        <div class="form-group">
            <textarea id="descripcion" name="descripcion" placeholder="Descripción de los requerimientos del equipo del cliente" required></textarea>
        </div>
        <div class="form-group">
            <input type="submit" value="Enviar Solicitud">
        </div>
    </form>
    <a href="ver_solicitudes.php" class="view-solicitudes-button">Ver Solicitudes</a>
    
    <a href="menuinfrusch.php" class="back-button">Regresar al Menú</a>

</div>

<div class="logout-container">
    <a href="logout.php" class="logout-button">Cerrar Sesión</a>
</div>