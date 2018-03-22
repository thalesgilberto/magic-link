<?php
require '../models/pessoa.php';
$pessoa = new Pessoa();

//Teste

if($pessoa->editar_usuario()){
    
    header("Location: ../views/visualizar.php");

}
else{
    "<h1>Erro ao listar usuários</h1>";
    
 
}