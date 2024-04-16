<?php
session_start();
//DB AND CONTROLLERS
if(!isset($_SESSION['user-id'])) {
    header('Location: index.php');
}

//COMPONENTS
include('src/includes/header.php');
include('src/components/ComHome.php');
include('src/includes/footer.php');
?>