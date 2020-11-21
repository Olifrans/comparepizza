$(document).ready(function() {
    $("#contenedor").load('vistas/principal.php');

    //-----Substitua o conteúdo do rótulo div con #contenedor------------//
    
    $("#principal").click(function(event) {
        $("#contenedor").load('vistas/principal.php');
    });

});