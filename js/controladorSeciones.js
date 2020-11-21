 $(document).ready(function() {
     window.onload = verificarSesion();
     $('#btnCancelarDC').click(function(e) {
         $('#modalDadosPizzaria').modal('close');
     });
     $('#btnCancelarPizzariaS').click(function(e) {
         $('#modalPizzaria').modal('close');
     });
     $('#btnCancelarPizzariaC').click(function(e) {
         $('#modalPizzariaCriar').modal('close');
     });
     $('#btnCerrarSC').click(function(e) {
         document.location.href = './vistas/fecharSessaoPizzaria.php';
     });

     $('#btnPizzaria').click(function(e) {

         var idcli = $('#idPizzaria').text();

         if (idcli == "") {
             $('#modalPizzaria').modal('open');
         } else {
             $('#modalDadosPizzaria').modal('open');
         }

     });
     // Eventos de registro de Pizzarias  
     $("#btnCriar").click(function(event) {
         $('#modalPizzaria').modal('close');
         $('#modalPizzariaCriar').modal('open');
     });

     $('#btnLogarAdmin').click(function(event) {
         event.preventDefault();
         var nome = $('#userName').val();
         var senha = $('#senha').val();
         var parametros = {
             'no': nome,
             'co': senha
         };
         validarAdministrador(parametros);
     });

     $('#btnPizzariaS').click(function(event) {
         event.preventDefault();
         var nomeC = $('#usuarioC1').val();
         var senhaC = $('#senhaC1').val();
         var parametros = {
             'noc': nomeC,
             'coc': senhaC
         };

         validarPizzaria(parametros);
     });

 });
 //validar sessão do administrador
 function validarAdministrador(parametros) {
     $.ajax({
         data: parametros,
         url: "./vistas/validarAdmin.php",
         type: 'post',
         success: function(response) {
             if (response == "valido") {
                 // $.post('./home.php', {nome: "tcc"});
                 document.form1.submit();
                 //document.location.href='./home.php?n='+parametros.no;
             } else {
                 $("#resposta").text("Usuario ou senha incorretos");
             }
         }
     });
 };
 //validar sesão Pizzarias

 function validarPizzaria(parametros) {
     $.ajax({
         data: parametros,
         url: "./vistas/validarPizzaria.php",
         type: 'post',
         success: function(response) {
             if (response == "valido") {

                 Materialize.toast('Sessão iniciada corretamente', 5000, "rounded");
                 document.form2.submit();


             } else {
                 $("#respostaPizzaria").text("Nome ou senha errada");
             }
         }
     });
 };

 function verificarSesion() {
     var idcli = $('#idPizzaria').text();

     if (idcli == "") {

     } else {

         $('#btnPizzaria').text("Sesión");
         $('#btnCarrito').removeClass('ocultar');
     }
 }