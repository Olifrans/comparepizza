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
    case 'PIZZAS':
     $sql="'".$_POST['chave']."','".$_POST['nome']."',".$_POST['sabor'].",".$_POST['preco'].",".$_POST['idimg'].",".$_POST['idmenu']."";
       insertar($tabela,$sql);
        break;
    case 'MENU':
       $sql="'".$_POST['dia']."','".$_POST
['pro']."','".$_POST['ha']."','".$_POST['hc']."'";
       insertar($tabela,$sql);
        break;
    case 'LOCALIZACAO':
 $sql="'".$_POST['cidade']."','".$_POST
['estado']."','".$_POST
['pais']."','".$_POST
['endereco']."','".$_POST
['numero']."','".$_POST
['cep']."','".$_POST
['referencia']."','".$_POST['localizacao']."'";
       insertar($tabela,$sql);
        break;
    case 'ADMIN':
 $sql="'".$_POST['nomeadmin']."','".$_POST['senhaadmin']."'";
       insertar($tabela,$sql);
        break;
    default:
        echo "Regra padrão";
    };

function insertar($tabela,$sql){
	
    include('../bd/conexionbd.php');
    if (!$conexion) 
    {
      die('Falha na conexão com o banco de dados: ' . mysqli_error($conexion));
    }
$cero=0;
$insertar="INSERT INTO ".$tabela." VALUES(".$cero.",".$sql.")";
	$query=mysqli_query($conexion,$insertar);
	if($query!=null){
		echo '<script>
   Materialize.toast("Os dados foram salvos corretamente",4000,"rounded");
   </script>';
	}else{
		echo '<script type="text/javascript">
    Materialize.toast("Erro, os dados não foram salvos",4000,"rounded");
   </script>';
	};
    mysqli_close($conexion);
	}
  ?>