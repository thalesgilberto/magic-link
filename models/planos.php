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

}
