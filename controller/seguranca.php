<?php
session_start();

if(!isset($_SESSION['id_nivel_usuario'], $_SESSION['nome'])){ 
    session_destroy();
    header('Location: ../index.php');
}
