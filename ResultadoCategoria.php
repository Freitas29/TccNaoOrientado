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
	<link href="http://localhost/MaterialIcons-Regular.eot" rel="stylesheet">
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

	function mostraCategoria(){
		document.getElementById('categorias').style.display="inline-table";
	}

	

	</script>

	<style>
		@font-face {
	  font-family: 'Material Icons';
	  font-style: normal;
	  font-weight: 400;
	  src: url(iconfont/MaterialIcons-Regular.eot); /* For IE6-8 */
	  src: local('Material Icons'),
	    local('MaterialIcons-Regular'),
	    url(iconfont/MaterialIcons-Regular.woff2) format('woff2'),
	    url(iconfont/MaterialIcons-Regular.woff) format('woff'),
	    url(iconfont/MaterialIcons-Regular.ttf) format('truetype');
}

.material-icons {
  font-family: 'Material Icons';
  font-weight: normal;
  font-style: normal;
  font-size: 24px;  /* Preferred icon size */
  display: inline-block;
  line-height: 1;
  text-transform: none;
  letter-spacing: normal;
  word-wrap: normal;
  white-space: nowrap;
  direction: ltr;

  /* Support for all WebKit browsers. */
  -webkit-font-smoothing: antialiased;
  /* Support for Safari and Chrome. */
  text-rendering: optimizeLegibility;

  /* Support for Firefox. */
  -moz-osx-font-smoothing: grayscale;

  /* Support for IE. */
  font-feature-settings: 'liga';
}

	nav{
		
		background-color:#1e88e5 !important;
	}

	blockquote{
		border-left:5px solid #1e88e5 !important
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
     z-index: 999;
    width: 100%;
    height: 100%;
    display: none;
    position: absolute;
    top: 100%;
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

	ul#categorias{
		display: inline-table;
	}
	.dropdown-content li{
		text-align: center;
	}
	.naoenco {
   	    height: auto;
    	width: 250px;
    	position: relative;
    	top: 250px;
    	left: 40%; 
	}

	
	</style>

	<body onclick="FechaTudo()" style="background-color: white;">

	<?php

			include './conexoesPhp/Conexao.php';
			
		
			
			$Usuario = 'select usrEmail,usrApelido,usrFoto from usuario where UsrCodigo='.$_SESSION['Login'];
			
			$DadosUsuario = mysqli_query($oCon,$Usuario);

			if($RegUsuario = mysqli_fetch_assoc($DadosUsuario)){
			
	?>



			<!-- dropdown de categorias -->
		<ul id = "categorias" class="dropdown-content" style="display:none;">
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
      
	  <nav class="nav">
    <div class="nav-wrapper container">
  
	       <a href="Logado.php" class="brand-logo left" style="width: 27%;"><img src="./imagens/logotipo.png" style="width: 46%"></a>


	      
	       <a href="Logado.php" class="brand-logo left"><img src="./imagens/logotipo.png" style="width: 12.3%"></a>

	      <ul class="right hide-on-med-and-down" style="width: 70%;">
	      	<li style="width: 59%;">

	        <div class="nav-wrapper" >

	        	<!-- Buscar de produtos pelo site -->

		        <form action="" method="POST" id="formPesquisa">
			        <div class="input-field" style="background-color:  #fff;">

			          <input id="pesquisa" type="search" name="pesquisa" onfocus="AtivaBusca()" onblur="DesativaForm()">
			          
			          <label class="label-icon" for="search"><i class="material-icons" style="color:#000;">search</i></label>
			          <i class="material-icons">close</i>
			        
	       		 </form>
					<!--traz os dados da busca -->
	       		<div id="divDaBusca">
		       		 <ul class="resultado" id="ResultadoBusca">


		       		 </ul>

		       	 </div>
	       	
	      	</div>

	      <li><a data-activates="slide-out" class="button tooltipped" data-position="bottom" data-tooltip="Clique para abrir o menu de usuário"><?php echo $RegUsuario['usrApelido'];?></a></li>
		    <li><a href="./conexoesPhp/Deslogar.php">Sair</a></li>
		     <li><a href="Logado.php">Página Inicial</a></li>
		     <li><a class="dropdown-button" href="#" data-activates="categorias" onclick="mostraCategoria()">Categorias
         	<i class ="mdi-navigation-arrow-drop-down right"></i></a></li>
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
     	<ul id = "categorias" class="dropdown-content">
			<?php
				$Categoria = 'select ctgCodigo,ctgNome from categoria where ctgNome != "Nenhum" ';

				$DadosCategoria = mysqli_query($oCon,$Categoria);

				while($RegCategoria = mysqli_fetch_assoc($DadosCategoria)){
			?>

         	<li><a href="#"></a><?php echo $RegCategoria['ctgNome'] ?></a></li>
         	<?php
         }
         	?>
      </ul>

    
  </nav>

  
	<div class="container">
	  <div class="row">
	  	<?php
	  	$codigo = $_GET['categoria'];
  	$SelecionaCategoria = "select ancTitulo,ancCodigo,ancDesc,fotoDescricao from anuncio inner join fotosprodutos on ancCodigo = foto_cod_anuncio where ancCod_Categoria = '$codigo' and trocado = 0";

  $resultado = mysqli_query($oCon,$SelecionaCategoria);
  $resultadoDaCategoria = mysqli_num_rows($resultado);
		if($resultadoDaCategoria <=0){

		// resultado com imagem nessa parte do codigo
		echo "<img class='naoenco'src='./imagens/nothing-found.png'/>";	
		}else{



	  while ($RegCategoria = mysqli_fetch_assoc($resultado)){
	  		$anuncioCelularNovoCod = $RegCategoria['ancCodigo'];


					$DadosFavoritos = ' select favoritos_cod,favoritos_cod_anuncio,favoritos_cod_usuario,ancCodigo from favoritos inner join anuncio on favoritos_cod_anuncio = ancCodigo where ancCodigo ='.$anuncioCelularNovoCod.' and  favoritos_cod_usuario ='.$_SESSION['Login'];

					$FavoritosMostra = mysqli_query($oCon,$DadosFavoritos);
	  		?>
	  		  <div class="col l3 m3 s3">
 					<a  href="MostraProduto.php?id_produto=<?php echo $RegCategoria['ancCodigo'];?>" >
				      <div class="card hoverable" style=" word-wrap: break-word;" >

				        <div class="card-image">
				        	 <img src="./Produtos/<?php echo $RegCategoria['fotoDescricao'] ?>">
				        	<?php

				     		//Nessa linha eu verifico se o codigo relacionado aquele anuncio traz alguma linha ou seja, favoritado ou não. Se não estiver, ele traz o botão do coração sem estar preenchido
				          $linhas = mysqli_num_rows($FavoritosMostra);
				          if($linhas == 0){
				          	?>
				      			<a class="btn-floating halfway-fab waves-effect waves-light blue darken-2"  onclick="enviaFavorito(<?php echo $RegCategoria['ancCodigo'];?>)" id="btnEsconderAnuncioQueBugaComABarraDeBusca"><i class="material-icons">favorite_border</i></a>
				      	
				      			<?php

				      			//Se estiver alguma linha ele entra no loop e pega o dado daquele anúncio
				          	}elseif($linhas > 0){

					          while($RegFav = mysqli_fetch_assoc($FavoritosMostra)) {

					      		?> 

					      		<a class="btn-floating halfway-fab waves-effect waves-light blue darken-2" id="btnEsconderAnuncioQueBugaComABarraDeBusca" onclick="TiraFavorito(<?php echo $RegCategoria['ancCodigo'];?>)"><i class="material-icons">favorite</i></a>
				
					      		<?php			

					      	}

				      	}
				    
				          ?>
				      	         

				        </div>

				        <div class="card-content">
				        	<span class="card-title"><?php echo $RegCategoria['ancTitulo']?></span>
				          <p id="Desc"><?php echo $RegCategoria['ancDesc']?></p>
				        </div>

				       
				      </div>
				    
				  	</a>
				</div>
			<?php
		}
		}
		
			?>
	 </div>
	</div>
	  

</body>
<!-- jquery -->
<script src="./javascript/jQuery.js"></script>


	<!-- para realizar o gif do golfinho -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
	<!-- Materialize JavaScript -->
	<script src="./Materialize/js/materialize.js"></script>
<script type="text/javascript">



	$(".button-collapse").sideNav();

	$(".button").sideNav();

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




</script>

  <?php
}
  ?>