<?php
include('../bd/conexionbd.php');
    if (!$conexion) 
	{
      die('Falha na conexão com o banco de dados: ' . mysqli_error($conexion));
    }
$user=$_POST['noc'];
$senha=$_POST['coc'];


$consulta="SELECT CADASTRODEPITIZZARIA.Nome,CADASTRODEPITIZZARIA.IdPitizzaria,CADASTRODEPITIZZARIA.Usuario,CADASTRODEPITIZZARIA.Senha,CADASTRODEPITIZZARIA.Endereco,CADASTRODEPITIZZARIA.Numero,CADASTRODEPITIZZARIA.Cep,CADASTRODEPITIZZARIA.Cidade,CADASTRODEPITIZZARIA.Estado,CADASTRODEPITIZZARIA.Pais,CADASTRODEPITIZZARIA.Telefone FROM CADASTRODEPITIZZARIA WHERE CADASTRODEPITIZZARIA.Usuario='".$user."' AND CADASTRODEPITIZZARIA.Senha='".$senha."'"; 
$buscar=mysqli_query($conexion,$consulta);
    while($row = mysqli_fetch_array($buscar)) 
    {
        if($user==$row['Usuario'] && $senha==$row['Senha']){     
            session_start();
            $_SESSAO['nome']=$row['Nome'];
            $_SESSAO['telefone']=$row['Telefone'];
            $_SESSAO['idc']=$row['IdPitizzaria'];
            $_SESSAO['usu']=$user;
            $_SESSAO['senhac']=$senha;
            echo 'valido';
        }
    } 
mysqli_close($conexion);
?>