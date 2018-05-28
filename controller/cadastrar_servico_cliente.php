<?php
session_start();
require_once '../models/planos_pessoa.php';

$planos_pessoa = new Planos_pessoa();

if ($_POST["dia_pagamento"] < 10) {
    $dia = str_pad($_POST["dia_pagamento"], 2, 0, STR_PAD_LEFT);
} else {
    $dia = $_POST["dia_pagamento"];
}

$planos_pessoa->setId_pessoa($_POST['id_pessoa']);
$planos_pessoa->setId_plano($_POST['id_plano']);
$tempo_servico = $_POST['tempo_servico'];

$planos_pessoa->cadastrar_plano_pessoa($dia, $tempo_servico);

header("Location: ../views/listar_pessoa_servico.php?pessoa=".$_POST['pessoa']."&funcionario=".$_POST["funcionario"]);