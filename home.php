<?php
session_start();


 $iniciadoU=$_SESSAO['usuario'];
if($_POST['nome']==$iniciadoU &&$_POST['senha']==$senha=$_SESSAO['senha']){
    
}else{
     header("Location:sessoes.html");
}
  $idAdmin=$_SESSAO['idadmin'];
    $senha=$_SESSAO['senha'];
if($iniciadoU==null||$iniciadoU==''){
  header("Location:sessoes.html");
}   
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Painel de Controle</title>
    <!-- Normalize CSS -->
    <link rel="stylesheet" href="css/normalize.css">
    <!-- Materialize CSS -->
    <link rel="stylesheet" href="css/materialize.css">
    <!-- Material Design Iconic Font CSS -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/material-design-iconic-font.min.css">
    <!-- Malihu jQuery custom content scroller CSS -->
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.css">
    <!-- Sweet Alert CSS -->
    <link rel="stylesheet" href="css/sweetalert.css">
    <!-- MaterialDark CSS -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="css/mapa.css">

       
</head>

<body>
   
    <!-- Nav Lateral -->
    <audio id="alerta" src="assets/audio/alerta.mp3" preload="auto"></audio>  
    <section class="NavLateral full-width">
        <div class="NavLateral-FontMenu full-width ShowHideMenu"></div>
        <div class="NavLateral-content full-width">
            <header class="NavLateral-title full-width center-align">
                Comparepizza<i class="tccpizza tccpizza-close NavLateral-title-btn ShowHideMenu"></i>
            </header>
            <figure class="full-width NavLateral-logo">
                <img src="assets/img/logo.png" alt="material-logo" class="responsive-img center-box">
                <figcaption class="center-align">Sistema ComparePizza </figcaption>
            </figure>
            <div class="NavLateral-Nav">
                <ul class="full-width">
                    <li>
                        <a id="principal" class="waves-effect waves-light"><i class="large material-icons">insert_chart</i> Panel Principal</a>
                    </li>
                    <li class="NavLateralDivider"></li>
                 
                    <li class="NavLateralDivider"></li>
                    <li>
                        <a href="#" class="NavLateral-DropDown  waves-effect waves-light"><i class="tccpizza tccpizza-view-web tccpizza-hc-fw"></i> <i class="tccpizza tccpizza-chevron-down NavLateral-CaretDown"></i>Operaciones </a>
                        <ul class="full-width">
                            <li><a id="menuP" class="waves-effect waves-light">Menú</a></li>
                            <li class="NavLateralDivider"></li>
                            <li><a id="pizzas" class="waves-effect waves-light">Pizzas</a></li>
                            <li class="NavLateralDivider"></li>
                            <li><a id="Imagens" class="waves-effect waves-light">Imagens</a></li>
                            <li class="NavLateralDivider"></li>
                            <li><a id="admin" class="waves-effect waves-light">Admin</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </section>


    <!-- Page content -->
    <section class="ContentPage full-width">
        <!-- Nav Info -->
        <div class="ContentPage-Nav full-width">
            <ul class="full-width">
                <li class="btn-MobileMenu ShowHideMenu"><a href="#" class="tooltipped waves-effect waves-light" data-position="bottom" data-delay="50" data-tooltip="Menu"><i class="tccpizza tccpizza-more-vert"></i></a></li>
                <li>
                    <figure><img src="assets/img/user.png" alt="UserImage"></figure>
                </li>
                <li id="idAdmin" style="padding:0 5px;display:none;"><?php echo $idAdmin; ?></li>
                <li  style="padding:0 5px;"><?php echo $iniciadoU; ?></li>
                <li><a href="#" class="tooltipped waves-effect waves-light btn-ExitSystem" data-position="bottom" data-delay="50" data-tooltip="Cerrar sessoes"><i class="tccpizza tccpizza-power"></i></a></li>
              
                <li>
                    <a href="#" class="tooltipped waves-effect waves-light btn-Notification" data-position="bottom" data-delay="50" data-tooltip="Notificaciones">
						<i class="tccpizza tccpizza-notificacoes"></i>
						<span id="notificacion" class="ContentPage-Nav-indicator bg-danger">0</span>
					</a>
                </li>
            </ul>
        </div>



        
        <!-- Notificacoes area -->
        <section class="z-depth-3 NotificationArea">
            <div class="full-width center-align NotificationArea-title">Notificacoes <i class="tccpizza tccpizza-close btn-Notification"></i></div>
            <a href="#" class="waves-effect Notification">
                <div class="Notification-icon"><i class="tccpizza tccpizza-accounts-alt bg-info"></i></div>
                <div class="Notification-text">
                    <p>
                        <i class="tccpizza tccpizza-circle tooltipped" data-position="left" data-delay="50" data-tooltip="Notification as UnRead"></i>
                        <strong>New User Registration</strong>
                        <br>
                        <small>Just Now</small>
                    </p>
                </div>
            </a>
            <a href="#" class="waves-effect Notification">
                <div class="Notification-icon"><i class="tccpizza tccpizza-cloud-download bg-primary"></i></div>
                <div class="Notification-text">
                    <p>
                        <i class="tccpizza tccpizza-circle-o tooltipped" data-position="left" data-delay="50" data-tooltip="Notification as Read"></i>
                        <strong>New Updates</strong>
                        <br>
                        <small>30 Mins Ago</small>
                    </p>
                </div>
            </a>
            <a href="#" class="waves-effect Notification">
                <div class="Notification-icon"><i class="tccpizza tccpizza-upload bg-success"></i></div>
                <div class="Notification-text">
                    <p>
                        <i class="tccpizza tccpizza-circle tooltipped" data-position="left" data-delay="50" data-tooltip="Notification as UnRead"></i>
                        <strong>Upload de arquivo</strong>
                        <br>
                        <small>31 Mins Ago</small>
                    </p>
                </div>
            </a>
            <a href="#" class="waves-effect Notification">
                <div class="Notification-icon"><i class="tccpizza tccpizza-mail-send bg-danger"></i></div>
                <div class="Notification-text">
                    <p>
                        <i class="tccpizza tccpizza-circle-o tooltipped" data-position="left" data-delay="50" data-tooltip="Notification as Read"></i>
                        <strong>New Mail</strong>
                        <br>
                        <small>37 Mins Ago</small>
                    </p>
                </div>
            </a>
            <a href="#" class="waves-effect Notification">
                <div class="Notification-icon"><i class="tccpizza tccpizza-folder bg-primary"></i></div>
                <div class="Notification-text">
                    <p>
                        <i class="tccpizza tccpizza-circle-o tooltipped" data-position="left" data-delay="50" data-tooltip="Notification as Read"></i>
                        <strong>Folder delete</strong>
                        <br>
                        <small>1 hours Ago</small>
                    </p>
                </div>
            </a>
        </section>
   
        <div class="row" id="contenedor">
        </div>
           
         <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAR7w704943DI7DGQ6_yLV0RgxVu4Xv2SQ" async defer></script>

  <!---------Modal dados del Mapa---------->
 <div id="modalMapa" class="modal modal-fixed-footer">
