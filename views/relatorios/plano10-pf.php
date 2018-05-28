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
            <th>Nome</th>
            <th>CPF/CNPJ</th>
            <th>Data de Pagamento</th>
            
            
        </tr>
    </thead>
    <tbody>
            
            <?php 
            $db = new DB();
        $link = $db->DBconnect();
        
        $query = mysqli_query($link, "SELECT DISTINCT Planos_pessoa.id_pessoa, Pessoa.cpf_cnpj, Planos_pessoa.data_pagamento, Pessoa.nome, Planos.descricao_plano FROM ((magiclink.Planos_pessoa INNER JOIN Pessoa ON Planos_pessoa.id_pessoa = Pessoa.id_pessoa) INNER JOIN Planos ON Planos_pessoa.id_plano = Planos.id_plano) where descricao_plano = '10 MB' AND flg_pessoa_juridica = 0 GROUP BY Planos_pessoa.id_pessoa;");  
        while($row = mysqli_fetch_assoc($query)){
            
                $parte_um = substr($row["cpf_cnpj"], 0, 3);
                $parte_dois = substr($row["cpf_cnpj"], 3, 3);
                $parte_tres = substr($row["cpf_cnpj"], 6, 3);
                $parte_quatro = substr($row["cpf_cnpj"], 9, 2);
                $monta_cpf_cnpj = "$parte_um.$parte_dois.$parte_tres-$parte_quatro";
           
            echo  "<tr><td>".$row['nome']; "</td></tr>";
            echo  "<td>".$monta_cpf_cnpj. "</td>";
            echo  "<td>".@date('d/m/Y', strtotime($row['data_pagamento'])); "</td>";
           
            
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
    $dompdf->load_html('<div><div style="float:right"><img src="../img/logo_magic.png" style="width: 25%; float:right"></div></div>
                <p>Magic Link</p>
                <p>Rua Teste, Cachoeira-BA, 44.300-000</p>
                <p><strong>Tel</strong> - 0000-0000</p><br><br>
		<h1 style="text-align: center;">Relatório de Serviços</h1>
                <h3 style="text-align: center;">Plano 10MB - Pessoa Física</h3></div><br>
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