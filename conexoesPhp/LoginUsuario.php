<?php
session_start();

include 'Conexao.php';
	

       
      

$Login = $_POST['UsuarioLogin'];

$Senha = md5($_POST['UsuarioSenha']);

$Redirecionar = header('location:../index.php');


if (empty($Login)) {

	$_SESSION['Vazio_Nome_Login'] = "Preecha o campo com nome de usuário ou email";

	$Redirecionar;

}


if (empty($Senha)) {

	$_SESSION['Vazio_Senha'] = "Preecha o campo senha";

	$Redirecionar;
}



$UsuarioValida = "SELECT UsrCodigo,usrEmail,usrApelido from usuario where (usrEmail = '$Login' or usrApelido = '$Login') and usrSenha = '$Senha'";
 echo $UsuarioValida;

$DadosUsuario = mysqli_query($oCon,$UsuarioValida);

if ($RegUsuario['usrEmail'] != $Login || $RegUsuario['usrApelido'] != $Login) {
	$_SESSION['Nome_Valida'] = "Seu nome de login, email ou senha está incorreto";
	$Redirecionar;
}



if($RegUsuario = mysqli_fetch_assoc($DadosUsuario)){
		$_SESSION['Login'] = $RegUsuario['UsrCodigo'];
		header('location:../Logado.php');
	}else{
		unset ($_SESSION['Login']);
		header('location:../index.php');
}



mysqli_close($oCon);

?>
