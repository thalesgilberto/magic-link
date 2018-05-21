<?php
    
    session_start();
    
    include '../../models/pessoa.php';
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
            <th>Cód. Serviço</th>
            <th>Cód. Cliente</th>
            
            
        </tr>
    </thead>
    <tbody>
            
            <?php 
            $db = new DB();
        $link = $db->DBconnect();
        
        $query = mysqli_query($link, "SELECT DISTINCT id_pessoa, id_servico FROM magiclink.Planos_pessoa P WHERE id_plano = 2 GROUP BY P.id_pessoa");  
        while($row = mysqli_fetch_assoc($query)){
            echo  "<tr><td>".$row['id_servico']; "</td></tr>";
            echo  "<td>".$row['id_pessoa']; "</td>";
            
        }    
            
            ?>
	
	</tbody>
        </table>

       
<?php
    
use Dompdf\Dompdf;

    $html = ob_get_contents();
   
    
    include_once "../../pdf/autoload.inc.php";
   
    $dompdf = new DOMPDF();
    
    
    // Carrega seu HTML
    $dompdf->load_html('<div><div style="float:left"><img src="../img/logo_magic.png" style="width: 20%;"></div>
		<h1 style="text-align: center;">Relatório de Serviços</h1>
                <h3 style="text-align: center;">Plano - 5Mb</h3></div><br>
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