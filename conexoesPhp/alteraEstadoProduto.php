<?php

include 'Conexao.php';

$estadoProduto = $_GET['estado'];

$codigo = $_GET['codigo'];

$sql = "update anuncio set ancEstadoItem = '$estadoProduto' where ancCodigo = '$codigo'";

mysqli_query($oCon,$sql)

?>