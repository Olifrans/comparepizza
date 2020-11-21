
<?php
error_reporting(0);
session_start();
$inic=$_SESSAO['usu'];
$idcli=$_SESSAO['idc'];
$senhac=$_SESSAO['senhac'];
$nome=$_SESSAO['nome'];
$telefone=$_SESSAO['telefone'];


if($_POST['usuarioS']=="" && $_POST['senhaS']==""){
    $idc="";
if($inic==null||$inic==''){
 $idc="";
}
}else{
    $idc=$idcli;
}

?>


<!DOCTYPE html5>
<html lang="pt-br">

<head>
    <title>TCC FAM Comparepizza</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-
	scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">

    <meta http-equiv="Pragma" content="no-cache">
    <link rel="stylesheet" href="csspg/materialize.css">
    <link rel="stylesheet" href="csspg/styles.css">
    <link rel="stylesheet" href="csspg/estilos.css">
    <link href="csspg/main.css" rel="stylesheet" />
    <link rel="stylesheet" href="csspg/mapa.css">
    <script src="js/jquery-1.10.1.min.js"></script>
    <script src="js/Saltos.js"></script>

</head>



<body>
  
    <script>
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = 'https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.10';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>


    <div id="Home" style=" width: 100%; height: 800px;" data-vide-bg="videopg/banner" data-vide-options=" loop: false, silenciado: false, posición: 0% 0% ">


        </ div>
        <header class="header" id="menu">
            <div class="contenedor">
                <h1 class="logo"><img src="imgpg/Comparepizza-v6.png" alt="" class="logo__comparepizza" id="comparepizza"></h1>
                <span class="icon-menu" id="btn-menu"></span>
                <nav class="nav" id="nav">
                    <ul class="menu">
                        <li class="menu__item"><a class="menu__link waves-effect waves-light" href="#Home">Home</a></li>
                        <li class="menu__item"><a class="menu__link waves-effect waves-light" href="#Buscar">Buscar</a></li>
                        <li class="menu__item"><a class="menu__link waves-effect waves-light" href="#Mapa">Mapa</a></li>
                        <li class="menu__item"><a class="menu__link waves-effect waves-light" id="btnPizzaria">Pizzaria</a></li>
                 
                        <li class="menu__item"><a class="menu__link waves-effect waves-light" href="sessoes.html">Administrador</a></li>
                      
                        <li id="idPizzaria" style="display:none"><?php echo $idc ?></li>
                    </ul>                  
                </nav>              
            </div>

        </header>


        <div class="banner">
            <div class="contenedor" id="banner">
                <h2 class="banner__titulo">ENCONTRE JÁ !". </h2>
                <p class="banner__txt">As melhores Pizzas com os menores preços, preparadas com os melhores ingredientes</p>
                <input type="text" id="banner-input" size="250" placeholder="Digite o seu endereço">
                <input type="submit" name="busca" value="Busca">
                
            </div>
        </div>

        <div id="Buscar"></div>
        <div id="scrolling">
           
        





           
           
           <?php
    setlocale(LC_ALL,"es_ES");
    include('bd/conexionbd.php');

    if (!$conexion) 
	{
      die('Falha na conexão com o banco de dados: ' . mysqli_error($conexion));
    }


    $dias = array('Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo');
$fecha = $dias[date('N')]; 


    $sql="SELECT PIZZAS.ChavePizza,PIZZAS.Nome AS 'NomeP',PIZZAS.Preco,IMAGENS.Nome AS 'NomeI',MENU.Promociones,MENU.HorarioApertura,MENU.HorarioCierre FROM PIZZAS,IMAGENS,MENU WHERE MENU.Dia='".$fecha."' AND PIZZAS.IdMenu=MENU.IdMenu AND PIZZAS.Imagen=IMAGENS.ChaveImg";
    $result = mysqli_query($conexion,$sql);


       $sql1="SELECT MENU.Nome,MENU.Sabor FROM MENU WHERE MENU.Dia='".$fecha."'";
     $result1 = mysqli_query($conexion,$sql1);
