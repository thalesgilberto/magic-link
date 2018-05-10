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

    public function dados_boleto($id_servico) {
        $db = new DB();
        $link = $db->DBconnect();
        $query = "SELECT p.nome, p.cpf_cnpj, p.flg_pessoa_juridica,p.nome_fantasia, e.endereco, e.cep, c.nome as cidade, es.nome as estado, pl.*, plp.*  FROM magiclink.Planos_pessoa plp "
                . "INNER JOIN Planos pl ON (plp.id_plano = pl.id_plano) "
                . "INNER JOIN Pessoa p ON (plp.id_pessoa = p.id_pessoa) "
                . "INNER JOIN Endereco e ON (e.id_pessoa = p.id_pessoa) "
                . "INNER JOIN Cidade c ON (c.id_cidade = e.cidade_id) "
                . "INNER JOIN Estado es ON (c.id_estado = es.id_estado) "
                . "WHERE plp.id_servico = " . $id_servico . " order by data_pagamento";
        $resultado = mysqli_query($link, $query);
        $dados = mysqli_fetch_array($resultado);
        $db->DBclose($link);
        return $dados;
    }

    public function listar_boleto_pessoa($id_pessoa) {
        $db = new DB();
        $link = $db->DBconnect();
        $query = "SELECT * FROM magiclink.Planos_pessoa plp "
                . "INNER JOIN Planos p ON (plp.id_plano = p.id_plano) "
                . "WHERE id_pessoa = " . $id_pessoa . " ORDER BY data_pagamento";
        $resultado = mysqli_query($link, $query);
        $dados = mysqli_fetch_all($resultado);
        $db->DBclose($link);
        return $dados;
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
                $data_pagamento = $ano . "/" . $mes . "/" . $dia;
            }

            $query = "INSERT INTO Planos_pessoa (id_pessoa, id_plano, data_pagamento, flg_pagamento) "
                    . "VALUES (" . $this->id_pessoa . ", " . $this->id_plano . ", '" . $data_pagamento . "', " . 0 . ")";

            mysqli_query($link, $query);

            $i += 1;
        }

        $num_linhas_depois = "SELECT * FROM Planos_pessoa";
        $num_linhas_depois = mysqli_query($link, $num_linhas_depois);
        $num_linhas_depois = mysqli_num_rows($num_linhas_depois);

        if (($num_linhas_depois - $num_linhas_antes) == $tempo_servico) {
            $db->DBclose($link);
            $_SESSION['sucesso'] = 'Dados salvos com sucesso!';
        } else {
            $db->DBclose($link);
            $_SESSION['erro'] = 'Erro ao adquirir o plano de dados!';
        }
    }

}
