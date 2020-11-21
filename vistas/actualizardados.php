<?php
session_start();
 $iniciadoU=$_SESSAO['usuario'];
  $idAdmin=$_SESSAO['idadmin'];
    $senha=$_SESSAO['senha'];
if($iniciadoU==null||$iniciadoU==''){
  header("Location:../sessoes.html");
}   
   $tabela=$_POST['tabela'];

switch ($tabela) 
    {
    case 'IMAGENS':
		actualizarimg();
		$campo=$_POST['nomeimg'];
		$sql="Nome='".$campo."' WHERE ChaveImg=".$_POST['id']."";
        actualizar($tabela,$sql);
        break;

    case 'PIZZAS':
        $sql="ChavePizza='".$_POST['chave']."',  Nome='".$_POST['nome']."', 
		Quantidade=".$_POST['quantidade'].",
		Precio=".$_POST['precio'].", 
		Imagen=".$_POST['idimg'].",
        IdMenu=".$_POST['idmenu']." WHERE IdPizza=".$_POST['id']."";
        actualizar($tabela,$sql);
        break;

    case 'MENU':
         $sql="Dia='".$_POST['dia']."', 
		Promociones='".$_POST['pro']."',
        HorarioApertura='".$_POST['ha']."', 
		HorarioCierre='".$_POST['hc']."' WHERE IdMenu=".$_POST['id']."";
        actualizar($tabela,$sql);
        break;

    case 'ADMIN':
         $sql="Nome='".$_POST['nomeadmin']."',
        Senha='".$_POST['senhaadmin']."' WHERE IdAdmin=".$_POST['idadmin']."";
        actualizar($tabela,$sql);
        break;
    default:
        echo "No se ingreso una tabela";
    };
    
function actualizarimg(){
@unlink('../assets/img/'.$_POST['eliminar']);
$temporal=$_FILES['archivo']['tmp_name'];
$nome=$_FILES['archivo']['name'];
$destinoArchivo=$_SERVER['DOCUMENT_ROOT'].'../SistemaAdministracionComparepizza_v3.9/assets/img/'.$nome;
move_uploaded_file($temporal,$destinoArchivo);
}
function actualizar($tabela,$sql){
    include('../bd/conexionbd.php');
    if (!$conexion) 
    {
      die('Falha na conexão com o banco de dados: ' . mysqli_error($conexion));
    }
$editar="UPDATE ".$tabela." SET ".$sql;
	$query=mysqli_query($conexion,$editar);
	if($query!=null){
		echo '<script>
		 Materialize.toast("Os dados foram atualizados com sucesso",4000,"rounded");
        </script>';
	}else{
		echo '<script type="text/javascript">
		Materialize.toast("Os dados não foram atualizados",4000,"rounded");
   </script>';
	};
    mysqli_close($conexion);
	}
  ?>