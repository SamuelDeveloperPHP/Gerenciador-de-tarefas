$(document).ready(function() {

    function limpa_formulario_cep() {
        // Limpa valores do formulÃ¡rio de cep.
        $("#logradouro").val("");
        $("#bairro").val("");
        $("#cidade").val("");
        $("#uf").val("");
        $("#ibge").val("");
    }
    
    //Quando o campo cep perde o foco.
    $("#cep").blur(function() {

        //Nova variÃ¡vel "cep" somente com dÃ­gitos.
        var cep = $(this).val().replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //ExpressÃ£o regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                $("#logradouro").val("...");
                $("#bairro").val("...");
                $("#id_municipio").val("...");
                $("#id_uf").val("...");
                $("#ibge").val("...");

                //Consulta o webservice viacep.com.br/
                $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                    if (!("erro" in dados)) {
                        //Atualiza os campos com os valores da consulta.
                        $("#logradouro").val(dados.logradouro);
                        $("#bairro").val(dados.bairro);
                        $("#id_municipio").val(dados.localidade);
                        $("#id_uf").val(dados.uf);
                        $("#ibge").val(dados.ibge);
                    } //end if.
                    else {
                        //CEP pesquisado nÃ£o foi encontrado.
                        limpa_formulario_cep();
                        alert("CEP nÃ£o encontrado.");
                    }
                });
            } //end if.
            else {
                //cep Ã© invÃ¡lido.
                limpa_formulario_cep();
                alert("Formato de CEP invÃ¡lido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulÃ¡rio.
            limpa_formulario_cep();
        }
    });
});