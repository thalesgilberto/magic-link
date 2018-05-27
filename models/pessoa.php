<?php
require_once 'config.php';
require_once 'controle_pessoa.php';

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
    private $flg_funcionario;
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

    public function getFlg_funcionario() {
        return $this->$flg_funcionario;
    }

    public function getSenha() {
        return $this->senha;
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

    public function setFlg_funcionario($flg_funcionario) {
        $this->flg_funcionario = $flg_funcionario;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function setImg_user($img_user) {
        $this->img_user = $img_user;
    }

    public function setData_cadastro($data_cadastro) {
        $this->data_cadastro = $data_cadastro;
    }

    public function cpf_cnpj_email_verificarIgual_Cadastrar($cpf_cnpj, $email) {
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

    public function insc_municipal_estadual_verificarIgual_Cadastrar($inscricao_estadual, $inscricao_municipal) {
        $db = new DB();
        $link = $db->DBconnect();
        $query = "SELECT inscricao_estadual, inscricao_municipal FROM Pessoa WHERE inscricao_estadual='" . $inscricao_estadual . "' "
                . "OR inscricao_municipal = '" . $inscricao_municipal . "'";
        $resultado = mysqli_query($link, $query);
        $dados = mysqli_fetch_array($resultado);
        if (empty($dados)) {
            return true;
        } else {
            return false;
        }
    }

    public function insc_municipal_verificarIgual_Editar($inscricao_municipal, $id_pessoa) {
        $db = new DB();
        $link = $db->DBconnect();
        $query = "SELECT inscricao_municipal FROM Pessoa WHERE id_pessoa = " . $id_pessoa;
        $resultado = mysqli_query($link, $query);
        $dados = mysqli_fetch_array($resultado);
        if ($dados["inscricao_municipal"] == $inscricao_municipal) {
            return true;
        } else {
            $query_inscricao_municipal = "SELECT inscricao_municipal FROM Pessoa WHERE inscricao_municipal = '" . $inscricao_municipal . "' ";
            $result = mysqli_query($link, $query_inscricao_municipal);
            $dados_verificar = mysqli_fetch_array($result);
            if (empty($dados_verificar)) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function insc_estadual_verificarIgual_Editar($inscricao_estadual, $id_pessoa) {
        $db = new DB();
        $link = $db->DBconnect();
        $query = "SELECT inscricao_estadual FROM Pessoa WHERE id_pessoa = " . $id_pessoa;
        $resultado = mysqli_query($link, $query);
        $dados = mysqli_fetch_array($resultado);
        if ($dados["inscricao_estadual"] == $inscricao_estadual) {
            return true;
        } else {
            $query_inscricao_estadual = "SELECT inscricao_estadual FROM Pessoa WHERE inscricao_estadual = '" . $inscricao_estadual . "' ";
            $result = mysqli_query($link, $query_inscricao_estadual);
            $dados_verificar = mysqli_fetch_array($result);
            if (empty($dados_verificar)) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function cpf_cnpj_verificarIgual_Editar($cpf_cnpj, $id_pessoa) {
        $db = new DB();
        $link = $db->DBconnect();
        $query = "SELECT cpf_cnpj FROM Pessoa WHERE id_pessoa = " . $id_pessoa;
        $resultado = mysqli_query($link, $query);
        $dados = mysqli_fetch_array($resultado);
        if ($dados["cpf_cnpj"] == $cpf_cnpj) {
            return true;
        } else {
            $query_cpf_cnpj = "SELECT cpf_cnpj FROM Pessoa WHERE cpf_cnpj = '" . $cpf_cnpj . "' ";
            $result = mysqli_query($link, $query_cpf_cnpj);
            $dados_verificar = mysqli_fetch_array($result);
            if (empty($dados_verificar)) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function email_verificarIgual_Editar($email, $id_pessoa) {
        $db = new DB();
        $link = $db->DBconnect();
        $query = "SELECT email FROM Pessoa WHERE id_pessoa = " . $id_pessoa;
        $resultado = mysqli_query($link, $query);
        $dados = mysqli_fetch_array($resultado);
        if ($dados["email"] == $email) {
            return true;
        } else {
            $query_email = "SELECT email FROM Pessoa WHERE email = '" . $email . "' ";
            $result = mysqli_query($link, $query_email);
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
            $query_acessos = "SELECT c.descricao_controle, c.id_controle FROM Controle_pessoa cp "
                    . "INNER JOIN Controle c ON (cp.id_controle = c.id_controle) "
                    . "WHERE cp.id_pessoa =" . $dados["id_pessoa"];

            $resultado_acessos = mysqli_query($link, $query_acessos);
            $dados_acessos = mysqli_fetch_all($resultado_acessos);
            foreach ($dados_acessos as $item) {
                $_SESSION['' . $item[0] . ''] = $item[1];
            }
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
        if ($pessoa->cpf_cnpj_email_verificarIgual_Cadastrar($this->cpf_cnpj, $this->email)) {
            if ($this->flg_pessoa_juridica == '0') {
                $query = "INSERT INTO Pessoa (nome,data_nascimento,sexo,cpf_cnpj,"
                        . "email,flg_pessoa_juridica,senha,img_user,data_cadastro)"
                        . " VALUES('" . $this->nome . "','" . $this->data_nascimento . "','" . $this->sexo . "','"
                        . $this->cpf_cnpj . "','" . $this->email . "'," . $this->flg_pessoa_juridica . ",'"
                        . $this->senha . "','" . $this->img_user . "','" . $this->data_cadastro . "')";
            } else if ($this->flg_pessoa_juridica == 1) {
                if ($pessoa->insc_municipal_estadual_verificarIgual_Cadastrar($this->inscricao_estadual, $this->inscricao_municipal)) {
                    $query = "INSERT INTO Pessoa (nome,nome_fantasia,cpf_cnpj,inscricao_estadual,inscricao_municipal,"
                            . "email,flg_pessoa_juridica,senha,img_user,data_cadastro)"
                            . " VALUES('" . $this->nome . "','" . $this->nome_fantasia . "','" . $this->cpf_cnpj . "','"
                            . $this->inscricao_estadual . "','" . $this->inscricao_municipal . "','" . $this->email . "',"
                            . $this->flg_pessoa_juridica . ",'" . $this->senha . "','" . $this->img_user . "','" . $this->data_cadastro . "')";
                } else {
                    $_SESSION['erro'] = "Inscrição estadual ou Inscrição municipal invalidos pois já estão cadastrados!";
                    $db->DBclose($link);
                    return false;
                }
            } else if ($this->flg_funcionario == 1) {
                $query = "INSERT INTO Pessoa (nome,data_nascimento,sexo,cpf_cnpj,"
                        . "email,flg_funcionario,senha,img_user,data_cadastro)"
                        . " VALUES('" . $this->nome . "','" . $this->data_nascimento . "','" . $this->sexo . "','"
                        . $this->cpf_cnpj . "','" . $this->email . "'," . $this->flg_funcionario . ",'"
                        . $this->senha . "','" . $this->img_user . "','" . $this->data_cadastro . "')";
            }


            if (mysqli_query($link, $query)) {
                $query_id_pessoa = "SELECT id_pessoa FROM Pessoa WHERE cpf_cnpj ='" . $this->cpf_cnpj . "' limit 1";
                $id_pessoa = mysqli_fetch_array(mysqli_query($link, $query_id_pessoa));
                $_SESSION["id_usuario_cadastrado"] = $id_pessoa["id_pessoa"];
                $db->DBclose($link);
                $_SESSION['sucesso'] = "Dados cadastrados com sucesso!";
                return true;
            } else {
                $_SESSION['erro'] = "Ocorreu algum erro!";
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
        //VERIFICA SE EMAIL JÁ ESTÁ CADASTRADO
        if (($pessoa->cpf_cnpj_verificarIgual_Editar($this->cpf_cnpj, $this->id_pessoa)) && ($pessoa->email_verificarIgual_Editar($this->email, $this->id_pessoa))) {
            //UPDATE PESSOA FÍSICA
            if ($this->flg_pessoa_juridica == '0' || $this->flg_funcionario == 1) {
                if ((empty($this->img_user)) && ($this->senha === "" || $this->senha === null)) {
                    $query = "UPDATE Pessoa SET nome ='" . $this->nome . "', data_nascimento = '" . $this->data_nascimento . "', sexo = '" . $this->sexo . "', "
                            . "cpf_cnpj = '" . $this->cpf_cnpj . "', email = '" . $this->email . "' "
                            . "WHERE id_pessoa = " . $this->id_pessoa;
                } else if (($this->img_user != null) && ($this->senha === "" || $this->senha === null)) {
                    $query = "UPDATE Pessoa SET nome ='" . $this->nome . "', data_nascimento = '" . $this->data_nascimento . "', sexo = '" . $this->sexo . "', "
                            . "cpf_cnpj = '" . $this->cpf_cnpj . "', email = '" . $this->email . "', img_user = '" . $this->img_user . "' "
                            . "WHERE id_pessoa = " . $this->id_pessoa;
                } else if ((empty($this->img_user)) && ($this->senha != "" || $this->senha != null)) {
                    $query = "UPDATE Pessoa SET nome ='" . $this->nome . "', data_nascimento = '" . $this->data_nascimento . "', sexo = '" . $this->sexo . "', "
                            . "cpf_cnpj = '" . $this->cpf_cnpj . "', email = '" . $this->email . "', senha = '" . $this->senha . "' "
                            . "WHERE id_pessoa = " . $this->id_pessoa;
                } else if (($this->img_user != null) && ($this->senha != "" || $this->senha != null)) {
                    $query = "UPDATE Pessoa SET nome ='" . $this->nome . "', data_nascimento = '" . $this->data_nascimento . "', sexo = '" . $this->sexo . "', "
                            . "cpf_cnpj = '" . $this->cpf_cnpj . "', email = '" . $this->email . "', senha = '" . $this->senha . "', img_user = '" . $this->img_user . "' "
                            . "WHERE id_pessoa = " . $this->id_pessoa;
                }
                //UPDATE PESSOA JURÍDICA
            } else if ($this->flg_pessoa_juridica == 1) {
                if (($pessoa->insc_estadual_verificarIgual_Editar($this->inscricao_estadual, $this->id_pessoa)) && ($pessoa->insc_municipal_verificarIgual_Editar($this->inscricao_municipal, $this->id_pessoa))) {
                    if ((empty($this->img_user)) && ($this->senha === "" || $this->senha === null)) {
                        $query = "UPDATE Pessoa SET nome ='" . $this->nome . "', nome_fantasia = '" . $this->nome_fantasia . "', "
                                . "cpf_cnpj = '" . $this->cpf_cnpj . "', email = '" . $this->email . "', inscricao_estadual = '" . $this->inscricao_estadual . "', "
                                . "inscricao_municipal = '" . $this->inscricao_municipal . "' "
                                . "WHERE id_pessoa = " . $this->id_pessoa;
                    } else if (($this->img_user != null) && ($this->senha === "" || $this->senha === null)) {
                        $query = "UPDATE Pessoa SET nome ='" . $this->nome . "', nome_fantasia = '" . $this->nome_fantasia . "', "
                                . "cpf_cnpj = '" . $this->cpf_cnpj . "', email = '" . $this->email . "', inscricao_estadual = '" . $this->inscricao_estadual . "', "
                                . "inscricao_municipal = '" . $this->inscricao_municipal . "', img_user = '" . $this->img_user . "' "
                                . "WHERE id_pessoa = " . $this->id_pessoa;
                    } else if ((empty($this->img_user)) && ($this->senha != "" || $this->senha != null)) {
                        $query = "UPDATE Pessoa SET nome ='" . $this->nome . "', nome_fantasia = '" . $this->nome_fantasia . "', "
                                . "cpf_cnpj = '" . $this->cpf_cnpj . "', email = '" . $this->email . "', inscricao_estadual = '" . $this->inscricao_estadual . "', "
                                . "inscricao_municipal = '" . $this->inscricao_municipal . "', senha = '" . $this->senha . "' "
                                . "WHERE id_pessoa = " . $this->id_pessoa;
                    } else if (($this->img_user != null) && ($this->senha != "" || $this->senha != null)) {
                        $query = "UPDATE Pessoa SET nome ='" . $this->nome . "', nome_fantasia = '" . $this->nome_fantasia . "', "
                                . "cpf_cnpj = '" . $this->cpf_cnpj . "', email = '" . $this->email . "', inscricao_estadual = '" . $this->inscricao_estadual . "', "
                                . "inscricao_municipal = '" . $this->inscricao_municipal . "', senha = '" . $this->senha . "', img_user = '" . $this->img_user . "' "
                                . "WHERE id_pessoa = " . $this->id_pessoa;
                    }
                } else {
                    $_SESSION['erro'] = "Inscrição estadual ou Inscrição municipal invalidos pois já estão cadastrados!";
                    $db->DBclose($link);
                    return false;
                }
            }
            //VERIFICA SE O UPDATE VAI DAR CERTO
            if (mysqli_query($link, $query)) {
                $db->DBclose($link);
                $_SESSION['sucesso'] = "Dados cadastrados com sucesso!";
                return true;
            } else {
                $_SESSION['erro'] = "Ocorreu algum erro!";
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

    public function listar_pessoa($flg_pessoa_juridica, $flg_funcionario, $acao_link) {
        $db = new DB();
        $link = $db->DBconnect();

        $query_id_pessoas_planos = "SELECT distinct id_pessoa FROM Planos_pessoa";
        $resultado = mysqli_query($link, $query_id_pessoas_planos);
        $id_pessoa_plano = mysqli_fetch_all($resultado);

        if ($flg_pessoa_juridica == 0 && empty($flg_funcionario)) {
            $query = mysqli_query($link, "SELECT P.* FROM magiclink.Pessoa P WHERE flg_pessoa_juridica = " . $flg_pessoa_juridica . " AND flg_funcionario = 0 " . $flg_funcionario . " ORDER BY P.id_pessoa");
        } else if ($flg_pessoa_juridica == 1 && empty($flg_funcionario)) {
            $query = mysqli_query($link, "SELECT P.* FROM magiclink.Pessoa P WHERE flg_pessoa_juridica = " . $flg_pessoa_juridica . " ORDER BY P.id_pessoa");
        } else if (empty($flg_pessoa_juridica) && $flg_funcionario == 1) {
            $query = mysqli_query($link, "SELECT P.* FROM magiclink.Pessoa P WHERE flg_funcionario = " . $flg_funcionario . " ORDER BY P.id_pessoa");
        }
        foreach ($query as $row) {
            if ($acao_link == 2) {
                if ($row["flg_pessoa_juridica"] == 0) {
                    $ulr = "../views/editar_pessoa_fisica.php?id=" . $row["id_pessoa"];
                } else {
                    $ulr = "../views/editar_pessoa_juridica.php?id=" . $row["id_pessoa"];
                }
            } else if ($acao_link == 3) {
                if ($row["flg_funcionario"] != 0) {
                    $ulr = "../views/editar_funcionario.php?id=" . $row["id_pessoa"];
                }
            }

            $controle_pessoa = new Controle_pessoa();

            if ($flg_pessoa_juridica == 0) {
                $parte_um = substr($row["cpf_cnpj"], 0, 3);
                $parte_dois = substr($row["cpf_cnpj"], 3, 3);
                $parte_tres = substr($row["cpf_cnpj"], 6, 3);
                $parte_quatro = substr($row["cpf_cnpj"], 9, 2);
                $monta_cpf_cnpj = "$parte_um.$parte_dois.$parte_tres-$parte_quatro";
            } else if ($flg_pessoa_juridica == 1) {
                $parte_um = substr($row["cpf_cnpj"], 0, 2);
                $parte_dois = substr($row["cpf_cnpj"], 2, 3);
                $parte_tres = substr($row["cpf_cnpj"], 5, 3);
                $parte_quatro = substr($row["cpf_cnpj"], 8, 4);
                $parte_cinco = substr($row["cpf_cnpj"], 12, 2);
                $monta_cpf_cnpj = "$parte_um.$parte_dois.$parte_tres/$parte_quatro-$parte_cinco";
            }

            echo "<tr> 
                    <td>" . $row["id_pessoa"] . "</td>
                    <td>" . $row["nome"] . "</td>  
                    <td>" . $row["email"] . "</td>  
                    <td>" . $monta_cpf_cnpj . "</td>  
                   
                    <td>";
            if ($acao_link == 1) {
                if ($controle_pessoa->in_array_r($row["id_pessoa"], $id_pessoa_plano)) {
                    ?>
                    <button type="button" onclick="listar_boleto(<?= $row["id_pessoa"] ?>)" title="Listar Boletos" class="btn btn-sm btn-warning"><i class="fa fa-file-text"></i></button>
                    <?php
                }
                ?>
                <button type="button" class="btn btn-sm btn-success" title="Adquirir Plano" data-toggle="modal" data-target="#modal_planos_serviços" data-whatever="<?= $row["id_pessoa"] ?>" data-whatevernome="<?= $row["nome"] ?>"><i class = "fa fa-cart-plus"></i></button>
                <?php
            } else {
                ?>
                <a class = "btn btn-sm btn-success" href = "<?= $ulr ?>" title = "Editar Cliente"><i class = "fa fa-edit"></i></a>
                <?php
                if (!$controle_pessoa->in_array_r($row["id_pessoa"], $id_pessoa_plano)) {
                    ?>
                    <button type="button" class="btn btn-sm btn-danger" title="Ecluir Cliente"><i class="fa fa-trash"></i></button>
                    <?php
                }
            }
            "</td>  
                 </tr>";
        }
        $db->DBclose($link);
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
        $db->DBclose($link);
        return $dados;
    }

    public function verificar_img_existe_user() {
        $db = new DB();
        $link = $db->DBconnect();
        $query = "SELECT img_user FROM Pessoa WHERE id_pessoa = " . $this->id_pessoa;
        $resultado = mysqli_query($link, $query);
        $dados = mysqli_fetch_array($resultado);
        if ($dados["img_user"] == "" || $dados["img_user"] == null) {
            $db->DBclose($link);
            return null;
        } else {
            $db->DBclose($link);
            return $dados["img_user"];
        }
    }

}
