<?php
// -- LLAMAR A LA CONECCION E INICIO DE SESION
// CALLING DB CONNECTION AND SESSION START
session_start();
if(isset($_SESSION['user-id'])) {
    header('Location: home.php');
}


require "controllers/LoginAdminController.php";
$loginAdmin = new LoginAdminController();

include("src/includes/header.php");
if(isset($_POST['submit'])) {
    $user = isset($_POST['usuario']) ? $_POST['usuario'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : ''; 
    $id = $loginAdmin->loginAdmin('infrusch_access', $user, $password);

    if($id == "ERROR") {
        echo '
            <div class="tg tg-danger"> Error, compruebe sus credenciales </div>
        ';
    } else {
        $_SESSION['user-id'] = $id;
        header('Location: home.php');
    }
}
include("src/components/ComFormInfruschAccess.php");
include("src/includes/footer.php");
?>
