<?php
require '../models/pessoa.php';
$pessoa = new Pessoa();
//Teste
if($pessoa->listar_usuario()){    
    header("Location: ../views/listar.php");
}
else{
    "<h1>Erro ao listar usuários</h1>";
}