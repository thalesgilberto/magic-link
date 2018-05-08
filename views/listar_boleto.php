<?php
require_once '../models/pessoa.php';
require_once '../models/planos_pessoa.php';
$p = new Pessoa();
$planos_pessoa = new Planos_pessoa();

$dados_boleto = $planos_pessoa->listar_boleto_pessoa($_POST["id_pessoa"]);
$dados = $p->mostrar_dados_pessoa($_POST["id_pessoa"]);
?>
<div class="modal-header">
    <h3 class="modal-title" id="nome_pessoa"><?= $_POST["id_pessoa"] . " - " . $dados["nome"] ?></h3>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <form action="../controller/cadastrar_servico_cliente.php" method="POST">
        <input type="hidden" name="id_pessoa" id="id_pessoa"/>
        <input type="hidden" name="pessoa" id="pessoa" value="<?= $_POST['pessoa'] ?>"/>
        <div class="form-group">
            <div class="table" style="height: 400px; width: auto ; overflow-y: scroll">
                <table id="listar_boleto_tabela" class="table table-striped table-responsive">
                    <thead>
                        <tr>
                            <th>
                                Plano - Valor R$
                            </th>
                            <th>
                                Data de vencimento
                            </th>
                            <th>
                                Status do boleto
                            </th>
                            <th>

                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($dados_boleto as $item) {
                            $data_vencimento_boleto = date_create($item[3]);
                            ?>
                            <tr>
                                <td>
                                    <?= $item[6] . " - R$" . $item[7] ?>
                                </td>
                                <td>
                                    <?= date_format($data_vencimento_boleto, 'd/m/Y') ?>
                                </td>
                                <td>
                                    <?php
                                    if ($item[4] == 0 && date("d/m/Y") <= $data_vencimento_boleto) {
                                        echo 'Não pago';
                                    } else if ($item[4] == 0 && date("d/m/Y") > $data_vencimento_boleto) {
                                        echo 'Vencido';
                                    } else if ($item[4] == 1) {
                                        echo 'Pago';
                                    }
                                    ?> 
                                </td>
                                <td>
                                    <a href="#" target="blank" onclick="sendPost('../boleto/boleto_bradesco.php', {id_servico: <?=$item[0]?>});" class="btn btn-sm btn-default" title="Imprimir boleto"><i class="fa fa-print"></i></a>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>           
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
    </form>
</div>

<script>
        if(!window.sendPost){
            window.sendPost = function(url, obj){
                //Define o formulário
                var myForm = document.createElement("form");
                myForm.action = url;
                myForm.method = "post";
 
	        for(var key in obj) {
		     var input = document.createElement("input");
		     input.type = "text";
		     input.value = obj[key];
		     input.name = key;
		     myForm.appendChild(input);			
	        }
                //Adiciona o form ao corpo do documento
                document.body.appendChild(myForm);
                //Envia o formulário
                myForm.submit();
            };    
        }  
    </script>

<script>
    $(document).ready(function () {
        $('#listar_boleto_tabela').DataTable({
            "bInfo": false,
            "bSort": false,
            "bLengthChange": false,
            "bPaginate": false,
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