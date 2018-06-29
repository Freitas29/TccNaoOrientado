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
			document.getElementById('ResultadoBusca').style.display="none"
		}
	}

function SalvaRegistro(valor,valor2){
	if(confirm("Deseja realmente trocar?\nAnote o número do usuário antes de confirmar!\nEnviaremos um e-mail para você com dados de  contato do usuário!")){
	var Objeto = new XMLHttpRequest();
			with(Objeto){
			
			open('GET','./conexoesPhp/efetuaTrocaDoProduto.php?id_produto='+valor+'&id_produto2='+valor2+'');
			
			send();
				onload = function(){
					location.reload();
				}
			}
		}
} 

function DeletaNotificacao(valor){
	if(confirm("Excluir notificação?")){
		var Objeto = new XMLHttpRequest();
			
			
			with(Objeto){
			
			open('GET','./conexoesPhp/excluiNotificacao.php?id_produto='+valor);
			
			send();
				onload = function(){
					location.reload();
				}
			}
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
	}
	.material-icons {
    font-family: 'Material Icons';
    font-weight: normal;
    font-style: normal;
    font-size: 1500%;
    line-height: 1;
    letter-spacing: normal;
    text-transform: none;
    display: inline-block;
    white-space: nowrap;
    word-wrap: normal;
    direction: ltr;
    -webkit-font-feature-settings: 'liga';
    -webkit-font-smoothing: antialiased;
}

	</style>

	<body onclick="FechaTudo()" style="background-color: white;">

	<?php

			include './conexoesPhp/Conexao.php';
			
			
			
			$Usuario = 'select usrEmail,usrApelido,usrFoto from usuario where UsrCodigo='.$_SESSION['Login'];
			
			$DadosUsuario = mysqli_query($oCon,$Usuario);

			

			if($RegUsuario = mysqli_fetch_assoc($DadosUsuario)){
			
	?>



	

	  <nav class="nav">
    <div class="nav-wrapper container" >
  
	      <a href="Logado.php" class="brand-logo left" style="width: 27%;"><img src="./imagens/logotipo.png" style="width: 46%"></a>


	      
	      <a href="#" data-activates="menu-mobile" class="button-collapse right"><i class="material-icons">menu</i></a>

	      <ul class="right hide-on-med-and-down" style="width: 70%;">
	      	<li style="width: 59%;">

	        <div class="nav-wrapper" >

	        	<!-- Buscar de produtos pelo site -->

		        <form action="" method="POST" id="formPesquisa" >
			        <div class="input-field" style="background-color:  #fff;">

			          <input id="pesquisa" type="search" name="pesquisa" onfocus="AtivaBusca()">
			          
			          <label class="label-icon" for="search"><i class="material-icons" style="color:#000;">search</i></label>
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
		     
		     <li><a class="dropdown-button" href="#" data-activates="categorias" onclick="mostraCategoria()">Categorias</a></li>
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

<div class="row">
	<div class="container">

<!--Conteudo do ste começa aqui -->

<?php


if(isset($_SESSION['trocas'])){
					echo "<p style='font-size: 40px;font-weight:  900;color: #00b4ff;'>Troca efetuada com sucesso</p>";
					unset($_SESSION['trocas']);
				}

//Trocado é diferente de um pois tudo que for igual a 1 significa que ele já foi trocado e não aparecera no select
	$DadosQuemRecebe = "select distinct ancTitulo,usrApelido,ancCodigo,ancDesc from anuncio inner join trocas t on anuncioEnvia = ancCodigo inner join usuario on usuarioRecebe = UsrCodigo where usuarioRecebe = ".$_SESSION['Login']."  and t.trocado != 1";
	$ResultadoQuemRecebe = mysqli_query($oCon,$DadosQuemRecebe);

	$LinhasResultantesQuemRecebe = mysqli_num_rows($ResultadoQuemRecebe);

		//Aqui já que não trouxe nenhum resultado verificarei se ele tem algum produto que foi solcitado a outro usuário
		$DadosQuemEnvia = "select ancTitulo,usrApelido,ancCodigo,ancDesc from anuncio inner join trocas t on anuncioRecebe = ancCodigo inner join usuario on usuarioRecebe = UsrCodigo where usuarioEnvia = ".$_SESSION['Login']."  and t.trocado != 1";
		$ResultadoQuemEnvia = mysqli_query($oCon,$DadosQuemEnvia);
		$LinhasResultantesQuemEnvia = mysqli_num_rows($ResultadoQuemEnvia);
		while($RegQuemEnvia = mysqli_fetch_assoc($ResultadoQuemEnvia)){

			//Essas variáveis serão usadas para mostrar num modal qual é o anuncio que o usuário atual recebeu solicitaçao para troca

			?>

			<!-- Estilo dos cards e as fotos -->


				    <div class="col l3 m3 s3">
 					<a  href="MostraProduto.php?id_produto=<?php echo $RegQuemEnvia['ancCodigo'];?>" >

				      <div class="card hoverable" style=" word-wrap: break-word;" >

				        <div class="card-image">

				        	 <?php
				        	  
			                    

				        	 //Nessa linha eu estou fazendo um select para pegar as fotos dos anuncios, porem, trazendo apenas uma
				        	 $Fotos = "select ancCodigo,fotoDescricao,foto_cod_usuario,foto_cod_anuncio from anuncio inner join fotosprodutos on ancCodigo = fotosprodutos.foto_cod_anuncio where foto_cod_anuncio =".$RegQuemEnvia['ancCodigo'].' order by  foto_cod asc limit 1';

				        	 $DadosDasFotos = mysqli_query($oCon,$Fotos);

				        	 //Aquie eu estou fazendo o loop para trazer as fotos
				        	 while ($FotosEnd = mysqli_fetch_assoc($DadosDasFotos)) {
				          	
				          	?>
				          <img src="./Produtos/<?php echo $FotosEnd['fotoDescricao'] ?>">
				          <?php
				      }
				          ?>

				        </div>
				        </a>
				        <div class="card-content">
				        	<p class="card-title"><?php echo $RegQuemEnvia['ancTitulo']?></p>
				          	<p id="Desc"><?php echo $RegQuemEnvia['ancDesc']?></p>
				        	<button class="btn disabled">Pedido Pendente</button>  	
				        
				        </div>

				       
				      </div>
				    
				  	
				    </div>



			<?php
		}
		}
		if($LinhasResultantesQuemEnvia == 0 && $LinhasResultantesQuemRecebe == 0){
		echo "<p style='font-size: 30px;'>Você não possui nenhum pedido de troca ou alguma troca pendente!</p>";
	}
	
		while($RegQuemRecebe = mysqli_fetch_assoc($ResultadoQuemRecebe)){

			?>


			  <div class="col l3 m3 s3">
 					<a  href="MostraProduto.php?id_produto=<?php echo $RegQuemRecebe['ancCodigo'];?>" >
				      <div class="card hoverable" style=" word-wrap: break-word;" >

				        <div class="card-image">

				        	 <?php 

				        	 //Nessa linha eu estou fazendo um select para pegar as fotos dos anuncios, porem, trazendo apenas uma
				        	 $Fotos = "select ancCodigo,fotoDescricao,ancDesc,ancCodigo,foto_cod_usuario,foto_cod_anuncio from anuncio inner join fotosprodutos on ancCodigo = fotosprodutos.foto_cod_anuncio where foto_cod_anuncio =".$RegQuemRecebe['ancCodigo'].' order by  foto_cod asc limit 1';

				        	 $DadosDasFotos = mysqli_query($oCon,$Fotos);

				        	 //Aquie eu estou fazendo o loop para trazer as fotos
				        	 while ($FotosEnd = mysqli_fetch_assoc($DadosDasFotos)) {
				          
				          	?>
				          <img src="./Produtos/<?php echo $FotosEnd['fotoDescricao'] ?>">

				          <?php

				      }
				      $codigoParaModal = $RegQuemRecebe['ancCodigo'];
				    
				      
				          ?>

				        </div>
						</a>
				        <div class="card-content">
				        	<p class="card-title"><?php echo $RegQuemRecebe['ancTitulo']?></p>
				          <p id="Desc"><?php echo $RegQuemRecebe['ancDesc']?></p>
				          <button data-target="<?php echo $codigoParaModal ?>" class="btn modal-trigger">Finalizar</button>
				        </div>

				       
				      </div>
				    
				  	
				    </div>

				     <!-- Modal Structure -->
  <div id="<?php echo $codigoParaModal?>" class="modal" style="top: 10%;height:  50%;">
    <div class="modal-content">
					     <div class="col l3 m3 s3" style="display: inherit;">
					 					<a  href="MostraProduto.php?id_produto=<?php echo $RegQuemRecebe['ancCodigo'];?>" >
									      <div class="card hoverable" style=" word-wrap: break-word;" >

									        <div class="card-image">

									        	 <?php 

									        	 
									        	 //Nessa linha eu estou fazendo um select para pegar as fotos dos anuncios, porem, trazendo apenas uma
									        	 $FotosAnuncio = "select ancCodigo,fotoDescricao,ancDesc,foto_cod_usuario,foto_cod_anuncio from anuncio inner join fotosprodutos on ancCodigo = fotosprodutos.foto_cod_anuncio where foto_cod_anuncio =".$RegQuemRecebe['ancCodigo'].' order by  foto_cod asc limit 1';

									        	 

									        	 $DadosDasFotosAnuncio = mysqli_query($oCon,$FotosAnuncio);

									        	 //Aquie eu estou fazendo o loop para trazer as fotos
									        	 while ($FotosEndereco = mysqli_fetch_assoc($DadosDasFotosAnuncio)) {
									          
									          	?>
									          <img src="./Produtos/<?php echo $FotosEndereco['fotoDescricao'] ?>">
									          
									          <?php
												}
									          ?>
									        </div>
											</a>
									        <div class="card-content">
									        	<p class="card-title"><?php echo $RegQuemRecebe['ancTitulo']?></p>
									          <p id="Desc"><?php echo $RegQuemRecebe['ancDesc']?></p>
									         
									        </div>

				       
				      	</div>

				      	<div style="position: relative;left: 120%;top: -230px;">
				      	<i class="material-icons">cached</i>
				    	</div>
				    <?php
						//Esse bloco traz o anuncio do usuário atual que está sendo solicitado para ser trocado
						$anuncioEscolhido = ' select  ancTitulo,ancCodigo,ancDesc,ancTitulo,a.trocado,idTroca from anuncio a inner join trocas on anuncioRecebe = ancCodigo where anuncioEnvia = '.$RegQuemRecebe['ancCodigo'];
						$ResultadoDoProdutoNoQualFoiSelecionado = mysqli_query($oCon,$anuncioEscolhido);
						while($Reg = mysqli_fetch_assoc($ResultadoDoProdutoNoQualFoiSelecionado)){

							
							?>

						
							
									      <div class="card" style="word-wrap: break-word;position:  relative;top: -470px;left: 240%;" >

									        <div class="card-image">

									        	 <?php 

									        	 //Nessa linha eu estou fazendo um select para pegar as fotos dos anuncios, porem, trazendo apenas uma
									        	 $Fotos = "select ancCodigo,fotoDescricao,ancDesc,ancCodigo,foto_cod_usuario,foto_cod_anuncio from anuncio inner join fotosprodutos on ancCodigo = fotosprodutos.foto_cod_anuncio where foto_cod_anuncio =".$Reg['ancCodigo'].' order by  foto_cod asc limit 1';

									        	 $DadosDasFotos = mysqli_query($oCon,$Fotos);

									        	 //Aquie eu estou fazendo o loop para trazer as fotos
									        	 while ($FotosEnd = mysqli_fetch_assoc($DadosDasFotos)) {
									          
									          	?>
									          <img src="./Produtos/<?php echo $FotosEnd['fotoDescricao'] ?>">
									          
									          <?php

													}
									          ?>
									        </div>


									
									        <div class="card-content">
									        	<p class="card-title"><?php echo $Reg['ancTitulo']?></p>
									          <p id="Desc"><?php echo $Reg['ancDesc']?></p>
									           <?php
											    if($Reg['trocado'] == 0){
													
												
											    ?>
											      <button class="blue darken-2 waves-effect waves-light btn  N/A-text text-N/A" onclick="SalvaRegistro(<?php echo $RegQuemRecebe['ancCodigo'].",". $Reg['ancCodigo'] ?>)">Aceitar</button>
											    
											    <?php
											}else{

											    ?>
											   <button class="btn disabled">Anuncio já trocado</button> 
											   <button class="btn" onclick="DeletaNotificacao(<?php echo $Reg['idTroca']?>)">Excluir notificação?</button>  
											   	
											    <?php
											    }
											    ?>
									        </div> 
							</div>
					
			<?php
 			}
			?>
				  	
				   
    </div>

   
 </div>
  
  </div>

 



  <?php
 			
  	}

  	mysqli_free_result($ResultadoQuemRecebe);
  ?>

</body>
<!-- jquery -->
<script src="./javascript/jQuery.js"></script>
<!-- Materialize JavaScript -->
<script src="./Materialize/js/materialize.js"></script>
<script>

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


	$(document).ready(function(){
    $('.modal').modal();
  });

	$(".button-collapse").sideNav();

	$(".button").sideNav();
          
	
</script>