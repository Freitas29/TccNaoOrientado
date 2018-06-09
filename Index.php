<html>
<?php
session_start();
if((!isset ($_SESSION['Login']))){
?>


<head>

<!-- Css do materialize -->
<link rel="stylesheet" href="./Materialize/css/materialize.css">

<meta charset="utf-8">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<style>
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

<body style="background-color: white;">

<?php

		include './conexoesPhp/Conexao.php';
		
		$ConteudoCelular = 'select ancCodigo,ancTitulo,ancDesc from anuncio where ancCod_Categoria=4  order by ancCodigo desc limit 4';
		
		$Conteudo = 'select * from anuncio limit 4';
		
		$Conteudo2 = 'select * from anuncio order by ancCodigo desc limit 4';
		
		$Dados = mysqli_query($oCon,$Conteudo);
		
		$Dados2 = mysqli_query($oCon,$Conteudo2);
		
		$DadosCelular = mysqli_query($oCon,$ConteudoCelular);

		//Cabeçalho sem estar logado
		include 'Header.php';
?>




	
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
		
			while($DadosMostraCelular = mysqli_fetch_assoc($DadosCelular)){
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
			          
			          <a class="btn-floating halfway-fab waves-effect waves-light blue darken-2"   ><i class="material-icons">favorite_border</i></a>
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
			          
			          <a class="btn-floating halfway-fab waves-effect waves-light blue darken-2"  href="./conexoesPhp/Favoritar.php?id_produto=<?php echo $DadosMostra['ancCodigo'];?>" ><i class="material-icons">favorite_border</i></a>
			        </div>
			        <div class="card-content">
			        	<span class="card-title"><?php echo $DadosMostra['ancTitulo']?></span>
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
			          
			          <a class="btn-floating halfway-fab waves-effect waves-light blue darken-2"  href="MostraProduto.php?id_produto=<?php echo $DadosMostra2['ancCodigo'];?>"><i class="material-icons">favorite_border</i></a>
			        </div>
			        <div class="card-content">
			        	<span class="card-title"><?php echo $DadosMostra2['ancTitulo']?></span>
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
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>

<!-- Materialize JavaScript -->
<script src="./Materialize/js/materialize.js"></script>


<!-- Menu dropdown -->
<script> 
$(".button-collapse").sideNav();


// Modal de login
$(document).ready(function(){
    $('.modal').modal();
  });


</script>



</body>
<?php

mysqli_close($oCon);
mysqli_free_result($Dados);
mysqli_free_result($Dados2);
mysqli_free_result($DadosCelular);


}else{


header('location:Logado.php');

}
?>