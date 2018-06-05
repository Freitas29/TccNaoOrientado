<?php

include 'Conexao.php';

$descricao = $_GET['titulo'];

$codigo = $_GET['codigo'];

$sql = "update anuncio set ancDesc = '$descricao' where ancCodigo = '$codigo'";

mysqli_query($oCon,$sql)
	

?>