<?php

session_start();

if((!isset ($_SESSION['Login']))){
header('location:index.php');
}else{

	$anuncio = $_GET['anuncio'];
?>


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
</style>
<script>

function TiraMenuCelular(){
  document.getElementById('menu-mobile').style.visibility="hidden";
}

function FechaTudo(){
  document.getElementById('menu-mobile').style.visibility="visible";
}

function fnAlteraTitulo(anuncio){
   var Objeto = new XMLHttpRequest();
      titulo = document.getElementById("titulo").value;
       with(Objeto){
      
       open('GET','./conexoesPhp/alteraTituloAnuncio.php?codigo='+anuncio+'&titulo='+titulo+'');
      
       send();

      
        onload = function(){
        
    
         Materialize.toast('Titulo Atualizado com sucesso!',4000);
        
        }
    }
}

function fnAlteraDescricao(codigo){
   var Objeto = new XMLHttpRequest();
      descricao = document.getElementById("descricao").value;
       with(Objeto){
      
       open('GET','./conexoesPhp/alteraDescricaoAnuncio.php?codigo='+codigo+'&titulo='+descricao+'');
      
       send();

      
        onload = function(){
        
    
         Materialize.toast('Descrição Atualizada com sucesso!',4000);
        
        }
    }
}



function DeletaFoto(codigo){
   var Objeto = new XMLHttpRequest();
       with(Objeto){
      
       open('GET','./conexoesPhp/deletaFoto.php?codigo='+codigo+'');
      
       send();

      
        onload = function(){
        
    
         location.reload();
        
        }
    }
}


function enviarEstadoProduto(codigo){
   var Objeto = new XMLHttpRequest();

    valor = document.getElementById("estadoProduto").value;
       with(Objeto){
      
       open('GET','./conexoesPhp/alteraEstadoProduto.php?codigo='+codigo+'&estado='+valor+'');
      
       send();

      
        onload = function(){
    
         Materialize.toast('Estado de uso do produto atualizado com sucesso!',4000);
        
        }
    }
}

function mudaCategoria(codigo){

   var Objeto = new XMLHttpRequest();

    var valor = document.getElementById("categoriaProduto").value;
       with(Objeto){
      
       open('GET','./conexoesPhp/alteraCategoriaProduto.php?codigo='+codigo+'&categoria='+valor+'');
      
       send();

      
        onload = function(){
    
         Materialize.toast('Categoria Atualizada com sucesso!',4000);
        
        }
    }
}


function mudaCategoriaEscolhe(codigo){
   var Objeto = new XMLHttpRequest();

    var valor = document.getElementById("categoriaProdutoEscolhe").value;
       with(Objeto){
      
       open('GET','./conexoesPhp/alteraCategoriaProdutoEscolhe.php?codigo='+codigo+'&categoriaEscolhe='+valor+'');
      
       send();

      
        onload = function(){
         Materialize.toast('Produto no qual você deseja trocar atualizado!',4000);
        
        }
    }
}


function fnAdicionaFoto(){
  document.getElementById('AdicionaFoto').click();
}

function teste(){
  var campo = document.getElementById('AdicionaFoto');
  if(campo.value.length > 0){

    var arquivo = new FileReader();

    arquivo.onloadend = function(){
      document.getElementById("visualizacao").src = arquivo.result;
    }

    arquivo.readAsDataURL(campo.files[0]);

    document.getElementById("enviaFoto").click();
  }else{
    alert("Não tem");
  }
}


</script>

<style>

#FotosAlterar{
  padding:2%;
}

</style>

<body onclick="FechaTudo()" style="background-color: whitesmoke;">

