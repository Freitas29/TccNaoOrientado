<?php

 include 'Conexao.php';

session_start();


$produto = $_GET['id_produto'];


$AlteraDados = "update anuncio set trocado = 0 where ancCodigo = '$produto'";



if(mysqli_query($oCon,$AlteraDados)){
	echo "OKay";
	echo $produto;

}


?>