<?php
 include 'Conexao.php';


session_start();

$Email = $_POST['NovoEmail'];

 $AlteraEmail = "update usuario set usrEmail = '$Email' where UsrCodigo = ".$_SESSION['Login'];


if (mysqli_query($oCon,$AlteraEmail)) {
	echo "Tudo certo";
	header('location:../ProdutosUsuario.php');
}else{
	echo 'erro';
	echo mysqli_error($oCon);
}

mysqli_close($oCon);
