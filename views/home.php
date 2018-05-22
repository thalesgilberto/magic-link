<?php
require '../controller/seguranca.php';
include 'header.php';
?>
<div class="content-header">
    <h1>
        Dashbord
        <small>Painel de Controle</small>
    </h1>
</div>
<br/>

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title"></h3>
        <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
    </div>
    <div class="box-body">
        <canvas height="180" width="600" style="height: 180px; width: 600px;"  id="grafico_qtd_pessoa"></canvas>
    </div>
    <div class="box-footer">

    </div>
</div>
<?php
include 'footer.php';
?>

<script type="text/javascript" src="../scripts/js/Chart.min.js"></script>
<script>
    $(document).ready(function () {
        $.ajax({
            url: "../controller/chat_qtd_pessoa_mes.php",
            type: "GET",
            datatype: "json",
            success: function (data) {
                var obj = JSON.parse(data);
               
                var data = {
                    labels : ["Jan","Fev","Mar","Abr","Mai","Jun","Jul","Ago","Set","Out","Nov","Dez"],
                    datasets:[
                        {
                            label: "Pessoa Física",
                            data: obj.pessoaFisica,
                            backgroundColor:"blue",
                            borderColor:"ligthblue",
                            fill:false,
                            lineTension:0,
                            pointRadius:5
                        },
                        {
                            label: "Pessoa Jurídica",
                            data: obj.pessoaJuridica,
                            backgroundColor:"green",
                            borderColor:"ligthgreen",
                            fill:false,
                            lineTension:0,
                            pointRadius:5
                        }
                    ]
                };
                
                var options = {
                    title : {
                        text: "Pessoa Cadastradas - 2018",
                        display: true,
                        fontSize: 18
                    }
                };
                
                var ctx = $("#grafico_qtd_pessoa");
                var chart = new Chart(ctx, {
                    type: "line",
                    data: data,
                    options: options
                });
            },
            error: function (data) {
                console.log(data);
            }
        });
    });
</script>
