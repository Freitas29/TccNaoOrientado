
<html>

<?php

session_start();

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

</style>

<body style="background-color: whitesmoke;">

<!-- Header -->
	<nav>
		<div class="nav-wrapper container">
	
		  <a href="#!" class="brand-logo center">Logo</a>
		  <a href="#" data-activates="menu-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
		  <ul class="right hide-on-med-and-down">
		  
		  
		  
			<li><a href="">Entrar</a></li>
			 <li><a href="Logado.php">Página Inicial</a></li>
			<li><a href="PaginaDeCadastro.php">Cadastrar</a></li>
			<li><a href="mobile.html">Mobile</a></li>
		  </ul>
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

			<li><a href="sass.html">Sass</a></li>
			<li><a href="badges.html">Components</a></li>
			<li><a href="collapsible.html">Javascript</a></li>
			<li><a href="mobile.html">Mobile</a></li>
		  </ul>
		</div>
  </nav>


<div class="container" style="margin-top: 2%">
    
									 
 <!--Login -->

			<div class="collapsible-header active" ><i class="material-icons" >account_circle</i>Login</div>
		<div class="collapsible-body"  style="display: block; border-bottom: 1px transparent;" ><span>
			<div class="row" style="background-color: #fff" >
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

				<button class="blue darken-2 waves-effect waves-light btn  N/A-text text-N/A" type="submit" name="action">Enviar
									<i class="material-icons right">send</i>
				</button>


					
					</span></div>
				
				
				
			 </form>
		</div>

 
</div>
 
 <!-- jquery -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>

<!-- Materialize JavaScript -->
<script src="./Materialize/js/materialize.js"></script>



 </body>
 </html>
