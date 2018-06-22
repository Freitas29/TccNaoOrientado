<?php

 include 'Conexao.php';

session_start();


$produto = $_GET['id_produto'];

$AlteraDados = "update trocas set trocado = 1 where anuncioRecebe = '$produto'";

if(mysqli_query($oCon,$AlteraDados)){
	echo "OKay";
}else{
	mysqli_error($oCon);
	echo " errpo";
	echo($AlteraDados);
}


?>