<?php
require '../models/pessoa.php';
$pessoa = new Pessoa();
if($pessoa->listar_funcionario()){    
    header("Location: ../views/listar_funcionario.php");
}
else{
    "<h1>Erro ao listar usuários</h1>";
}