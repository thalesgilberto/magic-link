<?php
require '../controller/seguranca.php';
require '../models/planos.php';
include 'header.php';
$planos = new Planos();
$dados = $planos->listar_planos(NULL);
?>
<div class="content-header">
    <h1>
        Serviços
        <small>Planos de Internet e mais...</small>
    </h1>
</div>
<br/>
<?php
if (isset($_SESSION["erro"])) {
    ?>
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-ban"></i> Alerta!</h4>
        <?= $_SESSION["erro"] ?>
    </div>
    <?php
    unset($_SESSION["erro"]);
}

if (isset($_SESSION['sucesso'])) {
    ?>
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-check"></i> Concluído!</h4>
        <?= $_SESSION['sucesso'] ?>
    </div>
    <?php
    unset($_SESSION["sucesso"]);
}
?>
<div class="box">  
    <div class="box-header">
        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal_adicionar_servico">Adicionar Serviço</button>
    </div>
    <div class="box-body">
        <div class="table" style="max-width: 100%; height: auto; overflow-x:scroll">  
            <table id="servicos" class="table table-striped table-responsive">  
                <thead>  
                    <tr>  
                        <th style="font-weight: bold">#</th>
                        <th style="font-weight: bold">Descrição do Serviço</th>
                        <th style="font-weight: bold">Valor R$</th>
                        <th></th>
                    </tr>  
                </thead>
                <tbody>
                    <?php
                    foreach ($dados as $item) {
                        ?>
                        <tr>
                            <td>
                                <?= $item[0] ?>
                            </td>
                            <td>
                                <?= $item[1] ?>
                            </td>
                            <td>
                                <?= $item[2] ?>
                            </td>
                            <td>
                                <?php
                                if ($planos->verificar_servico_pessoa_excluir($item[0])) {
                                    ?>
                                <button class="btn btn-sm btn-danger"onclick="excluir_servico(<?=$item[0]?>)" title="Excluir Serviço"><i class="fa fa-trash"></i></button>
                                    <?php
                                }
                                ?>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>

            </table>  
        </div>  
    </div>
</div>  

<div class="modal fade" id="modal_adicionar_servico" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div id="excluir_usuario"  class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="nome_pessoa">Cadastrar novo serviço</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="../controller/cadastrar_servico.php" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="descricao_plano">Descrição do Serviço</label>
                        <input id="descricao_plano" name="descricao_plano" class="form-control" required="" />                        
                    </div>
                    <div class="form-group">
                        <label for="valor_plano">Valor R$</label>
                        <input id="valor_plano" name="valor_plano" class="form-control" required=""/>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>    

<div class="modal fade" id="modal_excluir_servico" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div id="excluir_servico"  class="modal-content">

        </div>
    </div>
</div>

<?php
include 'footer.php';
?>
<script>
    function excluir_servico(id) {
        $.ajax({
            url: 'excluir_servico.php',
            type: 'POST',
            data: {id_plano: id}
        }).done(function (data) {
            $('#excluir_servico').html(data);
        });

        $('#modal_excluir_servico').modal('show');
    }
</script>
<script>
    $(document).ready(function () {
        $('#servicos').DataTable({
            "oLanguage": {
                "sProcessing": "Processando...",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "Nenhum registro correspondente encontrado",
                "sEmptyTable": "Não há dados para serem mostrados",
                "sLoadingRecords": "Carregando...",
                "sInfo": "Mostrando de _START_ a _END_ de _TOTAL_ registros",
                "sInfotEmpty": "Mostrando 0 até 0 de 0 registros",
                "sInfoFiltered": "(filtro aplicado em _MAX_ registros)",
                "sInfoThousands": ".",
                "sSearch": "Pesquisar:",
                "sUrl": "",
                "oPaginate": {
                    "sFirst": "Primeiro",
                    "sPrevious": "Anterior",
                    "sNext": "Próximo",
                    "sLast": "Último"
                }
            }
        });
    });
</script>  