<?php
session_start();
require '../models/pessoa.php';
$pessoa = new Pessoa();

if($pessoa->excluir_usuario()){
     echo "<script type=\"text/javascript\">
		alert(\"Usuário Deletado com Sucesso.\");
							
	   </script>";
    header("Location: ../views/listar_usuario.php");
}
else{
    echo "<script type=\"text/javascript\">
		alert(\"Falha ao deletar usuário.\");
							
	   </script>";
    header("Location: ../views/listar_usuario.php");
}