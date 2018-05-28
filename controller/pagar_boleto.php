<?php
session_start();
require_once '../models/planos_pessoa.php';
$planos_pessoa = new Planos_pessoa();
$planos_pessoa->setId_plano($_GET["b"]);

if ($planos_pessoa->pagar_boleto()) {
    header("Location: ../views/home.php");
} else {

    header("Location: ../views/home.php");
}

