<?php
session_start();
if(!isset($_SESSION['login'])){
    header('location:../cad/login_adm.php');
}
?>