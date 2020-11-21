<?php
include('../bd/conexionbd.php');
    if (!$conexion) 
	{
      die('Falha na conexão com o banco de dados: ' . mysqli_error($conexion));
    }
$user=$_POST['no'];
$senha=$_POST['co'];
 

$consulta="SELECT ADMIN.IdAdmin,ADMIN.Nome,ADMIN.Senha FROM ADMIN WHERE ADMIN.Nome='".$user."' AND ADMIN.Senha='".$senha."'"; 
$buscar=mysqli_query($conexion,$consulta);
    while($row = mysqli_fetch_array($buscar)) 
    {
        if($user==$row['Nome'] && $senha==$row['Senha']){
            session_start();
            $_SESSAO['idadmin']=$row['IdAdmin'];
            $_SESSAO['usuario']=$user;
            $_SESSAO['senha']=$senha;
            echo 'valido';
        }
     
    } 

mysqli_close($conexion);
?>