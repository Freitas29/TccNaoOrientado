<head>
 <meta charset="UTF-8">
</head>

<style type="text/css">
	#imgEmai{
		width: 20%;
	}
</style>
<?php
session_start();
$emailProduto = $_POST["emailUsuarioProduto"];
$emailLogado = $_POST["emailUsuarioLogado"];
$titulo = $_POST["tituloAnuncio"];
$nome = $_POST["nomeUsuario"];
$telefone = $_POST["Telefone"];
$codigo = $_POST["codigo"];
$codigoProdutoEscolhidoParaTrocar = $_POST["codigoProdutoEscolhidoParaTrocar"];
$foto= $_POST["fotoUsuarioProduto"];


require_once("../PHPMailerAutoload.php");
$mail = new PHPMailer();
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = true;
$mail->Username = "informaticaparainternet2017@gmail.com";
$mail->Password = "informatica";
$mail->setFrom("{$emailLogado}", "{$nome}");
$mail->addAddress("{$emailProduto}");
$mail->Subject = "Usuário {$nome} deseja trocar com você";
$mail->msgHTML("<html>Usuário {$nome} deseja trocar com você!
	<br/>
	E-mail de contato: {$emailLogado}<br/>
	Seu Produto: {$titulo} <br/>
	Entre em contato com ele(a) pelo numero: {$telefone}<br/>
	Produto no qual ele quer trocar com você: <br><img src='http://localhost/TccNaoOrientado/Produtos/{$foto}' style='width:30%;'><br/>
	Deseja ver o anuncio?<br>
	<a href='http://localhost/TccNaoOrientado/MostraProduto.php?id_produto=$codigoProdutoEscolhidoParaTrocar'>fdks</a></html>");

$mail->AltBody = "de: {$nome}\nemail:{$emailLogado}\nProduto no qual ele deseja trocar: {$titulo}\nEntre em contato com ele(a) pelo numero: {$telefone}";
if($mail->send()) {
    echo "Mensagem enviada com sucesso";
	header("location:../MostraProduto.php?id_produto=$codigo");
	$_SESSION['Enviado'] = "Pedido de troca enviado ao com sucesso!";
} else {
    echo "Erro ao enviar  " . $mail->ErrorInfo;
    
}
die();