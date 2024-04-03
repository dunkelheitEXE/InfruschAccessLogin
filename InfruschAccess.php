<?php
include("src/includes/header.php");
require("config/app.php");
//session_start();


/**
 * 
 * PENDIENTE A ACABAR
 * 
*/



if(isset($_POST['submit'])) {
    $id=$connection->getId("infrusch_access", $_POST['user'], $_POST['token']);
    echo $id;
}
?>


<!-- FORMULARIO DE REGISTRO -->
<form action="" method="post" class="form">
    <p class="form-title">Ingresar</p>
    <input type="text" name="user" class="form-control" placeholder="Usuario">
    <input type="text" name="token" class="form-control" placeholder="Token">
    <input type="submit" name="submit" value="submit" class="form-btn">
</form>
<?php include("src/includes/footer.php");?>
