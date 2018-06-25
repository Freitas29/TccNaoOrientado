<?php
	
	 include 'Conexao.php';
	$Pesquisa = $_POST['palavra'];

	$BuscaAnuncio = "select ctgNome from categoria  where ctgNome like '$Pesquisa%' limit 3";


	$ResultadoBusca = mysqli_query($oCon,$BuscaAnuncio);


	if(mysqli_num_rows($ResultadoBusca) <=0){
		echo "Nada encontrado";
	}else{


    	while ($Resultado = mysqli_fetch_assoc($ResultadoBusca)) {

    		echo "<li id='resultadoDasBuscas' class='resultadoDasBuscas'>".$Resultado['ctgNome']."</li>";
    	}
    }
?>