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

    public function cadastrar_acesso_pessoa($id_pessoa, $id_controle, $id_pessoa_registro, $data_registro){
        
    }
    
    public function  listar_acessos_controle($id_pessoa) {
        $db = new DB();
        $link = $db->DBconnect();
        $query_controle = "SELECT * FROM Controle";
        $resultado = mysqli_query($link, $query_controle);
        $dados = mysqli_fetch_all($resultado);

        $query_acessos = "SELECT id_controle FROM Controle_pessoa WHERE id_pessoa = " . $id_pessoa;
        $resultado_acesso = mysqli_query($link, $query_acessos);
        $dados_acesso = mysqli_fetch_all($resultado_acesso);

        foreach ($dados as $item) {
            if (!empty($dados_acesso)) {
                foreach ($dados_acesso as $item_acesso) {
                    if ($item[0] == $item_acesso[0]) {
                        echo "<input checked type=\"checkbox\" name=\"controle[]\" value=\"" . $item[0] . "\" >  <span>" . $item[1] . "</span> <br>";
                    } else {
                        echo "<input  type=\"checkbox\" id=\"controle\" name=\"controle[]\" value=\"" . $item[0] . "\" >  <span>" . $item[1] . "</span> <br>";
                    }
                }
            } else {
                echo "<input  type=\"checkbox\" name=\"controle[]\" value=\"" . $item[0] . "\" >  <span>" . $item[1] . "</span> <br>";
            }
        }
    }
}
