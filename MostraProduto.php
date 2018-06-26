<?php


include './conexoesPhp/Conexao.php';

$Id_Produto = $_GET['id_produto'];

$Produto = "select anuncio.ancTitulo,ancCodigo,ancEstadoItem,ancDesc,ancCategoria_interesse,usuario.usrApelido,usrEmail,UsrCodigo,usrLocalidade,usuario.usrTelefone,categoria.ctgNome from ((anuncio inner join usuario on ancCod_Criador = usuario.usrCodigo) inner join categoria on anuncio.ancCod_Categoria = categoria.ctgCodigo)where trocado = 0 and ancCodigo =".$Id_Produto;

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
*{
  overflow: hidden;
  word-wrap: break-word;
}
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

#MostraEnvio{
  display: none;
}


</style>

<script type="text/javascript">
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


  function EscolheAnuncio(valor){
   var Objeto = new XMLHttpRequest();
      
      with(Objeto){
      
      open('GET','./conexoesPhp/pegaAnuncioSeleciona.php?codigoAnuncio='+valor+'');
      
      send();

      
        onload = function(){
        
        if(confirm("Deseja realmente selecionar este produto?")){
          document.getElementById('ProdutoEscolhidoTabela').value = valor;
          document.getElementById('enviaTroca').click();
        }else{
           document.getElementById('ProdutoEscolhido').value = "não";
        }
        
        
        }
      }
  }

function Teste(){
    document.getElementById('SomePedirTroca').style.visibility="visible";
}
                    
 
</script>

<body>
<?php
  
  include 'HeaderLogado.php';