while($row1 = mysqli_fetch_array($result1)){
    
echo'<h1 class="menu_pizzas" id="menu-dia">
    Menu de Pizza '.$fecha.' Disponivél '.$row1['HorarioApertura'].' a '.$row1['HorarioCierre'].'</h1>';
}
echo'<ul class="class_lu">';
   
    while($row = mysqli_fetch_array($result)){
        echo'<li class="class_li">
        <div class="conte-slider">

            <img src="assets/img/'.$row['NomeI'].'" alt="" class="info__img">
            <p>'.$row['NomeP'].'</p>
            <p>$'.$row['Preco'].' MX</p>
            <p>'.$row['Promociones'].'</p>
            <a id="btnAgregar" data-id="'.$row['ChavePizza'].'" data-np="'.$row['NomeP'].'" data-pre="'.$row['Precio'].'"
            data-img="'.$row['NomeI'].'"  class="mas">ORDENAR</a>
        </div>
    </li>';
     }  
echo'</ul>';   
  
?>






        </div>
        <div id="listaTabela">
            <div id="remover" class="row ocultar">
                <table class="responsive-table" id="tabelaP">
                    <thead>
                        <tr>
                            <th>Imagen</th>
                            <th>Nome</th>
                            <th>Preco</th>
                            <th>Sabor</th>
                            <th>Tamanho</th>
                            <th>Pasta</th>
                            <th>Salsas</th>
                            <th>Total</th>
                            <th>Opciones</th>

                        </tr>
                    </thead>
                    <tbody style="transition: all 1.4s;">
                        <tr>
                        </tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td id="total"></td>
                        <td> <button id="enviarMub" type="submit" class="waves-effect waves-light btn">ENDEREÇO</button>
                        </td>
                    </tbody>
                </table>
            </div>
        </div>
        <div id="resposta">

        </div>
        <!---------Modal agregar Pizzas---------->
        <div id="modalAG" class="modal modal-fixed-footer">
            <div class="modal-content">

                <!--Input fields-->
                <div class="container">
                    <div class="row">
                        <h4 class="center-align">Escolha o sabor de sua pizza</h4>
                        <form autocomplete="off" class="col s12" name="formAgregar">
                            <div class="row">
                                <div class="input-field col s12">
                                    <h5>Quantidade de pizzas</h5>
                                    <div class="input-field col s12">
                                        <p class="range-field">
                                            <input id="rango" name="rango" type="range" size="20" value="1" min="1" max="10" />
                                        </p>
                                    </div>
                                    <div class="input-field col s6">
                                        <input disabled type="text" id="valor" name="valor" value="1">

                                    </div>
                                </div>

                                <div id="modalimg" class="input-field col s12"></div>
                               
                                <div class="input-field col m6">
                                    <h5 type="text" id="nome" name="nome"></h5>
                                </div>


                                <div class="input-field col s6">
                                    <h5 type="text" id="quantidade" name="quantidade"></h5>
                                </div>


                                <div class="input-field col s12">


                                    <div class="input-field col m3" style="margin-left: 20px;">
                                        <p>Arroz $15.00 MX</p>
                                        <input type="button" value="+" id="mas">
                                        <input disabled name="quantity" id="arroz" value="0" size="4" />
                                        <input type="button" value="-" id="menos" style="width: 26px;">
                                    </div>


                                    <div class="input-field col m3" style="margin-left: 20px;">
                                        <p>Pasta $15.00 MX</p>
                                        <input type="button" value="+" id="mas1">
                                        <input disabled name="quantity1" id="pasta" value="0" size="4" />
                                        <input type="button" value="-" id="menos1" style="width: 26px;">
                                    </div>


                                    <div class="input-field col m3" style="margin-left: 20px;">
                                        <p>Salsas $5.00 MX</p>
                                        <input type="button" value="+" id="mas2">
                                        <input disabled name="quantity2" id="salsa" value="1" size="2" />
                                        <input type="button" value="-" id="menos2" style="width: 26px;">
                                    </div>


                                </div>

                            </div>

                        </form>
                    </div>
                </div>
            </div>


            <div class="modal-footer">
                <td>
                    <button id="btnAgregarLista" type="submit" class="modal-action waves-effect waves-light btn">Agregar</button>
                    <a id="btnCancelar" class="
            modal-action waves-effect waves-light red btn">Cancelar</a>
                </td>

            </div>


        </div>
        <!---------Fin modal---------->

        <!---------Modal dados de localizacao---------->
        <div id="modalUB" class="modal modal-fixed-footer">
            <div class="modal-content">

                <!--Input fields-->
                <div class="container">
                    <div class="row">
                        <h4 class="center-align">Digite o endereço</h4>
                        <form autocomplete="off" class="col s12" name="formAgregar">
                            <div class="row">


                                <div class="input-field col s12">
                                    <p>Coordenadas da sua localização</p>
                                    <input type="text" id="localizacao" name="valor" readonly="readonly">
                                </div>


                                <div class="input-field col s6">
                                    <input id="colonia" type="text" class="validate">
                                    <label for="colonia">Colonia</label>
                                </div>


                                <div class="input-field col s6">
                                    <input id="calles" type="text" class="validate">
                                    <label for="calles">Calles</label>
                                </div>


                                <div class="input-field col s6">
                                    <input id="numcasa" type="text" class="validate">
                                    <label for="numcasa">Número de Casa</label>
                                </div>


                                <div class="input-field col s6">
                                    <input id="referencias" type="text" class="validate">
                                    <label for="referencias">Referencias</label>
                                </div>


                                <div id="mapPizzaria" class="input-field col s6">
                                </div>

                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <td>
                    <a href="#Mapa" id="pizzariaUB" type="submit" class="waves-effect waves-light btn">Ativar localização</a>
                    <button id="btnEnviarDados" type="submit" class="modal-action waves-effect waves-light btn">ENVIAR PEDIDO</button>
                    <a id="btnCancelarUB" class="
            modal-action waves-effect waves-light red btn">Cancelar</a>
                </td>
            </div>
        </div>
        <!---------Fin modal---------->
       
        



        <div id="Mapa">
        </div>
        <button class="waves-effect waves-light" id="boton">Como chegar</button>
         <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAR7w704943DI7DGQ6_yLV0RgxVu4Xv2SQ&callback=localizacaoComparepizza" async defer></script>
        
        <div id="map">

        </div>
        <div class="fb-comments" data-href="https://www.facebook.com/ComparePizzaNew/photos/a.102511764966682/102511734966685" data-width="100%" data-numposts="5"></div>


       <!-- <div class="fb-comments" data-href="http://127.0.0.1:51985/index.html" data-width="100%" data-numposts="5"></div> -->
 
        <div id="btnCarrito" class="fixed-action-btn horizontal click-to-toggle ocultar">
            <a class="modalEspera btn-floating btn-large red icon-compras"></a>
            <span class="modalEspera" id="pedidosR">0</span>

        </div>
        

        <!---------Modal Pizzaria Logar sesión---------->
        <div id="modalPizzaria" class="modal modal-fixed-footer">
            <div class="modal-content">
                <!--Input fields-->
                <div class="container">
                    <div class="row">
                        <h4 class="center-align">Cadastre-se ou faça login</h4>

                        <form autocomplete="off" class="col s12" action="index.php" method="post" name="form2" id="form2">
                            <div class="row">
                              
                                 <div class="input-field col s12">
                                    <input name="usuarioS" id="usuarioC1" type="text" class="validate">
                                    <label for="icon_prefix">Nome de usuario</label>
                                </div>
                               
                                <div class="input-field col s12">
                                    <input name="senhaS" id="senhaC1" type="password" class="validate">
                                    <label for="senha">Senha</label>
                                </div>
                                   <div class="input-field col s12">
                                 <span id="respostaPizzaria" style="color: red;"></span>
                                </div>
                                
                            </div>
                        </form>
                  
                    </div>
                </div>
            </div>
            <div class="modal-footer">
               <td>
                <a id="btnCriar" class="
            modal-action waves-effect waves-light btn blue">Criar Conta</a>
                </td>
                <td>
                    <a id="btnPizzariaS" class="
            modal-action waves-effect waves-light btn">Logar</a>
                </td>
                <td>
                    <a id="btnCancelarPizzariaS" class="
            modal-action waves-effect waves-light red btn">Cancelar</a>
                </td>
            </div>
        </div>
        <!---------Fin modal ---------->
        
               
        
        
        <!---------Modal Pizzaria Criar Conta---------->
        <div id="modalPizzariaCriar" class="modal modal-fixed-footer">
            <div class="modal-content">
                <!--Input fields-->
                <div class="container">
                    <div class="row">
                        <h4 class="center-align">Criar conta</h4>

                        <form autocomplete="off" class="col s12" name="formAgregar">
                            <div class="row">
                                <div class="input-field col s12">
                                    
                                    <input id="nome" type="text" class="validate">
                                    <label for="icon_prefix">Nome completo</label>
                                </div>
                                 <div class="input-field col s12">
                                    <input id="usuario" type="text" class="validate">
                                    <label for="icon_prefix">Nome de usuario</label>
                                </div>
                                <div class="input-field col s12">
                                    <input id="senha1" type="password" class="validate">
                                    <label for="senha">Senha</label>
                                </div>
                                <div class="input-field col s12">
                                    <input id="senha2" type="password" class="validate">
                                    <label for="senha">Repita a senha</label>
                                </div>
                                <div id="tel" class="input-field col s12">
                                    <input id="telefone" type="tel" class="validate">
                                    <label for="icon_telephone">Telefone</label>
                                </div>
                              
                            </div>
                        </form>
                    </div>
                </div>
            </div>
           
            <div class="modal-footer">
                <td>
                    <a id="btnPizzariaC" class="
            modal-action waves-effect waves-light btn">Logar</a>
                </td>
                <td>
                    <a id="btnCancelarPizzariaC" class="
            modal-action waves-effect waves-light red btn">Cancelar</a>
                </td>
            </div>
        </div>
        <!---------Fin modal ---------->


        <!---------Modal Pizzaria Criar conta---------->
        <div id="modalDadosPizzaria" class="modal modal-fixed-footer">
            <div class="modal-content">
                <!--Input fields-->
                <div class="container">
                    <div class="row">
                        <h4 class="center-align">Dados da sua conta</h4>

                        <form autocomplete="off" class="col s12" name="formAgregar">
                            <div class="row">
    
                                <div class="input-field col s12">
                             <span>Usuario: </span>
                                  <span><?php echo  $inic ?></span>
                                 
                                </div>
                                 <div class="input-field col s12">
                                    <span>Nome: </span>
                                     <span><?php echo  $nome ?></span>
                                </div>
                                <div class="input-field col s12">
                                    <span>Telefone:</span>
                                     <span><?php echo  $telefone ?></span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
           
            <div class="modal-footer">
                <td>
                    <a id="btnCerrarSC" class="
            modal-action waves-effect waves-light btn">Cerrar sesión</a>
                </td>
                <td>
                    <a id="btnCancelarDC" class="
            modal-action waves-effect waves-light red btn">Cancelar</a>
                </td>
            </div>
        </div>
        <footer class="footer">
            <div class="social">
                <a href="https://www.facebook.com/ComparePizzaNew/" class="icon-facebook"></a>
              
                <!-- <a href="https://www.facebook.com/pg/ComparePizzaNew/about/" class="icon-facebook"></a>-->
                <!--<a class="icon-whapsat tooltipped" data-position="bottom" data-delay="50" data-tooltip="01 756 103 4002"></a>-->

                <a class="icon-whapsat tooltipped" data-position="bottom" data-delay="50" data-tooltip="11 98704-1701"></a>

            </div>
            <img src="imgpg/LOGO-COMPAREPIZZA.png" alt="" class="giratec">
            <p class="copy">&copy; Compare Pizza & todos os direitos reservados</p>
        </footer>
        <script src="js/materialize.min.js"></script>
        <script src="js/Mapa.js"></script>
        <script src="js/menu.js"></script>
         <script src="js/controladorSeciones.js"></script>
        <script src="js/jquery.vide.min.js"></script>
        <script src="js/itemslide.min.js"></script>
        <script src="js/jquery.mousewheel.min.js"></script>
        <script src="js/sliding.js"></script>
</body>

</html>