<?php
session_start();
session_destroy();
header('location:../cad/login_organizador.php');
?>