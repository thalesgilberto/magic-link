<?php
session_start();
require_once '../models/planos.php';
$planos = new Planos();

$planos->setDescricao_plano($_POST["descricao_plano"]);
$planos->setValor_plano($_POST["valor_plano"]);

if ($planos->cadastrar_servico()) {
    header("Location: ../views/listar_servico.php");
} else {
    header("Location: ../views/listar_servico.php");
}

