<?php
session_start();

if(!isset($_SESSION['id_pessoa'], $_SESSION['nome'])){ 
    session_destroy();
    header('Location: ../index.php');
}
