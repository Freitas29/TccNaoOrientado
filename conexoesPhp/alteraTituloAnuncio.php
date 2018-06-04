<?php

include 'Conexao.php';

$titulo = $_GET['titulo'];

$codigo = $_GET['codigo'];

echo var_dump("tiutlo : ".$titulo);
echo var_dump($codigo);

$sql = "update anuncio set ancTitulo = '$titulo' where ancCodigo = '$codigo'";

mysqli_query($oCon,$sql)
	

?>