if($RegProduto = mysqli_fetch_assoc($DadosDoProduto)){

  $ProdutoCod = $RegProduto['ancCodigo'];
  $NomeUsuarioLogado = $RegProduto['usrApelido'];
  $CodigoUsuarioLogado = $RegProduto['UsrCodigo'];
  $DadosFavoritos = ' select favoritos_cod,favoritos_cod_anuncio,favoritos_cod_usuario,ancCodigo from favoritos inner join anuncio on favoritos_cod_anuncio = ancCodigo where ancCodigo ='.$ProdutoCod.' and  favoritos_cod_usuario ='.$_SESSION['Login'];


  //pega o email do usuario logado

    $DadosUsuarioLogado = "select usrEmail,usrApelido from usuario where UsrCodigo =".$_SESSION['Login'];

    $ResultadoLogado = mysqli_query($oCon,$DadosUsuarioLogado);

    if($RegLogado = mysqli_fetch_assoc($ResultadoLogado)){


    $FavoritosMostra = mysqli_query($oCon,$DadosFavoritos);
?>



 <div class="row">
    
    <div class="container">

  
    <?php
         if (!empty($_SESSION['Enviado'])) {
                      echo "<p style='color:#4caf50'>".$_SESSION['Enviado'];
                      unset($_SESSION['Enviado']);
                      echo "FJKLDSJLKFSDLKF";
                    }
      ?>
        <div class="card horizontal">

                <div class="card-image col s12 m12 l12">

                  <div class="carousel carousel-slider" style="height: 100%;">
                  <?php 

                  while ($FotosEnd = mysqli_fetch_assoc($DadosDasFotos)) {
                  
                    //Para mandar ao email
                    $FotoEmail = $FotosEnd['fotoDescricao'];

                  ?>
                  <a class="carousel-item" ><img src="./Produtos/<?php echo $FotosEnd['fotoDescricao'] ?>" id="Imagem" ></a>
                
                <?php 

                }

                ?>
               
                </div>

  
                </div>

            <div class="card-stacked">

              <div class="card-content">

              <?php
               $linhas = mysqli_num_rows($FavoritosMostra);
                  if($linhas == 0){
                    ?>
                    <a class="blue darken-2 waves-effect waves-light btn  N/A-text text-N/A"  onclick="enviaFavorito(<?php echo $RegProduto['ancCodigo'];?>)" id="btnFavoritado"><i class="material-icons left">favorite_border</i>Favoritar</a>
                
                    <?php
                    }elseif($linhas > 0){

                    while($RegFav = mysqli_fetch_assoc($FavoritosMostra)) {

                    ?> 

                    <a class="blue darken-2 waves-effect waves-light btn  N/A-text text-N/A" id="btnNaoFavoritado" onclick="TiraFavorito(<?php echo $RegProduto['ancCodigo'];?>)"><i class="material-icons left">favorite</i>Desfavoritar</a>
        
                    <?php     

                  }

                }
            ?>


              <br>        
              <br>      

              <?php
              //Aqui eu verifico se o usuario solicitou a troca de anuncio. Se sim, ele mostra o button de pendente

                  $DadosQuemEnvia = "select ancTitulo,usrApelido,ancCodigo,ancDesc from anuncio inner join trocas t on anuncioRecebe = ancCodigo inner join usuario on usuarioRecebe = UsrCodigo where usuarioEnvia = ".$_SESSION['Login']."  and t.trocado != 1 and anuncioRecebe =".$Id_Produto;
                    $ResultadoQuemEnvia = mysqli_query($oCon,$DadosQuemEnvia);
                    $LinhasResultantesQuemEnvia = mysqli_num_rows($ResultadoQuemEnvia);
                    if($RegQuemEnvia = mysqli_fetch_assoc($ResultadoQuemEnvia)){

              ?>
              
                   <button  class="btn disabled">Pedido pendente</button>
                   <?php
                   
                 }
                  ?>
                   
                  <?php
            //Verifico se ele recebeu um pedido de troca, se sim, ele tem a opção de finalizar a troca

                 $DadosQuemRecebe = "select ancTitulo,usrApelido,ancCodigo,ancDesc from anuncio inner join trocas t on anuncioEnvia = ancCodigo inner join usuario on usuarioRecebe = UsrCodigo where usuarioRecebe = ".$_SESSION['Login']."  and t.trocado != 1 and anuncioEnvia =".$Id_Produto;
                  $ResultadoQuemRecebe = mysqli_query($oCon,$DadosQuemRecebe);
                   $LinhasResultantesQuemRecebe = mysqli_num_rows($ResultadoQuemRecebe);
                  if($RegQuemRecebe = mysqli_fetch_assoc($ResultadoQuemRecebe)){
                  ?>
                 <a href="efetuaTroca.php"><button class="btn blue darken-2 waves-effect waves-light btn  N/A-text text-N/A" >Finalizar</button></a>
                  <?php
                 
                 }
                 //Aqui eu verifico se algum dos selects acima trouxe algo, se não quer dizer que ele pode fazer um pedido de troca
                 if($LinhasResultantesQuemRecebe == 0 and $LinhasResultantesQuemEnvia==0){
                   echo "<script>Teste();</script>";
                  ?>
                    <button data-target="modal1" class="btn modal-trigger blue darken-2 waves-effect waves-light btn  N/A-text text-N/A" style="visibility="hidden;" id="SomePedirTroca">Pedir troca</button>
                  <?php
                 }

                 ?>
                   <div id="modal1" class="modal" id="Modal">
                      <div class="modal-content">
                        <h4>Escolha o produto que no qual você deseja trocar com este usuário</h4>



                         <?php
          
            $SelecionaOsProdutosAnunciados = 'select ancCodigo,ancTitulo,ancEstadoItem,ancCod_Criador,ancDesc from anuncio where trocado = 0 and ancCod_Criador = '.$_SESSION['Login'];

            $DadosDoProdutosAnunciados = mysqli_query($oCon,$SelecionaOsProdutosAnunciados);

            $LinhasResultantesParaQuemEscolheAnuncio = mysqli_num_rows($DadosDoProdutosAnunciados);

            if($LinhasResultantesParaQuemEscolheAnuncio == 0){
              echo "Você ainda não tem produtos para trocar com esse usuário";
            }

            while ($RegProdutosAnunciado = mysqli_fetch_assoc($DadosDoProdutosAnunciados)) {
              

                $anunciosDoUsuario = $RegProdutosAnunciado['ancCodigo'];
                $tituloDoUsuarioLogado = $RegProdutosAnunciado['ancTitulo'];

                $anuncioEnvia = $RegProdutosAnunciado['ancCodigo'];

                
            
          ?>
          

          
              <div class="col l3 m3 s3" onclick="EscolheAnuncio(<?php echo $RegProdutosAnunciado['ancCodigo']?>)">
                <div class="card" style=" word-wrap: break-word;">
                  <div class="card-image" style="max-width: 100% !important;">
  
                     <?php 

                     $Fotos = "select ancCodigo,fotoDescricao,foto_cod_usuario,foto_cod_anuncio from anuncio inner join fotosprodutos on ancCodigo = fotosprodutos.foto_cod_anuncio where foto_cod_anuncio =".$anunciosDoUsuario.' order by  foto_cod asc limit 1';

                     $DadosDasFotos = mysqli_query($oCon,$Fotos);

                     while ($FotosEnd = mysqli_fetch_assoc($DadosDasFotos)) {
                      
                      //Foto para enviar no e-mail
                      $FotoDoAnuncio =  $FotosEnd['fotoDescricao'];

                      ?>
                    <img src="./Produtos/<?php echo $FotosEnd['fotoDescricao'] ?>" style=" border-radius: 2px 0 0 2px;max-width: 100%;width: 100% !important;">
                    

                    <?php 
                   }
                   ?>
                  </div>

                  <div class="card-content">
                    <span class="card-title"><?php echo $RegProdutosAnunciado['ancTitulo']?></span>
                    <p id="Desc"><?php echo $RegProdutosAnunciado['ancDesc']?></p>
                  </div>

                </div>
              </div>
        
            
          <?php
            
          }
        
          ?>
          </div>




                        <p></p>
                      </div>
                    
                    <?php 

                    $selecionaNomeUsuario = 'select usrApelido,usrEmail,usrTelefone from usuario where UsrCodigo =  '.$_SESSION['Login'];
                    
                    $resultadoNome = mysqli_query($oCon,$selecionaNomeUsuario);

                    if($RegNome = mysqli_fetch_assoc($resultadoNome)){
                      $nomeUsuario = $RegNome['usrApelido'];
                    


                    ?>


                   

                     <!--Essa div é para enviar ao trocas-->
                     <div style="visibility: hidden;display: none;">
                      <form action="./conexoesPhp/cadastraTroca.php" method="post">
                       <input name="usuarioEnvia" value="<?php echo $_SESSION['Login'];?>">
                       <input name="usuarioRecebe" value="<?php echo $CodigoUsuarioLogado ?>">
                       <input name="anuncioRecebe" value="<?php echo $ProdutoCod; ?>"">
                       <input name="codigo" value="<?php echo $ProdutoCod; ?>"">
                       <input name="anuncioEnvia" id="ProdutoEscolhidoTabela">
                       <button id="enviaTroca"></button>
                     </form>
                    </div>
                     <?php
                     }

                   
                     ?>


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

                <h5>
                    Telefone: <?php echo $RegProduto['usrTelefone'] ?>

                </h5>

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
<script src="./javascript/jQuery.js"></script>

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

 $(document).ready(function(){
    $('.modal').modal();
    
  });


</script>


</html>
<?php
}
}

mysqli_free_result($DadosDoProduto);
mysqli_close($oCon);


?>