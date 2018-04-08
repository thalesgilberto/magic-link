<?php
    
    session_start();
    
    include '../../models/pessoa.php';
    
   
    $html = '<table>';	
	$html .= '<thead >';
	$html .= '<tr>';
	$html .= '<th>ID</th>';
	$html .= '<th>Nome</th>';
	$html .= '<th>Email</th>';
	$html .= '<th>CPF</th>';
        
        //Css da Tabela
	$html .= '<style>table, td, th {    
                        border: 1px solid #ddd;
                        text-align: left;
                    }
                    tr:nth-child(even){background-color: #f2f2f2;}

                    table {
                        border-collapse: collapse;
                        width: 100%;
                    }

                    th, td {
                        padding: 15px;
                    }</style>';
	$html .= '</tr>';
	$html .= '</thead>';
	$html .= '<tbody>';
	
	$db = new DB();
        $link = $db->DBconnect();
        $query = mysqli_query($link, "SELECT P.* FROM magiclink.Pessoa P WHERE flg_pessoa_juridica = 0 ORDER BY P.id_pessoa");

	
	while($row = mysqli_fetch_assoc($query)){
		$html .= '<tr><td>'.$row['id_pessoa'] . "</td>";
		$html .= '<td>'.$row['nome'] . "</td>";
		$html .= '<td>'.$row['email'] . "</td>";
		$html .= '<td>'.$row['cpf_cnpj'] . "</td>";
			
	}
	
	$html .= '</tbody>';
	$html .= '</table';

$arquivo = "ComponenteCurricular.pdf";
//referenciar o DomPDF com namespace
	use Dompdf\Dompdf;

	// include autoloader
	require_once("../../pdf/autoload.inc.php");

	//Criando a Instancia
	$dompdf = new DOMPDF();
	
	// Carrega seu HTML
	$dompdf->load_html('<div><div style="float:left"><img src="../../img/logo_magic.png" style="width: 20%;"/></div>
			<h1 style="text-align: center;">Relatório de Clientes</h1>
                        <h3 style="text-align: center;">Pessoa Física</h3></div><br>
			'. $html .'
		');

	//Renderizar o html
	$dompdf->render();

	//Exibir a página
	$dompdf->stream(
		"relatorio_pf.pdf", 
		array(
			"Attachment" => false //Para realizar o download somente alterar para true
		)
	);
?>