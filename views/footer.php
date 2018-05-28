

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Main Footer -->
<footer class="main-footer text-center">
    <!-- Default to the left -->
    <strong>Copyright &copy; <?= date('Y') ?> <a>Magic LINK</a>.</strong> Todos os direitos reservados.
</footer>

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="../scripts/js/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../scripts/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="../scripts/js/adminlte.min.js"></script>
<!-- Masked Input -->
<script src="../scripts/js/jquery.maskedinput.min.js"></script>
<script src="../scripts/js/jquery-ui.min.js"></script>
<!--DataTable-->
<script src="../scripts/js/jquery.dataTables.min.js"></script>
<script src="../scripts/js/dataTables.bootstrap.min.js"></script>  
<script>
    $(document).ready(function(){
       $(".mask-cpf").mask("999.999.999-99"); 
       $(".mask-cnpj").mask("99.999.999/9999-99");
       $(".mask-cep").mask("99999-999");
       $(".mask-celular").mask("(99) 99999-9999");
       $(".mask-telefone").mask("(99) 9999-9999");
       $(".mask-insc-estadual").mask("999.999.99-9");
       $(".mask-insc-municipal").mask("999.999.99-9");
    });
</script>
<script>
    function excluir_usuario(id) {
        $.ajax({
            url: 'excluir_usuario.php',
            type: 'POST',
            data: {id_pessoa: id}
        }).done(function (data) {
            $('#excluir_usuario').html(data);
        });

        $('#modal_excluir_usuario').modal('show');
    }
</script>
<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
</body>
</html>
<?php
echo sha1("123");
?>
