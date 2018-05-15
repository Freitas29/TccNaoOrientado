<?php
session_start();

include 'Conexao.php';
	

require_once "../bibliotecas/recaptchalib.php";
// sua chave secreta
$secret = "6Lc05VcUAAAAAFV6zbbVkZ2-Yb0iGojUV3I6bZyP";
 
// resposta vazia
$response = null;
 
// verifique a chave secreta
$reCaptcha = new ReCaptcha($secret);

// se submetido, verifique a resposta
if ($_POST["g-recaptcha-response"]) {
$response = $reCaptcha->verifyResponse(
        $_SERVER["REMOTE_ADDR"],
        $_POST["g-recaptcha-response"]
    );

  
       
      

$Login = $_POST['UsuarioLogin'];

$Senha = md5($_POST['UsuarioSenha']);

$Redirecionar = header('location:../Index.php');


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
		header('location:../Index.php');
	}


} else {
		echo "<script>alert('Captch incorreto!');</script>";
		header('location:../Index.php');
}

mysqli_close($oCon);

?>
