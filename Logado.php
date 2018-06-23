	<html>
	<?php

	session_start();

	if((!isset ($_SESSION['Login']))){
	header('location:index.php');
	}else{
	?>


	<head>
	<!-- Css do materialize -->
	<link rel="stylesheet" href="./Materialize/css/materialize.css">

	<meta charset="utf-8">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	</head>

	<script>

	function TiraMenuCelular(){
		document.getElementById('menu-mobile').style.visibility="hidden";
	}

	function FechaTudo(){
		document.getElementById('menu-mobile').style.visibility="visible";
		DesativaForm();
	}


	function enviaFavorito(valor){
			var Objeto = new XMLHttpRequest();
			
			with(Objeto){
			
			open('GET','./conexoesPhp/Favoritar.php?id_produto='+valor+'');
			
			send();
				onload = function(){
					 location.reload();
				}
			}
		
	}

	function TiraFavorito(valor){
			var Objeto = new XMLHttpRequest();
			
			with(Objeto){
			
			open('GET','./conexoesPhp/TiraFavoritos.php?id_produto='+valor+'');
			
			send();

			
				onload = function(){
				
				location.reload();
				
				}
			}
		
	}

	function AtivaBusca(){
			document.getElementById('divDaBusca').style.display="inline-grid";
	}

	function DesativaForm(){
		//document.getElementById('resultadoDasBuscas').style.display="none";
		var x = document.getElementById("ResultadoBusca").getElementsByTagName("LI");
    	a = x.length;
		var i;
		for(i = 0;i<a;i++){
			document.getElementById('ResultadoBusca').style.display="none";
		}
	}

	

	</script>

	<style>

	nav{
		
		background-color:#1e88e5 !important;
	}

	blockquote{
		border-left:5px solid #1e88e5 !important
	}


	.side-nav.fixed {
    left: 0;
    -webkit-transform: translateX(0);
    transform: translateX(0);
    position: fixed;
    width: 14%;
}



	.card .card-content p {
	    margin: 0;
	    color: inherit;
	    max-width: 68ch;
	    overflow: hidden;
	    text-overflow: ellipsis;
	    white-space: nowrap;
	}

	  .card .card-image img {
	    display: block;
	    border-radius: 2px 2px 0 0;
	    position: relative;
	    left: 0;
	    right: 0;
	    top: 0;
	    bottom: 0;
	    max-height: 25%;
	    width: 100%;
	    min-height: 20%;
	    height: 25%;
	}

	@media only screen and (max-width: 320px) {
	  .card .card-image img {
	    display: block;
	    border-radius: 2px 2px 0 0;
	    position: relative;
	    left: 0;
	    right: 0;
	    top: 0;
	    bottom: 0;
	    max-height: 25%;
	    width: 100%;
	    height: 12%
		}
	}

	#ResultadoBusca{
	background-color: #1e88e5;
    width: 100%;
    height: 100%;
    display: none;
    position: absolute;
    top: 100%;
    z-index: 999;
	}

	#ResultadoBusca li{
	z-index: 1;
    background-color: #fdfdfd;
    color: black;
    box-shadow: 1px 1px 1px 1px #ddd;
    padding: 5px;
	}

	#ResultadoBusca li img{
		width: 10%;
    	height: auto;
    	margin-right: 3%;
	}

	#ResultadoBusca li a{
		color: black;
	}

	.imgDaBarraDeBusca{
   		 width: 100%;
    	height: auto;
    	box-shadow: 1px 1px 1px 1px #ddd;
    	margin-bottom: 2%;
	}

	.imgDaBarraDeBusca img{
		width: 70%;
	    height: 20%;
	    position: relative;
	    left: 20%;
	}

	#nav-right a{
		width: 100%;
		background-color:white !important;
		color: #3c3737; 
		margin-bottom: 3%;
	}
	ul#categorias{
		display: inline-table;
	}
	.dropdown-content li{
		text-align: center;
	}

	#divDaBusca{
		width: 100%;
		height: auto;
	}

	</style>

	<body onclick="FechaTudo()" style="background-color: white;">

	<?php

			include './conexoesPhp/Conexao.php';
			
			$ConteudoCelular = 'select ancTitulo,ancDesc,ancCodigo from anuncio  where ancCod_Categoria=4 and ancCod_Criador != '.$_SESSION['Login'].' and trocado = 0 order by ancCodigo desc limit 4';
			
			$Usuario = 'select usrEmail,usrApelido,usrFoto from usuario where UsrCodigo='.$_SESSION['Login'];
			
			//jogos
			$Conteudo = ' select ancTitulo,ancDesc,ancCodigo from anuncio  where ancCod_Categoria=5 and ancCod_Criador != '.$_SESSION['Login'].' and trocado = 0 order by ancCodigo desc limit 4';
			
			$Conteudo2 = 'select * from anuncio where ancCod_Criador != '.$_SESSION['Login'].' and trocado = 0 order by ancCodigo desc limit 4';

			$Livros = 'select ancTitulo,ancDesc,ancCodigo from anuncio  where ancCod_Categoria=2 and ancCod_Criador != '.$_SESSION['Login'].' and trocado = 0  order by ancCodigo desc limit 4';

			$DadosLivros = mysqli_query($oCon,$Livros);
			
			$Dados = mysqli_query($oCon,$Conteudo);
			
			$Dados2 = mysqli_query($oCon,$Conteudo2);
			
			$DadosCelular = mysqli_query($oCon,$ConteudoCelular);
			
			$DadosUsuario = mysqli_query($oCon,$Usuario);

			if($RegUsuario = mysqli_fetch_assoc($DadosUsuario)){
			
	?>



	

	  <nav class="nav">
    <div class="nav-wrapper container" >
  
	     <a href="#!" class="brand-logo left"><img src="logoTeste.png" style="width: 35%;"></a>

	      
	      <a href="#" data-activates="menu-mobile" class="button-collapse right"><i class="material-icons">menu</i></a>

	      <ul class="right hide-on-med-and-down" style="width: 70%;">
	      	<li style="width: 59%;">

	        <div class="nav-wrapper" >

	        	<!-- Buscar de produtos pelo site -->

		        <form action="" method="POST" id="formPesquisa" >
			        <div class="input-field" >

			          <input id="pesquisa" type="search" name="pesquisa" onfocus="AtivaBusca()">
			          
			          <label class="label-icon" for="search"><i class="material-icons">search</i></label>
			          <i class="material-icons">close</i>
			        
	       		 </form>
					<!--traz os dados da busca -->
	       		<div id="divDaBusca" >
		       		 <ul class="resultado" id="ResultadoBusca" >


		       		 </ul>

		       	 </div>
	       	
	      	</div>

	      <li><a data-activates="slide-out" class="button tooltipped" data-position="bottom" data-tooltip="Clique para abrir o menu de usuário"><?php echo $RegUsuario['usrApelido'];?></a></li>
		    <li><a href="./conexoesPhp/Deslogar.php">Sair</a></li>
		     <li><a href="Logado.php">Página Inicial</a></li>
		     <li><a class="dropdown-button" href="#" data-activates="categorias">Categorias</a></li>
	      </ul>


	     <!--  Menu que aparece na esquerda do usuário -->
	       <ul id="slide-out" class="side-nav">
		    <li>
		    	<div class="user-view">
			      <div class="background" style="background-color: #084172;">
			        
			      </div>
		    	  <img class="circle" src="./Usuarios/<?php echo $RegUsuario['usrFoto']?>"	>





		      <a href="#!name"><span class="white-text name"><?php echo $RegUsuario['usrApelido'];?></span></a>
		      <a href="#!email"><span class="white-text email"><?php echo $RegUsuario['usrEmail'];
			  
				}
			  ?></span></a>
		   	 </div>
			</li>

		    <li><a href="ProdutosUsuario.php#test-swipe-4">Seus Dados</a></li>
		    <li><a href="ProdutosUsuario.php#test-swipe-2">Anunciar um Novo Produto</a></li>
		     <li><a href="ProdutosUsuario.php#test-swipe-1">Seus Produtos</a></li>
		    <li><div class="divider"></div></li>
		    <li><a class="subheader" >Favoritos</a></li>
		    <li><a class="waves-effect" href="ProdutosUsuario.php#test-swipe-3">Seus Produtos Favoritados</a></li>
		      <li><a class="subheader">Trocas</a></li>
     		<li><a class="waves-effect" href="efetuaTroca.php">Pedidos para troca</a></li>
     		<li><a class="waves-effect" href="produtosTrocados.php">Produtos trocados</a></li>

		  </ul>
