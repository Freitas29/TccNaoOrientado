<html>
<?php
session_start();

if((!isset ($_SESSION['Login']))){
    header('location:SemLogin.php');  
  ?>

  <div class="container">

    <h1>Faça Login</h1>
  </div>

<?php
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
}


</script>
<?php

   include './conexoesPhp/Conexao.php';
    
    
    $Usuario = 'select usrEmail,usrApelido,usrFoto,usrCEP,usrLogradouro,usrUf,usrBairro,usrLocalidade from usuario where UsrCodigo='.$_SESSION['Login'];
$DadosUsuario = mysqli_query($oCon,$Usuario);
    
    if($RegUsuario = mysqli_fetch_assoc($DadosUsuario)){
    
?>

<style type="text/css">
  nav .input-field {
    margin: 0;
    height: auto !important;
}

.nav-wrapper .input-field input[type=search] {
    height: inherit;
    padding-left: 4rem;
    width: calc(100% - 4rem);
    border: 0;
    -webkit-box-shadow: none;
    box-shadow: none;
    margin-bottom: 0px;
  }
</style>



  <nav class="nav">
    <div class="nav-wrapper container" >
  
       <a href="#!" class="brand-logo left"><img src="logoTeste.png" style="width: 35%;"></a>

        
        <a href="#" data-activates="menu-mobile" class="button-collapse right"><i class="material-icons">menu</i></a>

        <ul class="right hide-on-med-and-down" style="width: 70%;">
          <li style="width: 59%;">

          <div class="nav-wrapper" >

            <!-- Buscar de produtos pelo site -->

            <form action="" method="POST" id="formPesquisa">
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
            <img class="circle" src="./Usuarios/<?php echo $RegUsuario['usrFoto']?>"  >





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







  <!-- jquery -->
<script src="./javascript/jQuery.js"></script>

<!-- Materialize JavaScript -->
<script src="./Materialize/js/materialize.js"></script>


<!-- Menu dropdown -->
<script> 
$(".button-collapse").sideNav();
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


<!-- MENU DO USUARIO -->
<script>

$(".button").sideNav();

</script>
<?php
}
?>