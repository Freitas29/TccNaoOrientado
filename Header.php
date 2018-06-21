<head>

<!-- Css do materialize -->
<link rel="stylesheet" href="./Materialize/css/materialize.css">

<meta charset="utf-8">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<script src="./Materialize/js/materialize.js"></script>
<style type="text/css">
  nav{
  
  background-color:#1e88e5 !important;
}


@media only screen and (max-width: 992px)
nav .brand-logo.left {
    right: 0.5rem !important;
}

#ResultadoBusca{
  background-color: #1e88e5;
    z-index: 1;
    width: 100%;
    height: 100%;
    display: none;
    position: absolute;
    top: 100%;
    z-index: 999;
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
</style>

<script type="text/javascript">
  function FechaTudo(){
    DesativaForm();
  }

  function DesativaForm(){
    var x = document.getElementById("ResultadoBusca").getElementsByTagName("LI");
      a = x.length;
    var i;
    for(i = 0;i<a;i++){
      document.getElementById('ResultadoBusca').style.display="none";
    }
	
  }
 
</script>

<body style="background-color: whitesmoke;" onclick="FechaTudo()">
<nav class="nav">
    <div class="nav-wrapper container">
  
      <a href="#!" class="brand-logo left"><img src="logo.png" style="width: 35%;"></a>

      
      <a href="#" data-activates="menu-mobile" class="button-collapse right"><i class="material-icons">menu</i></a>

      <ul class="right hide-on-med-and-down" style="width: 70%;">
      <li style="width: 59%;">
        <div class="nav-wrapper">
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
      </li>
        <li><a class="modal-trigger" href="#modal1">Entrar</a></li>
        <li><a href="index.php">Página Inicial</a></li>
        <li><a href="PaginaDeCadastro.php">Cadastrar</a></li>
		<li><a href="Sobre.php">Sobre</a></li>
      </ul>
      <ul class="side-nav" id="menu-mobile" >

        <li><a href="sass.html">Sass</a></li>
        <li><a href="index.php">Página Inicial</a></li>
        <li><a href="collapsible.html">Javascript</a></li>
	  <li><a href="Sobre.php">Sobre</a></li>
      </ul>
    </div>
     
    </div>
  </nav>

  </nav>
<!-- 
  Modal para logar usuário -->

  <div id="modal1" class="modal">
    <div class="modal-content">

      <form action="./conexoesPhp/LoginUsuario.php" class="col s12 m12 l12" method="POST" >
       <div class="input-field col s12 m12 l12">
              <i class="material-icons prefix">account_circle</i>
              <input id="icon_prefix" type="text" class="validate" name="UsuarioLogin">
              <label for="icon_prefix">Nome de usuário ou email</label>
              <?php



                if (!empty($_SESSION['Vazio_Nome_Login'])) {
                  echo "<p style='color:#f00'>".$_SESSION['Vazio_Nome_Login'];
                  unset($_SESSION['Vazio_Nome_Login']);
                }



              ?>
          </div>

         
           <div class="input-field col s12 m12 l12">
            <i class="material-icons prefix">https</i>
              <input id="password" type="password" class="validate" name="UsuarioSenha" required>
              <label for="password">Senha</label>

              <?php



                if (!empty($_SESSION['Vazio_Senha'])) {
                   echo "<p style='color:#f00'>".$_SESSION['Vazio_Senha'];
                  unset($_SESSION['Vazio_Senha']);
                }


                if (!empty($_SESSION['Nome_Valida'])) {
                   echo "<p style='color:#f00'>".$_SESSION['Nome_Valida'];
                  unset($_SESSION['Nome_Valida']);
                }
                
                

              ?>
          </div>

    </div>
    <div class="modal-footer">
      <button class="btn">Enviar</button>
    </div>
    </form>
  </div>
  <script src="jQuery.js"></script>
  
  <script>
// Modal de login
$(document).ready(function(){
 $('.modal').modal();
 });
 </script>

</body>
