<?php


 include 'Conexao.php';

$Local = "../Usuarios/";

session_start();

$FotoUsuario = $_FILES['FotoUsuario']['name'];

 $AlteraEmail = "update usuario set usrFoto = '$FotoUsuario' where UsrCodigo = ".$_SESSION['Login'];

if (mysqli_query($oCon,$AlteraEmail)) {

	echo "Tudo certo";
	move_uploaded_file($_FILES['FotoUsuario']['tmp_name'],$Local.$FotoUsuario);
	header('location:../ProdutosUsuario.php');
}else{
	echo 'erro';
	echo mysqli_error($oCon);
}

mysqli_close($oCon);

