<?php
require '../controller/seguranca.php';
include 'header.php';
?>

<div class="box">  
    <div class="box-header">
        <h4 class="box-title">Lista de Usuários</h4>  
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
