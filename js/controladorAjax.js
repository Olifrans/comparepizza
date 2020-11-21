$(document).ready(function() {

    //---------EVENTOS------------
    //inicializacion de relog
    $('.timepicker').pickatime({
        default: 'now', // Set default time: 'now', '1:30AM', '16:30'
        fromnow: 0, // set default time to * milliseconds from now (using with default = 'now')
        twelvehour: false, // Use AM/PM or 24-hour format
        donetext: 'LISTO', // text for done-button
        cleartext: 'BORRAR', // text for clear-button
        canceltext: 'CANCELAR', // Text for cancel-button
        autoclose: false, // automatic close timepicker
        ampmclickable: false, // make AM PM clickable
        aftershow: function() {} //Function for after opening timepicker
    });
    //inicialização dos componentes
    $('select').material_select();
    $('.modal').modal();
    $('.collapsible').collapsible();
    $('ul.tabs').tabs();


    //evento de cargar dados de imagens
    $("#imagens").click(function(event) {
        cargarTabela("IMAGENS");
    });

    //evento de cargar dados de Pizzas
    $("#pizzas").click(function(event) {
        cargarTabela("PIZZAS");
    });
    //evento da carga dados do Menu
    $("#menuP").click(function(event) {
        cargarTabela("MENU");
    });
    //evento da carga dados do Admin
    $("#admin").click(function(event) {
        cargarTabela("ADMIN");
    });

    //evento de formatear fecha
    $("#formatofecha").click(function(event) {

        var fechainicio = $('#fechainicio').val();
        var fechafin = $('#fechafin').val();

        var parametros = {
            'fechain': fechainicio,
            'fechafi': fechafin,
            'validar': "filtrar"
        };
        filtrarVendas(parametros);
    });
    //evento del boton editar IMAGENS
    $('button[id=btnEditarImg]').click(function(event) {
        var dados = $(this).data("id");
        var nome = $(this).val();
        $('#nome-imga').val(nome);
        $('#id').val(dados);
        $('#eliminar').val(nome);
        $('#tabela').val("IMAGENS");
        //$('#list1').html('<img src="./assets/img/'+nome+'" alt="">');
        $('#modalAI').modal('open');

    });
    //evento do botão editar Pizzas
    $('button[id=btnEditarP]').click(function(event) {
        var dados = $(this).data("id");
        var dia = $(this).data("dia");
        var idimg = $(this).data("img");
        var id = $(this).val();
        var p = $(this).parent();
        var chave = p.siblings('td')[0].innerHTML;
        var nome = p.siblings('td')[1].innerHTML;
        var quantidade = p.siblings('td')[2].innerHTML;
        var preco = p.siblings('td')[3].innerHTML;
        var nomeimg = p.siblings('td')[5].innerHTML;
        var nomedia = p.siblings('td')[6].innerHTML;
        $('#chavePizzaA').val(chave);
        $('#nomePizzaA').val(nome);
        $('#quantidadePizzaA').val(quantidade);
        $('#precoPizzaA').val(preco);
        $('#idA').val(id);
        $('#btnActulizarP').val(dados);
        $('#nomeimgA').val(nomeimg);
        $('#idMenuA').val(dia);
        $('#menuDiaPA').val(nomedia);
        $('#idA').val(idimg);
        $('#modalAI').modal('open');
    });
    //evento do botão editar admin
    $('button[id=btnEditarAdmin]').click(function(event) {
        var contar = $(this).data("senha");
        var nome = $(this).data("nome");
        var chave = $(this).data("id");
        $('#nomeAdminA').val(nome);
        $('#senhaAdminA').val(contar);
        $('#btnActualizarAdmin').val(chave);
        $('#modalAAdmin').modal('open');

    });

    $('button[id=btnSeleccionDia]').click(function(event) {
        event.preventDefault();
        var valor = $(this).val();
        $('#diaMenuActualizar').val(valor);
        $('ul[class=collapsible]').collapsible('close', 0);
    });
    //evento de selecionar dia en Guardar Menu
    $('button[id=btnSeleccionDiaG]').click(function(event) {
        event.preventDefault();
        var valor = $(this).val();
        $('#diaMenuG').val(valor);
        $('ul[class=collapsible]').collapsible('close', 0);
    });
    //selecionar dia en Pizzas guardar
    $('button[id=btnSelectMenu]').click(function(event) {
        event.preventDefault();
        var idM = $(this).data("idm");
        var dia = $(this).data("dia");

        $('#idMenu').val(idM);
        $('#menuDiaP').val(dia);

        $('ul[class=collapsible]').collapsible('close', 0);
    });
    //selecionar dia en Pizzas actualizar 
    $('button[id=btnSelectMenuA]').click(function(event) {
        event.preventDefault();
        var idM = $(this).data("idm");
        var dia = $(this).data("dia");

        $('#idMenuA').val(idM);
        $('#menuDiaPA').val(dia);

        $('ul[class=collapsible]').collapsible('close', 0);
    });


    $("#btnCalcular").click(function(event) {

        calcularPrecioTotalVendas();
    });

    //evento do botão  boto editar Pizzas
    $('button[id=btnEditarM]').click(function(event) {

        var dados = $(this).data("id");
        var id = $(this).val();
        var p = $(this).parent();
        var chave = p.siblings('td')[0].innerHTML;
        var dia = p.siblings('td')[1].innerHTML;
        var promociones = p.siblings('td')[2].innerHTML;
        var horaapeA = p.siblings('td')[3].innerHTML;
        var horacierreA = p.siblings('td')[4].innerHTML;

        $('#diaMenuActualizar').val(dia);
        $('#promocionMA').val(promociones);
        $('#horaapeMA').val(horaapeA);
        $('#horacierMA').val(horacierreA);
        $('#btnActulizarM').val(dados);
        $('#modalAI').modal('open');
    });
    //evento de suvir imagen al servidor y guardar
    $('#form-subir').submit(function(event) {
        event.preventDefault();
        var dados = this;
        var validar = $('#btnValidar').val()
        if (validar == "true") {
            $('#nome-img').val("");
            $('#modalGI').modal('close');
            Subirimg(dados);
        };
    });
    //evento del boton actualizar imagen en el servidor y bd
    $('#form-actualizar').submit(function(event) {
        event.preventDefault();
        var formData = new FormData(document.getElementById("form-actualizar"));
        formData.append("dato", "valor");
        $('#nome-imga').val("");
        $('#id').val("");
        $('#eliminar').val("");
        $('#modalAI').modal('close');
        actualizarimg(formData);
    });
    //evento del boton guardar Pizzas
    $('#btnGuardarPizzas').click(function(event) {
        var validar = $('#chavePizza').val();
        var nome = $('#nomePizza').val();
        var img = $('#id').val();
        var idMenu = $('#idMenu').val();
        if (validar.length > 0 && nome.length > 0 && img.length > 0 && idMenu.length > 0) {
            var parametros = {
                'chave': validar,
                'nome': nome,
                'quantidade': $('#quantidadePizza').val(),
                'precio': $('#precioPizza').val(),
                'idimg': img,
                'idmenu': idMenu,
                'tabela': "PIZZAS"
            };
            limpiarFormPizzas();
            $('#modalGI').modal('close');
            guardarDados(parametros);

        } else {
            Materialize.toast('Ingresa una chave,nome, día y imagen', 6000);
        }

    });

    //evento do botão guardar Menu
    $('#btnGuardarMenu').click(function(event) {

        var dia = $('#diaMenuG').val();
        var promo = $('#promocionM').val();
        var hoape = $('#horaapeM').val();
        var hocierre = $('#horacierM').val();
        if (dia.length > 0 && hoape.length > 0 && hocierre.length > 0) {
            var parametros = {
                'dia': dia,
                'pro': promo,
                'ha': hoape,
                'hc': hocierre,
                'tabela': "MENU"
            };
            limpiarFormMenu();
            $('#modalGI').modal('close');
            guardarDados(parametros);

        } else {
            Materialize.toast('Insira o dia, horário de abertura e horário de fechamento', 5000);
        }

    });
    //evento del boton guardar Admin
    $('#btnGuardarAdmin').click(function(event) {

        var nomead = $('#nomeAdmin').val();

        var senhaad = $('#senhaAdmin').val();


        if (nomead.length > 0 && senhaad.length > 0) {
            var parametros = {
                'nomeadmin': nomead,
                'senhaadmin': senhaad,
                'tabela': "ADMIN"
            };
            limpiarFormAdmin();

            $('#modalGAdmin').modal('close');
            guardarDados(parametros);

        } else {
            Materialize.toast('Digite seu nome e senha', 6000);
        }

    });
    //evento do botão tualizar Adminn
    $('#btnActualizarAdmin').click(function(event) {
        var id = $(this).val();
        var nomead = $('#nomeAdminA').val();
        var senhaad = $('#senhaAdminA').val();

        if (nomead.length > 0 && senhaad.length > 0) {
            var parametros = {
                'idadmin': id,
                'nomeadmin': nomead,
                'senhaadmin': senhaad,
                'tabela': "ADMIN"
            };
            limpiarFormAdminA();

            $('#modalAAdmin').modal('close');
            actualizarDados(parametros);

        } else {
            Materialize.toast('Digite seu nome e senha', 6000);
        }

    });
    //evento do botão tualizar  Pizzas
    $('#btnActulizarP').click(function(event) {
        var id = $(this).val();
        var validarA = $('#chavePizzaA').val();
        var nomeA = $('#nomePizzaA').val();
        var quantidadeA = $('#quantidadePizzaA').val();
        var precoA = $('#precioPizzaA').val();
        var idMenuA = $('#idMenuA').val();
        var imgA = $('#idA').val();
        if (validarA.length > 0 && nomeA.length > 0 && imgA.length > 0 && idMenuA.length > 0) {
            var parametros = {
                "tabela": "PIZZAS",
                "id": id,
                "chave": validarA,
                "nome": nomeA,
                "quantidade": quantidadeA,
                "precio": precoA,
                "idimg": imgA,
                "idmenu": idMenuA
            };

            $('#modalAI').modal('close');
            actualizarDados(parametros)
        } else {
            Materialize.toast('Ingresa una chave,nome, día y imagen', 6000);
        }
    });

    //evento do botão tualizar   Menu
    $('#btnActulizarM').click(function(event) {
        var id = $(this).val();
        var dia = $('#diaMenuActualizar').val();
        var promo = $('#promocionMA').val();
        var hoape = $('#horaapeMA').val();
        var hocierre = $('#horacierMA').val();
        if (dia.length > 0 && hoape.length > 0 && hocierre.length > 0) {
            var parametros = {
                "id": id,
                "dia": dia,
                "pro": promo,
                "ha": hoape,
                "hc": hocierre,
                "tabela": "MENU"
            };

            $('#modalAI').modal('close');
            actualizarDados(parametros)

        } else {
            Materialize.toast('Ingresa el día, hora de apertura y hora de cierre', 5000);
        }

    });

    //evento de selecionar imagen en Guardar Pizzas
    $('button[id=btnSeleccionGurdarP]').click(function(event) {
        event.preventDefault();
        var idimg = $(this).data("idimg");
        var nome = $(this).data("nom");
        $('#nomeimg').val(nome);
        $('#id').val(idimg);
        $('ul[class=collapsible]').collapsible('close', 0);
    });

    //evento de selecionar imagen en Actualizar Pizzas
    $('button[id=btnSeleccionActualizarP]').click(function(event) {
        event.preventDefault();
        var dados = $(this).data("id");
        var id = $(this).val();
        $('#nomeimgA').val(dados);
        $('#idA').val(id);
        $('ul[class=collapsible]').collapsible('close', 0);
    });

    //evento de cerrar modal IMAGENS
    $('#btnCancelar').click(function(event) {
        $('#nome-img').val("");
        $('#modalGI').modal('close');
    });
    //evento de cerrar modal Admin
    $('#btnCancelarAdmin').click(function(event) {
        //$('#nome-img').val("");
        $('#modalGAdmin').modal('close');
    });
    $('#btnCancelarAdminA').click(function(event) {
        //$('#nome-img').val("");
        $('#modalAAdmin').modal('close');
    });
    //evento de eliminar IMAGENS--------------
    $('button[id=btnEliminarImg]').click(function(e) {
        var dados = $(this).data("id");
        var $toastContent = $('<span>Desea eliminar este dato</span>').add($('<button onclick="siEliminarImg(' + dados + ')" class="btn-flat toast-action">Si</button><button onclick="no()" class="btn-flat toast-action">No</button>'));
        Materialize.toast($toastContent, 5000);
    });
    //evento de eliminar Pizzas--------------
    $('button[id=btnEliminarP]').click(function(e) {
        var dados = $(this).data("id");
        var $toastContent = $('<span>Desea eliminar este dato</span>').add($('<button onclick="siEliminarP(' + dados + ')" class="btn-flat toast-action">Si</button><button onclick="no()" class="btn-flat toast-action">No</button>'));
        Materialize.toast($toastContent, 5000);
    });
    //evento de eliminar Menu--------------
    $('button[id=btnEliminarMenu]').click(function(e) {
        var dados = $(this).data("id");
        var $toastContent = $('<span>Desea eliminar este dato</span>').add($('<button onclick="siEliminarM(' + dados + ')" class="btn-flat toast-action">Si</button><button onclick="no()" class="btn-flat toast-action">No</button>'));
        Materialize.toast($toastContent, 5000);
    });
    //evento de eliminar Admin--------------
    $('button[id= btnEliminarAdmin]').click(function(e) {
        var dados = $(this).data("id");
        var $toastContent = $('<span>Desea eliminar este Administrador</span>').add($('<button onclick="siEliminarAdmin(' + dados + ')" class="btn-flat toast-action">Si</button><button onclick="no()" class="btn-flat toast-action">No</button>'));
        Materialize.toast($toastContent, 5000);
    });

    //evento del boton nuevo registro abre un modal limpio
    $('#btn-modal').click(function(event) {
        $('#modalGI').modal('open');
        //$('#modalGI').modal('open');
    });
    //evento del boton nuevo registro abre un modal limpio Adminstrador
    $('#btn-modalAdmin').click(function(event) {
        $('#modalGAdmin').modal('open');
        //$('#modalGI').modal('open');
    });
    //////////evento Vendas   

    $('button[id=botonMapa]').click(function(event) {
        var ubiadmin = $(this).data("ubi");

        $('#modalMapa').modal('open');
        //localizacaoComparepizza(ubiadmin);
        findMe(ubiadmin);

        var btn = $('#administradorUbi');
        btn.attr('data-ubi', ubiadmin);
    });

    $('#administradorUbi').click(function(event) {
        var ubiadmin = $(this).data("ubi");
        findMe(ubiadmin);
        $(this).removeData("ubi");
    });
    $('a[id=btnCancelarLocalizacao]').click(function(event) {
        $('#modalMapa').modal('close');
    });
    $('.btn-vender').click(function(e) {
        var total = $(this).data("total");
        var id = $(this).data("id");
        e.preventDefault();
        swal({
            title: "REALIZAR VENDA",
            text: "Total del Pedido: $ " + total + ".00 MX",
            type: "input",
            showCancelButton: true,
            closeOnConfirm: false,
            animation: "slide-from-top",
            inputPlaceholder: "Ingresa La quantidade Recivida",
            confirmButtonText: "Realizar Venta",
            cancelButtonText: "Cancelar"
        }, function(inputValue) {
            if (inputValue === false) return false;
            if (inputValue === "" || inputValue < total || (isNaN(inputValue))) {
                swal.showInputError("Ingresa Una quantidade Mayor al Total");
                return false
            }
            swal("", "El cambio es: $" + (inputValue - total) + ".00 MX", "success");
            realizarVenta(total, id);
        });
    });

    $('button[id=btnAceptar]').click(function(event) {


        var id = $(this).data("id");
        var parametros = {
            'id': id,
            'estado': "aceptado"

        };
        actualizarEstadoPedidos(parametros);


    });
    $('button[id=btnRechazar]').click(function(event) {
        var id = $(this).data("id");
        var parametros = {
            'id': id,
            'estado': "rechazado"
        };
        actualizarEstadoPedidos(parametros);
    });

    /////////////-------NOTIFICACIONES-------/////////////////// 

    setInterval("calcularAutomatico()", 2000);
    setInterval("actualizar()", 9000);
});



