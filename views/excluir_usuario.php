<?php
require '../controller/seguranca.php';
require_once '../models/pessoa.php';
$p = new Pessoa();
$dados = $p->mostrar_dados_pessoa($_POST["id_pessoa"]);

if ($dados["flg_pessoa_juridica"] == 0) {
    $parte_um = substr($dados["cpf_cnpj"], 0, 3);
    $parte_dois = substr($dados["cpf_cnpj"], 3, 3);
    $parte_tres = substr($dados["cpf_cnpj"], 6, 3);
    $parte_quatro = substr($dados["cpf_cnpj"], 9, 2);
    $monta_cpf_cnpj = "$parte_um.$parte_dois.$parte_tres-$parte_quatro";
} else if ($dados["flg_pessoa_juridica"] == 1) {
    $parte_um = substr($dados["cpf_cnpj"], 0, 2);
    $parte_dois = substr($dados["cpf_cnpj"], 2, 3);
    $parte_tres = substr($dados["cpf_cnpj"], 5, 3);
    $parte_quatro = substr($dados["cpf_cnpj"], 8, 4);
    $parte_cinco = substr($dados["cpf_cnpj"], 12, 2);
    $monta_cpf_cnpj = "$parte_um.$parte_dois.$parte_tres/$parte_quatro-$parte_cinco";
}
?>
<div class="modal-header">
    <h3 class="modal-title" id="nome_pessoa">Tem certeza que deseja excluir esse usuário?</h3>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="form-group">
        <label for="nome">Nome</label>
        <input id="nome" name="nome" class="form-control" disabled="disabled" value="<?= $dados['nome'] ?>"/>
        <input type="hidden" name="id_pessoa" value="<?= $dados["id_pessoa"] ?>"/>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input id="email" name="email" class="form-control" disabled="disabled" value="<?= $dados['email'] ?>"/>
    </div>
    <div class="form-group">
        <label for="cpf_cnpj">CPF/CNPJ</label>
        <input id="cpf_cnpj" name="cpf_cnpj" class="form-control" disabled="disabled" value="<?= $monta_cpf_cnpj ?>"/>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-danger">Excluir</button>
    </div>
</div>
