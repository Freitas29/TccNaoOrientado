<?php
	
	include 'Conexao.php';

	$Deleta = $_GET['id_produto'];
	
	$DeletaAnuncio = 'delete from anuncio where ancCodigo = '.$Deleta.'';

	if(mysqli_query($oCon, $DeletaAnuncio)){
		echo "OKayy";
	}else{
		mysqli_error($oCon);
	}

?>