<!-- 
		  MENU MOBILE -->

	      <ul class="side-nav" id="menu-mobile">
	    
	    
	      <nav>
	      <div class="nav-wrapper">
	        <form action="./conexoesPhp/BarraDeBusca.php" method="POST">
		        <div class="input-field">
		          <input id="search" type="search" name="Pesquisa">
		          <label class="label-icon" for="search"><i class="material-icons">search</i></label>
		          <i class="material-icons">close</i>
		        </div>
	        </form>
	      </div>
	   	 </nav>

	        <li><a href="sass.html">Sass</a></li>
	        <li><a href="Index.php">Página Inicial</a></li>
	        <li><a href="collapsible.html">Javascript</a></li>
	        <li><a href="mobile.html">Mobile</a></li>
	      </ul>
    </div>
     
    
  </nav>


<!--   AQUI COMEÇA TODO O CONTEUDO DO SITE -->
	          



		
	<div class="container">	
		<div class="row">
			<div class="Header">
			
				<blockquote>
					Celulares novos
					<a href="#">Ver mais</a>
				</blockquote>
			
			</div>
				<div class="row">


						
				
				<?php 
					

					//Nessa linha eu estou fazendo o loop para pegar os anunucios de celulares
				while($DadosMostraCelular = mysqli_fetch_assoc($DadosCelular)){

					//Nessa linha eu estou atribuindo o codigo do celular a variável apra poder vê se ela está favoritada ou não
				$anuncioCelularNovoCod = $DadosMostraCelular['ancCodigo'];


					$DadosFavoritos = ' select favoritos_cod,favoritos_cod_anuncio,favoritos_cod_usuario,ancCodigo from favoritos inner join anuncio on favoritos_cod_anuncio = ancCodigo where ancCodigo ='.$anuncioCelularNovoCod.' and  favoritos_cod_usuario ='.$_SESSION['Login'];

					$FavoritosMostra = mysqli_query($oCon,$DadosFavoritos);

					
				?>
				

				
				    <div class="col l3 m3 s3">
 					<a  href="MostraProduto.php?id_produto=<?php echo $DadosMostraCelular['ancCodigo'];?>" >
				      <div class="card hoverable" style=" word-wrap: break-word;" >

				        <div class="card-image">

				        	 <?php 

				        	 //Nessa linha eu estou fazendo um select para pegar as fotos dos anuncios, porem, trazendo apenas uma
				        	 $Fotos = "select ancCodigo,fotoDescricao,foto_cod_usuario,foto_cod_anuncio from anuncio inner join fotosprodutos on ancCodigo = fotosprodutos.foto_cod_anuncio where foto_cod_anuncio =".$anuncioCelularNovoCod.' order by  foto_cod asc limit 1';

				        	 $DadosDasFotos = mysqli_query($oCon,$Fotos);

				        	 //Aquie eu estou fazendo o loop para trazer as fotos
				        	 while ($FotosEnd = mysqli_fetch_assoc($DadosDasFotos)) {
				          	
				          	?>
				          <img src="./Produtos/<?php echo $FotosEnd['fotoDescricao'] ?>">
				          

				          <?php 
				     		 }

				     		//Nessa linha eu verifico se o codigo relacionado aquele anuncio traz alguma linha ou seja, favoritado ou não. Se não estiver, ele traz o botão do coração sem estar preenchido
				          $linhas = mysqli_num_rows($FavoritosMostra);
				          if($linhas == 0){
				          	?>
				      			<a class="btn-floating halfway-fab waves-effect waves-light blue darken-2"  onclick="enviaFavorito(<?php echo $DadosMostraCelular['ancCodigo'];?>)" id="btnEsconderAnuncioQueBugaComABarraDeBusca"><i class="material-icons">favorite_border</i></a>
				      	
				      			<?php

				      			//Se estiver alguma linha ele entra no loop e pega o dado daquele anúncio
				          	}elseif($linhas > 0){

					          while($RegFav = mysqli_fetch_assoc($FavoritosMostra)) {

					      		?> 

					      		<a class="btn-floating halfway-fab waves-effect waves-light blue darken-2" id="btnEsconderAnuncioQueBugaComABarraDeBusca" onclick="TiraFavorito(<?php echo $DadosMostraCelular['ancCodigo'];?>)"><i class="material-icons">favorite</i></a>
				
					      		<?php			

					      	}

				      	}
				    
				          ?>
				      	         

				        </div>

				        <div class="card-content">
				        	<span class="card-title"><?php echo $DadosMostraCelular['ancTitulo']?></span>
				          <p id="Desc"><?php echo $DadosMostraCelular['ancDesc']?></p>
				        </div>

				       
				      </div>
				    
				  	</a>
				    </div>
			
					
				<?php
					
				}
			
				?>
				</div>
			</div>
				
		
		<!-- SEGUNDO BLOCO DE CONTEUDO -->
		
		<div class="row">
			<div class="Header">
			
				<blockquote>
					Jogos
					<a href="#">Ver mais</a>
				</blockquote>
			
			</div>
				<div class="row">
				
				
				<?php 
			
				//Nessa linha eu estou pegando os dados dos produtos relacionado a categoria de jogos
				while($DadosMostra = mysqli_fetch_assoc($Dados)){
			
				?>

			
				    <div class="col l3 m3 s3">
				    	<a href="MostraProduto.php?id_produto=<?php echo $DadosMostra['ancCodigo'];?>">
				      <div class="card hoverable" style="word-wrap: break-word;">
				        <div class="card-image">


				         <?php

				         //atribuindo o codigo a variável para poder comparar nos selects
				         $anuncioGeralCod = $DadosMostra['ancCodigo']; 


				        	 $Fotos = "select ancCodigo,fotoDescricao,foto_cod_usuario,foto_cod_anuncio from anuncio inner join fotosprodutos on ancCodigo = fotosprodutos.foto_cod_anuncio where foto_cod_anuncio =".$anuncioGeralCod.' order by  foto_cod asc limit 1';

				        	 $DadosDasFotos = mysqli_query($oCon,$Fotos);

				        	 //fazendo loop nas fotos, mas pegando apenas uma
				        	 while ($FotosEnd = mysqli_fetch_assoc($DadosDasFotos)) {
				          	
				          	?>
				          <img src="./Produtos/<?php echo $FotosEnd['fotoDescricao'] ?>">
				          

				          <?php 
				     		 }

				     $DadosFavoritos = ' select favoritos_cod,favoritos_cod_anuncio,favoritos_cod_usuario,ancCodigo from favoritos inner join anuncio on favoritos_cod_anuncio = ancCodigo where ancCodigo ='.$anuncioGeralCod.' and  favoritos_cod_usuario ='.$_SESSION['Login'];

					$FavoritosMostra = mysqli_query($oCon,$DadosFavoritos);


				    	//vendo se o favoritos traz alguma linha      
				        $linhas = mysqli_num_rows($FavoritosMostra);
				          if($linhas == 0){

				          	// se não pegou alguma linha, ele traz o coração vazio
				          	?>

				      			<a class="btn-floating halfway-fab waves-effect waves-light blue darken-2"  onclick="enviaFavorito(<?php echo $DadosMostra['ancCodigo'];?>)" id="btnFavoritado"><i class="material-icons">favorite_border</i></a>
				      	
				      			<?php
				          	}elseif($linhas > 0){
				          		//se trouxe, entra no loop e deixa o coração preenchido
					          while($RegFav = mysqli_fetch_assoc($FavoritosMostra)) {

					      		?> 

					      		<a class="btn-floating halfway-fab waves-effect waves-light blue darken-2" id="btnNaoFavoritado" onclick="TiraFavorito(<?php echo $DadosMostra['ancCodigo'];?>)"><i class="material-icons">favorite</i></a>
				
					      		<?php			

					      	}

				      	}
				    
				          ?>
				      	         
				        </div>
				        <div class="card-content">
				        	<span class="card-title"><?php echo $DadosMostra['ancTitulo']?></span>
				         	<p id="Desc"><?php echo $DadosMostra['ancDesc']?></p>
				        </div>

				      </div>
				  </a>
				    </div>
					
			
					
				<?php
				
				}
				?>
				</div>
				
		</div>
		
