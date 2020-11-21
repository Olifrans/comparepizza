$(document).ready(function() {
    window.onload = quantidadepedidos();
    var suma = 0;
    var arregloTabela = [];
    $('select').material_select();
    $('.modal').modal();
    $('.collapsible').collapsible();
    $('#btnCancelar').click(function(event) {
        $('#modalAG').modal('close');
    });
    $('a[id=btnAgregar]').on('click', function(e) {
        var idcli = $('#idPizzaria').text();

        if (idcli == "") {
            Materialize.toast('Para fazer consulta de Pizzarias "Pizzarias"', 8000);
        } else {
            var id = $(this).data("id");
            var img = $(this).data("img");
            var pre = $(this).data("pre");
            var nome = $(this).data("np");
            var btn = $('#btnAgregarLista');
            btn.attr('data-opera', 'agregar');
            btn.attr('data-id', id);
            btn.attr('data-img', img);
            btn.attr('data-precio', pre);
            btn.attr('data-nome', nome);
            $('#quantidade').html("Preço da pizza: $ " + pre + ".00 MX");
            $('#nome').html("nome da Pizza: " + nome);
            $('#modalimg').html('<img src="assets/img/' + img + '" alt="" style="max-width:100%">');
            $('#modalAG').modal('open');
        }
    });
    $('#rango').change(function() {
        $('#valor').val($(this).val());
    });
    $('#menos').click(function() {
        if ($('#arroz').val() != 0)

            $('#arroz').val(parseInt($('#arroz').val()) - 1);
    });
    $('#mas').click(function() {
        //Aumentamos el valor del campo
        if ($('#arroz').val() != 10)
            $('#arroz').val(parseInt($('#arroz').val()) + 1);
    });
    $('#menos1').click(function() {
        //Solo si el valor del campo es diferente de 0
        if ($('#pasta').val() != 0)
        //Decrementamos su valor
            $('#pasta').val(parseInt($('#pasta').val()) - 1);
    });
    $('#mas1').click(function() {
        if ($('#pasta').val() != 10)
            $('#pasta').val(parseInt($('#pasta').val()) + 1);
    });
    $('#menos2').click(function() {
        //Somente se o valor do campo for diferente de 0
        if ($('#salsa').val() != 0)
        //Decrementamos su valor
            $('#salsa').val(parseInt($('#salsa').val()) - 1);
    });
    $('#mas2').click(function() {
        if ($('#salsa').val() != 10)
            $('#salsa').val(parseInt($('#salsa').val()) + 1);
    });
    $('#btnAgregarLista').click(function(e) {


        $('#remover').removeClass('ocultar');
        var tabela = document.getElementById('tabelaP');
        var pos = $(this).data("pos");
        var opera = $(this).data("opera");
        var id = $(this).data("id");
        var img = $(this).data("img");
        var precio = $(this).data("precio");
        var nomeN = $(this).data("nome");
        var quantidade = $('#valor').val();
        var arroz = $('#arroz').val();
        var pasta = $('#pasta').val();
        var salsa = $('#salsa').val();

        var total = ((parseInt(precio) * parseInt(quantidade)) + (parseInt(arroz) * 15) + (parseInt(pasta) * 15) + (parseInt(salsa) * 5));

        $('#modalAG').modal('close');
        if (opera == 'agregar') {
            var noFilas = (tabela.rows.length) - 1;
            var row = tabela.insertRow(noFilas).outerHTML =
                '<tr id="fila' + noFilas + '">\
   \n<td class="clavep" id="id' + noFilas + '" style="display: none;">' + id + '</td>\
    \n<td id="img' + noFilas + '" style="display: none;">' + img + '</td>\
    \n<td id="tdN1' + noFilas + '"><img src="./assets/img/' + img + '" alt="" style="max-width: 30%;max-height: 30%;"></td>\
    \n<td id="tdN2' + noFilas + '">' + nomeN + '</td>\
    \n<td class="preciounitario" id="tdN3' + noFilas + '">' + precio + '</td>\
    \n<td class="quantidade" id="tdN4' + noFilas + '">' + quantidade + '</td>\
    \n<td class="arroz" id="tdN5' + noFilas + '">' + arroz + '</td>\
    \n<td class="pasta" id="tdN6' + noFilas + '">' + pasta + '</td>\
    \n<td class="salsa" id="tdN7' + noFilas + '">' + salsa + '</td>\
    \n<td class="subtotal" id="tdN9' + noFilas + '">' + total + '</td>\
    \n<td><button class="waves-effect waves-light btn icon-editar" id="btnEditar' + noFilas + '" onclick="editar(' + noFilas + ')"></button>\
    \n<button  class="waves-effect waves-light red btn icon-trash-o" id="btnEliminar' + noFilas + '" onclick="eliminar(' + noFilas + ')"></button>\
    \n</td>\ \n</tr>';
            var $toastContent = $('<span>Sua pizza foi adicionada à lista</span>').add($('<a href="#listaTabela">--IR--></a><span> En la lista: ' + (parseInt(noFilas) - 1) + '</span>'));
            Materialize.toast($toastContent, 5000, "rounded");
        }
        if (opera == 'editar') {
            var noFilas = pos;
            document.getElementById('fila' + pos).outerHTML =
                '<tr id="fila' + noFilas + '">\
   \n<td class="clavep" id="id' + noFilas + '" style="display: none;">' + id + '</td>\
    \n<td id="img' + noFilas + '" style="display: none;">' + img + '</td>\
    \n<td id="tdN1' + noFilas + '"><img src="./assets/img/' + img + '" alt="" style="max-width: 30%;max-height: 30%;"></td>\
    \n<td id="tdN2' + noFilas + '">' + nomeN + '</td>\
    \n<td class="preciounitario" id="tdN3' + noFilas + '">' + precio + '</td>\
    \n<td class="quantidade" id="tdN4' + noFilas + '">' + quantidade + '</td>\
    \n<td class="arroz" id="tdN5' + noFilas + '">' + arroz + '</td>\
    \n<td class="pasta" id="tdN6' + noFilas + '">' + pasta + '</td>\
    \n<td class="salsa" id="tdN7' + noFilas + '">' + salsa + '</td>\
    \n<td class="subtotal" id="tdN9' + noFilas + '">' + total + '</td>\
    \n<td><button class="waves-effect waves-light btn icon-editar" id="btnEditar' + noFilas + '" onclick="editar(' + noFilas + ')"></button>\
    \n<button  class="waves-effect waves-light red btn icon-trash-o" id="btnEliminar' + noFilas + '" onclick="eliminar(' + noFilas + ')"></button>\
    \n</td>\ \n</tr>';
        }
        $(this).removeData("id");
        $(this).removeData("img");
        $(this).removeData("precio");
        $(this).removeData("nome");
        $(this).removeData("opera");
        $(this).removeData("pos");
        calcularTotal();

    });

    $('#enviarMub').click(function(e) {
        var ubi = $(this).val();
        $('#localizacao').val(ubi);
        // $('#localizacao').attr("readonly","readonly");
        $('#modalUB').modal('open');
    });
    $('#btnCancelarUB').click(function(e) {
        $('#enviarMub').val("");
        $('#localizacao').val("");
        $('#colonia').val("");
        $('#calles').val("");
        $('#numcasa').val("");
        $('#referencias').val("");
        $('#modalUB').modal('close');

    });

    $('#pizzariaUB').click(function(e) {
        $('#modalUB').modal('close');
        findMe();
        Materialize.toast('Você pode fazer a localização manualmente', 8000, "rounded");
    });
    $('#btnEnviarDados').click(function(e) {
        var ubi = $('#localizacao').val();
        var col = $('#colonia').val();
        var call = $('#calles').val();
        var num = $('#numcasa').val();
        var refe = $('#referencias').val();
        var total = parseFloat($('#total').text());
        var idcli = $('#idPizzaria').text();
        var dadosLocalizacao = {
            localizacao: ubi,
            colonia: col,
            calles: call,
            numcasa: num,
            referencia: refe,
            pretotal: total,
            tabela: "LOCALIZACAO",
            pizzaria: idcli
        };
        if (ubi.length > 0 || (col.length > 0 && call.length > 0 && num.length > 0)) {
            grabaTodoTabela(dadosLocalizacao);
            localizacaoComparepizza();
            $('#enviarMub').val("");
            $('#localizacao').val("");
            $('#colonia').val("");
            $('#calles').val("");
            $('#numcasa').val("");
            $('#referencias').val("");
            $('#modalUB').modal('close');
        } else {
            Materialize.toast('Por favor, ative sua localização ou insira seu endereço', 5000, "rounded");
        }
    });

    $('.modalEspera').click(function(e) {
        var pedidos = $('#pedidosR').text();
        if (pedidos == "0") {
            Materialize.toast('Você não tem pedido para confirmar', 5000, "rounded");
        } else {
            $('#estadoL').text("Tienes " + pedidos + " pedidos");
            $('#modalLista').modal('open');
            estado();
        }

    });
    $('#btnCancelarLista').click(function(e) {
        $('#modalLista').modal('close');
    });


    //verificar camvios del estado do pedido
    setInterval("estado()", 5000);

});
///////////--------Cargar---Lista--Estado----------------/////////
function estado() {
    var pedidos = $('#pedidosR').text();
    if (pedidos != "0") {
        cargarListaEspera();
        quantidadepedidos();

    }

};

