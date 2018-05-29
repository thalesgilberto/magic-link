<?php
session_start();
require '../models/planos.php';
$planos = new Planos();
$planos->setId_plano($_POST["id_plano"]);

if($planos->excluir_servico()){
    header("Location: ../views/listar_servico.php");
}
else{
    header("Location: ../views/listar_servico.php");
}