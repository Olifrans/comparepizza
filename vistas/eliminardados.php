<?php
session_start();
 $iniciadoU=$_SESSAO['usuario'];
  $idAdmin=$_SESSAO['idadmin'];
    $senha=$_SESSAO['senha'];
if($iniciadoU==null||$iniciadoU==''){
  header("Location:../sessoes.html");
}   
    $id = $_POST['dados'];
    $tabela = $_POST['tabela'];
    $campo = $_POST['campo'];

    include('../bd/conexionbd.php');
    if (!$conexion) 
    {
      die('Falha na conexão com o banco de dados: ' . mysqli_error($conexion));
    }

    
if($tabela=="IMAGENS"){
	$consulta="SELECT Nome FROM ".$tabela." WHERE ".$campo."=".$id;
    $nome=mysqli_query($conexion,$consulta);
	while($fila=mysqli_fetch_array($nome))
			{
				$Nome=$fila['Nome'];
		@unlink('../assets/img/'.$Nome);
			}
	
	eliminar($conexion,$tabela,$campo,$id);
}else{
	eliminar($conexion,$tabela,$campo,$id);
}
function eliminar($conexion,$tabela,$campo,$id){
	

    $eliminar="DELETE FROM ".$tabela." WHERE ".$campo."=".$id;
    $query=mysqli_query($conexion,$eliminar);
	if($query!=null){
		echo '<script type="text/javascript">
    Materialize.toast("Os dados foram excluídos com sucesso",4000,"rounded");
	
   </script>';
	}else{
		echo '<script type="text/javascript">
    Materialize.toast("Os dados não puderam ser excluídos, podem estar relacionados",4000,"rounded");
   </script>';
	};
    mysqli_close($conexion);
	}
  ?>