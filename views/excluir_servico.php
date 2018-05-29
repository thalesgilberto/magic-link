<?php
require '../controller/seguranca.php';
require '../models/planos.php';
$pl = new Planos();
$dados_plano = $pl->listar_planos($_POST['id_plano']);
?>
<div class="modal-header">
    <h3 class="modal-title">Tem certeza que deseja excluir esse serviço?</h3>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form action="../controller/excluir_servico.php" method="POST">
    <div class="modal-body">
        <div class="form-group">
            <label for="descricao_plano">Descrição do serviço</label>
            <input id="descricao_plano" name="descricao_plano" class="form-control" disabled="disabled" value="<?= $dados_plano["descricao_plano"] ?>"/>
            <input type="hidden" name="id_plano" value="<?= $dados_plano["id_plano"] ?>"/>
        </div>
        <div class="form-group">
            <label for="valor_plano">Valor R$</label>
            <input id="valor_plano" name="valor_plano" class="form-control" disabled="disabled" value="<?= $dados_plano["valor_plano"] ?>"/>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-danger">Excluir</button>
        </div>
    </div>
</form>
