<?php
$error='<script type="text/javascript">
    Materialize.toast("Desculpe, seu pedido não pode ser processado.",5000,"rounded");';

include('../bd/conexionbd.php');
    if (!$conexion) 
    {
      die('Falha na conexão com o banco de dados: ' . mysqli_error($conexion));
    }
$DATA = json_decode($_POST['data']);
$cont=0;
for ($j=2; $j < count($DATA); $j++) {
  $chave=$DATA[$j]->idp;
$c[$j]= "SELECT PIZZAS.Quantidade,PIZZAS.Nome FROM PIZZAS WHERE PIZZAS.ChavePizza='".$chave."'"; 
   $can[$j]=mysqli_query($conexion,$c[$j]);
    while($rowT = mysqli_fetch_array($can[$j])) 
    {       
     $contotal=(int)$rowT['Quantidade'];
       $menor=(int)$DATA[$j]->quantidade;
       
     if($menor<=$contotal){
        $cont=$cont+1; 
    }else{
          echo '<script type="text/javascript">
    Materialize.toast("Seu pedido não pode ser feito, não temos mais esta pizza: '.$rowT['Nome'].' Elige otro porfavor",8000,"rounded");
    </script>';
     }
        
}
};
$numero=(int)$DATA[1]->ntotal;
if($numero==$cont){
    $sql="'".$DATA[0]->colonia."','".$DATA[0]->calles."','".$DATA[0]->numcasa."','".$DATA[0]->referencia."','".$DATA[0]->localizacao."'";
$cero=0;
$insertar="INSERT INTO ".$DATA[0]->tabela." VALUES(".$cero.",".$sql.")";
$query=mysqli_query($conexion,$insertar);
	if($query!=null){ 
    $consulta="SELECT MAX(ChaveLocalizacao) AS 'ULTIMO' FROM LOCALIZACAO ORDER BY ChaveLocalizacao";
$query1=mysqli_query($conexion,$consulta);
while($row = mysqli_fetch_array($query1)) 
    {
          $idubi=$row['ULTIMO'];          
    } 
      $fecha=date("d") . "/" . date("m") . "/" . date("Y");
    
        $hora=date("h").":".date("i").":".date("s")." ".date("A"); 
        $estado="pendente";
        $idpizzaria=$DATA[0]->pizzaria;
$sql2="'".$fecha."','".$hora."','".$estado."',".$DATA[0]->pretotal.",".$idubi.",".$idpizzaria."";


$cero2=0;
$insertar2="INSERT INTO LISTADOPEDIDOS VALUES(".$cero2.",".$sql2.")";
$query2=mysqli_query($conexion,$insertar2);
if($query2!=null){
    
     $consulta2="SELECT MAX(IdListaPedido) AS 'idultimo' FROM LISTADOPEDIDOS ORDER BY IdListaPedido";
$query3=mysqli_query($conexion,$consulta2);
while($row2 = mysqli_fetch_array($query3)) 
    {
      $idlista=$row2['idultimo'];          
    } 
  $c=0;
 $insertar4="INSERT INTO PENDENTE VALUES(".$idlista.",'".$fecha."',".$c.")";
$query4=mysqli_query($conexion,$insertar4);
if($query4!=null) {
 $mensage="Tu pedido esta ciendo prosezado";
 $estado="pendente";
$insertar5="INSERT INTO ESPERA VALUES(".$idlista.",'".$fecha."',".$idpizzaria.",'".$estado."','".$mensage."')";
$query5=mysqli_query($conexion,$insertar5);
if($query5!=null) {
    
$contar="SELECT COUNT(*) AS 'Contar' FROM ESPERA WHERE ESPERA.Pizzaria='".$idpizzaria."' AND (ESPERA.Estado='pendente' OR ESPERA.Estado='aceptado' OR ESPERA.Estado='rechazado') AND FechaPedido='".$fecha."'";
$contotal=mysqli_query($conexion,$contar);
    while($rowC = mysqli_fetch_array($contotal)) 
    {
          $total=$rowC['Contar'];          
    } 
    echo '<script type="text/javascript">
    $("#pedidosR").text('.$total.');
    </script>';
for ($i=2; $i < count($DATA); $i++) {
$q[$i]= "INSERT INTO DETALHESPEDIDOS VALUES(".$idlista.",'".$DATA[$i]->idp."',".$DATA[$i]->arroz.",".$DATA[$i]->pasta.",".$DATA[$i]->salsa.",".$DATA[$i]->preuni.",".$DATA[$i]->quantidade.",".$DATA[$i]->subtotal.")"; 
    $insertartabela=mysqli_query($conexion,$q[$i]);
}
if($insertartabela!=null){
    echo '<script type="text/javascript">
    Materialize.toast("Seu pedido foi enviado com sucesso, o número do seu pedido é: '.$idlista.'",5000,"rounded");
    $("#numeroLista").text('.$idlista.');
    </script>';
}else{
   echo $error;
}  
}else{
    echo $error;
}
    
}else{
     echo $error;
} 
}else{
     echo $error;
}     
}else{
    echo $error;
    }    
}else{
    
    echo '<script type="text/javascript">
    Materialize.toast("Não foi possível fazer seu pedido",8000,"rounded");
    </script>';
}

?>