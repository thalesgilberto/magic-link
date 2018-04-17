<?php
require '../controller/seguranca.php';
require '../models/pessoa.php';
require '../models/controle_pessoa.php';
include 'header.php';
?>
<div class="content-header">
    <h1>
        Funcionário
        <small>Editar cadastro</small>
    </h1>
</div>
<br/>
<?php
$controle_pessoa = new Controle_pessoa();
if (isset($_GET["id"])) {
    $pessoa = new Pessoa();

    $dados = $pessoa->mostrar_dados_pessoa($_GET["id"]);
}
?>
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
<form enctype="multipart/form-data" action="../controller/editar_pessoa.php" method="POST">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li id="lidados" class="active"><a href="#dados-principais" data-toggle="tab">Dados Principais</a></li>
            <li id="licomplement" ><a id="acomplemet" href="#acessos" data-toggle="tab">Acessos do usuário</a></li>
        </ul>
        <div class="tab-content">
            <div class="active tab-pane" id="dados-principais">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="nome">Nome*</label>
                                    <input type="hidden" name="id_pessoa" value="<?= @$dados["id_pessoa"] ?>"/>
                                    <input type="text" name="nome" value="<?= @$dados["nome"] ?>" id="nome" class="form-control" required="required"/>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="data_nascimento">Data de Nascimento*</label>
                                    <input type="date" name="data_nascimento" value="<?= @$dados["data_nascimento"] ?>" id="data_nascimento" class="form-control" required="required"/>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="sexo">Sexo*</label>
                                    <select class="form-control" name="sexo" id="sexo" required="required">
                                        <option value="">Selecione</option>
                                        <?php
                                        if (@$dados["sexo"] == "M") {
                                            ?>
                                            <option selected value="M">Masculino</option>
                                            <option value="F">Feminino</option>
                                            <?php
                                        } else {
                                            ?>
                                            <option value="M">Masculino</option>
                                            <option selected value="F">Feminino</option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="cpf_cnpj">CPF*</label>
                                    <input type="text" name="cpf_cnpj" value="<?= @$dados["cpf_cnpj"] ?>" id="cpf_cnpj" class="form-control mask-cpf" placeholder="000.000.000-00" required="required"/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email">Email*</label>
                                    <input type="email" name="email" value="<?= @$dados["email"] ?>" id="email" class="form-control" placeholder="exemplo@exemplo.com" required="required"/>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="fixo">Telefone (fixo)*</label>
                                    <input type="text" name="fixo" id="fixo" value="<?= @$dados["fixo"] ?>" class="form-control mask-telefone" placeholder="(00) 0000-0000" required="required"/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="celular">Celular*</label>
                                    <input type="text" name="celular" value="<?= @$dados["celular"] ?>" id="celular" class="form-control mask-celular" placeholder="(00) 00000-0000" required="required"/>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="endereco">Endereço*</label>
                                    <input type="text" name="endereco" value="<?= @$dados["endereco"] ?>" id="endereco" class="form-control" required="required"/>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="bairro">Bairro*</label>
                                    <input type="text" name="bairro" id="bairro"  value="<?= @$dados["bairro"] ?>" class="form-control" required="required"/>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="numero">N°*</label>
                                    <input type="number" name="numero" id="numero"  value="<?= @$dados["numero"] ?>" class="form-control" required="required"/>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="cidade">Cidade*</label>
                                    <input type="text" name="buscar_cidade"  value="<?= @$dados["cidade"] ?>" id="buscar_cidade" class="form-control" required="required"/>
                                    <input type="hidden" name="cidade" id="cidade"  value="<?= @$dados["cidade_id"] ?>" class="form-control"/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="cep">CEP*</label>
                                    <input type="text" name="cep" id="cep"  value="<?= @$dados["cep"] ?>" class="form-control mask-cep" placeholder="00000-000" required="required"/>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="senha">Senha de Acesso</label>
                                    <input type="password" name="senha" id="senha" class="form-control"/>
                                </div>
                            </div>
                            <input type="hidden" value="1" name="flg_funcionario"/>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="img_user">Foto de Perfil</label>
                                    <div class="" id="divImg" style="height: 100px; width: 100px">
                                        <a href="#" id="removerImg" title="Remover imagem" class="btn btn-xs"><i class="fa fa-remove"></i></a>
                                        <img src="<?= @$dados["img_user"] == "" || @$dados["img_user"] == null ? "../img/default.jpg" : "../img/" . $dados["img_user"] ?>" id="imagepreview" style="height: 100px; width: 100px"/>
                                    </div>
                                    <br/>
                                    <br/>
                                    <input type="file" class="btn-file" name="img_user" id="img_user"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer ">
                        <button type="button" id="proximo" class="btn btn-default pull-right">Proxímo</button>
                    </div>
                </div>
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="acessos">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <?= $controle_pessoa->listar_acessos_controle($_GET["id"]) ?>
                        </div>
                    </div>
                    <div class="box-footer ">
                        <button type="button" id="voltar" class="btn btn-default pull-left">Voltar</button>
                        <button type="submit" class="btn btn-primary pull-right">Salvar</button>
                    </div>
                </div>
                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
        </div>
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
            $("#imagepreview").attr('src', '../img/<?= @$dados["img_user"] == "" || @$dados["img_user"] == null ? "../img/default.jpg" : "../img/" . $dados["img_user"] ?>');
        });

        $("#proximo").click(function () {
            $("#lidados").removeClass("active");
            $("#dados-principais").removeClass("active");
            $("#licomplement").addClass("active");
            $("#acomplemet").attr("aria-expanded", "true");
            $("#acessos").addClass("active");

        });

        $("#voltar").click(function () {
            $("#lidados").addClass("active");
            $("#dados-principais").addClass("active");
            $("#licomplement").removeClass("active");
            $("#acomplemet").attr("aria-expanded", "false");
            $("#acessos").removeClass("active");

        });
    });
</script>

<script>
    $(document).ready(function () {
        $("#buscar_cidade").autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: '../controller/autocomplete_cidades.php',
                    type: "POST",
                    dataType: "json",
                    data: {term: request.term},
                    success: function (data) {
                        response($.map(data, function (item) {
                            return {label: item[1] + " " + "(" + item[2] + ")", val: item[0]};
                        }));
                    }
                });
            },
            search: function (event, i) {
                $(this).addClass('loader');
            },
            response: function (event, i) {
                $(this).removeClass('loader');
                if (!i.content.length) {
                    var semresultado = {label: "Nenhum resultado encontrado", value: ""};
                    i.content.push(semresultado);
                }
            },
            select: function (event, i) {
                $("#cidade").val(i.item.val);
                $(this).removeClass('loader');
            },
            change: function (event, ui) {
                $(this).removeClass('loader');
                if (ui.item === null) {
                    $(this).val('');
                    $('#cidade').val('');

                }
            }
        });
    });
</script>