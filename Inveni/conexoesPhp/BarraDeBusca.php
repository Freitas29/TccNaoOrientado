<?php
	
	 include 'Conexao.php';
	$Pesquisa = $_POST['palavra'];

	$BuscaAnuncio = "  select ancCodigo,ancTitulo,fotoDescricao,foto_cod from anuncio inner join fotosprodutos on ancCodigo = foto_cod_anuncio where ancTitulo like '%$Pesquisa%' and  foto_cod limit 1,3";


	$ResultadoBusca = mysqli_query($oCon,$BuscaAnuncio);


	if(mysqli_num_rows($ResultadoBusca) <=0){
		echo "Nada encontrado";
	}else{


    	while ($Resultado = mysqli_fetch_assoc($ResultadoBusca)) {

    		echo "<li id='resultadoDasBuscas'><a href='MostraProduto.php?id_produto=".$Resultado['ancCodigo']."' ><img src='".$Resultado['fotoDescricao']."'>".$Resultado['ancTitulo']."</a></li>";
    	}
    }
?>