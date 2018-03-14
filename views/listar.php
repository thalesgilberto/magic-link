<?php
require '../controller/seguranca.php';
include 'header.php';
include '../models/pessoa.php';

$pessoa = new Pessoa();
?>
 

    
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Table With Full Features</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Nome</th>
                  <th>CPF/CNPJ</th>
                  <th>Email</th>
                  <th>Nível de Usuário</th>
                </tr>
                </thead>
                <tbody>
                    
                    <!-- Teste -->
                    
                    <?php
                      while($rows = mysqli_fetch_array($query)){
                          echo "<tr>";
                          echo "<td>".$rows['id_usuario']."</td>";
                          echo "<td>".$rows['nome']."</td>";
                          echo "<td>".$rows['cpf_cnpj']."</td>";
                          echo "<td>".$rows['email']."</td>";
                          echo "<td>".$rows['usuario']."</td>";
                          echo "<td>".$rows['senha']."</td>";
                          echo "<td>".$rows['id_nivel_usuario']."</td>";
                          echo "<td>Editar - Visualizar - Apagar</td>";

                          echo "</tr>";

                      }
                    ?>  
 
            </tbody>
                </tbody>
                <tfoot>
                <tr>
                  
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  

  <?php
include 'footer.php';