function calcularAutomatico() {
    var valor = $('#IngresoTotal').text();
    if (valor == "0") {
        $("#btnCalcular").click();
    }
}


function actualizar() {
    var parametros = {
        'tabela': "PENDENTE"
    };
    $.ajax({
        data: parametros,
        url: "./vistas/actualizar.php",
        type: 'post',

        success: function(response) {
            if (response != "0") {
                Materialize.toast('Tienes: ' + response + ' Pedidos Nuevos', 8000, "rounded");
                document.getElementById('alerta').play();
                Materialize.toast('Actualiza tu lista de pedidos', 8000, "rounded");
                $('#actualizar').text(response);
                $('#notificacion').text(response);
            }
        }
    });

};




//Mostrar mapa
var arregloPines = [];

function findMe(ubi) {
    var divConte = document.getElementById('mapa');
    if (navigator.geolocation) {
        divConte.innerHTML = "<p> Teu navegador suporta geolocalizacion</p>";
    } else {
        divConte.innerHTML = "<p> Não suporta</p>";
    }
    navigator.geolocation.getCurrentPosition(localizacion, error);

    function localizacion(posicion) {
        var latitude = posicion.coords.latitude;
        var longitude = posicion.coords.longitude;
        var latLng = new google.maps.LatLng(latitude, longitude);

        var nuevo = ubi.substr(1, (ubi.length) - 2);
        var corte1 = nuevo.indexOf(",");
        var lati = nuevo.substr(0, corte1);
        var long = nuevo.substr(corte1 + 1, nuevo.length);
        var localizacaoPizzaria = new google.maps.LatLng(lati, long);

        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer({
            suppressMarkers: true
        });
        var map = new google.maps.Map(document.getElementById('mapa'), {
            zoom: 19,
            gestureHandling: 'cooperative',
            center: latLng
        });
        directionsDisplay.setMap(map);
        comparepizzaInfo(map, latLng);
        pizzariaInfo(map, localizacaoPizzaria);
        calculateAndDisplayRoute(latLng, localizacaoPizzaria, directionsService, directionsDisplay);
        map.addListener('click', function(e) {
            var nuevaUbi = e.latLng;
            for (var i in arregloPines) {
                arregloPines[i].setMap(null);
            }
            // map.setDirections(null);
            comparepizzaInfo(map, nuevaUbi);
            pizzariaInfo(map, localizacaoPizzaria);
            calculateAndDisplayRoute(nuevaUbi, localizacaoPizzaria, directionsService, directionsDisplay);
        });
    };

    function calculateAndDisplayRoute(latLng, localizacaoPizzaria, directionsService, directionsDisplay) {
        directionsService.route({
            origin: latLng,
            destination: localizacaoPizzaria,
            travelMode: 'DRIVING'
        }, function(response, status) {
            if (status === 'OK') {
                directionsDisplay.setDirections(response);
            } else {
                Materialize.toast('Não foi possível rastrear a rota', 5000);
            }
        });
    }

    function error() {
        Materialize.toast('Não foi possível obter seu local', 5000);
    }
}

