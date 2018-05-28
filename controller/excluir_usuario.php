<?php
session_start();
require '../models/pessoa.php';
$pessoa = new Pessoa();
$pessoa->setId_pessoa($_POST["id_pessoa"]);

if($pessoa->excluir_usuario()){
    header("Location: ../views/".$_POST["lista"]);
}
else{
    header("Location: ../views/".$_POST["lista"]);
}