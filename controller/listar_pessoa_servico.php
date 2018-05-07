<?php
if($pessoa->listar_pessoa($_GET['pessoa'],NULL, 1)){    
    header("Location: ../views/listar_pessoa_servico.php");
}
else{
    "<h1>Erro ao listar usuários</h1>";
}