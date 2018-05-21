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



   <nav>
    <div class="nav-wrapper container">
  
      <a href="#!" class="brand-logo center">Logo</a>

      <a href="#" data-activates="menu-mobile" class="button-collapse"><i class="material-icons">menu</i></a>

      <ul class="right hide-on-med-and-down">
    
    
    <!--Menu de usuario-->
         <li><a data-activates="slide-out" class="button tooltipped" data-position="bottom" data-tooltip="Clique para abrir o menu de usuário"><?php echo $RegUsuario['usrApelido'];?></a></li>
        <li><a href="./conexoesPhp/Deslogar.php">Sair</a></li>

         <li><a href="Logado.php">Página Inicial</a></li>

      </ul>

    <ul id="slide-out" class="side-nav">

    <li><div class="user-view">

      <div class="background" style="background-color: #084172;">


      </div>
      <a href="#!user"><img class="circle" src="Usuarios/<?php echo $RegUsuario['usrFoto'];?>"></a>

      <a href="#!name"><span class="white-text name"><?php echo $RegUsuario['usrApelido'];?></span></a>

      <a href="#!email"><span class="white-text email"><?php echo $RegUsuario['usrEmail'];
    
    }
    ?></span></a>

    </div></li>

    <li><a href="ProdutosUsuario.php">Seus produtos anunciados</a></li>

    <li><a href="#!">Anunciar um novo produto</a></li>

    <li><div class="divider"></div></li>

    <li><a class="subheader">Favoritos</a></li>

    <li><a class="waves-effect" href="#!">Seus produtos favoritados</a></li>

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
      </ul>
    
    </div>

  </nav>






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
<?php
}
?>