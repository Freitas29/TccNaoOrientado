<?php
	
	 include 'Conexao.php';
	$Pesquisa = $_POST['palavra'];
	$BuscaAnuncio = " select ancTitulo,ancCodigo,fotoDescricao from anuncio inner join fotosprodutos on  ancCodigo = foto_cod inner join usuario on ancCod_Criador = UsrCodigo where ancTitulo like '%$Pesquisa%' and usrCodigo != 1 limit 3";
	;


	$ResultadoBusca = mysqli_query($oCon,$BuscaAnuncio);


	if(mysqli_num_rows($ResultadoBusca) <=0){
		echo "Nada encontrado";
	}else{


    	while ($Resultado = mysqli_fetch_assoc($ResultadoBusca)) {

    		echo "<li id='resultadoDasBuscas' class='resultadoDasBuscas'><a href='MostraProduto.php?id_produto=".$Resultado['ancCodigo']."' ><img src='./Produtos/".$Resultado['fotoDescricao']."'>".$Resultado['ancTitulo']."</a></li>";
    	}
    }
?>