<html>

<?php


session_start();

?>
<?php include "Header.php"; ?>
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

 <script>         

// CEP usuário
 function fnObtemDados()
   {
   var
      oPagina = new XMLHttpRequest();
      cep = document.all.CEP.value;

      with(oPagina)
      {
      open('GET','http://cep.republicavirtual.com.br/web_cep.php?cep='+cep+'&formato=json');
      send();
      onload = function()
               {
               var 
                   oResposta = JSON.parse(responseText);
                   document.all.Estado.value = oResposta.uf;
                   document.all.Cidade.value = oResposta.cidade;
                   document.all.Bairro.value = oResposta.bairro;
                   document.all.Logradouro.value = oResposta.logradouro;
               }
      }
   }





function fnExibeArquivo()
{
	var arquivo = new FileReader();

	arquivo.onloadend = function(){

		document.all.imgGG.src = arquivo.result;
	}

	if (document.getElementById('arquivo').files[0]) 
	{
		arquivo.readAsDataURL(document.getElementById('arquivo').files[0]);
		document.getElementById('imgGG').style.display = "block";
	}
	else
	{
		document.getElementById('imgGG').style.display = "";
	}
}

function validaTel(valor){
	var d1 = valor.charAt(0);
	var d2 = valor.charAt(1);
	var d3 = valor.charAt(2);
	var d4 = valor.charAt(4);
	var d5 = valor.charAt(5);
	var d6 = valor.charAt(6);
	var d7 = valor.charAt(7);
	var final = "("+d1.concat(d2,")")+d3+" "+d4+valor.substring(4,5)+d5+valor.substring(6,6)+d6+"-"+d7+valor.substring(8);
	document.getElementById('CampoValue').value =final;
	document.getElementById('TELE').style.display="block";
	document.getElementById('TelPrincipal').style.display="none";
	if(document.getElementById('CampoValue').value.length <= 8){
		document.getElementById('TelefoneValidacaoDoP').style.display="block";
	}
	

}

function ComValida(){
	document.getElementById('TELE').style.display="none";
	document.getElementById('TelPrincipal').style.display="block";
	if(document.getElementById('CampoValue').value.length <= 8){	
		document.getElementById('TelefoneValidacaoDoP').style.display="block";
	}
}

function veValidacao(){
	if(document.getElementById('CampoValue').value.length <= 8){
	document.getElementById('TelefoneValidacaoDoP').style.display="block";
	}
}
</script>