<!-- 		TERCEIRO BLOCO DE CONTEUDO -->
		
		<div class="row">
			<div class="Header">
			
				<blockquote>
					Produtos em geral novos
					<a href="#">Ver mais</a>
				</blockquote>
			
		</div>
				<div class="row">
				
				
				<?php 
			
				// Pegando os dados relacionado a carteogoria de produtos novos
				while($DadosMostra2 = mysqli_fetch_assoc($Dados2)){
			
				?>
				

					<div class="col l3 m3 s3">
						<a  href="MostraProduto.php?id_produto=<?php echo $DadosMostra2['ancCodigo'];?>">
				      <div class="card hoverable" style=" word-wrap: break-word;">
				        <div class="card-image">
				         <?php

				         //atribuindo o codigo do produto a uma vari´vel para filtrar nos selects
				         $anuncioGeralNovoCod = $DadosMostra2['ancCodigo']; 

				        	 $Fotos = "select ancCodigo,fotoDescricao,foto_cod_usuario,foto_cod_anuncio from anuncio inner join fotosprodutos on ancCodigo = fotosprodutos.foto_cod_anuncio where foto_cod_anuncio =".$anuncioGeralNovoCod.' order by  foto_cod asc limit 1';

				        	 $DadosDasFotos = mysqli_query($oCon,$Fotos);

				        	 //fazendo o loop para pegar as fotos, porem trazendo apenas uma
				        	 while ($FotosEnd = mysqli_fetch_assoc($DadosDasFotos)) {
				          	
				          	?>
				          <img src="./Produtos/<?php echo $FotosEnd['fotoDescricao'] ?>">
				          

				          <?php 
				     		 }
				     		 		 

				     $DadosFavoritos = ' select favoritos_cod,favoritos_cod_anuncio,favoritos_cod_usuario,ancCodigo from favoritos inner join anuncio on favoritos_cod_anuncio = ancCodigo where ancCodigo ='.$anuncioGeralNovoCod.' and  favoritos_cod_usuario ='.$_SESSION['Login'];

					$FavoritosMostra = mysqli_query($oCon,$DadosFavoritos);

				          //verificando se há alguma linha, se não tiver, traz o coração vazio
				        $linhas = mysqli_num_rows($FavoritosMostra);
				          if($linhas == 0){
				          	?>
				      			<a class="btn-floating halfway-fab waves-effect waves-light blue darken-2"  onclick="enviaFavorito(<?php echo $DadosMostra2['ancCodigo'];?>)" id="btnFavoritado"><i class="material-icons">favorite_border</i></a>
				      	
				      			<?php

				      			//se tiver, traz o coração preencido
				          	}elseif($linhas > 0){

					          while($RegFav = mysqli_fetch_assoc($FavoritosMostra)) {

					      		?> 

					      		<a class="btn-floating halfway-fab waves-effect waves-light blue darken-2" id="btnNaoFavoritado" onclick="TiraFavorito(<?php echo $DadosMostra2['ancCodigo'];?>)"><i class="material-icons">favorite</i></a>
				
					      		<?php			

					      	}

				      	}
				    
				          ?>
				        </div>
				        <div class="card-content">
				        	<span class="card-title"><?php echo $DadosMostra2['ancTitulo']?></span>
				          <p id="Desc"><?php echo $DadosMostra2['ancDesc']?></p>
				        </div>
				      </div>
				  </a>
				    </div>


			
					
				<?php
				
				}

				?>
				</div>
				
		</div>

