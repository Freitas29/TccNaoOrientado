<?php
 include 'Conexao.php';

session_start();

$Telefone = $_POST['AtualizaTel'];

 $AlteraTelefone = "update usuario set usrTelefone = '$Telefone' where UsrCodigo = ".$_SESSION['Login'];


if (mysqli_query($oCon,$AlteraTelefone)) {
	echo "Tudo certo";
	header('location:../ProdutosUsuario.php');
}else{
	echo 'erro';
	echo mysqli_error($oCon);
}

mysqli_close($oCon);