function localizacaoComparepizza(ubi) {
    var nuevo = ubi.substr(1, (ubi.length) - 2);
    var corte1 = nuevo.indexOf(",");
    var lati = nuevo.substr(0, corte1);
    var long = nuevo.substr(corte1 + 1, nuevo.length);
    var localizacaoPizzaria = new google.maps.LatLng(lati, long);
    var map = new google.maps.Map(document.getElementById('mapa'), {
        center: localizacaoPizzaria,
        zoom: 19,
        gestureHandling: 'cooperative'
    });
    comparepizzaInfo(map, localizacaoPizzaria);
}

function comparepizzaInfo(map, comparepizza) {
    var contentString = '<div id="conte-pizzaria">' +
        '<div id="cont-imgcli"><img src="./imgpg/Comparepizza-v6.png" alt="" id="pizzaria">' +
        '</div>' +
        '</div>';
    var infowindow = new google.maps.InfoWindow({
        content: contentString
    });
    var marker = new google.maps.Marker({
        map: map,
        position: comparepizza,
        title: 'ComparePizza'
    });
    arregloPines.push(marker);
    marker.addListener('click', function() {
        infowindow.open(map, marker);
    });
}

function pizzariaInfo(map, latLng) {
    var contentStringCli = '<div id="conte-pizzaria">' +
        '<div id="cont-imgcli"><img src="./imgpg/pizzarialocalizacao.png" alt="" id="pizzaria">' +
        '</div>' +
        '</div>';
    var infowindow = new google.maps.InfoWindow({
        content: contentStringCli
    });
    var marker = new google.maps.Marker({
        map: map,
        position: latLng,
        title: 'As Pizzarias'
    });
    arregloPines.push(marker);
    marker.addListener('click', function() {
        infowindow.open(map, marker);
    });
};
///////////------FIN-----LISTADO PEDIDOS---------/////////////////


