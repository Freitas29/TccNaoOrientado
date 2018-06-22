<?php

 include 'Conexao.php';

session_start();


$produto = $_GET['id_produto'];
$produto2 = $_GET['id_produto2'];

$AlteraDados = "update trocas set trocado = 1 where anuncioEnvia = '$produto'";
$AlteraDadosAnuncio = "update anuncio set trocado = 1 where ancCodigo = '$produto'";
$AlteraDadosAnuncio2 = "update anuncio set trocado = 1 where ancCodigo = '$produto2'";


if(mysqli_query($oCon,$AlteraDados)){
	echo "OKay";
	echo $produto;

}

if(mysqli_query($oCon,$AlteraDadosAnuncio)){
	echo "OKay anuncio";
	echo $produto;
	echo $produto2;
}

if(mysqli_query($oCon,$AlteraDadosAnuncio2)){
	echo "OKay anuncio2";
	echo $produto;
	echo $produto2;
}

?>