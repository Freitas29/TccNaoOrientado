<?php

session_start();

include './conexoesPhp/Conexao.php';

$anuncio = $_GET['anuncio'];

 $Usuario = 'select usrEmail,usrApelido,usrFoto,usrCEP,usrLogradouro,usrUf,usrBairro,usrLocalidade from usuario where UsrCodigo='.$_SESSION['Login'];

  $DadosUsuario = mysqli_query($oCon,$Usuario);

    $Categoria = 'select ctgCodigo,ctgNome from categoria';

    $CategoriaTroca = 'select ctgCodigo,ctgNome from categoria';

    $DadosCategoria = mysqli_query($oCon,$Categoria);

    $DadosCategoriaTroca = mysqli_query($oCon,$CategoriaTroca);
    
  if($RegUsuario = mysqli_fetch_assoc($DadosUsuario)){

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
}

</script>

<body onclick="FechaTudo()" style="background-color: whitesmoke;">
 <nav>
    <div class="nav-wrapper container">
  
      <a href="#!" class="brand-logo center">Logo</a>

      <a href="#" data-activates="menu-mobile" class="button-collapse"><i class="material-icons">menu</i></a>

      <ul class="right hide-on-med-and-down">
    
    
    <!--Menu de usuario-->
        <li><a href="#" data-activates="slide-out" class="button"><?php echo $RegUsuario['usrApelido'];?></a></li>
        <li><a href="./conexoesPhp/Deslogar.php">Sair</a></li>

         <li><a href="Logado.php">Página Inicial</a></li>

       
      </ul>

    <ul id="slide-out" class="side-nav">

    <li><div class="user-view">

      <div class="background" style="background-color: #3d6888;">


      </div>
      <a href="#!user"><img class="circle" src="Usuarios/<?php echo $RegUsuario['usrFoto'];?>"></a>

      <a href="#!name"><span class="white-text name"><?php echo $RegUsuario['usrApelido'];?></span></a>

      <a href="#!email"><span class="white-text email"><?php echo $RegUsuario['usrEmail'];
    
    }
    ?></span></a>

    </div></li>

     <li><a href="#test-swipe-4">Seus Dados</a></li>

      <li><a href="#test-swipe-2">Anunciar um Novo Produto</a></li>

       <li><a href="#test-swipe-1">Seus Produtos</a></li>

    <li><div class="divider"></div></li>

    <li><a class="subheader">Favoritos</a></li>

    <li><a class="waves-effect" href="#test-swipe-3">Seus produtos favoritos</a></li>

  </ul>

  
        <!-- Celular -->
    
      <ul class="side-nav" id="menu-mobile">
    
    
      <nav>

      <div class="nav-wrapper">

        <form>

        <div class="input-field">

          <input id="search" type="search" required>

          <label class="label-icon" for="search"><i class="material-icons">search</i></label>

          <i class="material-icons">close</i>

        </div>


        </form>


      </div>

    </nav>

      <li ><a href="#" data-activates="slide-out" class="button" onclick="TiraMenuCelular()"><i class="material-icons">account_circle</i></a></li>

        <li><a href="Logado.php">Página Inicial</a></li>

        <li><a href="collapsible.html">Javascript</a></li>

        <li><a href="mobile.html">Mobile</a></li>

      </ul>
    
    </div>

  </nav>

   <div class="row">
    
      <div class="container">
        

        <div class="card horizontal">

          <?php

          $sql = "select ancTitulo,ancEstadoItem,ancDesc,ancCategoria_interesse from anuncio where ancCodigo = '$anuncio'";

          $resultadoSql = mysqli_query($oCon,$sql);

          if ($anuncio = mysqli_fetch_assoc($resultadoSql)) {
            
          


          ?>

       
               
                  <form method="POST" enctype="multipart/form-data" action="">
            
                     <div class="input-field col s12 m12 l12">
                          <input type="email"  class="validate" name="NovoEmail" required>
                          <label for="icon_prefix"><?php echo $anuncio['ancTitulo']?></label>
                    </div>

                    <div class="input-field col s12 m12 l12">
                                <textarea id="textarea1" class="materialize-textarea" data-length="250" name="Descricao_Produto" required></textarea>

                                <span id="Vazio_Quinto" style="display: none;">Preencha o campo</span>

                                <label for="textarea1"><?php echo $anuncio['ancDesc']?></label>
                      </div>


                           <div class="input-field col s12 m12 l12">
                                    <select name="Categoria_Produto">
                                      <option value="" disabled selected>Categoria do produto</option>

                                      <?php 

                                      while($RegCategoria = mysqli_fetch_assoc($DadosCategoria)){
                                      ?>


                                      <option name="Categoria" value="<?php echo $RegCategoria['ctgCodigo']?>"> <?php echo $RegCategoria['ctgNome']?></option><?php }?>
                                
                                    </select>
                                    <span id="Vazio_Terceiro" style="display: none;">Preencha o campo</span>


                         </div>


                     <select name="Categoria_Para_Trocar">

                            <option value="" disabled selected>Opção de categoria no qual você gostaria de trocar</option>
                            <option name="Categoria" value="">Nenhum Produto</option>

                            <?php 

                            while($RegCategoriaTroca = mysqli_fetch_assoc($DadosCategoriaTroca)){
                            ?>


                            
                            <option name="Categoria" value="<?php echo $RegCategoriaTroca['ctgCodigo']?>"> <?php echo $RegCategoriaTroca['ctgNome']?></option><?php }?>
                      
                          </select>

                      

                
              <button>enivar</button>
            </form>
          
        
        </div>

      </div>
    </div>

    <?php
    }
    ?>

</body>

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


<!-- MENU DO USUARIO -->
<script>

$(".button").sideNav();

</script>

<!-- SELECTS -->
<script>
  $(document).ready(function() {
    $('select').material_select();
  });
</script>