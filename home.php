<?php
session_start();
//DB AND CONTROLLERS
require "config/app.php";
if(!isset($_SESSION['user-id'])) {
    header('Location: index.php');
}

//COMPONENTS
include('src/includes/header.php');
include('src/includes/components/ComHome.php');
include('src/includes/footer.php');
?>