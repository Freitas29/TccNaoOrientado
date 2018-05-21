<html>
<?php


include '.conexoesPhp/HeaderLogado.php';
include '.conexoesPhp/Conexao.php';
 

  $Categoria = 'select ctgCodigo,ctgNome from categoria';
 $DadosCategoria = mysqli_query($oCon,$Categoria);
?>
<div class="container" style="
    margin-top: 6%;>
 <div class="row">


              <form class="col s12 m12 s12" method="POST" enctype="multipart/form-data" action="./conexoesPhp/SalvandoProdutos.php">

                <div class="row">

                  <!-- Nome do produto -->

                  <div class="input-field col s6 m6 l6">

                    <input id="icon_prefix" type="text" class="validate" name="NomeProduto" placeholder="Nome do produto">

                    <label for="icon_prefix">Nome do produto</label>

                  </div>

                 <!--  Estado de uso do produto -->
                 <div class="input-field col s6 m6 l6">
                  <select name="EstadoItem">
                    <option value="" disabled selected>Novo ou Usado</option>
                    <option value="Novo" name="EstadoItem">Novo</option>
                    <option value="Usado" name="EstadoItem">Usado</option>
                  </select>
                  <label>Informe se seu produto está novo ou usado</label>
                </div>

                

               <!--  Categoria do produto -->

                <div class="input-field col s6 m6 l6">
                  <select name="Categoria">
                    <option value="" disabled selected>Categoria do produto</option>

                    <?php 

                    while($RegCategoria = mysqli_fetch_assoc($DadosCategoria)){
                    ?>


                    <option name="Categoria" value="<?php echo $RegCategoria['ctgCodigo']?>"> <?php echo $RegCategoria['ctgNome']?></option><?php }?>
              
                  </select>
                  <label>Selecione a categoria do seu produto para que outros usuários possam acha-lo mais facilmente</label>
                </div>

               <!--  Descrição do produto -->

                 <div class="input-field col s12 m12 l12">
                    <textarea id="textarea1" class="materialize-textarea" data-length="250" name="Descricao" required placeholder="Descrição do produto"></textarea>
                    <label for="textarea1">Descrição do produto</label>
                  </div>

                  <!-- Fotos do produto -->

                  <div class="file-field input-field col s6 m6 l6">
                    <div class="btn">
                      <span>Selecione as fotos do seu produto</span>
                      <input type="file" multiple name="FotoProduto[]">
                    </div>
                    <div class="file-path-wrapper">
                      <input class="file-path validate" type="text" placeholder="Fotos do seu produto">
                    </div>
                  </div>


              </div>
              <button name="Enviar">Enviar</button>
            </form>      

           </div>       

        </div>
        </div>

<!-- jquery -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>

<!-- Materialize JavaScript -->
<script src="./Materialize/js/materialize.js"></script>


<!-- Menu dropdown -->
<script> 
$(".button-collapse").sideNav();
</script>
<!-- SELECTS -->
<script>
  $(document).ready(function() {
    $('select').material_select();
  });
</script>


<!-- TextArea -->
<script>
  
  $(document).ready(function() {
    $('input#input_text, textarea#textarea1').characterCounter();
  });
</script>


</body>
<?php

mysqli_free_result($DadosCategoria);

?>