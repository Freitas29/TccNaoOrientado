<?php

 include 'Conexao.php';

$CodigoAnuncio = $_GET['codigoAnuncio'];

 $SelecionaAnuncio = "select ancCodigo,ancTitulo from anuncio where ancCodigo = $CodigoAnuncio";


$ProdutoSeleciona = mysqli_query($oCon,$SelecionaAnuncio);

if($RegDoProduto = mysqli_fetch_assoc($ProdutoSeleciona)){

	echo $RegDoProduto['ancTitulo'];
}else{
	echo 'erro';
	echo mysqli_error($oCon);
}

mysqli_close($oCon);
