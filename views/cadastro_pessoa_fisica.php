<?php
require '../controller/seguranca.php';
require '../models/pessoa.php';
include 'header.php';
$pessoa = new Pessoa();
?>
<div class="content-header">
    <h1>
        Pessoa Fisica
        <small>Cadastro</small>
    </h1>
</div>
<br/>
<?php
if (isset($_SESSION["erro"])) {
    ?>
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-ban"></i> Alerta!</h4>
        <?= $_SESSION["erro"] ?>
    </div>
    <?php
    unset($_SESSION["erro"]);
}

if (isset($_SESSION['sucesso'])) {
    ?>
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-check"></i> Concluído!</h4>
        <?= $_SESSION['sucesso'] ?>
    </div>
    <?php
    unset($_SESSION["sucesso"]);
}
?>
<form enctype="multipart/form-data" action="../controller/cadastrar_pessoa.php" method="POST">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li id="lidados" class="active"><a href="#dados-principais" data-toggle="tab">Dados Principais</a></li>
            <li id="licomplement" ><a id="acomplemet" href="#complementos" data-toggle="tab">Complementos</a></li>
        </ul>
        <div class="tab-content">
            <div class="active tab-pane" id="dados-principais">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-row">
                                <div class="form-group col-md-5">
                                    <label for="nome">Nome*</label>
                                    <input type="text" name="nome" id="nome" class="form-control" required="required"/>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="data_nascimento">Data de Nascimento*</label>
                                    <input type="date" name="data_nascimento" id="data_nascimento" class="form-control" required="required"/>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="sexo">Sexo*</label>
                                    <select class="form-control" name="sexo" id="sexo" required="required">
                                        <option value="">Selecione</option>
                                        <option value="M">Masculino</option>
                                        <option value="F">Feminino</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-5">
                                    <label for="cpf">CPF*</label>
                                    <input type="text" name="cpf" id="cpf" class="form-control mask-cpf" placeholder="000.000.000-00" required="required"/>
                                </div>
                                <div class="form-group col-md-7">
                                    <label for="email">Email*</label>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="exemplo@exemplo.com" required="required"/>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-5">
                                    <label for="senha">Senha*</label>
                                    <input type="password" name="senha" id="senha" class="form-control" required="required"/>
                                </div>
                                <div class="form-group col-md-7">
                                    <label for="id_nivel_usuario">Nível de Usuário*</label>
                                    <select class="form-control" name="id_nivel_usuario" id="id_nivel_usuario" required="required">
                                        <option value="">Selecione</option>
                                        <?php
                                        $pessoa->selectList("id_nivel_usuario", "descricao", "Nivel_usuario");
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label for="img_user">Foto de Perfil</label>
                                    <div class="" id="divImg" style="height: 100px; width: 100px">
                                        <a href="#" id="removerImg" title="Remover imagem" class="btn btn-xs"><i class="fa fa-remove"></i></a>
                                        <img src="../img/default.jpg" id="imagepreview" style="height: 100px; width: 100px"/>
                                    </div>
                                    <br/>
                                    <br/>
                                    <input type="file" class="btn-file" name="img_user" id="img_user"/>
                                </div>
                            </div>
                            <input type="hidden" value="0" name="flg_pessoa_juridica"/>
                        </div>
                    </div>
                    <div class="box-footer ">
                        <button type="button" id="proximo" class="btn btn-default pull-right">Proxímo</button>
                    </div>
                </div>
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="complementos">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="fixo">Telefone (fixo)</label>
                                    <input type="text" name="fixo" id="fixo" class="form-control mask-telefone"/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="celular">Celular</label>
                                    <input type="text" name="celular" id="celular" class="form-control mask-celular"/>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="endereco">Endereço</label>
                                    <input type="text" name="endereco" id="endereco" class="form-control"/>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="bairro">Bairro</label>
                                    <input type="text" name="bairro" id="bairro" class="form-control"/>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="numero">N°</label>
                                    <input type="number" name="numero" id="numero" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="cidade">Cidade</label>
                                    <input type="text" name="cidade" id="cidade" class="form-control"/>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="cep">CEP</label>
                                    <input type="text" name="cep" id="cep" class="form-control mask-cep"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer ">
                        <button type="button" id="voltar" class="btn btn-default pull-left">Voltar</button>
                        <button type="submit" class="btn btn-primary pull-right">Cadastrar</button>
                    </div>
                </div>
                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
        </div>
</form>
<?php
include 'footer.php';
?>

<script>
    $(document).ready(function () {
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#imagepreview').prop('src', e.target.result).show();
                },
                        reader.readAsDataURL(input.files[0]);
            }
        }
        $("#img_user").change(function () {
            readURL(this);
            $('#imagepreview').show();
        });
        $('#imagepreview').click(function () {
            $('#img_user').replaceWith($('#img_user').clone(true));
            $('#imagepreview').hide();
        });

        $("#removerImg").click(function (event) {
            event.preventDefault();
            $("#img_user").val('');
            $("#imagepreview").attr('src', '../img/default.jpg');
        });

        $("#proximo").click(function () {
            $("#lidados").removeClass("active");
            $("#dados-principais").removeClass("active");
            $("#licomplement").addClass("active");
            $("#acomplemet").attr("aria-expanded", "true");
            $("#complementos").addClass("active");

        });

        $("#voltar").click(function () {
            $("#lidados").addClass("active");
            $("#dados-principais").addClass("active");
            $("#licomplement").removeClass("active");
            $("#acomplemet").attr("aria-expanded", "false");
            $("#complementos").removeClass("active");

        });
    });
</script>