<?php
include 'Conexao.php';

$usuarioEnvia = $_POST['usuarioEnvia'];
$usuarioRecebe = $_POST['usuarioRecebe'];
$anuncioRecebe = $_POST['anuncioRecebe'];
$anuncioEnvia = $_POST['anuncioEnvia'];
$codigo = $_POST["codigo"];

 $insereTrocas = "insert into trocas(usuarioRecebe,UsuarioEnvia,anuncioRecebe,anuncioEnvia,trocado)values($usuarioRecebe,$usuarioEnvia,$anuncioRecebe,$anuncioEnvia,0)";

if(mysqli_query($oCon,$insereTrocas)){
	echo "UHUUUUUUU";
	header("location:../MostraProduto.php?id_produto=$codigo");
	$_SESSION['Enviado'] = "Pedido de troca enviado ao com sucesso!";
}else{
	echo mysqli_error($oCon);
}
?>