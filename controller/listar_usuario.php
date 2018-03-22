<?php
require '../models/pessoa.php';
$pessoa = new Pessoa();

//Teste

if($pessoa->listar_usuario()){
    
    header("Location: ../views/listar.php");

}
else{
    $_SESSION['login-erro'] = "Erro ao listar usuários";
    
 
}