<?php

   include './conexoesPhp/Conexao.php';
    
    
    $Usuario = 'select usrEmail,usrApelido,usrFoto,usrCEP,usrLogradouro,usrUf,usrBairro,usrLocalidade from usuario where UsrCodigo='.$_SESSION['Login'];
     $DadosUsuario = mysqli_query($oCon,$Usuario);
    
    if($RegUsuario = mysqli_fetch_assoc($DadosUsuario)){

?>



   <nav>
    <div class="nav-wrapper container">
  
      <a href="#!" class="brand-logo left"><img src="logo.png" style="width: 35%;"></a>

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

  $sql = " select ancCodigo,ancTitulo,ancEstadoItem,ancDesc,ctgNome from anuncio inner join categoria on ancCod_Categoria = ctgCodigo where trocado = 0 and ancCodigo = '$anuncio' and ctgCodigo = ancCod_Categoria";

  $resultado = mysqli_query($oCon,$sql);



  if($anuncioSql = mysqli_fetch_assoc($resultado)){

	
?>

	

	 <div class="row">
    
      <div class="container">
        

        <div class="card horizontal">


        	<div class="input-field col s12 l12 m12">
  	          <input value="<?php echo $anuncioSql['ancTitulo']?>" id="titulo" type="text" class="validate">
  	          <label for="disabled">Titulo anuncio</label>
  	          <a class="waves-effect waves-light btn" id="AlterarAnuncio">Alterar anuncio</a>
          </div>

        </div>



         <div class="card horizontal">

         	<div class="input-field col s12">
	          <textarea id="descricao" class="materialize-textarea"><?php echo $anuncioSql['ancDesc']?></textarea>
	          <label for="textarea1">Descrição do Anuncio</label>
	          <a class="waves-effect waves-light btn" id="AlterarDesc">Alterar Descrição</a>
	        </div>

        </div>


        <!-- loop de produtos -->

         <div class="card horizontal" id="FotosAlterar">

                  <?php
                      $sql = "select foto_cod,fotoDescricao,ancCodigo from fotosprodutos inner join usuario on foto_cod_usuario = UsrCodigo inner join anuncio on  foto_cod_anuncio = ancCodigo where foto_cod_anuncio = '$anuncio' and foto_cod_usuario =".$_SESSION['Login'];
                    
                      $resultadoFotos = mysqli_query($oCon,$sql);

                      while ($Fotos = mysqli_fetch_assoc($resultadoFotos)) {
                      
                      
                    ?>
   
              <div class="card-image col s3 m3 l3" style="margin-right:1%;width: 25%;height:  50%;">
                <a class="btn-floating btn-small waves-effect waves-light blue darken-2" onclick="DeletaFoto(<?php echo $Fotos['foto_cod'];?>)"><i class="material-icons">clear</i></a>
                <img src="./Produtos/<?php echo $Fotos['fotoDescricao']?>">

                
                

              </div>

                  <?php
                    }
                  ?>
                  <form action="./conexoesPhp/adicionaFoto.php" method="post" enctype="multipart/form-data">

                  <img id="visualizacao">
                  <input type="text" name="codigoAnuncio" value="<?php echo $anuncioSql['ancCodigo']?>" style="visibility: hidden;">
                  <button id="enviaFoto" style="visibility: hidden;" ></button>

                  <!-- adicionar mais fotos -->
                  <a class="btn halfway-fab waves-effect waves-light red" onclick="fnAdicionaFoto()"><i class="material-icons" >add</i></a>

                  <input type="file" style="display:none;" id="AdicionaFoto" onchange="teste()" name="fotoProdutoNova">
                  </form>
           </div>

           <div class="card horizontal">

             <div class="input-field col s12">
              <select id="estadoProduto">
                <option value="" selected disabled><?php echo $anuncioSql['ancEstadoItem'] ?></option>
                <option value="Usado" ">Usado</option>
                <option value="Novo">Novo</option>
              </select>
              <label>Estado item</label>
            </div>


           </div>

           <div class="card horizontal">

            <div class="input-field col s12 l12">
              <select id="categoriaProduto">
                <option value="" selected disabled><?php echo $anuncioSql['ctgNome'] ?></option>

                <?php
                $sqlPegaCategorias = "select ctgNome,ctgCodigo from categoria";

                $resultadoCategorias = mysqli_query($oCon,$sqlPegaCategorias);

                while($Categorias = mysqli_fetch_assoc($resultadoCategorias)){

                ?>
                <option value="<?php echo $Categorias['ctgCodigo']?>"><?php echo $Categorias['ctgNome']?></option>

                <?php
                }
                ?>
              </select>
              <label>Categoria</label>
            </div>

             <div class="input-field col s12 j12">
              <select id="categoriaProdutoEscolhe">

                <?php 
                $sqlEscolheProduto = "select ctgNome from anuncio inner join categoria on ancCategoria_interesse = ctgCodigo where ancCodigo = '$anuncio'";

                $resultadoEscolhe = mysqli_query($oCon,$sqlEscolheProduto);

                while($escolheProduto = mysqli_fetch_assoc($resultadoEscolhe)){


                ?>
                <option value="" selected disabled><?php echo $escolheProduto['ctgNome'] ?></option>


                <?php
                }
                $sqlPegaCategorias = "select ctgNome,ctgCodigo from categoria";

                $resultadoCategorias = mysqli_query($oCon,$sqlPegaCategorias);

                while($Categorias = mysqli_fetch_assoc($resultadoCategorias)){

                ?>
                <option value="<?php echo $Categorias['ctgCodigo']?>"><?php echo $Categorias['ctgNome']?></option>

                <?php
                }
                ?>
              </select>
              <label>Categoria interesse</label>
            </div>


          </div>

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
<script src="./javascript/jQuery.js"></script>
<!-- Materialize JavaScript -->
<script src="./Materialize/js/materialize.js"></script>


<!-- Menu dropdown -->
<script> 
$(".button-collapse").sideNav();
</script>



<!-- MENU DO USUARIO -->
<script>

  $(document).ready(function() {
    $('select').material_select();
  });

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
      fnAlteraTitulo(<?php echo $anuncio?>);
    //termina ajax
    }else{
       $("#titulo").css("color","#ddd");
    $("#titulo").prop("disabled",true);
    }
    $("#titulo").css("color","#ddd");
    $("#titulo").prop("disabled",true);
  });
});


$(document).ready(function(){
  var tituloAntigo = $("#descricao").val();
  $("#descricao").blur(function(){
    var tituloAtual = $("#descricao").val();
    if(tituloAntigo != tituloAtual){
    //ajax
      fnAlteraDescricao(<?php echo $anuncio?>);
    //termina ajax
    }else{
       $("#descricao").css("color","#ddd");
      $("#descricao").prop("disabled",true);
    }
    $("#descricao").css("color","#ddd");
    $("#descricao").prop("disabled",true);
  });
});


$(document).ready(function(){
  $("#estadoProduto").on("change",function(){
    enviarEstadoProduto(<?php echo $anuncio ?>);
  });
});

$(document).ready(function(){
  $("#categoriaProduto").on("change",function(){
    mudaCategoria(<?php echo $anuncio ?>);
  })
})
$(".button").sideNav();


$(document).ready(function(){
  $("#categoriaProdutoEscolhe").on("change",function(){
    mudaCategoriaEscolhe(<?php echo $anuncio ?>);
  })
})
</script>