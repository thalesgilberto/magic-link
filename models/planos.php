<?php
require_once 'config.php';

class Planos {

    private $id_plano;
    private $descricao_plano;
    private $valor_plano;

    public function getId_plano() {
        return $this->id_plano;
    }

    public function getDescricao_plano() {
        return $this->descricao_plano;
    }

    public function getValor_plano() {
        return $this->valor_plano;
    }

    public function setId_plano($id_plano) {
        $this->id_plano = $id_plano;
        return $this;
    }

    public function setDescricao_plano($descricao_plano) {
        $this->descricao_plano = $descricao_plano;
        return $this;
    }

    public function setValor_plano($valor_plano) {
        $this->valor_plano = $valor_plano;
        return $this;
    }

    public function mostrar_planos() {
        $db = new DB();
        $link = $db->DBconnect();
        $query = "SELECT * FROM Planos";
        $resultado = mysqli_query($link, $query);
        $dados = mysqli_fetch_all($resultado);
        ?>
        <select class="form-control" name="id_plano" id="id_plano" required="required"> 
            <option value="">Selecione</option>-->
            <?php
            foreach ($dados as $item) {
                ?>
                <option value="<?= $item[0] ?>"><?= $item[1] . " - R$" . $item[2] ?></option>
                <?php
            }
            ?>
        </select>
        <?php
    }

    public function listar_planos($id_plano) {
        $db = new DB();
        $link = $db->DBconnect();
        if (empty($id_plano)) {
            $query = "SELECT * FROM Planos";
            $resultado = mysqli_query($link, $query);
            $dados = mysqli_fetch_all($resultado);
            $db->DBclose($link);
            return $dados;
        } else {
            $query = "SELECT * FROM Planos WHERE id_plano = $id_plano";
            $resultado = mysqli_query($link, $query);
            $dados = mysqli_fetch_array($resultado);
            $db->DBclose($link);
            return $dados;
        }
        $resultado = mysqli_query($link, $query);
        $dados = mysqli_fetch_all($resultado);
        $db->DBclose($link);
        return $dados;
    }

    public function cadastrar_servico() {
        $db = new DB();
        $link = $db->DBconnect();
        $query = "INSERT INTO Planos (descricao_plano, valor_plano) "
                . "VALUES ('$this->descricao_plano','$this->valor_plano')";

        if (mysqli_query($link, $query)) {
            $_SESSION['sucesso'] = "Dados cadastrados com sucesso!";
            $db->DBclose($link);
            return true;
        } else {
            $_SESSION['erro'] = "Ocorreu um erro inesperado!";
            $db->DBclose($link);
            return false;
        }
    }

    public function excluir_servico() {
        $db = new DB();
        $link = $db->DBconnect();
        $query = "DELETE FROM Planos WHERE id_plano = $this->id_plano";
        if (mysqli_query($link, $query)) {
            $_SESSION['sucesso'] = "Dados excluidos com sucesso!";
            $db->DBclose($link);
            return true;
        } else {
            $_SESSION['erro'] = "Ocorreu um erro inesperado!";
            $db->DBclose($link);
            return false;
        }
    }

    public function verificar_servico_pessoa_excluir($id_plano) {
        $db = new DB();
        $link = $db->DBconnect();
        $query = "SELECT * FROM Planos_pessoa WHERE id_plano = $id_plano";
        $resultado = mysqli_query($link, $query);
        $dados = mysqli_fetch_all($resultado);
        if (empty($dados)) {
            $db->DBclose($link);
            return true;
        } else {
            return false;
        }
    }

}
