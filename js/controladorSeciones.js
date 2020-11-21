 $(document).ready(function() {
     window.onload = verificarSesion();
     $('#btnCancelarDC').click(function(e) {
         $('#modalDadosPizzaria').modal('close');
     });
     $('#btnCancelarPizzariasS').click(function(e) {
         $('#modalPizzarias').modal('close');
     });
     $('#btnCancelarPizzariasC').click(function(e) {
         $('#modalPizzariasCriar').modal('close');
     });
     $('#btnCerrarSC').click(function(e) {
         document.location.href = './vistas/fecharSessaoPizzaria.php';
     });

     $('#btnPizzarias').click(function(e) {

         var idcli = $('#idPizzaria').text();

         if (idcli == "") {
             $('#modalPizzarias').modal('open');
         } else {
             $('#modalDadosPizzaria').modal('open');
         }

     });
     // Eventos de registro de Pizzarias  
     $("#btnCriar").click(function(event) {
         $('#modalPizzarias').modal('close');
         $('#modalPizzariasCriar').modal('open');
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

     $('#btnPizzariasS').click(function(event) {
         event.preventDefault();
         var nomeC = $('#usuarioC1').val();
         var senhaC = $('#senhaC1').val();
         var parametros = {
             'noc': nomeC,
             'coc': senhaC
         };

         validarPizzarias(parametros);
     });

 });
 //validar secion de administrador
 function validarAdministrador(parametros) {
     $.ajax({
         data: parametros,
         url: "./vistas/validarAdmin.php",
         type: 'post',
         success: function(response) {
             if (response == "valido") {
                 // $.post('./home.php', {nome: "gerardo"});
                 document.form1.submit();
                 //document.location.href='./home.php?n='+parametros.no;
             } else {
                 $("#resposta").text("Usuario ou senha incorretos");
             }
         }
     });
 };
 //validar secion de Pizzarias

 function validarPizzarias(parametros) {
     $.ajax({
         data: parametros,
         url: "./vistas/validarPizzarias.php",
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

         $('#btnPizzarias').text("Sesión");
         $('#btnCarrito').removeClass('ocultar');
     }
 }