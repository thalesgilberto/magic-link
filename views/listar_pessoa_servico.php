<?php
require '../controller/seguranca.php';
require_once'../models/planos.php';
require_once'../models/pessoa.php';
include 'header.php';

$pessoa = new Pessoa();
$planos = new Planos();
?>
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
<div class="content-header">
    <h1>
        Lista de Clientes
        <small><?= $_GET['pessoa'] == 0 ? 'Pessoa Física' : 'Pessoa Jurídica' ?></small>
    </h1>
</div>
<br/>
<div class="box">  
    <div class="box-header">

    </div>
    <div class="box-body">
        <div class="table" style="max-width: 100%; height: auto; overflow-x:scroll">  
            <table id="employee_data" class="table table-striped table-responsive">  
                <thead>  
                    <tr>  
                        <th style="font-weight: bold">#</th>
                        <th style="font-weight: bold">Nome</th>  
                        <th style="font-weight: bold">Email</th>  
                        <th style="font-weight: bold">CPF</th>  
                        <th></th>  
                    </tr>  
                </thead> 
                <?php
                include '../controller/listar_pessoa_servico.php';
                ?>               
            </table>  
        </div>  
    </div>
</div>  

<div class="modal fade" id="modal_planos_serviços" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="nome_pessoa"></h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../controller/cadastrar_servico_cliente.php" method="POST">
                    <input type="hidden" name="id_pessoa" id="id_pessoa"/>
                    <input type="hidden" name="pessoa" id="pessoa" value="<?= $_GET['pessoa'] ?>"/>
                    <div class="form-group">
                        <label for="id_plano" class="col-form-label">Plano de dados*</label>
                        <?php
                        $planos->mostrar_planos();
                        ?>
                    </div>
                    <div class="form-group">
                        <label for="tempo_servico">Tempo de serviço*</label>
                        <select class="form-control" name="tempo_servico" id="tempo_servico" required="required">
                            <option value="">Selecione</option>
                            <?php
                            for ($i = 1; $i <= 12; $i++) {
                                ?>
                                <option value="<?= $i ?>"><?= $i ?> <?= $i == 1 ? 'mês' : 'meses' ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="dia_pagamento">Dia de pagamento*</label>
                        <select class="form-control" name="dia_pagamento" id="dia_pagamento" required="required">
                            <option value="">Selecione</option>
                            <?php
                            for ($i = 1; $i <= 30; $i++) {
                                ?>
                                <option value="<?= $i ?>"><?= $i ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modal_listar_boleto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div id="listar_boleto"  class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="nome_pessoa"></h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../controller/cadastrar_servico_cliente.php" method="POST">
                    <input type="hidden" name="id_pessoa" id="id_pessoa"/>
                    <input type="hidden" name="pessoa" id="pessoa" value="<?= $_GET['pessoa'] ?>"/>
                    <div id="listar_boleto" class="form-group">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php
include 'footer.php';
?>
<script>
    function listar_boleto(id) {
        $.ajax({
            url: 'listar_boleto.php',
            type: 'POST',
            data: {id_pessoa: id, pessoa: <?=$_GET['pessoa']?>}
        }).done(function (data) {
            $('#listar_boleto').html(data);
        });
        
        $('#modal_listar_boleto').modal('show');
    }
</script>

<script>
    $('#modal_planos_serviços').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var id_pessoa = button.data('whatever');
        var nome = button.data('whatevernome');
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this);
        modal.find('#id_pessoa').val(id_pessoa);
        modal.find('#nome_pessoa').text(id_pessoa + " - " + nome);
    });
</script>

<script>
    $(document).ready(function () {
        $('#employee_data').DataTable({
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