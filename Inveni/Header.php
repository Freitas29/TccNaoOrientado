<head>

<!-- Css do materialize -->
<link rel="stylesheet" href="./Materialize/css/materialize.css">

<meta charset="utf-8">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<style type="text/css">
  nav{
  
  background-color:#1e88e5 !important;
}


@media only screen and (max-width: 992px)
nav .brand-logo.left {
    right: 0.5rem !important;
}
</style>

<body style="background-color: whitesmoke;">
<nav class="nav">
    <div class="nav-wrapper container">
  
      <a href="#!" class="brand-logo left">Logo</a>

      
      <a href="#" data-activates="menu-mobile" class="button-collapse right"><i class="material-icons">menu</i></a>

      <ul class="right hide-on-med-and-down" style="width: 70%;">
      <li style="width: 59%;">
        <div class="nav-wrapper">
        <form action="./conexoesPhp/BarraDeBusca.php" method="POST">
        <div class="input-field">
          <input id="search" type="search" name="Pesquisa">
          <label class="label-icon" for="search"><i class="material-icons">search</i></label>
          <i class="material-icons">close</i>
        </div>
        </form>
      </div>
      </li>
        <li><a class="modal-trigger" href="#modal1">Entrar</a></li>
        <li><a href="Index.php">Página Inicial</a></li>
        <li><a href="PaginaDeCadastro.php">Cadastrar</a></li>
        <li><a href="mobile.html">Mobile</a></li>
      </ul>
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
               <div class="g-recaptcha" data-sitekey="6Lc05VcUAAAAAH-V-ktU8PvCYg-ns2XdhsAe3KEE"></div>
          </div>

    </div>
    <div class="modal-footer">
      <button class="btn">Enviar</button>
    </div>
    </form>
  </div>
          

</body>
