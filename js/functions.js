function calcular() {
    var els = document.getElementsByClassName("somar");
    var elsArray = Array.prototype.slice.call(els, 0);
    var soma = 0;

    elsArray.forEach(function (el) {
        soma -= -parseFloat(el.value);
    });

    document.getElementById("custo_final").value = parseFloat(soma).toFixed(2);
}

function calcular2() {
    var els = document.getElementsByClassName("somar2");
    var elsArray = Array.prototype.slice.call(els, 0);
    var soma = 0;

    elsArray.forEach(function (el) {
        soma -= -parseFloat(el.value);
    });

    document.getElementById("custo_rateio").value = parseFloat(soma).toFixed(2);
}

function custofinal() {

    var valor1 = document.getElementById('custo_final').value;
    var valor2 = document.getElementById('participacao').value;
    var conta = document.getElementById('custo_rateio').value = parseFloat(valor1 - valor2).toFixed(2);

}

function adicionarElemento() {
    var contador = 0;
    jQuery('input[fazparte]:visible').each(function () {
        contador++;
    });
    // Aqui a logica de adicionar um proximo elemento para
    // funcionar na logica acima so sera necessario criar o proximo id corretamente, 
    // desse modo mesmo que o input
    // existir, se ele nao for setado, nao vai alterar em nada o valor da comissao
    var elemento = '<br/><select id="porcentagem' + (contador + 1) + '" onchange="calcular()"><option value="10">10</option><option value="45">45</option></select><input id="valor' + (contador + 1) + '" onblur="calcular()" fazparte>';
    $("#valor" + (contador)).after(elemento);
}

function copiarTexto() {
    var textoCopiado = document.getElementById("link");
    textoCopiado.select();
    document.execCommand("Copy");
    alert("Link copiado: " + textoCopiado.value);
}


function dataEHora() {

    setTimeout(function () {
        var dataHora, xHora, xDia, dia, mes, ano, saudacao, diaSem, mesAno;
        dataHora = new Date();
        xHora = dataHora.getHours();

        if (xHora >= 0 && xHora < 12) { saudacao = "Bom Dia -" }
        if (xHora >= 12 && xHora < 18) { saudacao = "Boa Tarde -" }
        if (xHora >= 18 && xHora <= 23) { saudacao = "Boa Noite -" }

        xDia = dataHora.getDay();

        diaSem = new Array(7);

        diaSem[0] = "Domingo";
        diaSem[1] = "Segunda-feira";
        diaSem[2] = "Terça-feira";
        diaSem[3] = "Quarta-feira";
        diaSem[4] = "Quinta-feira";
        diaSem[5] = "Sexta-feira";
        diaSem[6] = "Sábado";

        dia = dataHora.getDate();
        mes = dataHora.getMonth();

        mesAno = new Array(12);

        mesAno[0] = "Janeiro";
        mesAno[1] = "Fevereiro";
        mesAno[2] = "Março";
        mesAno[3] = "Abril";
        mesAno[4] = "Maio";
        mesAno[5] = "Junho";
        mesAno[6] = "Julho";
        mesAno[7] = "Agosto";
        mesAno[8] = "Setembro";
        mesAno[9] = "Outubro";
        mesAno[10] = "Novembro";
        mesAno[11] = "Dezembro";

        ano = dataHora.getFullYear();


        if (document.getElementById("dataEHora") == undefined) {
            console.log('Não achou div com id = dataEHora')
        } else {

            document.getElementById("dataEHora").innerHTML = "<font face='arial', arial' size=3 color='000000'>" + "  " + saudacao + " " + diaSem[xDia] + ", " + dia + " de " + mesAno[mes] + " de " + ano + "</font>";
        }


    }, 100);
}
// funcao remove uma linha da tabela
function removeLinha(linha) {
    var i = linha.parentNode.parentNode.rowIndex;
    document.getElementById('idTabela').deleteRow(i);

    calcular()
}

function removeLinha2(linha) {
    var i = linha.parentNode.parentNode.rowIndex;
    document.getElementById('table2').deleteRow(i);

    calcular()
}

function removeLinha3(linha) {
    var i = linha.parentNode.parentNode.rowIndex;
    document.getElementById('idTabela3').deleteRow(i);

    calcular2()
}

