<?php

require_once 'config.php';

class Telefone {

    private $id_pessoa;
    private $celular;
    private $fixo;

    public function getId_pessoa() {
        return $this->id_pessoa;
    }

    public function getCelular() {
        return $this->celular;
    }

    public function getFixo() {
        return $this->fixo;
    }

    public function setId_pessoa($id_pessoa) {
        $this->id_pessoa = $id_pessoa;
        return $this;
    }

    public function setCelular($celular) {
        $this->celular = $celular;
        return $this;
    }

    public function setFixo($fixo) {
        $this->fixo = $fixo;
        return $this;
    }

    public function cadastrar_telefone_pessoa() {
        $db = new DB();
        $link = $db->DBconnect();

        $query_id_pessoa = "SELECT id_pessoa FROM Pessoa WHERE cpf_cnpj='" . $this->id_pessoa . "'";
        $resultado = mysqli_query($link, $query_id_pessoa);
        $id = mysqli_fetch_array($resultado);

        $query = "INSERT INTO Telefone(id_pessoa, celular, fixo)"
                . "VALUES(" . $id['id_pessoa'] . ",'" . $this->celular . "','" . $this->fixo . "')";

        if (mysqli_query($link, $query)) {
            $db->DBclose($link);
            return true;
        } else {
            $db->DBclose($link);
            return false;
        }
    }

    public function editar_telefone_pessoa() {
        $db = new DB();
        $link = $db->DBconnect();
        $query = "UPDATE Telefone SET celular = '" . $this->celular . "', fixo = '" . $this->fixo . "' "
                . "WHERE id_pessoa = " . $this->id_pessoa;
        if (mysqli_query($link, $query)) {
            $db->DBclose($link);
            return true;
        } else {
            $db->DBclose($link);
            return false;
        }
    }

}
