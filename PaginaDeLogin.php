
<html>

<?php

session_start();

?>
<?php include "Header.php"; ?>
<head>

<!-- Css do materialize -->
<link rel="stylesheet" href="./Materialize/css/materialize.css">

<meta charset="utf-8">
<link href="http://localhost/MaterialIcons-Regular.eot" rel="stylesheet">
</head>

<style>
nav{
	
	background-color:#1e88e5 !important;
}
	@font-face {
	  font-family: 'Material Icons';
	  font-style: normal;
	  font-weight: 400;
	  src: url(iconfont/MaterialIcons-Regular.eot); /* For IE6-8 */
	  src: local('Material Icons'),
	    local('MaterialIcons-Regular'),
	    url(iconfont/MaterialIcons-Regular.woff2) format('woff2'),
	    url(iconfont/MaterialIcons-Regular.woff) format('woff'),
	    url(iconfont/MaterialIcons-Regular.ttf) format('truetype');
}

.material-icons {
  font-family: 'Material Icons';
  font-weight: normal;
  font-style: normal;
  font-size: 24px;  /* Preferred icon size */
  display: inline-block;
  line-height: 1;
  text-transform: none;
  letter-spacing: normal;
  word-wrap: normal;
  white-space: nowrap;
  direction: ltr;

  /* Support for all WebKit browsers. */
  -webkit-font-smoothing: antialiased;
  /* Support for Safari and Chrome. */
  text-rendering: optimizeLegibility;

  /* Support for Firefox. */
  -moz-osx-font-smoothing: grayscale;

  /* Support for IE. */
  font-feature-settings: 'liga';
}


</style>

<script type="text/javascript">
	function mostraCategoria(){
		document.getElementById('categorias').style.display="inline-table";
	}

</script>

<body style="background-color: whitesmoke;">




<div class="container" style="margin-top: 2%">
    
									 
 <!--Login -->

			<div class="collapsible-header active" ><i class="material-icons" >account_circle</i>Login</div>
		<div class="collapsible-body"  style="display: block; border-bottom: 1px transparent;" ><span>
			<div class="row" style="background-color: #fff" >
			<form action="./conexoesPhp/LoginUsuario.php" class="col s12 m12 l12" method="POST" >

				<div class="input-field col s12 m12 l12">
					  <i class="material-icons prefix">account_circle</i>
					  <input id="icon_prefix" type="text" class="validate" name="UsuarioLogin" value="<?php if(isset($_SESSION['nomeUsuario'])){echo $_SESSION['nomeUsuario']; unset($_SESSION['nomeUsuario']);}else{echo "";}?>">
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
<script src="./javascript/jQuery.js"></script>

<!-- Materialize JavaScript -->
<script src="./Materialize/js/materialize.js"></script>



 </body>
 </html>
