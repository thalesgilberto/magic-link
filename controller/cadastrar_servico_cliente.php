<?php

session_start();

if ($_POST["dia_pagamento"] < 10) {
    $dia = str_pad($_POST["dia_pagamento"], 2, 0, STR_PAD_LEFT);
} else {
    $dia = $_POST["dia_pagamento"];
}

$mes = date("m");
$ano = date("Y");

$tempo_servico = $_POST["tempo_servico"];

$i = 1;
while ($i <= $tempo_servico) {
    if ($mes == 12) {
        $mes = 0;
        $ano += 1;
    }
    $mes += 1;
    if ($mes < 10) {
        if ($mes == 2 && $dia > 28) {
            echo $ano . "/" . str_pad($mes, 2, 0, STR_PAD_LEFT) . "/" . 28 . "<br>";
        } else {
            echo $ano . "/" . str_pad($mes, 2, 0, STR_PAD_LEFT) . "/" . $dia . "<br>";
        }
    } else {
        echo $ano . "/" . $mes . "/" . $dia . "<br>";
    }
    $i += 1;
}