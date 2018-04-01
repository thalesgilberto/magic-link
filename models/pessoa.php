<?php
require_once 'config.php';

class Pessoa {

    private $id_pessoa;
    private $nome;
    private $nome_fantasia;
    private $data_nascimento;
    private $sexo;
    private $cpf_cnpj;
    private $email;
    private $inscricao_estadual;
    private $inscricao_municipal;
    private $flg_pessoa_juridica;
    private $senha;
    private $img_user;
    private $data_cadastro;

############## GETS ###############    

    public function getId_pessoa() {
        return $this->id_pessoa;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getNome_fantasia() {
        return $this->nome_fantasia;
    }

    public function getData_nascimento() {
        return $this->data_nascimento;
    }

    public function getSexo() {
        return $this->sexo;
    }

    public function getCpf_cnpj() {
        return $this->cpf_cnpj;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getInscricao_estadual() {
        return $this->inscricao_estadual;
    }

    public function getInscricao_municipal() {
        return $this->inscricao_municipal;
    }

    public function getFlg_pessoa_juridica() {
        return $this->flg_pessoa_juridica;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function getId_nivel_usuario() {
        return $this->id_nivel_usuario;
    }

    public function getImg_user() {
        return $this->img_user;
    }

    public function getData_cadastro() {
        return $this->data_cadastro;
    }

################## SETS ####################

    public function setId_pessoa($id_pessoa) {
        $this->id_pessoa = $id_pessoa;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setNome_fantasia($nome_fantasia) {
        $this->nome_fantasia = $nome_fantasia;
    }

    public function setData_nascimento($data_nascimento) {
        $this->data_nascimento = $data_nascimento;
    }

    public function setSexo($sexo) {
        $this->sexo = $sexo;
    }

    public function setCpf_cnpj($cpf_cnpj) {
        $this->cpf_cnpj = $cpf_cnpj;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setInscricao_estadual($inscricao_estadual) {
        $this->inscricao_estadual = $inscricao_estadual;
    }

    public function setInscricao_municipal($inscricao_municipal) {
        $this->inscricao_municipal = $inscricao_municipal;
    }

    public function setFlg_pessoa_juridica($flg_pessoa_juridica) {
        $this->flg_pessoa_juridica = $flg_pessoa_juridica;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function setId_nivel_usuario($id_nivel_usuario) {
        $this->id_nivel_usuario = $id_nivel_usuario;
    }

    public function setImg_user($img_user) {
        $this->img_user = $img_user;
    }

    public function setData_cadastro($data_cadastro) {
        $this->data_cadastro = $data_cadastro;
    }

    public function selectList($colunaValor, $colunaTexto, $nomeTabela) {
        $db = new DB();
        $link = $db->DBconnect();

        $query = "SELECT " . $colunaValor . " value ," . $colunaTexto . " text FROM " . $nomeTabela;
        $resultado = mysqli_query($link, $query);

        foreach ($resultado as $opicoes) {
            echo "<option value=" . $opicoes['value'] . ">" . $opicoes['text'] . "</option>";
        }
    }

    //Terminar essa parte kkkkk Socorro!
    public function cpf_cnpj_email_verificarIgual($cpf_cnpj, $email) {
        $db = new DB();
        $link = $db->DBconnect();

        $query = "SELECT cpf_cnpj, email FROM Pessoa WHERE cpf_cnpj='" . $cpf_cnpj . "' OR email='" . $email . "'";
        $resultado = mysqli_query($link, $query);
        $dados = mysqli_fetch_array($resultado);
        if (empty($dados)) {
            return true;
        } else {
            return false;
        }
    }

    public function cpf_cnpj_email_verificarIgual_Editar($cpf_cnpj, $email, $id_pessoa) {
        $db = new DB();
        $link = $db->DBconnect();
        $query = "SELECT cpf_cnpj, email FROM Pessoa WHERE id_pessoa = " . $id_pessoa;
        $resultado = mysqli_query($link, $query);
        $dados = mysqli_fetch_array($resultado);
        if ($dados["cpf_cnpj"] == $cpf_cnpj && $dados["email"] == $email) {
            return true;
        } else {
            $query_cpf_cnpj_email = "SELECT cpf_cnpj, email FROM Pessoa WHERE cpf_cnpj = " . $cpf_cnpj . " OR email = '" . $email . "' ";
            $result = mysqli_query($link, $query_cpf_cnpj_email);
            $dados_verificar = mysqli_fetch_array($result);
            if (empty($dados_verificar)) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function validar_usuario() {
        $db = new DB();
        $link = $db->DBconnect();
        $query = "SELECT id_pessoa, nome, email, img_user FROM Pessoa "
                . "WHERE email='" . $this->email . "' AND senha='" . $this->senha . "' limit 1";
        $resultado = mysqli_query($link, $query);
        $dados = mysqli_fetch_array($resultado);
        if (!empty($dados)) {
            $_SESSION['nome'] = $dados["nome"];
            $_SESSION['id_pessoa'] = $dados["id_pessoa"];
            $_SESSION['email'] = $dados['email'];
            $_SESSION['img_user'] = $dados['img_user'];
            $db->DBclose($link);
            return true;
        } else {
            $db->DBclose($link);
            return false;
        }
    }

    public function cadastrar_pessoa() {
        $db = new DB();
        $pessoa = new Pessoa();
        $link = $db->DBconnect();
        if ($pessoa->cpf_cnpj_email_verificarIgual($this->cpf_cnpj, $this->email)) {
            if ($this->flg_pessoa_juridica == 0) {
                $query = "INSERT INTO Pessoa (nome,data_nascimento,sexo,cpf_cnpj,"
                        . "email,flg_pessoa_juridica,senha,img_user,data_cadastro)"
                        . " VALUES('" . $this->nome . "','" . $this->data_nascimento . "','" . $this->sexo . "','"
                        . $this->cpf_cnpj . "','" . $this->email . "'," . $this->flg_pessoa_juridica . ",'"
                        . $this->senha . "','" . $this->img_user . "','" . $this->data_cadastro . "')";
            } else {
                $query = "INSERT INTO Pessoa (nome,nome_fantasia,cpf_cnpj,inscricao_estadual,inscricao_municipal"
                        . "email,flg_pessoa_juridica,senha,img_user,data_cadastro)"
                        . " VALUES('" . $this->nome . "','" . $this->nome_fantasia . "','" . $this->cpf_cnpj . "','"
                        . $this->inscricao_estadual . "','" . $this->inscricao_municipal . "','" . $this->email . "',"
                        . $this->flg_pessoa_juridica . ",'" . $this->senha . "','" . $this->img_user . "','" . $this->data_cadastro . "')";
            }
            if (mysqli_query($link, $query)) {
                $query_id_pessoa = "SELECT id_pessoa FROM Pessoa WHERE cpf_cnpj ='" . $this->cpf_cnpj . "' limit 1";
                $id_pessoa = mysqli_fetch_array(mysqli_query($link, $query_id_pessoa));
                $_SESSION["id_usuario_cadastrado"] = $id_pessoa["id_pessoa"];
                $db->DBclose($link);
                $_SESSION['sucesso'] = "Dados cadastrados com sucesso!";
                return true;
            } else {
                $db->DBclose($link);
                return false;
            }
        } else {
            $_SESSION['erro'] = "Cpf, Cnpj ou E-mail invalidos pois já estão cadastrados!";
            $db->DBclose($link);
            return false;
        }
    }

    public function editar_pessoa() {
        $db = new DB();
        $pessoa = new Pessoa();
        $link = $db->DBconnect();
        if ($pessoa->cpf_cnpj_email_verificarIgual_Editar($this->cpf_cnpj, $this->email, $this->id_pessoa)) {
            if ($this->flg_pessoa_juridica == 0) {
                if ((empty($this->img_user)) && ($this->senha === "" || $this->senha === null)) {
                    $query = "UPDATE Pessoa SET nome ='" . $this->nome . "', data_nascimento = '" . $this->data_nascimento . "', sexo = '" . $this->sexo . "', "
                            . "cpf_cnpj = '" . $this->cpf_cnpj . "', email = '" . $this->email . "', flg_pessoa_juridica = " . $this->flg_pessoa_juridica . " "
                            . "WHERE id_pessoa = " . $this->id_pessoa;
                } else {
                    if (($this->img_user != null) && ($this->senha === "" || $this->senha === null)) {
                        $query = "UPDATE Pessoa SET nome ='" . $this->nome . "', data_nascimento = '" . $this->data_nascimento . "', sexo = '" . $this->sexo . "', "
                                . "cpf_cnpj = '" . $this->cpf_cnpj . "', email = '" . $this->email . "', flg_pessoa_juridica = " . $this->flg_pessoa_juridica . ", "
                                . "img_user = '" . $this->img_user . "' "
                                . "WHERE id_pessoa = " . $this->id_pessoa;
                    } else {
                        if ((empty($this->img_user)) && ($this->senha != "" || $this->senha != null)) {
                            $query = "UPDATE Pessoa SET nome ='" . $this->nome . "', data_nascimento = '" . $this->data_nascimento . "', sexo = '" . $this->sexo . "', "
                                    . "cpf_cnpj = '" . $this->cpf_cnpj . "', email = '" . $this->email . "', flg_pessoa_juridica = " . $this->flg_pessoa_juridica . ", "
                                    . "senha = '" . $this->senha . "' "
                                    . "WHERE id_pessoa = " . $this->id_pessoa;
                        } else {
                            if (($this->img_user != null) && ($this->senha != "" || $this->senha != null)) {
                                $query = "UPDATE Pessoa SET nome ='" . $this->nome . "', data_nascimento = '" . $this->data_nascimento . "', sexo = '" . $this->sexo . "', "
                                        . "cpf_cnpj = '" . $this->cpf_cnpj . "', email = '" . $this->email . "', flg_pessoa_juridica = " . $this->flg_pessoa_juridica . ", "
                                        . "senha = '" . $this->senha . "', img_user = '" . $this->img_user . "' "
                                        . "WHERE id_pessoa = " . $this->id_pessoa;
                            }
                        }
                    }
                }
            }
            if (mysqli_query($link, $query)) {
                $db->DBclose($link);
                $_SESSION['sucesso'] = "Dados cadastrados com sucesso!";
                return true;
            } else {
                $db->DBclose($link);
                return false;
            }
        } else {
            $_SESSION['erro'] = "Cpf, Cnpj ou E-mail invalidos pois já estão cadastrados!";
            $db->DBclose($link);
            return false;
        }
    }

    public function excluir_usuario() {
        $db = new DB();
        $link = $db->DBconnect();

        //Teste ==>
        $id = $_GET["id_pessoa"];
        $query = "Delete from Pessoa where id_pessoa = $id";

        if (mysqli_query($link, $query)) {
            $db->DBclose($link);
            return true;
        } else {
            $db->DBclose($link);
            return false;
        }
    }

    public function listar_usuario() {
        $db = new DB();
        $link = $db->DBconnect();
        $query = mysqli_query($link, "SELECT P.* FROM magiclink.Pessoa P ORDER BY P.id_pessoa");

        foreach ($query as $row) {
            if ($row["flg_pessoa_juridica"] == 0) {
                $ulr = "../views/editar_pessoa_fisica.php?id=" . $row["id_pessoa"];
            } else {
                $ulr = "../views/cadastro_pessoa_juridica.php?id=" . $row["id_pessoa"];
            }
            echo "<tr> 
                    <td>" . $row["id_pessoa"] . "</td>
                    <td>" . $row["nome"] . "</td>  
                    <td>" . $row["email"] . "</td>  
                    <td>" . @date('d/m/Y', strtotime($row["data_nascimento"])) . "</td>  
                   
                    <td>"
            ?>
            <a class="btn btn-sm btn-default" href="#" title="Detalhes"><i class="fa fa-search-plus"></i></a>
            <a class="btn btn-sm btn-success" href="<?= $ulr ?>" title="Editar"><i class="fa fa-edit"></i></a>
            <?php
            "</td>  
                 </tr>";
        }
    }

    public function mostrar_dados_pessoa($id) {
        $db = new DB();
        $link = $db->DBconnect();
        $query = "SELECT P.*, T.*, E.*, concat(C.nome,' (',ES.uf,')') cidade FROM magiclink.Pessoa P "
                . "INNER JOIN Telefone T ON (P.id_pessoa = T.id_pessoa) INNER JOIN Endereco E ON (P.id_pessoa = E.id_pessoa) "
                . "INNER JOIN Cidade C ON (E.cidade_id = C.id_cidade) INNER JOIN Estado ES ON (C.id_estado = ES.id_estado) "
                . "WHERE P.id_pessoa = " . $id;
        $resultado = mysqli_query($link, $query);
        $dados = mysqli_fetch_array($resultado);
        return $dados;
    }

    public function verificar_img_existe_user() {
        $db = new DB();
        $link = $db->DBconnect();
        $query = "SELECT img_user FROM Pessoa WHERE id_pessoa = " . $this->id_pessoa;
        $resultado = mysqli_query($link, $query);
        $dados = mysqli_fetch_array($resultado);
        if ($dados["img_user"] == "" || $dados["img_user"] == null) {
            return null;
        } else {
            return $dados["img_user"];
        }
    }

}