<div class="modal-content">

<!--Input fields-->
<div class="container" id="mapa">

    </div>
    </div>
    <div class="modal-footer">
     <td>
       <a id="administradorUbi" type="submit" class="waves-effect waves-light btn">Localização</a>
    
    <a id="btnCancelarLocalizacao" class="
            modal-action waves-effect waves-light red btn">Cancelar</a>
    </td>

    </div>
</div>
 <!---------Fin modal----------> 
        <!-- Footer -->
        <footer class="footer-MaterialDark">
            <div class="container">
                <div class="row">
                    <div class="col l6 s12">
                       
                        <p class="grey-text text-lighten-12">
			    Somos uma equipe jovem e empenhada, com uma visão da importância das novas tecnologias no desenvolvimento da sociedade.
                        </p>
                    </div>
                   
                </div>
            </div>
            <div class="NavLateralDivider"></div>
            <div class="footer-copyright">
                <div class="container center-align">
                    © 2020 GIRATEC
                </div>
            </div>
        </footer>
    </section>
    <!-- Sweet Alert JS -->
    <script src="js/sweetalert.min.js"></script>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
    <script>
        window.jQuery || document.write('<script src="js/jquery-1.10.1.min.js"><\/script>')
    </script>
  
    <!-- Materialize JS -->
    <script src="js/materialize.js"></script>
    <!-- Malihu jQuery custom content scroller JS -->
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- MaterialDark JS -->
    <script src="js/main.js"></script>
   
    <script src="js/cargarCodigo.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/controladorAjax.js"></script>
    
</body>

</html>