function cargarListaEspera() {
    var idcli = $('#idPizzaria').text();
    var parametros = {
        'pizzaria': idcli //Camviar el ide del pizzaria cuando este lo de seciones
    };
    $.ajax({
        data: parametros,
        url: "./vistas/listaEspera.php",
        type: 'post',

        success: function(response) {

            $('#listaPendientes').html(response);
        }
    });
};

function quantidadepedidos() {
    var idcli = $('#idPizzaria').text();
    var parametros = {
        'pizzaria': idcli //Camviar el ide del pizzaria cuando este lo de seciones
    };
    $.ajax({
        data: parametros,
        url: "./vistas/numeroPedidos.php",
        type: 'post',

        success: function(response) {
            $('#pedidosR').text(response);
        }
    });

};

function calcularTotal() {
    var SUMA = $("#tabelaP tbody > tr");
    var TOTAL = 0;
    SUMA.each(function() {
        var SUBTOTAL = $(this).find("td[class='subtotal']").text();
        if (SUBTOTAL !== '') {
            TOTAL = ((TOTAL) + (parseInt(SUBTOTAL)));
        }
    });
    document.getElementById('total').innerHTML = TOTAL;
};
//-----FUNCION GUARDAR DADOS DE LA TABELA DINAMICA-------
function grabaTodoTabela(dadosLocalizacao) {

    var DATA = [],
        TABELA = $("#tabelaP tbody > tr");
    var cont = 0;
    TABELA.each(function() {

        var CLAVEP = $(this).find("td[class='clavep']").text(),
            ARROZ = $(this).find("td[class='arroz']").text(),
            PASTA = $(this).find("td[class='pasta']").text(),
            SALSA = $(this).find("td[class='salsa']").text(),
            PRECIOUNI = $(this).find("td[class='preciounitario']").text(),
            QUANTIDADE = $(this).find("td[class='quantidade']").text(),
            SUBTOTAL = $(this).find("td[class='subtotal']").text();

        item = {};

        if (CLAVEP !== '') {
            cont = cont + 1;
            item["idp"] = CLAVEP;
            item["arroz"] = ARROZ;
            item["pasta"] = PASTA;
            item["salsa"] = SALSA;
            item["preuni"] = PRECIOUNI;
            item["quantidade"] = QUANTIDADE;
            item["subtotal"] = SUBTOTAL;

            DATA.push(item);
        }
    });

    /*
 var dados = [dadosLocalizacao];
var dados1 = [dadosPedido];
var dados2=dados.concat(dados1);
DATA = dados2.concat(DATA);
*/
    var total = [{
        ntotal: cont
    }];

    DATA = total.concat(DATA);
    var dados = [dadosLocalizacao];

    DATA = dados.concat(DATA);

    console.log(DATA);

    INFO = new FormData();
    aInfo = JSON.stringify(DATA);

    INFO.append('data', aInfo);

    $.ajax({
        data: INFO,
        type: 'POST',
        url: './vistas/guardarTabela.php',
        processData: false,
        contentType: false,
        success: function(r) {
            $("#resposta").html(r);
            eliminarDados(cont);
        }
    });
};

