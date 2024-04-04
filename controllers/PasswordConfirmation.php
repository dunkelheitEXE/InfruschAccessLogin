<?php
require "src/database/QueryFunctions.php";
$querys = new QueryFunctions;
if(isset($_SESSION['user-id'])) {
    $message="";
    if(isset($_POST['submit'])) {
        $message = $querys->passwordConfirmation($_POST['password'], $_POST['confirmation']);
    }
}
?>