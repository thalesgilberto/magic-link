<?php

session_start();
require_once '../models/config.php';
$db = new DB();
$con = $db->DBconnect();
$query = "SELECT 
case
  when flg_pessoa_juridica = 0 then 'fisica'
  when flg_pessoa_juridica = 1 then 'juridica'
END pessoa,
month(data_cadastro) mes
,count(flg_pessoa_juridica) qtd
FROM magiclink.Pessoa 
WHERE year(data_cadastro) = year(now()) 
and flg_pessoa_juridica in(0,1)
group by mes, pessoa
order by month(data_cadastro)";

$resultado = mysqli_query($con, $query);

function in_array_r($valor, $array, $strict = false) {
    foreach ($array as $item) {
        if (($strict ? $item["mes"] === $valor : $item["mes"] == $valor) || (is_array($item["mes"]) && $this->in_array_r($valor, $item["mes"], $strict))) {
            return true;
        }
    }
    return false;
}

$mesAno = array();
$mesAtual = date('m');
for ($i = 1; $i <= $mesAtual; $i++) {
    $mesAno[$i] = $i;
}

$mesPessoaFisica = array();
foreach ($resultado as $item) {
    if ($item["pessoa"] == "fisica") {
        $mesPessoaFisica [] = $item;
    }
}

$mesPessoaJuridica = array();
foreach ($resultado as $item) {
    if ($item["pessoa"] == "juridica") {
        $mesPessoaJuridica [] = $item;
    }
}

$cont1 = 0;
$qtdPessoaFisica = array();
for ($y = 1; $y <= $mesAtual; $y++) {
    if (in_array_r($y, $mesPessoaFisica)) {
        if ($cont1 != count($mesPessoaFisica)) {
            $qtdPessoaFisica[] = $mesPessoaFisica[$cont1]["qtd"];
            $cont1 += 1;
        }
    } else {
        $qtdPessoaFisica[] = 0;
    }
}

$cont2 = 0;
$qtdPessoaJuridica = array();
for ($z = 1; $z <= $mesAtual; $z++) {
    if (in_array_r($z, $mesPessoaJuridica)) {
        if ($cont2 != count($mesPessoaJuridica)) {
            $qtdPessoaJuridica[] = $mesPessoaJuridica[$cont2]["qtd"];
            $cont2 += 1;
        }
    } else {
        $qtdPessoaJuridica[] = 0;
    }
}

$json = array("pessoaFisica"=>$qtdPessoaFisica, "pessoaJuridica"=>$qtdPessoaJuridica);
        
print json_encode($json);

$db->DBclose($con);