function adicionaLinha(idTabela) {

    var tabela = document.getElementById(idTabela);
    var numeroLinhas = 2;
    var linha = tabela.insertRow(numeroLinhas);
    var celula1 = linha.insertCell(0);
    var celula2 = linha.insertCell(1);
    // var celula3 = linha.insertCell(2);
    celula1.innerHTML = `<td>
        <div class="mda-form-group">
            <input type="text" name="cod_eqp[]" class="cod_eqp mda-form-control ng-pristine ng-invalid ng-touched" required>
            <label class="form-check-label" for="cod_eqp">
            Cod Equipamento:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </label>
        </div>

    </td>`;
    // celula2.innerHTML = `<td>
    //     <div class="mda-form-group">
                
    //          <input type="text" name="descricao" class="mda-form-control ng-pristine ng-invalid ng-touched" required>
    //          <label class="form-check-label" for="descricao">
    //         Descrição:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    //         </label>
    //      </div>
    
    // </td>`;

    celula2.innerHTML = `<td>
        <div class="mda-form-group">
                
        <button onclick='removeLinha(this)' type="button" class="btn btn-danger">
        <i class="fas fa-times"></i>
        </button>
         </div>
    
    </td>`;
}

function adicionaLinha2(idTabela) {

    var tabela = document.getElementById(idTabela);
    var numeroLinhas = 3;
    var linha = tabela.insertRow(numeroLinhas);
    var celula1 = linha.insertCell(0);
    var celula3 = linha.insertCell(1);
    var celula4 = linha.insertCell(2);
    var celula5 = linha.insertCell(3);
    celula1.innerHTML = `< td >
        <div class="form-group" style="margin-bottom:0px !important;padding: 0px 20px 0px 20px;">

            <input type="text" name="paragrafo[]" class="form-control" required>
        </div>

</td>`;
    celula3.innerHTML = `< td >
        <div class="form-group" style="margin-bottom:0px !important;padding: 0px 20px 0px 20px;">

            <input type="text" name="detalhes[]" class="form-control" required>
            </div>
    </td>`;
    celula4.innerHTML = `< td >
        <div class="form-group" style="margin-bottom:0px !important;padding: 0px 20px 0px 20px;">

            <input value="0" fazparte onblur="calcular()" class="form-control somar" type="text" name="preco[]" required>
            </div>
    </td>`;
    celula5.innerHTML = `< tr >

        <button onclick='removeLinha(this)' type="button" class="btn btn-danger">
            <i class="fas fa-times"></i>
        </button>
    
</tr > `;
}

function adicionaLinha3(table2) {

    var tabela = document.getElementById(table2);
    var numeroLinhas = 4;
    var linha = tabela.insertRow(numeroLinhas);
    var celula1 = linha.insertCell(0);
    var celula3 = linha.insertCell(1);
    var celula4 = linha.insertCell(2);
    var celula5 = linha.insertCell(3);
    celula1.innerHTML = `< td >
        <div class="form-group" style="margin-bottom:0px !important;padding: 0px 20px 0px 20px;">

            <input type="date" name="datapag[]" class="form-control" required>
        </div>

</td>`;
    celula3.innerHTML = `< td >
        <div class="form-group" style="margin-bottom:0px !important;padding: 0px 20px 0px 20px;">

            <input type="text" name="condicoesac[]" class="form-control" required>
            </div>
    </td>`;
    celula4.innerHTML = `< td >
        <div class="form-group" style="margin-bottom:0px !important;padding: 0px 20px 0px 20px;">

            <input value="0" fazparte onblur="calcular2()" class="form-control somar2" type="text" name="valores2[]" required>
            </div>
    </td>`;
    celula5.innerHTML = `< tr >

        <button onclick='removeLinha2(this)' type="button" class="btn btn-danger">
            <i class="fas fa-times"></i>
        </button>
    
</tr > `;
}