function eliminarDados(cont) {
    cont = cont + 2;
    for (var i = 2; i < cont; i++) {

        document.getElementById('fila' + i).outerHTML = '';
    }
    $('#remover').addClass('ocultar');

};

function eliminar(pos) {
    var tabela = document.getElementById('tabelaP');
    var cont = (tabela.rows.length) - 1;
    if (cont == 3) {
        $('#remover').addClass('ocultar');
    }
    var res = document.getElementById('tdN9' + pos);
    document.getElementById('fila' + pos).outerHTML = '';
    calcularTotal();
};

function editar(pos) {
    var img = document.getElementById('img' + pos);
    var id = document.getElementById('id' + pos);
    var nome = document.getElementById('tdN2' + pos);
    var precio = document.getElementById('tdN3' + pos);
    var quantidade = document.getElementById('tdN4' + pos);
    var arroz = document.getElementById('tdN5' + pos);
    var pasta = document.getElementById('tdN6' + pos);
    var salsa = document.getElementById('tdN7' + pos);
    var btn = $('#btnAgregarLista');
    btn.attr('data-pos', pos);
    btn.attr('data-opera', 'editar');
    btn.attr('data-id', id.innerHTML);
    btn.attr('data-img', img.innerHTML);
    btn.attr('data-precio', precio.innerHTML);
    btn.attr('data-nome', nome.innerHTML);
    $('#valor').val(quantidade.innerHTML);
    $('#rango').val(quantidade.innerHTML);
    $('#arroz').val(arroz.innerHTML);
    $('#pasta').val(pasta.innerHTML);
    $('#salsa').val(salsa.innerHTML);
    $('#quantidade').html("$ " + precio.innerHTML + ".00 MX");
    $('#nome').html("Nome: " + nome.innerHTML);
    // alert("res: " + id);
    $('#modalimg').html('<img src="./assets/img/' + img.innerHTML + '" alt="" style="max-width:100%">');
    $('#modalAG').modal('open');
}
//-----------Javascript Puro---------------
var btnMenu = document.getElementById('btn-menu');
var nav = document.getElementById('nav');
btnMenu.addEventListener('click', function() {

    nav.classList.toggle('mostrar');
});
var casa = document.getElementsByClassName('menu__link')[0];
var pizzas = document.getElementsByClassName('menu__link')[1];
var conocenos = document.getElementsByClassName('menu__link')[2];
casa.addEventListener('click', function() {
    nav.classList.remove('mostrar');
});
pizzas.addEventListener('click', function() {
    nav.classList.remove('mostrar');
});
conocenos.addEventListener('click', function() {
    nav.classList.remove('mostrar');
});

var tiempo = setTimeout(trasladar, 1000);


function trasladar() {
    var banner = document.getElementById('banner');
    banner.style.transition = 'all 1.2s';
    banner.style.transform = 'translateX(-50%) translateY(-50%)';
}

var menu = document.getElementById('menu');
var comparepizza = document.getElementById('comparepizza');
var altura = menu.offsetTop;
window.addEventListener('scroll', function() {
    if (window.pageYOffset > altura) {

        menu.classList.add('fixed');
        comparepizza.classList.add('comparepizza-fixed');
    } else {
        menu.classList.remove('fixed');
        comparepizza.classList.remove('comparepizza-fixed');
    }
});