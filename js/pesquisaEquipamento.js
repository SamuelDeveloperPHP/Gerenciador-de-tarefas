$(document).ready(function () {
    $("input[name='cod_os']").blur(function () {
        var $descricao = $("input[name='tipo_produto']");
        var cod_os = $(this).val();
        
        $.getJSON('./pesquisaTipoOs.php', {cod_os},
            function(retorno){
                $descricao.val(retorno.tipo_produto);
            }
        );        
    });
});