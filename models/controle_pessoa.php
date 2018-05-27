<?php

require_once 'config.php';

class Controle_pessoa {

    private $id_pessoa;
    private $id_controle;
    private $id_pessoa_registro;
    private $data_registro;

    public function getId_pessoa() {
        return $this->id_pessoa;
    }

    public function getId_controle() {
        return $this->id_controle;
    }

    public function getId_pessoa_registro() {
        return $this->id_pessoa_registro;
    }

    public function getData_registro() {
        return $this->data_registro;
    }

    public function setId_pessoa($id_pessoa) {
        $this->id_pessoa = $id_pessoa;
        return $this;
    }

    public function setId_controle($id_controle) {
        $this->id_controle = $id_controle;
        return $this;
    }

    public function setId_pessoa_registro($id_pessoa_registro) {
        $this->id_pessoa_registro = $id_pessoa_registro;
        return $this;
    }

    public function setData_registro($data_registro) {
        $this->data_registro = $data_registro;
        return $this;
    }

    public function cadastrar_acesso_pessoa() {
        $db = new DB();
        $link = $db->DBconnect();
        $query_exite_pessoa = "SELECT DISTINCT id_pessoa FROM Controle_pessoa WHERE id_pessoa = " . $this->id_pessoa;
        $resultado = mysqli_query($link, $query_exite_pessoa);
        $dados = mysqli_fetch_array($resultado);
        if (empty($dados)) {
            foreach ($this->id_controle as $item) {
                $query = "INSERT INTO Controle_pessoa (id_pessoa, id_controle, id_pessoa_registro, data_registro) "
                        . "VALUES (" . $this->id_pessoa . "," . $item . "," . $this->id_pessoa_registro . ",'" . $this->data_registro . "')";
                mysqli_query($link, $query);
            }
        } else {
            $query_excluir_acesso = "DELETE FROM Controle_pessoa WHERE id_pessoa =" . $this->id_pessoa . " ";
            if (mysqli_query($link, $query_excluir_acesso)) {
                foreach ($this->id_controle as $item) {
                    $query = "INSERT INTO Controle_pessoa (id_pessoa, id_controle, id_pessoa_registro, data_registro) "
                            . "VALUES (" . $this->id_pessoa . "," . $item . "," . $this->id_pessoa_registro . ",'" . $this->data_registro . "')";
                    mysqli_query($link, $query);
                }
            }
        }
        $db->DBclose($link);
    }

    public function in_array_r($valor, $array, $strict = false) {
        foreach ($array as $item) {
            if (($strict ? $item === $valor : $item == $valor) || (is_array($item) && $this->in_array_r($valor, $item, $strict))) {
                return true;
            }
        }
        return false;
    }

    public function listar_acessos_controle($id_pessoa) {
        $db = new DB();
        $link = $db->DBconnect();
        $query_controle = "SELECT * FROM Controle";
        $resultado = mysqli_query($link, $query_controle);
        $dados = mysqli_fetch_all($resultado);

        $query_acessos = "SELECT id_controle FROM Controle_pessoa WHERE id_pessoa = " . $id_pessoa;
        $resultado_acesso = mysqli_query($link, $query_acessos);
        $dados_acesso = mysqli_fetch_all($resultado_acesso);

        for ($i = 0; $i < count($dados); $i++) {
            if ($this->in_array_r($dados[$i][0], $dados_acesso)) {
                echo "<input checked type=\"checkbox\" id=\"controle\" name=\"controle[]\" value=\"" . $dados[$i][0] . "\" > <span>" . $dados[$i][1] . "</span> <br>";
            } else {
                echo "<input type=\"checkbox\" id=\"controle\" name=\"controle[]\" value=\"" . $dados[$i][0] . "\" > <span>" . $dados[$i][1] . "</span> <br>";
            }
        }
        
        $db->DBclose($link);
    }

}