function adicionaLinha4(idTabela3) {

    var tabela = document.getElementById(idTabela3);
    var numeroLinhas = tabela.rows.length;
    var linha = tabela.insertRow(numeroLinhas);
    var celula1 = linha.insertCell(0);
    var celula2 = linha.insertCell(1);
    var celula3 = linha.insertCell(2);
    var celula4 = linha.insertCell(3);
    var celula5 = linha.insertCell(4);
    celula1.innerHTML = `< td >
        <div class="form-group" style="margin-bottom:0px !important;padding: 0px 20px 0px 20px;">
            <span class="input-group-text">Nota Fiscal:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <input type="text" name="nota[]" class="form-control" required>
        </div>

</td>`;
    celula2.innerHTML = `< td >
        <div class="form-group" style="margin-bottom:0px !important;padding: 0px 20px 0px 20px;">
            <span class="input-group-text">Peças/Serviços:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <input type="text" name="ps[]" class="form-control" required>
            </div>
    
    </td>`;
    celula3.innerHTML = `< td >
        <div class="form-group" style="margin-bottom:0px !important;padding: 0px 20px 0px 20px;">
            <span class="input-group-text">Fornecedores:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <input type="text" name="fornecedor[]" class="form-control" required>
            </div>
    </td>`;
    celula4.innerHTML = `< td >
        <div class="form-group" style="margin-bottom:0px !important;padding: 0px 20px 0px 20px;">
            <span class="input-group-text">Peças/Serviços:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <input value="0" fazparte onblur="calcular2()" onmouseover="calcular2()" class="form-control somar2" type="text" name="preco2[]" required>
            </div>
    </td>`;
    celula5.innerHTML = `< tr >

        <button onclick='removeLinha3(this)' type="button" class="btn btn-danger">
            <i class="fas fa-times"></i>
        </button>
    
</tr > `;
}

function adicionaLinhaANTIGO(linha) {

    var i = linha.parentNode.parentNode.rowIndex;
    document.getElementById('idTabela').insertRow(i);

    insertCell(0).innerHTML = `< td >
        <div class="card-body">
            <div class="form-group">
                <span class="input-group-text">Nota Fiscal:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                <input type="text" name="nota[]" class="form-control" required>
        </div>
            </div>

</td>`;

    row.insertCell(1).innerHTML = `< td >
        <div class="card-body">
            <div class="form-group">
                <span class="input-group-text">Peças/Serviços:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                <input type="text" name="ps[]" class="form-control" required>
            </div>
            </div>
    
    </td>`;

    row.insertCell(2).innerHTML = `< td >
        <div class="card-body">
            <div class="form-group">
                <span class="input-group-text">Fornecedores:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                <input type="text" name="fornecedor[]" class="form-control" required>
            </div>
            </div>
    </td>`;

    row.insertCell(3).innerHTML = `< td >
        <div class="card-body">
            <div class="form-group">
                <span class="input-group-text">Peças/Serviços:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                <input fazparte onblur="calcular()" class="form-control somar" type="text" name="preco[]" required>
            </div>
            </div>
    </td>`;

    row.insertCell(4).innerHTML = `< tr >

        <button onclick='removeLinha(this)' type="button" class="btn btn-danger">
            <i class="fas fa-times"></i>
        </button>
    
</tr > `;
}






//FUNÃ‡ÃƒO JAVASCRIPT RESPONSVEL POR REDIMENSIONAR AS IMAGENS
function handleFiles(id) {
    var dataurl = null;
    var filesToUpload = document.getElementsByClassName(id)[0].files;
    var file = filesToUpload[0];

    // Create an image
    var img = document.createElement("img");
    // Create a file reader
    var reader = new FileReader();
    // Set the image once loaded into file reader
    reader.onload = function (e) {
        img.src = e.target.result;

        img.onload = function () {
            var canvas = document.createElement("canvas");
            var ctx = canvas.getContext("2d");
            ctx.drawImage(img, 0, 0);

            //TROQUE O VALOR ABAIXO PARA ALTERAR A LARGURA MÃXIMA DA IMAGEM GERADA
            var MAX_WIDTH = 900;
            //TROQUE O VALOR ABAIXO PARA ALTERAR A ALTURA MÃXIMA DA IMAGEM GERADA
            var MAX_HEIGHT = 900;
            var width = img.width;
            var height = img.height;

            if (width > height) {
                if (width > MAX_WIDTH) {
                    height *= MAX_WIDTH / width;
                    width = MAX_WIDTH;
                }
            } else {
                if (height > MAX_HEIGHT) {
                    width *= MAX_HEIGHT / height;
                    height = MAX_HEIGHT;
                }
            }
            canvas.width = width;
            canvas.height = height;
            var ctx = canvas.getContext("2d");
            ctx.drawImage(img, 0, 0, width, height);

            dataurl = canvas.toDataURL("image/jpeg", 1.0);
            document.getElementById('image_' + id).src = dataurl;
            document.getElementsByName(id)[0].value = dataurl;

        }
    }
    // Load files into file reader
    reader.readAsDataURL(file);
}