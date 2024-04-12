<?php
include("src/includes/header.php");
require("config/app.php");



if(isset($_POST['submit'])) {
    $login_success = $connection->getId("infrusch_access", $_POST['user'], $_POST['token']);
    if (!$login_success) {
        
        echo "Error de inicio de sesión";
    }
}
?>

<!-- FORMULARIO DE REGISTRO -->
<form action="" method="post" class="form">
    <p class="form-title">Ingresar</p>
    <input type="text" name="user" class="form-control" placeholder="Usuario">
    <input type="text" name="token" class="form-cont rol" placeholder="Token">
    <input type="submit" name="submit" value="submit" class="form-btn">
</form>
<?php include("src/includes/footer.php");?>
