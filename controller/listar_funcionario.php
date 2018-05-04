<?php
require '../models/pessoa.php';
$pessoa = new Pessoa();
if($pessoa->listar_pessoa(NULL, 1, 3)){    
    header("Location: ../views/listar_funcionario.php");
}
else{
    "<h1>Erro ao listar usuários</h1>";
}