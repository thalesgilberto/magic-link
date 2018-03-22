<?php
require '../controller/seguranca.php';
include 'header.php';
?>

 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
  
<br /><br />  
           <div class="box">  
               <div class="box-header">
                <h3>Lista de Usuários</h3>  
               </div>
               <div class="container-fluid">
               
                   <br />  
                   
                <div class="table-responsive">  
                     <table id="employee_data" class="table table-striped table-bordered">  
                          <thead>  
                               <tr>  
                                    <td>Nome</td>  
                                    <td>Email</td>  
                                    <td>Idade</td>  
                                    <td>Nível de Usuário</td>  
                                    <td>Ações</td>  
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