<head>
 <meta charset="UTF-8">
</head>
<?php
session_start();
$emailProduto = $_POST["emailUsuarioProduto"];
$emailLogado = $_POST["emailUsuarioLogado"];
$titulo = $_POST["tituloAnuncio"];
$nome = $_POST["nomeUsuario"];
$telefone = $_POST["Telefone"];
$codigo = $_POST["codigo"];

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
$mail->Subject = "Usu�rio {$nome} deseja trocar com voc�";
$mail->msgHTML("<html>de: {$nome}<br/>email: {$emailProduto}<br/>mensagem: {$titulo}<br/>Entre em contato com ele(a) pelo numero: {$telefone}</html>");
$mail->AltBody = "de: {$nome}\nemail:{$emailProduto}\nProduto no qual ele deseja trocar: {$titulo}\nEntre em contato com ele(a) pelo numero: {$telefone}";
if($mail->send()) {
    echo "Mensagem enviada com sucesso";
	header("location:../MostraProduto.php?id_produto=$codigo");
	$_SESSION['Enviado'] = "Pedido de troca enviado ao com sucesso!";
} else {
    echo "Erro ao enviar  " . $mail->ErrorInfo;
    
}
die();