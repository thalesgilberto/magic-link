<?php

session_start();
require '../models/pessoa.php';
require '../models/telefone.php';
require '../models/endereco.php';

date_default_timezone_set('America/Bahia');

$pessoa = new Pessoa();
$pessoa->setNome($_POST['nome']);
$pessoa->setData_nascimento($_POST['data_nascimento']);
$pessoa->setSexo($_POST['sexo']);
$pessoa->setCpf_cnpj(preg_replace("/[^0-9]/", "", $_POST['cpf_cnpj']));
$pessoa->setEmail($_POST['email']);
$pessoa->setSenha(sha1($_POST['senha']));
$pessoa->setId_nivel_usuario($_POST['id_nivel_usuario']);
$pessoa->setFlg_pessoa_juridica($_POST['flg_pessoa_juridica']);
$pessoa->setData_cadastro(date("Y/m/d H:i:s"));
if (isset($_FILES['img_user']['name']) && $_FILES['img_user']['error'] == 0) {
    $arquivo = $_FILES['img_user']['tmp_name'];
    $nomeArquivo = $_FILES['img_user']['name'];
    $extensao = strrchr($nomeArquivo, '.');
    $extensao = strtolower($extensao);
    $novoNomeArquivo = md5(microtime()) . $extensao;
    $destino = '../img/' . $novoNomeArquivo;
    $pessoa->setImg_user($novoNomeArquivo);
}

if($_POST['celular']!= null || $_POST['fixo']!= null){
    $telefone = new Telefone();
    $telefone->setId_pessoa($_POST['cpf_cnpj']);
    $telefone->setCelular($_POST['celular']);
    $telefone->setFixo($_POST['fixo']);
}

if ($pessoa->cadastrar_pessoa()) {
    move_uploaded_file($arquivo, $destino);
    if ($_POST['flg_pessoa_juridica'] == 0) {
        header("Location: ../views/cadastro_pessoa_fisica.php");
    }
} else {
    header("Location: ../views/cadastro_pessoa_fisica.php");
}