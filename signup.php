<?php include("src/includes/header.php");?>
<?php
require "config/app.php";

/**
 * 
 * PENDIENTE A ACABAR
 * 
*/


if(isset($_POST['submit'])) {
    $pass = password_hash($_POST['token'], PASSWORD_BCRYPT);
    $message = $connection->insertUser($_POST['username'], $pass);
    echo $message;
}
?>
<form action="" class="form" method="post">
    <input type="text" name="username" class="form-control" placeholder="Usuario">
    <input type="text" name="token" class="form-control" placeholder="Contraseña">
    <input type="submit" name="submit" value="Submit" class="form-btn">
</form>
<?php include("src/includes/footer.php");?>