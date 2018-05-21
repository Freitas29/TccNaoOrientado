<?php


 include 'Conexao.php';


session_start();

$FotoUsuario = $_FILES['FotoUsuario']['name'];

 $AlteraEmail = "update usuario set usrFoto = '$FotoUsuario' where UsrCodigo = ".$_SESSION['Login'];

if (mysqli_query($oCon,$AlteraEmail)) {
	echo "Tudo certo";
	header('location:../ProdutosUsuario.php');
}else{
	echo 'erro';
	echo mysqli_error($oCon);
}

mysqli_close($oCon);