//Visualizar e validar Imagen
function archivo(evt) {
    var ext = document.getElementById("files").value;
    ext = ext.substring(ext.length - 3, ext.length);
    ext = ext.toLowerCase();
    if (ext == 'png' || ext == 'jpg' || ext == 'PNG' || ext == 'JPG') {
        $('#btnValidar').val("true");
        var files = evt.target.files; // FileList object
        // Obtenemos la imagen del campo "file".
        for (var i = 0, f; f = files[i]; i++) {
            //Apenas imagens.
            if (!f.type.match('image.*')) {
                continue;
            }
            var reader = new FileReader();
            reader.onload = (function(theFile) {
                return function(e) {
                    // Insertamos la imagen
                    document.getElementById("list").innerHTML = ['<img style="max-width: 100%;" src="', e.target.result, '" title="', escape(theFile.name), '"/>'].join('');
                };
            })(f);
            reader.readAsDataURL(f);
        }
    } else {
        $('#btnValidar').val("false");
        Materialize.toast('Tu archivo es: ' + ext +
            ' Solo se admiten archivos JPG Y PNG', 5000, "rounded");
        document.getElementById("list").innerHTML = '<h3>Solo se admiten archivos JPG Y PNG</h3>';
    }
};
document.getElementById('files').addEventListener('change', archivo, false);





