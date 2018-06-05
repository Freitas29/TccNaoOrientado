<html>
	<?php

	session_start();

	if((!isset ($_SESSION['Login']))){
	header('location:Index.php');
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
			document.getElementById('ResultadoBusca').style.display="none"
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
    z-index: 1;
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

	</style>

	<body onclick="FechaTudo()" style="background-color: white;">

	<?php

			include './conexoesPhp/Conexao.php';
			
			$ConteudoCelular = 'select ancTitulo,ancDesc,ancCodigo from anuncio  where ancCod_Categoria=4 and ancCod_Criador != '.$_SESSION['Login'].' order by ancCodigo desc limit 4';
			
			$Usuario = 'select usrEmail,usrApelido,usrFoto from usuario where UsrCodigo='.$_SESSION['Login'];
			
			//jogos
			$Conteudo = ' select ancTitulo,ancDesc,ancCodigo from anuncio  where ancCod_Categoria=5 and ancCod_Criador != '.$_SESSION['Login'].' order by ancCodigo desc limit 4';
			
			$Conteudo2 = 'select * from anuncio where ancCod_Criador != '.$_SESSION['Login'].' order by ancCodigo desc limit 4';

			$Livros = 'select ancTitulo,ancDesc,ancCodigo from anuncio  where ancCod_Categoria=2 and ancCod_Criador != '.$_SESSION['Login'].'  order by ancCodigo desc limit 4';

			$DadosLivros = mysqli_query($oCon,$Livros);
			
			$Dados = mysqli_query($oCon,$Conteudo);
			
			$Dados2 = mysqli_query($oCon,$Conteudo2);
			
			$DadosCelular = mysqli_query($oCon,$ConteudoCelular);
			
			$DadosUsuario = mysqli_query($oCon,$Usuario);

			if($RegUsuario = mysqli_fetch_assoc($DadosUsuario)){
			
	?>



	

	  <nav class="nav">
    <div class="nav-wrapper container" >
  
	      <a href="#!" class="brand-logo left">Logo</a>

	      
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
     		<li><a class="waves-effect" href="#!">Pedidos para troca</a></li>
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

  <div class="container">

  <div class="row">



  </div>


  </div>



  <?php

}
  ?>