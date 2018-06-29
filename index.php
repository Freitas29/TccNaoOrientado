<html>
<?php
session_start();
if((!isset ($_SESSION['Login']))){
?>


<head>

<!-- Css do materialize -->
<link rel="stylesheet" href="./Materialize/css/materialize.css">

<meta charset="utf-8">
<link href="http://localhost/MaterialIcons-Regular.eot" rel="stylesheet">
</head>

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


	#Descricao{
		display: none;	
		transition: 2s;
	}

	.card:hover #Descricao{
		visibility: visible;
		box-shadow: 5px 5px 5px 5px #ddd;
		transition: 2s;
		display: block;

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

</style>

<script type="text/javascript">
	function FechaTudo(){
		document.getElementById('menu-mobile').style.visibility="visible";
		DesativaForm();
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

	function mostraCategoria(){
		document.getElementById('categorias').style.display="inline-table";
	}

</script>


<body style="background-color: white;" onclick="FechaTudo()">

<?php

		include './conexoesPhp/Conexao.php';
		
		$ConteudoLivro = 'select ancCodigo,ancTitulo,ancDesc from anuncio where ancCod_Categoria=2 and trocado = 0  order by ancCodigo desc limit 4';
		
		$Conteudo = 'select * from anuncio where trocado = 0 limit 4';
		
		$Conteudo2 = 'select * from anuncio where trocado = 0 order by ancCodigo desc limit 4';
		
		$Dados = mysqli_query($oCon,$Conteudo);
		
		$Dados2 = mysqli_query($oCon,$Conteudo2);
		
		$DadosLivro = mysqli_query($oCon,$ConteudoLivro);

		//Cabeçalho sem estar logado
		include 'Header.php';
?>




	
<div class="container">	
	<div class="row">
		<div class="Header">
		
			<blockquote>
				Livros novos
				<a href="#">Ver mais</a>
			</blockquote>
		
		</div>
			<div class="row">
			
			
			<?php 
		
			while($DadosMostraCelular = mysqli_fetch_assoc($DadosLivro)){
			$anuncioCelularNovoCod = $DadosMostraCelular['ancCodigo'];
			?>
			

			
			    <div class="col l3 m3 s3">
			    	<a href="MostraProdutoDeslogado.php?id_produto=<?php echo $DadosMostraCelular['ancCodigo'];?>">
			      <div class="card hoverable">
			        <div class="card-image">
			          <?php 

				        	 $Fotos = "select ancCodigo,fotoDescricao,foto_cod_usuario,foto_cod_anuncio from anuncio inner join fotosprodutos on ancCodigo = fotosprodutos.foto_cod_anuncio where foto_cod_anuncio =".$anuncioCelularNovoCod.' order by  foto_cod asc limit 1';

				        	 $DadosDasFotos = mysqli_query($oCon,$Fotos);

				        	 while ($FotosEnd = mysqli_fetch_assoc($DadosDasFotos)) {
				          	
				          	?>
				          <img src="./Produtos/<?php echo $FotosEnd['fotoDescricao'] ?>">
				          
				          <?php

				      }
				          ?>
			          
			          <a class="btn-floating halfway-fab waves-effect waves-light blue darken-2 modal-trigger" href="#modal1" ><i class="material-icons">favorite_border</i></a>
			        </div>
			        <div class="card-content" style="overflow:hidden">
			        	<p class="card-title" style="width: 22ch;text-overflow:  ellipsis;"><?php echo $DadosMostraCelular['ancTitulo']?></php>
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
	
	<div class="row">
		<div class="Header">
		
			<blockquote>
				Produtos em geral
				<a href="#">Ver mais</a>
			</blockquote>
		
		</div>
			<div class="row">
			
			
			<?php 
		
			while($DadosMostra = mysqli_fetch_assoc($Dados)){
		
			?>

		
			    <div class="col l3 m3 s3">
			    	<a href="MostraProdutoDeslogado.php?id_produto=<?php echo $DadosMostra['ancCodigo'];?>">
			      <div class="card hoverable">
			        <div class="card-image">
			           <?php
				         $anuncioGeralCod = $DadosMostra['ancCodigo']; 

				        	 $Fotos = "select ancCodigo,fotoDescricao,foto_cod_usuario,foto_cod_anuncio from anuncio inner join fotosprodutos on ancCodigo = fotosprodutos.foto_cod_anuncio where foto_cod_anuncio =".$anuncioGeralCod.' order by  foto_cod asc limit 1';

				        	 $DadosDasFotos = mysqli_query($oCon,$Fotos);

				        	 while ($FotosEnd = mysqli_fetch_assoc($DadosDasFotos)) {
				          	
				          	?>
				          <img src="./Produtos/<?php echo $FotosEnd['fotoDescricao'] ?>">
				          

				          <?php 
				     		 }
				     	?>
			          
			          <a class="btn-floating halfway-fab waves-effect waves-light blue darken-2 modal-trigger" href="#modal1"><i class="material-icons">favorite_border</i></a>
			        </div>
			        <div class="card-content" style="overflow:hidden;">
			        	<p class="card-title" style="width: 22ch;text-overflow:  ellipsis;"><?php echo $DadosMostra['ancTitulo']?></p>
			         	<p id="Desc"><?php echo $DadosMostra['ancDesc']?></p>
			        </div>
					

			      </div>
			    </div>
				
		
				
			<?php
			
			}
			?>
			</div>
			
	</div>
	
	
	<div class="row">
		<div class="Header">
		
			<blockquote>
				Produtos em geral novos
				<a href="#">Ver mais</a>
			</blockquote>
		
	</div>
			<div class="row">
			
			
			<?php 
		
			while($DadosMostra2 = mysqli_fetch_assoc($Dados2)){
		
			?>
			

				<div class="col l3 m3 s3">
					<a href="MostraProdutoDeslogado.php?id_produto=<?php echo $DadosMostra2['ancCodigo'];?>">
			      <div class="card hoverable" >
			        <div class="card-image">
			         <?php
				         $anuncioGeralNovoCod = $DadosMostra2['ancCodigo']; 

				        	 $Fotos = "select ancCodigo,fotoDescricao,foto_cod_usuario,foto_cod_anuncio from anuncio inner join fotosprodutos on ancCodigo = fotosprodutos.foto_cod_anuncio where foto_cod_anuncio =".$anuncioGeralNovoCod.' order by  foto_cod asc limit 1';

				        	 $DadosDasFotos = mysqli_query($oCon,$Fotos);

				        	 while ($FotosEnd = mysqli_fetch_assoc($DadosDasFotos)) {
				          	
				          	?>
				          <img src="./Produtos/<?php echo $FotosEnd['fotoDescricao'] ?>">
				          

				          <?php 
				     		 }
				     		?>
			          
			          <a class="btn-floating halfway-fab waves-effect waves-light blue darken-2 modal-trigger" href="#modal1"><i class="material-icons">favorite_border</i></a>
			        </div>
			        <div class="card-content" style="overflow:hidden;">
			        	<p class="card-title" style="width: 22ch;text-overflow:  ellipsis;"><?php echo $DadosMostra2['ancTitulo']?></p>
			          	<p id="Desc"><?php echo $DadosMostra2['ancDesc']?></p>
			        </div>

			        
			      </div>
			    </div>


		
				
			<?php
			
			}

			
			?>
			</div>
			
	</div>
	
	
	
	
</div>

<!-- recaptcha -->
<script src='https://www.google.com/recaptcha/api.js?hl=pt-BR'></script>

<!-- jquery -->
<script src="./javascript/jQuery.js"></script>

<!-- Materialize JavaScript -->
<script src="./Materialize/js/materialize.js"></script>


<!-- Menu dropdown -->
<script> 
$(".button-collapse").sideNav();


// Modal de login
$(document).ready(function(){
    $('.modal').modal();
  });

$(function(){
	$("#pesquisa").keyup(function(){
		var pesquisa = $(this).val();

		//verifica se algo foi digitado
		if(pesquisa != ''){
			var dados = {
			palavra : pesquisa
		}
		
	
		$.post('./conexoesPhp/BarraDeBuscaDeslogado.php',dados,function(retorna){
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



</body>
<?php

mysqli_close($oCon);
mysqli_free_result($Dados);
mysqli_free_result($Dados2);
mysqli_free_result($DadosLivro);


}else{


header('location:Logado.php');

}
?>