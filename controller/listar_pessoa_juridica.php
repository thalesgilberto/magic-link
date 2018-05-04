<?php
require '../models/pessoa.php';
$pessoa = new Pessoa();
if($pessoa->listar_pessoa(1, NULL, 2)){    
    header("Location: ../views/listar_pessoa_juridica.php");
}
else{
    "<h1>Erro ao listar usuários</h1>";
}