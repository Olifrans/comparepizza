<?php
session_start();

 $inic=$_SESSAO['usu'];

  $idcli=$_SESSAO['idc'];
    $senhac=$_SESSAO['senhac'];
if($inic==null||$inic==''){
  header("Location:../index.php");
}else{
    //SESSAO_destroy();
    $inic=$_SESSAO['usu']="";
$idcli=$_SESSAO['idc']="";
$senhac=$_SESSAO['senhac']="";
$nome=$_SESSAO['nome']="";
$telefone=$_SESSAO['telefone']="";
    header("Location:../index.php");
}

?>