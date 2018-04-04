<?php

session_start();
require_once '../models/pessoa.php';
require_once '../models/telefone.php';
require_once '../models/endereco.php';

date_default_timezone_set('America/Bahia');
$pessoa = new Pessoa();
if ((isset($_POST['flg_pessoa_juridica']) && $_POST['flg_pessoa_juridica'] == 0) || (isset($_POST['flg_funcionario']) && $_POST['flg_funcionario'] == 1)) {
    $pessoa->setId_pessoa($_POST['id_pessoa']);
    $pessoa->setNome($_POST['nome']);
    $pessoa->setData_nascimento($_POST['data_nascimento']);
    $pessoa->setSexo($_POST['sexo']);
    $pessoa->setCpf_cnpj(preg_replace("/[^0-9]/", "", $_POST['cpf_cnpj']));
    $pessoa->setEmail($_POST['email']);
    if(isset($_POST['flg_pessoa_juridica'])) {
        $pessoa->setFlg_pessoa_juridica($_POST['flg_pessoa_juridica']);
    }else if ($_POST['flg_funcionario']){
        $pessoa->setFlg_funcionario($_POST['flg_funcionario']);
    }
    if ($_POST['senha'] != "" || $_POST['senha'] != null) {
        $pessoa->setSenha(sha1($_POST['senha']));
    } else {
        $pessoa->setSenha($_POST['senha']);
    }
} else if ($_POST['flg_pessoa_juridica'] == 1) {
    $pessoa->setId_pessoa($_POST['id_pessoa']);
    $pessoa->setNome($_POST['nome']);
    $pessoa->setNome_fantasia($_POST['nome_fantasia']);
    $pessoa->setCpf_cnpj(preg_replace("/[^0-9]/", "", $_POST['cpf_cnpj']));
    $pessoa->setEmail($_POST['email']);
    $pessoa->setInscricao_estadual(preg_replace("/[^0-9]/", "", $_POST['inscricao_estadual']));
    $pessoa->setInscricao_municipal(preg_replace("/[^0-9]/", "", $_POST['inscricao_municipal']));
    $pessoa->setFlg_pessoa_juridica($_POST['flg_pessoa_juridica']);
    if ($_POST['senha'] != "" || $_POST['senha'] != null) {
        $pessoa->setSenha(sha1($_POST['senha']));
    } else {
        $pessoa->setSenha($_POST['senha']);
    }
}
//if (isset($_POST['flg_funcionario']) && $_POST['flg_funcionario'] == 1) {
//    $pessoa->setId_pessoa($_POST['id_pessoa']);
//    $pessoa->setNome($_POST['nome']);
//    $pessoa->setData_nascimento($_POST['data_nascimento']);
//    $pessoa->setSexo($_POST['sexo']);
//    $pessoa->setCpf_cnpj(preg_replace("/[^0-9]/", "", $_POST['cpf_cnpj']));
//    $pessoa->setEmail($_POST['email']);
//    $pessoa->setFlg_funcionario($_POST['flg_funcionario']);
//    if ($_POST['senha'] != "" || $_POST['senha'] != null) {
//        $pessoa->setSenha(sha1($_POST['senha']));
//    } else {
//        $pessoa->setSenha($_POST['senha']);
//    }
//}
if (isset($_FILES['img_user']['name']) && $_FILES['img_user']['error'] == 0) {
    $img_exite = $pessoa->verificar_img_existe_user();
    if (empty($img_exite)) {
        $arquivo = $_FILES['img_user']['tmp_name'];
        $nomeArquivo = $_FILES['img_user']['name'];
        $extensao = strrchr($nomeArquivo, '.');
        $extensao = strtolower($extensao);
        $novoNomeArquivo = md5(microtime()) . $extensao;
        $destino = '../img/' . $novoNomeArquivo;
        $pessoa->setImg_user($novoNomeArquivo);
    } else {
        if (unlink("../img/" . $img_exite)) {
            $arquivo = $_FILES['img_user']['tmp_name'];
            $nomeArquivo = $_FILES['img_user']['name'];
            $extensao = strrchr($nomeArquivo, '.');
            $extensao = strtolower($extensao);
            $novoNomeArquivo = md5(microtime()) . $extensao;
            $destino = '../img/' . $novoNomeArquivo;
            $pessoa->setImg_user($novoNomeArquivo);
        }
    }
}
$telefone = new Telefone();
$telefone->setId_pessoa($_POST['id_pessoa']);
$telefone->setCelular(preg_replace("/[^0-9]/", "", $_POST['celular']));
$telefone->setFixo(preg_replace("/[^0-9]/", "", $_POST['fixo']));
$endereco = new Endereco();
$endereco->setId_pessoa($_POST['id_pessoa']);
$endereco->setEndereco($_POST['endereco']);
$endereco->setBairro($_POST['bairro']);
$endereco->setNumero($_POST['numero']);
$endereco->setCidade_id($_POST['cidade']);
$endereco->setCep(preg_replace("/[^0-9]/", "", $_POST['cep']));
if ($pessoa->editar_pessoa() && $telefone->editar_telefone_pessoa() && $endereco->editar_endereco_pessoa()) {
    if (isset($arquivo)) {
        move_uploaded_file($arquivo, $destino);
    }
    if ($_POST['flg_pessoa_juridica'] == 0) {
        header("Location: ../views/editar_pessoa_fisica.php?id=" . $_POST["id_pessoa"] . "");
    } else {
        header("Location: ../views/editar_pessoa_juridica.php?id=" . $_POST["id_pessoa"] . "");
    }
} else {
    if (isset($_POST['flg_pessoa_juridica']) && $_POST['flg_pessoa_juridica'] == 0) {
        header("Location: ../views/editar_pessoa_fisica.php?id=" . $_POST["id_pessoa"] . "");
    } else if ($_POST['flg_pessoa_juridica'] == 1) {
        header("Location: ../views/editar_pessoa_juridica.php?id=" . $_POST["id_pessoa"] . "");
    }
    if (isset($_POST['flg_funcionario']) && $_POST['flg_funcionario'] == 1) {
        header("Location: ../views/editar_funcionario.php?id=" . $_POST["id_pessoa"] . "");
    }
}    