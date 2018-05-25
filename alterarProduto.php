<?php

session_start();

if((!isset ($_SESSION['Login']))){
header('location:Index.php');
}else{

	$anuncio = $_GET['anuncio'];
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

function teste(anuncio){
   var Objeto = new XMLHttpRequest();
      titulo = document.getElementById("titulo").value;
       with(Objeto){
      
       open('GET','./conexoesPhp/alteraTituloAnuncio.php?codigo='+anuncio+'&titulo='+titulo+'');
      
       send();

      
        onload = function(){
        
        alert(responseText);
        
        }
    }
}

</script>

<body onclick="FechaTudo()" style="background-color: whitesmoke;">

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


  <!--                       Bloco de conteudo -->

<?php

  $sql = "select ancTitulo,ancEstadoItem,ancCod_Categoria,ancDesc from anuncio where ancCodigo = '$anuncio'";

  $resultado = mysqli_query($oCon,$sql);



  if($anuncioSql = mysqli_fetch_assoc($resultado)){

	
?>

	

	 <div class="row">
    
      <div class="container">
        

        <div class="card horizontal">


        	<div class="input-field col s12 l12 m12">
            <form id="formTitulo">
  	          <input value="<?php echo $anuncioSql['ancTitulo']?>" id="titulo" type="text" class="validate">
  	          <label for="disabled">Titulo anuncio</label>
  	          <a class="waves-effect waves-light btn" id="AlterarAnuncio">Alterar anuncio</a>
  	        </form>
          </div>

        </div>



         <div class="card horizontal">

         	<div class="input-field col s12">
	          <textarea id="descricao" class="materialize-textarea"><?php echo $anuncioSql['ancDesc']?></textarea>
	          <label for="textarea1">Descrição do Anuncio</label>
	          <a class="waves-effect waves-light btn" id="AlterarDesc">Alterar Descrição</a>
	        </div>

         </div>
      
      </div>
    
    </div>
<?php  	

  }
?>

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

//altera titulo
$(document).ready(function(){
	$("#titulo").css("color","#ddd");
	$("#titulo").prop("disabled",true);
});



$(document).ready(function(){
	$("#AlterarAnuncio").click(function(){

		$("#titulo").prop("disabled",false);
		$("#titulo").css("color","#000");

	});
	
});


//altera descrição
$(document).ready(function(){
	$("#descricao").css("color","#ddd");
	$("#descricao").prop("disabled",true);
});


$(document).ready(function(){
	$("#AlterarDesc").click(function(){

		$("#descricao").css("color","#000");
		$("#descricao").prop("disabled",false);
		
	});

});

$(document).ready(function(){
  var tituloAntigo = $("#titulo").val();
  $("#titulo").blur(function(){
    var tituloAtual = $("#titulo").val();
    if(tituloAntigo != tituloAtual){
    //ajax
      teste(<?php echo $anuncio?>);
    //termina ajax
    }
    $("#titulo").css("color","#ddd");
    $("#titulo").prop("disabled",true);
  });
});

$(document).ready(function(){
    $('select').formSelect();
  });

$(".button").sideNav();

</script>