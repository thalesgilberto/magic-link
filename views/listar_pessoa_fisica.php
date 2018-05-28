<?php
require '../controller/seguranca.php';
include 'header.php';
?>
<div class="content-header">
    <h1>
        Lista de Clientes
        <small>Pessoa Física</small>
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
                    include '../controller/listar_pessoa_fisica.php';
                    ?>               
            </table>  
        </div>  
    </div>
</div>  
<form action="../controller/excluir_usuario.php" method="POST">
<input type="hidden" id="lista" name="lista" value="listar_pessoa_fisica.php"/>
<div class="modal fade" id="modal_excluir_usuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div id="excluir_usuario"  class="modal-content">

        </div>
    </div>
</div>
</form>    

<?php
include 'footer.php';
?>
<script>  
 $(document).ready(function(){  
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