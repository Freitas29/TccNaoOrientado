<?php

include 'Conexao.php';

$categoriaEscolhe = $_GET['categoriaEscolhe'];

$codigo = $_GET['codigo'];

$sql = "update anuncio set ancCategoria_interesse = '$categoriaEscolhe' where ancCodigo = '$codigo'";

mysqli_query($oCon,$sql)

	

?>