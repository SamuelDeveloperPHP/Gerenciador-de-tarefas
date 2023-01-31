$(document).ready(function () {
    $("input[name='cod_eqp[]']").blur(function () {
        var $descricao = $("input[name='descricao']");
        var cod_eqp = $(this).val();
        
        $.getJSON('proc_pesq_user.php', {cod_eqp},
            function(retorno){
                $descricao.val(retorno.descricao);
            }
        );        
    });
});