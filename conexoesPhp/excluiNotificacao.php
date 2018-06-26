<?php
	
	include 'Conexao.php';

	$Deleta = $_GET['id_produto'];
	
	$DeletaTroca = 'delete from trocas where idTroca = '.$Deleta.'';

	if(mysqli_query($oCon, $DeletaTroca)){
		echo "OKayy";
	}else{
		mysqli_error($oCon);
	}

?>
