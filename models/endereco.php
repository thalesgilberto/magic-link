<?php

require_once 'config.php';

class Endereco {

    private $id_pessoa;
    private $endereco;
    private $bairro;
    private $numero;
    private $cidade_id;
    private $cep;

    public function getId_pessoa() {
        return $this->id_pessoa;
    }

    public function getEndereco() {
        return $this->endereco;
    }

    public function getBairro() {
        return $this->bairro;
    }

    public function getNumero() {
        return $this->numero;
    }

    public function getCidade_id() {
        return $this->cidade_id;
    }

    public function getCep() {
        return $this->cep;
    }

    public function setId_pessoa($id_pessoa) {
        $this->id_pessoa = $id_pessoa;
        return $this;
    }

    public function setEndereco($endereco) {
        $this->endereco = $endereco;
        return $this;
    }

    public function setBairro($bairro) {
        $this->bairro = $bairro;
        return $this;
    }

    public function setNumero($numero) {
        $this->numero = $numero;
        return $this;
    }

    public function setCidade_id($cidade_id) {
        $this->cidade_id = $cidade_id;
        return $this;
    }

    public function setCep($cep) {
        $this->cep = $cep;
        return $this;
    }

    public function cadastrar_endereco_pessoa() {
        $db = new DB();
        $link = $db->DBconnect();

        $query_id_pessoa = "SELECT id_pessoa FROM Pessoa WHERE cpf_cnpj='" . $this->id_pessoa . "'";
        $resultado = mysqli_query($link, $query_id_pessoa);
        $id = mysqli_fetch_array($resultado);

        $query = "INSERT INTO Endereco(id_pessoa, endereco, bairro, numero,cidade_id, cep)"
                . "VALUES(" . $id['id_pessoa'] . ",'" . $this->endereco . "','" . $this->bairro . "',"
                . $this->numero . "," . $this->cidade_id . ",'" . $this->cep . "')";

        if (mysqli_query($link, $query)) {
            $db->DBclose($link);
            return true;
        } else {
            $db->DBclose($link);
            return false;
        }
    }

}
