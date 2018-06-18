<?php
session_start();
$emailProduto = $_POST["emailUsuarioProduto"];
$emailLogado = $_POST["emailUsuarioLogado"];
$titulo = $_POST["tituloAnuncio"];
$nome = $_POST["nomeUsuario"];
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
$mail->msgHTML("<html>de: {$nome}<br/>email: {$emailProduto}<br/>mensagem: {$titulo}</html>");
$mail->AltBody = "de: {$nome}\nemail:{$emailProduto}\nProduto no qual ele deseja trocar: {$titulo}";

if($mail->send()) {
    echo "Mensagem enviada com sucesso";
    
} else {
    echo "Erro ao enviar  " . $mail->ErrorInfo;
    
}
die();
