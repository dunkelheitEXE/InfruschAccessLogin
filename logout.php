<?php
require "app.php";
session_start();
session_unset();
session_destroy();
?>