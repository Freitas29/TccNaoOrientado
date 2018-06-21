<?php

	include 'Conexao.php';

session_start();

if(!isset($_SESSION['Login'])){
	header ("location:../PaginaDeLogin.php");
	echo "<script>
	alert(faça o login);
			<script>
	";
}else{

$FavoritoCod = $_GET['id_produto'];

echo $FavoritoCod;

	$Insert = "insert into favoritos(favoritos_cod_anuncio,favoritos_cod_usuario)values(".$FavoritoCod.",".$_SESSION['Login'].")";

	if(mysqli_query($oCon,$Insert)){
		echo "Okau";
	}else{
		echo "kdflk";
	}
	}
?>