
<?php
    
    ob_start();
    require '../../controller/seguranca.php';
    require_once '../../models/pessoa.php';
    setlocale(LC_TIME, 'Pt_BR', 'Pt_BR.utf-8', 'Pt_BR.utf-8', 'Portuguese');
?>  
   
   <style>
      table, td, th {    
        border: 1px solid #ddd;
        text-align: left;
      }
      tr:nth-child(even){
        background-color: #f2f2f2;
      }
      table {
        border-collapse: collapse;
        width: 100%;
      }

      th, td {
        padding: 5px;
      }
   </style>
   
   <table>
    <thead>
        <tr>
            <th>Nome</th>
            <th>CPF/CNPJ</th>
            <th>Plano</th>
            <th>Data de Pagamento</th>
            
            
        </tr>
    </thead>
    <tbody>
            
            <?php 
            $db = new DB();
        $link = $db->DBconnect();
                                                                               
        
        $query = mysqli_query($link, "SELECT DISTINCT Planos_pessoa.id_pessoa, Pessoa.cpf_cnpj, Planos_pessoa.data_pagamento, Planos_pessoa.flg_pagamento, Pessoa.nome, Planos.descricao_plano FROM ((magiclink.Planos_pessoa INNER JOIN Pessoa ON Planos_pessoa.id_pessoa = Pessoa.id_pessoa) INNER JOIN Planos ON Planos_pessoa.id_plano = Planos.id_plano) WHERE flg_pagamento = 1 AND data_pagamento < date(now()) GROUP BY Pessoa.id_pessoa");  
        while($row = mysqli_fetch_assoc($query)){
            echo  "<tr><td>".$row['nome']; "</td></tr>";
            echo  "<td>".$row['cpf_cnpj']; "</td>";
            echo  "<td>".$row['descricao_plano']; "</td>";
            echo  "<td>".@date('d/m/Y', strtotime($row['data_pagamento'])); "</td>";
            
        }    
            
            ?>
	
	</tbody>
        </table>

       
<?php
    
use Dompdf\Dompdf;

    $html = ob_get_contents();
    $mes = strftime("%B");
    
    include_once "../../pdf/autoload.inc.php";
   
    $dompdf = new DOMPDF();
    
    
    // Carrega seu HTML
    $dompdf->load_html('<div><div style="float:left"><img src="../img/logo_magic.png" style="width: 20%;"></div>
		<h2 style="text-align: center;">Relatório de Pagamentos Realizados</h2><br>
                <h3 style="text-align: center;">'.ucfirst($mes).'</h3></div><br>
                '.$html);
    $dompdf->set_base_path("../");
    $dompdf->set_paper("A4");
    $dompdf->set_paper("A4");
    $pdf = $dompdf->render();
    $canvas = $dompdf->get_canvas(); 
    setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');

    $canvas->page_text(510, 792, "Pág. {PAGE_NUM}/{PAGE_COUNT}", "helvetica", 12, array(0,0,0)); //header
    $canvas->page_text(170, 820, "Este relatório foi gerado no dia ". $data = strftime("%d/%m/%Y ás %T"), "helvetica", 12, array(0,0,0));//footer
    $canvas->page_text(30, 792, "Usuário: ".$_SESSION["nome"], "helvetica", 12, array(0,0,0));//footer
    
    
    
    header("Content-type: application/pdf");    
    
    echo $dompdf->output();//Mostra na tela
    
    //$dompdf->stream("relatorio-pf.pdf"); //realiza o download
    
  

?>