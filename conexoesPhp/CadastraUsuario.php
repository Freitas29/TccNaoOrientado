 <?php

	 include 'Conexao.php';
	
	session_start();

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
}

	$Redirecionar = header('location:../PaginaDeCadastro.php');

	$Senha = md5($_POST['SenhaUsu']);
	
	$Email = $_POST['EmailUsu'];
	
	$Nome = $_POST['NomeUsu'];

	$CEP = $_POST['CEP'];
	
	$Logradouro = $_POST['Logradouro'];

	$Cidade = $_POST['Cidade'];

	$Bairro = $_POST['Bairro'];

	$Estado = $_POST['Estado'];
	
	$Local = "../Usuarios/";

	if(empty($_FILES['arquivo']['name']))
		$Img = "x";

	if(!empty($_FILES['arquivo']['name']))
		$Img = $_FILES['arquivo']['name'];
	



	// Validação dos campos do formulario

if (empty($Email)) {

	$_SESSION['Vazio_Email_Cadastrar'] = "Campo email obrigatório";

	$Redirecionar;

}

if (empty($Nome)) {

	$_SESSION['Vazio_Nome_Cadastrar'] = "Campo nome obrigatório";

	$Redirecionar;

}

if (empty($Senha)) {

	$_SESSION['Vazio_Senha_Cadastrar'] = "Campo senha obrigatório";

	$Redirecionar;

}

if (empty($CEP)) {

	$_SESSION['Vazio_CEP_Cadastrar'] = "Campo CEP obrigatório";

	$Redirecionar;

}


if (empty($Logradouro)) {

	$_SESSION['Vazio_Logradouro_Cadastrar'] = "Campo rua obrigatório";

	$Redirecionar;

}

if (empty($Cidade)) {

	$_SESSION['Vazio_Cidade_Cadastrar'] = "Campo cidade obrigatório";

	$Redirecionar;

}


if (empty($Bairro)) {

	$_SESSION['Vazio_Bairro_Cadastrar'] = "Campo bairro obrigatório";

	$Redirecionar;

}

if (empty($Estado)) {

	$_SESSION['Vazio_Estado_Cadastrar'] = "Campo estado obrigatório";

	$Redirecionar;

}



	// Terminou validação

		

	//Enviando para o banco
	
	
	$CadastrandoUsuario = "insert into usuario(usrEmail,usrApelido,usrSenha,usrCEP,usrFoto,usrLogradouro,usrUf,usrBairro,usrLocalidade)values('$Email','$Nome','$Senha','$CEP','$Img','$Logradouro','$Cidade','$Bairro','$Estado')";
	
	print_r($CadastrandoUsuario);
	
	
	move_uploaded_file($_FILES['arquivo']['tmp_name'],$Local.$Img);
		
		if(mysqli_query($oCon,$CadastrandoUsuario)){
		
			echo "JFKDSL";
		
		}else{
			
			echo mysqli_error($oCon);
		}
?>
