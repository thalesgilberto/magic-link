<?php
require '../controller/seguranca.php';
require '../models/pessoa.php';
include 'header.php';
$pessoa = new Pessoa();
$dados = $pessoa->mostrar_dados_pessoa($_GET['id']);
?>
<div class="content-header">
    <h1>
        <?=$dados['nome']?>
        <small>Serviços para clientes</small>
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
?>
<form enctype="multipart/form-data" action="../controller/cadastrar_servico_cliente.php" method="POST">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li id="lidados" class="active"><a href="#dados-principais" data-toggle="tab">Adquirir plano</a></li>
        </ul>
        <div class="tab-content">
            <div class="active tab-pane" id="dados-principais">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label for="tempo_servico">Plano de dados*</label>
                                    
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label for="tempo_servico">Tempo de serviço*</label>
                                    <select class="form-control" name="tempo_servico" id="tempo_servico">
                                        <option value="">Selecione</option>
                                        <?php
                                        for ($i = 1; $i <= 12; $i++) {
                                        ?>
                                            <option value="<?= $i ?>"><?= $i ?> <?= $i==1?'mês':'meses'?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label for="dia_pagamento">Dia de pagamento*</label>
                                    <select class="form-control" name="dia_pagamento" id="dia_pagamento">
                                        <option value="">Selecione</option>
                                        <?php
                                        for ($i = 1; $i <= 30; $i++) {
                                        ?>
                                            <option value="<?= $i ?>"><?= $i ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>      
                        </div>
                    </div>
                    <div class="box-footer ">
                        <button type="submit" class="btn btn-primary pull-right">Cadastrar</button>
                    </div>
                </div>
            </div>
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
            $("#imagepreview").attr('src', '../img/default.jpg');
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