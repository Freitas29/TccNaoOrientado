<?php

include 'Conexao.php';

$categoria = $_GET['categoria'];

$codigo = $_GET['codigo'];

$sql = "update anuncio set ancCod_Categoria = '$categoria' where ancCodigo = '$codigo'";

mysqli_query($oCon,$sql)
	

?>