<?php

 include 'Conexao.php';

$Local = "../Produtos/";

session_start();

$FotoUsuario = $_FILES['fotoProdutoNova']['name'];
$CodigoUsuario = $_SESSION['Login'];
$CodigoAnuncio = $_POST['codigoAnuncio'];

 $AlteraEmail = "insert into fotosprodutos(fotoDescricao,foto_cod_usuario,foto_cod_anuncio)values('$FotoUsuario','$CodigoUsuario','$CodigoAnuncio')";

var_dump($AlteraEmail);
if (mysqli_query($oCon,$AlteraEmail)) {

	echo "Tudo certo";
	move_uploaded_file($_FILES['fotoProdutoNova']['tmp_name'],$Local.$FotoUsuario);
	header("location:../alterarProduto.php?anuncio=$CodigoAnuncio");
}else{
	echo 'erro';
	echo mysqli_error($oCon);
}

mysqli_close($oCon);

