<?php
 include 'Conexao.php';


session_start();

$Nome = $_POST['NovoNome'];

 $AlteraNome = "update usuario set usrApelido = '$Nome' where UsrCodigo=".$_SESSION['Login'];


if (mysqli_query($oCon,$AlteraNome)) {
	echo "Tudo certo";
	header('location:../ProdutosUsuario.php');
}else{
	echo 'erro';
	echo mysqli_error($oCon);
}

mysqli_close($oCon);