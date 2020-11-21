<?php
session_start();
 $iniciadoU=$_SESSAO['usuario'];
  $idAdmin=$_SESSAO['idadmin'];
    $senha=$_SESSAO['senha'];
if($iniciadoU==null||$iniciadoU==''){
  header("Location:../sessoes.html");
}   
/*
$local = $_FILES["archivo"]["name"];
$remoto = $_FILES["archivo"]["tmp_name"];
$ruta = "/httpdocs/" . $local;
is_uploaded_file($remoto);
[b]copy($remoto, $ruta);[/b]
ftp_close($cid);

*/

$temporal=$_FILES['files']['tmp_name'];
$nome=$_FILES['files']['name'];
$destinoArchivo=$_SERVER['DOCUMENT_ROOT'].'../SistemaAdministracionComparepizza_v3.9/assets/img/'.$nome;

move_uploaded_file($temporal,$destinoArchivo);
	if($_FILES['files']['error']==''){	
		include('../bd/conexionbd.php');
    if (!$conexion) 
    {
      die('Falha na conexão com o banco de dados: ' . mysqli_error($conexion));
    }
$cero=0;
$insertar="INSERT INTO IMAGENS VALUES(".$cero.",'".$nome."')";
	$query=mysqli_query($conexion,$insertar);
	if($query!=null){
		echo '<script type="text/javascript">
    Materialize.toast("El archivo:'.$nome.' foi salvo corretamente",4000,"rounded"); 
   </script>';
	}else{
		echo '<script type="text/javascript">
		      Materialize.toast("Os dados não puderam ser salvos",4000,"rounded");
             </script>';
	};
    mysqli_close($conexion);
	}else{
	if($_FILES['files']['error']!=''){	
	echo '<script type="text/javascript">
	 Materialize.toast("El archivo: '.$nome.' não pôde fazer upload, error: '.$_FILES['files']['error'].'" ,4000,"rounded"); 
   </script>';
	}
	}
?>