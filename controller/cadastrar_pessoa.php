<?php

session_start();
require_once '../models/pessoa.php';
require_once '../models/telefone.php';
require_once '../models/endereco.php';

date_default_timezone_set('America/Bahia');
$pessoa = new Pessoa();
if ((isset($_POST['flg_pessoa_juridica']) && $_POST['flg_pessoa_juridica'] == 0) || (isset($_POST['flg_funcionario']) && $_POST['flg_funcionario'] == 1)) {
    $pessoa->setNome($_POST['nome']);
    $pessoa->setData_nascimento($_POST['data_nascimento']);
    $pessoa->setSexo($_POST['sexo']);
    $pessoa->setCpf_cnpj(preg_replace("/[^0-9]/", "", $_POST['cpf_cnpj']));
    $pessoa->setEmail($_POST['email']);
    $pessoa->setSenha(sha1($_POST['senha']));
    if(isset($_POST['flg_pessoa_juridica'])) {
        $pessoa->setFlg_pessoa_juridica($_POST['flg_pessoa_juridica']);
    }else if (isset($_POST['flg_funcionario'])){
        $pessoa->setFlg_funcionario($_POST['flg_funcionario']);
    }
    $pessoa->setData_cadastro(date("Y/m/d H:i:s"));
} else if (isset($_POST['flg_pessoa_juridica']) && $_POST['flg_pessoa_juridica'] == 1) {
    $pessoa->setNome($_POST['nome']);
    $pessoa->setNome_fantasia($_POST['nome_fantasia']);
    $pessoa->setCpf_cnpj(preg_replace("/[^0-9]/", "", $_POST['cpf_cnpj']));
    $pessoa->setEmail($_POST['email']);
    $pessoa->setInscricao_estadual(preg_replace("/[^0-9]/", "", $_POST['inscricao_estadual']));
    $pessoa->setInscricao_municipal(preg_replace("/[^0-9]/", "", $_POST['inscricao_municipal']));
    $pessoa->setSenha(sha1($_POST['senha']));
    $pessoa->setFlg_pessoa_juridica($_POST['flg_pessoa_juridica']);
    $pessoa->setData_cadastro(date("Y/m/d H:i:s"));
}

if (isset($_FILES['img_user']['name']) && $_FILES['img_user']['error'] == 0) {
    $arquivo = $_FILES['img_user']['tmp_name'];
    $nomeArquivo = $_FILES['img_user']['name'];
    $extensao = strrchr($nomeArquivo, '.');
    $extensao = strtolower($extensao);
    $novoNomeArquivo = md5(microtime()) . $extensao;
    $destino = '../img/' . $novoNomeArquivo;
    $pessoa->setImg_user($novoNomeArquivo);
}

$telefone = new Telefone();
$telefone->setCelular(preg_replace("/[^0-9]/", "", $_POST['celular']));
$telefone->setFixo(preg_replace("/[^0-9]/", "", $_POST['fixo']));

$endereco = new Endereco();
$endereco->setEndereco($_POST['endereco']);
$endereco->setBairro($_POST['bairro']);
$endereco->setNumero($_POST['numero']);
$endereco->setCidade_id($_POST['cidade']);
$endereco->setCep(preg_replace("/[^0-9]/", "", $_POST['cep']));

if ($pessoa->cadastrar_pessoa() && $telefone->cadastrar_telefone_pessoa() && $endereco->cadastrar_endereco_pessoa()) {
    if (isset($arquivo)) {
        move_uploaded_file($arquivo, $destino);
    }
    if (isset($_POST['flg_pessoa_juridica']) && $_POST['flg_pessoa_juridica'] == 0) {
        $id_pessoa = $_SESSION["id_usuario_cadastrado"];
        unset($_SESSION["id_usuario_cadastrado"]);
        header("Location: ../views/editar_pessoa_fisica.php?id=" . $id_pessoa);
    } else if (isset($_POST['flg_pessoa_juridica']) && $_POST['flg_pessoa_juridica'] == 1) {
        $id_pessoa = $_SESSION["id_usuario_cadastrado"];
        unset($_SESSION["id_usuario_cadastrado"]);
        header("Location: ../views/editar_pessoa_juridica.php?id=" . $id_pessoa);
    }

    if (isset($_POST['flg_funcionario']) && $_POST['flg_funcionario'] == 1) {
        $id_pessoa = $_SESSION["id_usuario_cadastrado"];
        unset($_SESSION["id_usuario_cadastrado"]);
        header("Location: ../views/editar_funcionario.php?id=" . $id_pessoa);
    }
} else {
    if (isset($_POST['flg_pessoa_juridica']) && $_POST['flg_pessoa_juridica'] == 0) {
        header("Location: ../views/cadastro_pessoa_fisica.php");
    } else if (isset($_POST['flg_pessoa_juridica']) && $_POST['flg_pessoa_juridica'] == 1) {
        header("Location: ../views/cadastro_pessoa_juridica.php");
    }
    if (isset($_POST['flg_funcionario']) && $_POST['flg_funcionario'] == 1) {
        header("Location: ../views/cadastro_funcionario.php");
    }
}