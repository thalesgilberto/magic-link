<?php

require_once 'config.php';

class Planos_pessoa {

    private $id_pessoa;
    private $id_plano;
    private $data_pagamento;
    private $flg_pagamento;

    function getId_pessoa() {
        return $this->id_pessoa;
    }

    function getId_plano() {
        return $this->id_plano;
    }

    function getData_pagamento() {
        return $this->data_pagamento;
    }

    function getFlg_pagamento() {
        return $this->flg_pagamento;
    }

    function setId_pessoa($id_pessoa) {
        $this->id_pessoa = $id_pessoa;
    }

    function setId_plano($id_plano) {
        $this->id_plano = $id_plano;
    }

    function setData_pagamento($data_pagamento) {
        $this->data_pagamento = $data_pagamento;
    }

    function setFlg_pagamento($flg_pagamento) {
        $this->flg_pagamento = $flg_pagamento;
    }

    public function cadastrar_plano_pessoa($dia, $tempo_servico) {
        $db = new DB();
        $link = $db->DBconnect();
        
        $num_linhas_antes = "SELECT * FROM Planos_pessoa";
        $num_linhas_antes = mysqli_query($link, $num_linhas_antes);
        $num_linhas_antes = mysqli_num_rows($num_linhas_antes);
        
        $mes = date("m");
        $ano = date("Y");

        $i = 1;
        while ($i <= $tempo_servico) {
            if ($mes == 12) {
                $mes = 0;
                $ano += 1;
            }
            $mes += 1;
            if ($mes < 10) {
                if ($mes == 2 && $dia > 28) {
                    $data_pagamento = $ano . "/" . str_pad($mes, 2, 0, STR_PAD_LEFT) . "/" . 28;
                } else {
                    $data_pagamento = $ano . "/" . str_pad($mes, 2, 0, STR_PAD_LEFT) . "/" . $dia;
                }
            } else {
                $data_pagamento = $ano . "/" . $mes . "/" . $dia . "<br>";
            }

            $query = "INSERT INTO Planos_pessoa (id_pessoa, id_plano, data_pagamento, flg_pagamento) "
                    . "VALUES (" . $this->id_pessoa . ", " . $this->id_plano . ", '" . $data_pagamento . "', " . 0 . ")";
            
            mysqli_query($link, $query);
            
            $i += 1;
        }
        
        $num_linhas_depois = "SELECT * FROM Planos_pessoa";
        $num_linhas_depois = mysqli_query($link, $num_linhas_depois);
        $num_linhas_depois = mysqli_num_rows($num_linhas_depois);
        
        
        
        
        echo $num_linhas_depois - $num_linhas_antes;
        
    }

}