<div class="container" style="margin-top: 2%">
<!--Cadastro -->
  
					  <div class="collapsible-header"><i class="material-icons">mail</i>Cadastrar-se</div>
						<div class="collapsible-body" style="display: block; border-bottom: 1px transparent;"><span>
							<div class="row" style="background-color: #fff">
							<form action="./conexoesPhp/CadastraUsuario.php" class="col s12 m12 l12" method="POST" enctype="multipart/form-data" >

								<div class="input-field col s12 m12 l12">
									  <i class="material-icons prefix">account_circle</i>
									  <input id="icon_prefix" type="text"  class="validate" name="NomeUsu" required>
									  <label for="icon_prefix">Nome de usuário</label>


									  <?php

									  if (!empty($_SESSION['Vazio_Nome_Cadastrar'])) {
									  	echo "<p style='color:#f00'>".$_SESSION['Vazio_Nome_Cadastrar'];
									  	unset($_SESSION['Vazio_Nome_Cadastrar']);
									  }

									  ?>

								</div>

								<div class="input-field col s12 m12 l12">
									  <i class="material-icons prefix">email</i>
									  <input id="email" type="email"  class="validate" name="EmailUsu"  required>
									  <label for="icon_prefix">Email</label>

									   <?php

									  if (!empty($_SESSION['Vazio_Email_Cadastrar'])) {
									  	echo "<p style='color:#f00'>".$_SESSION['Vazio_Email_Cadastrar'];
									  	unset($_SESSION['Vazio_Email_Cadastrar']);
									  }

									  ?>
								</div>

								
								<div class="input-field col s12 m12 l12" id="TelPrincipal">
									
									<i class="material-icons prefix">phone</i>
									   <input id="icon_telephone" type="tel" class="validate" name="TelefoneUsu" id="TelefoneUsu" required maxlength="15" onblur="validaTel(this.value)">
									   <label for="icon_prefix">Telefone</label>
									   

								</div>

							
								<div class="input-field col s12 m12 l12" style="display:none;" id="TELE" onclick="ComValida()" >
									
									<i class="material-icons prefix">phone</i>
									   <input type="text"  maxlength="15" id="CampoValue" required onblur="veValidacao()">
									    <p style="display:none;color:red;" id="TelefoneValidacaoDoP">Preencha este campo</p>

								</div>

								<div class="input-field col s12 m12 l12">
									<i class="material-icons prefix">https</i>
									  <input id="password" type="password"  class="validate" name="SenhaUsu" required>
									  <label for="password">Senha</label>

									   <?php

									  if (!empty($_SESSION['Vazio_Senha_Cadastrar'])) {
									  	echo "<p style='color:#f00'>".$_SESSION['Vazio_Senha_Cadastrar'];
									  	unset($_SESSION['Vazio_Senha_Cadastrar']);
									  }

									  ?>
								</div>

												<!-- Estado onde será anunciado -->
				                <div class="input-field col s12 m12 l12">
									  <i class="material-icons prefix">location_on</i>
									  <input type="text"  class="validate" name="CEP" maxlength="9" id="CEP" required>
									  <label for="icon_prefix">Digite seu cep</label>

									   <?php

									  if (!empty($_SESSION['Vazio_CEP_Cadastrar'])) {
									  	echo "<p style='color:#f00'>".$_SESSION['Vazio_CEP_Cadastrar'];
									  	unset($_SESSION['Vazio_CEP_Cadastrar']);
									  }

									  ?>
								</div>

								 <div class="input-field col s12 m12 l12">
									  <input id="Logradouro" type="text"  class="validate" name="Logradouro"  placeholder="Rua" onclick="fnObtemDados()" required>
									  <label for="icon_prefix">Rua</label>

									 <?php

									  if (!empty($_SESSION['Vazio_Logradouro_Cadastrar'])) {
									  	echo "<p style='color:#f00'>".$_SESSION['Vazio_Logradouro_Cadastrar'];
									  	unset($_SESSION['Vazio_Logradouro_Cadastrar']);
									  }

									  ?>

								</div>

								<div class="input-field col s12 m12 l12">
									  <input id="Cidade" type="text"  class="validate" name="Cidade" placeholder="Cidade" required>
									  <label for="icon_prefix">Cidade</label>

									   <?php

									  if (!empty($_SESSION['Vazio_Cidade_Cadastrar'])) {
									  	echo "<p style='color:#f00'>".$_SESSION['Vazio_Cidade_Cadastrar'];
									  	unset($_SESSION['Vazio_Cidade_Cadastrar']);
									  }

									  ?>
								</div>

								<div class="input-field col s12 m12 l12">
									  <input id="Bairro" type="text"  class="validate" name="Bairro" placeholder="Bairro" required>
									  <label for="icon_prefix">Bairro</label>
									   <?php

									  if (!empty($_SESSION['Vazio_Bairro_Cadastrar'])) {
									  	echo "<p style='color:#f00'>".$_SESSION['Vazio_Bairro_Cadastrar'];
									  	unset($_SESSION['Vazio_Bairro_Cadastrar']);
									  }

									  ?>
								</div>

								<div class="input-field col s12 m12 l12">
									  <input id="Estado" type="text"  class="validate" name="Estado" placeholder="Estado"  maxlength="2" required>
									  <label for="icon_prefix">Estado</label>

									  <?php

									  if (!empty($_SESSION['Vazio_Estado_Cadastrar'])) {
									  	echo "<p style='color:#f00'>".$_SESSION['Vazio_Estado_Cadastrar'];
									  	unset($_SESSION['Vazio_Estado_Cadastrar']);
									  }

									  ?>
									  <button onclick="fnObtemDados()" style="visibility: hidden;">Pesquisar</button>
								</div>


								<div class="file-field input-field col s12 m12 l12">
								  <div class="btn blue darken-2 waves-effect waves-light btn  N/A-text text-N/A">
									<span>Foto</span>
									<input type="file" onchange="fnExibeArquivo()" id="arquivo" name="arquivo" >
								  </div>
								  <div class="file-path-wrapper">
									<input class="file-path validate" type="text" placeholder="Escolha uma foto de perfil">
									
									
										<div class="col s12 m7 l3">
											<div class="card">
												<div class="card-image">	
													<img src="x" class="circle" onerror="this.style.display = 'none';" name="imgGG" id="imgGG" >
												</div>
											</div>
										</div>
									
									
								  </div>


								    
								</div>
								
								 <button class="blue darken-2 waves-effect waves-light btn  N/A-text text-N/A" type="submit" name="action">Enviar
									<i class="material-icons right">send</i>
								</button>
							
						</span>
							</div>
						
						
						
					  </form>

	<script src='https://www.google.com/recaptcha/api.js?hl=pt-BR'></script>
 

	<!-- jquery -->
<script src="./javascript/jQuery.js"></script>

<!-- Materialize JavaScript -->
<script src="./Materialize/js/materialize.js"></script>

<script>

	$(document).ready(function(){
    $('.modal').modal();
  });
          
	
</script>