<!--  	QUARTO BLOCO DE CONTEUDO -->

		<div class="row">
			<div class="Header">
			
				<blockquote>
					Livros
					<a href="#">Ver mais</a>
				</blockquote>
			
			</div>
				<div class="row">
				
				
				<?php 
			
			//Pegando os dados dos produtos dos livros
				while($MostraLivros = mysqli_fetch_assoc($DadosLivros)){
			
				?>
				

					<div class="col l3 m3 s3">
						<a href="MostraProduto.php?id_produto=<?php echo $MostraLivros['ancCodigo'];?>">
				      <div class="card hoverable" style=" word-wrap: break-word;">
				        <div class="card-image">
				         <?php

				         //atribuindo o codigo do produtos para poder filtrar nos outros selects
				         $anuncioLivroCod = $MostraLivros['ancCodigo']; 

				        	 $Fotos = "select ancCodigo,fotoDescricao,foto_cod_usuario,foto_cod_anuncio from anuncio inner join fotosprodutos on ancCodigo = fotosprodutos.foto_cod_anuncio where foto_cod_anuncio =".$anuncioLivroCod.' order by  foto_cod asc limit 1';

				        	 $DadosDasFotos = mysqli_query($oCon,$Fotos);

				        	 //Loop das fotos 
				        	 while ($FotosEnd = mysqli_fetch_assoc($DadosDasFotos)) {
				          	
				          	?>
				          <img src="./Produtos/<?php echo $FotosEnd['fotoDescricao'] ?>">
				          

				          <?php 
				     		 }
					     		 		 

					     $DadosFavoritos = 'select favoritos_cod,favoritos_cod_anuncio,favoritos_cod_usuario,ancCodigo from favoritos inner join anuncio on favoritos_cod_anuncio = ancCodigo where ancCodigo ='.$anuncioLivroCod.' and  favoritos_cod_usuario ='.$_SESSION['Login'];

						$FavoritosMostra = mysqli_query($oCon,$DadosFavoritos);

				          //se não tiver nenhuma linha de favoritos desse produtos, traz o coração vazio
				        $linhas = mysqli_num_rows($FavoritosMostra);
				          if($linhas == 0){
				          	?>
				      			<a class="btn-floating halfway-fab waves-effect waves-light blue darken-2"  onclick="enviaFavorito(<?php echo $MostraLivros['ancCodigo'];?>)" id="btnFavoritado"><i class="material-icons">favorite_border</i></a>
				      	
				      			<?php

				      			//se tiver alguma linha, traz o coração preechido
				          	}elseif($linhas > 0){

					          while($RegFav = mysqli_fetch_assoc($FavoritosMostra)) {

					      		?> 

					      		<a class="btn-floating halfway-fab waves-effect waves-light blue darken-2" id="btnNaoFavoritado" onclick="TiraFavorito(<?php echo $MostraLivros['ancCodigo'];?>)"><i class="material-icons">favorite</i></a>
				
					      		<?php			

					      	}

				      	}
				    
				          ?>
				        </div>
				        <div class="card-content">
				        	<span class="card-title"><?php echo $MostraLivros['ancTitulo']?></span>
				          <p id="Desc"><?php echo $MostraLivros['ancDesc']?></p>
				        </div>

				       
				      </div>
				  </a>
				    </div>


			
					
				<?php
				
				}

				?>
				</div>
				
		</div>
			


			<!-- dropdown de categorias -->
		<ul id = "categorias" class="dropdown-content">
			<?php
				$Categoria = 'select ctgCodigo,ctgNome from categoria where ctgNome != "Nenhum" ';
				$DadosCategoria = mysqli_query($oCon,$Categoria);
				while($RegCategoria = mysqli_fetch_assoc($DadosCategoria)){
			?>

         	<a href="ResultadoCategoria.php?categoria=<?php echo $RegCategoria['ctgCodigo']?>"><li><?php echo $RegCategoria['ctgNome'] ?></li></a>
         	<?php
         }
         	?>
      </ul>
      
      
	</div>



	</body>

	<!-- jquery -->
	<script src="./javascript/jQuery.js"></script>



	<!-- para realizar o gif do golfinho -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
	<!-- Materialize JavaScript -->
	<script src="./Materialize/js/materialize.js"></script>


	<!-- Menu dropdown -->
	<script> 
	$(".button-collapse").sideNav();

	$(".button").sideNav();


	$(document).ready(function () {
	    $("#carregandoPagina").show();
	    $(window).load(function () {
	        // Quando a página estiver totalmente carregada, remove o id
	        $('#carregandoPagina').fadeOut('slow');
	    });
	});


//Animação da instrução para clilcar no entrar
$(document).ready(function(){
    $('.tooltipped').tooltip();
  });


$(function(){
	$("#pesquisa").keyup(function(){
		var pesquisa = $(this).val();

		//verifica se algo foi digitado
		if(pesquisa != ''){
			var dados = {
			palavra : pesquisa
		}
		
	
		$.post('./conexoesPhp/BarraDeBusca.php',dados,function(retorna){
			$(".resultado").html(retorna);
			$(".resultado").css("display","inline-grid");
		});
	}else{
		(".resultado").html('');	
		$(".resultado").css("display","none");
	}
	});
});


	$(".open_left").sideNav({
  		edge: 'left'
	});
	
	$(".open_right").sideNav({
  		edge: 'right'
	});



</script>
</html>
	<?php



	}
	 
	 



	mysqli_free_result($Dados);
	mysqli_free_result($DadosCelular);
	mysqli_free_result($DadosUsuario);
	mysqli_close($oCon);
	?>