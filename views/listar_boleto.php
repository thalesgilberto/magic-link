<?php
require_once '../models/pessoa.php';
$p = new Pessoa();
$dados = $p->mostrar_dados_pessoa($_POST["id_pessoa"]);
?>
<div class="modal-header">
    <h3 class="modal-title" id="nome_pessoa"><?= $_POST["id_pessoa"]." - ".$dados["nome"]?></h3>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <form action="../controller/cadastrar_servico_cliente.php" method="POST">
        <input type="hidden" name="id_pessoa" id="id_pessoa"/>
        <input type="hidden" name="pessoa" id="pessoa" value="<?= $_POST['pessoa'] ?>"/>
        <div class="form-group">

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
    </form>
</div>
