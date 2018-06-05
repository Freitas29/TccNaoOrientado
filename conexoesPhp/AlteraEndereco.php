<?php

 include 'Conexao.php';

session_start();



$CEP = $_POST['CEP'];
$Logradouro = $_POST['Logradouro'];
$Cidade = $_POST['Cidade'];
$Bairro = $_POST['Bairro'];
$Localidade = $_POST['Estado'];

$AlteraDados = "update usuario set usrCEP = '$CEP' ,usrLogradouro = '$Logradouro' , usrUf = '$Cidade' , usrBairro = '$Bairro' , usrLocalidade = '$Localidade' where UsrCodigo = ".$_SESSION['Login'];

if(mysqli_query($oCon,$AlteraDados)){
	echo "OKay";
	header('location:../ProdutosUsuario.php');
}else{
	mysqli_error($oCon);
	echo " errpo";
	echo($AlteraDados);
}


?>