//---------FUNCIONES--------
//funcion eliminar dados IMAGENS
function siEliminarImg(dados) {
    var parametros = {
        "dados": dados,
        "tabela": "IMAGENS",
        "campo": "chaveImg"
    };
    eliminar(parametros);
}
//funcion eliminar dados Pizzas
function siEliminarP(dados) {
    var parametros = {
        "dados": dados,
        "tabela": "PIZZAS",
        "campo": "IdPizza"
    };
    eliminar(parametros);
}
//funcion eliminar dados Menu
function siEliminarM(dados) {
    var parametros = {
        "dados": dados,
        "tabela": "MENU",
        "campo": "IdMenu"
    };
    eliminar(parametros);
}
//funcion eliminar dados admin
function siEliminarAdmin(dados) {
    var parametros = {
        "dados": dados,
        "tabela": "ADMIN",
        "campo": "IdAdmin"
    };
    eliminar(parametros);
}
//funcion de rechaso Eliminar------
function no() {
    Materialize.Toast.removeAll();
}
//----------funciones ajax-----------
//funcion cargar tabelas
function cargarTabela(tabela) {
    var parametros = {
        'tabela': tabela
    };
    $.ajax({
        data: parametros,
        url: "./vistas/Cargardados.php",
        type: 'post',
        beforeSend: function() {
            $("#contenedor").load('/vistas/loader.php');
        },
        success: function(response) {
            $("#contenedor").html(response);
        }
    });
};
//funcion eliminar dados
function eliminar(parametros) {
    $.ajax({
        data: parametros,
        url: "./vistas/eliminardados.php",
        type: 'post',
        beforeSend: function() {
            $("#contenedor").load('vistas/loader.php');
        },
        success: function(response) {
            $("#contenedor").html(response);
            cargarTabela(parametros.tabela);
        }
    });
};
//funcion guardar dados
function guardarDados(parametros) {
    $.ajax({
        data: parametros,
        url: "./vistas/guardardados.php",
        type: 'post',
        beforeSend: function() {
            $("#contenedor").load('vistas/loader.php');
        },
        success: function(response) {
            $("#contenedor").html(response);
            cargarTabela(parametros.tabela);

        }
    });

};
//funcion de actualizar Imagen en el servidor y bd
function actualizarimg(formData) {
    $.ajax({
        url: './vistas/actualizardados.php',
        type: 'post',
        contentType: false,
        dataType: 'html',
        data: formData,
        processData: false,
        cache: false,
        beforeSend: function() {
            $("#contenedor").load('vistas/loader.php');
        },
        success: function(response) {
            $("#contenedor").html(response);
            cargarTabela("IMAGENS");
        }
    });
};
//funcion de subir al servidor y guardar IMAGENS
function Subirimg(form) {
    var archivo = new FormData(form);

    $.ajax({
        url: './vistas/subir.php',
        type: 'post',
        contentType: false,
        dataType: 'html',
        data: archivo,
        processData: false,
        cache: false,
        beforeSend: function() {
            $("#contenedor").load('vistas/loader.php');
        },
        success: function(response) {
            $("#contenedor").html(response);
            cargarTabela("IMAGENS");

        }
    });

};
//funcion actualizar dados
function actualizarDados(parametros) {
    $.ajax({
        data: parametros,
        url: "./vistas/actualizardados.php",
        type: 'post',
        beforeSend: function() {
            $("#contenedor").load('vistas/loader.php');
        },
        success: function(response) {
            $("#contenedor").html(response);
            cargarTabela(parametros.tabela);
        }
    });
};


//funcion limpiar dados del formulario Pizzas
function limpiarFormPizzas() {
    $('#chavePizza').val("");
    $('#nomePizza').val("");
    $('#quantidadePizza').val("");
    $('#precioPizza').val("")
    $('#id').val("");
    $('#idMenu').val("");
    $('#menuDiaP').val("");
    $('#nomeImg').val("");
};

//funcion limpiar dados del formulario Menu
function limpiarFormMenu() {
    $('#diaM').val("");
    $('#promocionM').val("");
    $('#horaapeM').val("");
    $('#horacierM').val("");
};

function limpiarFormAdmin() {
    $('#nomeAdmin').val("");
    $('#senhaAdmin').val("");
};

function limpiarFormAdminA() {
    $('#nomeAdminA').val("");
    $('#senhaAdminA').val("");
}
/*
$('#senhaAdminA').val("");
}*/