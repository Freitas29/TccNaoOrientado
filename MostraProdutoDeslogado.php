<?php


include './conexoesPhp/Conexao.php';

$Id_Produto = $_GET['id_produto'];

$Produto = "select anuncio.ancTitulo,ancCodigo,ancEstadoItem,ancDesc,ancCategoria_interesse,usuario.usrApelido,usrLocalidade,categoria.ctgNome from ((anuncio inner join usuario on ancCod_Criador = usuario.usrCodigo) inner join categoria on anuncio.ancCod_Categoria = categoria.ctgCodigo)where ancCodigo =".$Id_Produto;

$DadosDoProduto = mysqli_query($oCon,$Produto);


$Fotos = "select ancTitulo,ancCodigo,fotoDescricao,foto_cod_usuario,foto_cod_anuncio from anuncio inner join fotosprodutos on ancCodigo = fotosprodutos.foto_cod_anuncio where foto_cod_anuncio =".$Id_Produto;

$DadosDasFotos = mysqli_query($oCon,$Fotos);
?>


<!DOCTYPE html>
<html>

<!-- Css do materialize -->
<link rel="stylesheet" href="./Materialize/css/materialize.css">

<meta charset="utf-8">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


<style type="text/css">

  .carousel .indicators .indicator-item{
    background-color: #1e88e5 !important;
  }

  .carousel .indicators .indicator-item.active{
    background-color: #ee6e73 !important;
  }


  .card .card-image img {
      display: block;
      border-radius: 2px 2px 0 0;
      position: relative;
      left: 0;
      right: 0;
      top: 0;
      bottom: 0;
      max-height: 80%;
      width: 100%;
      min-height: 20%;
      height: 80%;
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

  nav{
  
  background-color:#1e88e5 !important;
}
</style>



<body>
<?php
	
	include 'Header.php';
if($RegProduto = mysqli_fetch_assoc($DadosDoProduto)){

  $ProdutoCod = $RegProduto['ancCodigo'];

  
  
?>



 <div class="row">
    
    <div class="container">
        

        <div class="card horizontal">

                <div class="card-image col s12 m12 l12">

                  <div class="carousel carousel-slider" style="height: 100%;">
                  <?php 

                  while ($FotosEnd = mysqli_fetch_assoc($DadosDasFotos)) {
                  

                  ?>
                  <a class="carousel-item" ><img src="./Produtos/<?php echo $FotosEnd['fotoDescricao'] ?>" id="Imagem" ></a>
                
                <?php 

                }

                ?>
               
                </div>

  
                </div>

            <div class="card-stacked">

              <div class="card-content">

         

            


              <br>        
              <br>      
              <a class="blue darken-2 waves-effect waves-light btn  N/A-text text-N/A"><i class="material-icons left">chat</i>Conversar com Usuário</a>
                     

               <div class="card-content">

                <h5>Nome Do Produto</h5>
                
                <p>
                    <?php echo $RegProduto['ancTitulo'] ?>

                </p>

                <h5>Descrição</h5>

                <p>
                    <?php echo $RegProduto['ancDesc'] ?>

                </p>

                <h5>Anunciante</h5>

                <p>
                    <?php echo $RegProduto['usrApelido'] ?>

                </p>

                <h5>Categoria</h5>

                <p>
                    <a href="#" class="blue darken-2 waves-effect waves-light btn  N/A-text text-N/A"><?php echo $RegProduto['ctgNome'] ?></a>

                </p>



                <h5>Localidade</h5>

                <p>
                    <a href="#" class="blue darken-2 waves-effect waves-light btn  N/A-text text-N/A"><?php echo $RegProduto['usrLocalidade'] ?></a>


                </p>


             </div>

            </div>

         </div>

      </div>

   
                            </div>

              
 </div>
</div>

</body>

	<!-- jquery -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>

<!-- Materialize JavaScript -->
<script src="./Materialize/js/materialize.js"></script>

<script type="text/javascript">
 


   $('.carousel.carousel-slider').carousel({
    fullWidth: true,
     padding:200,
     indicators:true
   },
  setTimeout(autoplay, 3000));

  function autoplay() {
    $('.carousel').carousel('next');
    setTimeout(autoplay, 3000);
     }
</script>


</html>
<?php
}

mysqli_free_result($DadosDoProduto);
mysqli_close($oCon);


?>