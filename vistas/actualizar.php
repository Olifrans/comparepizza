<?php
session_start();
 $iniciadoU=$_SESSAO['usuario'];
  $idAdmin=$_SESSAO['idadmin'];
    $senha=$_SESSAO['senha'];
if($iniciadoU==null||$iniciadoU==''){
  header("Location:../sessoes.html");
}   

   $tabela=$_POST['tabela'];
   include('../bd/conexionbd.php');
    if (!$conexion) 
    {
      die('Falha na conexão com o banco de dados: ' . mysqli_error($conexion));
    }
 $fecha=date("d") . "/" . date("m") . "/" . date("Y");


 
$consulta="SELECT NumPedido,FechaP,Leeido FROM PENDENTE WHERE FechaP='".$fecha."'";

$sql=mysqli_query($conexion,$consulta);
$cont=0;
while($row = mysqli_fetch_array($sql)) 
{ 
    $num1 = (int)$row['NumPedido']; 
    $num2 = (int)$row['Leeido']; 
    if($num1!=$num2){
      $cont=$cont+1; 
                 
    $editar="UPDATE PENDENTE SET Leeido=".$num1." WHERE NumPedido=".$num1."";
	$query=mysqli_query($conexion,$editar);
	if($query!=null){
    }
}
}

if($cont>0){
  echo $cont;
}else{
    echo 0;
}
mysqli_close($conexion);
?>