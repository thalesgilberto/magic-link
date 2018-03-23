<?php
require '../controller/seguranca.php';
include 'header.php';
?>
<div class="content-header">
    <h1>
        Lista de Usuários
        <small>Cadastro</small>
    </h1>
</div>
<br/>
<div class="box">  
    <div class="box-header">
        
    </div>
    <div class="box-body">
        <div class="table">  
            <table id="employee_data" class="table table-striped table-responsive">  
                <thead>  
                    <tr>  
                        <td style="font-weight: bold">Nome</td>  
                        <td style="font-weight: bold">Email</td>  
                        <td style="font-weight: bold">Data de Nascimento</td>  
                        <td style="font-weight: bold">Nível de Usuário</td>  
                        <td></td>  
                    </tr>  
                </thead> 
                    <?php
                    include '../controller/listar_usuario.php';
                    ?>               
            </table>  
        </div>  
    </div>
</div>  

<?php
include 'footer.php';
?>
<script>  
 $(document).ready(function(){  
      $('#employee_data').DataTable();  
 });  
 </script>  